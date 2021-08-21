<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    use HasFactory;

    public function origen_tabla()
    {
        return $this->hasMany(Corrida::class,'origen');
    }
    public function destino_tabla()
    {
        return $this->hasMany(Corrida::class,'destino');
    }
}

