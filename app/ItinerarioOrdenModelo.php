<?php

namespace GotoPeru;

use Illuminate\Database\Eloquent\Model;

class ItinerarioOrdenModelo extends Model
{
    //
    protected $table = "itinerario_orden_modelo";
    protected $fillable = [
        'orden_modelo_id','itinerario_modelo_id'
    ];

    protected $hidden = [
        '',
    ];

    public function orden_modelo()
    {
        return $this->belongsTo(OrdenModelo::class, 'orden_modelo_id');
    }
    public function itinerario_modelo()
    {
        return $this->belongsTo(ItinerarioModelo::class, 'itinerario_modelo_id');
    }
}
