<?php

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

Route::middleware('admin')->controller(\App\Http\Controllers\Admin\AdminPeticionesController::class)->group(function () {
    Route::get('admin', 'index')->name('admin.home');
    Route::get('admin/peticiones/index', 'index')->name('adminpeticiones.index');
    Route::get('admin/peticiones/{id}', 'show')->name('adminpeticiones.show');
    Route::get('admin/peticion/add', 'create')->name('adminpeticiones.create');
    Route::get('admin/peticiones/edit/{id}', 'edit')->name('adminpeticiones.edit');
    Route::post('admin/peticiones', 'store')->name('adminpeticiones.store');
    Route::delete('admin/peticiones/{id}', 'delete')->name('adminpeticiones.delete');
    Route::put('admin/peticiones/{id}', 'update')->name('adminpeticiones.update');
    Route::put('admin/peticiones/estado/{id}', 'cambiarEstado')->name('adminpeticiones.estado');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/home', [PagesController::class, 'home'])->name('pages.home');
Route::get('/admin/home', [PagesController::class, 'admin'])->name('admin.home');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

require __DIR__.'/auth.php';
