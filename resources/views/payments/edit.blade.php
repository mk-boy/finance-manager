@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card bg-dark border-secondary">
                <div class="card-header bg-secondary">
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
                                   class="form-control bg-secondary border-secondary text-white" 
                                   id="name" 
                                   name="name" 
                                   value="{{ $payment->name }}"
                                   placeholder="Введите название счёта"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="type_id" class="form-label text-white">
                                <i class="fas fa-list me-2"></i>
                                Тип счёта
                            </label>
                            <select class="form-select bg-secondary border-secondary text-white" 
                                    id="type_id" 
                                    name="type_id" 
                                    required>
                                @foreach (\App\Models\Payment::PAYMENTS_TITLES as $key => $value)
                                    @if ($key == $payment->type_id)
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" name="payment_id" value="{{ $payment->id }}">

                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary">
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