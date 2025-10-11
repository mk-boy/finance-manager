<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\Payment;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $transactions = Transaction::where('user_id', $user->id)
                                 ->with(['category', 'payment'])
                                 ->orderBy('created_at', 'desc')
                                 ->get();

        return view('transactions.main', [
            'transactions' => $transactions
        ]);
    }

    public function addView()
    {
        $user = Auth::user();
        $categories = Category::where('user_id', $user->id)->get();
        $payments = Payment::where('user_id', $user->id)->with('currency')->get();

        return view('transactions.add', [
            'userInfo' => $user,
            'categories' => $categories,
            'payments' => $payments
        ]);
    }

    public function add(Request $request)
    {
        $user = Auth::user();

        Transaction::create([
            'name' => $request->name,
            'sum' => $request->sum,
            'type_id' => $request->type_id,
            'user_id' => $user->id,
            'category_id' => $request->category_id,
            'payment_id' => $request->payment_id
        ]);

        return redirect('/transactions');
    }

    public function editView($transaction_id)
    {
        $user = Auth::user();
        $transaction = Transaction::where('id', $transaction_id)
                                 ->where('user_id', $user->id)
                                 ->first();
        
        if (!$transaction) {
            return redirect('/transactions')->with('error', 'Транзакция не найдена');
        }

        $categories = Category::where('user_id', $user->id)->get();
        $payments = Payment::where('user_id', $user->id)->with('currency')->get();

        return view('transactions.edit', [
            'transaction' => $transaction,
            'categories' => $categories,
            'payments' => $payments
        ]);
    }

    public function edit(Request $request)
    {
        $user = Auth::user();
        $transaction = Transaction::where('id', $request->transaction_id)
                                 ->where('user_id', $user->id)
                                 ->first();

        if (!$transaction) {
            return redirect('/transactions')->with('error', 'Транзакция не найдена');
        }

        $transaction->update([
            'name' => $request->name,
            'sum' => $request->sum,
            'type_id' => $request->type_id,
            'category_id' => $request->category_id,
            'payment_id' => $request->payment_id
        ]);

        return redirect('/transactions')->with('success', 'Транзакция успешно обновлена');
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        $transaction = Transaction::where('id', $request->transaction_id)
                                 ->where('user_id', $user->id)
                                 ->first();

        if ($transaction) {
            $transaction->delete();
            return response()->json([
                'success' => true,
                'message' => 'Транзакция успешно удалена'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Транзакция не найдена'
        ], 404);
    }
}