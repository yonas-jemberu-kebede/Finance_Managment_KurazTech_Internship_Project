<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseTransaction;
use App\Models\CompanyAccount;
use App\Models\ExpenseTransactionCategory;
use App\Models\Vendor;
use App\Models\TransactionCategory;
use App\Models\PaymentMethod;
use App\Models\currency_manager;

class ExpenseTransactionController extends Controller
{
    public function totalexpense()
    {
        $expense = ExpenseTransaction::all();
        $sum = $expense->sum('amount');
        return response()->json([
            'total_expense' => $sum
        ]);
    }
    

    public function allexpense()
    {
        $allExpenseTransactions = ExpenseTransaction::all();
        $jsonResponse= response()->json([
            'expensetransactions' => $allExpenseTransactions
        ]);
        $prettyPrintedJson = json_encode($jsonResponse->original, JSON_PRETTY_PRINT);

        // Return the JSON response with spaces for better readability
        return response($prettyPrintedJson)->header('Content-Type', 'application/json');
    }
    
    public function showadd(){
        return view('expensetransaction.showadd');
    }
  
    
    public function show(ExpenseTransaction $expensetransaction)
    {
        return response()->json([
            'expensetransaction' => $expensetransaction
        ]);
    }
    

    public function edit(ExpenseTransaction $expensetransaction)
    {
        return response()->json([
            'expensetransaction' => $expensetransaction
        ]);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'between:0.01,9999999999999.99'],
            //'type' => ['required', 'string', 'in:earned,passive,retirement,business,investment'],
            'reference' => ['nullable', 'string', 'max:255', 'unique:expense_transactions'],//but this reference should be always unique no matter what transaction its
            'attachment' => ['nullable', 'string', 'max:255', 'unique:expense_transactions'],
            'company_account_number' => ['required', 'exists:company_accounts,account_number'],
            'vendor_name' => ['required', 'exists:vendors,name'],
            'note' => ['nullable', 'string'],
            'payment_method_name' => ['required', 'string', 'max:255', 'exists:payment_methods,name'],
            'expense_transaction_category_name' => ['required', 'string', 'max:255', 'exists:expense_transaction_categories,name'],
            'currency_manager_name'=>'required|string|exists:currency_managers,name'
        ]);
   
    
        $enteredCurrency=currency_manager::where('name',$request->input('currency_manager_name'))->first();
        $basecurrency=currency_manager::where('is_basecurrency',true)->first();
        $amount=$request->input('amount');

       

        if($enteredCurrency->name != $basecurrency->name){
          $amount=$amount * $enteredCurrency->exchange_rate;
        }

        $vendor=Vendor::where('name',$request->input('vendor_name'))->firstOrFail();
        $payment=PaymentMethod::where('name',$request->input('payment_method_name'))->firstOrFail();
        $category=ExpenseTransactionCategory::where('name',$request->input('expense_transaction_category_name'))->firstOrFail();
        $companyAccount=CompanyAccount::where('account_number',$request->input('company_account_number'))->firstOrFail();
        
        if($amount > $companyAccount->amount){
            return response()->json(
                ["error"=>"insufficient amount"]
            );
        }
        else{
            $companyAccount->amount-=$amount;
            $companyAccount->save();
        }
       
    

        $expenseTransaction = ExpenseTransaction::create(
            [
                'amount' =>$request->input('amount'),
               // 'type' =>$request->input('type'),
                'reference' =>$request->input('reference'),
                'attachment' =>$request->input('attachment'),
                'company_account_id' => $companyAccount->id,
                'payment_method_id' => $payment->id,
                'expense_transaction_category_id' => $category->id,
                'currency_manager_id' => $enteredCurrency->id,
                'note' => $request->input('note'),
                'vendor_id' => $vendor->id,
    
            ]
        );
    
        return response()->json([
            'message' => 'Expense transaction added successfully',
            'expensetransaction' => $expenseTransaction
        ]);
    }

 public function update(Request $request, ExpenseTransaction $expensetransaction)
    {
    $validated = $request->validate([
        'amount' => ['required', 'numeric', 'between:0.01,9999999999999.99'],
        //'type' => ['required', 'string', 'in:earned,passive,retirement,business,investment'],
        'reference' => ['nullable', 'string', 'max:255', 'unique:expense_transactions'],
        'attachment' => ['nullable', 'string', 'max:255', 'unique:expense_transactions'],
        'company_account_number' => ['required', 'exists:company_accounts,account_number'],
        'vendor_name' => ['required', 'exists:vendors,name'],
        'note' => ['nullable', 'string'],
        'payment_method_name' => ['required', 'string', 'max:255', 'exists:payment_methods,name'],
        'expense_transaction_category_name' => ['required', 'string', 'max:255', 'exists:expense_transaction_categories,name'],
        'currency_manager_name'=>'required|string|exists:currency_managers,name'
    ]);
    $enteredCurrency=currency_manager::where('name',$request->input('currency_manager_name'))->first();
    $basecurrency=currency_manager::where('is_basecurrency',true)->first();
    $amount=$request->input('amount');

   

    if($enteredCurrency->name != $basecurrency->name){
      $amount=$amount * $enteredCurrency->exchange_rate;
    }


    $companyAccount = CompanyAccount::where('account_number', $request->input('company_account_number'))->firstOrFail();
    $vendor = Vendor::where('name', $request->input('vendor_name'))->firstOrFail();
    $payment=PaymentMethod::where('name',$request->input('payment_method_name'))->firstOrFail();
    $category=ExpenseTransactionCategory::where('name',$request->input('expense_transaction_category_name'))->firstOrFail();
    // Update the company account balance
    $previousexpense=$expensetransaction->amount;//becaues during update we are using the id in the method so,we can directly access the amount without using the model
    $companyAccount->amount+=$previousexpense;
  
    if($amount > $companyAccount->current_balance){
        return response()->json(
            ["error"=>"insufficient amount"]
        );
    }
    else{
        $companyAccount->amount-=$amount;
        $companyAccount->save();
    }

    // Create the new income transaction
    $updatedExpense = $expensetransaction->update([
        'amount' => $request->input('amount'),
       // 'type' => $request->input('type'),i commented it because we can substitue it income_transaction_category_name
        'reference' => $request->input('reference'),
        'attachment' => $request->input('attachment'),
        'company_account_id' => $companyAccount->id,
        'vendor_id' => $vendor->id,
        'payment_method_id' => $payment->id,
        'expense_transaction_category_id' => $category->id,
        'currency_manager_id' => $enteredCurrency->id,
        'note' => $request->input('note')
    ]);

    return response()->json([
        'message' => 'expense transaction updated successfully',
        'income_transaction' => $updatedExpense
    ]);
}

  

public function delete(Request $request, ExpenseTransaction $expensetransaction)
{
    $companyaccount=CompanyAccount::where('id',1)->firstOrFail();
    $companyaccount->amount+=$expensetransaction->amount;
    $companyaccount->save();
    
    $expensetransaction->delete();
    return response()->json([
        'message' => 'Expense transaction information deleted successfully!'
    ]);
}}


