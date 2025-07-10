<x-app title="Edit Permission" :use-sidebar="true">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Permission: {{ $permission->name }}</h1>
        <a href="{{ route('dynamic', ['slug' => 'panel/permissions']) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Permissions
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Permission Information</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dynamic', ['slug' => 'panel/permissions/update']) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $permission->id }}">

                        <div class="mb-3">
                            <label for="name" class="form-label">Permission Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $permission->name) }}" required
                                   placeholder="e.g., create-users, edit-posts, view-reports">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                Use lowercase letters, numbers, and hyphens only. Examples: create-users, manage-pages, view-dashboard
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Permission
                            </button>
                            <a href="{{ route('dynamic', ['slug' => 'panel/permissions']) }}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app>
