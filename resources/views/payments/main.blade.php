@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="alert alert-dismissible fade" role="alert" style="display: none;">
                <span class="alert-message"></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            @if (!empty($payments))
                <div class="card bg-dark mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="text-white mb-0">
                            <i class="fas fa-credit-card me-2"></i>
                            Ваши счета
                        </h3>
                        <a href="{{ route('payments.add') }}" class="btn btn-outline-success">
                            <i class="fas fa-plus me-2"></i>
                            Добавить счёт
                        </a>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0 table-dark">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-light border-0">Название</th>
                                        <th scope="col" class="text-light border-0">Тип</th>
                                        <th scope="col" class="text-light border-0">Баланс</th>
                                        <th scope="col" class="text-center text-light border-0">Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $payment)
                                        <tr class="payment-{{ $payment->id }}">
                                            <td class="fw-bold text-light">{{ $payment->name }}</td>
                                            <td>
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
                                                    <span class="badge bg-dark">
                                                        <i class="fas fa-tag me-1"></i>
                                                        {{ \App\Models\Payment::PAYMENTS_TITLES[$payment->type_id] }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="fw-bold text-light">
                                                {{ $payment->current_balance }} {{ $payment->currency->symbol }}
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-outline-success btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button class="btn btn-outline-danger btn-sm delete_btn">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <input type="hidden" class="payment_id" value="{{ $payment->id }}">
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <div class="card bg-dark">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-credit-card text-muted fs-1 mb-3"></i>
                        <h3 class="text-white mb-3">Пока нет счетов</h3>
                        <p class="text-light mb-4">Добавьте свой первый счёт, чтобы начать управление финансами</p>
                        <a href="{{ route('payments.add') }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-plus me-2"></i>
                            Добавить счёт
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete_btn').on('click', function () {
            let payment_id = $(this).siblings('.payment_id').val();
            let paymentRow = $(`.payment-${payment_id}`);

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
                        paymentRow.fadeOut(300, function () {
                            $(this).remove();
                        });
                        showAlert(response.message, 'success');
                    }
                },
                error: function(xhr) {
                    showAlert('Ошибка при удалении счёта', 'danger');
                }
            });
        });

        function showAlert(message, type) {
            let alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
            let alert = $('.alert');
            
            alert.removeClass('alert-success alert-danger');
            alert.addClass(alertClass);
            alert.find('.alert-message').text(message);
            
            alert.show().addClass('show');

            setTimeout(function () {
                alert.removeClass('show').fadeOut();
            }, 3000);
        }
    });
</script>
@endsection