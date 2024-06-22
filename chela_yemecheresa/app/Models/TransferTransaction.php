<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount', 'reference', 'attachment', 'payment_method_id', 'note','company_account_id', 'target_account_id',
        'currency_manager_id'
        ];
    public function companyaccount()
    {
        return $this->belongsTo(CompanyAccount::class);
    }
    public function targetAccount()
    {
        return $this->belongsTo(Account::class, 'target_account_id');
    }
    public function paymentmethod(){
        
        return $this->belongsTo(PaymentMethod::class);
    
    }
    public function currency(){return $this->belongsTo(Currency_Manager::class); }
}
