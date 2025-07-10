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

        // Admin has access to all menus (including panel admin)
        $adminRole = $roles->where('name', 'admin')->first();
        if ($adminRole) {
            foreach ($menus as $menu) {
                MenuRole::firstOrCreate([
                    'role_id' => $adminRole->id,
                    'menu_id' => $menu->id,
                ]);
            }
        }

        // Editor has access to Dashboard and public pages, but NO panel admin
        $editorRole = $roles->where('name', 'editor')->first();
        if ($editorRole) {
            $editorMenus = $menus->whereIn('nama_menu', [
                'Beranda',
                'Dashboard',
                'About Us',
                'Contact',
                'Services',
                'News'
            ]);
            foreach ($editorMenus as $menu) {
                MenuRole::firstOrCreate([
                    'role_id' => $editorRole->id,
                    'menu_id' => $menu->id,
                ]);
            }
        }

        // Viewer has access to Beranda and public pages only
        $viewerRole = $roles->where('name', 'viewer')->first();
        if ($viewerRole) {
            $viewerMenus = $menus->whereIn('nama_menu', [
                'Beranda',
                'About Us',
                'Contact'
            ]);
            foreach ($viewerMenus as $menu) {
                MenuRole::firstOrCreate([
                    'role_id' => $viewerRole->id,
                    'menu_id' => $menu->id,
                ]);
            }
        }
    }
}
