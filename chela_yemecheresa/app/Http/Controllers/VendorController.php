<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;

class VendorController extends Controller
{
    public function index(){
        $allvendors=Vendor::all();
        return view ('vendor.index',[
            'vendors'=>$allvendors
        ]
        );
    }
    public function edit(Vendor $vendor){

        return view('vendor.edit', [
            'vendor'=>$vendor
        ]);
    }
    public function showadd(){
        return view('vendor.showadd');
    }
       
    
        public function view(Vendor $vendor){
            return view('customer.view',[
                'vendor'=>$vendor
            ]);
        }

    public function store(Request $request){

        $validated=$request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'registration_number' => ['required', 'string', 'max:255', 'unique:customers'],
                'vat_id' => ['required', 'string', 'max:255', 'unique:customers'],
                'company_name' => ['nullable', 'string', 'max:255'],
                'country' => ['nullable', 'string', 'max:255'],
                'city' => ['nullable', 'string', 'max:255'],
                'address' => ['nullable', 'string', 'max:255'],
                'note' => ['nullable', 'string', 'max:1000'],
            ]
            );

            Vendor::create($validated);

            return redirect()->route('vendor.index')->with('message','vendor added successfelly');

    }
    public function update(Request $request,Vendor $vendor)
    {
        $validated=$request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'registration_number' => ['required', 'string', 'max:255', 'unique:customers'],
            'vat_id' => ['required', 'string', 'max:255', 'unique:customers'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        $vendor->update($validated);

        return redirect()->route('vendor.index')->with('message','vendor information updated successfully!');

    }
    public function delete(Request $request,Vendor $vendor)
    {
        $vendor->delete();
        return redirect()->route('vendor.index')->with('message','vendor information deleted successfully!');
    }
}
