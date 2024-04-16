<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupos';
    protected $primaryKey = 'clave';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['clave', 'nombre', 'rango_alumnos_id', 'horario_id', 'materia_clave'];

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
        return $this->belongsTo(Materia::class, 'materia_clave', 'clave');
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'grupo_clave', 'clave');
    }
}