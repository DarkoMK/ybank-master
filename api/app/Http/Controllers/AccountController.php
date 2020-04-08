<?php

namespace App\Http\Controllers;

use App\Account;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function getAccount($id)
    {
        return Account::find($id);
    }

    public function getTransactions($id)
    {
        return Account::find($id)->allTransactions()->select('id', 'from', 'to', 'details', 'amount')->get();
    }

    public function makeTransaction(Request $request, $id)
    {
        $to = $request->input('to');
        $amount = $request->input('amount');
        $details = $request->input('details');
        $fromUser = Account::find($id);
        $toUser = Account::find($to);

        if ($to !== $id && $fromUser->balance >= $amount) {
            $fromUser->update(['balance' => DB::raw('balance-' . $amount)]);
            $toUser->update(['balance' => DB::raw('balance+' . $amount)]);

            Transaction::create(
                [
                    'from' => $id,
                    'to' => $to,
                    'amount' => $amount,
                    'details' => $details
                ]
            );
        }
    }
}
