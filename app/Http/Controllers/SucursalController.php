<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modelo;
use Log;

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
            Log::error('No se pudo abrir la caja');
            return back()->with('error', 'No se pudo abrir la caja');
        }

        Log::info('La caja fue abierta exitosamente');
        return back()->with('success', 'La caja fue abierta exitosamente');
    }

    public function cambiarCheques(Request $request)
    {
        $request->validate([
            'importe' => 'required|numeric|min:1'
        ], [
            'importe.required' => 'El importe es obligatorio.',
            'importe.numeric' => 'El importe debe ser un número.',
            'importe.min' => 'El importe debe ser mayor a cero.'
        ]);

        $sucursalId = auth()->user()->id_sucursal;
        $importe = $request->input('importe');

        $denomUsadas = $this->modelo->cambiarCheques($sucursalId, $importe);

        if (!$denomUsadas) {
            return back()->with('error', 'No se pudo retirar el dinero de la caja');
        }
        $denomDetalle = collect($denomUsadas['denominaciones'])
            ->pluck('entregados', 'denominacion')
            ->toArray();

        return view('sucursal', [
            'denomDetalle' => $denomDetalle,
            'importe'      => $denomUsadas['importe']
        ])->with('success', 'El dinero fue retirado exitosamente');
    }



    public function agregarBilletes(Request $request)
    {
        
        $sucursalId = $sucursalId = auth()->user()->id_sucursal;
        $denomUsadas = $this->modelo->generarBilletes($sucursalId);
        if (!$denomUsadas) {
            return back()->with('error', 'No se pudo generar billetes');
        }
        $denomDetalle = collect($denomUsadas['denominaciones'])
        ->pluck('entregados', 'denominacion')
        ->toArray();

        return view('sucursal', [
            'denomDetalle' => $denomDetalle
        ])->with('success', 'El dinero fue generado exitosamente');
    }

    

    public function guardarEnCaja(Request $request)
    {
        $sucursalId = auth()->user()->id_sucursal;
        $denomDetalle = $request->input('denomDetalle');
        $denomDetalle = json_decode($denomDetalle, true);

        
    }
}
