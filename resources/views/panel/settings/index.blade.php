<x-app title="Settings - Panel Admin" :is-admin="true" body-class="admin-panel" nav-class="bg-gradient-primary">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <i class="fas fa-cog me-2"></i>Settings
        </h1>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Pengaturan Aplikasi</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="app_name" class="form-label">Nama Aplikasi</label>
                            <input type="text" class="form-control" id="app_name" value="{{ config('app.name') }}">
                        </div>
                        
                        <div class="mb-3">
                            <label for="app_url" class="form-label">URL Aplikasi</label>
                            <input type="url" class="form-control" id="app_url" value="{{ config('app.url') }}">
                        </div>

                        <div class="mb-3">
                            <label for="timezone" class="form-label">Timezone</label>
                            <select class="form-control" id="timezone">
                                <option value="UTC">UTC</option>
                                <option value="Asia/Jakarta" selected>Asia/Jakarta</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="maintenance_mode">
                                <label class="form-check-label" for="maintenance_mode">
                                    Mode Maintenance
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Pengaturan
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
