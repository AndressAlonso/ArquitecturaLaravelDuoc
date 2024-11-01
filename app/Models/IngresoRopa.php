<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngresoRopa extends Model
{
    protected $table = 'ingresos';

    protected $fillable = [
        'sEntrante',
        'sSaliente',
    ];

    public function ropas()
    {
        return $this->belongsToMany(Ropa::class, 'ingresos_ropa')->withPivot('estado', 'cantidad')->withTimestamps();
    }

}
