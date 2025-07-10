<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\MasterMenu;
use Illuminate\Support\Facades\Auth;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(['layouts.app', 'layouts.app-with-sidebar', 'components.app'], function ($view) {
            $menus = collect();
            $isAdmin = false;
            
            if (Auth::check()) {
                try {
                    $user = Auth::user();
                    $userRoles = $user->roles->pluck('id');
                    $isAdmin = $user->hasRole('admin');
                    
                    if ($userRoles->isNotEmpty()) {
                        // Get active menus accessible by user's roles
                        $menus = MasterMenu::active()
                            ->whereHas('roles', function ($query) use ($userRoles) {
                                $query->whereIn('role_id', $userRoles);
                            })
                            ->rootMenus()
                            ->with(['children' => function ($query) use ($userRoles) {
                                $query->active()
                                    ->whereHas('roles', function ($subQuery) use ($userRoles) {
                                        $subQuery->whereIn('role_id', $userRoles);
                                    })
                                    ->orderBy('urutan');
                            }])
                            ->orderBy('urutan')
                            ->get();
                    }
                } catch (\Exception $e) {
                    // Log error but don't break the page
                    \Log::error('Error loading user menus: ' . $e->getMessage());
                }
            }
            
            $view->with([
                'userMenus' => $menus,
                'isAdmin' => $isAdmin
            ]);
        });
    }
}
