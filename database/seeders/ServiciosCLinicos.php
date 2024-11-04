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
                ['tipo' => 'Bata', 'estado' => 'sucia', 'cantidad' => 20],
                ['tipo' => 'Uniforme', 'estado' => 'limpia', 'cantidad' => 30],
                ['tipo' => 'Camiseta', 'estado' => 'sucia', 'cantidad' =>24],
                ['tipo' => 'Uniforme', 'estado' => 'limpia', 'cantidad' => 15],
            ],
            'Neurología' => [
                ['tipo' => 'Bata', 'estado' => 'limpia', 'cantidad' => 40],
                ['tipo' => 'Uniforme', 'estado' => 'sucia', 'cantidad' => 31],
            ],
            'Psicología' => [
                ['tipo' => 'Bata', 'estado' => 'sucia', 'cantidad' => 31],
                ['tipo' => 'Uniforme', 'estado' => 'limpia', 'cantidad' => 21],
            ],
            'Otorrinolaringología' => [
                ['tipo' => 'Bata', 'estado' => 'limpia', 'cantidad' => 23],
                ['tipo' => 'Uniforme', 'estado' => 'sucia', 'cantidad' => 32],
            ],
            'Traumatología' => [
                ['tipo' => 'Bata', 'estado' => 'sucia', 'cantidad' => 23],
                ['tipo' => 'Uniforme', 'estado' => 'limpia', 'cantidad' => 34],
            ],
            'Psiquiatría' => [
                ['tipo' => 'Bata', 'estado' => 'limpia', 'cantidad' => 35],
                ['tipo' => 'Uniforme', 'estado' => 'sucia', 'cantidad' => 43],
            ],
            'Urología' => [
                ['tipo' => 'Bata', 'estado' => 'sucia', 'cantidad' => 19],
                ['tipo' => 'Uniforme', 'estado' => 'limpia', 'cantidad' => 16],
            ],
            'Pediatría' => [
                ['tipo' => 'Bata', 'estado' => 'sucia', 'cantidad' => 12],
                ['tipo' => 'Uniforme', 'estado' => 'limpia', 'cantidad' => 18],
            ],
        ];

        // Loop through each servicio to create entries and associated ropa
        foreach ($servicios as $nombre => $ropas) {
            $servicioClinico = ServicioClinico::create(['nombre' => $nombre]);
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
