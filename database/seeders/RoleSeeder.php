<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// Agregamos el modelo de roles de Spatie
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'Secretaria']
        ];        

        foreach($roles as $roleData) {
            // Creamos el rol
            $role = Role::create(['name' => $roleData['name']]);

            // Asignamos los permisos específicos al rol
            $permissions = [5, 13, 14, 15, 16, 17, 18, 22]; // IDs de los permisos que deseas asignar al rol
            $role->syncPermissions($permissions);
        }
    }
}
