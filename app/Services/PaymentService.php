<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\DTO\CreatePaymentDTO;
use App\DTO\UpdatePaymentDTO;
use App\Models\User;
use App\Models\Payment;

class PaymentService
{
    public function getUserPayment(User $user)
    {
        $payments = Payment::where('user_id', $user->id)
                           ->with('currency')
                           ->get();
        
        return $payments;
    }

    public function createUserPayment(CreatePaymentDTO $dto)
    {
        $dataArray = $dto->toArray();

        try {
            Payment::create($dataArray);

            Log::info('Создан новый счёт', $dataArray);

            return true;
        } catch (Exception $ex) {
            Log::error("Ошибка при создании счёта", [
                'data_array'    => $dataArray,
                'error_message' => $ex->getMessage(),
                'error_code'    => $ex->getCode(),
                'stack_trace'   => $ex->getTraceAsString()
            ]);
            return false;
        }
    }

    public function updateUserPayment(UpdatePaymentDTO $dto): bool
    {
        $dataArray = $dto->toArray();

        try {
            Payment::where('id', $dto->id)->update($dataArray);

            Log::info('Обновлён счёт', $dataArray);

            return true;
        } catch (Exception $ex) {
            Log::error("Ошибка при редактировании счёта", [
                'data_array'    => $dataArray,
                'error_message' => $ex->getMessage(),
                'error_code'    => $ex->getCode(),
                'stack_trace'   => $ex->getTraceAsString()
            ]);

            return false;
        }
    }

    public function getUserPaymentById(int $paymentId, User $user): ?Payment
    {
        return Payment::where('id', $paymentId)
                     ->where('user_id', $user->id)
                     ->first();
    }

    public function deleteUserPayment(Request $request): bool
    {
        $payment = Payment::find($request->payment_id);

        if (!$payment) {
            return false;
        }

        try {
            $payment->delete();

            Log::info('Удалён счёт', [
                'payment_id' => $request->payment_id
            ]);

            return true;
        } catch (Exception $ex) {
            Log::error("Ошибка при удалении счёта", [
                'dataArray'     => [
                    'id'              => $payment->id,
                    'user_id'         => $payment->user_id,
                    'currency_id'     => $payment->currency_id,
                    'name'            => $payment->name,
                    'description'     => $payment->description,
                    'current_balance' => $payment->current_balance
                ],
                'error_message' => $ex->getMessage(),
                'error_code'    => $ex->getCode(),
                'stack_trace'   => $ex->getTraceAsString()
            ]);
            
            return false;
        }
    }

    public function canUserAccessPayment(int $paymentId, User $user): bool
    {
        return Payment::where('id', $paymentId)
                     ->where('user_id', $user->id)
                     ->exists();
    }
}