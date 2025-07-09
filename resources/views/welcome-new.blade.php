@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Hero Section -->
            <div class="jumbotron bg-primary text-white text-center rounded p-5 mb-5">
                <h1 class="display-4">Laravel Superapp CMS</h1>
                <p class="lead">A powerful content management system built with Laravel 12, featuring role-based permissions, dynamic menus, and clean architecture.</p>
                @auth
                    <a class="btn btn-light btn-lg" href="{{ route('dashboard') }}" role="button">
                        <i class="fas fa-tachometer-alt"></i> Go to Dashboard
                    </a>
                @else
                    <a class="btn btn-light btn-lg" href="{{ route('login') }}" role="button">
                        <i class="fas fa-sign-in-alt"></i> Login to Continue
                    </a>
                @endauth
            </div>

            <!-- Features Section -->
            <div class="row mb-5">
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="text-primary mb-3">
                                <i class="fas fa-shield-alt fa-3x"></i>
                            </div>
                            <h5 class="card-title">Role-Based Access</h5>
                            <p class="card-text">Spatie Laravel Permission for granular access control with roles and permissions.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="text-success mb-3">
                                <i class="fas fa-bars fa-3x"></i>
                            </div>
                            <h5 class="card-title">Dynamic Menus</h5>
                            <p class="card-text">Hierarchical menu system with role-based visibility using clean relationship queries.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="text-info mb-3">
                                <i class="fas fa-file-alt fa-3x"></i>
                            </div>
                            <h5 class="card-title">Dynamic Pages</h5>
                            <p class="card-text">Slug-based routing with custom templates and SEO-friendly URL management.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="text-warning mb-3">
                                <i class="fas fa-code fa-3x"></i>
                            </div>
                            <h5 class="card-title">Clean Code</h5>
                            <p class="card-text">Modern Laravel practices with minimal conditionals, Blade components, and policies.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sample Pages -->
            <div class="row mb-5">
                <div class="col-12">
                    <h3 class="mb-4">Explore Sample Pages</h3>
                    <div class="row">
                        @php
                            $samplePages = \App\Models\Page::published()->orderBy('sort_order')->take(4)->get();
                        @endphp
                        
                        @forelse($samplePages as $page)
                            <div class="col-md-6 col-lg-3 mb-3">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $page->title }}</h6>
                                        <p class="card-text small text-muted">{{ Str::limit($page->content, 80) }}</p>
                                        <a href="{{ url($page->slug) }}" class="btn btn-outline-primary btn-sm">
                                            Read More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    No pages available yet. Login as admin to create some pages!
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Test Accounts -->
            @guest
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="fas fa-users"></i> Test Accounts
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-3">Use these accounts to explore different role-based features:</p>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="border rounded p-3">
                                        <h6 class="text-danger">Admin Account</h6>
                                        <p class="mb-1"><strong>Email:</strong> admin@example.com</p>
                                        <p class="mb-1"><strong>Password:</strong> password</p>
                                        <small class="text-muted">Full system access</small>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="border rounded p-3">
                                        <h6 class="text-warning">Editor Account</h6>
                                        <p class="mb-1"><strong>Email:</strong> editor@example.com</p>
                                        <p class="mb-1"><strong>Password:</strong> password</p>
                                        <small class="text-muted">Posts & Pages management</small>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="border rounded p-3">
                                        <h6 class="text-info">Viewer Account</h6>
                                        <p class="mb-1"><strong>Email:</strong> viewer@example.com</p>
                                        <p class="mb-1"><strong>Password:</strong> password</p>
                                        <small class="text-muted">Read-only access</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endguest
        </div>
    </div>
</div>
@endsection
