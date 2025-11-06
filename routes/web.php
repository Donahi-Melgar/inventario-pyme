<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login.show');
});

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes - requiere autenticación
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Productos: acceso general para ver/listar/crear/editar; eliminación solo admin
    Route::resource('productos', ProductoController::class)->except(['destroy']);
    Route::delete('productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy')->middleware('role:admin');

    // Movimiento de inventario (entradas/salidas) permitidos a admin y empleado
    Route::resource('movimientos', MovimientoController::class)->middleware('role:admin,empleado');
});
