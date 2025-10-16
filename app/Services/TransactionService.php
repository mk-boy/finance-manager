<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\DTO\CreateTransactionDTO;
use App\DTO\UpdateTransactionDTO;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\Payment;

class TransactionService
{
    public function getUserTransactions(User $user)
    {
        $transactions = Transaction::where('user_id', $user->id)
                                 ->with(['category', 'payment'])
                                 ->orderBy('created_at', 'desc')
                                 ->get();
        
        return $transactions;
    }

    public function createUserTransaction(CreateTransactionDTO $dto)
    {
        $dataArray = $dto->toArray();

        try {
            Transaction::create($dataArray);

            Log::info('Создана новая транзакция', $dataArray);

            return true;
        } catch (Exception $ex) {
            Log::error("Ошибка при создании транзакции", [
                'data_array'    => $dataArray,
                'error_message' => $ex->getMessage(),
                'error_code'    => $ex->getCode(),
                'stack_trace'   => $ex->getTraceAsString()
            ]);

            return false;
        }
    }

    public function updateUserTransaction(UpdateTransactionDTO $dto): bool
    {
        $dataArray = $dto->toArray();

        try {
            Transaction::where('id', $dto->id)->update($dataArray);

            Log::info('Обновлена транзакция', $dataArray);

            return true;
        } catch (Exception $ex) {
            Log::error("Ошибка при редактировании транзакции", [
                'data_array'    => $dataArray,
                'error_message' => $ex->getMessage(),
                'error_code'    => $ex->getCode(),
                'stack_trace'   => $ex->getTraceAsString()
            ]);

            return false;
        }
    }

    public function getUserTransactionById(int $transactionId, User $user): ?Transaction
    {
        return Transaction::where('id', $transactionId)
                         ->where('user_id', $user->id)
                         ->first();
    }

    public function deleteUserTransaction(Request $request): bool
    {
        $transaction = Transaction::find($request->transaction_id);

        if (!$transaction) {
            return false;
        }

        try {
            $transaction->delete();

            Log::info('Удалена транзакция', [
                'transaction_id' => $request->transaction_id
            ]);

            return true;
        } catch (Exception $ex) {
            Log::error("Ошибка при удалении транзакции", [
                'dataArray'     => [
                    'id'          => $transaction->id,
                    'user_id'     => $transaction->user_id,
                    'category_id' => $transaction->category_id,
                    'payment_id'  => $transaction->payment_id,
                    'type_id'     => $transaction->type_id,
                    'sum'         => $transaction->sum,
                    'description' => $transaction->description
                ],
                'error_message' => $ex->getMessage(),
                'error_code'    => $ex->getCode(),
                'stack_trace'   => $ex->getTraceAsString()
            ]);
            
            return false;
        }
    }

    public function canUserAccessTransaction(int $transactionId, User $user): bool
    {
        return Transaction::where('id', $transactionId)
                         ->where('user_id', $user->id)
                         ->exists();
    }

    public function getUserCategories(User $user)
    {
        return Category::where('user_id', $user->id)->get();
    }

    public function getUserPayments(User $user)
    {
        return Payment::where('user_id', $user->id)->with('currency')->get();
    }
}
