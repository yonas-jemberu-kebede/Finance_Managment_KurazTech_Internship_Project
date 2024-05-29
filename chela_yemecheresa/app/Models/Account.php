<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'account_id');
    }

    public function transferTransactions()
    {
        return $this->hasMany(Transaction::class, 'target_account_id');
    }
    public function incometransactions(){
        return $this->hasMany(IncomeTransaction::class);
    }
    public function expensetransactions(){
        return $this->hasMany(IncomeTransaction::class);
    }
}
