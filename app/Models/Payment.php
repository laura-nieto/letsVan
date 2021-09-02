<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'pay'
    ];

    public function image()
    {
        return $this->hasOne(PaymentsImage::class);
    }

    public function comprador()
    {
        return $this->belongsTo(Comprador::class,'comprador_id');
    }

    public function corrida()
    {
        return $this->belongsTo(Corrida::class,'corrida_id');
    }
}
