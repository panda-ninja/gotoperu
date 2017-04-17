<?php

namespace GotoPeru;

use Illuminate\Database\Eloquent\Model;

class ItinerarioCotizacion extends Model
{
    protected $table = "itinerario_cotizaciones";

//    public function paquetes_cotizaciones()
//    {
//        return $this->belongsTo(PaqueteCotizacion::class, 'cotizaciones_id');
//    }
//    public function paquetes_cotizaciones()
//    {
//        return $this->belongsTo(PaqueteCotizacion::class, 'paquete_cotizaciones_id');
//    }
    public function destino_cotizaciones()
    {
        return $this->belongTo(DestinoCotizacion::class, 'destino_cotizaciones_id');
    }
    public function horas_cotizaciones()
    {
        return $this->hasMany(HoraCotizacion::class, 'itinerario_cotizaciones_id');
    }

    public function servicios_cotizaciones()
    {
        return $this->hasMany(ServicioCotizacion::class, 'itinerario_cotizaciones_id');
    }
    public function ordenes()
    {
        return $this->hasMany(ItinerarioOrden::class, 'itinerario_cotizaciones_id');
    }
    public function orden_cotizaciones()
    {
        return $this->hasMany(ItinerarioOrden::class, 'itinerario_cotizaciones_id');
    }

}
