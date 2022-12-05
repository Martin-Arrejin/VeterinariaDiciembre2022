<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loteDescripcion extends Model
{
    use HasFactory;


    public function articulo()
   {
     return $this->belongsTo(articulo::class);
   }

   public function detalles()
   {
     return $this->hasMany(detalleVenta::class);
   }
}

