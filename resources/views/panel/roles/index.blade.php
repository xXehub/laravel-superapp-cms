<x-app title="Kelola Roles - Panel Admin" :is-admin="true" body-class="admin-panel" nav-class="bg-gradient-primary">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <i class="fas fa-user-tag me-2"></i>Kelola Roles
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Role
            </button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Role</th>
                    <th>Guard</th>
                    <th>Permissions</th>
                    <th>Dibuat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>
                            <strong>{{ $role->name }}</strong>
                        </td>
                        <td>{{ $role->guard_name }}</td>
                        <td>
                            <span class="badge bg-info">{{ $role->permissions->count() }} permissions</span>
                        </td>
                        <td>{{ $role->created_at->format('d M Y') }}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-info me-1">
                                <i class="fas fa-key"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Tidak ada roles</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $roles->links() }}
</x-app>
