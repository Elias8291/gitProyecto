<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $primaryKey = 'numeroDeControl'; // Establece 'numeroDeControl' como clave primaria
    public $incrementing = false; // Indica que la clave primaria no es autoincremental
    protected $keyType = 'string'; // Tipo de dato de la clave primaria

    protected $fillable = [
        'numeroDeControl', 'nombre', 'apellidoPaterno', 'apellidoMaterno', 'semestre'
    ];
}
