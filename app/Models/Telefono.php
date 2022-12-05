<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    use HasFactory;

    /**
     * Obtener la persona propietaria del teléfono.
     */
    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
