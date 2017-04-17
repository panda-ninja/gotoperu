<?php

namespace GotoPeru;

use Illuminate\Database\Eloquent\Model;

class ItinerarioXHora extends Model
{
    protected $fillable = [
        'hora',
        'descripcion',
        'itinerario_personalizados_id'
    ];

    public function itinerario_personalizados()
    {
        return $this->belongsTo(ItinerarioPersonalizado::class, 'itinerario_personalizados_id');
    }
}
