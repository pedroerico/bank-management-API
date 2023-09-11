<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\ExceptionHandlerMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'conta', 'middleware' => ExceptionHandlerMiddleware::class], function () {
    Route::get('/', [AccountController::class, 'consult']);
    Route::post('/', [AccountController::class, 'store']);
});
Route::post('/transacao', [TransactionController::class, 'create']);
