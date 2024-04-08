<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Grupo extends Model
{
    protected $table = 'grupos'; // Especifica el nombre de la tabla
    protected $primaryKey = 'clave'; // Establece 'clave' como la llave primaria
    public $incrementing = false; // Indica que la llave primaria no es autoincrementable
    protected $keyType = 'string'; // El tipo de dato de la llave primaria es string

    protected $fillable = ['clave', 'nombre', 'rango_alumnos_id', 'horario_id', 'materia_clave']; // Campos asignables de manera masiva

    // Relación con RangoAlumno
    public function rangoAlumno()
    {
        return $this->belongsTo(RangoAlumno::class, 'rango_alumnos_id');
    }

    // Relación con Horario
    public function horario()
    {
        return $this->belongsTo(RangoAlumno::class, 'horario_id');
    }

    // Relación con Materia
    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_clave', 'clave');
    }
    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'grupo_clave', 'clave');
    }
}
