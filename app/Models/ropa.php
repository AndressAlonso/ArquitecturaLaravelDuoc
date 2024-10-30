<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Ropa extends Model
{
    protected $table = 'ropa';
    protected $fillable = ['tipo'];
    public function serviciosClinicos()
    {
        return $this->belongsToMany(ServicioClinico::class, 'servicio_clinico_ropa')->withPivot('estado', 'cantidad')->withTimestamps();
    }
}