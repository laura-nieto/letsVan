<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;

    protected $table = 'unidades';

    public function corrida()
    {
        return $this->hasOne(Corrida::class);
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class,'servicios_unidades');
    }

}
