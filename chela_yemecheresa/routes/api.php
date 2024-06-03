


<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\IncomeTransactionController;
use App\Http\Controllers\ExpenseTransactionController;
use App\Http\Controllers\SettingsController;


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

    Route::get('customer/index',[CustomerController::class,'index'])->name('customer.index');
    Route::get('customer/{customer}/edit',[CustomerController::class,'edit'])->name('customer.edit');
    Route::post('customer/store/',[CustomerController::class,'store'])->name('customer.store');
    Route::delete('customer/delete/{customer}',[CustomerController::class,'delete'])->name('customer.delete');
    Route::patch('customer/update/{customer}',[CustomerController::class,'update'])->name('customer.update');


    Route::get('vendor/index',[VendorController::class,'index'])->name('vendor.index');
    Route::get('vendor/{vendor}/edit',[VendorController::class,'edit'])->name('vendor.edit');
    Route::post('vendor/store/',[VendorController::class,'store'])->name('vendor.store');
    Route::delete('vendor/delete/{vendor}',[VendorController::class,'delete'])->name('vendor.delete');
    Route::patch('vendor/update/{vendor}',[VendorController::class,'update'])->name('vendor.update');


    
    Route::get('account/{account}/edit',[AccountController::class,'edit'])->name('account.edit');
 
    
    Route::delete('account/delete/{account}',[AccountController::class,'delete'])->name('account.delete');
    Route::patch('account/update/{account}',[AccountController::class,'update'])->name('account.update');

   
    
  

    Route::get('allexpense',[ExpenseTransactionController::class,'allexpense'])->name('expensetransaction.allexpense');
    Route::get('totalexpense',[ExpenseTransactionController::class,'totalexpense'])->name('expensetransaction.totalexpense');
    Route::get('expensetransaction/index',[ExpenseTransactionController::class,'index'])->name('expensetransaction.index');
    Route::get('expensetransaction/{expensetransaction}/edit',[ExpenseTransactionController::class,'edit'])->name('expensetransaction.edit');
    Route::post('expensetransaction/store/',[ExpenseTransactionController::class,'store'])->name('expensetransaction.store');
    Route::delete('expensetransaction/delete/{expensetransaction}',[ExpenseTransactionController::class,'delete'])->name('expensetransaction.delete');
    Route::patch('expensetransaction/update/{expensetransaction}',[ExpenseTransactionController::class,'update'])->name('expensetransaction.update');

    Route::get('/totalincome',[IncomeTransactionController::class,'totalincome'])->name('incometransaction.totalincome');
    Route::get('incometransaction/{incometransaction}/edit',[IncomeTransactionController::class,'edit'])->name('incometransaction.edit');
    Route::post('incometransaction/store',[IncomeTransactionController::class,'store'])->name('incometransaction.store');
    Route::delete('incometransaction/delete/{incometransaction}',[IncomeTransactionController::class,'delete'])->name('incometransaction.delete');
    Route::patch('incometransaction/update/{incometransaction}',[IncomeTransactionController::class,'update'])->name('incometransaction.update');
    Route::get('/allincome',[IncomeTransactionController::class,'allincome'])->name('incometransaction.allincome');

    Route::get('/showsettings', [SettingsController::class, 'showSettings'])->name('settings.show');

Route::get('account/allaccounts',[AccountController::class,'index'])->name('account.index');
Route::post('account/store',[AccountController::class,'store'])->name('account.store');
Route::get('account/showadd',[AccountController::class,'showadd'])->name('account.showadd');
Route::get('account/view/{account}',[AccountController::class,'view'])->name('account.view');
require __DIR__.'/auth.php';

