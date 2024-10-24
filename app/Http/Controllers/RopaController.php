<?php

namespace App\Http\Controllers;

use App\Models\ropa;
use App\Models\tipo_servicios_cli;
use App\Models\tipoRopa;
use Illuminate\Http\Request;

class RopaController extends Controller
{
    public function CrearTiposSCLinicos(){
        $tipo_servicio = new tipo_servicios_cli();
        $tipo_servicio-> nombre = 'Cardiologia';
        $tipo_servicio->save();
    }
    public function CrearTipoRopa(){
        $tipo_servicio = new tipoRopa();
        $tipo_servicio-> tipo = 'Camiseta';
        $tipo_servicio->save();
    }

}
