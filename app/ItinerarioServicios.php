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
    public function itinerario_proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
    public function servicio()
    {
        return $this->belongsTo(M_Servicio::class, 'm_servicios_id');
    }
}
