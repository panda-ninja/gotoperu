<?php

namespace GotoPeru;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    public function cotizaciones()
    {
        return $this->belongsTo(Cotizacion::class, 'cotizaciones_id');
    }
}
