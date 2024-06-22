<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\currency_manager;

class CurrencyManagerController extends Controller
{
    public function basecurrency(){
        $base=currency_manager::where('is_basecurrency','1')->firstOrFail();
        $name=$base->name;
        return response()->json([
            'The base currency is'=>$name
        ]);
    }
  public function index(){
    $allcurrencies=currency_manager::all();
return response()->json([
    'all currencies'=>$allcurrencies
]);
  }
  public function store(Request $request){

    $validated=$request->validate([
        'name'=>'required|string|unique:currency_managers,name',
        'is_basecurrency'=>'required|boolean',
        'status'=>'required|in:Active,Inactive',
        'exchange_rate'=>'required|numeric'
    ]);
    $currency=currency_manager::create($validated);

    return response()->json([
        'hey there!theres newly added currency'=>$currency
    ]);
  }
  public function view(currency_manager $currency){
    return response()->json([
        'currency'=>$currency
    ]);
  }
  public function edit(currency_manager $currency){
return response()->json([
    'currency'=>$currency
]);
}
public function update(Request $request,currency_manager $currency){

    $validated=$request->validate([
        'name'=>'required|string|unique:currency_managers,name',
        'is_basecurrency'=>'required|boolean',
        'status'=>'required|in:Active,Inactive',
        'exchange_rate'=>'required|numeric'
    ]);
    $currency->update($validated);

    return response()->json([
        'message'=>'currency updated successfuly'
    ]);
}

public function delete(Request $request,currency_manager $currency){
$currency->delete();
return response()->json([
    'message'=>'currency deleted succesully!'
]);
}
}
