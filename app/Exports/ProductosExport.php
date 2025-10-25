<?php

namespace App\Exports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductosExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Producto::select('nombre', 'sku', 'cantidad', 'precio', 'proveedor')->get();
    }

    public function headings(): array
    {
        return ['Nombre', 'SKU', 'Cantidad', 'Precio', 'Proveedor'];
    }
}