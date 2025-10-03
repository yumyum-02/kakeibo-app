<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomebudgetController;

Route::get('/', function () {
    return view('homebudget.index');
});

Route::get('/',[HomebudgetController::class, 'index'])->name('index');
Route::post('/',[HomebudgetController::class, 'store'])->name('store');