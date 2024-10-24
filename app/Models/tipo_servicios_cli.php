<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_servicios_cli extends Model
{
    use HasFactory;
    public function ropas()
    {
        return
            $this->belongsToMany(ropa::class, 'servicio_clinico')
            ->withPivot('cantidad')
            ->withTimestamps();
    }
}
