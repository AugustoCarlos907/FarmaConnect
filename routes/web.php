<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FarmaciaController;
use Illuminate\Support\Facades\Route;

    

Route::middleware(['guest'])->group(function(){

    Route::get('/', function(){
        return view('index');
    })->name('index');


    Route::get('/register', [AuthController::class, 'create'])->name('register');
    Route::post('/register', [AuthController::class, 'store']);

    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function () {
        return view('auth.verify-email');
    })->middleware(['auth', 'signed'])->name('verification.verify');
    
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
});



    //farmacias

    Route::get('farmacias/dashboard', [FarmaciaController::class , 'dashboard'])->name('index.farmacias');
    
    //entregadores


    //clientes