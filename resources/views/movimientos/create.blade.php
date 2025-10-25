@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Registrar Movimiento</h2>

    {{-- Mensaje de sesión --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Formulario --}}
    <form action="{{ route('movimientos.store') }}" method="POST" class="row g-3">
        @csrf

        <div class="col-md-6">
            <label for="producto_id" class="form-label">Producto</label>
            <select name="producto_id" id="producto_id" class="form-select @error('producto_id') is-invalid @enderror">
                <option value="">Seleccione un producto</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}" {{ old('producto_id') == $producto->id ? 'selected' : '' }}>
                        {{ $producto->nombre }} ({{ $producto->sku }})
                    </option>
                @endforeach
            </select>
            @error('producto_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-3">
            <label for="tipo" class="form-label">Tipo de movimiento</label>
            <select name="tipo" id="tipo" class="form-select @error('tipo') is-invalid @enderror">
                <option value="">Seleccione tipo</option>
                <option value="entrada" {{ old('tipo') == 'entrada' ? 'selected' : '' }}>Entrada</option>
                <option value="salida" {{ old('tipo') == 'salida' ? 'selected' : '' }}>Salida</option>
            </select>
            @error('tipo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control @error('cantidad') is-invalid @enderror" value="{{ old('cantidad') }}">
            @error('cantidad')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12 d-flex justify-content-end mt-3">
            <a href="{{ route('movimientos.index') }}" class="btn btn-secondary me-2">
                <i class="bi bi-arrow-left-circle"></i> Cancelar
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Registrar Movimiento
            </button>
        </div>
    </form>
</div>
@endsection