<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\IncomeTransactionController;
use App\Http\Controllers\ExpenseTransactionController;
use App\Models\Account;

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

Route::middleware([''])->group(function(){
    Route::get('customer/index',[CustomerController::class,'index'])->name('customer.index');
    Route::get('customer/{customer}/edit',[CustomerController::class,'edit'])->name('customer.edit');
    Route::get('customer/{customer}/view',[CustomerController::class,'view'])->name('customer.view');
    Route::get('customer/showadd',[CustomerController::class,'showadd'])->name('customer.showadd');
    Route::post('customer/store/',[CustomerController::class,'store'])->name('customer.store');
    Route::delete('customer/delete/{customer}',[CustomerController::class,'delete'])->name('customer.delete');
    Route::patch('customer/update/{customer}',[CustomerController::class,'update'])->name('customer.update');

    Route::get('vendor/index',[VendorController::class,'index'])->name('vendor.index');
    Route::get('vendor/{vendor}/edit',[VendorController::class,'edit'])->name('vendor.edit');
    Route::get('vendor/{vendor}/view',[VendorController::class,'view'])->name('vendor.view');
    Route::get('vendor/showadd',[VendorController::class,'showadd'])->name('vendor.showadd');
    Route::post('vendor/store/',[VendorController::class,'store'])->name('vendor.store');
    Route::delete('vendor/delete/{vednor}',[VendorController::class,'delete'])->name('vendor.delete');
    Route::patch('vendor/update/{vendor}',[VendorController::class,'update'])->name('vendor.update');

    Route::get('account/index',[AccountController::class,'index'])->name('account.index');
    Route::get('account/{account}/edit',[AccountController::class,'edit'])->name('account.edit');
    Route::get('account/{account}/view',[AccountController::class,'view'])->name('account.view');
    Route::get('account/showadd',[AccountController::class,'showadd'])->name('account.showadd');  
    Route::post('account/store/',[AccountController::class,'store'])->name('account.store');
    Route::delete('account/delete/{account}',[AccountController::class,'delete'])->name('account.delete');
    Route::patch('account/update/{account}',[AccountController::class,'update'])->name('account.update');
});


Route::get('/allincome',[IncomeTransactionController::class,'allincome'])->name('incometransaction.allincome');
Route::get('/totalincome',[IncomeTransactionController::class,'totalincome'])->name('incometransaction.totalincome');
Route::get('/allexpense',[ExpenseTransactionController::class,'allexpense'])->name('transaction.expense');


require __DIR__.'/auth.php';
