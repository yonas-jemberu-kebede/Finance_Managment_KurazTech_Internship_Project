<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferTransaction extends Model
{
    use HasFactory;

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function targetAccount()
    {
        return $this->belongsTo(Account::class, 'target_account_id');
    }
    public function paymentmethod(){
        
        return $this->belongsTo(PaymentMethod::class);
    
    }
}
