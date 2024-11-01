<?php

namespace App\Http\Controllers;

use App\Models\Ropa;
use App\Models\ServicioClinico;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;


class adminController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function showTable($table)
    {
       
        if (!Schema::hasTable($table)) {
            abort(404, "Table not found");
        }

        $columns = Schema::getColumnListing($table);

        $data = DB::table($table)->get();

        return view('AdminTablas', compact('table', 'columns', 'data'));
    }

    public function modificarCrearDatos(Request $request)
    {
        dump($request->all());
        $id = $request->id;
        if ($id == 0) {
            #crear
            $table = $request->table;
            $columns = Schema::getColumnListing($table);
            dump($columns);
            $data = [];
            foreach($columns as $column) {
                if ($column != 'id') {
                    $data[$column] = $request->$column;
                }
            }
            dump($data);
            DB::table($table)->insert($data);
            
        } else {
            #modificar
            $table = $request->table;
            $id = $request->id;
            $columns = Schema::getColumnListing($table);
            $data = DB::select("SELECT * FROM $table WHERE id = $id");
            foreach($columns as $column) {
                if ($column != 'id' && $column != 'created_at' && $column != 'updated_at') {
                    $data[0]->$column = $request->$column;
                }
            }
            DB::table($table)->where('id', $id)->update((array)$data[0]);
        }
        return redirect('admin/' . $request->table)->with('success', 'Datos modificados');
    }

    public function eliminarDatos()
    {
        $table = request('table');
        $id = request('id');
        DB::table($table)->where('id', $id)->delete();        
        return redirect('admin/' . $table)->with('success', 'Datos eliminados');   
    }
    
  
}
