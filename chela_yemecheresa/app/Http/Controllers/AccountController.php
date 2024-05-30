<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    public function index(){
        $allaccounts=Account::all();
        $jsonResponse= response()->json(['accounts'=>$allaccounts]);

        $prettyPrintedJson = json_encode($jsonResponse->original, JSON_PRETTY_PRINT);

        // Return the JSON response with spaces for better readability
        return response($prettyPrintedJson)->header('Content-Type', 'application/json');
   
    }
    public function edit(Account $account)
    {
        return response()->json([
            'account' => $account
        ]);
    }
    
    public function showadd(){
        return view('account.showadd');
    }
       
    
    public function view(Account $account)
    {
        return response()->json([
            'account' => $account
        ]);
    }
    

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'account_number' => ['required', 'string', 'max:255', 'unique:accounts'],
        'account_currency' => ['required', 'string', 'max:255'],
        'opening_balance' => ['required', 'string', 'max:255'],
        'contact_person' => ['nullable', 'string', 'max:255'],
        'contact_email' => ['nullable', 'string', 'email', 'max:255'],
        'note' => ['nullable', 'string', 'max:1000'],
    ]);

    $account = Account::create($validated);

    return response()->json([
        'message' => 'Account added successfully',
        'account' => $account
    ]);
}

public function update(Request $request, Account $account)
{
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'account_number' => ['required', 'string', 'max:255', 'unique:accounts,account_number,' . $account->id],
        'account_currency' => ['required', 'string', 'max:255'],
        'opening_balance' => ['required', 'string', 'max:255'],
        'contact_person' => ['nullable', 'string', 'max:255'],
        'contact_email' => ['nullable', 'string', 'email', 'max:255'],
        'note' => ['nullable', 'string', 'max:1000'],
    ]);

    $account->update($validated);

    return response()->json([
        'message' => 'Account information updated successfully!',
        'account' => $account
    ]);
}

public function delete(Request $request, Account $account)
{
    $account->delete();
    return response()->json([
        'message' => 'Account information deleted successfully!'
    ]);
}

}
