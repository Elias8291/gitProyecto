<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creamos el usuario administrador
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin12345'), // Aseguramos la contraseña con bcrypt
        ]);

        // Creamos otro usuario
        User::create([
            'name' => 'Otro Usuario',
            'email' => 'abisai@gmail.com',
            'password' => bcrypt('abisai1456'), // Aseguramos la contraseña con bcrypt
        ]);
    }
}
