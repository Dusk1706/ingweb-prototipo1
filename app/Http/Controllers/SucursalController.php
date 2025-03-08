<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modelo;

class SucursalController extends Controller
{
    protected $modelo;

    public function __construct()
    {
        $this->modelo = new Modelo();
    }


    public function index()
    {
        return view('sucursal');
    }


    public function abrirCaja(Request $request)
    {
        $sucursalId = auth()->user()->id_sucursal;

        if (!$this->modelo->abrirCaja($sucursalId)) {
            return response()->json(['mensaje' => 'No se pudo abrir la caja.'], 400);
        }

        return response()->json(['mensaje' => 'La caja fue abierta exitosamente.'], 200);
    }

    public function cambiarCheques(Request $request)
    {
        $sucursalId = auth()->user()->id_sucursal;
        $importe = $request->input('importe');

        $cajaAbierta = $this->modelo->estaCajaAbierta($sucursalId);

        if (!$cajaAbierta) {
            return response()->json(['mensaje' => 'La caja no ha sido abierta.'], 400);
        }

        $retiroExitoso = $this->modelo->retirarDineroACaja($sucursalId, $importe);

        if (!$retiroExitoso) {
            return response()->json(['mensaje' => 'No se pudo retirar el dinero.'], 400);
        }

        return response()->json(['mensaje' => 'El retiro fue exitoso.'], 200);
    }

    public function agregarDinero(Request $request)
    {
        $sucursalId = $sucursalId = auth()->user()->id_sucursal;
        $denominacion = $request->input('denominacion');
        $existencia = $request->input('existencia');

        $cajaAbierta = $this->modelo->estaCajaAbierta($sucursalId);

        if (!$cajaAbierta) {
            return response()->json(['mensaje' => 'La caja no ha sido abierta.'], 400);
        }

        $this->modelo->insertarDenominacion($sucursalId, $denominacion, $existencia);

        return response()->json(['mensaje' => 'La denominación fue agregada exitosamente.'], 200);
    }
}
