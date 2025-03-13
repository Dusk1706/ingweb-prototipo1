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
        $denomDetalle = session('denomDetalle', []);
        $importe = session('importe', 0);
        log::info($denomDetalle);

        return view('sucursal', [
            'denomDetalle' => $denomDetalle,
            'importe' => $importe
        ]);
    }

    public function abrirCaja(Request $request)
    {
        $sucursalId = auth()->user()->id_sucursal;

        $mensaje = $this->modelo->abrirCaja($sucursalId);
        if (!$mensaje) {
            return redirect()->route('sucursal')
                ->with('error', 'No se pudo abrir la caja');
        }


        return redirect()->route('sucursal')
            ->with('success', 'La caja fue abierta exitosamente');
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
            return redirect()->route('sucursal')
                ->with('error', 'No se pudo cambiar los cheques');
        }
        $denomDetalle = collect($denomUsadas['denominaciones'])
            ->pluck('entregados', 'denominacion')
            ->toArray();

        return redirect()->route('sucursal')
            ->with([
                'denomDetalle' => $denomDetalle,
                'importe' => $denomUsadas['importe'],
                'success' => 'El dinero fue cambiado exitosamente'
            ]);
    }



    public function agregarBilletes(Request $request)
    {
        $sucursalId = $sucursalId = auth()->user()->id_sucursal;
        $denomUsadas = $this->modelo->generarBilletes($sucursalId);

        Log::info($denomUsadas);

        if (!$denomUsadas) {
            return redirect()->route('sucursal')
                ->with('error', 'No se pudo generar billetes');
        }

        return redirect()->route('sucursal')
            ->with([
                'denomDetalle' => $denomUsadas,
                'success' => 'El dinero fue generado exitosamente'
            ]);
    }



    public function guardarEnCaja(Request $request)
    {
        $sucursalId = auth()->user()->id_sucursal;
        $denomDetalle = $request->input('denomDetalle');

        $mensaje = $this->modelo->guardarEnCaja($sucursalId, $denomDetalle);
        if (!$mensaje) {
            return redirect()->route('sucursal')
                ->with('error', 'No se pudo guardar el dinero en la caja');
        }

        return redirect()->route('sucursal')
            ->with('success', 'El dinero fue guardado exitosamente');
    }
}
