<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\LangController;


Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [OwnerController::class, 'index'])->name('owners.index');

    Route::get('/changeLanguage/{lang}', [LangController::class, 'changeLanguage'])->name('lang.changeLanguage');


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('cars', CarController::class)->only(['index']);

    Route::group(['middleware' => [\App\Http\Middleware\SetLanguage::class]], function () {
        Route::resource('cars', CarController::class)->except(['index']);
        Route::get('/owners/create', [OwnerController::class, 'create'])->name('owners.create');
        Route::post('/owners', [OwnerController::class, 'store'])->name('owners.store');
        Route::get('/owners/{owner}', [OwnerController::class, 'edit'])->name('owners.edit');
        Route::put('owners/{owner}', [OwnerController::class, 'update'])->name('owners.update');
        Route::get('owners/{owner}/destroy', [OwnerController::class, 'destroy'])->name('owners.destroy');
        Route::get('cars/{photo}/deletePhoto', [CarController::class, 'deletePhoto'])->name('cars.deletePhoto');
    });

});




Auth::routes();
