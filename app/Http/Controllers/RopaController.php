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
 // Importa el modelo User
use App\Notifications\RopaBajaNotification;

class RopaController extends Controller
{

    public function verificarRopaBaja()
    {
        // Obtén los servicios clínicos con ropa en cantidad menor a 10
        $serviciosConRopaBajaCantidad = ServicioClinico::whereHas('ropas', function ($query) {
            $query->where('cantidad', '<', 10);
        })->with('ropas')->get();
    
        // Verificar si el usuario es admin
        if (auth()->user()->isAdmin) {
            foreach ($serviciosConRopaBajaCantidad as $servicio) {
                // Obtén los usuarios asociados a este servicio
                $usuariosAsociados = User::where('servicio_clinico_id', $servicio->id)->get();
    
                foreach ($usuariosAsociados as $usuario) {
                    // Enviar la notificación por correo
                    $usuario->notify(new RopaBajaNotification($servicio));
                }
            }
        }
    }

    public function home()
{
    $serviciosConRopaBajaCantidad = json_decode(ServicioClinico::whereHas('ropas', function ($query) {
        $query->where('cantidad', '<=', 10);
    })->with('ropas')
      ->get());
    
    $sclinicosUser = json_decode(auth()->user()->sClinicos, true);
    $serviciosClinicosusuario = ServicioClinico::with('ropas')->whereIn('nombre', $sclinicosUser)->get()->toJson();
    $ingresosServicioClinico = IngresoRopa::with('ropas')->whereIn('sEntrante', $sclinicosUser)->get();
    $movimientos = MovimientoRopa::with('ropas')->whereIn('sEntrante', $sclinicosUser)->get();

    return view('home', compact('serviciosClinicosusuario', 'ingresosServicioClinico', 'movimientos', 'serviciosConRopaBajaCantidad'));
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

        return redirect()->route('home')->with('success', 'Egreso De Ropa Correcto.');
    }


    public function ingresos()
    {
        $sclinicosUser = json_decode(auth()->user()->sClinicos, true);
        $serviciosClinicosusuario = ServicioClinico::with('ropas')->whereIn('nombre', $sclinicosUser)->get()->toArray();

        $ingresosServicioClinico = IngresoRopa::with('ropas')->whereIn('sEntrante', $sclinicosUser)
            ->get();

        return view('ingresos', compact('serviciosClinicosusuario'), compact('ingresosServicioClinico'));
    }

    public function ingresos2(Request $request)
    {
        $servicioClinico = ServicioClinico::with('ropas')->where('id', $request->ServicioDesde)->first();

        // Verificar si el servicio clínico existe
        if (!$servicioClinico) {
            return redirect()->back()->with('error', 'Servicio clínico no encontrado.');
        }

        $ingresosServicioClinico = IngresoRopa::with('ropas')
            ->where('sEntrante', $servicioClinico->nombre)
            ->get()->toArray();

        $servicioClinicoarray = ServicioClinico::with('ropas')->where('id', $request->ServicioDesde)->first()->toArray();


        return view('ingresos2', compact('ingresosServicioClinico', 'servicioClinicoarray'));
    }

    public function ingresarRopa(Request $request)
    {
        $servicioClinico = ServicioClinico::with('ropas')->where('nombre', $request->sEntrante)->first();
        $ropas = json_decode($request->input('ropas'), true);

        $nuevoMovimiento = MovimientoRopa::create([
            'sEntrante' => $request->sEntrante,
            'sSaliente' => $request->sSaliente,
            'tipoMovimiento' => 'Ingreso',
        ]);

        foreach ($ropas as $ropaData) {
            $ropaExistente = $servicioClinico->ropas()
                ->where('tipo', $ropaData['tipo'])
                ->wherePivot('estado', $ropaData['pivot']['estado'])
                ->first();

            if ($ropaExistente) {
                $nuevaCantidad = $ropaExistente->pivot->cantidad + $ropaData['pivot']['cantidad'];
                $servicioClinico->ropas()->updateExistingPivot($ropaExistente->id, [
                    'cantidad' => $nuevaCantidad,
                    'estado' => $ropaData['pivot']['estado']
                ]);
            } else {
                $servicioClinico->ropas()->attach($ropaData['id'], [
                    'cantidad' => $ropaData['pivot']['cantidad'],
                    'estado' => $ropaData['pivot']['estado']
                ]);
            }

            $nuevoMovimiento->ropas()->attach($ropaData['id'], [
                'cantidad' => $ropaData['pivot']['cantidad'],
                'estado' => $ropaData['pivot']['estado']
            ]);
        }

        IngresoRopa::with('ropas')->where('sEntrante', $request->sEntrante)->delete();

        return view('home')->with('success', 'Ingreso de Ropa Correcto!');
    }



    public function reportes()
    {
        $sclinicosUser = json_decode(auth()->user()->sClinicos, true);
        $serviciosClinicosusuario = json_decode(ServicioClinico::with('ropas')->whereIn('nombre', $sclinicosUser)->get());
        $movimientos = json_decode(MovimientoRopa::with('ropas')->whereIn('sEntrante', $sclinicosUser)->get());

        return view('reportes', compact('serviciosClinicosusuario', 'movimientos'));
    }

}