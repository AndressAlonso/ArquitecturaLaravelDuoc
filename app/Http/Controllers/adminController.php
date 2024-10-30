<?php

namespace App\Http\Controllers;

use App\Models\Ropa;
use App\Models\ServicioClinico;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class adminController extends Controller
{
 
     public function showTable($table)
     {
        $servicioClinico = ServicioClinico::create(['nombre' => 'Pediatría']);
        $ropa1 = Ropa::create(['tipo' => 'Bata']);
        $ropa2 = Ropa::create(['tipo' => 'Uniforme']);
        $servicioClinico->ropas()->attach($ropa1->id, ['estado' => 'sucia', 'cantidad' => 10]);
        $servicioClinico->ropas()->attach($ropa2->id, ['estado' => 'limpia', 'cantidad' => 5]);
        $servicioClinico->save();

         if (!Schema::hasTable($table)) {
             abort(404, "Table not found");
         }
         
         $columns = Schema::getColumnListing($table);
 
         $data = DB::table($table)->get();
 
         return view('AdminTablas', compact('table', 'columns', 'data'));
     }
}
