<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ropa extends Model
{
    protected $table = 'ropa';
    protected $fillable = ['tipo'];
    public function serviciosClinicos()
    {
        return $this->belongsToMany(ServicioClinico::class, 'servicio_clinico_ropa')->withPivot('estado', 'cantidad')->withTimestamps();
    }

    public function IngresoRopas()
    {
        return $this->belongsToMany(IngresoRopa::class, 'ingresos_ropa')->withPivot('estado', 'cantidad')->withTimestamps();
    }

    public function MovimientoRopas()
    {
        return $this->belongsToMany(MovimientoRopa::class, 'movimiento_ropas')->withPivot('estado', 'cantidad')->withTimestamps();
    }

}