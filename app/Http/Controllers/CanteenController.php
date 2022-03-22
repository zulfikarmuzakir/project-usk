<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Auth;

class CanteenController extends Controller
{
    public function items()
    {
        $items = Item::all();

        return view('canteen.items.index', compact('items'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'stock' => 'required|numeric',
        ]);

        $image = $request->file('image');
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $image_name);

        Item::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'image' => $image_name,
        ]);

        return redirect()->back()->with('success', 'Item created successfully');
    }

    public function update(Request $request, $id)
    {
        $item = Item::find($id);

        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'stock' => 'required|numeric',
            'image' => 'required',
        ]);

        $item->name = $request->name;
        $item->price = $request->price;
        $item->description = $request->description;
        $item->stock = $request->stock;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
            $item->image = $image_name;
        }
        $item->save();

        return redirect()->back()->with('success', 'Item updated successfully');
    }
    
    public function delete($id)
    {
        $item = Item::find($id);

        $item->delete();

        return redirect()->back()->with('success', 'Item deleted successfully');
    }

    public function transaction_history()
    {
        $transactions = Transaction::where("type", 2)->get();

        return view('canteen.transactions.index', compact('transactions'));
    }

    public function orders()
    {
        $transactions = Transaction::where("type", 2)->where('status', 1)->groupBy('transaction_code')->get();

        return view('canteen.orders', compact('transactions'));
    }

    public function approve_order(Request $request)
    {
        $transactions = Transaction::where("transaction_code", $request->transaction_code)->get();
        $user_id = $transactions[0]->user_id;
        $total_price = $transactions->sum('total');
        
        foreach($transactions as $transaction) {
            $transaction->status = 3;
            $transaction->save();
        }        

        $wallet = Wallet::where('user_id', $user_id)->first();
        $wallet->balance -= $total_price; 
        $wallet->save();

        $canteen_wallet = Wallet::where('user_id', Auth::user()->id)->first();
        $canteen_wallet->balance += $total_price;
        $canteen_wallet->save();
     
        return redirect()->back()->with('success', 'Order approved');
    }

    public function reject_order($id)
    {
        $transaction = Transaction::find($id);
        $transaction->status = 2;
        $transaction->save();

        return redirect()->back()->with('success', 'Order rejected');
    }

    public function history()
    {
        $transactions = Transaction::where("type", 2)->get();

        return view('canteen.history', compact('transactions'));
    }
}
