<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyAccount extends Model
{
    use HasFactory;
    public function income(){
        return $this->hasMany(IncomeTransaction::class);
    }
    public function expense(){
        return $this->hasMany(ExpenseTransaction::class);
    }
    public function transfer(){
        return $this->hasMany(TransferTransaction::class);
    }
}
