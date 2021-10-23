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

Route::get('users', function () {
    return "sdads";
});

Route::post('bank-accounts',Bank\CreateBankAccountController::class);
Route::get('bank-accounts',Bank\GetBankAccountsController::class);
Route::get('bank-accounts/{bankAccountNumber}',Bank\GetBankAccountController::class);
Route::post('deposit-money',Bank\DepositMoneyController::class);
Route::post('extract-money',Bank\ExtractMoneyController::class);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
