<?php

use Faker\Factory;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

route::view('/login', "login")->name('login');
route::view('/registro', "registro")->name('registro');
route::view('/privada', "secret")->name('privada');

route::post('/validar-registro', [LoginController::class, 'register'])->name('validar-registro');
route::post('/inicia-sesion', [LoginController::class, 'login'])->name('inicia-sesion');
route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/', function () {
    return view('home');
})->middleware('auth')->name('home');

Route::get('index', function () {
    return view('index');
})->middleware('auth')->name('index');

Route::get('/ingresos', function () {
    return view('ingresos'); 
})->middleware('auth')->name('ingresos');

Route::get('/egresos', function () {
    return view('egresos'); 
})->middleware('auth')->name('egresos');
