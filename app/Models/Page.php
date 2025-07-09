<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'template',
        'is_published',
        'meta_title',
        'meta_description',
        'sort_order'
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    /**
     * Scope for published pages only
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Get page by slug
     */
    public function scopeBySlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    /**
     * Get the route key name for Laravel
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
