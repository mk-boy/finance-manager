<?php

namespace App\Http\Controllers;

use Auth;
use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function __construct(
        private readonly ReportService $service
    ) {}

    public function expense(Request $request): View
    {
        $user = Auth::user();

        $categories = $this->service->getUserCategories($user);

        $expenseTransactions = $this->service->getExpenseReport($user, $request->only(['date_from', 'date_to', 'category']));

        return view('reports.expense', [
            'transactions' => $expenseTransactions,
            'categories'   => $categories,
            'filters'      => $request->only(['date_from', 'date_to', 'category'])
        ]);
    }

    public function income(Request $request): View
    {
        $user = Auth::user();

        $categories = $this->service->getUserCategories($user);

        $incomeTransactions = $this->service->getIncomeReport($user, $request->only(['date_from', 'date_to', 'category']));

        return view('reports.income', [
            'transactions' => $incomeTransactions,
            'categories'   => $categories,
            'filters'      => $request->only(['date_from', 'date_to', 'category'])
        ]);
    }

    public function summary(Request $request): View
    {
        $user = Auth::user();
        $filters = $request->only(['date_from', 'date_to', 'category']);

        $totalExpenses = $this->service->getTotalExpenses($user, $filters);
        $totalIncome = $this->service->getTotalIncome($user, $filters);
        $balance = $totalIncome - $totalExpenses;

        $categories = $this->service->getUserCategories($user);

        return view('reports.summary', [
            'totalExpenses' => $totalExpenses,
            'totalIncome'   => $totalIncome,
            'balance'       => $balance,
            'categories'    => $categories,
            'filters'       => $filters
        ]);
    }
}