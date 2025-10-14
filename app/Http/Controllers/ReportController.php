<?php

namespace App\Http\Controllers;

use Auth;
use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function expense(Request $request): View
    {
        $user = Auth::user();

        $categories = ReportService::getUserCategories($user);

        $expenseTransactions = ReportService::getExpenseReport($user, $request->only(['date_from', 'date_to', 'category']));

        return view('reports.expense', [
            'transactions' => $expenseTransactions,
            'categories' => $categories,
            'filters' => $request->only(['date_from', 'date_to', 'category'])
        ]);
    }

    public function income(Request $request): View
    {
        $user = Auth::user();

        $categories = ReportService::getUserCategories($user);

        $incomeTransactions = ReportService::getIncomeReport($user, $request->only(['date_from', 'date_to', 'category']));

        return view('reports.income', [
            'transactions' => $incomeTransactions,
            'categories' => $categories,
            'filters' => $request->only(['date_from', 'date_to', 'category'])
        ]);
    }

    public function summary(Request $request): View
    {
        $user = Auth::user();
        $filters = $request->only(['date_from', 'date_to', 'category']);

        $totalExpenses = ReportService::getTotalExpenses($user, $filters);
        $totalIncome = ReportService::getTotalIncome($user, $filters);
        $balance = $totalIncome - $totalExpenses;

        $categories = ReportService::getUserCategories($user);

        return view('reports.summary', [
            'totalExpenses' => $totalExpenses,
            'totalIncome' => $totalIncome,
            'balance' => $balance,
            'categories' => $categories,
            'filters' => $filters
        ]);
    }
}