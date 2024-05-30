<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;

class VendorController extends Controller
{
    public function index()
{
    $allVendors = Vendor::all();
    $jsonResponse =response()->json([
        'vendors' => $allVendors
    ]);
    $prettyPrintedJson = json_encode($jsonResponse->original, JSON_PRETTY_PRINT);

    // Return the JSON response with spaces for better readability
    return response($prettyPrintedJson)->header('Content-Type', 'application/json');
}

public function edit(Vendor $vendor)
{
    return response()->json([
        'vendor' => $vendor
    ]);
}

    public function showadd(){
        return view('vendor.showadd');
    }
       
    
    public function view(Vendor $vendor)
    {
        return response()->json([
            'vendor' => $vendor
        ]);
    }
    
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'registration_number' => ['required', 'string', 'max:255', 'unique:vendors'],
        'vat_id' => ['required', 'string', 'max:255', 'unique:vendors'],
        'company_name' => ['nullable', 'string', 'max:255'],
        'country' => ['nullable', 'string', 'max:255'],
        'city' => ['nullable', 'string', 'max:255'],
        'address' => ['nullable', 'string', 'max:255'],
        'note' => ['nullable', 'string', 'max:1000'],
    ]);

    $vendor = Vendor::create($validated);

    return response()->json([
        'message' => 'Vendor added successfully',
        'vendor' => $vendor
    ]);
}

public function update(Request $request, Vendor $vendor)
{
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'registration_number' => ['required', 'string', 'max:255', 'unique:vendors'],
        'vat_id' => ['required', 'string', 'max:255', 'unique:vendors'],
        'company_name' => ['nullable', 'string', 'max:255'],
        'country' => ['nullable', 'string', 'max:255'],
        'city' => ['nullable', 'string', 'max:255'],
        'address' => ['nullable', 'string', 'max:255'],
        'note' => ['nullable', 'string', 'max:1000'],
    ]);

    $vendor->update($validated);

    return response()->json([
        'message' => 'Vendor information updated successfully!',
        'vendor' => $vendor
    ]);
}

public function delete(Request $request, Vendor $vendor)
{
    $vendor->delete();
    return response()->json([
        'message' => 'Vendor information deleted successfully!'
    ]);
}

}
