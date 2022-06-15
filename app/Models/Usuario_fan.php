<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario_fan extends Model
{
    use HasFactory;

    protected $connection = "mysql";
    protected $table = "users";

}
