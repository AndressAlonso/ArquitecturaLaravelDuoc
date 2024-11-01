<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServicioClinico;
use App\Models\Ropa;

class ServiciosCLinicos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $servicios = [
            'Cardiología' => [
                ['tipo' => 'Bata', 'estado' => 'sucia', 'cantidad' => 10],
                ['tipo' => 'Uniforme', 'estado' => 'limpia', 'cantidad' => 5],
                ['tipo' => 'Camiseta', 'estado' => 'sucia', 'cantidad' => 5],
                ['tipo' => 'Uniforme', 'estado' => 'limpia', 'cantidad' => 5],
            ],
            'Neurología' => [
                ['tipo' => 'Bata', 'estado' => 'limpia', 'cantidad' => 3],
                ['tipo' => 'Uniforme', 'estado' => 'sucia', 'cantidad' => 7],
            ],
            'Psicología' => [
                ['tipo' => 'Bata', 'estado' => 'sucia', 'cantidad' => 6],
                ['tipo' => 'Uniforme', 'estado' => 'limpia', 'cantidad' => 4],
            ],
            'Otorrinolaringología' => [
                ['tipo' => 'Bata', 'estado' => 'limpia', 'cantidad' => 8],
                ['tipo' => 'Uniforme', 'estado' => 'sucia', 'cantidad' => 2],
            ],
            'Traumatología' => [
                ['tipo' => 'Bata', 'estado' => 'sucia', 'cantidad' => 12],
                ['tipo' => 'Uniforme', 'estado' => 'limpia', 'cantidad' => 3],
            ],
            'Psiquiatría' => [
                ['tipo' => 'Bata', 'estado' => 'limpia', 'cantidad' => 5],
                ['tipo' => 'Uniforme', 'estado' => 'sucia', 'cantidad' => 4],
            ],
            'Urología' => [
                ['tipo' => 'Bata', 'estado' => 'sucia', 'cantidad' => 9],
                ['tipo' => 'Uniforme', 'estado' => 'limpia', 'cantidad' => 6],
            ],
            'Pediatría' => [
                ['tipo' => 'Bata', 'estado' => 'sucia', 'cantidad' => 10],
                ['tipo' => 'Uniforme', 'estado' => 'limpia', 'cantidad' => 5],
            ],
        ];

        // Loop through each servicio to create entries and associated ropa
        foreach ($servicios as $nombre => $ropas) {
            $servicioClinico = ServicioClinico::create(['nombre' => $nombre]);

            // Loop through each ropa type and associate it with the servicio
            foreach ($ropas as $ropa) {

                $ropaEntry = Ropa::create(['tipo' => $ropa['tipo']]);
                $servicioClinico->ropas()->attach($ropaEntry->id, [
                    'estado' => $ropa['estado'],
                    'cantidad' => $ropa['cantidad'],
                ]);
            }
        }
    }
    
}
