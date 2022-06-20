<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialApi extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "historial_api";
    protected $primaryKey = 'id';

}
