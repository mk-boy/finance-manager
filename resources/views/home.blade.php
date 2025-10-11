@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Hero Section -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-10">
            <div class="card bg-dark border-secondary text-center py-5">
                <div class="card-body">
                    <h1 class="display-4 fw-bold text-white mb-4">
                        <i class="fas fa-chart-line text-success me-3"></i>
                        Добро пожаловать в FinanceManager
                    </h1>
                    <p class="lead text-light mb-4">
                        Управляйте своими финансами эффективно и просто
                    </p>
                    
                    @auth
                        <div class="row g-4 mt-5">
                            <div class="col-md-4">
                                <div class="card border-success h-100">
                                    <div class="card-body text-center">
                                        <i class="fas fa-wallet text-success fs-1 mb-3"></i>
                                        <h3 class="text-white fw-bold">₽{{ number_format($totalBalance, 0, ',', ' ') }}</h3>
                                        <p class="text-light mb-0">Общий баланс</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-success h-100">
                                    <div class="card-body text-center">
                                        <i class="fas fa-arrow-up text-success fs-1 mb-3"></i>
                                        <h3 class="text-white fw-bold">₽{{ number_format($totalIncome, 0, ',', ' ') }}</h3>
                                        <p class="text-light mb-0">Доходы</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-warning h-100">
                                    <div class="card-body text-center">
                                        <i class="fas fa-arrow-down text-warning fs-1 mb-3"></i>
                                        <h3 class="text-white fw-bold">₽{{ number_format($totalExpense, 0, ',', ' ') }}</h3>
                                        <p class="text-light mb-0">Расходы</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{ route('login') }}" class="btn btn-success btn-lg">
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
                    <div class="card-header">
                        <h3 class="text-white mb-0 text-center">
                            <i class="fas fa-bolt me-2"></i>
                            Быстрые действия
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <a href="{{ route('transactions.add') }}" class="text-decoration-none">
                                    <div class="card border-success h-100">
                                        <div class="card-body d-flex align-items-center">
                                            <i class="fas fa-plus text-success fs-2 me-3"></i>
                                            <div>
                                                <h5 class="text-white mb-1">Добавить транзакцию</h5>
                                                <p class="text-light mb-0 small">Зафиксировать операцию</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('payments.add') }}" class="text-decoration-none">
                                    <div class="card border-success h-100">
                                        <div class="card-body d-flex align-items-center">
                                            <i class="fas fa-wallet text-success fs-2 me-3"></i>
                                            <div>
                                                <h5 class="text-white mb-1">Добавить счет</h5>
                                                <p class="text-light mb-0 small">Создать платежное средство</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('transactions') }}" class="text-decoration-none">
                                    <div class="card border-success h-100">
                                        <div class="card-body d-flex align-items-center">
                                            <i class="fas fa-list text-success fs-2 me-3"></i>
                                            <div>
                                                <h5 class="text-white mb-1">Все транзакции</h5>
                                                <p class="text-light mb-0 small">Просмотр всех операций</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('payments') }}" class="text-decoration-none">
                                    <div class="card border-success h-100">
                                        <div class="card-body d-flex align-items-center">
                                            <i class="fas fa-wallet text-success fs-2 me-3"></i>
                                            <div>
                                                <h5 class="text-white mb-1">Платежные средства</h5>
                                                <p class="text-light mb-0 small">Управление счетами</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
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
                    <div class="card-header">
                        <h3 class="text-white mb-0">
                            <i class="fas fa-history me-2"></i>
                            Последняя активность
                        </h3>
                    </div>
                    <div class="card-body">
                        @if($recentTransactions->count() > 0)
                            @foreach($recentTransactions as $transaction)
                                <div class="d-flex align-items-center mb-3 {{ !$loop->last ? 'border-bottom border-secondary pb-3' : '' }}">
                                    <div class="me-3">
                                        @if($transaction->type_id == \App\Models\Transaction::INCOME_TYPE_ID)
                                            <i class="fas fa-arrow-up text-success fs-4"></i>
                                        @else
                                            <i class="fas fa-arrow-down text-danger fs-4"></i>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-white mb-1">{{ $transaction->name }}</p>
                                        <small class="text-light">
                                            {{ $transaction->category->name ?? 'Без категории' }} • 
                                            {{ $transaction->payment->name ?? 'Не указано' }} • 
                                            {{ $transaction->created_at->format('d.m.Y H:i') }}
                                        </small>
                                    </div>
                                    <div class="text-end">
                                        <span class="fw-bold {{ $transaction->type_id == \App\Models\Transaction::INCOME_TYPE_ID ? 'text-success' : 'text-danger' }}">
                                            {{ $transaction->type_id == \App\Models\Transaction::INCOME_TYPE_ID ? '+' : '-' }}₽{{ number_format($transaction->sum, 0, ',', ' ') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                            <div class="text-center mt-3">
                                <a href="{{ route('transactions') }}" class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-list me-2"></i>
                                    Показать все транзакции
                                </a>
                            </div>
                        @else
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle text-success fs-4 me-3"></i>
                                <div>
                                    <p class="text-white mb-1">Добро пожаловать в FinanceManager!</p>
                                    <small class="text-light">Начните добавлять свои транзакции</small>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endauth
</div>

@endsection
