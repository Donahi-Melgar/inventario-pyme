<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Productos</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; margin-bottom: 10px; }
        footer { margin-top: 30px; font-size: 10px; text-align: center; color: #666; }
    </style>
</head>
<body>
    <h2>Listado de Productos</h2>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>SKU</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Proveedor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->sku }}</td>
                    <td>{{ $producto->cantidad }}</td>
                    <td>Q{{ number_format($producto->precio, 2) }}</td>
                    <td>{{ $producto->proveedor }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <footer>
        Generado el {{ now()->format('d/m/Y H:i') }} — Sistema de Inventario Pyme |
    </footer>
</body>
</html>