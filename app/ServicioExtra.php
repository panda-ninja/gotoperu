<?php

namespace GotoPeru;

use Illuminate\Database\Eloquent\Model;

class ServicioExtra extends Model
{
    protected $table = "tservicio_extras";
    public function paquete_servicio_extra()
    {
//        return $this->belongsTo(ServicioExtra::class,'id');
        return $this->hasMany(TPaquete_servicio_extra::class, 'idservicio_extra');
    }
}
