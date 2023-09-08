<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/conta', [AccountController::class, 'consult']);
Route::post('/conta', [AccountController::class, 'store']);
Route::post('/transacao', [TransactionController::class, 'create']);
