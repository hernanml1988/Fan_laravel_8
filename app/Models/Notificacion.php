<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "notificacion";
    protected $primaryKey = 'IDnotificacion';
    
}
