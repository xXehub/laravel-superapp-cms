<x-app title="Users Management - Panel Admin" :use-sidebar="true">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <i class="fas fa-users me-2"></i>Users Management
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('dynamic', ['slug' => 'panel/users/create']) }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add User
            </a>
        </div>
    </div>

    <x-flash-messages />

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Terdaftar</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach($user->roles as $role)
                                <span class="badge bg-primary me-1">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td>{{ $user->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('dynamic', ['slug' => 'panel/users/edit']) }}?id={{ $user->id }}" 
                               class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($user->id !== auth()->id())
                                <form method="POST" 
                                      action="{{ route('dynamic', ['slug' => 'panel/users/delete']) }}" 
                                      class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this user?')">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Tidak ada users</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $users->links() }}
</x-app>

