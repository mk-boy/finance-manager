@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <!-- Login Header -->
            <div class="card bg-dark border-secondary mb-4">
                <div class="card-body text-center">
                    <i class="fas fa-sign-in-alt text-primary fs-1 mb-3"></i>
                    <h1 class="text-white mb-2">Вход в систему</h1>
                    <p class="text-light mb-0">Добро пожаловать обратно!</p>
                </div>
            </div>

            <!-- Login Form -->
            <div class="card bg-dark border-secondary mb-4">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label text-white">
                                <i class="fas fa-envelope me-2"></i>
                                Email адрес
                            </label>
                            <input 
                                id="email" 
                                type="email" 
                                class="form-control border-secondary text-white @error('email') is-invalid @enderror" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                autocomplete="email" 
                                autofocus
                                placeholder="Введите ваш email"
                            >
                            @error('email')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label text-white">
                                <i class="fas fa-lock me-2"></i>
                                Пароль
                            </label>
                            <div class="input-group">
                                <input 
                                    id="password" 
                                    type="password" 
                                    class="form-control border-secondary text-white @error('password') is-invalid @enderror" 
                                    name="password" 
                                    required 
                                    autocomplete="current-password"
                                    placeholder="Введите ваш пароль"
                                >
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                                    <i class="fas fa-eye" id="passwordToggleIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-light" for="remember">
                                    Запомнить меня
                                </label>
                            </div>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                Войти
                            </button>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="text-center">
                                <a href="{{ route('password.request') }}" class="text-decoration-none">
                                    <i class="fas fa-key me-1"></i>
                                    Забыли пароль?
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Register Link -->
            <div class="text-center">
                <p class="text-light">
                    Нет аккаунта? 
                    <a href="{{ route('register') }}" class="text-decoration-none fw-bold">
                        Зарегистрироваться
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('passwordToggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>
@endsection
