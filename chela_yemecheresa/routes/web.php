<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\IncomeTransactionController;
use App\Http\Controllers\ExpenseTransactionController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserManagmentController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});


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


    Route::get('vendor/index',[VendorController::class,'index'])->name('vendor.index');
    Route::get('vendor/{vendor}/edit',[VendorController::class,'edit'])->name('vendor.edit');
    Route::post('vendor/store/',[VendorController::class,'store'])->name('vendor.store');
    Route::delete('vendor/delete/{vendor}',[VendorController::class,'delete'])->name('vendor.delete');
    Route::patch('vendor/update/{vendor}',[VendorController::class,'update'])->name('vendor.update');


    
    Route::get('account/{account}/edit',[AccountController::class,'edit'])->name('account.edit');
    Route::post('account/store',[AccountController::class,'store'])->name('account.store');
    Route::delete('account/delete/{account}',[AccountController::class,'delete'])->name('account.delete');
    Route::patch('account/update/{account}',[AccountController::class,'update'])->name('account.update');

   
    
  

    Route::get('/allexpense',[ExpenseTransactionController::class,'allexpense'])->name('expensetransaction.allexpense');
    Route::get('/totalexpense',[ExpenseTransactionController::class,'totalexpense'])->name('expensetransaction.totalexpense');
    Route::get('/expensetransaction/index',[ExpenseTransactionController::class,'index'])->name('expensetransaction.index');
    Route::get('/expensetransaction/{expensetransaction}/edit',[ExpenseTransactionController::class,'edit'])->name('expensetransaction.edit');
    Route::post('/expensetransaction/store/',[ExpenseTransactionController::class,'store'])->name('expensetransaction.store');
    Route::delete('/expensetransaction/delete/{expensetransaction}',[ExpenseTransactionController::class,'delete'])->name('expensetransaction.delete');
    Route::patch('/expensetransaction/update/{expensetransaction}',[ExpenseTransactionController::class,'update'])->name('expensetransaction.update');

    Route::get('/showsettings', [SettingsController::class, 'showSettings'])->name('settings.show');
});

Route::get('/allusers',[UserManagmentController::class,'allusers'])->name('usermanagment.allusers');
Route::get('/allroles',[UserManagmentController::class,'allroles'])->name('usermanagment.allroles');
Route::get('/createrole',[UserManagmentController::class,'createrole'])->name('usermanagment.createrole');
Route::post('/viewrole/{role}',[UserManagmentController::class,'viewrole'])->name('usermanagment.viewrole');
Route::post('/editrole/{role}',[UserManagmentController::class,'editrole'])->name('usermanagment.editrole');
Route::post('/updaterole/{role}',[UserManagmentController::class,'updaterole'])->name('usermanagment.updaterole');
Route::post('/deleterole/{role}',[UserManagmentController::class,'deleterole'])->name('usermanagment.deleterole');
Route::post('/registersanctum', [AuthController::class, 'register']);
Route::post('/loginsanctum', [AuthController::class, 'login']);

Route::get('account/index',[AccountController::class,'index'])->name('account.index');
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
require __DIR__.'/auth.php';
