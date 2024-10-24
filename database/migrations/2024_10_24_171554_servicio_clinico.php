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
        Schema::create('servicio_clinicos', function (Blueprint $table) { 
            $table->id();
            $table->foreignId('servicio_clinico_id')->constrained('tipo_servicios_cli')->onDelete('cascade');
            $table->foreignId('ropa_id')->constrained('ropas')->onDelete('cascade');
            $table->integer('cantidad')->default(0); // La cantidad de ropa que posee el servicio 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicio_clinicos');
    }
};
