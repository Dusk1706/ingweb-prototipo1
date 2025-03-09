<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseDatos;
use Nette\Utils\Random;
use Illuminate\Support\Facades\Log;

class Modelo extends Model
{
    protected $baseDatos;

    public function __construct()
    {
        $this->baseDatos = new BaseDatos();
    }

    public function abrirCaja($sucursalId)
    {
        try {
            $this->baseDatos->iniciarTransaccion();

            $caja = $this->baseDatos->getEstadoCaja($sucursalId);

            if (!is_null($caja) && $caja->caja_abierta) {
                $this->baseDatos->cancelarTransaccion();
                return false;
            }

            if (is_null($caja)) {
                $caja = new SucursalEstatus();
                $caja->id_sucursal = $sucursalId;

                foreach ([1, 2, 5, 10, 20, 50, 100, 200, 500, 1000] as $denominacion) {
                    $sucursal = new Sucursal();
                    $sucursal->id_sucursal = $sucursalId;
                    $sucursal->denominacion = $denominacion;
                    $sucursal->existencia = rand(0, 50); 
                    $sucursal->entregados = 0;
                    $sucursal->save();
                }
            }

            $caja->caja_abierta = true;
            $caja->save();

            $this->baseDatos->finalizarTransaccion();
            return true;
        } catch (\Exception $e) {
            $this->baseDatos->cancelarTransaccion();
            return false;
        }
    }

    public function cambiarCheques($sucursalId, $importe)
    {
        try {
            $this->baseDatos->iniciarTransaccion();

            $cajaAbierta = $this->baseDatos->getEstadoCaja($sucursalId);

            if (!$cajaAbierta || !$cajaAbierta->caja_abierta) {
                $this->baseDatos->cancelarTransaccion();
                return false;
            }

            $denominaciones = $this->baseDatos->getDenominaciones($sucursalId);
            $importeRestante = $importe;
            $denomUsadas = [];

            foreach ($denominaciones as $denom) {
                $valor = $denom->denominacion;
                $cantidadDisponible = $denom->existencia;

                $cantidadNecesaria = (int) ($importeRestante / $valor);
                $cantidadARetirar = min($cantidadNecesaria, $cantidadDisponible);

                $denom->existencia -= $cantidadARetirar;
                $denom->entregados += $cantidadARetirar;
                $importeRestante -= $cantidadARetirar * $valor;

                if ($cantidadARetirar > 0) {
                    $denomUsadas[] = [
                        'denominacion' => $valor,
                        'entregados' => $denom->entregados
                    ];
                }
            }

            if ($importeRestante != 0) {
                $this->baseDatos->cancelarTransaccion();
                return false;
            }

            foreach ($denominaciones as $denom) {
                $denom->save();
            }

            $this->baseDatos->finalizarTransaccion();

            return $denomUsadas;
        } catch (\Exception $e) {
            $this->baseDatos->cancelarTransaccion();
            return false;
        }
    }


}
