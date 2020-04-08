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
}
