@extends('layouts.app-with-sidebar')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create Post</h1>
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Posts
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Post Information</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Excerpt</label>
                        <textarea class="form-control" id="excerpt" name="excerpt" rows="3" placeholder="Brief description of the post"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select" id="category" name="category">
                                    <option value="">Select Category</option>
                                    <option value="news">News</option>
                                    <option value="tutorial">Tutorial</option>
                                    <option value="review">Review</option>
                                    <option value="general">General</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tags" class="form-label">Tags</label>
                        <input type="text" class="form-control" id="tags" name="tags" placeholder="Enter tags separated by comma">
                        <small class="form-text text-muted">Example: laravel, php, tutorial</small>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-secondary me-md-2" onclick="window.history.back()">Cancel</button>
                        <button type="submit" class="btn btn-outline-primary me-md-2">Save as Draft</button>
                        <button type="submit" class="btn btn-primary">Publish Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Publishing Guidelines</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-check text-success"></i>
                        <small>Write a compelling title</small>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success"></i>
                        <small>Add a brief excerpt</small>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success"></i>
                        <small>Use proper formatting</small>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success"></i>
                        <small>Select appropriate category</small>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success"></i>
                        <small>Add relevant tags</small>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">Your Permissions</h5>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    @can('create posts')
                        <span class="badge bg-success">Create Posts</span>
                    @else
                        <span class="badge bg-secondary">Create Posts</span>
                    @endcan
                </div>
                <div class="mb-2">
                    @can('edit posts')
                        <span class="badge bg-success">Edit Posts</span>
                    @else
                        <span class="badge bg-secondary">Edit Posts</span>
                    @endcan
                </div>
                <div class="mb-2">
                    @can('delete posts')
                        <span class="badge bg-success">Delete Posts</span>
                    @else
                        <span class="badge bg-secondary">Delete Posts</span>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
