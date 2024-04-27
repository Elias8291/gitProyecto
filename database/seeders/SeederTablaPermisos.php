<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//agregamos el modelo de permisos de spatie
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            // Permisos para la tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',
        
            // Permisos para la tabla estudiantes
            'ver-estudiante',
            'crear-estudiante',
            'editar-estudiante',
            'borrar-estudiante',
        
            // Permisos para la tabla usuarios
            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borrar-usuario',
        
            // Permisos para la tabla inscripciones
            'ver-inscripcion',
            'crear-inscripcion',
            'editar-inscripcion',
            'borrar-inscripcion',
        
            // Permisos para la tabla grupos
            'ver-grupos',
            'ver_excel_grupo',
            'crear-grupos',
            'editar-grupos',
            'eliminar-grupos',
        
            // Permisos para la tabla materias
            'ver-materias',
            'crear-materias',
            'editar-materias',
            'eliminar-materias',
        ];        

        foreach($permisos as $permiso) {
            Permission::create(['name'=>$permiso]);
        }
    }
}
