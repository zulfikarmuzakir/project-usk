<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @stack('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm no-print">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            @if (Auth::user()->role_id == 1)
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}" class="nav-link">Users</a>
                            </li>
                            @endif
                            @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <li class="nav-item">
                                <a href="{{ route('topup.create') }}" class="nav-link">Topup</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('topup.request') }}" class="nav-link">Topup Request</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('topup.history') }}" class="nav-link">Topup History</a>
                            </li>
                            @endif
                            @if (Auth::user()->role_id == 3)
                            <li class="nav-item">
                                <a href="{{ route('canteen.items') }}" class="nav-link">Items</a> 
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('canteen.orders') }}" class="nav-link">Orders</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('canteen.history') }}" class="nav-link">Order History</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('canteen.wallet') }}" class="nav-link">Wallet</a>
                            </li>
                            @endif
                            @if (Auth::user()->role_id == 4)
                            <li class="nav-item">
                                <a href="{{ route('user.wallet') }}" class="nav-link">Wallet</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.shop') }}" class="nav-link">Shop</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.cart') }}" class="nav-link">Cart</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.history') }}" class="nav-link">Transaction History</a>
                            </li>
                            @endif
                        @endauth

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @stack('scripts')
</body>
</html>
