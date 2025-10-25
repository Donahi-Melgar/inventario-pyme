<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class InsumoController extends Controller
{
    public function index()
    {
        $insumos = Producto::where('proveedor', 'Shake&Smile')
            ->where(function($query) {
                $query->where('nombre', 'like', '%Coctel%')
                      ->orWhere('nombre', 'like', '%Copa%')
                      ->orWhere('nombre', 'like', '%Vaso%')
                      ->orWhere('nombre', 'like', '%Jigger%')
                      ->orWhere('nombre', 'like', '%Colador%')
                      ->orWhere('nombre', 'like', '%Mortero%')
                      ->orWhere('nombre', 'like', '%Mat%')
                      ->orWhere('nombre', 'like', '%Pinza%')
                      ->orWhere('nombre', 'like', '%Cubeta%')
                      ->orWhere('nombre', 'like', '%Exprimidor%');
            })
            ->orderBy('nombre')
            ->paginate(20);

        return view('insumos.index', compact('insumos'));
    }
}