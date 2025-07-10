<x-app title="Kelola Permissions - Panel Admin" :is-admin="true" body-class="admin-panel" nav-class="bg-gradient-primary">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <i class="fas fa-key me-2"></i>Kelola Permissions
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Permission
            </button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Permission</th>
                    <th>Guard</th>
                    <th>Dibuat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>
                            <strong>{{ $permission->name }}</strong>
                        </td>
                        <td>{{ $permission->guard_name }}</td>
                        <td>{{ $permission->created_at->format('d M Y') }}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Tidak ada permissions</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $permissions->links() }}
</x-app>
