<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Currency;

class PaymentController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $payments = Payment::where('user_id', $user->id)
                           ->with('currency')
                           ->get();

        return view('payments.main', [
            'payments' => $payments
        ]);
    }

    public function addView()
    {
        $user = Auth::user();
        $currencies = Currency::all();

        return view('payments.add', [
            'userInfo' => $user,
            'currencies' => $currencies
        ]);
    }

    public function add(Request $request)
    {
        $user = Auth::user();

        Payment::create([
            'name' => $request->name,
            'type_id' => $request->type_id,
            'user_id' => $user->id,
            'currency_id' => $request->currency_id
        ]);

        return redirect('/payments');
    }

    public function editView($payment_id)
    {
        $payment = Payment::find($payment_id);
        $currencies = Currency::all();
        $user = Auth::user();
        
        if ($user->id == $payment->user_id) {
            return view('payments.edit', [
                'payment' => $payment,
                'currencies' => $currencies
            ]);
        } else {
            return 'Нету доступа';
        }
    }

    public function edit(Request $request)
    {
        $payment = Payment::find($request->payment_id);

        $payment->update([
            'name' => $request->name,
            'type_id' => $request->type_id,
            'currency_id' => $request->currency_id
        ]);

        return redirect('/payments');
    }

    public function delete(Request $request)
    {
        $payment = Payment::find($request->payment_id);

        $payment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Счёт успешно удалён'
        ]);
    }
}