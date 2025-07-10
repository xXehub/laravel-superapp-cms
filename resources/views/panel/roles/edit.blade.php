<x-app title="Edit Role" :use-sidebar="true">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Role: {{ $role->name }}</h1>
        <a href="{{ route('dynamic', ['slug' => 'panel/roles']) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Roles
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Role Information</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dynamic', ['slug' => 'panel/roles/update']) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $role->id }}">

                        <div class="mb-3">
                            <label for="name" class="form-label">Role Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $role->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Permissions</label>
                            <div class="row">
                                @foreach($permissions as $permission)
                                    <div class="col-md-6 col-lg-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" 
                                                   id="permission_{{ $permission->id }}" name="permissions[]" value="{{ $permission->name }}"
                                                   {{ in_array($permission->name, old('permissions', $role->permissions->pluck('name')->toArray())) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                {{ ucfirst(str_replace('-', ' ', $permission->name)) }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Role
                            </button>
                            <a href="{{ route('dynamic', ['slug' => 'panel/roles']) }}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app>
