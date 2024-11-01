<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoRopa extends Model
{
    protected $table = 'movimientos';

    protected $fillable = [
        'sEntrante',
        'sSaliente',
        'tipoMovimiento',
    ];

    public function ropas()
    {
        return $this->belongsToMany(Ropa::class, 'movimiento_ropas')->withPivot('estado', 'cantidad')->withTimestamps();
    }

}
