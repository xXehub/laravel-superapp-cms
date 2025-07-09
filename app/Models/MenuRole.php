<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Permission\Models\Role;

class MenuRole extends Model
{
    protected $fillable = [
        'role_id',
        'menu_id'
    ];

    /**
     * Relationship to role
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relationship to menu
     */
    public function menu(): BelongsTo
    {
        return $this->belongsTo(MasterMenu::class);
    }
}
