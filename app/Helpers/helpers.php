<?php

if (!function_exists('setting')) {
    /**
     * Get a setting value by key with optional default.
     * Uses static cache for performance.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function setting(string $key, $default = null)
    {
        static $settings = [];
        
        if (!isset($settings[$key])) {
            $settings[$key] = \App\Models\Setting::getValue($key, $default);
        }
        
        return $settings[$key];
    }
}