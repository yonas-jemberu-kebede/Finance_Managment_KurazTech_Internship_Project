<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

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
});

Route::middleware(['role:admin'])->group(function(){
    Route::get('customer/index',[CustomerController::class,'index'])->name('customer.index');
    Route::get('customer/{customer}/edit',[CustomerController::class,'edit'])->name('customer.edit');
    Route::post('customer/store/',[CustomerController::class,'store'])->name('customer.store');
    Route::delete('customer/delete/{customer}',[CustomerController::class,'delete'])->name('customer.delete');
    Route::patch('customer/update/{customer}',[CustomerController::class,'update'])->name('customer.update');
});

Route::get('/income',[TransactionController::class,'income'])->name('transaction.income');
Route::get('/expense',[TransactionController::class,'expense'])->name('transaction.expense');

require __DIR__.'/auth.php';
