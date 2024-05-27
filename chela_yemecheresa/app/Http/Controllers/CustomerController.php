<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $allcustomers=Customer::all();
        return view ('customer.index',[
            'customers'=>$allcustomers
        ]
        );
    }
    public function edit(Customer $customer){

        return view('customer.edit', [
            'customer'=>$customer
        ]);
    }
    public function store($request){

        $validated=$request->validate(
            [

            ]
            );

            Customer::create($validated);

            return redirect()->route('customer.index')->with('message','customer added successfelly');

    }
    public function update(Request $request,Customer $customer)
    {
        $validated=$request->validate([

        ]);

        $customer->update($validated);

        return redirect()->route('customer.index')->with('message','customer information updated successfully!');

    }
    public function delete(Request $request,Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customer.index')->with('message','customer information deleted successfully!');
    }
}
