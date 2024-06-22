<?php

namespace App\Models;

use Database\Factories\AccountFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class currency_manager extends Model
{
    protected $fillable=['name','exchange_rate','is_basecurrency','status'];
    use HasFactory;


    public function account(){
        return $this->hasMany(Account::class);
    }
    public function income(){
        return $this->hasMany(IncomeTransaction::class);
    }
    public function expense(){
        return $this->hasMany(ExpenseTransaction::class);
    }
    public function transfer(){
        return $this->hasMany(TransferTransaction::class);
    }
    
    public static function getBaseCurrency()
    {
        return self::where('is_basecurrency', true)->first();
    }
}