<?php

use App\Http\Controllers\AulaController;
use App\Http\Controllers\ClaseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TarifaController;
use App\Http\Controllers\TrabajoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\Auth\ResetPasswordController;

// Ruta principal que muestra la vista de clases
Route::get('/', function () {
    return view('clases');
});

// Ruta para el índice sin autenticación requerida
Route::get('/', function () {
    return view('index');
});

// Ruta para el controlador del índice
Route::get('/index', [App\Http\Controllers\IndexController::class, 'index'])->name('index');

// Ruta para mostrar las clases
Route::get('/clases', [App\Http\Controllers\ClasesController::class, 'clases'])->name('clases');

// Grupo de rutas que necesitan autenticación y verificación de email
Route::middleware(['auth', 'verified'])->group(function () {
    // Rutas de perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile/update-profile', [ProfileController::class, 'updateProfile'])->name('profile.update.profile');
    Route::patch('profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Ruta para reservar una clase
Route::post('/reservar-clase/{claseId}', [ClaseController::class, 'reservarClase'])->name('reservar-clase');

// Ruta para cancelar una reserva
Route::delete('/cancelar-reserva/{claseId}', [ClaseController::class, 'cancelarReserva'])->name('cancelar-reserva');

// Cargar rutas de autenticación (register, login, etc.)
require __DIR__.'/auth.php';

// Rutas de autenticación de Laravel Breeze
Auth::routes();

// Grupo de rutas que requieren autenticación y un rol específico
Route::middleware(['auth', CheckRole::class])->group(function () {
    // Rutas de recursos para las clases
    Route::resource('clase', ClaseController::class);
    // Rutas de recursos para las aulas
    Route::resource('aula', AulaController::class);
    // Rutas de recursos para los roles
    Route::resource('role', RoleController::class);
    // Rutas de recursos para las tarifas
    Route::resource('tarifa', TarifaController::class);
    // Rutas de recursos para los trabajos
    Route::resource('trabajo', TrabajoController::class);
    // Rutas de recursos para los usuarios
    Route::resource('user', UserController::class);
    // Rutas de recursos para las reservas
    Route::resource('reserva', ReservaController::class);
});

// Ruta para eliminar una tarifa y los usuarios asociados
Route::delete('tarifa/{id}/eliminar-tarifa-usuarios', 'TarifaController@eliminarTarifaYUsuarios')->name('tarifa.eliminar_tarifa_usuarios');