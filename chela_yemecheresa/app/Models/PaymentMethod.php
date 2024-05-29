<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\IncomeTransaction;
use App\Models\ExpenseTransaction;
use App\Models\TransferTransaction;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function incomes(){
        return $this->hasMany(IncomeTransaction::class);
    }
    public function expenses(){
        return $this->hasMany(ExpenseTransaction::class);
    }
    public function transfers(){
        return $this->hasMany(TransferTransaction::class);
    }
}
