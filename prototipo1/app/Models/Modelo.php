<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseDatos;

class Modelo extends Model
{
    protected $baseDatos;

    public function __construct()
    {
        $this->baseDatos = new BaseDatos();
    }

    public function isCajaAbierta($sucursalId)
    {
        return $this->baseDatos->isCajaAbierta($sucursalId);
    }

    public function abrirCaja($sucursalId)
    {
        $sucursal = $this->baseDatos->getEstadoCaja($sucursalId);

        if ($sucursal && $sucursal->caja_abierta) {
            return false;
        }

        if (!$sucursal) {
            $sucursal = new SucursalEstatus();
            $sucursal->id_sucursal = $sucursalId;
        }
        $sucursal->caja_abierta = true;
        
        $sucursal->save();

        return true;
    }

    public function retirarDineroACaja($sucursalId, $importe)
    {
        $denominaciones = $this->baseDatos->getDenominaciones($sucursalId);

        $importeRestante = $importe;

        foreach ($denominaciones as $denom) {
            $valor = $denom->denominacion;
            $cantidadDisponible = $denom->existencia;

            $cantidadNecesaria = (int) ($importeRestante / $valor);

            $cantidadARetirar = min($cantidadNecesaria, $cantidadDisponible);

            $denom->existencia -= $cantidadARetirar;
            $denom->entregados += $cantidadARetirar;
            $importeRestante -= $cantidadARetirar * $valor;
        }

        if ($importeRestante != 0) {
            return false;
        }

        foreach ($denominaciones as $denom) {
            $denom->save();
        }

        return true;
    }



}
