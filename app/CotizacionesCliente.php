<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CotizacionesCliente extends Model
{
    //
    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class, 'cotizaciones_id');
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
