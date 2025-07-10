<x-app title="Edit Menu - Panel Admin" :use-sidebar="true">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Menu: {{ $menu->nama_menu }}</h1>
        <a href="{{ route('dynamic', ['slug' => 'panel/menus']) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Menus
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Menu Information</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dynamic', ['slug' => 'panel/menus/update']) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $menu->id }}">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nama_menu" class="form-label">Menu Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_menu') is-invalid @enderror" 
                                       id="nama_menu" name="nama_menu" value="{{ old('nama_menu', $menu->nama_menu) }}" required>
                                @error('nama_menu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                       id="slug" name="slug" value="{{ old('slug', $menu->slug) }}" required>
                                <small class="form-text text-muted">Example: panel/users</small>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="route_name" class="form-label">Route Name</label>
                                <input type="text" class="form-control @error('route_name') is-invalid @enderror" 
                                       id="route_name" name="route_name" value="{{ old('route_name', $menu->route_name) }}">
                                <small class="form-text text-muted">Optional. Example: users.index</small>
                                @error('route_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="icon" class="form-label">Icon</label>
                                <input type="text" class="form-control @error('icon') is-invalid @enderror" 
                                       id="icon" name="icon" value="{{ old('icon', $menu->icon) }}">
                                <small class="form-text text-muted">Font Awesome class. Example: fas fa-users</small>
                                @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="parent_id" class="form-label">Parent Menu</label>
                                <select class="form-select @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
                                    <option value="">-- Root Menu --</option>
                                    @foreach($parentMenus as $parentMenu)
                                        <option value="{{ $parentMenu->id }}" {{ old('parent_id', $menu->parent_id) == $parentMenu->id ? 'selected' : '' }}>
                                            {{ $parentMenu->nama_menu }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="urutan" class="form-label">Order <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('urutan') is-invalid @enderror" 
                                       id="urutan" name="urutan" value="{{ old('urutan', $menu->urutan) }}" required>
                                @error('urutan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                       {{ old('is_active', $menu->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Assign to Roles</label>
                            <div class="row">
                                @foreach($roles as $role)
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" 
                                                id="role_{{ $role->id }}" name="roles[]" value="{{ $role->id }}"
                                                {{ in_array($role->id, old('roles', $menu->roles->pluck('id')->toArray())) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="role_{{ $role->id }}">
                                                {{ ucfirst($role->name) }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Menu
                            </button>
                            <a href="{{ route('dynamic', ['slug' => 'panel/menus']) }}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app>
