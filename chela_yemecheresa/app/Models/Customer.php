<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guraded=[];
    
    public function incometransaction(){
        return $this->hasMany(IncomeTransaction::class);
    }
}