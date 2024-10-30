<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RopaController;
use App\Http\Controllers\adminController;

route::view('/login', "login")->name('login');
route::view('/registro', "registro")->name('registro');

Route::get('/admin', [adminController::class, 'listTables'])->name('admin.tablas');
Route::get('/admin/{table}', [adminController::class, 'showTable'])->name('admin.mostrarTabla');

route::post('/validar-registro', [LoginController::class, 'register'])->name('validar-registro');
route::post('/inicia-sesion', [LoginController::class, 'login'])->name('inicia-sesion');
route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/', [RopaController::class, 'home'])->middleware('auth')->name('home');

Route::get('index', function () {
    return view('index');
})->middleware('auth')->name('index');

Route::get('/ingresos', function () {
    return view('ingresos');
})->middleware('auth')->name('ingresos');

Route::get('/egresos', function () {
    return view('egresos');
})->middleware('auth')->name('egresos');


Route::get('/crearTServicioClinico', [RopaController::class, 'CrearTiposSCLinicos'])->name('CrearTipoServicio');
Route::get('/crearTipoRopa', [RopaController::class, 'CrearTipoRopa'])->name('CrearTipoRopa');

Route::get('/crearRopa', [RopaController::class, 'CrearRopa'])->name('CrearRopa');

Route::get('/crearServicioClinico', [RopaController::class, 'CrearServicioClinico'])->name('CrearServicioClinico');

Route::get('/crearIngreso', [RopaController::class, 'CrearIngreso'])->name('CrearIngreso');

Route::get('/crearEgreso', [RopaController::class, 'CrearEgreso'])->name('CrearEgreso');