<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class raza extends Model
{
    use HasFactory;

    public function mascotas()
    {
        return $this->hasMany(Mascota::class);
    }
    public function historialClinico()
    {
        return $this->belongsTo(especie::class);
    }
}
