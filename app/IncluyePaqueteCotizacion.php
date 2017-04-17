<?php

namespace GotoPeru;

use Illuminate\Database\Eloquent\Model;

class IncluyePaqueteCotizacion extends Model
{
    protected $table = "incluye_paquete_cotizaciones";

    public function paquetes_cotizaciones()
    {
        return $this->belongsTo(PaqueteCotizacion::class, 'paquete_cotizaciones_id');
    }

    public function incluye()
    {
        return $this->belongsTo(IncluyePaquete::class, 'incluye_paquetes_id');
    }


}
