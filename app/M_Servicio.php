<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_Servicio extends Model
{

    //
    protected $table = "m_servicios";

    public function servicios()
    {
        return $this->hasMany(M_ItinerarioServicio::class, 'm_servicios_id');
    }
}
