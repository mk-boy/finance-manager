@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="alert alert-dismissible fade" role="alert" style="display: none;">
                <span class="alert-message"></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            @if (!empty($transactions))
                <div class="card bg-dark mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="text-white mb-0">
                            <i class="fas fa-exchange-alt me-2"></i>
                            Ваши транзакции
                        </h3>
                        <a href="{{ route('transactions.add') }}" class="btn btn-outline-success">
                            <i class="fas fa-plus me-2"></i>
                            Добавить транзакцию
                        </a>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0 table-dark">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-light border-0">Название</th>
                                        <th scope="col" class="text-light border-0">Тип</th>
                                        <th scope="col" class="text-light border-0">Категория</th>
                                        <th scope="col" class="text-light border-0">Счёт</th>
                                        <th scope="col" class="text-light border-0">Сумма</th>
                                        <th scope="col" class="text-light border-0">Дата</th>
                                        <th scope="col" class="text-center text-light border-0">Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr class="transaction-{{ $transaction->id }}">
                                            <td class="fw-bold text-light">{{ $transaction->name }}</td>
                                            <td>
                                                @if($transaction->type_id == \App\Models\Transaction::INCOME_TYPE_ID)
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-arrow-up me-1"></i>
                                                        {{ \App\Models\Transaction::TRANSACTION_TITLES[$transaction->type_id] }}
                                                    </span>
                                                @elseif($transaction->type_id == \App\Models\Transaction::EXPENSE_TYPE_ID)
                                                    <span class="badge bg-danger">
                                                        <i class="fas fa-arrow-down me-1"></i>
                                                        {{ \App\Models\Transaction::TRANSACTION_TITLES[$transaction->type_id] }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-light">
                                                <div class="d-flex align-items-center">
                                                    <div style="width: 20px; height: 20px; background-color: {{ $transaction->category->tag_color }}; border-radius: 50%; border: 1px solid #2a2a2a; margin-right: 8px;"></div>
                                                    {{ $transaction->category->name }}
                                                </div>
                                            </td>
                                            <td class="text-light">{{ $transaction->payment->name }}</td>
                                            <td class="fw-bold text-light">
                                                @if($transaction->type_id == \App\Models\Transaction::INCOME_TYPE_ID)
                                                    <span class="text-success">+{{ $transaction->sum }} {{ $transaction->payment->currency->symbol }}</span>
                                                @else
                                                    <span class="text-danger">-{{ $transaction->sum }} {{ $transaction->payment->currency->symbol }}</span>
                                                @endif
                                            </td>
                                            <td class="text-light">{{ $transaction->created_at->format('d.m.Y H:i') }}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-outline-success btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button class="btn btn-outline-danger btn-sm delete_btn">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <input type="hidden" class="transaction_id" value="{{ $transaction->id }}">
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
                        <i class="fas fa-exchange-alt text-muted fs-1 mb-3"></i>
                        <h3 class="text-white mb-3">Пока нет транзакций</h3>
                        <p class="text-light mb-4">Добавьте свою первую транзакцию для отслеживания доходов и расходов</p>
                        <a href="{{ route('transactions.add') }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-plus me-2"></i>
                            Добавить транзакцию
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
            let transaction_id = $(this).siblings('.transaction_id').val();
            let transactionRow = $(`.transaction-${transaction_id}`);

            $.ajax({
                url: '/transactions/delete',
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    transaction_id: transaction_id
                },
                success: function (response) {
                    if (response.success) {
                        transactionRow.fadeOut(300, function () {
                            $(this).remove();
                        });
                        showAlert(response.message, 'success');
                    }
                },
                error: function(xhr) {
                    showAlert('Ошибка при удалении транзакции', 'danger');
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
