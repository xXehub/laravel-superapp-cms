<x-app title="Settings - Panel Admin" :use-sidebar="true">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <i class="fas fa-cog me-2"></i>Settings Management
        </h1>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Application Settings</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('dynamic', ['slug' => 'panel/settings']) }}">
                        @csrf
                        
                        <!-- Welcome Page Settings -->
                        <h6 class="border-bottom pb-2 mb-3">Welcome Page Settings</h6>
                        
                        <div class="mb-3">
                            <label for="welcome_title" class="form-label">Welcome Title</label>
                            <input type="text" class="form-control" name="settings[welcome_title]" 
                                   value="{{ $settings['welcome_title']->value ?? 'Laravel Superapp CMS' }}">
                        </div>
                        
                        <div class="mb-3">
                            <label for="welcome_subtitle" class="form-label">Welcome Subtitle</label>
                            <textarea class="form-control" name="settings[welcome_subtitle]" rows="2">{{ $settings['welcome_subtitle']->value ?? 'A powerful content management system built with Laravel 12.' }}</textarea>
                        </div>

                        <!-- Feature Settings -->
                        <h6 class="border-bottom pb-2 mb-3 mt-4">Feature Settings</h6>
                        
                        @php
                            $features = [
                                1 => ['title' => 'Feature 1', 'default_title' => 'Role-Based Access', 'default_icon' => 'fas fa-shield-alt'],
                                2 => ['title' => 'Feature 2', 'default_title' => 'Dynamic Menus', 'default_icon' => 'fas fa-bars'],
                                3 => ['title' => 'Feature 3', 'default_title' => 'Dynamic Pages', 'default_icon' => 'fas fa-file-alt'],
                                4 => ['title' => 'Feature 4', 'default_title' => 'Clean Code', 'default_icon' => 'fas fa-code']
                            ];
                        @endphp

                        @foreach($features as $num => $feature)
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">{{ $feature['title'] }} Title</label>
                                    <input type="text" class="form-control" name="settings[feature_{{ $num }}_title]" 
                                           value="{{ $settings['feature_' . $num . '_title']->value ?? $feature['default_title'] }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ $feature['title'] }} Icon</label>
                                    <input type="text" class="form-control" name="settings[feature_{{ $num }}_icon]" 
                                           value="{{ $settings['feature_' . $num . '_icon']->value ?? $feature['default_icon'] }}"
                                           placeholder="e.g., fas fa-shield-alt">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ $feature['title'] }} Description</label>
                                <textarea class="form-control" name="settings[feature_{{ $num }}_description]" rows="2">{{ $settings['feature_' . $num . '_description']->value ?? '' }}</textarea>
                            </div>
                        @endforeach

                        <!-- General Site Settings -->
                        <h6 class="border-bottom pb-2 mb-3 mt-4">General Site Settings</h6>
                        
                        <div class="mb-3">
                            <label for="site_title" class="form-label">Site Title</label>
                            <input type="text" class="form-control" name="settings[site_title]" 
                                   value="{{ $settings['site_title']->value ?? config('app.name') }}">
                        </div>
                        
                        <div class="mb-3">
                            <label for="site_description" class="form-label">Site Description</label>
                            <textarea class="form-control" name="settings[site_description]" rows="2">{{ $settings['site_description']->value ?? 'Laravel-based Content Management System' }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="sample_pages_title" class="form-label">Sample Pages Section Title</label>
                            <input type="text" class="form-control" name="settings[sample_pages_title]" 
                                   value="{{ $settings['sample_pages_title']->value ?? 'Explore Sample Pages' }}">
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Settings
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Sistem</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td><strong>Laravel Version</strong></td>
                            <td>{{ app()->version() }}</td>
                        </tr>
                        <tr>
                            <td><strong>PHP Version</strong></td>
                            <td>{{ PHP_VERSION }}</td>
                        </tr>
                        <tr>
                            <td><strong>Environment</strong></td>
                            <td>
                                <span class="badge bg-{{ app()->environment() === 'production' ? 'success' : 'warning' }}">
                                    {{ ucfirst(app()->environment()) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Debug Mode</strong></td>
                            <td>
                                <span class="badge bg-{{ config('app.debug') ? 'danger' : 'success' }}">
                                    {{ config('app.debug') ? 'Enabled' : 'Disabled' }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">Cache Management</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-warning btn-sm">
                            <i class="fas fa-broom me-2"></i>Clear All Cache
                        </button>
                        <button class="btn btn-outline-info btn-sm">
                            <i class="fas fa-sync me-2"></i>Reload Configuration
                        </button>
                        <button class="btn btn-outline-success btn-sm">
                            <i class="fas fa-database me-2"></i>Optimize Database
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
