<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_ItinerarioServicio extends Model
{
    //
    protected $table = "m_itinerario_servicio";

    public function servicios_itinerario()
    {
        return $this->belongsTo(M_Itinerario::class, 'm_itinerario_id');
    }
    public function servicios()
    {
        return $this->belongsTo(M_Servicio::class, 'm_servicios_id');
    }
}
