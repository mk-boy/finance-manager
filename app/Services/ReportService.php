<?php

namespace App\Services;

use App\Models\User;
use App\Models\Transaction;
use App\Models\Category;

class ReportService
{
    public function getUserCategories(User $user)
    {
        return Category::where('user_id', $user->id)->get();
    }

    public function getExpenseReport(User $user, array $filters = [])
    {
        $expenseQuery = Transaction::where('user_id', $user->id)
                                  ->where('type_id', Transaction::EXPENSE_TYPE_ID)
                                  ->with('category');

        if (isset($filters['date_from']) && $filters['date_from']) {
            $expenseQuery->where('created_at', '>=', $filters['date_from']);
        }

        if (isset($filters['date_to']) && $filters['date_to']) {
            $expenseQuery->where('created_at', '<=', $filters['date_to'] . ' 23:59:59');
        }

        if (isset($filters['category']) && $filters['category'] !== 'all') {
            $expenseQuery->where('category_id', $filters['category']);
        }

        $expenseTransactions = $expenseQuery->selectRaw('category_id, SUM(sum) as category_sum')
                                           ->groupBy('category_id')
                                           ->get();

        return $expenseTransactions;
    }

    public function getIncomeReport(User $user, array $filters = [])
    {
        $incomeQuery = Transaction::where('user_id', $user->id)
                                 ->where('type_id', Transaction::INCOME_TYPE_ID)
                                 ->with('category');

        if (isset($filters['date_from']) && $filters['date_from']) {
            $incomeQuery->where('created_at', '>=', $filters['date_from']);
        }

        if (isset($filters['date_to']) && $filters['date_to']) {
            $incomeQuery->where('created_at', '<=', $filters['date_to'] . ' 23:59:59');
        }

        if (isset($filters['category']) && $filters['category'] !== 'all') {
            $incomeQuery->where('category_id', $filters['category']);
        }

        $incomeTransactions = $incomeQuery->selectRaw('category_id, SUM(sum) as category_sum')
                                          ->groupBy('category_id')
                                          ->get();

        return $incomeTransactions;
    }

    public function getTotalExpenses(User $user, array $filters = [])
    {
        $query = Transaction::where('user_id', $user->id)
                           ->where('type_id', Transaction::EXPENSE_TYPE_ID);

        if (isset($filters['date_from']) && $filters['date_from']) {
            $query->where('created_at', '>=', $filters['date_from']);
        }

        if (isset($filters['date_to']) && $filters['date_to']) {
            $query->where('created_at', '<=', $filters['date_to'] . ' 23:59:59');
        }

        if (isset($filters['category']) && $filters['category'] !== 'all') {
            $query->where('category_id', $filters['category']);
        }

        return $query->sum('sum');
    }

    public function getTotalIncome(User $user, array $filters = [])
    {
        $query = Transaction::where('user_id', $user->id)
                           ->where('type_id', Transaction::INCOME_TYPE_ID);

        if (isset($filters['date_from']) && $filters['date_from']) {
            $query->where('created_at', '>=', $filters['date_from']);
        }

        if (isset($filters['date_to']) && $filters['date_to']) {
            $query->where('created_at', '<=', $filters['date_to'] . ' 23:59:59');
        }

        if (isset($filters['category']) && $filters['category'] !== 'all') {
            $query->where('category_id', $filters['category']);
        }

        return $query->sum('sum');
    }
}
