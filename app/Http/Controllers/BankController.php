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

    public function topup_request()
    {
        $transactions = Transaction::where('type', 1)->get();

        return view('bank.topup-request', compact('transactions'));
    }


}
