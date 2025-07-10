<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\MasterMenu;
use Symfony\Component\HttpFoundation\Response;

class DynamicMenuAccess
{
    /**
     * Handle an incoming request - Clean dynamic access control
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentPath = $request->path();
        
        // Skip auth routes - clean early return approach
        if ($this->shouldSkipCheck($currentPath)) {
            return $next($request);
        }

        // Check menu access - clean approach without hardcoded roles
        $menu = $this->findMenuBySlug($currentPath);
        
        if ($menu && $this->menuHasRoleRestrictions($menu)) {
            return $this->checkMenuAccess($menu) ? $next($request) : $this->denyAccess();
        }

        return $next($request);
    }

    /**
     * Check if we should skip access check
     */
    private function shouldSkipCheck(string $path): bool
    {
        $publicPaths = ['', 'login', 'register', 'password'];
        
        return in_array($path, $publicPaths) || 
               str_starts_with($path, 'password/') ||
               str_starts_with($path, 'email/');
    }

    /**
     * Find menu by slug - clean approach
     */
    private function findMenuBySlug(string $slug): ?MasterMenu
    {
        return MasterMenu::active()->where('slug', $slug)->first();
    }

    /**
     * Check if menu has role restrictions
     */
    private function menuHasRoleRestrictions(MasterMenu $menu): bool
    {
        return $menu->roles()->exists();
    }

    /**
     * Check menu access - clean approach without hardcoded roles
     */
    private function checkMenuAccess(MasterMenu $menu): bool
    {
        if (!auth()->check()) {
            return false;
        }

        $userRoleIds = auth()->user()->roles->pluck('id');
        
        return $menu->roles()->whereIn('role_id', $userRoleIds)->exists();
    }

    /**
     * Deny access with redirect or abort
     */
    private function denyAccess(): Response
    {
        return auth()->check() 
            ? abort(403, 'Access denied. You do not have permission to access this page.')
            : redirect()->route('login');
    }
}
