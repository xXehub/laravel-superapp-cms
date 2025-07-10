<x-app title="Manage Roles" :is-admin="true" body-class="admin-panel" nav-class="bg-gradient-primary">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <i class="fas fa-user-tag me-2"></i>Manage Roles
        </h1>
    </div>

    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">All Roles</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Guard</th>
                            <th>Permissions</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $role)
                        <tr>
                            <td>
                                <span class="badge bg-info">{{ $role->name }}</span>
                            </td>
                            <td>{{ $role->guard_name }}</td>
                            <td>
                                @foreach($role->permissions as $permission)
                                    <span class="badge bg-secondary me-1">{{ $permission->name }}</span>
                                @endforeach
                            </td>
                            <td>{{ $role->created_at->format('M d, Y') }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No roles found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($roles->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $roles->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app>
