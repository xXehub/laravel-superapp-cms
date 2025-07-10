<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Get a setting value by key with optional default.
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function getValue(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        
        return $setting ? $setting->value : $default;
    }

    /**
     * Set a setting value by key.
     * 
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    public static function setValue(string $key, $value): bool
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        )->wasRecentlyCreated;
    }
}