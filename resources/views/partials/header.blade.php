<header>
    @if(Route::is('home') || Route::is('search.title') || Route::is('search.category'))
        <div class="background-image">
            <img src="{{ Vite::asset('resources/images/img_banner.png') }}" alt="banner"/>
        </div>
    @endif
    <div class="nav">
        <div class="container">
            <div class="row">
                <div class="mobile">
                    <div class="bar-mobile">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="35"
                            height="37"
                            viewBox="0 0 35 37"
                            fill="none"
                        >
                            <path
                                d="M4.375 10.7917H30.625"
                                stroke="#292D32"
                                stroke-width="1.5"
                                stroke-linecap="round"
                            />
                            <path
                                d="M4.375 18.5H30.625"
                                stroke="#292D32"
                                stroke-width="1.5"
                                stroke-linecap="round"
                            />
                            <path
                                d="M4.375 26.2083H30.625"
                                stroke="#292D32"
                                stroke-width="1.5"
                                stroke-linecap="round"
                            />
                        </svg>
                    </div>
                    <div class="logo-mobile">
                        <a href="{{ route("home") }}" class="logo">
                            <img src="{{ Vite::asset('resources/images/logo_mobile.png') }}" alt/>
                        </a>
                    </div>
                    <div class="search-mobile">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="19"
                            height="19"
                            viewBox="0 0 19 19"
                            fill="none"
                        >
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M9.13098 0C14.1659 0 18.2613 4.00508 18.2613 8.9289C18.2613 11.2519 17.3497 13.3707 15.8579 14.9608L18.7933 17.8254C19.068 18.0941 19.0689 18.5287 18.7942 18.7974C18.6573 18.9331 18.4763 19 18.2963 19C18.1172 19 17.9372 18.9331 17.7994 18.7992L14.8286 15.902C13.2658 17.126 11.2843 17.8587 9.13098 17.8587C4.0961 17.8587 -0.000244141 13.8527 -0.000244141 8.9289C-0.000244141 4.00508 4.0961 0 9.13098 0ZM9.13098 1.37537C4.87149 1.37537 1.40615 4.76336 1.40615 8.9289C1.40615 13.0944 4.87149 16.4833 9.13098 16.4833C13.3895 16.4833 16.8549 13.0944 16.8549 8.9289C16.8549 4.76336 13.3895 1.37537 9.13098 1.37537Z"
                                fill="#A7A7A7"
                            />
                        </svg>
                    </div>
                </div>

                <div class="header-right">
                    <a href="{{ route("home") }}" class="logo">
                        <img src="{{ Vite::asset('resources/images/logo.png') }}" alt/>
                    </a>
                    <div class="form-search">
                        <form action={{ route('search.title') }} method="GET">
                            <input type="text" placeholder="Search blog" class="news-search" name="title" value="{{ request()->title }}"/>
                            <button>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="19"
                                    height="19"
                                    viewBox="0 0 19 19"
                                    fill="none"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M9.13101 0C14.1659 0 18.2613 4.00508 18.2613 8.9289C18.2613 11.2519 17.3497 13.3707 15.8579 14.9608L18.7933 17.8254C19.068 18.0941 19.0689 18.5287 18.7942 18.7974C18.6573 18.9331 18.4764 19 18.2964 19C18.1173 19 17.9373 18.9331 17.7994 18.7992L14.8286 15.902C13.2659 17.126 11.2844 17.8587 9.13101 17.8587C4.09613 17.8587 -0.000213623 13.8527 -0.000213623 8.9289C-0.000213623 4.00508 4.09613 0 9.13101 0ZM9.13101 1.37537C4.87152 1.37537 1.40618 4.76336 1.40618 8.9289C1.40618 13.0944 4.87152 16.4833 9.13101 16.4833C13.3896 16.4833 16.8549 13.0944 16.8549 8.9289C16.8549 4.76336 13.3896 1.37537 9.13101 1.37537Z"
                                        fill="#A7A7A7"
                                    />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="header-left">
                    <a @if(Route::is('home')) class="home-top active" @else href="{{ route('home') }}" class="home-top" @endif>Top</a>
                    @if(Auth::check())
                        <a @if(Route::is('post.create')) class="active" @else href="{{ route('post.create') }}" @endif>{{ __('message.create_blog') }}</a>
                        <div class="login">
                            <a id="showMenuProfile"><span>{{ Auth::user()->name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                    <path
                                        d="M406.5 399.6C387.4 352.9 341.5 320 288 320H224c-53.5 0-99.4 32.9-118.5 79.6C69.9 362.2 48 311.7 48 256C48 141.1 141.1 48 256 48s208 93.1 208 208c0 55.7-21.9 106.2-57.5 143.6zm-40.1 32.7C334.4 452.4 296.6 464 256 464s-78.4-11.6-110.5-31.7c7.3-36.7 39.7-64.3 78.5-64.3h64c38.8 0 71.2 27.6 78.5 64.3zM256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-272a40 40 0 1 1 0-80 40 40 0 1 1 0 80zm-88-40a88 88 0 1 0 176 0 88 88 0 1 0 -176 0z"
                                    />
                                </svg>
                            </a>
                            <div class="menu-profile">
                                <ul class="menu-profile-list">
                                    <li class="menu-profile-item">
                                        <a class="menu-profile-item-link">
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button class="menu-profile-item-link">{{ __('message.logout') }}</button>
                                            </form>
                                        </a>
                                    </li>
                                    @if (Auth::user()->role === \App\Models\User::ROLE_ADMIN)
                                        <li class="menu-profile-item">
                                            <a href class="menu-profile-item-link">{{ __('message.admin') }}</a>
                                        </li>
                                    @else
                                        <li class="menu-profile-item">
                                            <a href="#" class="menu-profile-item-link">{{ __('message.my_blogs') }}</a>
                                        </li>
                                        <li class="menu-profile-item">
                                            <a href class="menu-profile-item-link">{{ __('message.profile') }}</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="left-login">{{ __('message.login') }}</a>
                        <a href="{{ route('register') }}" class="left-sign-up">{{ __('message.sign_up') }}</a>
                    @endif
                </div>
                <div class="background-mobile"></div>
            </div>
        </div>
    </div>
</header>
