<?php

namespace GotoPeru;

use Illuminate\Database\Eloquent\Model;

class SubCliente extends Model
{
    public function clientes()
    {
        return $this->belongsTo(Cliente::class, 'clientes_id');
    }
}
