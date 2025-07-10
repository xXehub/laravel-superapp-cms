@props(['menu'])

@php
    // Generate URL based on menu configuration
    try {
        $menuUrl = $menu->getUrl();
    } catch (\Exception $e) {
        $menuUrl = '#'; // Fallback if URL generation fails
    }
    
    // Check if current URL matches this menu
    $currentUrl = url()->current();
    $currentPath = request()->path();
    $isActive = ($currentUrl === $menuUrl) || ($menu->slug && $currentPath === $menu->slug);
@endphp

@if($menu->children->count() > 0)
    <!-- Menu with submenu -->
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center" data-bs-toggle="collapse"
            href="#submenu-{{ $menu->id }}" role="button"
            aria-expanded="false" aria-controls="submenu-{{ $menu->id }}">
            <x-menu-icon :icon="$menu->icon" />
            {{ $menu->nama_menu }}
            <i class="fas fa-chevron-down ms-auto"></i>
        </a>
        <div class="collapse" id="submenu-{{ $menu->id }}">
            <ul class="nav flex-column ms-3">
                @foreach($menu->children as $child)
                    @if($child->isAccessible())
                        <li class="nav-item">
                            @php
                                try {
                                    $childUrl = $child->getUrl();
                                } catch (\Exception $e) {
                                    $childUrl = '#';
                                }
                                $isChildActive = (url()->current() === $childUrl) || ($child->slug && request()->path() === $child->slug);
                            @endphp
                            <a class="nav-link d-flex align-items-center {{ $isChildActive ? 'active' : '' }}"
                                href="{{ $childUrl }}">
                                <x-menu-icon :icon="$child->icon" />
                                {{ $child->nama_menu }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </li>
@else
    <!-- Single menu item -->
    @if($menu->isAccessible())
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center {{ $isActive ? 'active' : '' }}"
                href="{{ $menuUrl }}">
                <x-menu-icon :icon="$menu->icon" />
                {{ $menu->nama_menu }}
            </a>
        </li>
    @endif
@endif
