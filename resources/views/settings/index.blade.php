@extends('layouts.app-with-sidebar')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Settings</h1>
    <span class="badge bg-danger">Admin Only</span>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Roles & Permissions</h5>
            </div>
            <div class="card-body">
                @foreach(Spatie\Permission\Models\Role::with('permissions')->get() as $role)
                    <div class="accordion mb-3" id="accordion-{{ $role->id }}">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-{{ $role->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $role->id }}" aria-expanded="false" aria-controls="collapse-{{ $role->id }}">
                                    <strong>{{ ucfirst($role->name) }}</strong>
                                    <span class="badge bg-secondary ms-2">{{ $role->permissions->count() }} permissions</span>
                                </button>
                            </h2>
                            <div id="collapse-{{ $role->id }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $role->id }}" data-bs-parent="#accordion-{{ $role->id }}">
                                <div class="accordion-body">
                                    @forelse($role->permissions as $permission)
                                        <span class="badge bg-info me-1 mb-1">{{ $permission->name }}</span>
                                    @empty
                                        <span class="text-muted">No permissions assigned</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Menu Access Overview</h5>
            </div>
            <div class="card-body">
                @foreach(Spatie\Permission\Models\Role::all() as $role)
                    <h6 class="text-primary">{{ ucfirst($role->name) }} Role</h6>
                    <div class="mb-3">
                        @php
                            $roleMenus = App\Models\MasterMenu::whereHas('roles', function($query) use ($role) {
                                $query->where('role_id', $role->id);
                            })->get();
                        @endphp
                        
                        @forelse($roleMenus as $menu)
                            <span class="badge bg-success me-1 mb-1">{{ $menu->nama_menu }}</span>
                        @empty
                            <span class="text-muted">No menu access</span>
                        @endforelse
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">System Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td><strong>Laravel Version:</strong></td>
                        <td>{{ app()->version() }}</td>
                    </tr>
                    <tr>
                        <td><strong>PHP Version:</strong></td>
                        <td>{{ PHP_VERSION }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total Users:</strong></td>
                        <td>{{ App\Models\User::count() }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total Roles:</strong></td>
                        <td>{{ Spatie\Permission\Models\Role::count() }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total Permissions:</strong></td>
                        <td>{{ Spatie\Permission\Models\Permission::count() }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total Menus:</strong></td>
                        <td>{{ App\Models\MasterMenu::count() }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
