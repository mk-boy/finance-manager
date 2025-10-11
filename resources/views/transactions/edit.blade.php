@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card bg-dark border-secondary">
                <div class="card-header">
                    <h3 class="text-white mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Редактировать транзакцию
                    </h3>
                </div>
                <div class="card-body">
                    <form action="/transactions/edit" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="name" class="form-label text-white">
                                <i class="fas fa-tag me-2"></i>
                                Название транзакции
                            </label>
                            <input type="text" 
                                   class="form-control border-secondary text-white" 
                                   id="name" 
                                   name="name" 
                                   value="{{ $transaction->name }}"
                                   placeholder="Введите название транзакции"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="type_id" class="form-label text-white">
                                <i class="fas fa-list me-2"></i>
                                Тип транзакции
                            </label>
                            <select class="form-select border-secondary text-white" 
                                    id="type_id" 
                                    name="type_id" 
                                    required>
                                @foreach (\App\Models\Transaction::TRANSACTION_TITLES as $key => $value)
                                    @if ($key == $transaction->type_id)
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="sum" class="form-label text-white">
                                <i class="fas fa-money-bill-wave me-2"></i>
                                Сумма
                            </label>
                            <input type="number" 
                                   class="form-control border-secondary text-white" 
                                   id="sum" 
                                   name="sum" 
                                   value="{{ $transaction->sum }}"
                                   placeholder="Введите сумму"
                                   min="1"
                                   step="0.01"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="category_id" class="form-label text-white">
                                <i class="fas fa-tags me-2"></i>
                                Категория
                            </label>
                            <select class="form-select border-secondary text-white" 
                                    id="category_id" 
                                    name="category_id" 
                                    required>
                                @foreach ($categories as $category)
                                    @if ($category->id == $transaction->category_id)
                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="payment_id" class="form-label text-white">
                                <i class="fas fa-credit-card me-2"></i>
                                Счёт
                            </label>
                            <select class="form-select border-secondary text-white" 
                                    id="payment_id" 
                                    name="payment_id" 
                                    required>
                                @foreach ($payments as $payment)
                                    @if ($payment->id == $transaction->payment_id)
                                        <option value="{{ $payment->id }}" selected>{{ $payment->name }} ({{ $payment->currency->symbol }})</option>
                                    @else
                                        <option value="{{ $payment->id }}">{{ $payment->name }} ({{ $payment->currency->symbol }})</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">

                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                Сохранить изменения
                            </button>
                            <a href="{{ route('transactions') }}" class="btn btn-outline-light">
                                <i class="fas fa-arrow-left me-2"></i>
                                Назад к списку
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
