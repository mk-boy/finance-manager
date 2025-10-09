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
    
    <style>
        body {
            background: linear-gradient(135deg, #0f0f0f 0%, #1a1a1a 100%);
            min-height: 100vh;
            color: #ffffff;
        }
        
        .navbar-dark {
            background: rgba(26, 26, 26, 0.95) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #404040;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #6366f1 !important;
        }
        
        .nav-link {
            font-weight: 500;
            color: #e5e5e5 !important;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            color: #6366f1 !important;
            transform: translateY(-1px);
        }
        
        .dropdown-menu {
            background-color: #1a1a1a;
            border: 1px solid #404040;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
        }
        
        .dropdown-item {
            color: #e5e5e5;
            transition: all 0.3s ease;
        }
        
        .dropdown-item:hover {
            background-color: #262626;
            color: #6366f1;
        }
        
        main {
            background: transparent;
        }
        
        /* Improved text readability */
        h1, h2, h3, h4, h5, h6 {
            color: #ffffff;
            font-weight: 600;
        }
        
        p, span, div {
            color: #e5e5e5;
        }
        
        .text-muted {
            color: #a3a3a3 !important;
        }
        
        .text-light {
            color: #e5e5e5 !important;
        }
        
        /* Bootstrap Alert Dark Theme */
        .alert-success {
            background-color: rgba(34, 197, 94, 0.1);
            border-color: #22c55e;
            color: #22c55e;
        }
        
        .alert-danger {
            background-color: rgba(239, 68, 68, 0.1);
            border-color: #ef4444;
            color: #ef4444;
        }
        
        .alert-warning {
            background-color: rgba(245, 158, 11, 0.1);
            border-color: #f59e0b;
            color: #f59e0b;
        }
        
        .alert-info {
            background-color: rgba(59, 130, 246, 0.1);
            border-color: #3b82f6;
            color: #3b82f6;
        }
        
        .btn-close {
            filter: invert(1);
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center fw-bold" href="{{ url('/') }}">
                    <i class="fas fa-chart-line me-2 text-primary"></i>
                    FinanceManager
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center" href="{{ route('payments') }}">
                                    <i class="fas fa-credit-card me-1"></i>
                                    Счета
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center" href="{{ route('profile') }}">
                                    <i class="fas fa-user me-1"></i>
                                    Профиль
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
                                    <a class="btn btn-primary" href="{{ route('register') }}">
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
</body>
</html>
