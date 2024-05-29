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
public function showadd(){
    return view('customer.showadd');
}
    public function edit(Customer $customer){

        return view('customer.edit', [
            'customer'=>$customer
        ]);
    }

    public function view(Customer $customer){
        return view('customer.view',[
            'customer'=>$customer
        ]);
    }
    public function store(Request $request){

        $validated=$request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'company_name' => ['nullable', 'string', 'max:255'],
                'country' => ['nullable', 'string', 'max:255'],
                'city' => ['nullable', 'string', 'max:255'],
                'address' => ['nullable', 'string', 'max:255'],
                'note' => ['nullable', 'string', 'max:1000'], 
            ]
            );

            Customer::create($validated);

            return redirect()->route('customer.index')->with('message','customer added successfelly');

    }
    public function update(Request $request,Customer $customer)
    {
        $validated=$request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'note' => ['nullable', 'string', 'max:1000'], 
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
