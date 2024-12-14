<?php

namespace App\Http\Controllers;

use App\Models\IngresoRopa;
use App\Models\MovimientoRopa;
use App\Models\ropa;
use App\Models\ServicioClinico;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\ServiciosCEscasezRopa;
use Mail;

class RopaController extends Controller
{

    
    public function verificarEscasez()
    {
        $serviciosConRopaBajaCantidad = ServicioClinico::whereHas('ropas', function ($query) {
            $query->where('cantidad', '<', 10);
        })->with('ropas')->get();

        if($serviciosConRopaBajaCantidad->isNotEmpty()){
            return $this->EnviarEmailEscasez();
        }else{
            return false;
        };
    }
    
    public function EnviarEmailEscasez()
    {
        $serviciosConRopaBajaCantidad = ServicioClinico::whereHas('ropas', function ($query) {
            $query->where('cantidad', '<', 10);
        })->with('ropas')->get();
       
        $usuariosUnicos = collect();

        foreach ($serviciosConRopaBajaCantidad as $servicio) {
            $usuarios = User::whereJsonContains('sClinicos', $servicio->nombre)->get();
            $usuariosUnicos = $usuariosUnicos->merge($usuarios);
        }

        $usuariosUnicos = $usuariosUnicos->unique('id');

        foreach ($usuariosUnicos as $usuario) {
            $serviciosUsuario = $serviciosConRopaBajaCantidad->filter(function ($servicio) use ($usuario) {
                return in_array($servicio->nombre, json_decode($usuario->sClinicos, true));
            });

            Mail::to($usuario->email)->send(new ServiciosCEscasezRopa($serviciosUsuario, $usuario));
        }

        return redirect()->route('home')->with('success', 'Emails enviados correctamente.');
    }

    public function home()
    {
        $serviciosConRopaBajaCantidad = ServicioClinico::whereHas('ropas', function ($query) {
            $query->where('cantidad', '<=', 10);
        })->with('ropas')->get()->toJson();

        $sclinicosUser = json_decode(auth()->user()->sClinicos, true);
        $serviciosClinicosusuario = ServicioClinico::with('ropas')->whereIn('nombre', $sclinicosUser)->get();
        $ingresosServicioClinico = IngresoRopa::with('ropas')->whereIn('sEntrante', $sclinicosUser)->get();
        $movimientos = MovimientoRopa::with('ropas')->whereIn('sEntrante', $sclinicosUser)->orderByDesc('created_at')->get();

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
        $servicioClinico1 = json_decode($request->sClinico1, true);
        $servicioClinico2 = json_decode($request->sClinico2, true);
        $ropas = $request->input('ropas');
        $procesoLavado = $request->input('procesoLavado');

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
            'sEntranteID' => $servicioClinico2['id'],
        ]);

        foreach ($ropas as $id => $data) {
            $estado = ($procesoLavado && $data['estado'] === 'sucia') ? 'limpia' : $data['estado'];

            $ingresoRopa->ropas()->attach($id, [
                'estado' => $estado,
                'cantidad' => $data['cantidad'],
            ]);
        }

        return redirect('/')->with('success', 'Egreso De Ropa Correcto.');
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

        IngresoRopa::where('id', $request->ingresoID)
            ->delete();

        return redirect()->route('home')->with('success', 'Ingreso de Ropa Correcto!');
    }
    public function reportes(Request $request)
    {

        $ssclinicosRR = $request->serviciosClinicos;
        $tiposropasRR = $request->tiposRopa;
        
        if ($ssclinicosRR){
            $sclinicosUser = $ssclinicosRR;
            $sclinicosSin = json_decode(auth()->user()->sClinicos, true);
            $serviciosClinicosusuario = json_decode(ServicioClinico::with('ropas')->whereIn('nombre', $sclinicosSin)->get());
            $ssclinicosFiltro = json_decode(ServicioClinico::with('ropas')->whereIn('nombre', $sclinicosUser)->get());
           
        }else{
            $sclinicosUser =  json_decode(auth()->user()->sClinicos, true);;
            $sclinicosSin = json_decode(auth()->user()->sClinicos, true);
            $serviciosClinicosusuario = json_decode(ServicioClinico::with('ropas')->whereIn('nombre', $sclinicosSin)->get());
            $ssclinicosFiltro = json_decode(ServicioClinico::with('ropas')->whereIn('nombre', $sclinicosSin)->get());
        }
    
        
        $movimientos = json_decode(MovimientoRopa::with('ropas')->whereIn('sEntrante', $sclinicosUser)->orderByDesc('created_at')->get());
        $ropas = json_decode(ropa::with('serviciosClinicos')->groupBy('tipo')->get());

      

        $sClinicos = ServicioClinico::with('ropas')->get();
        $ropasAgrupadas = [];
        $listado = [];

        foreach ($ropas as $ropa) {
            $tiposAsociados = [];

            foreach ($sClinicos as $clinico) {
                $ropasClinico = $clinico->ropas->pluck('tipo')->toArray();
                
                if (in_array($ropa->tipo, $ropasClinico)) {
                    $tiposAsociados[] = $clinico;
                }
            }

            if (!empty($tiposAsociados)) {
                $listado[] = [
                    'ropa' => $ropa->tipo,
                    'servicios' => $tiposAsociados
                ];
            }
        }
        if ($tiposropasRR){
            $listadoFiltrado = array_filter($listado, function ($item) use ($tiposropasRR) {
                return in_array($item['ropa'], $tiposropasRR);
            });
            
            $listadoFiltrado = array_values($listadoFiltrado);
        }else{
            $listadoFiltrado = $listado;
        }
        return view('reportes', compact('serviciosClinicosusuario', 'movimientos', 'listadoFiltrado', 'ropas', 'ssclinicosFiltro'));
    }
    

}