<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;

class UserController extends Controller
{
    public function store(Request $request)
    {
        if(Auth::user()->role_id != 1) {
            return redirect()->back();
        }

        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'role_id' => 'required',
        ]);

        $user = User::create($data);

        if ($request->role_id == 4) {
            Wallet::create([
                'user_id' => $user->id,
                'wallet_address' => mt_rand(100000000000, 999999999999),
                'balance' => 0,
            ]);
        }

        return redirect()->back()->with('success', 'User created successfully');
    }
    
    public function delete_user($id) {
        if(Auth::user()->role_id != 1) {
            return redirect()->back();
        }

        $user = User::find($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully');
    }

    public function wallet()
    {
        $wallet = Wallet::where('user_id', Auth::user()->id)->first();

        return view('user.wallet', compact('wallet'));
    }
}
