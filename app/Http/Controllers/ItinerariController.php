<?php

namespace App\Http\Controllers;

use App\M_Itinerario;
use App\M_ItinerarioDestino;
use Illuminate\Http\Request;

class ItinerariController extends Controller
{
    //
    public function show_Itineraries(Request $request){
        $destinos=($request->input('destinos'));
        $destinos=explode('_',$destinos);

        $itineraios=M_Itinerario::with(['destinos'=> function ($query) use ($destinos) {
            $query->whereNotIn('destino', $destinos);
        }])

            ->get();
        dd($itineraios);
    }
}
