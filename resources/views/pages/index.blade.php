@extends('layouts.app-with-sidebar')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Pages Management</h1>
    <x-can permission="manage posts">
        <a href="{{ route('pages.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create Page
        </a>
    </x-can>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">All Pages</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Template</th>
                        <th>Status</th>
                        <th>Sort Order</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pages as $page)
                        <tr>
                            <td>
                                <a href="{{ url($page->slug) }}" class="text-decoration-none">
                                    {{ $page->title }}
                                </a>
                            </td>
                            <td>
                                <code>{{ $page->slug }}</code>
                            </td>
                            <td>
                                @if($page->template)
                                    <span class="badge bg-info">{{ $page->template }}</span>
                                @else
                                    <span class="text-muted">default</span>
                                @endif
                            </td>
                            <td>
                                @if($page->is_published)
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-secondary">Draft</span>
                                @endif
                            </td>
                            <td>{{ $page->sort_order }}</td>
                            <td>{{ $page->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ url($page->slug) }}" class="btn btn-sm btn-outline-primary" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <x-can permission="manage posts">
                                    <a href="{{ route('pages.edit', $page) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('pages.destroy', $page) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('Are you sure you want to delete this page?')" 
                                                title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </x-can>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No pages found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
