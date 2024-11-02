<?php

namespace App\Console\Commands;

use App\Http\Controllers\RopaController;
use Illuminate\Console\Command;
use App\Http\Controllers\ServicioClinicoController;

class VerificarRopaBaja extends Command
{
    protected $signature = 'ropa:baja';
    protected $description = 'Verifica la ropa con cantidad baja y envía notificaciones';

    public function handle()
    {
        // Crear una instancia del controlador y llamar a la función
        $controller = new RopaController();
        $controller->verificarRopaBaja();
        $this->info('Notificaciones de ropa baja enviadas.');
    }
}
