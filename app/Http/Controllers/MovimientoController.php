<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimiento;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MovimientoController extends Controller
{
    /**
     * Mostrar listado de movimientos.
     */
    public function index(Request $request)
    {
        $movimientos = Movimiento::with('producto', 'usuario')
                        ->orderBy('created_at', 'desc')
                        ->paginate(15);

        return view('movimientos.index', compact('movimientos'));
    }

    /**
     * Mostrar formulario para crear un movimiento (entrada / salida).
     */
    public function create()
    {
        $productos = Producto::orderBy('nombre')->get();
        return view('movimientos.create', compact('productos'));
    }

    /**
     * Guardar un movimiento (entrada/salida) validando que no produzca stock negativo.
     */
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'tipo' => 'required|in:entrada,salida',
            'cantidad' => 'required|integer|min:1',
            'nota' => 'nullable|string|max:255',
        ]);

        $producto = Producto::findOrFail($request->producto_id);
        $cantidad = (int) $request->cantidad;
        $tipo = $request->tipo;

        // Ejecutar en transacción para asegurar atomicidad.
        try {
            DB::beginTransaction();

            if ($tipo === 'entrada') {
                // Incrementar stock
                $producto->cantidad = $producto->cantidad + $cantidad;
                $producto->save();

            } else { // salida
                // Verificar stock suficiente
                if ($producto->cantidad < $cantidad) {
                    DB::rollBack();
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['cantidad' => 'No hay stock suficiente para realizar esta salida. Stock actual: ' . $producto->cantidad]);
                }

                $producto->cantidad = $producto->cantidad - $cantidad;
                $producto->save();
            }

            // Crear registro de movimiento
            $mov = new Movimiento();
            $mov->producto_id = $producto->id;
            $mov->tipo = $tipo;
            $mov->cantidad = $cantidad;
            $mov->nota = $request->nota ?? null;
            $mov->usuario_id = Auth::id() ?? null; // si tienes usuarios autenticados
            $mov->save();

            DB::commit();

            return redirect()->route('movimientos.index')
                ->with('success', 'Movimiento registrado correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            // Puedes loguear el error si lo deseas: \Log::error($e);
            return redirect()->back()
                ->withInput()
                ->withErrors(['general' => 'Ocurrió un error al registrar el movimiento. Intenta de nuevo.']);
        }
    }

    /**
     * Mostrar un movimiento (opcional).
     */
    public function show(Movimiento $movimiento)
    {
        return view('movimientos.show', compact('movimiento'));
    }

    /**
     * (Opcional) Eliminar un movimiento - solo admin si lo quieres restringir.
     */
    public function destroy(Movimiento $movimiento)
    {
        // Si quieres revertir stock al eliminar un movimiento, debes manejarlo con cuidado.
        $movimiento->delete();
        return redirect()->route('movimientos.index')->with('success', 'Movimiento eliminado.');
    }
}
