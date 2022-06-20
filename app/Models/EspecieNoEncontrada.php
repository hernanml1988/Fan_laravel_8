<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspecieNoEncontrada extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "especie_no_encontrada";
    protected $primaryKey = 'IDespecie_no_encontrada';

}
