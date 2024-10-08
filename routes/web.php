<?php

use Faker\Factory;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});


Route::get('/egresos', function () {
    return view('egresos'); 
});
