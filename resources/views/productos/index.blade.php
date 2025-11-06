@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between mb-3">
        <h3>Productos</h3>
        <div>
            <a href="{{ route('productos.create') }}" class="btn btn-success">Agregar producto</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button class="btn btn-outline-secondary">Cerrar sesión</button>
            </form>
        </div>
    </div>

    {{-- Barra de búsqueda simple --}}
    <form class="mb-3" method="GET" action="{{ route('productos.index') }}">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Buscar por nombre o SKU" value="{{ request('q') }}">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    {{-- Tabla --}}
    <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>SKU</th>
                <th>Cantidad</th>
                <th>Stock mínimo</th>
                <th>Precio</th>
                <th>Proveedor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $p)
            <tr @if($p->cantidad <= $p->stock_minimo) class="table-danger" title="Stock bajo" @endif>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->nombre }}</td>
                <td>{{ $p->sku }}</td>
                <td>
                    {{ $p->cantidad }}
                    @if($p->cantidad <= $p->stock_minimo)
                        <span class="badge bg-danger ms-2">Stock bajo</span>
                    @endif
                </td>
                <td>{{ $p->stock_minimo }}</td>
                <td>{{ number_format($p->precio,2) }}</td>
                <td>{{ $p->proveedor }}</td>
                <td>
                    <a href="{{ route('productos.edit', $p->id) }}" class="btn btn-sm btn-warning">Editar</a>

                    @if(auth()->user() && auth()->user()->isAdmin())
                        <form method="POST" action="{{ route('productos.destroy', $p->id) }}" style="display:inline-block;" onsubmit="return confirm('Eliminar producto?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    @endif

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    {{-- Paginación --}}
    <div class="d-flex justify-content-center">
        {{ $productos->links() }}
    </div>
</div>
@endsection
