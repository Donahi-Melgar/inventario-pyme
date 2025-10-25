<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimiento;
use App\Models\Producto;

class MovimientoController extends Controller
{
    public function index()
    {
        $movimientos = Movimiento::orderBy('id', 'desc')->paginate(10);
        return view('movimientos.index', compact('movimientos'));
    }

    public function create()
    {
        $productos = Producto::orderBy('nombre')->get();
        return view('movimientos.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'tipo' => 'required|in:entrada,salida',
            'cantidad' => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        if ($request->tipo === 'salida' && $producto->cantidad < $request->cantidad) {
            return back()->withErrors(['cantidad' => 'No hay suficiente stock disponible.'])->withInput();
        }

        // Actualizar stock
        $producto->cantidad += ($request->tipo === 'entrada') ? $request->cantidad : -$request->cantidad;
        $producto->save();

        // Registrar movimiento
        Movimiento::create([
            'producto_id' => $producto->id,
            'tipo' => $request->tipo,
            'cantidad' => $request->cantidad,
        ]);

        return redirect()->route('movimientos.index')->with('success', 'Movimiento registrado correctamente.');
    }
}