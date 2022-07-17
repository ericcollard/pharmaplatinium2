<!-- Topbar Start -->
<div class="navbar-custom">
    <ul class="list-unstyled topbar-menu float-end mb-0">
        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{asset('assets/images/flags/'.session('locale').'.jpg')}}" alt="user-image" class="me-0 me-sm-1" height="12">
                <span class="align-middle d-none d-sm-inline-block">
                    @if (session('locale') and array_key_exists(3,session('locale')))
                    {{ config('locale.languages')[session('locale')][3] }}
                    @endif
                </span> <i class="mdi mdi-chevron-down d-none d-sm-inline-block align-middle"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu">

                @foreach(config('app.locales') as $locale)
                    @if($locale != session('locale'))

                        <!-- item-->
                            <a  href="{{ route('language', $locale) }}" class="dropdown-item notify-item">
                                <img src="{{asset('assets/images/flags/'.$locale.'.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">{{ config('locale.languages')[$locale][3] }}</span>
                            </a>

                    @endif
                @endforeach

            </div>
        </li>


        <li class="notification-list">
            <a class="nav-link end-bar-toggle" href="javascript: void(0);">
                <i class="dripicons-gear noti-icon"></i>
            </a>
        </li>

        <!-- user block-->
        <li class="dropdown notification-list">
            @guest
                <span class="nav-link  nav-user  me-0">
                    <span>
                        <span class="account-user-name">{{ __('Not connected') }}</span>
                        <span class="account-position">
                            <a href="{{ route('login') }}">{{ __('Login') }}</a>
                            -
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </span>
                    </span>
                </span>
            @else
                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="account-user-avatar">
                        <img src="{{ Auth::user()->avatarUrl() }}" alt="user-image" class="rounded-circle" />
                    </span>
                    <span>
                        <span class="account-user-name">{{ Auth::user()->name }}</span>
                        <span class="account-position">{{ Auth::user()->email }}</span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                    <!-- item-->
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __("Welcome") }} !</h6>
                    </div>

                    <!-- item-->
                    <a href="{{ route('user.show' , ['user' => Auth::user()->id]) }}" class="dropdown-item notify-item">
                        <i class="mdi mdi-account-circle me-1"></i>
                        <span>{{ __("My Profile") }}</span>
                    </a>

                    <!-- item-->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="javascript:void(0);" class="dropdown-item notify-item" onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                            <i class="mdi mdi-logout me-1"></i>
                            <span>{{ __("Logout") }}</span>
                        </a>
                    </form>
                </div>
            @endguest
        </li>

    </ul>
    <button class="button-menu-mobile open-left">
        <i class="mdi mdi-menu"></i>
    </button>
</div>
<!-- end Topbar -->
