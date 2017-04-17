<?php

namespace GotoPeru;

use Illuminate\Database\Eloquent\Model;

class PItinerarioOrden extends Model
{
    //
    //
    protected $table = "pitinerario_orden";
    public function itinerario()
    {
        return $this->belongsTo(PItinerario::class, 'pitinerario_id');
    }
}
