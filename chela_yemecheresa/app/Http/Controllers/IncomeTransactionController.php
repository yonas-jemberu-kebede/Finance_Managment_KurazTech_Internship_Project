<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncomeTransaction;
use App\Models\ExpenseTransaction;
use App\Models\PaymentMethod;
use App\Models\IncomeTransactionCategory;
use App\Models\CompanyAccount;
use App\Models\currency_manager;
use App\Models\Customer;


class IncomeTransactionController extends Controller
{
    public function totalincome()
    {
        $income = IncomeTransaction::all();
        $sum = $income->sum('amount');
        $jsonResponse =response()->json([
            'total_income' => $sum
        ]);
        $prettyPrintedJson = json_encode($jsonResponse->original, JSON_PRETTY_PRINT);

        // Return the JSON response with spaces for better readability
        return response($prettyPrintedJson)->header('Content-Type', 'application/json');
    }
public function profit(){
    $income=IncomeTransaction::all();
    $totalincome=$income->sum('amount');

   $expense=ExpenseTransaction::all();
    $totalexpense=$expense->sum('amount');

    $profit=$totalincome-$totalexpense;

    return response()->json([
        'total profit'=>$profit
    ]);
}
    public function allincome()
    {
        $allIncomeTransactions = IncomeTransaction::all();
        $jsonResponse =response()->json([
            'incometransactions' => $allIncomeTransactions
        ]);
        $prettyPrintedJson = json_encode($jsonResponse->original, JSON_PRETTY_PRINT);

        // Return the JSON response with spaces for better readability
        return response($prettyPrintedJson)->header('Content-Type', 'application/json');
    }
    public function showadd(){
        return view('incometransaction.showadd');
    }
  
    
    public function show(IncomeTransaction $incometransaction)
    {
        return response()->json([
            'incometransaction' => $incometransaction
        ]);
    }

    public function edit(IncomeTransaction $incometransaction)
    {
        return response()->json([
            'incometransaction' => $incometransaction
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'between:0.01,9999999999999.99'],
            //'type' => ['required', 'string', 'in:earned,passive,retirement,business,investment'],
            'reference' => ['nullable', 'string', 'max:255', 'unique:income_transactions'],
            'attachment' => ['nullable', 'string', 'max:255', 'unique:income_transactions'],
            'company_account_number' => ['required', 'exists:company_accounts,account_number'],
            'customer_name' => ['required', 'exists:customers,name'],
            'note' => ['nullable', 'string'],
            'payment_method_name' => ['required', 'string', 'max:255', 'exists:payment_methods,name'],
            'income_transaction_category_name' => ['required', 'string', 'max:255', 'exists:income_transaction_categories,name'],
        
            
        ]);

        $companyAccount = CompanyAccount::where('account_number', $request->input('company_account_number'))->firstOrFail();
        $customer = Customer::where('name', $request->input('customer_name'))->firstOrFail();
        $payment=PaymentMethod::where('name',$request->input('payment_method_name'))->firstOrFail();
        $category=IncomeTransactionCategory::where('name',$request->input('income_transaction_category_name'))->firstOrFail();
        $currency=currency_manager::where('is_base_currency',true)->first();


        // Update the company account balance
        $companyAccount->amount += $request->input('amount');
        $companyAccount->save();

        // Create the new income transaction
        $newIncome = IncomeTransaction::create([
            'amount' => $request->input('amount'),//this will later used in update method as a previous income amount
            //'type' => $request->input('type'),
            'reference' => $request->input('reference'),
            'attachment' => $request->input('attachment'),
            'company_account_id' => $companyAccount->id,
            'customer_id' => $customer->id,
            'payment_method_id' => $payment->id,
            'income_transaction_category_id' => $category->id,
            'currency_manager_id'=>$currency->id,
            'note' => $request->input('note')
        ]);

        return response()->json([
            'message' => 'Income transaction added successfully',
            'income_transaction' => $newIncome
        ]);
    }


    public function update(Request $request, IncomeTransaction $incometransaction)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'between:0.01,9999999999999.99'],
            //'type' => ['required', 'string', 'in:earned,passive,retirement,business,investment'],
            'reference' => ['nullable', 'string', 'max:255', 'unique:income_transactions'],
            'attachment' => ['nullable', 'string', 'max:255', 'unique:income_transactions'],
            'company_account_number' => ['required', 'exists:company_accounts,account_number'],
            'customer_name' => ['required', 'exists:customers,name'],
            'note' => ['nullable', 'string'],
            'payment_method_name' => ['required', 'string', 'max:255', 'exists:payment_methods,name'],
            'income_transaction_category_name' => ['required', 'string', 'max:255', 'exists:income_transaction_categories,name'],
        ]);

        $companyAccount = CompanyAccount::where('account_number', $request->input('company_account_number'))->firstOrFail();
        $customer = Customer::where('name', $request->input('customer_name'))->firstOrFail();
        $payment=PaymentMethod::where('name',$request->input('payment_method_name'))->firstOrFail();
        $category=IncomeTransactionCategory::where('name',$request->input('income_transaction_category_name'))->firstOrFail();
        // Update the company account balance
        $previousincome=$incometransaction->amount;//becaues during update we are using the id in the method so,we can directly access the amount without using the model
        $companyAccount->amount-=$previousincome;
        $companyAccount->amount += $request->input('amount');
        $companyAccount->save();

        // Create the new income transaction
        $updatedIncome = $incometransaction->update([
            'amount' => $request->input('amount'),
           // 'type' => $request->input('type'),i commented it because we can substitue it income_transaction_category_name
            'reference' => $request->input('reference'),
            'attachment' => $request->input('attachment'),
            'company_account_id' => $companyAccount->id,
            'customer_id' => $customer->id,
            'payment_method_id' => $payment->id,
            'income_transaction_category_id' => $category->id,
            'note' => $request->input('note')
        ]);

        return response()->json([
            'message' => 'Income transaction updated successfully',
            'income_transaction' => $updatedIncome
        ]);
    }

    public function delete(Request $request, IncomeTransaction $incometransaction)
    {
        $companyaccount=CompanyAccount::where('id',1)->firstOrFail();
        $companyaccount->amount-=$incometransaction->amount;
        $companyaccount->save();

        $incometransaction->delete();
        return response()->json([
            'message' => 'Income transaction information deleted successfully!'
        ]);
    }
}
