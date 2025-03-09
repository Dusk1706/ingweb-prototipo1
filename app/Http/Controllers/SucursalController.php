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

        $mensaje = $this->modelo->abrirCaja($sucursalId);
        if (!$mensaje) {
            return back()->with('error', 'No se pudo abrir la caja');
        }

        return back()->with('success', 'La caja fue abierta exitosamente');
    }

    public function cambiarCheques(Request $request)
    {
        $sucursalId = auth()->user()->id_sucursal;
        $importe = $request->input('importe');

        $denomUsadas = $this->modelo->cambiarCheques($sucursalId, $importe);

        if (!$denomUsadas) {
            return back()->with('error', 'No se pudo retirar el dinero de la caja');
        }

        $denomDetalle = collect($denomUsadas)->pluck('entregados', 'denominacion')->toArray();

        return view('sucursal', compact('denomDetalle'))
            ->with('success', 'El dinero fue retirado exitosamente');
    }



    public function agregarBilletes(Request $request)
    {
        $sucursalId = $sucursalId = auth()->user()->id_sucursal;
        $denominacion = $request->input('denominacion');
        $existencia = $request->input('existencia');

        $this->modelo->insertarDenominacion($sucursalId, $denominacion, $existencia);

        return response()->json(['mensaje' => 'La denominación fue agregada exitosamente.'], 200);
    }
}
