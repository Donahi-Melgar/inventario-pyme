@extends('layouts.app')

@section('content')
    <h2 class="fw-bold text-secondary mb-4">Resumen de Inventario</h2>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-box-seam"></i> Total Productos</h5>
                    <p class="fs-3 mb-0">{{ $totalProductos }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-exclamation-triangle"></i> Productos bajos en stock</h5>
                    <p class="fs-3 mb-0">{{ $productosBajos }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-arrow-down-circle"></i> Entradas hoy</h5>
                    <p class="fs-3 mb-0">{{ $entradasHoy }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-arrow-up-circle"></i> Salidas hoy</h5>
                    <p class="fs-3 mb-0">{{ $salidasHoy }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection