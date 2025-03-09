<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class BaseDatos extends Model
{
    public function iniciarTransaccion()
    {
        return DB::beginTransaction();
    }

    public function finalizarTransaccion()
    {
        return DB::commit();
    }

    public function cancelarTransaccion()
    {
        return DB::rollBack();
    }

    public function getEstadoCaja($sucursalId)
    {
        return SucursalEstatus::where('id_sucursal', $sucursalId)
            ->lockForUpdate()
            ->first();
    }

    public function getDenominaciones($sucursalId)
    {
        return Sucursal::where('id_sucursal', $sucursalId)
            ->lockForUpdate()
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