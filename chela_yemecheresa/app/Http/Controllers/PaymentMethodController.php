<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    public function index(){
        $allpaymentmethods=PaymentMethod::all();
        return view ('paymentmethod.index',[
            'paymentmethods'=>$allpaymentmethods
        ]
        );
    }
    public function edit(PaymentMethod $paymentmethod){

        return view('paymentmethod.edit', [
            'paymentmethod'=>$paymentmethod
        ]);
    }
    public function store(Request $request){

        $validated=$request->validate(
            [

            ]
            );

            PaymentMethod::create($validated);

            return redirect()->route('paymentmethod.index')->with('message','paymentmethod added successfelly');

    }
    public function update(Request $request,PaymentMethod $paymentmethod)
    {
        $validated=$request->validate([

        ]);

        $paymentmethod->update($validated);

        return redirect()->route('paymentmethod.index')->with('message','paymentmethod information updated successfully!');

    }
    public function delete(Request $request,PaymentMethod $paymentmethod)
    {
        $paymentmethod->delete();
        return redirect()->route('paymentmethod.index')->with('message','paymentmethod information deleted successfully!');
    }
}
