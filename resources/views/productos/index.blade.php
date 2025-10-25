@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Listado de Productos</h2>

    {{-- Mensaje de sesión --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Botones de exportación --}}
    <div class="mb-3 d-flex gap-2">
        <a href="{{ route('productos.export.excel') }}" class="btn btn-success">
            <i class="bi bi-file-earmark-excel"></i> Exportar Excel
        </a>
        <a href="{{ route('productos.export.pdf') }}" class="btn btn-danger">
            <i class="bi bi-file-earmark-pdf"></i> Exportar PDF
        </a>
    </div>

    {{-- Filtros --}}
    <form method="GET" action="{{ route('productos.index') }}" class="row g-3 mb-4">
        <div class="col-md-6">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre o SKU" value="{{ request('buscar') }}">
        </div>
        <div class="col-md-4">
            <select name="proveedor" class="form-select">
                <option value="">Todos los proveedores</option>
                @foreach($proveedores as $prov)
                    <option value="{{ $prov }}" {{ $prov == $proveedorSeleccionado ? 'selected' : '' }}>
                        {{ $prov }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-search"></i> Filtrar
            </button>
        </div>
    </form>

    {{-- Tabla de productos --}}
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Nombre</th>
                <th>SKU</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Proveedor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($productos as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->sku }}</td>
                    <td>{{ $producto->cantidad }}</td>
                    <td>Q{{ number_format($producto->precio, 2) }}</td>
                    <td>{{ $producto->proveedor }}</td>
                    <td class="d-flex gap-2">
                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>
                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este producto?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No hay productos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Paginación --}}
    <div class="d-flex justify-content-center">
        {{ $productos->links() }}
    </div>
</div>
@endsection