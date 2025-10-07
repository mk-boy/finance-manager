@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <!-- Register Header -->
            <div class="auth-header mb-4">
                <div class="auth-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h1 class="auth-title">Регистрация</h1>
                <p class="auth-subtitle">Создайте новый аккаунт</p>
            </div>

            <!-- Register Form -->
            <div class="auth-form-card">
                <form method="POST" action="{{ route('register') }}" class="auth-form">
                    @csrf

                    <div class="form-group mb-4">
                        <label for="name" class="form-label">
                            <i class="fas fa-user me-2"></i>
                            Имя пользователя
                        </label>
                        <input 
                            id="name" 
                            type="text" 
                            class="form-control @error('name') is-invalid @enderror" 
                            name="name" 
                            value="{{ old('name') }}" 
                            required 
                            autocomplete="name" 
                            autofocus
                            placeholder="Введите ваше имя"
                        >
                        @error('name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-2"></i>
                            Email адрес
                        </label>
                        <input 
                            id="email" 
                            type="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autocomplete="email"
                            placeholder="Введите ваш email"
                        >
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock me-2"></i>
                            Пароль
                        </label>
                        <div class="password-input-wrapper">
                            <input 
                                id="password" 
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                name="password" 
                                required 
                                autocomplete="new-password"
                                placeholder="Введите пароль"
                            >
                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                <i class="fas fa-eye" id="passwordToggleIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="password-confirm" class="form-label">
                            <i class="fas fa-lock me-2"></i>
                            Подтверждение пароля
                        </label>
                        <div class="password-input-wrapper">
                            <input 
                                id="password-confirm" 
                                type="password" 
                                class="form-control" 
                                name="password_confirmation" 
                                required 
                                autocomplete="new-password"
                                placeholder="Подтвердите пароль"
                            >
                            <button type="button" class="password-toggle" onclick="togglePassword('password-confirm')">
                                <i class="fas fa-eye" id="passwordConfirmToggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                            <label class="form-check-label" for="terms">
                                Я согласен с 
                                <a href="#" class="terms-link">условиями использования</a>
                            </label>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-register">
                            <i class="fas fa-user-plus me-2"></i>
                            Зарегистрироваться
                        </button>
                    </div>
                </form>
            </div>

            <!-- Login Link -->
            <div class="auth-footer">
                <p class="auth-footer-text">
                    Уже есть аккаунт? 
                    <a href="{{ route('login') }}" class="auth-link">
                        Войти
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    .auth-header {
        text-align: center;
        background: rgba(26, 26, 26, 0.4);
        border-radius: 20px;
        padding: 2rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .auth-icon {
        font-size: 3rem;
        color: #6366f1;
        margin-bottom: 1rem;
    }

    .auth-title {
        font-size: 2rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 0.5rem;
    }

    .auth-subtitle {
        color: #e5e5e5;
        font-size: 1.1rem;
        margin-bottom: 0;
        font-weight: 500;
    }

    .auth-form-card {
        background: rgba(26, 26, 26, 0.4);
        border-radius: 20px;
        padding: 2rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.15);
        margin-bottom: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        color: #ffffff;
        font-weight: 600;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
    }

    .form-control {
        background: rgba(38, 38, 38, 0.7);
        border: 2px solid #404040;
        border-radius: 12px;
        color: #ffffff;
        padding: 0.875rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        background: rgba(38, 38, 38, 0.9);
        border-color: #6366f1;
        box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
        color: #ffffff;
    }

    .form-control::placeholder {
        color: #a3a3a3;
    }

    .password-input-wrapper {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #a3a3a3;
        cursor: pointer;
        font-size: 1rem;
        transition: color 0.3s ease;
    }

    .password-toggle:hover {
        color: #6366f1;
    }

    .form-check {
        display: flex;
        align-items: flex-start;
    }

    .form-check-input {
        background-color: rgba(38, 38, 38, 0.7);
        border: 2px solid #404040;
        border-radius: 6px;
        margin-right: 0.75rem;
        margin-top: 0.25rem;
    }

    .form-check-input:checked {
        background-color: #6366f1;
        border-color: #6366f1;
    }

    .form-check-input:focus {
        box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
    }

    .form-check-label {
        color: #e5e5e5;
        font-weight: 500;
        line-height: 1.4;
    }

    .terms-link {
        color: #6366f1;
        text-decoration: none;
        font-weight: 600;
    }

    .terms-link:hover {
        color: #4f46e5;
        text-decoration: underline;
    }

    .error-message {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
    }

    .error-message::before {
        content: "⚠";
        margin-right: 0.5rem;
    }

    .form-actions {
        margin-bottom: 1.5rem;
    }

    .btn-register {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: #ffffff;
        border: none;
        border-radius: 12px;
        padding: 0.875rem 2rem;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
        color: #ffffff;
    }

    .auth-footer {
        text-align: center;
    }

    .auth-footer-text {
        color: #e5e5e5;
        margin-bottom: 0;
    }

    .auth-footer .auth-link {
        color: #6366f1;
        font-weight: 600;
    }

    .auth-footer .auth-link:hover {
        color: #4f46e5;
    }
</style>

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
