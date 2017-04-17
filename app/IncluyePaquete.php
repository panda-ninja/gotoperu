<?php

namespace GotoPeru;

use Illuminate\Database\Eloquent\Model;

class IncluyePaquete extends Model
{
    protected $table = "incluye_paquetes";

    public function incluye_paquete()
    {
        return $this->hasMany(IncluyePaqueteCotizacion::class, 'incluye_paquetes_id');
    }
}
