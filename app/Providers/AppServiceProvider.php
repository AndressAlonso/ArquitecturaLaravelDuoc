<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

use App\Models\ServicioClinico;

use App\Models\User;
use App\Mail\ServiciosCEscasezRopa;
use Mail;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale(config('app.locale'));
        $this->verificarEscasez();
    }

    public function verificarEscasez()
    {
        $serviciosConRopaBajaCantidad = ServicioClinico::whereHas('ropas', function ($query) {
            $query->where('cantidad', '<', 10);
        })->with('ropas')->get();

        if ($serviciosConRopaBajaCantidad->isNotEmpty()) {
            return $this->EnviarEmailEscasez();
        } else {
            return false;
        }
        
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
            if ($usuario->last_email_sent_at && Carbon::parse($usuario->last_email_sent_at)->isToday()) {
                continue;
            }
            $serviciosUsuario = $serviciosConRopaBajaCantidad->filter(function ($servicio) use ($usuario) {
                return in_array($servicio->nombre, json_decode($usuario->sClinicos, true));
            });

            Mail::to($usuario->email)->send(new ServiciosCEscasezRopa($serviciosUsuario, $usuario));

            $usuario->last_email_sent_at = now();
            $usuario->save();
            
        }
    }

}
