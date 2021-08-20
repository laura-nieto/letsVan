<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asiento extends Model
{
    use HasFactory;

    public function corrida()
    {
        return $this->belongsTo(Corrida::class);
    }
    public function pasajero()
    {
        return $this->belongsTo(Pasajero::class);
    }
}
