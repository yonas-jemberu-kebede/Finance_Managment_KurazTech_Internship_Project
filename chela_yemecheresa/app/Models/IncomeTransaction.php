<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeTransaction extends Model
{
    use HasFactory;
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function paymentmethod(){
        
        return $this->belongsTo(PaymentMethod::class);
    
    }
}
