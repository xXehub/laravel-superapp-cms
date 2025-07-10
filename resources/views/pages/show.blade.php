<x-app>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $page->title }}</h1>
        <x-can permission="manage posts">
            <a href="{{ route('pages.edit', $page) }}" class="btn btn-outline-primary">
                <i class="fas fa-edit"></i> Edit Page
            </a>
        </x-can>
    </div>

    @if ($page->meta_title || $page->meta_description)
        <div class="alert alert-info mb-4">
            @if ($page->meta_title)
                <strong>SEO Title:</strong> {{ $page->meta_title }}<br>
            @endif
            @if ($page->meta_description)
                <strong>Meta Description:</strong> {{ $page->meta_description }}
            @endif
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="content">
                {!! nl2br(e($page->content)) !!}
            </div>
        </div>

        @if ($page->template)
            <div class="card-footer text-muted">
                <small><i class="fas fa-palette"></i> Using template: {{ $page->template }}</small>
            </div>
        @endif
    </div>

    <div class="mt-4">
        <small class="text-muted">
            <i class="fas fa-calendar"></i> Created: {{ $page->created_at->format('F d, Y') }}
            @if ($page->updated_at->ne($page->created_at))
                | Updated: {{ $page->updated_at->format('F d, Y') }}
            @endif
        </small>
    </div>
</x-app>
