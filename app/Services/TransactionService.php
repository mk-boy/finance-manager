<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Request;
use App\DTO\CreateTransactionDTO;
use App\DTO\UpdateTransactionDTO;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\Payment;

class TransactionService
{
    public static function getUserTransactions(User $user)
    {
        $transactions = Transaction::where('user_id', $user->id)
                                 ->with(['category', 'payment'])
                                 ->orderBy('created_at', 'desc')
                                 ->get();
        
        return $transactions;
    }

    public static function createUserTransaction(CreateTransactionDTO $dto)
    {
        $dataArray = $dto->toArray();

        try {
            Transaction::create($dataArray);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    public static function updateUserTransaction(UpdateTransactionDTO $dto): bool
    {
        $dataArray = $dto->toArray();

        try {
            Transaction::where('id', $dto->id)->update($dataArray);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    public static function getUserTransactionById(int $transactionId, User $user): ?Transaction
    {
        return Transaction::where('id', $transactionId)
                         ->where('user_id', $user->id)
                         ->first();
    }

    public static function deleteUserTransaction(Request $request): bool
    {
        $transaction = Transaction::find($request->transaction_id);

        if (!$transaction) {
            return false;
        }

        try {
            $transaction->delete();
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    public static function canUserAccessTransaction(int $transactionId, User $user): bool
    {
        return Transaction::where('id', $transactionId)
                         ->where('user_id', $user->id)
                         ->exists();
    }

    public static function getUserCategories(User $user)
    {
        return Category::where('user_id', $user->id)->get();
    }

    public static function getUserPayments(User $user)
    {
        return Payment::where('user_id', $user->id)->with('currency')->get();
    }
}
