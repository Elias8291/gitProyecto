<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'inscripciones';
   protected $fillable = ['estudiante_id', 'grupo_clave'];

    public function alumno()
    {
        // Asegúrate de que el nombre de la clave foránea aquí coincida
        // con el nombre del campo en tu base de datos
        return $this->belongsTo(Estudiante::class, 'estudiantes_numeroDeControl', 'numeroDeControl');
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_clave', 'clave');
    }
}