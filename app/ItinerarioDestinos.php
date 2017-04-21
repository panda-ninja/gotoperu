<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItinerarioDestinos extends Model
{
    //
    protected $table = "itinerario_destino";
    public function itinerario_cotizaciones()
    {
        return $this->belongsTo(ItinerarioCotizaciones::class, 'itinerario_cotizaciones_id');
    }
}
