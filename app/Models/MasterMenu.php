<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Permission\Models\Role;

class MasterMenu extends Model
{
    protected $fillable = [
        'nama_menu',
        'slug',
        'parent_id',
        'route_name',
        'icon',
        'urutan',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relationship to parent menu
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(MasterMenu::class, 'parent_id');
    }

    /**
     * Relationship to child menus
     */
    public function children(): HasMany
    {
        return $this->hasMany(MasterMenu::class, 'parent_id')->orderBy('urutan');
    }

    /**
     * Relationship to roles through menu_roles pivot table
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'menu_roles', 'menu_id', 'role_id');
    }

    /**
     * Relationship to corresponding dynamic page (if exists)
     */
    public function page(): HasOne
    {
        return $this->hasOne(Page::class, 'slug', 'slug');
    }

    /**
     * Scope for root menus (no parent)
     */
    public function scopeRootMenus($query)
    {
        return $query->whereNull('parent_id')->orderBy('urutan');
    }

    /**
     * Scope for active menus only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get URL for this menu based on slug or route_name
     */
    public function getUrl()
    {
        // Handle special case for homepage (empty slug)
        if ($this->slug === '') {
            return url('/');
        }
        
        // If has slug, use slug-based URL
        if ($this->slug && $this->slug !== null) {
            return url($this->slug);
        }
        
        // Fallback to route_name if exists
        if ($this->route_name && \Route::has($this->route_name)) {
            return route($this->route_name);
        }
        
        // For parent menus or menus without slugs/routes, return a placeholder
        return '#';
    }

    /**
     * Check if this menu is accessible to current user
     */
    public function isAccessible()
    {
        if (!auth()->check()) {
            return false;
        }
        
        $userRoles = auth()->user()->roles->pluck('id');
        return $this->roles()->whereIn('role_id', $userRoles)->exists();
    }

    /**
     * Check if this is a panel/admin menu
     */
    public function isPanelMenu()
    {
        return str_starts_with($this->slug ?? '', 'panel/');
    }

    /**
     * Get the display name with proper formatting
     */
    public function getDisplayNameAttribute()
    {
        return $this->nama_menu;
    }

    /**
     * Get full breadcrumb path
     */
    public function getBreadcrumbs()
    {
        $breadcrumbs = collect([$this]);
        $parent = $this->parent;
        
        while ($parent) {
            $breadcrumbs->prepend($parent);
            $parent = $parent->parent;
        }
        
        return $breadcrumbs;
    }
}
