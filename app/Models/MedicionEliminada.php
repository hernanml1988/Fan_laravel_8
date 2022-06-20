<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicionEliminada extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "medicion_eliminada";
    protected $primaryKey = 'id';
    
}
