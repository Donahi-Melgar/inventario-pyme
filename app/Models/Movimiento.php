<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;

class Movimiento extends Model
{
    protected $fillable = [
        'producto_id',
        'tipo',
        'cantidad',
        'motivo',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}