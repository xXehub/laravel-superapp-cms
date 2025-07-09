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
        // Create main menus
        $dashboard = MasterMenu::create([
            'nama_menu' => 'Dashboard',
            'route_name' => 'dashboard',
            'icon' => 'fas fa-tachometer-alt',
            'urutan' => 1,
        ]);

        $users = MasterMenu::create([
            'nama_menu' => 'Users',
            'route_name' => 'users.index',
            'icon' => 'fas fa-users',
            'urutan' => 2,
        ]);

        $posts = MasterMenu::create([
            'nama_menu' => 'Posts',
            'route_name' => 'posts.index',
            'icon' => 'fas fa-newspaper',
            'urutan' => 3,
        ]);

        $pages = MasterMenu::create([
            'nama_menu' => 'Pages',
            'route_name' => 'pages.index',
            'icon' => 'fas fa-file-alt',
            'urutan' => 4,
        ]);

        // Create sub-menus for Users
        MasterMenu::create([
            'nama_menu' => 'All Users',
            'parent_id' => $users->id,
            'route_name' => 'users.index',
            'icon' => 'fas fa-list',
            'urutan' => 1,
        ]);

        MasterMenu::create([
            'nama_menu' => 'Create User',
            'parent_id' => $users->id,
            'route_name' => 'users.create',
            'icon' => 'fas fa-plus',
            'urutan' => 2,
        ]);

        // Create sub-menus for Posts
        MasterMenu::create([
            'nama_menu' => 'All Posts',
            'parent_id' => $posts->id,
            'route_name' => 'posts.index',
            'icon' => 'fas fa-list',
            'urutan' => 1,
        ]);

        MasterMenu::create([
            'nama_menu' => 'Create Post',
            'parent_id' => $posts->id,
            'route_name' => 'posts.create',
            'icon' => 'fas fa-plus',
            'urutan' => 2,
        ]);

        // Create sub-menus for Pages
        MasterMenu::create([
            'nama_menu' => 'All Pages',
            'parent_id' => $pages->id,
            'route_name' => 'pages.index',
            'icon' => 'fas fa-list',
            'urutan' => 1,
        ]);

        MasterMenu::create([
            'nama_menu' => 'Create Page',
            'parent_id' => $pages->id,
            'route_name' => 'pages.create',
            'icon' => 'fas fa-plus',
            'urutan' => 2,
        ]);

        // Create settings menu
        $settings = MasterMenu::create([
            'nama_menu' => 'Settings',
            'route_name' => 'settings.index',
            'icon' => 'fas fa-cog',
            'urutan' => 6,
        ]);
    }
}
