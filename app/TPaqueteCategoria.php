<?php

namespace GotoPeru;

use Illuminate\Database\Eloquent\Model;

class TPaqueteCategoria extends Model
{
    protected $table = "tpaquetescategoria";

    public function paquetes()
    {
        return $this->belongsTo(TPaquete::class, 'idpaquetes');
    }

    public function categoria()
    {
        return $this->belongsTo(TCategoria::class, 'idcategoria');
    }
}
