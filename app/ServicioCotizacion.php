<?php

namespace GotoPeru;

use Illuminate\Database\Eloquent\Model;

class ServicioCotizacion extends Model
{
    protected $table = "servicio_cotizaciones";

    public function itinerario_cotizaciones()
    {
        return $this->belongsTo(ItinerarioCotizacion::class, 'itinerario_cotizaciones_id');
    }
}
