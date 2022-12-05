<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class especie extends Model
{
    use HasFactory;

    public function razas()
    {
        return $this->hasMany(raza::class);
    }
}
