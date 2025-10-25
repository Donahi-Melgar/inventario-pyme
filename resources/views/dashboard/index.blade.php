@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard Institucional</h2>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-box-seam fs-2 text-primary"></i>
                    <h5 class="card-title mt-2">Productos Registrados</h5>
                    <p class="fs-4 fw-bold">{{ $totalProductos }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-success shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-arrow-left-right fs-2 text-success"></i>
                    <h5 class="card-title mt-2">Movimientos Totales</h5>
                    <p class="fs-4 fw-bold">{{ $totalMovimientos }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-warning shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-stack fs-2 text-warning"></i>
                    <h5 class="card-title mt-2">Stock Total</h5>
                    <p class="fs-4 fw-bold">{{ $stockTotal }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-danger shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-currency-dollar fs-2 text-danger"></i>
                    <h5 class="card-title mt-2">Valor del Inventario</h5>
                    <p class="fs-4 fw-bold">Q{{ number_format($valorInventario, 2) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection