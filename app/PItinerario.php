<?php

namespace GotoPeru;

use Illuminate\Database\Eloquent\Model;

class PItinerario extends Model
{
    //
    protected $table = "pitinerario";

    public function destino()
    {
        return $this->belongsTo(PDestino::class, 'pdestino_id');
    }
    public function ordenes()
    {
        return $this->hasMany(PItinerarioOrden::class, 'pitinerario_id');
    }
}
