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
        Schema::create('ropas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_ropa_id')->nullable()->constrained('tipo_ropas');
            $table-> enum('estado_ropa',
            ['Limpia', 'Sucia', 'Proceso Lavado', 'En Movimiento', 'Disponible']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ropas');
    }
};
