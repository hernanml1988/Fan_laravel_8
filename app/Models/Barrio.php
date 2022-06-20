<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "barrio";
    protected $primaryKey = 'IDbarrio';

    
}
