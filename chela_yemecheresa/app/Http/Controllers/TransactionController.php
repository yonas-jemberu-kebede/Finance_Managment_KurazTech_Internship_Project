<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function income(){
        $income=Transaction::where('type','income')->get();
        $sum=$income->sum('amount');
        return  view('income',[
            'income'=>$sum
        ]);
    }
    public function expense(){
        $expense=Transaction::where('type','expense')->get();
        $sum=$expense->sum('amount');
        return  view('expense',[
            'expense'=>$sum
        ]);
    }
    
}
