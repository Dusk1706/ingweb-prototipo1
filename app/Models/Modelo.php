<?php

namespace App\Models;

use App\Models\BaseDatos;

class Modelo
{
    private static $instancia;
    private $baseDatos;

    private function __construct()
    {
        $this->baseDatos = new BaseDatos();
    }

    public static function getInstancia()
    {
        if (is_null(self::$instancia)) {
            self::$instancia = new Modelo();
        }

        return self::$instancia;
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
                $this->baseDatos->insertarEstadoCaja($sucursalId, true);

                foreach ([1, 2, 5, 10, 20, 50, 100, 200, 500, 1000] as $denominacion) {
                    $this->baseDatos->insertarDenominacion(
                        $sucursalId,
                        $denominacion,
                        rand(0, 50)
                    );
                }
            }

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

            if (is_null($cajaAbierta) || !$cajaAbierta->caja_abierta) {
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
                $this->baseDatos->guardarObjeto($denom);

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
                return false;
            }

            $this->baseDatos->finalizarTransaccion();
            return $denomUsadas;
        } catch (\Exception $e) {
            $this->baseDatos->cancelarTransaccion();
            return false;
        }
    }


    public function agregarBilletes($sucursalId)
    {
        try {
            $cajaAbierta = $this->baseDatos->getEstadoCaja($sucursalId);

            if (is_null($cajaAbierta) || !$cajaAbierta->caja_abierta) {
                $this->baseDatos->cancelarTransaccion();
                return false;
            }

            $denominaciones = $this->baseDatos->getDenominaciones($sucursalId);

            foreach ($denominaciones as $denom) {
                $denom->existencia += rand(0, 50);
                $this->baseDatos->guardarObjeto($denom);
            }

            return true;
        } catch (\Exception $e) {
            $this->baseDatos->cancelarTransaccion();
            return false;
        }
    }


    public function generarBilletes($sucursalId)
    {
        try {
            $cajaAbierta = $this->baseDatos->getEstadoCaja($sucursalId);

            if (is_null($cajaAbierta) || !$cajaAbierta->caja_abierta) {
                $this->baseDatos->cancelarTransaccion();
                return false;
            }

            $denominaciones = [];
            foreach ([1000, 500, 200, 100, 50, 20, 10, 5, 2, 1] as $denom) {
                $denominaciones[$denom] = rand(0, 50);
            }

            return $denominaciones;
        } catch (\Exception $e) {
            $this->baseDatos->cancelarTransaccion();
            return false;
        }
    }

    public function guardarEnCaja($sucursalId, $denomUsadas)
    {
        try {
            $this->baseDatos->iniciarTransaccion();

            $cajaAbierta = $this->baseDatos->getEstadoCaja($sucursalId);

            if (is_null($cajaAbierta) || !$cajaAbierta->caja_abierta) {
                $this->baseDatos->cancelarTransaccion();
                return false;
            }

            $denominaciones = $this->baseDatos->getDenominaciones($sucursalId);

            foreach ($denominaciones as $denom) {
                $denom->existencia += $denomUsadas[$denom->denominacion];
                $this->baseDatos->guardarObjeto($denom);
            }

            $this->baseDatos->finalizarTransaccion();
            return true;
        } catch (\Exception $e) {
            $this->baseDatos->cancelarTransaccion();
            return false;
        }
    }
}
