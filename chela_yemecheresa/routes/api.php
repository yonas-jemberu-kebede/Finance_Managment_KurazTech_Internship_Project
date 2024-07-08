


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
use App\Http\Controllers\CurrencyManagerController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\TransferTransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\IncomeTransactionCategoryController;
use App\Http\Controllers\ExpenseTransactionCategoryController;

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
    Route::get('/customer/show/{customer}',[CustomerController::class,'show'])->name('customer.show');


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

   
    
  

    Route::get('/allexpense',[ExpenseTransactionController::class,'allexpense'])->name('ExpenseTransaction.allexpense');
    Route::get('/totalexpense',[ExpenseTransactionController::class,'totalexpense'])->name('ExpenseTransaction.totalexpense');
    Route::get('expensetransaction/index',[ExpenseTransactionController::class,'index'])->name('ExpenseTransaction.index');
    Route::get('/expensetransaction/{expensetransaction}/edit',[ExpenseTransactionController::class,'edit'])->name('ExpenseTransaction.edit');
    Route::post('/expensetransaction/store',[ExpenseTransactionController::class,'store'])->name('ExpenseTransaction.store');
    Route::delete('/expensetransaction/delete/{expensetransaction}',[ExpenseTransactionController::class,'delete'])->name('ExpenseTransaction.delete');
    Route::patch('/expensetransaction/update/{expensetransaction}',[ExpenseTransactionController::class,'update'])->name('ExpenseTransaction.update');


    Route::get('/totalincome',[IncomeTransactionController::class,'totalincome'])->name('IncomeTransaction.totalincome');
    Route::get('/incometransaction/{incometransaction}/edit',[IncomeTransactionController::class,'edit'])->name('IncomeTransaction.edit');
    Route::post('/incometransaction/store',[IncomeTransactionController::class,'store'])->name('IncomeTransaction.store');
    Route::delete('/incometransaction/delete/{incometransaction}',[IncomeTransactionController::class,'delete'])->name('IncomeTransaction.delete');
    Route::put('/incometransaction/update/{incometransaction}',[IncomeTransactionController::class,'update'])->name('IncomeTransaction.update');
    Route::get('/allincome',[IncomeTransactionController::class,'allincome'])->name('IncomeTransaction.allincome');
    Route::get('/totalprofit',[IncomeTransactionController::class,'profit']);

    Route::get('/totaltransfer',[TransferTransactionController::class,'totaltransfer'])->name('IncomeTransaction.totalincome');
    Route::get('/transfertransaction/{transfertransaction}/edit',[TransferTransactionController::class,'edit'])->name('IncomeTransaction.edit');
    Route::post('/transfertransaction/store',[TransferTransactionController::class,'store'])->name('IncomeTransaction.store');
    Route::delete('/transfertransaction/delete/{transfertransaction}',[TransferTransactionController::class,'delete'])->name('IncomeTransaction.delete');
    Route::patch('/transfertransaction/update/{transfertransaction}',[TransferTransactionController::class,'update'])->name('IncomeTransaction.update');
    Route::get('/alltransfertransactions',[TransferTransactionController::class,'allExpenseTransactions'])->name('IncomeTransaction.allincome');  


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
Route::post('/setpermission',[UserManagmentController::class,'setpermission'])->name('usermanagment.setpermission');

Route::get('/allpaymentmethods',[PaymentMethodController::class,'index']);
Route::get('/paymentmethod/edit/{paymentmethod}',[PaymentMethodController::class,'edit']);
Route::patch('/paymentmethod/update/{paymentmethod}',[PaymentMethodController::class,'update']);
Route::delete('/paymentmethod/delete/{paymentmethod}',[PaymentMethodController::class,'delete']);
Route::get('/paymentmethod/view/{paymentmethod}',[PaymentMethodController::class,'view']);
Route::post('/paymentmethod/store',[PaymentMethodController::class,'store']);



Route::get('/allexpensecategories',[ExpenseTransactionCategoryController::class,'index']);
Route::get('/expensecategory/edit/{category}',[ExpenseTransactionCategoryController::class,'edit']);
Route::patch('/expensecategory/update/{category}',[ExpenseTransactionCategoryController::class,'update']);
Route::delete('/expensecategory/delete/{category}',[ExpenseTransactionCategoryController::class,'delete']);
Route::get('/expensecategory/view/{category}',[ExpenseTransactionCategoryController::class,'show']);
Route::post('/expensecategory/store',[ExpenseTransactionCategoryController::class,'store']);

Route::get('/allincomecategories',[IncomeTransactionCategoryController::class,'index']);
Route::get('/incomecategory/edit/{category}',[IncomeTransactionCategoryController::class,'edit']);
Route::patch('/incomecategory/update/{category}',[IncomeTransactionCategoryController::class,'update']);
Route::delete('/incomecategory/delete/{category}',[IncomeTransactionCategoryController::class,'delete']);
Route::get('/incomecategory/view/{category}',[IncomeTransactionCategoryController::class,'show']);
Route::post('/incomecategory/store',[IncomeTransactionCategoryController::class,'store']);

Route::get('/basecurrency',[CurrencyManagerController::class,'basecurrency']);
Route::get('/currency/all',[CurrencyManagerController::class,'index']);
Route::get('/currency/view/{currency}',[CurrencyManagerController::class,'view']);
Route::get('/currency/edit/{currency}',[CurrencyManagerController::class,'edit']);
Route::delete('/currency/delete/{currency}',[CurrencyManagerController::class,'delete']);
Route::put('/currency/update/{currency}',[CurrencyManagerController::class,'update']);
Route::post('/currency/store',[CurrencyManagerController::class,'store']);

Route::post('/incomereport',[ReportController::class,'incomereportgenerate']);
Route::post('/expensereport',[ReportController::class,'expensereportgenerate']);
Route::post('/incomevsexpensereport',[ReportController::class,'incomeVsExpenseReportGenerate']);
Route::get('/incomebycategory',[ReportController::class,'incomebycategory']);
Route::post('/incomebycustomer',[ReportController::class,'incomebycustomer']);
Route::get('/expensebycategory',[ReportController::class,'expensebycategory']);
Route::post('/expensebyvendor',[ReportController::class,'expensebyvendor']);
Route::get('/latestincome',[ReportController::class,'latestincome']);
Route::get('/latestexpense',[ReportController::class,'latestexpense']);
Route::get('/visitaccount',[ReportController::class,'visitaccount']);


Route::get('/showgeneralsetting', [SettingsController::class, 'showGeneralSettings'])->name('settings.show');
Route::get('/showemailsetting', [SettingsController::class, 'showEmailSettings'])->name('settings.show');
Route::get('/showcurrencysetting', [SettingsController::class, 'showcurrencysetting'])->name('settings.show');
Route::get('/showlogosetting', [SettingsController::class, 'showlogosettings'])->name('settings.show');
Route::get('/showcachesetting', [SettingsController::class, 'showcachesettings'])->name('settings.show');

Route::post('/updategeneralsetting', [SettingsController::class, 'updateGeneralSettings'])->name('settings.update');
Route::post('/updateemailsetting', [SettingsController::class, 'updateEmailSettings'])->name('settings.update');
Route::post('/updatecachesetting', [SettingsController::class, 'updatecachesettings'])->name('settings.update');
Route::post('/updatelogosetting', [SettingsController::class, 'updatelogosettings'])->name('settings.update');
Route::post('/updatecurrencysetting', [SettingsController::class, 'updatecurrencyettings'])->name('settings.update');

Route::patch('/updateemailsetting', [SettingsController::class, 'updateEmailSettings'])->name('settings.update');
require __DIR__.'/auth.php';

