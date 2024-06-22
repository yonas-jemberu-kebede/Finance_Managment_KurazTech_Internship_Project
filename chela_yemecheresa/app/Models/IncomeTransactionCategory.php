<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeTransactionCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'color',
    ];
    public function income(){
        return $this->hasMany(IncomeTransaction::class);
    }
}
