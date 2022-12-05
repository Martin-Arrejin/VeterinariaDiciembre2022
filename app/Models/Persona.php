<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    /**
     * Obtener teléfonos de la persona.
     */
    public function telefonos()
    {
        return $this->hasone(Telefono::class);
    }

    /**
     * Obtener teléfonos de la persona.
     */
    public function turnos()
    {
        return $this->hasMany(Turno::class);
    }

    public function mascotas()
    {
        return $this->hasMany(Mascota::class);
    }
    
}