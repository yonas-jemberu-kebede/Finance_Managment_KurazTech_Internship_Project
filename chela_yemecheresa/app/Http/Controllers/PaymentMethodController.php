<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    public function index(){
        $allpaymentmethods=PaymentMethod::all();

        return response()->json([
            'paymentmethods'=>$allpaymentmethods
        ]
        );
    }

    public function show(PaymentMethod $paymentmethod){

        return response()->json( [
            'paymentmethod'=>$paymentmethod
        ]);
    }
    public function edit(PaymentMethod $paymentmethod){

        return view([
            'paymentmethod'=>$paymentmethod
        ]);
    }
    public function store(Request $request){

        $validated=$request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
            ]
            );

            $paymentmethod=PaymentMethod::create($validated);

            return response()->json([
                'payment method'=>$paymentmethod,
                'message'=> 'paymentmethod added successfully'
            ]);

    }
    public function update(Request $request,PaymentMethod $paymentmethod)
    {
        $validated=$request->validate([
'name' => ['required', 'string', 'max:255'],
        ]);

        $paymentmethod->update($validated);

        return response()->json([
            'payment method'=>$paymentmethod,
            'message'=>'paymentmethod updated successfully']);

    }

    public function delete(Request $request,PaymentMethod $paymentmethod)
    {
        $paymentmethod->delete();
        return response()->json([
          
            'message'=>'paymentmethod deleted successfully']);
    }
}
