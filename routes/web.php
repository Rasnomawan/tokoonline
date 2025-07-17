<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

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
Route::middleware(['auth'])->group(function(){
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('customers',CustomerController::class);
Route::resource('categories',CategoryController::class);
Route::resource('products',ProductController::class);
Route::get('/transactions',[TransactionController::class,'index'])->name('transactions.index');
Route::get('/transactions/buy/{product_id}',[TransactionController::class,'create'])->name('transactions.create'); //ini untuk buy
Route::post('/transactions',[TransactionController::class,'store'])->name('transactions.store');
Route::get('/transactions/{id}/edit',[TransactionController::class,'edit'])->name('transactions.edit');
Route::patch('/transactions/{id}',[TransactionController::class,'update'])->name('transactions.update');
Route::delete('/transactions/{id}',[TransactionController::class,'destroy'])->name('transactions.destroy');
Route::get('/payments',[PaymentController::class,'index'])->name('payments.index');
Route::get('/payments/create/{transaction_id}',[PaymentController::class,'create'])->name('payments.create'); //ini untuk bayar
Route::post('/payments',[PaymentController::class,'store'])->name('payments.store');
Route::get('/payments/{id}',[PaymentController::class,'show'])->name('payments.show');
Route::get('/payments/{id}/edit',[PaymentController::class,'edit'])->name('payments.edit');
Route::put('/payments/{id}',[PaymentController::class,'update'])->name('payments.update');
Route::delete('/payments/{id}',[PaymentController::class,'destroy'])->name('payments.destroy');
});

