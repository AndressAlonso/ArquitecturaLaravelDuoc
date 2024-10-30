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
        Schema::create('servicio_clinico_ropa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servicio_clinico_id')->constrained('servicio_clinico')->onDelete('cascade');
            $table->foreignId('ropa_id')->constrained('ropa')->onDelete('cascade');
            $table->string('estado');
            $table->integer('cantidad'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicio_clinico_ropa');
    }
};
