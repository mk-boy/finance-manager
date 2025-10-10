<?php

namespace App\Observers;

use App\Models\Payment;
use App\Models\PaymentChangesHistory;

class PaymentObserver
{
    /**
     * Handle the Payment "created" event.
     */
    public function created(Payment $payment): void
    {
        //
    }

    /**
     * Handle the Payment "updated" event.
     */
    public function updated(Payment $payment): void
    {
        //
    }

    public function updating(Payment $payment): void
    {
        $changes_fields = $payment->getDirty();

        if (array_key_exists('current_balance', $changes_fields)) {
            $old_balance = $payment->getOriginal('current_balance');
            
            PaymentChangesHistory::create([
                'payment_id' => $payment->id,
                'old_value'  => $old_balance
            ]);
        }
    }

    /**
     * Handle the Payment "deleted" event.
     */
    public function deleted(Payment $payment): void
    {
        //
    }

    /**
     * Handle the Payment "restored" event.
     */
    public function restored(Payment $payment): void
    {
        //
    }

    /**
     * Handle the Payment "force deleted" event.
     */
    public function forceDeleted(Payment $payment): void
    {
        //
    }
}
