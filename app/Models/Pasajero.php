<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasajero extends Model
{
    use HasFactory;

    public function asiento()
    {
        return $this->hasOne(Asiento::class);
    }
}
