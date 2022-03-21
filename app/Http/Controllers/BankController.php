<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        return view('bank.index');
    }
    
    public function topup()
    {
        return view('bank.topup');
    }

    public function new_topup(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric',
            'wallet_address' => 'required',
        ]);

        $wallet = Wallet::where('wallet_address', $request->wallet_address)->first();

        $wallet->balance += $request->amount;
        $wallet->save();

        $transaction = Transaction::create([
            'user_id' => $wallet->user_id,
            'transaction_code' => "CODE_".$wallet->user_id.mt_rand(100000000000, 999999999999),
            'amount' => $request->amount,
            'type' => 1,
            'status' => 3,
        ]);

        return redirect()->back()->with('success', 'Topup successful');
    }

    public function topup_request()
    {
        $transactions = Transaction::where('type', 1)->where('status', 1)->get();

        return view('bank.topup-request', compact('transactions'));
    }


}
