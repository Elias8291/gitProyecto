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
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PeriodoController;

// Ruta para la página de bienvenida, accesible para todos los usuarios
Route::get('/', [WelcomeController::class, 'showWelcomePage'])->name('welcome');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [WelcomeController::class, 'showWelcomePage'])->name('welcome');

Route::post('/usuarios/changePassword', [App\Http\Controllers\UsuarioController::class, 'changePassword'])->name('usuarios.changePassword');
Route::post('/usuarios/updateProfile', [App\Http\Controllers\UsuarioController::class, 'updateProfile'])->name('usuarios.updateProfile');
Route::get('/usuarios/user-list', [App\Http\Controllers\UsuarioController::class, 'getUserList'])->name('usuarios.getUserList');

// Grupo de rutas protegidas por el middleware 'auth'
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('estudiantes', EstudianteController::class);
    Route::resource('inscripciones', InscripcionController::class);
    Route::resource('periodos', PeriodoController::class);
    Route::resource('grupos', GrupoController::class);
    Route::resource('materias', MateriasController::class);
    Route::resource('logs', LogController::class);
    Route::get('/grupos/{clave}/generarPDF', [GrupoController::class, 'generarPDF'])->name('grupos.generarPDF');
});