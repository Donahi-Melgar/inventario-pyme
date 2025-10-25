@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Listado de Movimientos</h2>

    {{-- Mensaje de sesión --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Tabla de movimientos --}}
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Producto</th>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @forelse($movimientos as $mov)
                <tr>
                    <td>{{ $mov->producto->nombre }}</td>
                    <td>
                        @if($mov->tipo === 'entrada')
                            <span class="badge bg-success">Entrada</span>
                        @else
                            <span class="badge bg-danger">Salida</span>
                        @endif
                    </td>
                    <td>{{ $mov->cantidad }}</td>
                    <td>{{ $mov->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No hay movimientos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Paginación --}}
    <div class="d-flex justify-content-center">
        {{ $movimientos->links() }}
    </div>
</div>
@endsection