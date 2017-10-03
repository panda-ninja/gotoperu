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
    public function servicios()
    {
        return $this->hasMany(ItinerarioServicios::class, 'proveedor_id');
    }
    public function hotel()
    {
        return $this->hasMany(HotelProveedor::class, 'proveedor_id');
    }
    public function hotel_reserva()
    {
        return $this->hasMany(PrecioHotelReserva::class, 'proveedor_id');
    }
}
