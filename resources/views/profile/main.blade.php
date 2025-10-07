@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Profile Header -->
            <div class="profile-header mb-4">
                <div class="profile-avatar">
                    <i class="fas fa-user-circle"></i>
                </div>
                <div class="profile-info">
                    <h1 class="profile-name">{{ $user_info->name }}</h1>
                    <p class="profile-email">{{ $user_info->email }}</p>
                </div>
            </div>

            <!-- Profile Details Card -->
            <div class="profile-card mb-4">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle me-2"></i>
                        Информация о профиле
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-id-card me-2"></i>
                                    ID пользователя
                                </div>
                                <div class="info-value">{{ $user_info->id }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-envelope me-2"></i>
                                    Email адрес
                                </div>
                                <div class="info-value">{{ $user_info->email }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-user me-2"></i>
                                    Имя пользователя
                                </div>
                                <div class="info-value">{{ $user_info->name }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-calendar-plus me-2"></i>
                                    Дата регистрации
                                </div>
                                <div class="info-value">{{ $user_info->created_at ? $user_info->created_at->format('d.m.Y') : 'Не указано' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Actions -->
            <div class="profile-actions">
                <div class="row g-3">
                    <div class="col-md-6">
                        <a href="{{ route('profile.edit') }}" class="action-btn primary">
                            <i class="fas fa-edit me-2"></i>
                            Редактировать профиль
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="#" class="action-btn secondary">
                            <i class="fas fa-cog me-2"></i>
                            Настройки безопасности
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .profile-header {
        display: flex;
        align-items: center;
        background: rgba(26, 26, 26, 0.4);
        border-radius: 20px;
        padding: 2rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.15);
        margin-bottom: 2rem;
    }

    .profile-avatar {
        font-size: 4rem;
        color: #6366f1;
        margin-right: 2rem;
    }

    .profile-name {
        font-size: 2rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 0.5rem;
    }

    .profile-email {
        color: #e5e5e5;
        font-size: 1.1rem;
        margin-bottom: 0;
        font-weight: 500;
    }

    .profile-card {
        background: rgba(26, 26, 26, 0.4);
        border-radius: 20px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.15);
        overflow: hidden;
    }

    .card-header {
        background: rgba(38, 38, 38, 0.7);
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        padding: 1.5rem 2rem;
    }

    .card-title {
        color: #ffffff;
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 0;
    }

    .card-body {
        padding: 2rem;
    }

    .info-item {
        background: rgba(38, 38, 38, 0.5);
        border-radius: 15px;
        padding: 1.5rem;
        border: 1px solid rgba(255, 255, 255, 0.15);
        transition: all 0.3s ease;
    }

    .info-item:hover {
        transform: translateY(-2px);
        background: rgba(99, 102, 241, 0.15);
        border-color: #6366f1;
    }

    .info-label {
        color: #a3a3a3;
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }

    .info-value {
        color: #ffffff;
        font-size: 1.1rem;
        font-weight: 600;
    }

    .profile-actions {
        margin-top: 2rem;
    }

    .action-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem 2rem;
        border-radius: 15px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .action-btn.primary {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: #ffffff;
    }

    .action-btn.primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
        color: #ffffff;
    }

    .action-btn.secondary {
        background: rgba(38, 38, 38, 0.7);
        color: #ffffff;
        border-color: #404040;
    }

    .action-btn.secondary:hover {
        transform: translateY(-3px);
        background: rgba(99, 102, 241, 0.15);
        border-color: #6366f1;
        color: #ffffff;
    }

    @media (max-width: 768px) {
        .profile-header {
            flex-direction: column;
            text-align: center;
        }

        .profile-avatar {
            margin-right: 0;
            margin-bottom: 1rem;
        }

        .profile-name {
            font-size: 1.5rem;
        }
    }
</style>
@endsection