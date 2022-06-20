<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentrosProductivos extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "centrosproductivos";
    protected $primaryKey = 'IDcentro';
    




}
