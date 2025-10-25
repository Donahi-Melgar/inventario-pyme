<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario Pyme</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap y Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

    {{-- Encabezado institucional --}}
    <header class="bg-white border-bottom py-2 px-3 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" height="40">
            <span class="fw-bold text-secondary"> Sistema de Gestión de Inventario Pyme</span>
        </div>
        <div class="text-muted small">
            {{ now()->format('d/m/Y H:i') }}
        </div>
    </header>

    {{-- Menú principal --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-primary" href="{{ route('productos.index') }}">
                <i class="bi bi-box-seam"></i> Inventario Pyme
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuPrincipal">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active text-primary fw-bold' : '' }}" href="{{ route('dashboard.index') }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('productos.index') ? 'active text-primary fw-bold' : '' }}" href="{{ route('productos.index') }}">
                            <i class="bi bi-list-ul"></i> Productos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('productos.create') ? 'active text-primary fw-bold' : '' }}" href="{{ route('productos.create') }}">
                            <i class="bi bi-plus-circle"></i> Registrar Producto
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('movimientos.index') ? 'active text-primary fw-bold' : '' }}" href="{{ route('movimientos.index') }}">
                            <i class="bi bi-arrow-left-right"></i> Movimientos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('movimientos.create') ? 'active text-primary fw-bold' : '' }}" href="{{ route('movimientos.create') }}">
                            <i class="bi bi-pencil-square"></i> Registrar Movimiento
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Contenido dinámico --}}
    <main class="container py-4">
        @yield('content')
    </main>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>