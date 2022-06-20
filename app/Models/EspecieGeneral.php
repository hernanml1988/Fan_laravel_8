<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspecieGeneral extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "especie_general";
    protected $primaryKey = 'IDespecie_general';

}
