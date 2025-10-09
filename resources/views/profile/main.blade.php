@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Profile Header -->
            <div class="card bg-dark border-secondary mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-user-circle text-primary fs-1 me-4"></i>
                        <div>
                            <h1 class="text-white mb-1">{{ $user_info->name }}</h1>
                            <p class="text-light mb-0">{{ $user_info->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Details Card -->
            <div class="card bg-dark border-secondary mb-4">
                <div class="card-header bg-secondary">
                    <h3 class="text-white mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Информация о профиле
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card bg-secondary border-primary">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-id-card text-primary me-3"></i>
                                        <div>
                                            <small class="text-light">ID пользователя</small>
                                            <p class="text-white mb-0 fw-bold">{{ $user_info->id }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-secondary border-info">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-envelope text-info me-3"></i>
                                        <div>
                                            <small class="text-light">Email адрес</small>
                                            <p class="text-white mb-0 fw-bold">{{ $user_info->email }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-secondary border-success">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-user text-success me-3"></i>
                                        <div>
                                            <small class="text-light">Имя пользователя</small>
                                            <p class="text-white mb-0 fw-bold">{{ $user_info->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-secondary border-warning">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-plus text-warning me-3"></i>
                                        <div>
                                            <small class="text-light">Дата регистрации</small>
                                            <p class="text-white mb-0 fw-bold">{{ $user_info->created_at ? $user_info->created_at->format('d.m.Y') : 'Не указано' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Actions -->
            <div class="row g-3">
                <div class="col-md-6">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-lg w-100">
                        <i class="fas fa-edit me-2"></i>
                        Редактировать профиль
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="#" class="btn btn-outline-secondary btn-lg w-100">
                        <i class="fas fa-cog me-2"></i>
                        Настройки безопасности
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection