<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DestinoCotizacion extends Model
{
    protected $table = "destino_cotizaciones";

    public function paquetes_cotizaciones()
    {
        return $this->belongsTo(PaqueteCotizacion::class, 'paquete_cotizaciones_id');
    }
    public function itinerario_cotizaciones()
    {
        return $this->hasMany(ItinerarioCotizacion::class, 'destino_cotizaciones_id');
    }
}
