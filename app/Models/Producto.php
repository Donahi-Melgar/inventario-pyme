<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'sku',
        'cantidad',
        'precio',
        'proveedor',
    ];

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }
}