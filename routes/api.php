<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('v1.')->group(function () {
    Route::prefix('speedtest')->name('speedtest.')->group(function () {
        Route::post('/', [ApiController::class, 'create'])->name('create');
    });
});
