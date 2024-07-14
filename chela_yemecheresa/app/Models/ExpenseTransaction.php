<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseTransaction extends Model
{
    use HasFactory;
    protected $fillable=[
        'amount',
        //'type' ,
        'reference',
        'attachment',
        'note',
        'company_account_id',
        'payment_method_id',
        'currency_manager_id', 
        'expense_transaction_category_id',
        'vendor_id'

    ];

    public function companyaccount()
    {
        return $this->belongsTo(CompanyAccount::class);
    }
    public function vendor(){
        return $this->belongsTo(vendor::class);
    }
    public function payment(){
        return $this->belongsTo(PaymentMethod::class);
    }
 public function currency(){return $this->belongsTo(currency_manager::class);}
 public function category(){
    return $this->belongsTo(ExpenseTransactionCategory::class);
 }

 
}
