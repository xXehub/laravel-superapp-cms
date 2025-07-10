<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions - Clean list following instructions
        $permissions = [
            // Dashboard/Panel access
            'access panel',
            'view dashboard',
            
            // User management
            'view users',
            'create users',
            'edit users', 
            'delete users',
            
            // Role management
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
            
            // Permission management
            'view permissions',
            'create permissions',
            'edit permissions',
            'delete permissions',
            
            // Menu management
            'view menus',
            'create menus',
            'edit menus',
            'delete menus',
            
            // Page management
            'view pages',
            'create pages',
            'edit pages',
            'delete pages',
            
            // Settings management
            'view settings',
            'edit settings',
            
            // Profile management
            'view profile',
            'edit profile',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions - Clean approach
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all()); // Admin gets all permissions

        $editor = Role::create(['name' => 'editor']);
        $editor->givePermissionTo([
            'access panel',
            'view dashboard',
            'view pages',
            'create pages',
            'edit pages',
            'delete pages',
            'view profile',
            'edit profile',
        ]);

        $viewer = Role::create(['name' => 'viewer']);
        $viewer->givePermissionTo([
            'view profile',
            'edit profile',
        ]);

        // Create admin user
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $adminUser->assignRole('admin');

        // Create editor user
        $editorUser = User::create([
            'name' => 'Editor User',
            'email' => 'editor@example.com',
            'password' => bcrypt('password'),
        ]);
        $editorUser->assignRole('editor');

        // Create viewer user
        $viewerUser = User::create([
            'name' => 'Viewer User',
            'email' => 'viewer@example.com',
            'password' => bcrypt('password'),
        ]);
        $viewerUser->assignRole('viewer');
    }
}
