<?php

namespace GotoPeru;

use Illuminate\Database\Eloquent\Model;

class OrdenModelo extends Model
{
    //
    protected $table = "orden_modelo";


    protected $hidden = [
        '',
    ];
    public function orden_asociado()
    {
        return $this->hasMany(ItinerarioOrdenModelo::class, 'orden_modelo_id');
    }
}
