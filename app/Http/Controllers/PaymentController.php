<?php

namespace App\Http\Controllers;

use Auth;
use App\DTO\CreatePaymentDTO;
use App\DTO\UpdatePaymentDTO;
use App\Http\Requests\CreatePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use App\Models\Currency;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{
    public function __construct(
        private readonly PaymentService $service
    ) {}

    public function index(): View
    {
        $payments = $this->service->getUserPayment(Auth::user());

        return view('payments.main', [
            'payments' => $payments
        ]);
    }

    public function addView(): View
    {
        $user = Auth::user();
        $currencies = Currency::all();

        return view('payments.add', [
            'userInfo'   => $user,
            'currencies' => $currencies
        ]);
    }

    public function add(CreatePaymentRequest $request): RedirectResponse
    {
        $dto = CreatePaymentDTO::fromRequest($request, Auth::user());
        $response = $this->service->createUserPayment($dto);

        $status = $response ? 'Платеж успешно создан' : 'Ошибка при создании платежа';
        
        return redirect()->route('payments')->with('status', $status);
    }

    public function editView($payment_id): View
    {
        $user = Auth::user();
        
        if (!$this->service->canUserAccessPayment($payment_id, $user)) {
            return redirect('/payments')->with('error', 'Нет доступа к этому платежу');
        }

        $payment = $this->service->getUserPaymentById($payment_id, $user);
        $currencies = Currency::all();
        
        return view('payments.edit', [
            'payment'    => $payment,
            'currencies' => $currencies
        ]);
    }

    public function edit(UpdatePaymentRequest $request): RedirectResponse
    {
        $user = Auth::user();
        
        if (!$this->service->canUserAccessPayment($request->payment_id, $user)) {
            return redirect('/payments')->with('error', 'Нет доступа к этому платежу');
        }

        $dto = UpdatePaymentDTO::fromRequest($request);
        $response = $this->service->updateUserPayment($dto);

        $status = $response ? 'Платеж успешно обновлен' : 'Ошибка при обновлении платежа';
        
        return redirect('/payments')->with('status', $status);
    }

    public function delete(Request $request): JsonResponse
    {
        $user = Auth::user();
        
        if (!$this->service->canUserAccessPayment($request->payment_id, $user)) {
            return response()->json([
                'success' => false,
                'message' => 'Нет доступа к этому платежу'
            ], 403);
        }

        $result = $this->service->deleteUserPayment($request);

        return response()->json([
            'success' => $result,
            'message' => $result ? 'Счёт успешно удалён' : 'Ошибка при удалении счёта'
        ]);
    }
}