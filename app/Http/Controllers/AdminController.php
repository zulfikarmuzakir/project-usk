<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function get_users()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function store_user(Request $request)
    {
        if(Auth::user()->role_id != 1) {
            return redirect()->back();
        }
        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'role_id' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
        ]);

        if ($request->role_id == 4) {
            Wallet::create([
                'user_id' => $user->id,
                'wallet_address' => mt_rand(100000000000, 999999999999),
                'balance' => 0,
            ]);
        }

        return redirect()->back()->with('success', 'User created successfully');
    }

    public function delete_user($id)
    {
        if(Auth::user()->role_id != 1) {
            return redirect()->back();
        }

        $user = User::find($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully');
    }

    public function update_user(Request $request, $id)
    {
        if(Auth::user()->role_id != 1) {
            return redirect()->back();
        }

        $user = User::find($id);

        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role_id' => 'required',
        ]);

        $user->update($data);

        return redirect()->back()->with('success', 'User updated successfully');
    }
}
