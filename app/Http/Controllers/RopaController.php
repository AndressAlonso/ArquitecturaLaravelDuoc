<?php

namespace App\Http\Controllers;

use App\Models\IngresoServicio;
use App\Models\IngresoRopa;
use App\Models\MovimientoRopa;
use App\Models\ropa;
use App\Models\ServicioClinico;
use App\Models\tipo_servicios_cli;
use App\Models\tipoRopa;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;


class RopaController extends Controller
{
    public function home()
    {

        $servicios_cli = ServicioClinico::with('ropas')->get();
        return view('home', compact('servicios_cli'));
    }

    public function egresos()
    {
        $sclinicosUser = json_decode(auth()->user()->sClinicos, true);
        $serviciosClinicosusuario = ServicioClinico::with('ropas')->whereIn('nombre', $sclinicosUser)->get()->toJson();

        $servicioClinicos = ServicioClinico::with('ropas')->get()->toJson();


        return view('egresos', compact('serviciosClinicosusuario', 'servicioClinicos'));

    }
    public function egresos2(Request $request)
    {

        $servicio1 = $request->ServicioDesde;
        $servicio2 = $request->ServicioHacia;

        $servicioClinico1 = ServicioClinico::with('ropas')->where('id', $servicio1)->first();
        $servicioClinico2 = ServicioClinico::with('ropas')->where('id', $servicio2)->first();
        return view('egresos2', compact('servicioClinico1', 'servicioClinico2'));
    }


    public function egresarRopas(Request $request)
    {
        // Decodifica los datos de los servicios clínicos y ropas del request
        $servicioClinico1 = json_decode($request->sClinico1, true);
        $servicioClinico2 = json_decode($request->sClinico2, true);
        $ropas = $request->input('ropas');

        $nuevoMovimiento = MovimientoRopa::create([
            'sEntrante' => $servicioClinico2['nombre'],
            'sSaliente' => $servicioClinico1['nombre'],
            'tipoMovimiento' => 'Egreso',
        ]);

    
        $servicioClinico1Model = ServicioClinico::find($servicioClinico1['id']);
    
        foreach ($ropas as $id => $data) {
            $cantidadARestar = (int) $data['cantidad'];
            $ropa = $servicioClinico1Model->ropas()->where('ropa_id', $id)->first();
    
            
            if ($ropa && $cantidadARestar <= $ropa->pivot->cantidad) {
                $nuevaCantidad = $ropa->pivot->cantidad - $cantidadARestar;
    
                if ($nuevaCantidad > 0) {
                    $servicioClinico1Model->ropas()->updateExistingPivot($id, ['cantidad' => $nuevaCantidad]);
                } else {
                    $servicioClinico1Model->ropas()->detach($id);
                }
            } else {
                return response()->json(['error' => 'Cantidad a restar excede la cantidad disponible'], 400);
            }

            $nuevoMovimiento->ropas()->attach($id, [
                'estado' => $data['estado'],
                'cantidad' => $data['cantidad'],
            ]);
        }
    
        // Registra el ingreso de ropa en el servicio entrante
        $ingresoRopa = IngresoRopa::create([
            'sEntrante' => $servicioClinico2['nombre'],
            'sSaliente' => $servicioClinico1['nombre'],
        ]);
    
        // Asocia las prendas al ingreso
        foreach ($ropas as $id => $data) {
            $ingresoRopa->ropas()->attach($id, [
                'estado' => $data['estado'],
                'cantidad' => $data['cantidad'],
            ]);
        }
    
        return redirect()->route('home')->with('success', 'Ingreso registrado correctamente.');
    }
    


    public function ingresos()
    {
        $sclinicosUser = json_decode(auth()->user()->sClinicos, true);
        $serviciosClinicosusuario = ServicioClinico::with('ropas')->whereIn('nombre', $sclinicosUser)->get()->toArray();
        return view('ingresos', compact('serviciosClinicosusuario'));
    }

    public function ingresos2(Request $request)
    {
        $servicioClinico = ServicioClinico::with('ropas')->where('id', $request->ServicioDesde)->first();

        // Verificar si el servicio clínico existe
        if (!$servicioClinico) {
            return redirect()->back()->with('error', 'Servicio clínico no encontrado.');
        }

        $ingresosServicioClinico = IngresoRopa::with('ropas')
            ->where('sEntrante', $servicioClinico->nombre) // Suponiendo que tienes un campo 'servicio_clinico_id' en la tabla 'ingreso_ropa'
            ->get()->toArray();

        $servicioClinicoarray = ServicioClinico::with('ropas')->where('id', $request->ServicioDesde)->first()->toArray();


        return view('ingresos2', compact('ingresosServicioClinico', 'servicioClinicoarray'));
    }

    public function ingresarRopa(Request $request)
    {
        $servicioClinico = ServicioClinico::with('ropas')->where('nombre', $request->sEntrante)->first();
        $ropas = json_decode($request->input('ropas'), true);
    
        // Crear un nuevo movimiento para el ingreso de ropa
        $nuevoMovimiento = MovimientoRopa::create([
            'sEntrante' => $request->sEntrante,
            'sSaliente' => $request->sSaliente,
            'tipoMovimiento' => 'Ingreso',
        ]);
    
        foreach ($ropas as $ropaData) {
            // Buscar si la ropa ya existe en el servicio clínico con el estado específico
            $ropaExistente = $servicioClinico->ropas()
                ->where('tipo', $ropaData['tipo'])
                ->wherePivot('estado', $ropaData['pivot']['estado'])
                ->first();
    
            if ($ropaExistente) {
                // Actualizar la cantidad de la ropa existente
                $nuevaCantidad = $ropaExistente->pivot->cantidad + $ropaData['pivot']['cantidad'];
                $servicioClinico->ropas()->updateExistingPivot($ropaExistente->id, [
                    'cantidad' => $nuevaCantidad,
                    'estado' => $ropaData['pivot']['estado']
                ]);
            } else {
                // Adjuntar la ropa nueva con la cantidad y el estado especificados
                $servicioClinico->ropas()->attach($ropaData['id'], [
                    'cantidad' => $ropaData['pivot']['cantidad'],
                    'estado' => $ropaData['pivot']['estado']
                ]);
            }
    
            // Asociar la ropa al movimiento con su cantidad y estado
            $nuevoMovimiento->ropas()->attach($ropaData['id'], [
                'cantidad' => $ropaData['pivot']['cantidad'],
                'estado' => $ropaData['pivot']['estado']
            ]);
        }
    
        // Eliminar registros antiguos de ingreso de ropa (si es necesario)
        IngresoRopa::with('ropas')->where('sEntrante', $request->sEntrante)->delete();
    
        return view('home')->with('success', 'Ingreso de Ropa Correcto!');
    }
    
    

    public function reportes(){
        $sclinicosUser = json_decode(auth()->user()->sClinicos, true);
        $serviciosClinicosusuario = json_decode(ServicioClinico::with('ropas')->whereIn('nombre', $sclinicosUser)->get());
        $movimientos = json_decode(MovimientoRopa::with('ropas')->whereIn('sEntrante', $sclinicosUser)->get());

        return view('reportes', compact('serviciosClinicosusuario', 'movimientos'));
    }


}