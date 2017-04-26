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
        $arreglo=array();
        foreach ($destinos as $desti){
            $arreglo[]=$desti;
        }
        $itinerarios=M_Itinerario::with(['destinos'=> function ($query) use ($arreglo) {
            $query->whereIn('destino', $arreglo);
        }])
        ->get();
//        dd($arreglo);
        $cadena='';
        foreach ($itinerarios as $itinerario){
            $cadena.='<div class="row margin-bottom-5">
                        <div class="input-group">
                      <span class="input-group-addon">';
                        $servicios='';
                        $precio_iti=0;
                        foreach($itinerario->itinerario_itinerario_servicios as $servicios){
                            $precio_iti+=$servicios->itinerario_servicios_servicio->precio;
                            $servicios.=$servicios->itinerario_servicios_servicio->nombre.'/'.$servicios->itinerario_servicios_servicio->precio.'*';
                        }
                        $servicios=substr($servicios,0,strlen($servicios)-1);
              $cadena.='<input type="checkbox" aria-label="..." name="itinerarios" value="'.$itinerario->id.'_'.$itinerario->titulo.'_'.$itinerario->descripcion.'_'.$precio_iti.'_'.$servicios.'">
                      </span>

                            <input type="text" class="form-control" aria-label="..." value="'.$itinerario->titulo.'" readonly>

                            <span class="input-group-btn">
                            <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapse_'.$itinerario->id.'"><b>$'.$itinerario->precio.'</b> <i class="fa fa-arrows-v" aria-hidden="true"></i></button>
                        </span>
                        </div><!-- /input-group -->
                        <div class="collapse clearfix" id="collapse_'.$itinerario->id.'">
                            <div class="col-md-12 well margin-top-5">
                                '.$itinerario->descripcion.'
                                <h5><b>Services</b></h5>
                                <table class="table table-condensed table-striped">
                                    <thead>
                                    <tr class="bg-grey-goto text-white">
                                        <th colspan="2">Concepts</th>
                                        <th>Prices</th>
                                    </tr>
                                    </thead>
                                    <tbody>';
                                    foreach($itinerario->itinerario_itinerario_servicios as $servicios){
                                        $cadena.='<tr>
                                                    <td>'.$servicios->itinerario_servicios_servicio->nombre.'</td>
                                                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                                                    <td>'.$servicios->itinerario_servicios_servicio->precio.'</td>
                                                </tr>';
                                    }
                                $cadena.='</tbody>
                                </table>
                            </div>
                        </div>
                    </div>';
        }
        return $cadena;

    }
}
