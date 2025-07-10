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
        // 1. Beranda - Root menu
        MasterMenu::create([
            'nama_menu' => 'Beranda',
            'slug' => '',
            'parent_id' => null,
            'route_name' => 'welcome',
            'icon' => 'fas fa-home',
            'urutan' => 0,
            'is_active' => true,
        ]);

        // 2. Dashboard - Root menu
        MasterMenu::create([
            'nama_menu' => 'Dashboard',
            'slug' => 'panel/dashboard',
            'parent_id' => null,
            'route_name' => null,
            'icon' => 'fas fa-tachometer-alt',
            'urutan' => 1,
            'is_active' => true,
        ]);

        // 3. Panel Management - Parent menu
        $panelManagement = MasterMenu::create([
            'nama_menu' => 'Panel Management',
            'slug' => 'dashboard',
            'parent_id' => null,
            'route_name' => null,
            'icon' => 'fas fa-cogs',
            'urutan' => 2,
            'is_active' => true,
        ]);

        // Child menus under Panel Management
        MasterMenu::create([
            'nama_menu' => 'Users',
            'slug' => 'panel/users',
            'parent_id' => $panelManagement->id,
            'route_name' => null,
            'icon' => 'fas fa-users',
            'urutan' => 3,
            'is_active' => true,
        ]);

        MasterMenu::create([
            'nama_menu' => 'Roles',
            'slug' => 'panel/roles',
            'parent_id' => $panelManagement->id,
            'route_name' => null,
            'icon' => 'fas fa-user-tag',
            'urutan' => 4,
            'is_active' => true,
        ]);

        MasterMenu::create([
            'nama_menu' => 'Permissions',
            'slug' => 'panel/permissions',
            'parent_id' => $panelManagement->id,
            'route_name' => null,
            'icon' => 'fas fa-key',
            'urutan' => 5,
            'is_active' => true,
        ]);

        MasterMenu::create([
            'nama_menu' => 'Menus',
            'slug' => 'panel/menus',
            'parent_id' => $panelManagement->id,
            'route_name' => null,
            'icon' => 'fas fa-bars',
            'urutan' => 6,
            'is_active' => true,
        ]);

        MasterMenu::create([
            'nama_menu' => 'Pages',
            'slug' => 'panel/pages',
            'parent_id' => $panelManagement->id,
            'route_name' => null,
            'icon' => 'fas fa-file-alt',
            'urutan' => 7,
            'is_active' => true,
        ]);

        MasterMenu::create([
            'nama_menu' => 'Settings',
            'slug' => 'panel/settings',
            'parent_id' => $panelManagement->id,
            'route_name' => null,
            'icon' => 'fas fa-cog',
            'urutan' => 8,
            'is_active' => true,
        ]);

        // 4. Public pages - Root menus
        MasterMenu::create([
            'nama_menu' => 'About Us',
            'slug' => 'about-us',
            'parent_id' => null,
            'route_name' => null,
            'icon' => 'fas fa-info-circle',
            'urutan' => 9,
            'is_active' => true,
        ]);

        MasterMenu::create([
            'nama_menu' => 'Contact',
            'slug' => 'contact',
            'parent_id' => null,
            'route_name' => null,
            'icon' => 'fas fa-envelope',
            'urutan' => 10,
            'is_active' => true,
        ]);
    }
}
