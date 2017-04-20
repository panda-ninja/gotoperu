<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class P_ItinerarioDestino extends Model
{
    //
    protected $table = "p_itinerario_destinos";
    public function destinos()
    {
        return $this->belongsTo(P_ItinerarioDestino::class,'p_itinerario_id');
    }
}
