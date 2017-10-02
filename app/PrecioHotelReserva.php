<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrecioHotelReserva extends Model
{
    //
    protected $table = "precio_hotel_reserva";

    public function paquete_cotizaciones()
    {
        return $this->belongsTo(PaqueteCotizaciones::class, 'paquete_cotizaciones_id');
    }
}
