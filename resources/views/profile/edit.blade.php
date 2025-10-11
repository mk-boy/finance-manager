@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <!-- Edit Profile Header -->
            <div class="card bg-dark border-secondary mb-4">
                <div class="card-body text-center">
                    <h1 class="text-white mb-2">
                        <i class="fas fa-edit me-2"></i>
                        Редактирование профиля
                    </h1>
                    <p class="text-light mb-0">Обновите информацию о своем профиле</p>
                </div>
            </div>

            <!-- Edit Profile Form -->
            <div class="card bg-dark border-secondary mb-4">
                <div class="card-body">
                    <form action="{{ route('profile.edit') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label text-white">
                                <i class="fas fa-user me-2"></i>
                                Имя пользователя
                            </label>
                            <input 
                                type="text" 
                                id="name"
                                name="name" 
                                class="form-control border-secondary text-white" 
                                value="{{ $user_info->name }}"
                                placeholder="Введите ваше имя"
                                required
                            >
                            @error('name')
                                <div class="text-danger mt-1">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label text-white">
                                <i class="fas fa-envelope me-2"></i>
                                Email адрес
                            </label>
                            <input 
                                type="email" 
                                id="email"
                                name="email" 
                                class="form-control border-secondary text-white" 
                                value="{{ $user_info->email }}"
                                placeholder="Введите ваш email"
                                required
                            >
                            @error('email')
                                <div class="text-danger mt-1">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex">
                            <button type="submit" class="btn btn-success btn-lg flex-fill">
                                <i class="fas fa-save me-2"></i>
                                Сохранить изменения
                            </button>
                            <a href="{{ route('profile') }}" class="btn btn-outline-secondary btn-lg flex-fill">
                                <i class="fas fa-times me-2"></i>
                                Отмена
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection