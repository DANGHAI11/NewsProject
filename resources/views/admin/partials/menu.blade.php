<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item @if(Route::is('admin.index')) active @endif">
            <a class="nav-link" href="{{ route('admin.index') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">{{ __('admin.dashboard') }}</span>
            </a>
        </li>
        <li class="nav-item @if(Route::is('admin.post.index')) active @endif">
            <a class="nav-link" href="{{ route('admin.post.index') }}">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">{{ __('admin.post_page') }} </span>
            </a>
        </li>
        <li class="nav-item @if(Route::is('admin.user.index')) active @endif">
            <a class="nav-link" href="{{ route('admin.user.index') }}">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">{{ __('admin.user_page') }}</span>
            </a>
        </li>
        <li class="nav-item @if(Route::is('admin.category.index')) active @endif">
            <a class="nav-link" href="{{ route('admin.category.index') }}">
                <i class="fa-solid fa-list icon-head menu-icon"></i>
                <span class="menu-title">{{ __('admin.category_page') }}</span>
            </a>
        </li>
    </ul>
</nav>
