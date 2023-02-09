<nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <div class="fs-2 fw-bold" style="font-family: serif">
                {{ config('app.name', 'Laravel') }}
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      {{__('messages.language')}}
                    </a>

                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{str_replace(App::getLocale(), 'en', url(Request::path()))}}">EN</a></li>
                      <li><a class="dropdown-item" href="{{str_replace(App::getLocale(), 'id', url(Request::path()))}}">ID</a></li>
                    </ul>
                  </div>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if(Route::currentRouteName() === 'welcome')
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="btn btn-secondary px-4 me-3" href="{{ route('login') }}">{{ __('messages.login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="btn btn-secondary px-4" href="{{ route('register') }}">{{ __('messages.register') }}</a>
                            </li>
                        @endif
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link {{Route::currentRouteName() === 'home' ? "active" : ""}}" href="{{ route('home') }}">{{ __('messages.home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{Route::currentRouteName() === 'cart' ? "active" : ""}}" href="{{ route('cart') }}">{{ __('messages.cart') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{Route::currentRouteName() === 'profile' ? "active" : ""}}" href="{{ route('profile') }}">{{ __('messages.profile') }}</a>
                    </li>
                    @if (Auth::user()->role->role_name === 'Admin')
                        <li class="nav-item">
                            <a class="nav-link {{Route::currentRouteName() === 'account.maintenance' ? "active" : ""}}" href="{{ route('account.maintenance') }}">{{ __('messages.account_maintenance') }}</a>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->first_name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('messages.logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @if(file_exists(public_path().'\storage/'.Auth::user()->display_picture_link))
                        <img src="{{asset('storage/'.Auth::user()->display_picture_link)}}" alt="Profile Image" class="img-fluid rounded-circle" style="aspect-ratio: 1/1; width: 40px">
                    @else
                        <img src="{{Auth::user()->display_picture_link}}" alt="Profile Image" class="img-fluid rounded-circle" style="aspect-ratio: 1/1; width: 40px">
                    @endif
                @endguest
            </ul>
        </div>
    </div>
</nav>
