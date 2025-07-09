@extends('layouts.app-with-sidebar')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">All Posts</h1>
    @can('create posts')
        <a href="{{ route('posts.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create Post
        </a>
    @endcan
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Posts Management</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Sample posts -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Sample Post 1</h5>
                        <p class="card-text">This is a sample post content. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p class="card-text"><small class="text-muted">Created 2 days ago</small></p>
                    </div>
                    <div class="card-footer">
                        @can('edit posts')
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        @endcan
                        @can('delete posts')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        @endcan
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Sample Post 2</h5>
                        <p class="card-text">Another sample post with different content. Sed do eiusmod tempor incididunt ut labore.</p>
                        <p class="card-text"><small class="text-muted">Created 1 week ago</small></p>
                    </div>
                    <div class="card-footer">
                        @can('edit posts')
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        @endcan
                        @can('delete posts')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        @endcan
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Sample Post 3</h5>
                        <p class="card-text">Yet another sample post. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
                        <p class="card-text"><small class="text-muted">Created 2 weeks ago</small></p>
                    </div>
                    <div class="card-footer">
                        @can('edit posts')
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        @endcan
                        @can('delete posts')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        
        @cannot('manage posts')
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i>
            You have view-only access to posts. Contact your administrator to request edit permissions.
        </div>
        @endcannot
    </div>
</div>
@endsection
