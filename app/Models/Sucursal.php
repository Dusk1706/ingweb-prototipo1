<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursales';
    protected $primaryKey = 'id_caja';
    public $incrementing = true;
    public $timestamps = false;
    
    protected $fillable = [
        'id_caja',
        'id_sucursal',
        'denominacion',
        'entregados',
        'existencia',
    ];
}
