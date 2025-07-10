<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Page;
use App\Models\MasterMenu;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function dynamicRoute($slug)
    {
        // Map slugs to methods
        $routeMap = [
            'dashboard' => 'dashboard',
            'users' => 'users',
            'roles' => 'roles',
            'permissions' => 'permissions',
            'menus' => 'menus',
            'pages' => 'pages',
            'settings' => 'settings'
        ];

        if (isset($routeMap[$slug])) {
            return $this->{$routeMap[$slug]}();
        }

        abort(404, 'Panel page not found');
    }

    public function dashboard()
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

    public function users()
    {
        $users = User::with('roles')->paginate(20);
        return view('panel.users.index', compact('users'));
    }

    public function roles()
    {
        $roles = Role::with('permissions')->paginate(20);
        return view('panel.roles.index', compact('roles'));
    }

    public function permissions()
    {
        $permissions = Permission::paginate(20);
        return view('panel.permissions.index', compact('permissions'));
    }

    public function menus()
    {
        $menus = MasterMenu::with('roles', 'parent', 'children')->orderBy('urutan')->paginate(20);
        return view('panel.menus.index', compact('menus'));
    }

    public function pages()
    {
        $pages = Page::paginate(20);
        return view('panel.pages.index', compact('pages'));
    }

    public function settings()
    {
        return view('panel.settings.index');
    }
}
