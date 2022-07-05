<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialEmail extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "historial_email";
    protected $primaryKey = 'id';

    
}
