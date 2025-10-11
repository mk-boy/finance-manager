<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Models\Payment;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     */
    public function created(Transaction $transaction): void
    {
        $payment = Payment::find($transaction->payment_id);
        $old_balance = $payment->current_balance;

        switch ($transaction->type_id) {
            case Transaction::INCOME_TYPE_ID:
                $new_balance = $old_balance + $transaction->sum;
                break;
            case Transaction::EXPENSE_TYPE_ID:
                $new_balance = $old_balance - $transaction->sum;
                break;
        }

        $payment->update([
            'current_balance' => $new_balance
        ]);
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "deleted" event.
     */
    public function deleted(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     */
    public function restored(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     */
    public function forceDeleted(Transaction $transaction): void
    {
        //
    }
}
