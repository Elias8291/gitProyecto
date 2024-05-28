<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
            'ver-dashboard',
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'eliminar-rol',
            'ver-estudiante',
            'crear-estudiante',
            'editar-estudiante',
            'eliminar-estudiante',
            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'eliminar-usuario',
            'ver-inscripcion',
            'ver-estudiantes-inscritos',
            'crear-inscripcion',
            'editar-inscripcion',
            'eliminar-inscripcion',
            'ver-periodos',
            'crear-periodos',
            'editar-periodos',
            'eliminar-periodos',
            'ver-grupos',
            'ver_excel_grupo',
            'crear-grupos',
            'editar-grupos',
            'eliminar-grupos',
            'ver-materias',
            'crear-materias',
            'editar-materias',
            'eliminar-materias',
            'ver-log',
        ];
             

        foreach ($permisos as $permiso) {
            Permission::create(['name' => $permiso]);
        }
    }
}
