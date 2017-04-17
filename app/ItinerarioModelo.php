<?php

namespace GotoPeru;

use Illuminate\Database\Eloquent\Model;

class ItinerarioModelo extends Model
{
    //
    protected $table = "itinerario_modelo";
    protected $fillable = [
        'dia','titulo','descripcion','precio','imagen','updated_at','created_at'
    ];

    protected $hidden = [
        '',
    ];
    public function ordenes()
    {
        return $this->hasMany(ItinerarioOrdenModelo::class, 'itinerario_modelo_id');
    }
    public function destinos()
    {
        return $this->belongTo(DestinoModelo::class, 'destino_modelo_id');
    }
}
