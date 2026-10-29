<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KurirController;

Route::get('/', function () {
    return redirect()->route('kurir.index');
});

Route::resource('kurir', KurirController::class)
    ->except(['show']);