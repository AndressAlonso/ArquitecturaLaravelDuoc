<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ServicioClinico;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call(ServiciosCLinicos::class);

        $allServiciosClinicos = ServicioClinico::pluck('nombre')->toArray();
        
        User::create([
            'email' => 'admin@example.com',
            'fname' => 'Super',
            'lname' => 'User',
            'sClinicos' => json_encode($allServiciosClinicos),
            'isAdmin' => true,
          
            'password' => Hash::make('adminadmin'),
        ]);

       
    }
}
