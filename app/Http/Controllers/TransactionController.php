<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function create(){
        return view('transaction.create');
    }

    public function store(Request $request){
        // dd($request->all());
         // Check if the user is authenticated
         if (auth()->check()) {
            // Validate the request data
            $validatedData = $request->validate([
                'amount' => 'required|numeric',
                'date' => 'required|date',
                'user_id' => 'required|exists:users,id',
                'transaction_type' => 'required',
                'description' => 'nullable|string',
            ]);


            // Create a new deposit record
            $deposit = Transaction::create($validatedData);

            // Additional logic if needed...

            return redirect()->route('deposit.index')->with('success', 'Deposit added successfully');
        } else {
            // User is not authenticated, handle accordingly
            return redirect()->route('login')->with('error', 'Please login to make a deposit.');
        }
    }
}
