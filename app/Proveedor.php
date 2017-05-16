<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    //
    protected $table = "proveedor";

    public function productos()
    {
        return $this->hasMany(M_Producto::class, 'proveedor_id');
    }
}
