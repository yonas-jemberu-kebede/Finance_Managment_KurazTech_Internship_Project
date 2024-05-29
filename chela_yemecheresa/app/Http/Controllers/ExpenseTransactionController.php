<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseTransaction;

class ExpenseTransactionController extends Controller
{
    public function expense(){
        $expense=ExpenseTransaction::all();
        $sum=$expense->sum('amount');
        return  view('expense',[
            'expense'=>$sum
        ]);
    }

    public function index(){
        $allexpensetransactions=ExpenseTransaction::all();
        return view ('expensetransaction.index',[
            'expensetransactions'=>$allexpensetransactions
        ]
        );
    }
    public function showadd(){
        return view('expensetransaction.showadd');
    }
  
    
        public function view(ExpenseTransaction $expensetransaction){
            return view('expensetransaction.view',[
                'expensetransaction'=>$expensetransaction
            ]);
        }

    public function edit(ExpenseTransaction $expensetransaction){

        return view('expensetransaction.edit', [
            'expensetransaction'=>$expensetransaction
        ]);
    }
    public function store(Request $request){

        $validated=$request->validate(
            [
'amount' => ['required', 'numeric', 'between:0.01,9999999999999.99'],
        'type' => ['required', 'string', 'in:rent,insurance,loan,tax,utilities'],
        'reference' => ['required', 'string', 'max:255', 'unique:expense_transactions'],
        'attachment' => ['required', 'string', 'max:255', 'unique:expense_transactions'],
        'payment_method_id' => ['required', 'exists:payment_methods,id'],
        'account_id' => ['required', 'exists:accounts,id'],
        'vendor_id' => ['required', 'exists:vendors,id'],
            ]
            );

            ExpenseTransaction::create($validated);

            return redirect()->route('expensetransaction.index')->with('message','expensetransaction added successfelly');

    }
    public function update(Request $request,ExpenseTransaction $expensetransaction)
    {
        $validated=$request->validate([
            'amount' => ['required', 'numeric', 'between:0.01,9999999999999.99'],
            'type' => ['required', 'string', 'in:rent,insurance,loan,tax,utilities'],
            'reference' => ['required', 'string', 'max:255', 'unique:expense_transactions'],
            'attachment' => ['required', 'string', 'max:255', 'unique:expense_transactions'],
            'payment_method_id' => ['required', 'exists:payment_methods,id'],
            'account_id' => ['required', 'exists:accounts,id'],
            'vendor_id' => ['required', 'exists:vendors,id'],
        ]);

        $expensetransaction->update($validated);

        return redirect()->route('expensetransaction.index')->with('message','expensetransaction information updated successfully!');

    }
    public function delete(Request $request,ExpenseTransaction $expensetransaction)
    {
        $expensetransaction->delete();
        return redirect()->route('expensetransaction.index')->with('message','expensetransaction information deleted successfully!');
    }
}
