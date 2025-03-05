<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('pages.dashboard');
})->name('dashboard');

Route::get('/icons', function() {
    return view('icon-material');
})->name('icons');

Route::middleware(['guest'])->group(function() {
    Route::get('/login', function() {
        return view('pages.login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'login']);
});

Route::prefix('/product')->name('product.')->group(function() {
    Route::get('/', [ProductController::class, 'index'])->name('home');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/create', [ProductController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [ProductController::class, 'update'])->name('update');
    Route::patch('/update-stock/{id}', [ProductController::class, 'updateStock'])->name('updateStock');
    Route::delete('/{id}', [ProductController::class, 'destroy'])->name('delete');
});

Route::prefix('/user')->name('user.')->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('home');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/create', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('delete');
});