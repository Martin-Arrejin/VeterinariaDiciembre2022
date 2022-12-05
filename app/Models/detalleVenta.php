<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalleVenta extends Model
{
    use HasFactory;
public function venta(){
    return $this->belongsTo(venta::class);
}

public function lote(){
    return $this->belongsTo(loteDescripcion::class);
}

}
