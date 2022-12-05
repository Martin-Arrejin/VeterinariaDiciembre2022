<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleClinico extends Model
{
    use HasFactory;

    public function historialClinico()
    {
        return $this->belongsTo(HistorialClinico::class);
    }
}
