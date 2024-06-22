<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeTransaction extends Model
{
    use HasFactory;

    protected $fillable=[
        'amount',
           
            'reference',
            'attachment',
           'note',
     'company_account_id',
           'customer_id',
           'payment_method_id',
           'currency_manager_id',
           'income_transaction_category_id',
            

    ];

    public function companyaccount()
    {
        return $this->belongsTo(CompanyAccount::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function payment(){
        return $this->belongsTo(PaymentMethod::class);
    }
 public function currency(){
    return $this->belongsTo(currency_manager::class);
}
 public function category(){
    return $this->belongsTo(IncomeTransactionCategory::class);
 }

}
