<?php

// En app/Models/ServicioClinico.php
namespace App\Models;
use App\Models\Ropa;
use Illuminate\Database\Eloquent\Model;
class ServicioClinico extends Model
{
    protected $table = 'servicio_clinico';
    protected $fillable = ['nombre'];

    public function ropas()
    {
        return $this->belongsToMany(Ropa::class, 'servicio_clinico_ropa')->withPivot('estado', 'cantidad')->withTimestamps();
    }
}