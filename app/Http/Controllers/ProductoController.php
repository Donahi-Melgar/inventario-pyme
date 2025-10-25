<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductosExport;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');
        $proveedorSeleccionado = $request->input('proveedor');

        $query = Producto::query();

        if ($buscar) {
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre', 'like', "%$buscar%")
                  ->orWhere('sku', 'like', "%$buscar%");
            });
        }

        if ($proveedorSeleccionado) {
            $query->where('proveedor', $proveedorSeleccionado);
        }

        $productos = $query->orderBy('id', 'desc')->paginate(10);
        $proveedores = Producto::distinct()->pluck('proveedor');

        return view('productos.index', compact('productos', 'proveedores', 'proveedorSeleccionado'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'sku' => 'required|string|unique:productos',
            'cantidad' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
            'proveedor' => 'required|string|max:100',
        ]);

        Producto::create($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto registrado correctamente.');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100',
            'sku' => 'required|string|unique:productos,sku,' . $producto->id,
            'cantidad' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
            'proveedor' => 'required|string|max:100',
        ]);

        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }

    // ✅ Exportar a Excel
    public function exportExcel()
    {
        return Excel::download(new ProductosExport, 'productos.xlsx');
    }

    // ✅ Exportar a PDF
    public function exportPdf()
    {
        $productos = Producto::orderBy('id', 'desc')->get();
        $pdf = Pdf::loadView('productos.pdf', compact('productos'));
        return $pdf->download('productos.pdf');
    }
}