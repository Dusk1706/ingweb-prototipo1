<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SucursalEstatus extends Model
{
   
    protected $table = 'estado_sucursales';
    protected $primaryKey = 'id_sucursal';
    
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_sucursal',
        'caja_abierta'
    ];
}
