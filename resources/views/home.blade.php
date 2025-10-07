@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Hero Section -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-10">
            <div class="hero-section text-center py-5">
                <div class="hero-content">
                    <h1 class="display-4 fw-bold text-white mb-4">
                        <i class="fas fa-chart-line text-primary me-3"></i>
                        Добро пожаловать в FinanceManager
                    </h1>
                    <p class="lead text-light mb-4">
                        Управляйте своими финансами эффективно и просто
                    </p>
                    @auth
                        <div class="hero-stats row g-4 mt-5">
                            <div class="col-md-4">
                                <div class="stat-card">
                                    <div class="stat-icon">
                                        <i class="fas fa-wallet"></i>
                                    </div>
                                    <div class="stat-content">
                                        <h3 class="stat-number">₽0</h3>
                                        <p class="stat-label">Общий баланс</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card">
                                    <div class="stat-icon">
                                        <i class="fas fa-arrow-up text-success"></i>
                                    </div>
                                    <div class="stat-content">
                                        <h3 class="stat-number">₽0</h3>
                                        <p class="stat-label">Доходы</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card">
                                    <div class="stat-icon">
                                        <i class="fas fa-arrow-down text-danger"></i>
                                    </div>
                                    <div class="stat-content">
                                        <h3 class="stat-number">₽0</h3>
                                        <p class="stat-label">Расходы</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="hero-actions">
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-3">
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
            <div class="col-lg-8">
                <div class="quick-actions">
                    <h3 class="text-white mb-4 text-center">
                        <i class="fas fa-bolt me-2"></i>
                        Быстрые действия
                    </h3>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="action-card">
                                <div class="action-icon">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="action-content">
                                    <h5>Добавить доход</h5>
                                    <p class="text-muted">Зафиксировать поступление средств</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="action-card">
                                <div class="action-icon">
                                    <i class="fas fa-minus"></i>
                                </div>
                                <div class="action-content">
                                    <h5>Добавить расход</h5>
                                    <p class="text-muted">Записать трату</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="action-card">
                                <div class="action-icon">
                                    <i class="fas fa-chart-pie"></i>
                                </div>
                                <div class="action-content">
                                    <h5>Аналитика</h5>
                                    <p class="text-muted">Просмотр статистики</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="action-card">
                                <div class="action-icon">
                                    <i class="fas fa-cog"></i>
                                </div>
                                <div class="action-content">
                                    <h5>Настройки</h5>
                                    <p class="text-muted">Управление профилем</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="recent-activity">
                    <h3 class="text-white mb-4">
                        <i class="fas fa-history me-2"></i>
                        Последняя активность
                    </h3>
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div class="activity-content">
                                <p class="mb-0">Добро пожаловать в FinanceManager!</p>
                                <small class="text-muted">Начните добавлять свои транзакции</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth
</div>

<style>
    .hero-section {
        background: rgba(26, 26, 26, 0.4);
        border-radius: 20px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .stat-card {
        background: rgba(26, 26, 26, 0.7);
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.15);
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(99, 102, 241, 0.25);
        border-color: #6366f1;
    }

    .stat-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: #6366f1;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: #e5e5e5;
        margin-bottom: 0;
        font-weight: 500;
    }

    .quick-actions {
        background: rgba(26, 26, 26, 0.4);
        border-radius: 20px;
        padding: 2rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .action-card {
        background: rgba(38, 38, 38, 0.7);
        border-radius: 15px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.15);
        cursor: pointer;
    }

    .action-card:hover {
        transform: translateY(-3px);
        background: rgba(99, 102, 241, 0.15);
        border-color: #6366f1;
    }

    .action-icon {
        font-size: 2rem;
        color: #6366f1;
        margin-right: 1rem;
        width: 60px;
        text-align: center;
    }

    .action-content h5 {
        color: #ffffff;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .action-content p {
        color: #a3a3a3;
        margin-bottom: 0;
    }

    .recent-activity {
        background: rgba(26, 26, 26, 0.4);
        border-radius: 20px;
        padding: 2rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .activity-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        background: rgba(38, 38, 38, 0.5);
        border-radius: 10px;
        margin-bottom: 1rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .activity-icon {
        font-size: 1.5rem;
        color: #6366f1;
        margin-right: 1rem;
        width: 40px;
        text-align: center;
    }

    .activity-content p {
        color: #ffffff;
        margin-bottom: 0.25rem;
        font-weight: 500;
    }

    .activity-content small {
        color: #a3a3a3;
    }

    .hero-actions .btn {
        border-radius: 50px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .hero-actions .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
    }

    /* Improved text contrast */
    .text-white {
        color: #ffffff !important;
    }

    .text-light {
        color: #e5e5e5 !important;
    }

    .text-muted {
        color: #a3a3a3 !important;
    }

    h1, h2, h3, h4, h5, h6 {
        color: #ffffff;
        font-weight: 600;
    }
</style>
@endsection
