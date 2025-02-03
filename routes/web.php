<?php

use App\Http\Controllers\Admin\AdminPeticionesController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PeticioneController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\PagesController::class, 'home'])->name('home');


Route::controller(\App\Http\Controllers\PeticioneController::class)->group(function () {
    Route::get('/peticiones/index', 'index')->name('peticiones.index');
    Route::get('/peticiones/{id}','show')->name('peticiones.show');
    Route::get('peticion/add', 'create')->name('peticiones.create');
    Route::get('/mispeticiones', 'listMine')->name('peticiones.mine');
    Route::post('/peticion', 'store')->name('peticiones.store');
    Route::delete('/peticiones/{id}', 'delete')->name('peticiones.delete');
    Route::put('/peticiones/{id}', 'update')->name('peticiones.update');
    Route::post('/peticiones/firmar/{id}','firmar')->name('peticiones.firmar');
    Route::get('/peticiones/edit/{id}', 'update')->name('peticiones.edit');
    Route::get('peticionesfirmadas', 'peticionesFirmadas')->name('peticiones.firmadas');
});


Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/', [AdminPeticionesController::class, 'index'])->name('admin.home');
    Route::get('/peticiones/index', [AdminPeticionesController::class, 'index'])->name('admin.peticiones.index');
    Route::get('/peticiones/add', [AdminPeticionesController::class, 'create'])->name('admin.peticiones.create');
    Route::post('/peticion', [AdminPeticionesController::class, 'store'])->name('admin.peticiones.store');
    Route::get('/peticiones/{id}', [AdminPeticionesController::class, 'show'])->name('admin.peticiones.show');
    Route::get('/peticiones/edit/{id}', [AdminPeticionesController::class, 'edit'])->name('admin.peticiones.edit');
    Route::put('/peticiones/update/{id}', [AdminPeticionesController::class, 'update'])->name('admin.peticiones.update');
    Route::delete('/peticiones/delete/{id}', [AdminPeticionesController::class, 'delete'])->name('admin.peticiones.delete');
    Route::put('/peticiones/estado/{id}', [AdminPeticionesController::class, 'cambiarEstado'])->name('admin.peticiones.estado');
});


use App\Http\Controllers\Admin\AdminCategoriasController;

Route::middleware('admin')->controller(AdminCategoriasController::class)->group(function () {
    Route::get('admin/categorias', 'index')->name('admin.categorias.index');
    Route::get('admin/categorias/{id}', 'show')->name('admin.categorias.show');
    Route::get('admin/categorias/create', 'create')->name('admin.categorias.create');
    Route::post('admin/categorias', 'store')->name('admin.categorias.store');
    Route::get('admin/categorias/edit/{id}', 'edit')->name('admin.categorias.edit');
    Route::put('admin/categorias/{id}', 'update')->name('admin.categorias.update');
    Route::delete('admin/categorias/{id}', 'delete')->name('admin.categorias.delete');
});

use App\Http\Controllers\Admin\AdminUsersController;

Route::middleware('admin')->controller(AdminUsersController::class)->group(function () {
    Route::get('admin/users', 'index')->name('admin.users.index'); // Listado de usuarios
    Route::get('admin/users/{id}', 'show')->name('admin.users.show'); // Mostrar usuario específico
    Route::get('admin/users/create', 'create')->name('admin.users.create'); // Formulario de creación
    Route::post('admin/users', 'store')->name('admin.users.store'); // Guardar usuario nuevo
    Route::get('admin/users/edit/{id}', 'edit')->name('admin.users.edit'); // Formulario de edición
    Route::put('admin/users/{id}', 'update')->name('admin.users.update'); // Actualizar usuario
    Route::delete('admin/users/{id}', 'delete')->name('admin.users.delete'); // Eliminar usuario
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/home', [PagesController::class, 'home'])->name('pages.home');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

require __DIR__.'/auth.php';
