<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseDatos extends Model
{
    public function estaCajaAbierta($sucursalId)
    {
        return SucursalEstatus::where('id_sucursal', $sucursalId)->first();
    }

    public function getEstadoCaja($sucursalId)
    {
        return SucursalEstatus::where('id_sucursal', $sucursalId)->first();
    }

    public function getDenominaciones($sucursalId)
    {
        return Sucursal::where('id_sucursal', $sucursalId)
            ->orderBy('denominacion', 'desc')
            ->get();
    }

    public function insertarDenominacion($sucursalId, $denominacion, $existencia)
    {
        $sucursal = new Sucursal();
        $sucursal->id_sucursal = $sucursalId;
        $sucursal->denominacion = $denominacion;
        $sucursal->existencia = $existencia;
        $sucursal->entregados = 0;
        $sucursal->save();
    }
}