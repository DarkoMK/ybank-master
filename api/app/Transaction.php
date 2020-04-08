<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];
    protected $table = 'transactions';

    public function sender()
    {
        return $this->belongsTo(Account::class, 'from', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(Account::class, 'to', 'id');
    }
}
