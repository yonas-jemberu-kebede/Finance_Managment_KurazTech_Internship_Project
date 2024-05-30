<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseTransaction;

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
        return response()->json([
            'expensetransactions' => $allExpenseTransactions
        ]);
    }
    
    public function showadd(){
        return view('expensetransaction.showadd');
    }
  
    
    public function view(ExpenseTransaction $expensetransaction)
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
            'type' => ['required', 'string', 'in:rent,insurance,loan,tax,utilities'],
            'reference' => ['required', 'string', 'max:255', 'unique:expense_transactions'],
            'attachment' => ['required', 'string', 'max:255', 'unique:expense_transactions'],
            'payment_method_id' => ['required', 'exists:payment_methods,id'],
            'account_id' => ['required', 'exists:accounts,id'],
            'vendor_id' => ['required', 'exists:vendors,id'],
        ]);
    
        $expenseTransaction = ExpenseTransaction::create($validated);
    
        return response()->json([
            'message' => 'Expense transaction added successfully',
            'expensetransaction' => $expenseTransaction
        ]);
    }
    public function update(Request $request, ExpenseTransaction $expensetransaction)
{
    $validated = $request->validate([
        'amount' => ['required', 'numeric', 'between:0.01,9999999999999.99'],
        'type' => ['required', 'string', 'in:rent,insurance,loan,tax,utilities'],
        'reference' => ['required', 'string', 'max:255', 'unique:expense_transactions,reference,' . $expensetransaction->id],
        'attachment' => ['required', 'string', 'max:255', 'unique:expense_transactions,attachment,' . $expensetransaction->id],
        'payment_method_id' => ['required', 'exists:payment_methods,id'],
        'account_id' => ['required', 'exists:accounts,id'],
        'vendor_id' => ['required', 'exists:vendors,id'],
    ]);

    $expensetransaction->update($validated);

    return response()->json([
        'message' => 'Expense transaction information updated successfully!',
        'expensetransaction' => $expensetransaction
    ]);
}

  

public function delete(Request $request, ExpenseTransaction $expensetransaction)
{
    $expensetransaction->delete();
    return response()->json([
        'message' => 'Expense transaction information deleted successfully!'
    ]);
}

}
