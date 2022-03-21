<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function get_users()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
}
