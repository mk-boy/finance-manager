<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg">
            <div class="container">
                <a style="text-decoration: none;" class="text-success navbar-brand d-flex align-items-center fw-bold {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ url('/') }}">
                    <i class="fas fa-chart-line me-2 text-success"></i>
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center {{ request()->routeIs('payments*') ? 'active' : '' }}" href="{{ route('payments') }}">
                                    <i class="fas fa-credit-card me-1"></i>
                                    Счета
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center {{ request()->routeIs('categories*') ? 'active' : '' }}" href="{{ route('categories') }}">
                                    <i class="fas fa-tags me-1"></i>
                                    Категории
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center {{ request()->routeIs('transactions*') ? 'active' : '' }}" href="{{ route('transactions') }}">
                                    <i class="fas fa-exchange-alt me-1"></i>
                                    Транзакции
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center {{ request()->routeIs('profile*') ? 'active' : '' }}" href="{{ route('profile') }}">
                                    <i class="fas fa-user me-1"></i>
                                    Профиль
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center {{ request()->routeIs('reports.expense*') ? 'active' : '' }}" href="{{ route('reports.expense') }}">
                                    <i class="fas fa-money-bill-wave me-1"></i>
                                    Траты
                                </a>
                            </li>
                        @endauth
                    </ul>
                    
                    <ul class="navbar-nav">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item me-2">
                                    <a class="btn btn-outline-light" href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt me-1"></i>
                                        Войти
                                    </a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-outline-success" href="{{ route('register') }}">
                                        <i class="fas fa-user-plus me-1"></i>
                                        Регистрация
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-circle me-2"></i>
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center" href="{{ route('profile') }}">
                                            <i class="fas fa-user me-2"></i>
                                            Профиль
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt me-2"></i>
                                            Выйти
                                        </a>
                                    </li>
                                </ul>
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
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom Navigation Styles -->
    <style>
        .navbar-nav .nav-link:hover {
            color: #28a745 !important;
        }
        .navbar-nav .nav-link.active {
            color: #28a745 !important;
            font-weight: 600;
        }
        .navbar-brand:hover {
            color: #28a745 !important;
        }
        .navbar-brand.active {
            color: #28a745 !important;
        }
        .dropdown-item:hover {
            background-color: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }
        .navbar-nav .nav-link.active i {
            color: #28a745 !important;
        }
        .navbar-brand.active i {
            color: #28a745 !important;
        }
    </style>
</body>
</html>
