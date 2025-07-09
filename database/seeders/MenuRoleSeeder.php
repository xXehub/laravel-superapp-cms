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

        // Admin has access to all menus
        $adminRole = $roles->where('name', 'admin')->first();
        foreach ($menus as $menu) {
            MenuRole::create([
                'role_id' => $adminRole->id,
                'menu_id' => $menu->id,
            ]);
        }

        // Editor has access to Dashboard and Posts
        $editorRole = $roles->where('name', 'editor')->first();
        $editorMenus = $menus->whereIn('nama_menu', ['Dashboard', 'Posts', 'All Posts', 'Create Post']);
        foreach ($editorMenus as $menu) {
            MenuRole::create([
                'role_id' => $editorRole->id,
                'menu_id' => $menu->id,
            ]);
        }

        // Viewer has access to Dashboard and view Posts only
        $viewerRole = $roles->where('name', 'viewer')->first();
        $viewerMenus = $menus->whereIn('nama_menu', ['Dashboard', 'Posts', 'All Posts']);
        foreach ($viewerMenus as $menu) {
            MenuRole::create([
                'role_id' => $viewerRole->id,
                'menu_id' => $menu->id,
            ]);
        }
    }
}
