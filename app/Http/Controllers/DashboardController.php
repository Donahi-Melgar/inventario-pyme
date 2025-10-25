<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Movimiento;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProductos = Producto::count();
        $totalMovimientos = Movimiento::count();
        $stockTotal = Producto::sum('cantidad');
        $valorInventario = Producto::sum(\DB::raw('cantidad * precio'));

        return view('dashboard.index', compact(
            'totalProductos',
            'totalMovimientos',
            'stockTotal',
            'valorInventario'
        ));
    }
}