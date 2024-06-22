<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'currency_manager_id',
        'account_number',
        'opening_balance',
        'contact_person',
        'contact_email',
'current_balance',
        'note'
    ];
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
    public function currency(){
        return $this->belongsTo(Currency_Manager::class);
    }
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($account) {
            $account->current_balance = $account->opening_balance;
        });
    }
}
