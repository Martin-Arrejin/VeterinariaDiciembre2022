<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory;

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function historialClinico()
    {
        return $this->hasOne(HistorialClinico::class);
    }

    public function raza()
    {
        return $this->belongsTo(raza::class);
    }
}
