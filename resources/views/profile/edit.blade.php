@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <!-- Edit Profile Header -->
            <div class="edit-header mb-4">
                <h1 class="edit-title">
                    <i class="fas fa-edit me-2"></i>
                    Редактирование профиля
                </h1>
                <p class="edit-subtitle">Обновите информацию о своем профиле</p>
            </div>

            <!-- Edit Profile Form -->
            <div class="edit-form-card">
                <form action="{{ route('profile.edit') }}" method="POST" class="edit-form">
                    @csrf
                    
                    <div class="form-group mb-4">
                        <label for="name" class="form-label">
                            <i class="fas fa-user me-2"></i>
                            Имя пользователя
                        </label>
                        <input 
                            type="text" 
                            id="name"
                            name="name" 
                            class="form-control" 
                            value="{{ $user_info->name }}"
                            placeholder="Введите ваше имя"
                            required
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
                            type="email" 
                            id="email"
                            name="email" 
                            class="form-control" 
                            value="{{ $user_info->email }}"
                            placeholder="Введите ваш email"
                            required
                        >
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-save">
                            <i class="fas fa-save me-2"></i>
                            Сохранить изменения
                        </button>
                        <a href="{{ route('profile') }}" class="btn-cancel">
                            <i class="fas fa-times me-2"></i>
                            Отмена
                        </a>
                    </div>
                </form>
            </div>

            <!-- Additional Info -->
            <div class="additional-info">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div class="info-content">
                        <h5>Важная информация</h5>
                        <p>После изменения email адреса вам потребуется подтвердить новый адрес электронной почты.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .edit-header {
        text-align: center;
        background: rgba(26, 26, 26, 0.4);
        border-radius: 20px;
        padding: 2rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .edit-title {
        font-size: 2rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 0.5rem;
    }

    .edit-subtitle {
        color: #e5e5e5;
        font-size: 1.1rem;
        margin-bottom: 0;
        font-weight: 500;
    }

    .edit-form-card {
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
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }

    .btn-save {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: #ffffff;
        border: none;
        border-radius: 12px;
        padding: 0.875rem 2rem;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
        color: #ffffff;
    }

    .btn-cancel {
        background: rgba(38, 38, 38, 0.7);
        color: #ffffff;
        border: 2px solid #404040;
        border-radius: 12px;
        padding: 0.875rem 2rem;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-cancel:hover {
        transform: translateY(-2px);
        background: rgba(99, 102, 241, 0.15);
        border-color: #6366f1;
        color: #ffffff;
    }

    .additional-info {
        margin-top: 2rem;
    }

    .info-card {
        background: rgba(26, 26, 26, 0.4);
        border-radius: 15px;
        padding: 1.5rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.15);
        display: flex;
        align-items: flex-start;
    }

    .info-icon {
        font-size: 1.5rem;
        color: #6366f1;
        margin-right: 1rem;
        margin-top: 0.25rem;
    }

    .info-content h5 {
        color: #ffffff;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .info-content p {
        color: #e5e5e5;
        margin-bottom: 0;
        line-height: 1.5;
    }

    @media (max-width: 768px) {
        .form-actions {
            flex-direction: column;
        }

        .edit-title {
            font-size: 1.5rem;
        }
    }
</style>
@endsection