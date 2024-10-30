<?php

namespace App\Http\Controllers;

use App\Models\ServicioClinico;
use App\Models\tipo_servicios_cli;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class adminController extends Controller
{
 
     public function showTable($table)
     {
        
        $nuevoServicioClinico = new ServicioClinico();
        $nuevoServicioClinico->servicio_clinico_id = 1;
        $nuevoServicioClinico->ropa_id = 1;
        $nuevoServicioClinico->cantidad = 1;
        $nuevoServicioClinico->save();
         if (!Schema::hasTable($table)) {
             abort(404, "Table not found");
         }
         
         $columns = Schema::getColumnListing($table);
 
         $data = DB::table($table)->get();
 
         return view('AdminTablas', compact('table', 'columns', 'data'));
     }
}
