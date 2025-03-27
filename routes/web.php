<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function() {
//     return view('pages.dashboard');
// })->name('dashboard');

// Route::get('/icons', function() {
//     return view('icon-material');
// })->name('icons');

Route::middleware(['guest'])->group(function() {
    Route::get('/login', function() {
        return view('pages.login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware(['auth'])->group(function() {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

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
    
    Route::prefix('/transaction')->name('transaction.')->group(function() {
        Route::get('/', [TransactionController::class, 'index'])->name('home');
        Route::get('/create', [TransactionController::class, 'create'])->name('create');
        Route::post('/create', [TransactionController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [TransactionController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [TransactionController::class, 'update'])->name('update');
        Route::delete('/{id}', [TransactionController::class, 'destroy'])->name('delete');

        Route::get('/create/member', [TransactionController::class, 'createMember'])->name('create-member');
        Route::post('/create/member', [TransactionController::class, 'storeMember'])->name('store-member');

        Route::get('/detail-print/{id}', [TransactionController::class, 'detailPrint'])->name('detail-print');
        Route::get('/detail-print/print/{id}', [TransactionController::class, 'print'])->name('print');

        Route::get('/export-excel', [TransactionController::class, 'exportExcel'])->name('export-excel');
    });
});