@props(['menus'])

@forelse($menus as $menu)
    <x-sidebar-menu-item :menu="$menu" />
@empty
    <li class="nav-item">
        <span class="nav-link text-muted">No menus available</span>
    </li>
@endforelse
