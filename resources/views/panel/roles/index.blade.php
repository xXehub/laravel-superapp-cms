<x-app title="Roles Management - Panel Admin" :use-sidebar="true">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <i class="fas fa-user-tag me-2"></i>Roles Management
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('dynamic', ['slug' => 'panel/roles/create']) }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add Role
            </a>
        </div>
    </div>

    <x-flash-messages />

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
                            <a href="{{ route('dynamic', ['slug' => 'panel/roles/edit']) }}?id={{ $role->id }}" 
                               class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" 
                                  action="{{ route('dynamic', ['slug' => 'panel/roles/delete']) }}" 
                                  class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this role?')">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $role->id }}">
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
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
