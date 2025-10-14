<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Request;
use App\DTO\CreatePaymentDTO;
use App\DTO\UpdatePaymentDTO;
use App\Models\User;
use App\Models\Payment;

class PaymentService
{
    public static function getUserPayment(User $user)
    {
        $payments = Payment::where('user_id', $user->id)
                           ->with('currency')
                           ->get();
        
        return $payments;
    }

    public static function createUserPayment(CreatePaymentDTO $dto)
    {
        $dataArray = $dto->toArray();

        try {
            Payment::create($dataArray);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    public static function updateUserPayment(UpdatePaymentDTO $dto): bool
    {
        $dataArray = $dto->toArray();

        try {
            Payment::where('id', $dto->id)->update($dataArray);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    public static function getUserPaymentById(int $paymentId, User $user): ?Payment
    {
        return Payment::where('id', $paymentId)
                     ->where('user_id', $user->id)
                     ->first();
    }

    public static function deleteUserPayment(Request $request): bool
    {
        $payment = Payment::find($request->payment_id);

        if (!$payment) {
            return false;
        }

        try {
            $payment->delete();
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    public static function canUserAccessPayment(int $paymentId, User $user): bool
    {
        return Payment::where('id', $paymentId)
                     ->where('user_id', $user->id)
                     ->exists();
    }
}