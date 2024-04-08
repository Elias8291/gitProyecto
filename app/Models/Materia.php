<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materia extends Model
{
    use HasFactory;
    protected $table = 'materias'; // Especifica el nombre de la tabla
    protected $primaryKey = 'clave'; // Establece 'clave' como la llave primaria
    public $incrementing = true; // Indica que la llave primaria no es autoincrementable
    protected $keyType = 'string'; // El tipo de dato de la llave primaria es string

    protected $fillable = ['clave', 'nombre', 'creditos'];
}
