<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncomeTransaction;

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
  
    
    public function view(IncomeTransaction $incometransaction)
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
            'type' => ['required', 'string', 'in:earned,passive,retirement,business,investment'],
            'reference' => ['required', 'string', 'max:255', 'unique:income_transactions'],
            'attachment' => ['required', 'string', 'max:255', 'unique:income_transactions'],
            'payment_method_id' => ['required', 'exists:payment_methods,id'],
            'account_id' => ['required', 'exists:accounts,id'],
            'incometransaction_id' => ['required', 'exists:incometransactions,id'],
        ]);

        $incomeTransaction = IncomeTransaction::create($validated);

        return response()->json([
            'message' => 'Income transaction added successfully',
            'incometransaction' => $incomeTransaction
        ]);
    }

    public function update(Request $request, IncomeTransaction $incometransaction)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'between:0.01,9999999999999.99'],
            'type' => ['required', 'string', 'in:earned,passive,retirement,business,investment'],
            'reference' => ['required', 'string', 'max:255', 'unique:income_transactions,reference,' . $incometransaction->id],
            'attachment' => ['required', 'string', 'max:255', 'unique:income_transactions,attachment,' . $incometransaction->id],
            'payment_method_id' => ['required', 'exists:payment_methods,id'],
            'account_id' => ['required', 'exists:accounts,id'],
            'incometransaction_id' => ['required', 'exists:incometransactions,id'],
        ]);

        $incometransaction->update($validated);

        return response()->json([
            'message' => 'Income transaction information updated successfully!',
            'incometransaction' => $incometransaction
        ]);
    }

    public function delete(Request $request, IncomeTransaction $incometransaction)
    {
        $incometransaction->delete();
        return response()->json([
            'message' => 'Income transaction information deleted successfully!'
        ]);
    }
}
