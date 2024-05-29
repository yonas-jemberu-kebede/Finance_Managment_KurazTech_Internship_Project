<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $guarded=[];
    
    public function expensetransaction(){
        return $this->hasMany(ExpenseTransaction::class);
    }
}
