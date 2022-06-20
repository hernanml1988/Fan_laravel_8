<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "area";
    protected $primaryKey = 'IDarea';

    
}
