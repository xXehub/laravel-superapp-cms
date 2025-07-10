<x-app title="Menus Management - Panel Admin" :use-sidebar="true">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <i class="fas fa-bars me-2"></i>Menus Management
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('dynamic', ['slug' => 'panel/menus/create']) }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add Menu
            </a>
        </div>
    </div>

    <x-flash-messages />

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Menu</th>
                    <th>Slug</th>
                    <th>Parent</th>
                    <th>Route</th>
                    <th>Icon</th>
                    <th>Urutan</th>
                    <th>Status</th>
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
                        <td><code>{{ $menu->slug }}</code></td>
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
                            @if($menu->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            @foreach($menu->roles as $role)
                                <span class="badge bg-primary me-1">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('dynamic', ['slug' => 'panel/menus/edit/' . $menu->id]) }}" class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('dynamic', ['slug' => 'panel/menus/delete']) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $menu->id }}">
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this menu?');">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted">No menus found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $menus->links() }}
</x-app>
