<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $fillable = [
        'precio',
        'observaciones',

    ];

//    public function itinerario_personalizados()
//    {
//        return $this->belongsTo(ItinerarioPersonalizado::class, 'itinerario_personalizados_id');
//    }
}
