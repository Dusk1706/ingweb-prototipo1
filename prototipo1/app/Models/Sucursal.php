<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\CompositeKey\Traits\HasCompositeKey;

class Sucursal extends Model
{
    use HasCompositeKey;

    protected $table = 'sucursales';

    protected $primaryKey = ['id_sucursal', 'denominacion'];

    public $incrementing = false;
    
    protected $fillable = [
        'id_sucursal',
        'denominacion',
        'entregados',
        'existencia',
    ];
}
