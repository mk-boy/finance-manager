@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card bg-dark">
                <div class="card-header">
                    <h3 class="text-white mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Редактировать счёт
                    </h3>
                </div>
                <div class="card-body">
                    <form action="/payments/edit" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="name" class="form-label text-white">
                                <i class="fas fa-tag me-2"></i>
                                Название счёта
                            </label>
                            <input type="text" 
                                   class="form-control text-white @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $payment->name) }}"
                                   placeholder="Введите название счёта"
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
                                Тип счёта
                            </label>
                            <select class="form-select text-white @error('type_id') is-invalid @enderror" 
                                    id="type_id" 
                                    name="type_id" 
                                    required>
                                @foreach (\App\Models\Payment::PAYMENTS_TITLES as $key => $value)
                                    @if ($key == old('type_id', $payment->type_id))
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('type_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="currency_id" class="form-label text-white">
                                <i class="fas fa-coins me-2"></i>
                                Валюта счёта
                            </label>
                            <select class="form-select text-white @error('currency_id') is-invalid @enderror" 
                                    id="currency_id" 
                                    name="currency_id" 
                                    required>
                                @foreach ($currencies as $currency)
                                    @if ($currency->id == old('currency_id', $payment->currency_id))
                                        <option value="{{ $currency->id }}" selected>{{ $currency->name }}</option>
                                    @else
                                        <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('currency_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <input type="hidden" name="payment_id" value="{{ $payment->id }}">

                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-outline-success">
                                <i class="fas fa-save me-2"></i>
                                Сохранить изменения
                            </button>
                            <a href="{{ route('payments') }}" class="btn btn-outline-light">
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