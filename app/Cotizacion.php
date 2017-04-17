<?php

namespace GotoPeru;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    protected $table = "cotizaciones";

    protected $fillable = [
        'nropersonas','estado',
    ];

//    public function clientes()
//    {
//        return $this->belongsTo(Cliente::class, 'clientes_id');
//    }

//    public function paquete_personalizados()
//    {
//        return $this->belongsTo(PaquetePersonalizado::class, 'paquete_personalizados_id');
//    }

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'cotizaciones_id');
    }

    public function paquete_cotizaciones()
    {
        return $this->hasMany(PaqueteCotizacion::class, 'cotizaciones_id');
    }

    public function cliente_cotizaciones()
    {
        return $this->hasMany(ClienteCotizacion::class, 'cotizaciones_id');
    }
}
