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
            //Operaciones sobre tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            //Operacions sobre tabla blogs
            'ver-estudiante',
            'crear-estudiante',
            'editar-estudiante',
            'borrar-estudiante',

            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borrar-usuario',
            
            'ver-inscripcion',
            'crear-inscripcion',
            'editar-inscripcion',
            'borrar-inscripcion',


            'ver-grupos',
            'ver_excel_grupo',
        ];

        foreach($permisos as $permiso) {
            Permission::create(['name'=>$permiso]);
        }
    }
}
