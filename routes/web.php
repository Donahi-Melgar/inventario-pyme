<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InsumoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::resource('productos', ProductoController::class);
Route::get('productos/export/excel', [ProductoController::class, 'exportExcel'])->name('productos.export.excel');
Route::get('productos/export/pdf', [ProductoController::class, 'exportPDF'])->name('productos.export.pdf');

Route::resource('movimientos', MovimientoController::class);

Route::get('/insumos', [InsumoController::class, 'index'])->name('insumos.index');