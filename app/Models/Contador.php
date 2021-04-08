<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contador extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'parada',
        'promocion',
        'estadistica',
        'reporte',
        'movil',
        'servicio',
        'tarifa',
        'viaje',
        'permiso',
        'fecha',
    ];
}
