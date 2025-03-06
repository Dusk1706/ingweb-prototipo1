<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SucursalEstatus extends Model
{
   
    protected $table = 'estado_sucursales';
    protected $primaryKey = 'sucursal_id';
    
    public $incrementing = false;


    protected $fillable = [
        'sucursal_id',
        'caja_abierta'
    ];
}
