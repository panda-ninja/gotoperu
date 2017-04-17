<?php

namespace GotoPeru;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = "orden";
    protected $fillable = [
        'nombre',
        'estado',
    ];

    protected $hidden = [
        'remember_token',
    ];

}
