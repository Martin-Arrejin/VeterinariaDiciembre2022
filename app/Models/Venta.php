<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class venta extends Model
{
    use HasFactory;

public function detalle(){
    return $this->hasMany(detalleVenta::class);
}
public function cliente(){
    return $this->belongsTo(Persona::class);
}

}

