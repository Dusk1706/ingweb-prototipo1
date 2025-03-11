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
            Log::error('Error al abrir la caja en modelo' . $e->getMessage());
            $this->baseDatos->cancelarTransaccion();
            return false;
        }
    }

    public function cambiarCheques($sucursalId, $importe)
    {
        try {
            $this->baseDatos->iniciarTransaccion();

            $cajaAbierta = $this->baseDatos->getEstadoCaja($sucursalId);

            if (is_null($cajaAbierta) || !$cajaAbierta->caja_abierta) {
                Log::error('La caja no está abierta en cheques');
                $this->baseDatos->cancelarTransaccion();
                return false;
            }

            $denominaciones = $this->baseDatos->getDenominaciones($sucursalId);
            $importeRestante = $importe;
            $denomUsadas = [];
            $denomUsadas['importe'] = (int) $importe;
            $denomUsadas['denominaciones'] = [];

            foreach ($denominaciones as $denom) {
                $valor = $denom->denominacion;
                $cantidadDisponible = $denom->existencia;

                $cantidadNecesaria = (int) ($importeRestante / $valor);
                $cantidadARetirar = min($cantidadNecesaria, $cantidadDisponible);

                $denom->existencia -= $cantidadARetirar;
                $denom->entregados += $cantidadARetirar;
                $importeRestante -= $cantidadARetirar * $valor;

                if ($cantidadARetirar > 0) {
                    array_push($denomUsadas['denominaciones'], [
                        'denominacion' => $valor,
                        'entregados' => $cantidadARetirar
                    ]);
                }
            }

            if ($importeRestante != 0) {
                $this->baseDatos->cancelarTransaccion();
                Log::error('No hay suficiente dinero en la caja');
                return false;
            }

            foreach ($denominaciones as $denom) {
                $denom->save();
            }

            $this->baseDatos->finalizarTransaccion();

            Log::info('Se retiró el dinero de la caja: ' . json_encode($denomUsadas));
            return $denomUsadas;
        } catch (\Exception $e) {
            Log::error('Error al retirar el dinero de la caja en modelo' . $e->getMessage());
            $this->baseDatos->cancelarTransaccion();
            return false;
        }
    }


    public function agregarBilletes($sucursalId)
    {
        try {
            $cajaAbierta = $this->baseDatos->getEstadoCaja($sucursalId);

            if (is_null($cajaAbierta) || !$cajaAbierta->caja_abierta) {
                Log::error('La caja no está abierta en billetes');
                $this->baseDatos->cancelarTransaccion();
                return false;
            }

            $denominaciones = $this->baseDatos->getDenominaciones($sucursalId);

            foreach ($denominaciones as $denom) {
                $denom->existencia += rand(0, 50);
                $this->baseDatos->guardar($denom);
            }

            Log::info('Se agregó la denominación a la caja: ' . json_encode($denom));
            return true;
        } catch (\Exception $e) {
            Log::error('Error al agregar la denominación a la caja en modelo' . $e->getMessage());
            $this->baseDatos->cancelarTransaccion();
            return false;
        }
    }
   

    public function generarBilletes($sucursalId)
    {
        try {
            $cajaAbierta = $this->baseDatos->getEstadoCaja($sucursalId);

            if (is_null($cajaAbierta) || !$cajaAbierta->caja_abierta) {
                Log::error('La caja no está abierta en billetes');
                $this->baseDatos->cancelarTransaccion();
                return false;
            }
            $denominaciones = [];
            $denominaciones['denominaciones'] = [];
            foreach ([1000,500,200,100,50,20,10,5,2,1] as $denom) {
               array_push($denominaciones['denominaciones'], [
                'denominacion' => $denom,
                'entregados' => rand(0,50)
            ]);
            }

            return $denominaciones;
        } catch (\Exception $e) {
            Log::error('Error al agregar la denominación a la caja en modelo' . $e->getMessage());
            $this->baseDatos->cancelarTransaccion();
            return false;
        }
    }

    //guardar en caja
    public function guardarEnCaja($sucursalId, $importe)
    {
            $this->baseDatos->iniciarTransaccion();

            $cajaAbierta = $this->baseDatos->getEstadoCaja($sucursalId);

            if (is_null($cajaAbierta) || !$cajaAbierta->caja_abierta) {
                Log::error('La caja no está abierta en guardar en caja');
                $this->baseDatos->cancelarTransaccion();
                return false;
            }
    }
}
