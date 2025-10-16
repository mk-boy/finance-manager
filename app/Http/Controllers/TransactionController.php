<?php

namespace App\Http\Controllers;

use Auth;
use App\DTO\CreateTransactionDTO;
use App\DTO\UpdateTransactionDTO;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TransactionController extends Controller
{
    public function __construct(
        private readonly TransactionService $service
    ) {}

    public function index(): View
    {
        $transactions = $this->service->getUserTransactions(Auth::user());

        return view('transactions.main', [
            'transactions' => $transactions
        ]);
    }

    public function addView(): View
    {
        $user = Auth::user();
        $categories = $this->service->getUserCategories($user);
        $payments = $this->service->getUserPayments($user);

        return view('transactions.add', [
            'userInfo'   => $user,
            'categories' => $categories,
            'payments'   => $payments
        ]);
    }

    public function add(Request $request): RedirectResponse
    {
        $dto = CreateTransactionDTO::fromRequest($request, Auth::user());
        $response = $this->service->createUserTransaction($dto);

        $status = $response ? 'Транзакция успешно создана' : 'Ошибка при создании транзакции';
        
        return redirect()->route('transactions')->with('status', $status);
    }

    public function editView($transaction_id): View
    {
        $user = Auth::user();
        
        if (!$this->service->canUserAccessTransaction($transaction_id, $user)) {
            return redirect('/transactions')->with('error', 'Нет доступа к этой транзакции');
        }

        $transaction = $this->service->getUserTransactionById($transaction_id, $user);
        $categories = $this->service->getUserCategories($user);
        $payments = $this->service->getUserPayments($user);

        return view('transactions.edit', [
            'transaction' => $transaction,
            'categories'  => $categories,
            'payments'    => $payments
        ]);
    }

    public function edit(Request $request): RedirectResponse
    {
        $user = Auth::user();
        
        if (!$this->service->canUserAccessTransaction($request->transaction_id, $user)) {
            return redirect('/transactions')->with('error', 'Нет доступа к этой транзакции');
        }

        $dto = UpdateTransactionDTO::fromRequest($request);
        $response = $this->service->updateUserTransaction($dto);

        $status = $response ? 'Транзакция успешно обновлена' : 'Ошибка при обновлении транзакции';
        
        return redirect('/transactions')->with('status', $status);
    }

    public function delete(Request $request): JsonResponse
    {
        $user = Auth::user();
        
        if (!$this->service->canUserAccessTransaction($request->transaction_id, $user)) {
            return response()->json([
                'success' => false,
                'message' => 'Нет доступа к этой транзакции'
            ], 403);
        }

        $result = $this->service->deleteUserTransaction($request);

        return response()->json([
            'success' => $result,
            'message' => $result ? 'Транзакция успешно удалена' : 'Ошибка при удалении транзакции'
        ]);
    }
}