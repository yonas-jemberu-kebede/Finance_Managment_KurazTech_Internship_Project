<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseTransactionCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'color',
    ];
    public function expense(){
        return $this->hasMany(ExpenseTransaction::class);
    }
}
