<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;

class TransactionController extends Controller
{
    public function index(){
        return view('transaction.index');
    }

    public function create(){
        return view('transaction.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Check if the user is authenticated
        if (auth()->check()) {
            // Validate the request data
            $validatedData = $request->validate([
                'amount' => 'required|numeric',
                'date' => 'required|date',
                'user_id' => 'required|exists:users,id',
                'transaction_type' => 'required|in:deposit,withdrawal',
                'description' => 'nullable|string',
            ]);

            // Find the user
            $user = User::find($validatedData['user_id']);

            // Perform the transaction
            if ($validatedData['transaction_type'] == 'deposit') {
                $user->balance += $validatedData['amount'];
            } elseif ($validatedData['transaction_type'] == 'withdrawal') {
                if ($user->balance < $validatedData['amount']) {
                    return redirect()->route('transaction.index')->with('error', 'Insufficient funds for withdrawal.');
                }
                $user->balance -= $validatedData['amount'];
            }

            // Save the user and create a transaction record
            $user->save();

            $transaction = Transaction::create($validatedData);

            return redirect()->route('transaction.index')->with('success', 'Transaction added successfully');
        } else {
            // User is not authenticated, handle accordingly
            return redirect()->route('login')->with('error', 'Please login to make a transaction.');
        }
    }
}
