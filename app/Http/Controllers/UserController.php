<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class UserController extends Controller
{
    public function wallet()
    {
        $wallet = Wallet::where('user_id', Auth::user()->id)->first();

        return view('user.wallet', compact('wallet'));
    }

    public function topup_request(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric',
        ]);

        $transaction = Transaction::create([
            'user_id' => Auth::user()->id,
            'transaction_code' => "CODE_".Auth::user()->id.mt_rand(100000000000, 999999999999),
            'amount' => $request->amount,
            'type' => 1,
            'status' => 1,
        ]);

        return redirect()->back()->with('success', 'Topup request sent');
    }

    public function shop()
    {
        $items = Item::all();

        return view('user.shop', compact('items'));
    }
}
