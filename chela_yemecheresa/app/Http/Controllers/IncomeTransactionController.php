<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncomeTransaction;

class IncomeTransactionController extends Controller
{
    public function income(){
        $income=IncomeTransaction::all();
        $sum=$income->sum('amount');
        return  view('income',[
            'income'=>$sum
        ]);
    }

    public function index(){
        $allincometransactions=IncomeTransaction::all();
        return view ('incometransaction.index',[
            'incometransactions'=>$allincometransactions
        ]
        );
    }
    public function showadd(){
        return view('incometransaction.showadd');
    }
  
    
        public function view(IncomeTransaction $incometransaction){
            return view('incometransaction.view',[
                'incometransaction'=>$incometransaction
            ]);
        }
    public function edit(IncomeTransaction $incometransaction){

        return view('incometransaction.edit', [
            'incometransaction'=>$incometransaction
        ]);
    }
    public function store(Request $request){

        $validated=$request->validate(
            [
                'amount' => ['required', 'numeric', 'between:0.01,9999999999999.99'],
                'type' => ['required', 'string', 'in:earned,passive,retirement,business,investment'],
                'reference' => ['required', 'string', 'max:255', 'unique:income_transactions'],
                'attachment' => ['required', 'string', 'max:255', 'unique:income_transactions'],
                'payment_method_id' => ['required', 'exists:payment_methods,id'],
                'account_id' => ['required', 'exists:accounts,id'],
                'incometransaction_id' => ['required', 'exists:incometransactions,id'],
            ]
            );

            IncomeTransaction::create($validated);

            return redirect()->route('incometransaction.index')->with('message','incometransaction added successfelly');

    }
    public function update(Request $request,IncomeTransaction $incometransaction)
    {
        $validated=$request->validate([
            'amount' => ['required', 'numeric', 'between:0.01,9999999999999.99'],
            'type' => ['required', 'string', 'in:earned,passive,retirement,business,investment'],
            'reference' => ['required', 'string', 'max:255', 'unique:income_transactions'],
            'attachment' => ['required', 'string', 'max:255', 'unique:income_transactions'],
            'payment_method_id' => ['required', 'exists:payment_methods,id'],
            'account_id' => ['required', 'exists:accounts,id'],
            'incometransaction_id' => ['required', 'exists:incometransactions,id'],
        ]);

        $incometransaction->update($validated);

        return redirect()->route('incometransaction.index')->with('message','incometransaction information updated successfully!');

    }
    public function delete(Request $request,IncomeTransaction $incometransaction)
    {
        $incometransaction->delete();
        return redirect()->route('incometransaction.index')->with('message','incometransaction information deleted successfully!');
    }
}
