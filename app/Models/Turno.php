<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;

    protected $contenidoTabla = ['title','star','end'];

 /**
     * Obtener la persona propietaria del teléfono.
     */
    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
