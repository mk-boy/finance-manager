@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Hero Section -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-10">
            <div class="card bg-dark border-secondary text-center py-5">
                <div class="card-body">
                    <h1 class="display-4 fw-bold text-white mb-4">
                        <i class="fas fa-chart-line text-primary me-3"></i>
                        Добро пожаловать в FinanceManager
                    </h1>
                    <p class="lead text-light mb-4">
                        Управляйте своими финансами эффективно и просто
                    </p>
                    
                    @auth
                        <div class="row g-4 mt-5">
                            <div class="col-md-4">
                                <div class="card bg-secondary border-primary h-100">
                                    <div class="card-body text-center">
                                        <i class="fas fa-wallet text-primary fs-1 mb-3"></i>
                                        <h3 class="text-white fw-bold">₽0</h3>
                                        <p class="text-light mb-0">Общий баланс</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-secondary border-success h-100">
                                    <div class="card-body text-center">
                                        <i class="fas fa-arrow-up text-success fs-1 mb-3"></i>
                                        <h3 class="text-white fw-bold">₽0</h3>
                                        <p class="text-light mb-0">Доходы</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-secondary border-danger h-100">
                                    <div class="card-body text-center">
                                        <i class="fas fa-arrow-down text-danger fs-1 mb-3"></i>
                                        <h3 class="text-white fw-bold">₽0</h3>
                                        <p class="text-light mb-0">Расходы</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                Войти
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">
                                <i class="fas fa-user-plus me-2"></i>
                                Регистрация
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    @auth
        <!-- Quick Actions -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-10">
                <div class="card bg-dark border-secondary">
                    <div class="card-header bg-secondary">
                        <h3 class="text-white mb-0 text-center">
                            <i class="fas fa-bolt me-2"></i>
                            Быстрые действия
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="card bg-secondary border-primary h-100">
                                    <div class="card-body d-flex align-items-center">
                                        <i class="fas fa-plus text-primary fs-2 me-3"></i>
                                        <div>
                                            <h5 class="text-white mb-1">Добавить доход</h5>
                                            <p class="text-light mb-0 small">Зафиксировать поступление средств</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-secondary border-danger h-100">
                                    <div class="card-body d-flex align-items-center">
                                        <i class="fas fa-minus text-danger fs-2 me-3"></i>
                                        <div>
                                            <h5 class="text-white mb-1">Добавить расход</h5>
                                            <p class="text-light mb-0 small">Записать трату</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-secondary border-info h-100">
                                    <div class="card-body d-flex align-items-center">
                                        <i class="fas fa-chart-pie text-info fs-2 me-3"></i>
                                        <div>
                                            <h5 class="text-white mb-1">Аналитика</h5>
                                            <p class="text-light mb-0 small">Просмотр статистики</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-secondary border-warning h-100">
                                    <div class="card-body d-flex align-items-center">
                                        <i class="fas fa-cog text-warning fs-2 me-3"></i>
                                        <div>
                                            <h5 class="text-white mb-1">Настройки</h5>
                                            <p class="text-light mb-0 small">Управление профилем</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card bg-dark border-secondary">
                    <div class="card-header bg-secondary">
                        <h3 class="text-white mb-0">
                            <i class="fas fa-history me-2"></i>
                            Последняя активность
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-info-circle text-primary fs-4 me-3"></i>
                            <div>
                                <p class="text-white mb-1">Добро пожаловать в FinanceManager!</p>
                                <small class="text-light">Начните добавлять свои транзакции</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth
</div>

@endsection
