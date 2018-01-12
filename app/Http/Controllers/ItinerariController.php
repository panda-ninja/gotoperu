<?php

namespace App\Http\Controllers;

use App\M_Category;
use App\M_Destino;
use App\M_Itinerario;
use App\M_ItinerarioDestino;
use App\M_ItinerarioServicio;
use App\M_Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class ItinerariController extends Controller
{
    //
    public function index()
    {
        $destinations=M_Destino::get();
        $services=M_Servicio::get();
        $itinerarios=M_Itinerario::get();
        $categorias=M_Category::get();
        return view('admin.itinerary',['destinations'=>$destinations,'services'=>$services,'itinerarios'=>$itinerarios,'categorias'=>$categorias]);
    }

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
                        $servicios1='';
                        $precio_iti=0;
                        foreach($itinerario->itinerario_itinerario_servicios as $servicios){
                            $precio_iti+=$servicios->itinerario_servicios_servicio->precio;
                            $servicios1.=$servicios->itinerario_servicios_servicio->nombre.'/'.$servicios->itinerario_servicios_servicio->precio.'*';
                        }
                        $servicios1=substr($servicios1,0,strlen($servicios1)-1);
              $cadena.='<input type="checkbox" aria-label="..." name="itinerarios" value="'.$itinerario->id.'_'.$itinerario->titulo.'_'.$itinerario->descripcion.'_'.$precio_iti.'_'.$servicios1.'">
                      </span>

                            <input type="text" class="form-control" aria-label="..." value="'.$itinerario->titulo.'" readonly>

                            <span class="input-group-btn">
                            <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapse_'.$itinerario->id.'"><b>$'.$precio_iti.'</b> <i class="fa fa-arrows-v" aria-hidden="true"></i></button>
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

    public function store(Request $request){
        $txt_titulo=strtoupper($request->input('txt_titulo'));
        $txt_descripcion=$request->input('txt_descripcion');
        $destinos=$request->input('destinos');
        $servicios=$request->input('servicios');
        $precio_iti=$request->input('precio_itinerario');
        $txt_imagen=$request->file('txt_imagen');
        $txt_imagenB=$request->file('txt_imagenB');
        $txt_imagenC=$request->file('txt_imagenC');

        $itinerario=new M_Itinerario();
        $itinerario->titulo=$txt_titulo;
        $itinerario->descripcion=$txt_descripcion;
        $itinerario->precio=$precio_iti;
        $itinerario->imagen=$txt_imagen;
        $itinerario->imagen=$txt_imagenB;
        $itinerario->imagen=$txt_imagenC;
        $itinerario->save();
        if($txt_imagen){
            $filename ='itinerary-'.$itinerario->id.'.jpg';
            $itinerario->imagen=$filename;
            $itinerario->save();
            Storage::disk('itinerary')->put($filename,  File::get($txt_imagen));
        }
        if($txt_imagenB){
            $filename ='itinerary-'.$itinerario->id.'B.jpg';
            $itinerario->imagenB=$filename;
            $itinerario->save();
            Storage::disk('itinerary')->put($filename,  File::get($txt_imagenB));
        }
        if($txt_imagenC){
            $filename ='itinerary-'.$itinerario->id.'C.jpg';
            $itinerario->imagenC=$filename;
            $itinerario->save();
            Storage::disk('itinerary')->put($filename,  File::get($txt_imagenC));
        }
            foreach ($destinos as $destino){
                $dato=explode('_',$destino);
                $m_destino=M_Destino::FindOrFail($dato[0]);
                $itinerario_destino=new M_ItinerarioDestino();
                $itinerario_destino->codigo=$m_destino->codigo;
                $itinerario_destino->destino=$m_destino->destino;
                $itinerario_destino->departamento=$m_destino->departamento;
                $itinerario_destino->region=$m_destino->region;
                $itinerario_destino->pais=$m_destino->pais;
                $itinerario_destino->descripcion=$m_destino->descripcion;
                $itinerario_destino->imagen=$m_destino->imagen;
                $itinerario_destino->estado=1;
                $itinerario_destino->m_itinerario_id=$itinerario->id;
                $itinerario_destino->save();
            }

            foreach ($servicios as $servicio){
                $dato=explode('_',$servicio);
//                dd($dato);
                $m_servicio=M_Servicio::FindOrFail($dato[2]);
                $itinerario_servicio=new M_ItinerarioServicio();
                $itinerario_servicio->m_servicios_id=$m_servicio->id;
                $itinerario_servicio->m_itinerario_id=$itinerario->id;
                $itinerario_servicio->save();
            }
            $destinations=M_Destino::get();
            $services=M_Servicio::get();
            $itinerarios=M_Itinerario::get();
            $categorias=M_Category::get();
            return view('admin.itinerary',['destinations'=>$destinations,'services'=>$services,'itinerarios'=>$itinerarios,'categorias'=>$categorias]);
    }
    public function edit(Request $request){

        $txt_id=$request->input('itinerario_id');
        $txt_titulo=strtoupper($request->input('txt_titulo'));
        $txt_descripcion=$request->input('txt_descripcion');
        $destinos=$request->input('destinos');
        $servicios=$request->input('servicios'.$txt_id);
        $precio_iti=$request->input('precio_itinerario');
        $txt_imagen=$request->file('txt_imagen');
        $txt_imagenB=$request->file('txt_imagenB');
        $txt_imagenC=$request->file('txt_imagenC');

        $itinerario=M_Itinerario::FindOrFail($txt_id);
        $itinerario->titulo=$txt_titulo;
        $itinerario->descripcion=$txt_descripcion;
        $itinerario->precio=$precio_iti;
        $itinerario->save();
        if($txt_imagen){
            $filename ='itinerary-'.$itinerario->id.'.jpg';
            $itinerario->imagen=$filename;
            $itinerario->save();
            Storage::disk('itinerary')->put($filename,  File::get($txt_imagen));
        }
        if($txt_imagenB){
            $filename ='itinerary-'.$itinerario->id.'B.jpg';
            $itinerario->imagenB=$filename;
            $itinerario->save();
            Storage::disk('itinerary')->put($filename,  File::get($txt_imagenB));
        }
        if($txt_imagenC){
            $filename ='itinerary-'.$itinerario->id.'C.jpg';
            $itinerario->imagenC=$filename;
            $itinerario->save();
            Storage::disk('itinerary')->put($filename,  File::get($txt_imagenC));
        }

        M_ItinerarioDestino::where('m_itinerario_id',$txt_id)->delete();
        foreach ($destinos as $destino){
            $dato=explode('_',$destino);
            $m_destino=M_Destino::FindOrFail($dato[0]);
            $itinerario_destino=new M_ItinerarioDestino();
            $itinerario_destino->codigo=$m_destino->codigo;
            $itinerario_destino->destino=$m_destino->destino;
            $itinerario_destino->departamento=$m_destino->departamento;
            $itinerario_destino->region=$m_destino->region;
            $itinerario_destino->pais=$m_destino->pais;
            $itinerario_destino->descripcion=$m_destino->descripcion;
            $itinerario_destino->imagen=$m_destino->imagen;
            $itinerario_destino->estado=1;
            $itinerario_destino->m_itinerario_id=$itinerario->id;
            $itinerario_destino->save();
        }

        M_ItinerarioServicio::where('m_itinerario_id',$txt_id)->delete();
        foreach ($servicios as $servicio){
            $dato=explode('_',$servicio);
            $m_servicio=M_Servicio::FindOrFail($dato[2]);
            $itinerario_servicio=new M_ItinerarioServicio();
            $itinerario_servicio->m_servicios_id=$m_servicio->id;
            $itinerario_servicio->m_itinerario_id=$itinerario->id;
            $itinerario_servicio->save();
        }
        $destinations=M_Destino::get();
        $services=M_Servicio::get();
        $itinerarios=M_Itinerario::get();
        $categorias=M_Category::get();
        return view('admin.itinerary',['destinations'=>$destinations,'services'=>$services,'itinerarios'=>$itinerarios,'categorias'=>$categorias]);
    }
    public function delete(Request $request){
        $id=$request->input('id');
        $producto=M_Itinerario::FindOrFail($id);
        if($producto->delete())
            return 1;
        else
            return 0;
    }
    public function getItineraryImageName($filename){
//        return Storage::setVisibility($filename, 'public');
//        Storage::getVisibility($filename);
//        return $filename;
        $file = Storage::disk('itinerary')->get($filename);
        return new Response($file, 200);
    }
    public function getItineraryImage($filename){
        $file = Storage::disk('itinerary')->get($filename);
        return new Response($file, 200);
    }
}


