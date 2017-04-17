<?php

namespace GotoPeru;

use Illuminate\Database\Eloquent\Model;

class PPrecio extends Model
{
    //
    //
    protected $table = "pprecio";
    public function paquete()
    {
        return $this->belongsTo(PPaquete::class, 'ppaquete_id');
    }

}
