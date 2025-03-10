<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('users', UserController::class); //users.index , users.create
    Route::resource('menus', MenuController::class); //menus
    Route::resource('transactions', TransactionController::class); //transactions
    // Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    // Route::post('/transactions/store', [TransactionController::class, 'store'])->name('transactions.store');
    // Route::get('/transactions/history', [TransactionController::class, 'history'])->name('transactions.history');
    // Route::get('/transactions/print/{id}', [TransactionController::class, 'printReceipt'])->name('transactions.print');
});

require __DIR__.'/auth.php';
