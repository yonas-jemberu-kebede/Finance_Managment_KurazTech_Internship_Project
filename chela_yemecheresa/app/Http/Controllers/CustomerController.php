<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $allCustomers = Customer::all();
        $jsonResponse= response()->json([
            'customers' => $allCustomers
        ]);
        $prettyPrintedJson = json_encode($jsonResponse->original, JSON_PRETTY_PRINT);

        // Return the JSON response with spaces for better readability
        return response($prettyPrintedJson)->header('Content-Type', 'application/json');
    }
    
public function showadd(){
    return view('customer.showadd');
}
public function edit(Customer $customer)
{
    return response()->json([
        'customer' => $customer
    ]);
}

public function view(Customer $customer)
{
    return response()->json([
        'customer' => $customer
    ]);
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'company_name' => ['nullable', 'string', 'max:255'],
        'country' => ['nullable', 'string', 'max:255'],
        'city' => ['nullable', 'string', 'max:255'],
        'address' => ['nullable', 'string', 'max:255'],
        'note' => ['nullable', 'string', 'max:1000'],
    ]);

    $customer = Customer::create($validated);

    return response()->json([
        'message' => 'Customer added successfully',
        'customer' => $customer
    ]);
}

public function update(Request $request, Customer $customer)
{
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'company_name' => ['nullable', 'string', 'max:255'],
        'country' => ['nullable', 'string', 'max:255'],
        'city' => ['nullable', 'string', 'max:255'],
        'address' => ['nullable', 'string', 'max:255'],
        'note' => ['nullable', 'string', 'max:1000'],
    ]);

    $customer->update($validated);

    return response()->json([
        'message' => 'Customer information updated successfully!',
        'customer' => $customer
    ]);
}

public function delete(Request $request, Customer $customer)
{
    $customer->delete();
    return response()->json([
        'message' => 'Customer information deleted successfully!'
    ]);
}
}
