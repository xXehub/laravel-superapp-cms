<x-app title="Kelola Pages - Panel Admin" :is-admin="true" body-class="admin-panel" nav-class="bg-gradient-primary">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <i class="fas fa-file-alt me-2"></i>Kelola Pages
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Page
            </button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Template</th>
                    <th>Dibuat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pages as $page)
                    <tr>
                        <td>{{ $page->id }}</td>
                        <td>
                            <strong>{{ $page->title }}</strong>
                        </td>
                        <td>
                            <code>{{ $page->slug }}</code>
                        </td>
                        <td>
                            <span class="badge bg-{{ $page->status === 'published' ? 'success' : 'warning' }}">
                                {{ ucfirst($page->status) }}
                            </span>
                        </td>
                        <td>{{ $page->template ?? 'default' }}</td>
                        <td>{{ $page->created_at->format('d M Y') }}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-info me-1">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Tidak ada pages</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $pages->links() }}
</x-app>
