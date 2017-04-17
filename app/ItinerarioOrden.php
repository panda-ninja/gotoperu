<?php

namespace GotoPeru;

use Illuminate\Database\Eloquent\Model;

class ItinerarioOrden extends Model
{
    //
    protected $table = "itinerario_orden";
    protected $fillable = [
        'itinerario_cotizaciones_id','nombre',
        'observavion', 'precio',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function orden_cotizaciones()
    {
        return $this->belongsTo(ItinerarioCotizacion::class, 'itinerario_cotizaciones_id');
    }
}
