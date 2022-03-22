<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'transaction_code',
        'type',
        'status',
        'total',
        'quantity'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wallet()
    {
        return $this->hasOneThrough(Wallet::class, User::class, 'id', 'user_id', 'user_id', 'id');
    }
}
