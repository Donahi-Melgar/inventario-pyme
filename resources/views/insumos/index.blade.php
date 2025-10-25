@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Insumos de Coctelería - Shake&Smile</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Nombre</th>
                <th>SKU</th>
                <th>Cantidad</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @forelse($insumos as $item)
                <tr>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->sku }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>Q{{ number_format($item->precio, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No hay insumos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $insumos->links() }}
    </div>
</div>
@endsection