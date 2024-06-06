


<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

    Route::get('/customer/index',[CustomerController::class,'index'])->name('customer.index');
    Route::get('/customer/{customer}/edit',[CustomerController::class,'edit'])->name('customer.edit');
    
    Route::post('/customer/store',[CustomerController::class,'store'])->name('customer.store');
    
    Route::delete('/customer/delete/{customer}',[CustomerController::class,'delete'])->name('customer.delete');
    Route::patch('/customer/update/{customer}',[CustomerController::class,'update'])->name('customer.update');


    Route::get('vendor/index',[VendorController::class,'index'])->name('vendor.index');
    Route::get('vendor/{vendor}/edit',[VendorController::class,'edit'])->name('vendor.edit');
    Route::post('/vendor/store/',[VendorController::class,'store'])->name('vendor.store');
    Route::delete('vendor/delete/{vendor}',[VendorController::class,'delete'])->name('vendor.delete');
    Route::patch('vendor/update/{vendor}',[VendorController::class,'update'])->name('vendor.update');


    
 Route::get('account/index',[AccountController::class,'index'])->name('account.index');
 Route::post('/account/store',[AccountController::class,'store'])->name('account.store');
 Route::get('/account/showadd',[AccountController::class,'showadd'])->name('account.showadd');
 Route::get('/account/view/{account}',[AccountController::class,'view'])->name('account.view');
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
    Route::delete('/incometransaction/delete/{incometransaction}',[IncomeTransactionController::class,'delete'])->name('incometransaction.delete');
    Route::patch('incometransaction/update/{incometransaction}',[IncomeTransactionController::class,'update'])->name('incometransaction.update');
    Route::get('/allincome',[IncomeTransactionController::class,'allincome'])->name('incometransaction.allincome');

  


Route::get('/allusers',[UserManagmentController::class,'allusers'])->name('usermanagment.allusers');
Route::post('/registersanctum', [AuthController::class, 'register']);
Route::post('/loginsanctum', [AuthController::class, 'login']);
Route::post('/logoutsanctum', [AuthController::class, 'logout'])->middleware('auth:sanctum');
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {return $request->user();});
Route::get('/viewuser/{user}',[UserManagmentController::class,'viewuser'])->name('usermanagment.viewuser');
Route::get('/edituser/{user}',[UserManagmentController::class,'edituser'])->name('usermanagment.edituser');
Route::put('/updateuser/{user}',[UserManagmentController::class,'updateuser'])->name('usermanagment.updateuser');
Route::delete('/deleteuser/{user}',[UserManagmentController::class,'deleteuser'])->name('usermanagment.deleteuser');

Route::get('/allroles',[UserManagmentController::class,'allroles'])->name('usermanagment.allroles');
Route::get('/createrole',[UserManagmentController::class,'createrole'])->name('usermanagment.createrole');
Route::post('/storerole',[UserManagmentController::class,'storerole'])->name('usermanagment.storerole');
Route::get('/viewrole/{role}',[UserManagmentController::class,'viewrole'])->name('usermanagment.viewrole');
Route::get('/editrole/{role}',[UserManagmentController::class,'editrole'])->name('usermanagment.editrole');
Route::put('/updaterole/{role}',[UserManagmentController::class,'updaterole'])->name('usermanagment.updaterole');
Route::delete('/deleterole/{role}',[UserManagmentController::class,'deleterole'])->name('usermanagment.deleterole');



Route::get('/showgeneralsetting', [SettingsController::class, 'showGeneralSettings'])->name('settings.show');
Route::patch('/updategeneralsetting', [SettingsController::class, 'updateGeneralSettings'])->name('settings.update');

Route::get('/showemailsetting', [SettingsController::class, 'showEmailSettings'])->name('settings.show');
Route::patch('/updateemailsetting', [SettingsController::class, 'updateEmailSettings'])->name('settings.update');
require __DIR__.'/auth.php';

