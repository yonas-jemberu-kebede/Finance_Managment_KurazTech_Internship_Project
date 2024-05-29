<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseTransaction extends Model
{
    use HasFactory;
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
    public function vendor(){
        return $this->belongsTo(vendor::class);
    }
    public function paymentmethod(){
        
        return $this->belongsTo(PaymentMethod::class);
    
    }
}
