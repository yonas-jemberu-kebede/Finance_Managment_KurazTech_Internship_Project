<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    public function index(){
        $allaccounts=Account::all();
        return view ('account.index',[
            'accounts'=>$allaccounts
        ]
        );
    }
    public function edit(Account $account){

        return view('account.edit', [
            'account'=>$account
        ]);
    }
    public function showadd(){
        return view('account.showadd');
    }
       
    
        public function view(Account $account){
            return view('account.view',[
                'account'=>$account
            ]);
        }

    public function store(Request $request){

        $validated=$request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'account_number' => ['required', 'string', 'max:255', 'unique:accounts'],
                'account_currency' => ['required', 'string', 'max:255'],
                'opening_balance' => ['required', 'string', 'max:255'],
                'contact_person' => ['nullable', 'string', 'max:255'],
                'contact_email' => ['nullable', 'string', 'email', 'max:255'],
                'note' => ['nullable', 'string', 'max:1000'],
            ]
            );

            Account::create($validated);

            return redirect()->route('account.index')->with('message','account added successfelly');

    }
    public function update(Request $request,Account $account)
    {
        $validated=$request->validate([
            'name' => ['required', 'string', 'max:255'],
            'account_number' => ['required', 'string', 'max:255', 'unique:accounts'],
            'account_currency' => ['required', 'string', 'max:255'],
            'opening_balance' => ['required', 'string', 'max:255'],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'contact_email' => ['nullable', 'string', 'email', 'max:255'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        $account->update($validated);

        return redirect()->route('account.index')->with('message','account information updated successfully!');

    }
    public function delete(Request $request,Account $account)
    {
        $account->delete();
        return redirect()->route('account.index')->with('message','account information deleted successfully!');
    }
}
