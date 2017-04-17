<?php

namespace GotoPeru;

use Illuminate\Database\Eloquent\Model;

class ClienteCotizacion extends Model
{
    protected $table = "cliente_cotizaciones";

    public function cotizaciones()
    {
        return $this->belongsTo(Cotizacion::class, 'cotizaciones_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'clientes_id');
    }

}
