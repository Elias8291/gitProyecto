<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\MateriasController;

// Ruta para la página de bienvenida, accesible para todos los usuarios
Route::get('/', [WelcomeController::class, 'showWelcomePage'])->name('welcome');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Auth::routes();

// Grupo de rutas protegidas por el middleware 'auth'
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('estudiantes', EstudianteController::class);
    Route::resource('inscripciones', InscripcionController::class);
    Route::resource('grupos', GrupoController::class);
    Route::resource('materias', MateriasController::class);
    Route::get('/grupos/{clave}/generarPDF', [GrupoController::class, 'generarPDF'])->name('grupos.generarPDF');
});