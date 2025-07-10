<x-app title="Kelola Menus - Panel Admin" :is-admin="true" body-class="admin-panel" nav-class="bg-gradient-primary">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <i class="fas fa-bars me-2"></i>Kelola Menus
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Menu
            </button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Menu</th>
                    <th>Parent</th>
                    <th>Route</th>
                    <th>Icon</th>
                    <th>Urutan</th>
                    <th>Roles</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($menus as $menu)
                    <tr>
                        <td>{{ $menu->id }}</td>
                        <td>
                            @if($menu->parent_id)
                                <span class="text-muted ms-3">└─</span>
                            @endif
                            <strong>{{ $menu->nama_menu }}</strong>
                        </td>
                        <td>
                            @if($menu->parent)
                                <span class="badge bg-secondary">{{ $menu->parent->nama_menu }}</span>
                            @else
                                <span class="text-muted">Root</span>
                            @endif
                        </td>
                        <td>
                            @if($menu->route_name)
                                <code>{{ $menu->route_name }}</code>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($menu->icon)
                                <i class="{{ $menu->icon }}"></i>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $menu->urutan }}</td>
                        <td>
                            @foreach($menu->roles as $role)
                                <span class="badge bg-primary me-1">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-info me-1">
                                <i class="fas fa-users"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Tidak ada menus</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $menus->links() }}
</x-app>
