<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MasterMenu;

class MasterMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Home/Landing Page - accessible to all (no role restrictions)
        MasterMenu::create([
            'nama_menu' => 'Beranda',
            'slug' => '',  // Empty slug for homepage
            'route_name' => 'welcome',
            'icon' => 'fas fa-home',
            'urutan' => 0,
            'is_active' => true,
        ]);

        // 2. Profile Page - accessible to authenticated users
        MasterMenu::create([
            'nama_menu' => 'Profile',
            'slug' => 'profile',
            'route_name' => 'profile',
            'icon' => 'fas fa-user',
            'urutan' => 1,
            'is_active' => true,
        ]);

        // 3. Panel Access - Dashboard moved inside panel structure
        MasterMenu::create([
            'nama_menu' => 'Dashboard',
            'slug' => 'panel/dashboard',
            'route_name' => null,
            'icon' => 'fas fa-tachometer-alt',
            'urutan' => 2,
            'is_active' => true,
        ]);

        MasterMenu::create([
            'nama_menu' => 'Users',
            'slug' => 'panel/users',
            'route_name' => null,
            'icon' => 'fas fa-users',
            'urutan' => 3,
            'is_active' => true,
        ]);

        MasterMenu::create([
            'nama_menu' => 'Roles',
            'slug' => 'panel/roles',
            'route_name' => null,
            'icon' => 'fas fa-user-tag',
            'urutan' => 4,
            'is_active' => true,
        ]);

        MasterMenu::create([
            'nama_menu' => 'Permissions',
            'slug' => 'panel/permissions',
            'route_name' => null,
            'icon' => 'fas fa-key',
            'urutan' => 5,
            'is_active' => true,
        ]);

        MasterMenu::create([
            'nama_menu' => 'Menus',
            'slug' => 'panel/menus',
            'route_name' => null,
            'icon' => 'fas fa-bars',
            'urutan' => 6,
            'is_active' => true,
        ]);

        MasterMenu::create([
            'nama_menu' => 'Pages',
            'slug' => 'panel/pages',
            'route_name' => null,
            'icon' => 'fas fa-file-alt',
            'urutan' => 7,
            'is_active' => true,
        ]);

        MasterMenu::create([
            'nama_menu' => 'Settings',
            'slug' => 'panel/settings',
            'route_name' => null,
            'icon' => 'fas fa-cog',
            'urutan' => 8,
            'is_active' => true,
        ]);

        // 4. Sample public pages
        MasterMenu::create([
            'nama_menu' => 'About Us',
            'slug' => 'about-us',
            'route_name' => null,
            'icon' => 'fas fa-info-circle',
            'urutan' => 9,
            'is_active' => true,
        ]);

        MasterMenu::create([
            'nama_menu' => 'Contact',
            'slug' => 'contact',
            'route_name' => null,
            'icon' => 'fas fa-envelope',
            'urutan' => 10,
            'is_active' => true,
        ]);
    }
}
