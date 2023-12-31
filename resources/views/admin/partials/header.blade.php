<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
   <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{ route('admin.index') }}"><img src="{{ Vite::asset('resources/images/logo.png') }}" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('admin.index') }}"><img src="{{ Vite::asset('resources/images/logo_mobile.png') }}" alt="logo"/></a>
   </div>
   <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    {{ Auth::user()->name }}
                    @if (Auth::user()->avatar)
                        <img src="{{ Vite::asset('public/storage/') . Auth::user()->avatar }}" alt="profile"/>
                    @else
                        <img src="{{ Vite::asset('resources/admin/images/faces/face28.jpg') }}" alt="profile"/>
                    @endif
                </a>
            </li>
            <li class="nav-item nav-profile">
                <a class="nav-link" href="{{ route('home') }}"  >
                    {{ __('admin.website') }}
                </a>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
   </div>
 </nav>
