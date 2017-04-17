<?php

namespace GotoPeru;

use Illuminate\Database\Eloquent\Model;

class PPaquete extends Model
{
    //
    protected $table = "ppaquete";

    public function precios()
    {
        return $this->hasMany(PPrecio::class, 'ppaquete_id');
    }

    public function destinos()
    {
        return $this->hasMany(PDestino::class, 'ppaquete_id');
    }

//    public function itinerarios()
//    {
//        return $this->hasMany(PItinerario::class, 'ppaquete_id');
//    }

}
