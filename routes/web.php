<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RopaController;
use App\Http\Controllers\adminController;

route::view('/login', "login")->name('login');
route::get('/registro', [LoginController::class, 'registro'])->name('registro');
Route::get('/admin', [adminController::class, 'listTables'])->name('admin.tablas');
Route::get('/admin/{table}', [adminController::class, 'showTable'])->name('admin.mostrarTabla');
route::post('/validar-registro', [LoginController::class, 'register'])->name('validar-registro');
route::post('/inicia-sesion', [LoginController::class, 'login'])->name('inicia-sesion');
route::get('/logout', [LoginController::class, 'logout'])->name('logout');
route::post('/modificar-crear-datos', [adminController::class, 'modificarCrearDatos'])->name('modificar-crear-datos');
Route::post('/eliminar-dato', [AdminController::class, 'eliminarDatos'])->name('eliminar-dato');
Route::get('/', [RopaController::class, 'home'])->middleware('auth')->name('home');

Route::get('index', [adminController::class, 'index'])->middleware('auth')->name('index');

Route::get('/ingresos', [RopaController::class, 'ingresos'])->middleware('auth')->name('ingresos');

Route::post('/ingresos2', [RopaController::class, 'ingresos2'])->middleware('auth')->name('ingresos2');

Route::post('/ingresarRopa', [RopaController::class, 'ingresarRopa'])->middleware('auth')->name('ingresarRopa');


Route::get('/egresos', [RopaController::class, 'egresos'])->middleware('auth')->name('egresos');
Route::get('/reportes', [RopaController::class, 'reportes'])->middleware('auth')->name('reportes');
Route::post('/egresos2', [RopaController::class, 'egresos2'])->middleware('auth')->name('egresos2');
Route::post('egresarRopas', [RopaController::class, 'egresarRopas'])->middleware('auth')->name('egresarRopas');
Route::get('/tiposServicioClinicos', [RopaController::class, 'crearOModificarServiciosCLinicos'])->name('CrearTipoServicio');
