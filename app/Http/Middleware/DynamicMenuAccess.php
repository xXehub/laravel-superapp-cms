<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\MasterMenu;
use Symfony\Component\HttpFoundation\Response;

class DynamicMenuAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeName = $request->route()->getName();
        $currentPath = $request->path();
        
        // Skip check for certain core routes
        $skipRoutes = ['dashboard', 'home', 'logout', 'welcome', 'login', 'register'];
        if (in_array($routeName, $skipRoutes) || str_starts_with($routeName, 'password.')) {
            return $next($request);
        }

        // Handle panel routes (admin only)
        if (str_starts_with($currentPath, 'panel/')) {
            // Check if user is authenticated and is admin
            if (!auth()->check()) {
                return redirect()->route('login');
            }
            
            if (!auth()->user()->hasRole('admin')) {
                abort(403, 'Access denied. Admin role required.');
            }
            
            // Extract slug from panel path
            $slug = $currentPath; // This will be "panel/dashboard", "panel/users", etc.
            
            // Find menu by slug
            $menu = MasterMenu::where('slug', $slug)->where('is_active', true)->first();
            
            if ($menu) {
                // Check if user's roles have access to this panel menu
                $userRoleIds = auth()->user()->roles->pluck('id');
                $hasAccess = $menu->roles()->whereIn('role_id', $userRoleIds)->exists();
                
                if (!$hasAccess) {
                    abort(403, 'Access denied. You do not have permission to access this panel page.');
                }
            }
            
            return $next($request);
        }

        // Handle public/user pages - check if there's a corresponding menu
        $menu = MasterMenu::where('slug', $currentPath)->where('is_active', true)->first();
        
        if ($menu && $menu->roles()->exists()) {
            // This page is protected by menu roles
            if (!auth()->check()) {
                return redirect()->route('login');
            }
            
            // Check if user's roles have access to this menu
            $userRoleIds = auth()->user()->roles->pluck('id');
            $hasAccess = $menu->roles()->whereIn('role_id', $userRoleIds)->exists();
            
            if (!$hasAccess) {
                abort(403, 'Access denied. You do not have permission to access this page.');
            }
        }
        
        // Also check by route_name for backwards compatibility
        if ($routeName) {
            $menuByRoute = MasterMenu::where('route_name', $routeName)->where('is_active', true)->first();
            
            if ($menuByRoute && $menuByRoute->roles()->exists()) {
                if (!auth()->check()) {
                    return redirect()->route('login');
                }
                
                $userRoleIds = auth()->user()->roles->pluck('id');
                $hasAccess = $menuByRoute->roles()->whereIn('role_id', $userRoleIds)->exists();
                
                if (!$hasAccess) {
                    abort(403, 'Access denied. You do not have permission to access this page.');
                }
            }
        }

        return $next($request);
    }
}
