<?php

namespace App\Services;

use App\Models\User;
use App\Models\Transaction;
use App\Models\Payment;

class HomeService
{
    public static function getDashboardData(User $user): array
    {
        // Получаем все платежные средства пользователя
        $payments = Payment::where('user_id', $user->id)->get();
        
        // Рассчитываем общий баланс
        $totalBalance = $payments->sum('current_balance');
        
        // Получаем транзакции пользователя
        $transactions = Transaction::where('user_id', $user->id)
            ->with(['category', 'payment'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Рассчитываем доходы и расходы
        $totalIncome = $transactions->where('type_id', Transaction::INCOME_TYPE_ID)->sum('sum');
        $totalExpense = $transactions->where('type_id', Transaction::EXPENSE_TYPE_ID)->sum('sum');
        
        // Получаем последние 5 транзакций
        $recentTransactions = $transactions->take(5);
        
        return [
            'totalBalance'       => $totalBalance,
            'totalIncome'        => $totalIncome,
            'totalExpense'       => $totalExpense,
            'recentTransactions' => $recentTransactions,
            'payments'           => $payments
        ];
    }
}
