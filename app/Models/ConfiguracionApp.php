<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguracionApp extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "configuracion_app";
    protected $primaryKey = 'IDconfiguracionapp';
    
}
