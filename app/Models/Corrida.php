<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corrida extends Model
{
    use HasFactory;

    protected $dates = ['dia_salida','dia_llegada'];

    public function precio()
    {
        return $this->hasOne(Precio::class);
    }
    public function asientos()
    {
        return $this->hasMany(Asiento::class);
    }
    public function unidad()
    {
        return $this->belongsTo(Unidad::class);
    }
}
