<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
            'total' => $request->amount,
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

    public function addToCart(Request $request)
    {
        $item = Item::where('id', $request->item_id)->first();

        if ($item->stock < 1) {
            return redirect()->back()->with('error', 'Item out of stock');
        }

        $cart_item = Cart::where('user_id', Auth::user()->id)->where('item_id', $request->item_id)->first();
        if($cart_item) {
            $cart_item->quantity += 1;
            $cart_item->total += $request->price;
            $cart_item->save();
        } else {
            Cart::create([
                'user_id' => Auth::user()->id,
                'item_id' => $request->item_id,
                'quantity' => 1,
                'total' => $request->price,
            ]);
        }
        return redirect()->back()->with('success', 'Item added to cart');
    }

    public function cart()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        
        $total_price = 0;
        foreach($carts as $cart) {
            $total_price += $cart->total;
        }

        return view('user.cart', compact('carts', 'total_price'));
    }

    public function checkout()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        
        $total_price = 0;
        foreach($carts as $cart) {
            $total_price += $cart->total;
        }

        if(Auth::user()->wallet->balance <= $total_price) {
            return redirect()->back()->with('error', 'Insufficient balance');
        }

        $code = "CODE_".Auth::user()->id.mt_rand(100000000000, 999999999999);

        foreach($carts as $cart) {
            $transaction = Transaction::create([
                'user_id' => Auth::user()->id,
                'transaction_code' => $code,
                'item_id' => $cart->item_id,
                'quantity' => $cart->quantity,
                'total' => $cart->total,
                'type' => 2,
                'status' => 1,
            ]);
        }

        Cart::where('user_id', Auth::user()->id)->delete();

        return redirect()->back()->with('success', 'Checkout successful');
    }

    public function history()
    {
        $transactions = Transaction::where('user_id', Auth::user()->id)->get();

        return view('user.history', compact('transactions'));
    }
}
