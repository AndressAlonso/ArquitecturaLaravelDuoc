<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('servicio_clinico', function (Blueprint $table) { 
            $table->id();
            $table-> string('nombre');
            $table -> boolean('IsLavanderia')->default(false)->nullable(false);
            $table -> string('direccion')->nullable(false)->default('Sin Ubicacion Especificada');
            $table-> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicio_clinico');
    }
};
