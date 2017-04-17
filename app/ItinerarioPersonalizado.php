<?php

namespace GotoPeru;

use Illuminate\Database\Eloquent\Model;

class ItinerarioPersonalizado extends Model
{
    protected $fillable = [
        'titulo','paquete_personalizados_id'
    ];

    public function paquete_personalizados()
    {
        return $this->belongsTo(PaquetePersonalizado::class, 'paquete_cotizaciones_id');
    }

    public function itinerario_x_horas()
    {
        return $this->hasMany(ItinerarioXHora::class, 'itinerario_personalizados_id');
    }

    public function servicios()
    {
        return $this->hasMany(Servicio::class, 'itinerario_personalizados_id');
    }

}
