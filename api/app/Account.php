<?php

namespace App;

use App\Transaction;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $guarded = [];
    protected $table = 'accounts';

    public function allTransactions()
    {
        return $this->hasMany(Transaction::class, 'from', 'id')->orWhere('to', $this->id);
    }

    public function sentTransactions()
    {
        return $this->hasMany(Transaction::class, 'from', 'id');
    }

    public function receivedTransactions()
    {
        return $this->hasMany(Transaction::class, 'to', 'id');
    }
}
