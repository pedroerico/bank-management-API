<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

Route::get('/conta', [AccountController::class, 'consult']);
Route::post('/conta', [AccountController::class, 'store']);
