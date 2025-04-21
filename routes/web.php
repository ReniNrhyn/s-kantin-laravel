<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Group middleware untuk autentikasi
Route::middleware('auth')->group(function () {
    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Management
    Route::resource('users', UserController::class);

    // Menu Management
    // Route::resource('menus', MenuController::class);
    Route::resource('menus', MenuController::class)->middleware(['auth']);

    // Transaction Management
    Route::resource('transactions', TransactionController::class);

    Route::resource('categories', CategoryController::class);

    // // Cetak Struk
    // Route::get('/transactions/{transaction}/print', [TransactionController::class, 'print'])->name('transactions.print');

    // Route::resource('categories', CategoryController::class)->middleware('auth');

});

// Include authentication routes
require __DIR__.'/auth.php';
