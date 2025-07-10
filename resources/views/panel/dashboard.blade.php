<x-app title="Panel Admin Dashboard" :use-sidebar="true">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <i class="fas fa-tachometer-alt me-2"></i>Panel Dashboard
        </h1>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['users'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pages</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pages'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Menu Items</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['menus'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bars fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Roles & Permissions</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['roles'] }}/{{ $stats['permissions'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-key fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Recent Users -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Users</h6>
                </div>
                <div class="card-body">
                    @forelse($recentUsers as $user)
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div>
                                <strong>{{ $user->name }}</strong><br>
                                <small class="text-muted">{{ $user->email }}</small>
                            </div>
                            <span class="badge bg-primary">{{ $user->roles->first()->name ?? 'No Role' }}</span>
                        </div>
                    @empty
                        <p class="text-muted">No users found.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Pages -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Pages</h6>
                </div>
                <div class="card-body">
                    @forelse($recentPages as $page)
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div>
                                <strong>{{ $page->title }}</strong><br>
                                <small class="text-muted">{{ $page->slug }}</small>
                            </div>
                            <span class="badge bg-{{ $page->status === 'published' ? 'success' : 'warning' }}">
                                {{ ucfirst($page->status) }}
                            </span>
                        </div>
                    @empty
                        <p class="text-muted">No pages found.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app>
