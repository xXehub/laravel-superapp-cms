<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuRole;
use App\Models\MasterMenu;
use Spatie\Permission\Models\Role;

class MenuRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::all();
        $menus = MasterMenu::all();

        // Admin has access to ALL menus (including all panel menus)
        $adminRole = $roles->where('name', 'admin')->first();
        if ($adminRole) {
            foreach ($menus as $menu) {
                MenuRole::firstOrCreate([
                    'role_id' => $adminRole->id,
                    'menu_id' => $menu->id,
                ]);
            }
        }

        // Editor has access to profile and pages panel only
        $editorRole = $roles->where('name', 'editor')->first();
        if ($editorRole) {
            $editorMenuSlugs = [
                '', // Homepage
                'profile', // Profile
                'panel/pages', // Pages management only
                'about-us', // Public pages
                'contact',
            ];
            
            $editorMenus = $menus->whereIn('slug', $editorMenuSlugs);
            foreach ($editorMenus as $menu) {
                MenuRole::firstOrCreate([
                    'role_id' => $editorRole->id,
                    'menu_id' => $menu->id,
                ]);
            }
        }

        // Viewer has access to public pages and profile only (NO panel access)
        $viewerRole = $roles->where('name', 'viewer')->first();
        if ($viewerRole) {
            $viewerMenuSlugs = [
                '', // Homepage
                'profile', // Profile
                'about-us', // Public pages
                'contact',
            ];
            
            $viewerMenus = $menus->whereIn('slug', $viewerMenuSlugs);
            foreach ($viewerMenus as $menu) {
                MenuRole::firstOrCreate([
                    'role_id' => $viewerRole->id,
                    'menu_id' => $menu->id,
                ]);
            }
        }
    }
}
