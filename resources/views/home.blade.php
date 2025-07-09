@extends('layouts.app-with-sidebar')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<div class="row">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Welcome!</h5>
                        <p class="card-text">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-user fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Your Role</h5>
                        <p class="card-text">{{ Auth::user()->roles->first()->name ?? 'No Role' }}</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-user-tag fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Permissions</h5>
                        <p class="card-text">{{ Auth::user()->getAllPermissions()->count() }} permissions</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-key fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Menu Access</h5>
                        <p class="card-text">{{ isset($userMenus) ? $userMenus->count() : 0 }} menus</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-bars fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Your Permissions</h5>
            </div>
            <div class="card-body">
                @if(Auth::user()->getAllPermissions()->count() > 0)
                    <div class="row">
                        @foreach(Auth::user()->getAllPermissions() as $permission)
                            <div class="col-md-4 mb-2">
                                <span class="badge bg-secondary">{{ $permission->name }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No permissions assigned.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
