<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransferTransaction;
use App\Models\Account;
use App\Models\CompanyAccount;
use App\Models\PaymentMethod;
use App\Models\currency_manager;

class TransferTransactionController extends Controller
{
    public function totaltransfer()
    {
        $transfer = TransferTransaction::all();
        $sum = $transfer->sum('amount');
        $jsonResponse =response()->json([
            'total_income' => $sum
        ]);
        $prettyPrintedJson = json_encode($jsonResponse->original, JSON_PRETTY_PRINT);

        // Return the JSON response with spaces for better readability
        return response($prettyPrintedJson)->header('Content-Type', 'application/json');
    }

    public function alltransactions()
    {
        $alltransfer_transactions = TransferTransaction::all();
        $jsonResponse =response()->json([
            'transfer_transactions' => $alltransfer_transactions
        ]);
        $prettyPrintedJson = json_encode($jsonResponse->original, JSON_PRETTY_PRINT);

        // Return the JSON response with spaces for better readability
        return response($prettyPrintedJson)->header('Content-Type', 'application/json');
    }
    public function showadd(){
        return view('transfertransaction.showadd');
    }
  
    
    public function view(TransferTransaction $transfertransaction)
    {
        return response()->json([
            'transfertransaction' => $transfertransaction
        ]);
    }

    public function edit(TransferTransaction $transfertransaction)
    {
        return response()->json([
            'transfertransaction' => $transfertransaction
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|between:0,999999999999.99',
            'reference' => 'required|unique:transfer_transactions,reference',
            'attachment' => 'nullable|unique:transfer_transactions,attachment',
            'note' => 'nullable|string|max:255', // Adding validation for note
     
            'company_account_name' => 'required|exists:company_accounts,name',
            'target_account_name' => 'nullable|exists:accounts,name',
            'payment_method_name' => ['required', 'string', 'max:255', 'exists:payment_methods,name'],
            'currency_manager_name'=>'required|string|exists:currency_managers,name'
            
        ]);
        
        $enteredCurrency=currency_manager::where('name',$request->input('currency_manager_name'))->first();
        $basecurrency=currency_manager::where('is_basecurrency',true)->first();
        $amount=$request->input('amount');

       

        if($enteredCurrency->name != $basecurrency->name){
          $amount=$amount * $enteredCurrency->exchange_rate;
        }

        $companyaccount=CompanyAccount::where('name',$request->input('company_account_name'))->firstOrFail();
        $targetaccount=Account::where('name',$request->input('target_account_name'))->firstOrFail();
   $paymentmethod=PaymentMethod::where('name',$request->input('payment_method_name'))->firstOrFail();

          if(!$companyaccount|| !$targetaccount){
            return response()->json([
                'error'=>'one or more account is not found'
            ],404);      
          }
    if($amount>$companyaccount->amount){
            return response()->json([
                "error"=>"insufficient balance"
            ]);
        }
        else{
            $companyaccount->amount-=$amount;
            $targetaccount->current_balance+=$amount;
            $companyaccount->save();
            $targetaccount->save();
    
        }

        $transfertransaction = TransferTransaction::create([
             
            'amount' => $validated['amount'],
            'reference' => $validated['reference'],
            'attachment' => $validated['attachment'],
            'note' => $validated['note'],

            'company_account_id' => $companyaccount->id,
            'target_account_id' => $targetaccount->id,
            'payment_method_id' => $paymentmethod->id,
            'currency_manager_id' => $enteredCurrency->id,

        ]);

        return response()->json([
            'message' => 'transfer transaction added successfully',
            'transfertransaction' => $transfertransaction
        ]);
    }

    public function update(Request $request, TransferTransaction $transfertransaction)
    {
        $validated = $request->validate([
           'amount' => 'required|numeric|between:0,999999999999.99',
            'reference' => 'required|unique:transactions,reference',
            'attachment' => 'nullable|unique:transactions,attachment',
            'note' => 'nullable|string|max:255', // Adding validation for note
    
            'company_account_name' => 'required|string|exists:company_accounts,name',
            'target_account_name' => 'required|string|exists:accounts,name',
       'currency_manager_name'=>'required|string|exists:currency_managers,name'
    
        ]);

        $enteredCurrency=currency_manager::where('name',$request->input('currency_manager_name'))->first();
        $basecurrency=currency_manager::where('is_basecurrency',true)->first();
        $amount=$request->input('amount');

       

        if($enteredCurrency->name != $basecurrency->name){
          $amount=$amount * $enteredCurrency->exchange_rate;
        }


        $companyaccount=CompanyAccount::where('name',$request->input('company_account_name'))->first();
        $targetaccount=Account::where('name',$request->input('target_account_name'))->firstOrFail();
       $paymentmethod=PaymentMethod::where('name',$request->input('payment_method_name'))->firstOrFail();
       
       if(!$companyaccount || !$targetaccount){
            return response()->json([
                'error'=>'one or more account is not found'
            ],404);      
          }
          if($amount>$companyaccount->amount){
            return response()->json([
                "error"=>"insufficient balance"
            ]);
        }else{
            $previoustransfer=$transfertransaction->amount;
            $companyaccount->amount+=$previoustransfer;
            $targetaccount->current_balance-=$previoustransfer;
            
            $companyaccount->amount-=$amount;
            $targetaccount->current_balance+=$amount;
            
            $companyaccount->save();
            $targetaccount->save();
        }  




        $transfertransaction->update([
            'amount' => $validated['amount'],
            'reference' => $validated['reference'],
            'attachment' => $validated['attachment'],
            'note' => $validated['note'],

            'account_id' => $companyaccount->id,
            'target_account_id' => $targetaccount->id,
            'payment_method_id' => $paymentmethod->id,
            'currency_manager_id' => $enteredCurrency->id
        ]);

        return response()->json([
            'message' => 'transfer transaction information updated successfully!',
            'transfertransaction' => $transfertransaction
        ]);
    }

    public function delete(Request $request, TransferTransaction $transfertransaction)
    {
        $companyaccount=CompanyAccount::where('id',$transfertransaction->company_account_id)->firstOrFail();
        $targetaccount=TransferTransaction::where('id',$transfertransaction->target_account_id)->firstOrFail();

        $companyaccount->amount+=$transfertransaction->amount;
        $targetaccount->amount-=$transfertransaction->amount;
        
        $companyaccount->save();
        $targetaccount->save();

        $transfertransaction->delete();
        return response()->json([
            'message' => 'transfer transaction information deleted successfully!'
        ]);
    }
}
