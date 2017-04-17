<?php

namespace GotoPeru;

use Illuminate\Database\Eloquent\Model;

class PrecioPaquete extends Model
{
    protected $table = "precio_paquetes";
    public function paquetes_cotizaciones()
    {
        return $this->belongsTo(PaqueteCotizacion::class, 'paquete_cotizaciones_id');
    }
}
