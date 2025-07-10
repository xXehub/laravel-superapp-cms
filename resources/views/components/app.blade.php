@props(['title' => null, 'isAdmin' => false, 'bodyClass' => '', 'navClass' => 'bg-dark', 'useSidebar' => null])

@php
    // Auto-detect if we should use sidebar based on current route
    $currentRoute = request()->route()->getName() ?? '';
    $shouldUseSidebar = $useSidebar ?? (
        auth()->check() && 
        (str_starts_with($currentRoute, 'panel.') || 
         in_array($currentRoute, ['dashboard', 'home']))
    );
@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
        }

        .sidebar .nav-link {
            color: #fff;
            border-radius: 0.25rem;
            margin-bottom: 0.25rem;
        }

        .sidebar .nav-link:hover {
            background-color: #495057;
            color: #fff;
        }

        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: #fff;
        }

        .sidebar-sticky {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .content-wrapper {
            min-height: calc(100vh - 56px);
        }

        .admin-panel {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .admin-panel .sidebar {
            background: rgba(0,0,0,0.2);
        }

        .admin-panel .sidebar .nav-link {
            color: rgba(255,255,255,0.9);
        }

        .admin-panel .sidebar .nav-link:hover {
            background-color: rgba(255,255,255,0.2);
            color: #fff;
        }
    </style>
</head>

<body class="{{ $bodyClass }}">
    <div id="app">
        <!-- Top Navigation -->
        <nav class="navbar navbar-expand-md navbar-dark {{ $navClass }} shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                    @if($isAdmin)
                        <span class="badge bg-danger ms-2">Admin</span>
                    @endif
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                    <span
                                        class="badge bg-secondary ms-1">{{ Auth::user()->roles->first()->name ?? 'No Role' }}</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @php
                                        // Check if user has access to panel/dashboard menu dynamically
                                        $panelDashboard = \App\Models\MasterMenu::active()
                                            ->where('slug', 'panel/dashboard')
                                            ->whereHas('roles', function($q) {
                                                $q->whereIn('role_id', auth()->user()->roles->pluck('id'));
                                            })
                                            ->first();
                                    @endphp
                                    
                                    @if($panelDashboard)
                                        <a class="dropdown-item" href="{{ route('dynamic', ['slug' => 'panel/dashboard']) }}">
                                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                        </a>
                                    @endif
                                    
                                    <a class="dropdown-item" href="{{ route('dynamic', ['slug' => 'profile']) }}">
                                        <i class="fas fa-user me-2"></i>Profile
                                    </a>
                                    <hr class="dropdown-divider">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>{{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @if($shouldUseSidebar)
            <div class="container-fluid">
                <div class="row">
                    <!-- Sidebar -->
                    <x-sidebar :menus="$userMenus ?? collect()" />

                    <!-- Main content -->
                    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                        <div class="content-wrapper">
                            <x-flash-messages />
                            {{ $slot }}
                        </div>
                    </main>
                </div>
            </div>
        @else
            <main class="py-4">
                <x-flash-messages />
                {{ $slot }}
            </main>
        @endif
    </div>
</body>

</html>
