@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Alert для уведомлений -->
            <div class="alert alert-dismissible fade" role="alert" style="display: none;">
                <span class="alert-message"></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            @if (!empty($payments))
                <div class="card bg-dark border-secondary mb-4">
                    <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                        <h3 class="text-white mb-0">
                            <i class="fas fa-credit-card me-2"></i>
                            Ваши платежи
                        </h3>
                        <a href="{{ route('payments.add') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>
                            Добавить счёт
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            @foreach ($payments as $payment)
                                <div class="col-md-6 col-lg-4">
                                    <div class="card bg-secondary border-primary payment-{{ $payment->id }}">
                                        <div class="card-body">
                                            <h5 class="card-title text-white">{{ $payment->name }}</h5>
                                            <div class="mb-2">
                                                @if($payment->type_id == \App\Models\Payment::CASH_PAYMENT_TYPE)
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-money-bill-wave me-1"></i>
                                                        {{ \App\Models\Payment::PAYMENTS_TITLES[$payment->type_id] }}
                                                    </span>
                                                @elseif($payment->type_id == \App\Models\Payment::BANK_CARD_PAYMENT_TYPE)
                                                    <span class="badge bg-primary">
                                                        <i class="fas fa-credit-card me-1"></i>
                                                        {{ \App\Models\Payment::PAYMENTS_TITLES[$payment->type_id] }}
                                                    </span>
                                                @elseif($payment->type_id == \App\Models\Payment::CREDIT_CARD_PAYMENT_TYPE)
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="fas fa-credit-card me-1"></i>
                                                        {{ \App\Models\Payment::PAYMENTS_TITLES[$payment->type_id] }}
                                                    </span>
                                                @elseif($payment->type_id == \App\Models\Payment::SAVING_PAYMENT_TYPE)
                                                    <span class="badge bg-info">
                                                        <i class="fas fa-piggy-bank me-1"></i>
                                                        {{ \App\Models\Payment::PAYMENTS_TITLES[$payment->type_id] }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">
                                                        <i class="fas fa-tag me-1"></i>
                                                        {{ \App\Models\Payment::PAYMENTS_TITLES[$payment->type_id] }}
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="card-text text-white fw-bold">
                                                {{ $payment->current_balance }} ₽
                                            </p>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit me-1"></i>
                                                    Редактировать
                                                </a>
                                                <button class="btn btn-danger btn-sm delete_btn">
                                                    <i class="fas fa-trash me-1"></i>
                                                    Удалить
                                                </button>
                                                <input type="hidden" class="payment_id" value="{{ $payment->id }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="card bg-dark border-secondary">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-credit-card text-muted fs-1 mb-3"></i>
                        <h3 class="text-white mb-3">Пока нет платежей</h3>
                        <p class="text-light mb-4">Добавьте свой первый платеж, чтобы начать управление финансами</p>
                        <a href="{{ route('payments.add') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus me-2"></i>
                            Добавить счёт
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete_btn').on('click', function () {
            let payment_id = $(this).siblings('.payment_id').val();
            let $paymentCard = $(`.payment-${payment_id}`).closest('.col-md-6, .col-lg-4');

            $.ajax({
                url: '/payments/delete',
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    payment_id: payment_id
                },
                success: function (response) {
                    if (response.success) {
                        $paymentCard.fadeOut(300, function () {
                            $(this).remove();
                        });
                        showAlert(response.message, 'success');
                    }
                },
                error: function(xhr) {
                    showAlert('Ошибка при удалении платежа', 'danger');
                }
            });
        });

        function showAlert(message, type) {
            let alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
            let $alert = $('.alert');
            
            // Удаляем предыдущие классы
            $alert.removeClass('alert-success alert-danger');
            // Добавляем новый класс
            $alert.addClass(alertClass);
            // Устанавливаем текст
            $alert.find('.alert-message').text(message);
            
            // Показываем alert с Bootstrap анимацией
            $alert.show().addClass('show');

            // Автоматически скрываем через 3 секунды
            setTimeout(function () {
                $alert.removeClass('show').fadeOut();
            }, 3000);
        }
    });
</script>
@endsection