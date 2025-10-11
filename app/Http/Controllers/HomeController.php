<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        
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
        
        return view('home', compact(
            'totalBalance',
            'totalIncome', 
            'totalExpense',
            'recentTransactions',
            'payments'
        ));
    }
}
