<?php

namespace App\Http\Controllers;

use App\Models\IngresoServicio;
use App\Models\IngresoRopa;
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

        // Obtiene el modelo de ServicioClinico desde la base de datos
        $servicioClinico1Model = ServicioClinico::find($servicioClinico1['id']);

        // Itera sobre las ropas enviadas para restar cantidades del servicio clínico saliente
        foreach ($ropas as $id => $data) {
            $cantidadARestar = (int) $data['cantidad'];
            $ropa = $servicioClinico1Model->ropas()->where('ropa_id', $id)->first();

            if ($ropa && $cantidadARestar <= $ropa->pivot->cantidad) {
                $nuevaCantidad = $ropa->pivot->cantidad - $cantidadARestar;
                $servicioClinico1Model->ropas()->updateExistingPivot($id, ['cantidad' => $nuevaCantidad]);
            } else {
                return response()->json(['error' => 'Cantidad a restar excede la cantidad disponible'], 400);
            }
        }

        $ingresoRopa = IngresoRopa::create([
            'sEntrante' => $servicioClinico2['nombre'],
            'sSaliente' => $servicioClinico1['nombre'],
        ]);

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

}