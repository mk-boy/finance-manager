<?php

namespace App\Http\Controllers;

use Auth;
use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function expense(Request $request, ReportService $service): View
    {
        $user = Auth::user();

        $categories = $service->getUserCategories($user);

        $expenseTransactions = $service->getExpenseReport($user, $request->only(['date_from', 'date_to', 'category']));

        return view('reports.expense', [
            'transactions' => $expenseTransactions,
            'categories'   => $categories,
            'filters'      => $request->only(['date_from', 'date_to', 'category'])
        ]);
    }

    public function income(Request $request, ReportService $service): View
    {
        $user = Auth::user();

        $categories = $service->getUserCategories($user);

        $incomeTransactions = $service->getIncomeReport($user, $request->only(['date_from', 'date_to', 'category']));

        return view('reports.income', [
            'transactions' => $incomeTransactions,
            'categories'   => $categories,
            'filters'      => $request->only(['date_from', 'date_to', 'category'])
        ]);
    }

    public function summary(Request $request, ReportService $service): View
    {
        $user = Auth::user();
        $filters = $request->only(['date_from', 'date_to', 'category']);

        $totalExpenses = $service->getTotalExpenses($user, $filters);
        $totalIncome = $service->getTotalIncome($user, $filters);
        $balance = $totalIncome - $totalExpenses;

        $categories = $service->getUserCategories($user);

        return view('reports.summary', [
            'totalExpenses' => $totalExpenses,
            'totalIncome'   => $totalIncome,
            'balance'       => $balance,
            'categories'    => $categories,
            'filters'       => $filters
        ]);
    }
}