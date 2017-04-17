<?php

namespace GotoPeru;

use Illuminate\Database\Eloquent\Model;

class PDestino extends Model
{
    //
    //
    protected $table = "pdestino";
    public function paquete()
    {
        return $this->belongsTo(PPaquete::class, 'ppaquete_id');
    }
    public function itinerarios()
    {
        return $this->hasMany(PItinerario::class, 'pdestino_id');
    }
}
