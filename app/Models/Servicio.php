<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    public function unidades()
    {
        return $this->belongsToMany(Unidad::class,'servicios_unidades');
    }
}
