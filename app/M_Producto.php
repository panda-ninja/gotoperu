<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_Producto extends Model
{
    //
    protected $table = "m_producto";

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
}
