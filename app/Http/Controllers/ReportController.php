<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function expense(Request $request)
    {
        $user = Auth::user();

        // Получаем все категории для фильтра
        $categories = Category::where('user_id', $user->id)->get();

        // Базовый запрос для расходов
        $expenseQuery = Transaction::where('user_id', $user->id)
                                  ->where('type_id', Transaction::EXPENSE_TYPE_ID)
                                  ->with('category');

        // Применяем фильтры
        if ($request->has('date_from') && $request->date_from) {
            $expenseQuery->where('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $expenseQuery->where('created_at', '<=', $request->date_to . ' 23:59:59');
        }

        if ($request->has('category') && $request->category !== 'all') {
            $expenseQuery->where('category_id', $request->category);
        }

        // Группируем по категориям и суммируем
        $allExpenseTransactions = $expenseQuery->selectRaw('category_id, SUM(sum) as category_sum')
                                               ->groupBy('category_id')
                                               ->get();

        return view('reports.expense', [
            'transactions' => $allExpenseTransactions,
            'categories' => $categories,
            'filters' => $request->only(['date_from', 'date_to', 'category'])
        ]);
    }
}