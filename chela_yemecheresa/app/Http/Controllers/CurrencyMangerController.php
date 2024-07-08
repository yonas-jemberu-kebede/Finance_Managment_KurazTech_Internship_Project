<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\currency_manager;

class CurrencyMangerController extends Controller
{
    public function basecurrency()
    {
        $base = currency_manager::where('is_basecurrency', true)->firstOrFail(); // Hold the row
        $name = $base->name; // Specific attribute from the row
        return response()->json([
            'The base currency is' => $name
        ]);
    }

    public function index()
    {
        $allcurrencies = currency_manager::all();
        return response()->json([
            'all currencies' => $allcurrencies
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:currency_managers,name',
            'is_basecurrency' => 'required|boolean',
            'status' => 'required|in:Active,Inactive',
            'exchange_rate' => 'nullable|numeric'
        ]);

        $currency = currency_manager::create($validated);

        return response()->json([
            'hey there! theres newly added currency' => $currency
        ]);
    }

    public function view(currency_manager $currency)
    {
        return response()->json([
            'currency' => $currency
        ]);
    }

    public function edit(currency_manager $currency)
    {
        return response()->json([
            'currency' => $currency
        ]);
    }

    public function update(Request $request,currency_manager $currency_manager)
    {
        $validated = $request->validate([
        
            'name' => 'required|string|unique:currency_managers,name',
            'is_basecurrency' => 'required|boolean',
            'status' => 'required|in:Active,Inactive',
            'exchange_rate' => 'nullable|numeric',
        ]);
        $currency_manager->exchange_rate = $request->input('exchange_rate');
        $currency_manager->is_basecurrency = $request->input('is_basecurrency');
        $currency_manager->save();

        return response()->json([
            'message' => 'Currencies updated successfully'
        ]);
    }

    public function delete(currency_manager $currency)
    {
        $currency->delete();
        return response()->json([
            'message' => 'currency deleted successfully!'
        ]);
    }
}
