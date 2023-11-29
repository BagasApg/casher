<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionDetailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function(){
    Route::resource('/category', CategoryController::class);
    Route::resource('/item', ItemController::class);
    Route::get('/transaction/check', [TransactionController::class, 'check'])->name('transaction.check');
    Route::get('/transaction/flush', [TransactionController::class, 'flush'])->name('transaction.flush');
    Route::resource('/transaction', TransactionController::class);
    Route::get('/transaction/add-item/{id}', [TransactionController::class, 'addItem'])->name('transaction.add-item');
    Route::get('/transaction/remove-item/{id}', [TransactionController::class, 'removeItem'])->name('transaction.remove-item');
    
});
// Route::resource('/details', TransactionDetailController::class);
