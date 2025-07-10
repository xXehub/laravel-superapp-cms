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
        // 1. Home/Landing Page - accessible to all
        $home = MasterMenu::create([
            'nama_menu' => 'Beranda',
            'slug' => '',  // Empty slug for homepage
            'route_name' => 'welcome',
            'icon' => 'fas fa-home',
            'urutan' => 0,
            'is_active' => true,
        ]);

        // 2. Dashboard - for authenticated users
        $dashboard = MasterMenu::create([
            'nama_menu' => 'Dashboard',
            'slug' => 'dashboard',
            'route_name' => 'dashboard',
            'icon' => 'fas fa-tachometer-alt',
            'urutan' => 1,
            'is_active' => true,
        ]);

        // 3. Panel Admin Menu (Main Root Menu) - for admins only
        $panelMenu = MasterMenu::create([
            'nama_menu' => 'Panel Admin',
            'slug' => null,  // No slug for parent menu - it's just a grouper
            'route_name' => null,  // No direct route, parent menu only
            'icon' => 'fas fa-shield-alt',
            'urutan' => 2,
            'is_active' => true,
        ]);

        // Panel Admin Sub-menus
        MasterMenu::create([
            'nama_menu' => 'Panel Dashboard',
            'slug' => 'panel/dashboard',
            'parent_id' => $panelMenu->id,
            'route_name' => null,
            'icon' => 'fas fa-chart-line',
            'urutan' => 1,
            'is_active' => true,
        ]);

        MasterMenu::create([
            'nama_menu' => 'Kelola Users',
            'slug' => 'panel/users',
            'parent_id' => $panelMenu->id,
            'route_name' => null,
            'icon' => 'fas fa-users-cog',
            'urutan' => 2,
            'is_active' => true,
        ]);

        MasterMenu::create([
            'nama_menu' => 'Kelola Roles',
            'slug' => 'panel/roles',
            'parent_id' => $panelMenu->id,
            'route_name' => null,
            'icon' => 'fas fa-user-tag',
            'urutan' => 3,
            'is_active' => true,
        ]);

        MasterMenu::create([
            'nama_menu' => 'Kelola Permissions',
            'slug' => 'panel/permissions',
            'parent_id' => $panelMenu->id,
            'route_name' => null,
            'icon' => 'fas fa-key',
            'urutan' => 4,
            'is_active' => true,
        ]);

        MasterMenu::create([
            'nama_menu' => 'Kelola Menus',
            'slug' => 'panel/menus',
            'parent_id' => $panelMenu->id,
            'route_name' => null,
            'icon' => 'fas fa-bars',
            'urutan' => 5,
            'is_active' => true,
        ]);

        MasterMenu::create([
            'nama_menu' => 'Kelola Pages',
            'slug' => 'panel/pages',
            'parent_id' => $panelMenu->id,
            'route_name' => null,
            'icon' => 'fas fa-file-alt',
            'urutan' => 6,
            'is_active' => true,
        ]);

        MasterMenu::create([
            'nama_menu' => 'Settings',
            'slug' => 'panel/settings',
            'parent_id' => $panelMenu->id,
            'route_name' => null,
            'icon' => 'fas fa-cog',
            'urutan' => 7,
            'is_active' => true,
        ]);

        // 4. Sample dynamic public pages - accessible based on role assignments
        MasterMenu::create([
            'nama_menu' => 'About Us',
            'slug' => 'about-us',
            'route_name' => null,
            'icon' => 'fas fa-info-circle',
            'urutan' => 3,
            'is_active' => true,
        ]);

        MasterMenu::create([
            'nama_menu' => 'Contact',
            'slug' => 'contact',
            'route_name' => null,
            'icon' => 'fas fa-envelope',
            'urutan' => 4,
            'is_active' => true,
        ]);

        MasterMenu::create([
            'nama_menu' => 'Services',
            'slug' => 'services',
            'route_name' => null,
            'icon' => 'fas fa-concierge-bell',
            'urutan' => 5,
            'is_active' => true,
        ]);

        MasterMenu::create([
            'nama_menu' => 'News',
            'slug' => 'news',
            'route_name' => null,
            'icon' => 'fas fa-newspaper',
            'urutan' => 6,
            'is_active' => true,
        ]);
    }
}
