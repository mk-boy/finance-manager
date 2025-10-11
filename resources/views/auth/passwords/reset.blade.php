@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card bg-dark border-secondary">
                <div class="card-header">
                    <h3 class="text-white mb-0">
                        <i class="fas fa-key me-2"></i>
                        {{ __('Reset Password') }}
                    </h3>
                </div>

                <div class="card-body">
                    <div class="text-center mb-4">
                        <i class="fas fa-lock text-success fs-1 mb-3"></i>
                        <p class="text-light">Создайте новый пароль для вашего аккаунта</p>
                    </div>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-4">
                            <label for="email" class="form-label text-white">
                                <i class="fas fa-envelope me-2"></i>
                                {{ __('Email Address') }}
                            </label>
                            <input id="email" 
                                   type="email" 
                                   class="form-control border-secondary text-white @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ $email ?? old('email') }}" 
                                   required 
                                   autocomplete="email" 
                                   autofocus
                                   readonly>

                            @error('email')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label text-white">
                                <i class="fas fa-lock me-2"></i>
                                {{ __('Password') }}
                            </label>
                            <input id="password" 
                                   type="password" 
                                   class="form-control border-secondary text-white @error('password') is-invalid @enderror" 
                                   name="password" 
                                   required 
                                   autocomplete="new-password"
                                   placeholder="Введите новый пароль">

                            @error('password')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label text-white">
                                <i class="fas fa-lock me-2"></i>
                                {{ __('Confirm Password') }}
                            </label>
                            <input id="password-confirm" 
                                   type="password" 
                                   class="form-control border-secondary text-white" 
                                   name="password_confirmation" 
                                   required 
                                   autocomplete="new-password"
                                   placeholder="Подтвердите новый пароль">
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                {{ __('Reset Password') }}
                            </button>
                            <a href="{{ route('login') }}" class="btn btn-outline-light">
                                <i class="fas fa-arrow-left me-2"></i>
                                Назад к входу
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
