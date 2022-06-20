<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspecieEstandar extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "especie_estandar";
    protected $primaryKey = 'IDespecie_estandar';

}
