@php use Illuminate\Support\Facades\Auth; @endphp
@php
    $user_role = auth()->user()->role;
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Script for Iconsax -->
    <script src="https://grxvityhj.github.io/iconsax/script.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Akshar&family=Bitter&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Akshar&family=Bitter&family=Roboto:wght@300&display=swap"
        rel="stylesheet">

    <link rel="icon" href="{{ asset('logo.svg') }}">

    <style>
        #dropdownToggle:hover {
            cursor: pointer;
        }

        #dropdownToggle {
            rotate: 90deg;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        #dropdownList {
            display: none;
        }

        .menu-item:hover {
            background-color: #CFE2FF;
            color: #CFE2FF;
        }

        .dropdown-toggle::after {
            margin-left: 6em;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="bg-white" @style(['overflow-y-hidden'])>
    <div class="app" style="max-height: 100vh">
        @include('layouts.sidebar', ['user_role' => $user_role])

        <main class="overflow-y-auto" style="height: 100vh">
            <nav class="navbar px-0 navbar-expand-lg navbar-light border-bottom">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto align-items-center">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link">{{ __('Login') }}</a>
                                    </li>
                                @endif
                            @else
                                <a href="{{ url('profile/' . auth()->user()->id) }}"
                                    class="text-dark link-underline link-underline-opacity-0">
                                    <li class="nav-item mx-4 d-flex align-items-center">
                                        <p class="m-0">Hello, {{ auth()->user()->username }}</p>
                                        <h1 class="m-auto mx-2"><i class="bi bi-person-circle"></i></h1>
                                        <div>
                                            <p class="text-capitalize m-0 text-secondary"></p>
                                        </div>
                                    </li>
                                </a>

                                <li class="nav-item">
                                    <a class="btn logout btn-danger" href="{{ route('logout') }}"><i class="iconsax"
                                            type="linear" stroke-width="1.5"
                                            icon="logout-1"></i>{{ __('Logout') }}</a>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container p-4 px-sm-2 px-3 w-100 mx-auto ">
                @include('layouts.flash-message')
                @yield('content')
            </div>
        </main>
    </div>

    @yield('footer')
    <script type="module">
        $("#dropdownToggle").click(function() {
            if ($("#dropdownList").first().is(":hidden")) {
                $("#dropdownList").slideDown("slow");
                $(this).css('rotate', '-90deg')
            } else {
                $("#dropdownList").slideUp();
                $(this).css('rotate', '90deg')
            }
        })
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 3000);
    </script>
</body>

</html>
