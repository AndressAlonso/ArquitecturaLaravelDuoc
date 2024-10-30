<?php

namespace App\Http\Controllers;

use App\Models\ropa;
use App\Models\ServicioClinico;
use App\Models\tipo_servicios_cli;
use App\Models\tipoRopa;
use Illuminate\Http\Request;

class RopaController extends Controller
{
public function home(){
    $servicios_cli = ServicioClinico::with('ropas')->get();
    return view('home',compact('servicios_cli'));
}
}
