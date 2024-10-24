<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ropa extends Model
{
    use HasFactory;
    public function ropas()
    {
        return
            $this->belongsToMany(tipo_servicios_cli::class, 'servicio_clinico')
            ->withPivot('cantidad')
            ->withTimestamps();
    }
}
