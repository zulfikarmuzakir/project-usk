<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Transaction;

class TopupController extends Controller
{
    public function create()
    {
        return view('topup.topup');
    }

    public function topup(Request $request)
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
            'total' => $request->amount,
            'type' => 1,
            'status' => 3,
        ]);

        return redirect()->back()->with('success', 'Topup successful');
    }

    public function topup_request()
    {
        $transactions = Transaction::where('type', 1)->where('status', 1)->get();

        return view('topup.request', compact('transactions'));
    }

    public function topup_approve($id)
    {
        $transaction = Transaction::find($id);
        $transaction->status = 3;
        $transaction->save();

        $wallet = Wallet::where('user_id', $transaction->user_id)->first();
        $wallet->balance += $transaction->total;
        $wallet->save();

        return redirect()->back()->with('success', 'Topup approved');
    }
    
    public function topup_reject($id)
    {
        $transaction = Transaction::find($id);
        $transaction->status = 2;
        $transaction->save();

        return redirect()->back()->with('success', 'Topup rejected');
    }

    public function history()
    {
        $transactions = Transaction::where('type', 1)->get();

        return view('topup.history', compact('transactions'));
    }
}
