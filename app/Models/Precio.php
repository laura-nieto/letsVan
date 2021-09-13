<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Precio extends Model
{
    use HasFactory;

    protected $fillable = [
        'adulto',
        'niño',
        'cupon_id',
    ];

    public function corrida()
    {
        return $this->belongsTo(Corrida::class);
    }
    public function cupon()
    {
        return $this->belongsTo(Cupon::class);
    }
}
