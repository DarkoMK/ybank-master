<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function getAccount($id)
    {
        return Account::find($id);
    }

    public function getTransactions($id)
    {
        return Account::find($id)->allTransactions()->get();
    }
}
