<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
*/
Route::get('accounts/{id}', 'AccountController@getAccount');
Route::get('accounts/{id}/transactions', 'AccountController@getTransactions');
Route::post('accounts/{id}/transactions', 'AccountController@makeTransaction');

//Route::get('currencies', function () {
//    $account = DB::table('currencies')
//              ->get();
//
//    return $account;
//}); //does not exist
