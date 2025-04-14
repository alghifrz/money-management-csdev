<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

// Dashboard sebagai halaman utama
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Welcome route
Route::get('/welcome', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');
Route::post('/welcome', [App\Http\Controllers\WelcomeController::class, 'saveUsername'])->name('welcome.save');

// Route untuk Wallet
Route::post('/wallets', [WalletController::class, 'store'])->name('wallets.store');
Route::put('/wallets/{id}', [WalletController::class, 'update'])->name('wallets.update');
Route::delete('/wallets/{id}', [WalletController::class, 'destroy'])->name('wallets.destroy');

// Route untuk Transaction
Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
Route::put('/transactions/{id}', [TransactionController::class, 'update'])->name('transactions.update');
Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
