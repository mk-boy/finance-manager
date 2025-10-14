@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card bg-dark">
                <div class="card-header">
                    <h3 class="text-white mb-0">
                        <i class="fas fa-plus me-2"></i>
                        Добавить новую транзакцию
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('transactions.add') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="name" class="form-label text-white">
                                <i class="fas fa-tag me-2"></i>
                                Название транзакции
                            </label>
                            <input type="text" 
                                   class="form-control text-white @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   placeholder="Введите название транзакции"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="type_id" class="form-label text-white">
                                <i class="fas fa-list me-2"></i>
                                Тип транзакции
                            </label>
                            <select class="form-select text-white @error('type_id') is-invalid @enderror" 
                                    id="type_id" 
                                    name="type_id" 
                                    required>
                                <option value="" disabled {{ old('type_id') == '' ? 'selected' : '' }}>Выберите тип транзакции</option>
                                @foreach (\App\Models\Transaction::TRANSACTION_TITLES as $key => $value)
                                    <option value="{{ $key }}" {{ old('type_id') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('type_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="sum" class="form-label text-white">
                                <i class="fas fa-money-bill-wave me-2"></i>
                                Сумма
                            </label>
                            <input type="number" 
                                   class="form-control text-white @error('sum') is-invalid @enderror" 
                                   id="sum" 
                                   name="sum" 
                                   value="{{ old('sum') }}"
                                   placeholder="Введите сумму"
                                   min="1"
                                   step="0.01"
                                   required>
                            @error('sum')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="category_id" class="form-label text-white">
                                <i class="fas fa-tags me-2"></i>
                                Категория
                            </label>
                            <select class="form-select text-white @error('category_id') is-invalid @enderror" 
                                    id="category_id" 
                                    name="category_id" 
                                    required>
                                <option value="" disabled {{ old('category_id') == '' ? 'selected' : '' }}>Выберите категорию</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="payment_id" class="form-label text-white">
                                <i class="fas fa-credit-card me-2"></i>
                                Счёт
                            </label>
                            <select class="form-select text-white @error('payment_id') is-invalid @enderror" 
                                    id="payment_id" 
                                    name="payment_id" 
                                    required>
                                <option value="" disabled {{ old('payment_id') == '' ? 'selected' : '' }}>Выберите счёт</option>
                                @foreach ($payments as $payment)
                                    <option value="{{ $payment->id }}" {{ old('payment_id') == $payment->id ? 'selected' : '' }}>{{ $payment->name }} ({{ $payment->currency->symbol }})</option>
                                @endforeach
                            </select>
                            @error('payment_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-outline-success">
                                <i class="fas fa-save me-2"></i>
                                Создать транзакцию
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
