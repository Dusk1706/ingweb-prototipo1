<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\CompositeKey\Traits\HasCompositeKey;

class Sucursal extends Model
{
    use HasCompositeKey;

    protected $table = 'sucursales';

    protected $primaryKey = ['sucursal_id', 'denominacion'];

    public $incrementing = false;
    

    protected $fillable = [
        'sucursal_id',
        'denominacion',
        'entregados',
        'existencia',
    ];
}
