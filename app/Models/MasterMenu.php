<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Models\Role;

class MasterMenu extends Model
{
    protected $fillable = [
        'nama_menu',
        'parent_id',
        'route_name',
        'icon',
        'urutan'
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
     * Relationship to roles through menu_roles
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'menu_roles', 'menu_id', 'role_id');
    }

    /**
     * Scope for root menus (no parent)
     */
    public function scopeRootMenus($query)
    {
        return $query->whereNull('parent_id')->orderBy('urutan');
    }
}
