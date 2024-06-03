<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatiRole;
class Role extends SpatiRole
{
    use HasFactory;

    protected $fillable=['name','description'];
}
