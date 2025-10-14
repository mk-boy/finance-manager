<?php

namespace App\Http\Controllers;

use Auth;
use App\DTO\CreatePaymentDTO;
use App\DTO\UpdatePaymentDTO;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use App\Models\Currency;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{
    public function index(): View
    {
        $payments = PaymentService::getUserPayment(Auth::user());

        return view('payments.main', [
            'payments' => $payments
        ]);
    }

    public function addView(): View
    {
        $user = Auth::user();
        $currencies = Currency::all();

        return view('payments.add', [
            'userInfo' => $user,
            'currencies' => $currencies
        ]);
    }

    public function add(Request $request, PaymentService $service): RedirectResponse
    {
        $dto = CreatePaymentDTO::fromRequest($request, Auth::user());
        $response = $service->createUserPayment($dto);

        $status = $response ? 'Платеж успешно создан' : 'Ошибка при создании платежа';
        
        return redirect()->route('payments')->with('status', $status);
    }

    public function editView($payment_id): View
    {
        $user = Auth::user();
        
        if (!PaymentService::canUserAccessPayment($payment_id, $user)) {
            return redirect('/payments')->with('error', 'Нет доступа к этому платежу');
        }

        $payment = PaymentService::getUserPaymentById($payment_id, $user);
        $currencies = Currency::all();
        
        return view('payments.edit', [
            'payment' => $payment,
            'currencies' => $currencies
        ]);
    }

    public function edit(Request $request, PaymentService $service): RedirectResponse
    {
        $user = Auth::user();
        
        if (!PaymentService::canUserAccessPayment($request->payment_id, $user)) {
            return redirect('/payments')->with('error', 'Нет доступа к этому платежу');
        }

        $dto = UpdatePaymentDTO::fromRequest($request);
        $response = $service->updateUserPayment($dto);

        $status = $response ? 'Платеж успешно обновлен' : 'Ошибка при обновлении платежа';
        
        return redirect('/payments')->with('status', $status);
    }

    public function delete(Request $request, PaymentService $service): JsonResponse
    {
        $user = Auth::user();
        
        if (!PaymentService::canUserAccessPayment($request->payment_id, $user)) {
            return response()->json([
                'success' => false,
                'message' => 'Нет доступа к этому платежу'
            ], 403);
        }

        $result = $service->deleteUserPayment($request);

        return response()->json([
            'success' => $result,
            'message' => $result ? 'Счёт успешно удалён' : 'Ошибка при удалении счёта'
        ]);
    }
}