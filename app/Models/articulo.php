<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class articulo extends Model
{
    protected $fillable=['lote',
    'marca',
    'descripcion',
    'unidad',
    'garantia',
    'precioVenta',
    'precioCosto',
    'vencimiento',
    'elavoracion',
    'talle',
    'peso',
    'tamaño'];

    use HasFactory;

    public function categoria()
   {
     return $this->belongsTo(categoria::class);
   }

   public function lotes()
   {
    return $this->hasMany(loteDescripcion::class);
   } 

    //public function articuloAlertas()
    //{
      //  return $this->belongsTo(ArticuloAlerta::class);
    //}

}
