<?php

namespace GotoPeru;

use Illuminate\Database\Eloquent\Model;

class HoraCotizacion extends Model
{
    protected $table = "hora_cotizaciones";

    public function itinerario_cotizaciones()
    {
        return $this->belongsTo(ItinerarioCotizacion::class, 'itinerario_cotizaciones_id');
    }
}
