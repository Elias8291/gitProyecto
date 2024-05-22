<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupos';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';

    // Incluir 'activo' en el arreglo $fillable para permitir la asignación masiva
    protected $fillable = [
        'clave',
        'nombre',
        'rango_alumnos_id',
        'horario_id',
        'materia_id',
        'activo', // Agregar esta línea
    ];

    public function rangoAlumno()
    {
        return $this->belongsTo(RangoAlumno::class, 'rango_alumnos_id');
    }

    public function horario()
    {
        return $this->belongsTo(Horario::class, 'horario_id');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'grupo_id');
    }
    public function rangoAlumnos()
{
    return $this->belongsTo(RangoAlumno::class, 'rango_alumnos_id');
}

}
