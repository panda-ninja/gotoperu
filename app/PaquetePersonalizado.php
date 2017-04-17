<?php

namespace GotoPeru;

use Illuminate\Database\Eloquent\Model;

class PaquetePersonalizado extends Model
{
    protected $fillable = [
        'codigo',
        'duracion'
    ];

    public function itinerario_personalizados()
    {
        return $this->hasMany(ItinerarioPersonalizado::class, 'paquete_personalizados_id');
    }

    public function cotizaciones()
    {
        return $this->hasMany(Cotizacion::class, 'paquete_personalizados_id');
    }
}
