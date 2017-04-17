<?php

namespace GotoPeru;

//use Illuminate\Database\Eloquent\Model;
//use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cliente extends Authenticatable
{
    protected $fillable = [
        'id','nombres',
        'apellidos', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

//    public function sub_clientes()
//    {
//        return $this->hasMany(SubCliente::class, 'clientes_id');
//    }
//
//    public function cotizaciones()
//    {
//        return $this->hasMany(Cotizacion::class, 'clientes_id');
//    }

    public function cliente_cotizaciones()
    {
        return $this->hasMany(ClienteCotizacion::class, 'clientes_id');
    }

}
