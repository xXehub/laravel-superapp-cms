@extends('components.app', ['title' => $menu->nama_menu, 'useSidebar' => false])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    @if($menu->icon)
                        <i class="{{ $menu->icon }} me-2"></i>
                    @endif
                    <h4 class="mb-0">{{ $menu->nama_menu }}</h4>
                </div>
                <div class="card-body">
                    <div class="text-center py-5">
                        <i class="fas fa-construction fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Page Under Construction</h5>
                        <p class="text-muted">
                            This is a dynamic page for the "{{ $menu->nama_menu }}" menu. 
                            Content can be added by creating a corresponding page in the admin panel 
                            with the slug: <code>{{ $menu->slug }}</code>
                        </p>
                        
                        @auth
                            @role('admin')
                                <div class="mt-4">
                                    <a href="{{ url('/panel/pages') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-1"></i>Add Content
                                    </a>
                                </div>
                            @endrole
                        @endauth
                    </div>

                    <!-- Breadcrumb -->
                    @if($menu->getBreadcrumbs()->count() > 1)
                        <nav aria-label="breadcrumb" class="mt-4">
                            <ol class="breadcrumb">
                                @foreach($menu->getBreadcrumbs() as $breadcrumb)
                                    @if($loop->last)
                                        <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb->nama_menu }}</li>
                                    @else
                                        <li class="breadcrumb-item">
                                            <a href="{{ $breadcrumb->getUrl() }}">{{ $breadcrumb->nama_menu }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ol>
                        </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
