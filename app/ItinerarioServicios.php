<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItinerarioServicios extends Model
{
    //
    protected $table = "itinerario_servicios";
    public function itinerario_cotizacion()
    {
        return $this->belongsTo(ItinerarioCotizaciones::class, 'itinerario_cotizaciones_id');
    }
}
