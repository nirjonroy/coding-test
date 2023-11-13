<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Auth;
// Use Alert;

use RealRashid\SweetAlert\Facades\Alert;


class TransactionController extends Controller
{
    public function index(){
        $allTransaction = Transaction::where('user_id', Auth::user()->id)->get();
        $balance = User::where('id', Auth::user()->id)->first();
        // dd($allTransaction);
        return view('transaction.index', compact('allTransaction', 'balance'));
    }

    public function create(){
        return view('transaction.create');
    }

    public function store(Request $request)
    {
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

            // If the transaction type is withdrawal, apply the withdrawal fee based on account type and conditions
            if ($validatedData['transaction_type'] == 'withdrawal') {
                $withdrawalFeeRate = 0.025; // Default fee rate for business accounts

                if ($user->account_type == 'individual') {
                    // Free withdrawal conditions for individual accounts
                    $today = now();
                    $friday = $today->isFriday();
                    $firstTransactionFree = $user->transactions()->count() == 0;
                    $first1KFree = $validatedData['amount'] <= 1000;
                    $first5KFreeThisMonth = $user->transactions()
                        ->whereMonth('date', $today->month)
                        ->where('transaction_type', 'withdrawal')
                        ->sum('amount') <= 5000;

                    // Check and apply the withdrawal fee based on conditions
                    if ($friday || $firstTransactionFree || $first1KFree || $first5KFreeThisMonth) {
                        $withdrawalFeeRate = 0.0; // No fee
                    }

                    // Decrease the withdrawal fee to 0.015% for Business accounts after a total withdrawal of 50K
                    if ($user->account_type == 'business' && $user->total_withdrawal >= 50000) {
                        $withdrawalFeeRate = 0.015;
                    }
                }

                $withdrawalFee = $validatedData['amount'] * $withdrawalFeeRate;

                // Check if the user has enough balance, including the withdrawal fee
                if ($user->balance < ($validatedData['amount'] + $withdrawalFee)) {
                    return redirect()->route('transaction.index')->with('error', 'Insufficient funds for withdrawal.');
                }

                // Subtract the withdrawal amount and fee from the user's balance
                $user->balance -= ($validatedData['amount'] + $withdrawalFee);

                // Update total withdrawal amount for the user
                $user->updateTotalWithdrawal($validatedData['amount']);
            } else {
                // If it's a deposit, simply add the amount to the user's balance
                $user->balance += $validatedData['amount'];
            }

            // Save the user to persist the changes
            $user->save();

            // Create a transaction record
            $transaction = Transaction::create([
                'user_id' => $validatedData['user_id'],
                'transaction_type' => $validatedData['transaction_type'],
                'amount' => $validatedData['amount'],
                'description' => $validatedData['description'],
                'fee' => isset($withdrawalFee) ? $withdrawalFee : null,
                'date' => $validatedData['date'],
            ]);
            Alert::success('Success Title', 'Success Message');

            return redirect()->route('transaction.index')->with('success', 'Transaction added successfully');
        } else {
            // User is not authenticated, handle accordingly
            Alert::error('Error Title', 'Error Message');

            return redirect()->route('login')->with('error', 'Please login to make a transaction.');
        }
    }


}
