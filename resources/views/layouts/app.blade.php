<!doctype html>
<html lang="{{ str_replace('_', '-', session('locale')) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel')}} @yield('append_title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <style>
        .nav-link{
            color: #FFF!important;
        }
        .nav-link.active{
            color: #e4d46a!important;
        }
        .btn-outline-primary:hover{
            color: #FFF!important;
        }
    </style>
</head>
<body>
    <div id="app">
        @include('components.navbar')
        <main class="py-4" @yield('background')>
            <div class="container position-relative">
                @if(session('fail'))
                    <div class="container py-2 position-absolute top-0">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{__(session('fail'))}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                @if(session('success'))
                    <div class="container py-2 position-absolute top-0">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{__(session('success'))}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
            </div>
            @yield('content')
        </main>
        @include('components.footer')
    </div>
    @yield('script')
</body>
</html>
