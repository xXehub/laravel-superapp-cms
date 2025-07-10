<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Page;
use App\Models\MasterMenu;
use App\Models\Setting;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DynamicController extends Controller
{
    /**
     * Handle all dynamic routes - Clean single entry point following context instructions
     */
    public function handleDynamicRoute(Request $request, $slug = null, $id = null)
    {
        $slug = $slug ?: '';
        
        // Set route parameters for later use in methods
        if ($id) {
            $request->merge(['id' => $id]);
        }
        
        // Extract ID from slug pattern like 'panel/menus/edit/123'
        if (preg_match('#^(.*?)/(\d+)$#', $slug, $matches)) {
            $basePath = $matches[1];
            $extractedId = $matches[2];
            
            // Special handling for edit paths
            if (strpos($basePath, '/edit') !== false) {
                $slug = $basePath;
                $request->merge(['id' => $extractedId]);
            }
        }
        
        // Clean mapping approach - minimal conditionals
        $actionMap = [
            '' => 'handleWelcome',
            'profile' => 'handleProfile',
            'panel' => 'handlePanelIndex',
            'panel/dashboard' => 'handlePanelDashboard',
            'panel/users' => 'handlePanelUsers',
            'panel/roles' => 'handlePanelRoles', 
            'panel/permissions' => 'handlePanelPermissions',
            'panel/menus' => 'handlePanelMenus',
            'panel/pages' => 'handlePanelPages',
            'panel/settings' => 'handlePanelSettings',
            
            // CRUD operations for users
            'panel/users/create' => 'handlePanelUsersCreate',
            'panel/users/store' => 'handlePanelUsersStore',
            'panel/users/edit' => 'handlePanelUsersEdit',
            'panel/users/update' => 'handlePanelUsersUpdate',
            'panel/users/delete' => 'handlePanelUsersDelete',
            
            // CRUD operations for roles
            'panel/roles/create' => 'handlePanelRolesCreate',
            'panel/roles/store' => 'handlePanelRolesStore',
            'panel/roles/edit' => 'handlePanelRolesEdit',
            'panel/roles/update' => 'handlePanelRolesUpdate',
            'panel/roles/delete' => 'handlePanelRolesDelete',
            
            // CRUD operations for permissions
            'panel/permissions/create' => 'handlePanelPermissionsCreate',
            'panel/permissions/store' => 'handlePanelPermissionsStore',
            'panel/permissions/edit' => 'handlePanelPermissionsEdit',
            'panel/permissions/update' => 'handlePanelPermissionsUpdate',
            'panel/permissions/delete' => 'handlePanelPermissionsDelete',
            
            // CRUD operations for menus
            'panel/menus/create' => 'handlePanelMenusCreate',
            'panel/menus/store' => 'handlePanelMenusStore',
            'panel/menus/edit' => 'handlePanelMenusEdit',
            'panel/menus/update' => 'handlePanelMenusUpdate',
            'panel/menus/delete' => 'handlePanelMenusDelete',
            
            // CRUD operations for pages
            'panel/pages/create' => 'handlePanelPagesCreate',
            'panel/pages/store' => 'handlePanelPagesStore',
            'panel/pages/edit' => 'handlePanelPagesEdit',
            'panel/pages/update' => 'handlePanelPagesUpdate',
            'panel/pages/delete' => 'handlePanelPagesDelete',
        ];
        
        $method = $actionMap[$slug] ?? 'handleDynamicPage';
        
        if (method_exists($this, $method)) {
            return $this->$method($request, $slug);
        }
        
        // Fallback to dynamic page handling
        return $this->handleDynamicPage($request, $slug);
    }

    /**
     * Handle welcome page
     */
    protected function handleWelcome(Request $request, $slug)
    {
        return view('welcome');
    }

    /**
     * Handle profile page  
     */
    protected function handleProfile(Request $request, $slug)
    {
        return view('profile.show', ['user' => auth()->user()]);
    }

    /**
     * Handle panel index - redirect to dashboard
     */
    protected function handlePanelIndex(Request $request, $slug)
    {
        return redirect()->route('dynamic', ['slug' => 'panel/dashboard']);
    }

    /**
     * Handle panel dashboard - Clean approach
     */
    protected function handlePanelDashboard(Request $request, $slug)
    {
        $stats = [
            'users' => User::count(),
            'pages' => Page::count(),
            'menus' => MasterMenu::count(),
            'roles' => Role::count(),
            'permissions' => Permission::count(),
        ];

        $recentUsers = User::latest()->take(5)->get();
        $recentPages = Page::latest()->take(5)->get();

        return view('panel.dashboard', compact('stats', 'recentUsers', 'recentPages'));
    }

    /**
     * Handle panel users
     */
    protected function handlePanelUsers(Request $request, $slug)
    {
        $users = User::with('roles')->paginate(20);
        return view('panel.users.index', compact('users'));
    }

    /**
     * Handle panel roles  
     */
    protected function handlePanelRoles(Request $request, $slug)
    {
        $roles = Role::with('permissions')->paginate(20);
        return view('panel.roles.index', compact('roles'));
    }

    /**
     * Handle panel permissions
     */
    protected function handlePanelPermissions(Request $request, $slug)
    {
        $permissions = Permission::paginate(20);
        return view('panel.permissions.index', compact('permissions'));
    }

    /**
     * Handle panel menus
     */
    protected function handlePanelMenus(Request $request, $slug)
    {
        $menus = MasterMenu::with('roles', 'parent', 'children')->orderBy('urutan')->paginate(20);
        return view('panel.menus.index', compact('menus'));
    }

    /**
     * Handle panel pages
     */
    protected function handlePanelPages(Request $request, $slug)
    {
        $pages = Page::paginate(20);
        return view('panel.pages.index', compact('pages'));
    }

    /**
     * Handle panel settings
     */
    protected function handlePanelSettings(Request $request, $slug)
    {
        if ($request->isMethod('POST')) {
            return $this->updateSettings($request);
        }
        
        $settings = Setting::all()->keyBy('key') ?? collect();
        return view('panel.settings.index', compact('settings'));
    }

    /**
     * Handle dynamic pages - fallback for unknown slugs
     */
    protected function handleDynamicPage(Request $request, $slug)
    {
        $page = Page::where('slug', $slug)->where('is_published', true)->first();
        
        if (!$page) {
            abort(404, 'Page not found');
        }
        
        return view('pages.show', compact('page'));
    }

    /**
     * Update settings - clean approach
     */
    protected function updateSettings(Request $request)
    {
        $settings = $request->input('settings', []);
        
        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value);
        }
        
        return redirect()->back()->with('success', 'Settings updated successfully');
    }

    // ==================== USER CRUD OPERATIONS ====================

    /**
     * Show create user form
     */
    protected function handlePanelUsersCreate(Request $request, $slug)
    {
        $roles = Role::all();
        return view('panel.users.create', compact('roles'));
    }

    /**
     * Store new user
     */
    protected function handlePanelUsersStore(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'array'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->has('roles')) {
            $user->assignRole($request->roles);
        }

        return redirect()->route('dynamic', ['slug' => 'panel/users'])
            ->with('success', 'User created successfully');
    }

    /**
     * Show edit user form
     */
    protected function handlePanelUsersEdit(Request $request, $slug)
    {
        $userId = $request->route('id') ?? $request->input('id');
        $user = User::findOrFail($userId);
        $roles = Role::all();
        
        return view('panel.users.edit', compact('user', 'roles'));
    }

    /**
     * Update user
     */
    protected function handlePanelUsersUpdate(Request $request, $slug)
    {
        $userId = $request->route('id') ?? $request->input('id');
        $user = User::findOrFail($userId);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'array'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        $user->syncRoles($request->roles ?? []);

        return redirect()->route('dynamic', ['slug' => 'panel/users'])
            ->with('success', 'User updated successfully');
    }

    /**
     * Delete user
     */
    protected function handlePanelUsersDelete(Request $request, $slug)
    {
        $userId = $request->route('id') ?? $request->input('id');
        $user = User::findOrFail($userId);

        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'You cannot delete yourself');
        }

        $user->delete();

        return redirect()->route('dynamic', ['slug' => 'panel/users'])
            ->with('success', 'User deleted successfully');
    }

    // ==================== ROLE CRUD OPERATIONS ====================

    /**
     * Show create role form
     */
    protected function handlePanelRolesCreate(Request $request, $slug)
    {
        $permissions = Permission::all();
        return view('panel.roles.create', compact('permissions'));
    }

    /**
     * Store new role
     */
    protected function handlePanelRolesStore(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'permissions' => 'array'
        ]);

        $role = Role::create(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }

        return redirect()->route('dynamic', ['slug' => 'panel/roles'])
            ->with('success', 'Role created successfully');
    }

    /**
     * Show edit role form
     */
    protected function handlePanelRolesEdit(Request $request, $slug)
    {
        $roleId = $request->route('id') ?? $request->input('id');
        $role = Role::findOrFail($roleId);
        $permissions = Permission::all();
        
        return view('panel.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update role
     */
    protected function handlePanelRolesUpdate(Request $request, $slug)
    {
        $roleId = $request->route('id') ?? $request->input('id');
        $role = Role::findOrFail($roleId);

        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'array'
        ]);

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('dynamic', ['slug' => 'panel/roles'])
            ->with('success', 'Role updated successfully');
    }

    /**
     * Delete role
     */
    protected function handlePanelRolesDelete(Request $request, $slug)
    {
        $roleId = $request->route('id') ?? $request->input('id');
        $role = Role::findOrFail($roleId);

        $role->delete();

        return redirect()->route('dynamic', ['slug' => 'panel/roles'])
            ->with('success', 'Role deleted successfully');
    }

    // ==================== PERMISSION CRUD OPERATIONS ====================

    /**
     * Show create permission form
     */
    protected function handlePanelPermissionsCreate(Request $request, $slug)
    {
        return view('panel.permissions.create');
    }

    /**
     * Store new permission
     */
    protected function handlePanelPermissionsStore(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions',
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->route('dynamic', ['slug' => 'panel/permissions'])
            ->with('success', 'Permission created successfully');
    }

    /**
     * Show edit permission form
     */
    protected function handlePanelPermissionsEdit(Request $request, $slug)
    {
        $permissionId = $request->route('id') ?? $request->input('id');
        $permission = Permission::findOrFail($permissionId);
        
        return view('panel.permissions.edit', compact('permission'));
    }

    /**
     * Update permission
     */
    protected function handlePanelPermissionsUpdate(Request $request, $slug)
    {
        $permissionId = $request->route('id') ?? $request->input('id');
        $permission = Permission::findOrFail($permissionId);

        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update(['name' => $request->name]);

        return redirect()->route('dynamic', ['slug' => 'panel/permissions'])
            ->with('success', 'Permission updated successfully');
    }

    /**
     * Delete permission
     */
    protected function handlePanelPermissionsDelete(Request $request, $slug)
    {
        $permissionId = $request->route('id') ?? $request->input('id');
        $permission = Permission::findOrFail($permissionId);

        $permission->delete();

        return redirect()->route('dynamic', ['slug' => 'panel/permissions'])
            ->with('success', 'Permission deleted successfully');
    }

    // ==================== MENU CRUD OPERATIONS ====================

    /**
     * Show create menu form
     */
    protected function handlePanelMenusCreate(Request $request, $slug)
    {
        $parentMenus = MasterMenu::whereNull('parent_id')->get();
        $roles = Role::all();
        return view('panel.menus.create', compact('parentMenus', 'roles'));
    }

    /**
     * Store new menu
     */
    protected function handlePanelMenusStore(Request $request, $slug)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:master_menus',
            'route_name' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:master_menus,id',
            'urutan' => 'required|integer',
            'is_active' => 'boolean',
            'roles' => 'array'
        ]);

        $menu = MasterMenu::create([
            'nama_menu' => $request->nama_menu,
            'slug' => $request->slug,
            'route_name' => $request->route_name,
            'icon' => $request->icon,
            'parent_id' => $request->parent_id,
            'urutan' => $request->urutan,
            'is_active' => $request->has('is_active'),
        ]);

        if ($request->has('roles')) {
            $menu->roles()->sync($request->roles);
        }

        return redirect()->route('dynamic', ['slug' => 'panel/menus'])
            ->with('success', 'Menu created successfully');
    }

    /**
     * Show edit menu form
     */
    protected function handlePanelMenusEdit(Request $request, $slug)
    {
        $menuId = $request->route('id') ?? $request->input('id');
        
        if (!$menuId) {
            return redirect()->route('dynamic', ['slug' => 'panel/menus'])
                ->with('error', 'Menu ID not provided');
        }
        
        $menu = MasterMenu::findOrFail($menuId);
        $parentMenus = MasterMenu::whereNull('parent_id')->where('id', '!=', $menu->id)->get();
        $roles = Role::all();
        
        return view('panel.menus.edit', compact('menu', 'parentMenus', 'roles'));
    }

    /**
     * Update menu
     */
    protected function handlePanelMenusUpdate(Request $request, $slug)
    {
        $menuId = $request->route('id') ?? $request->input('id');
        $menu = MasterMenu::findOrFail($menuId);

        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:master_menus,slug,' . $menu->id,
            'route_name' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:master_menus,id',
            'urutan' => 'required|integer',
            'is_active' => 'boolean',
            'roles' => 'array'
        ]);

        $menu->update([
            'nama_menu' => $request->nama_menu,
            'slug' => $request->slug,
            'route_name' => $request->route_name,
            'icon' => $request->icon,
            'parent_id' => $request->parent_id,
            'urutan' => $request->urutan,
            'is_active' => $request->has('is_active'),
        ]);

        $menu->roles()->sync($request->roles ?? []);

        return redirect()->route('dynamic', ['slug' => 'panel/menus'])
            ->with('success', 'Menu updated successfully');
    }

    /**
     * Delete menu
     */
    protected function handlePanelMenusDelete(Request $request, $slug)
    {
        $menuId = $request->route('id') ?? $request->input('id');
        $menu = MasterMenu::findOrFail($menuId);

        // Check if menu has children
        if ($menu->children()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete menu with child items');
        }

        $menu->delete();

        return redirect()->route('dynamic', ['slug' => 'panel/menus'])
            ->with('success', 'Menu deleted successfully');
    }

    // ==================== PAGE CRUD OPERATIONS ====================

    /**
     * Show create page form
     */
    protected function handlePanelPagesCreate(Request $request, $slug)
    {
        return view('panel.pages.create');
    }

    /**
     * Store new page
     */
    protected function handlePanelPagesStore(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages',
            'content' => 'required',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'is_published' => 'boolean',
        ]);

        Page::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('dynamic', ['slug' => 'panel/pages'])
            ->with('success', 'Page created successfully');
    }

    /**
     * Show edit page form
     */
    protected function handlePanelPagesEdit(Request $request, $slug)
    {
        $pageId = $request->route('id') ?? $request->input('id');
        $page = Page::findOrFail($pageId);
        
        return view('panel.pages.edit', compact('page'));
    }

    /**
     * Update page
     */
    protected function handlePanelPagesUpdate(Request $request, $slug)
    {
        $pageId = $request->route('id') ?? $request->input('id');
        $page = Page::findOrFail($pageId);

        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'content' => 'required',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'is_published' => 'boolean',
        ]);

        $page->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('dynamic', ['slug' => 'panel/pages'])
            ->with('success', 'Page updated successfully');
    }

    /**
     * Delete page
     */
    protected function handlePanelPagesDelete(Request $request, $slug)
    {
        $pageId = $request->route('id') ?? $request->input('id');
        $page = Page::findOrFail($pageId);

        $page->delete();

        return redirect()->route('dynamic', ['slug' => 'panel/pages'])
            ->with('success', 'Page deleted successfully');
    }

    /**
     * Clean route mapping for CRUD operations
     */
    protected function getSlugRouteMap(): array
    {
        return [
            // Landing/Auth pages
            '' => 'handleWelcome',
            'profile' => 'handleProfile',
            
            // Panel dashboard and index
            'panel' => 'handlePanelIndex',
            'panel/dashboard' => 'handlePanelDashboard',
            
            // Panel listing pages
            'panel/users' => 'handlePanelUsers',
            'panel/roles' => 'handlePanelRoles', 
            'panel/permissions' => 'handlePanelPermissions',
            'panel/menus' => 'handlePanelMenus',
            'panel/pages' => 'handlePanelPages',
            'panel/settings' => 'handlePanelSettings',
            
            // CRUD operations for users
            'panel/users/create' => 'handlePanelUsersCreate',
            'panel/users/store' => 'handlePanelUsersStore',
            'panel/users/edit' => 'handlePanelUsersEdit',
            'panel/users/update' => 'handlePanelUsersUpdate',
            'panel/users/delete' => 'handlePanelUsersDelete',
            
            // CRUD operations for roles
            'panel/roles/create' => 'handlePanelRolesCreate',
            'panel/roles/store' => 'handlePanelRolesStore',
            'panel/roles/edit' => 'handlePanelRolesEdit',
            'panel/roles/update' => 'handlePanelRolesUpdate',
            'panel/roles/delete' => 'handlePanelRolesDelete',
            
            // CRUD operations for permissions
            'panel/permissions/create' => 'handlePanelPermissionsCreate',
            'panel/permissions/store' => 'handlePanelPermissionsStore',
            'panel/permissions/edit' => 'handlePanelPermissionsEdit',
            'panel/permissions/update' => 'handlePanelPermissionsUpdate',
            'panel/permissions/delete' => 'handlePanelPermissionsDelete',
            
            // CRUD operations for menus
            'panel/menus/create' => 'handlePanelMenusCreate',
            'panel/menus/store' => 'handlePanelMenusStore',
            'panel/menus/edit' => 'handlePanelMenusEdit',
            'panel/menus/update' => 'handlePanelMenusUpdate',
            'panel/menus/delete' => 'handlePanelMenusDelete',
            
            // CRUD operations for pages
            'panel/pages/create' => 'handlePanelPagesCreate',
            'panel/pages/store' => 'handlePanelPagesStore',
            'panel/pages/edit' => 'handlePanelPagesEdit',
            'panel/pages/update' => 'handlePanelPagesUpdate',
            'panel/pages/delete' => 'handlePanelPagesDelete',
        ];
    }
}
