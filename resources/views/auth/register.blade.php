@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <!-- Register Header -->
            <div class="card bg-dark border-secondary mb-4">
                <div class="card-body text-center">
                    <i class="fas fa-user-plus text-primary fs-1 mb-3"></i>
                    <h1 class="text-white mb-2">Регистрация</h1>
                    <p class="text-light mb-0">Создайте новый аккаунт</p>
                </div>
            </div>

            <!-- Register Form -->
            <div class="card bg-dark border-secondary mb-4">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label text-white">
                                <i class="fas fa-user me-2"></i>
                                Имя пользователя
                            </label>
                            <input 
                                id="name" 
                                type="text" 
                                class="form-control bg-secondary border-secondary text-white @error('name') is-invalid @enderror" 
                                name="name" 
                                value="{{ old('name') }}" 
                                required 
                                autocomplete="name" 
                                autofocus
                                placeholder="Введите ваше имя"
                            >
                            @error('name')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label text-white">
                                <i class="fas fa-envelope me-2"></i>
                                Email адрес
                            </label>
                            <input 
                                id="email" 
                                type="email" 
                                class="form-control bg-secondary border-secondary text-white @error('email') is-invalid @enderror" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                autocomplete="email"
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
                                    class="form-control bg-secondary border-secondary text-white @error('password') is-invalid @enderror" 
                                    name="password" 
                                    required 
                                    autocomplete="new-password"
                                    placeholder="Введите пароль"
                                >
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">
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

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label text-white">
                                <i class="fas fa-lock me-2"></i>
                                Подтверждение пароля
                            </label>
                            <div class="input-group">
                                <input 
                                    id="password-confirm" 
                                    type="password" 
                                    class="form-control bg-secondary border-secondary text-white" 
                                    name="password_confirmation" 
                                    required 
                                    autocomplete="new-password"
                                    placeholder="Подтвердите пароль"
                                >
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password-confirm')">
                                    <i class="fas fa-eye" id="passwordConfirmToggleIcon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                                <label class="form-check-label text-light" for="terms">
                                    Я согласен с 
                                    <a href="#" class="text-decoration-none">условиями использования</a>
                                </label>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-user-plus me-2"></i>
                                Зарегистрироваться
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Login Link -->
            <div class="text-center">
                <p class="text-light">
                    Уже есть аккаунт? 
                    <a href="{{ route('login') }}" class="text-decoration-none fw-bold">
                        Войти
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(fieldId) {
        const passwordInput = document.getElementById(fieldId);
        const toggleIcon = document.getElementById(fieldId + 'ToggleIcon');
        
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
