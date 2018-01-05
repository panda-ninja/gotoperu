<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\M_Destino;
use App\M_Itinerario;
use App\M_Servicio;
use App\P_Itinerario;
use App\P_ItinerarioDestino;
use App\P_ItinerarioServicios;
use App\P_Paquete;
use App\P_PaquetePrecio;
use Illuminate\Http\Request;

use Mockery\Exception;
use PhpParser\Node\Expr\Array_;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Redirect;
use Psy\Test\Readline\HoaConsoleTest;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //--
    }

    public function catalog()
    {
        return view('admin.catalog');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $destinos=M_Destino::get();
        $itinerarios=M_Itinerario::get();
        $m_servicios=M_Servicio::get();
        $hotel=Hotel::get();
//        dd($servicios);
        return view('admin.package',['destinos'=>$destinos,'itinerarios'=>$itinerarios,'m_servicios'=>$m_servicios,'hotel'=>$hotel]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $txt_day=strtoupper(($request->input('txt_day')));
        $txt_code=strtoupper(($request->input('txt_codigo')));
        $txt_title=strtoupper(($request->input('txt_title')));
        $txta_description=$request->input('txta_description');
        $txta_include=$request->input('txta_include');
        $txta_notinclude=$request->input('txta_notinclude');
        $totalItinerario=$request->input('totalItinerario');
        $itinerarios_=$request->input('itinerarios_');
        $txt_sugerencia=$request->input('txt_sugerencia');
        $hotel_id_2=$request->input('hotel_id_2');
        $hotel_id_3=$request->input('hotel_id_3');
        $hotel_id_4=$request->input('hotel_id_4');
        $hotel_id_5=$request->input('hotel_id_5');

        $strellas_2=$request->input('strellas_2');
        $strellas_3=$request->input('strellas_3');
        $strellas_4=$request->input('strellas_4');
        $strellas_5=$request->input('strellas_5');

        $amount_t2=$request->input('amount_t2');
        $amount_d2=$request->input('amount_d2');
        $amount_s2=$request->input('amount_s2');

        $amount_t3=$request->input('amount_t3');
        $amount_d3=$request->input('amount_d3');
        $amount_s3=$request->input('amount_s3');

        $amount_t4=$request->input('amount_t4');
        $amount_d4=$request->input('amount_d4');
        $amount_s4=$request->input('amount_s4');

        $amount_t5=$request->input('amount_t5');
        $amount_d5=$request->input('amount_d5');
        $amount_s5=$request->input('amount_s5');

        $profit_2=$request->input('profitt_2');
        $profit_3=$request->input('profitt_3');
        $profit_4=$request->input('profitt_4');
        $profit_5=$request->input('profitt_5');

        $plantillas= P_Paquete::where('duracion',$txt_day)->get();
        $diferencia = 4 - strlen(count($plantillas));
        $numero_con_ceros='';
        for($i = 0 ; $i < $diferencia; $i++)
        {
            $numero_con_ceros .= 0;
        }

        $numero_con_ceros.= count($plantillas);
        $plantilla_pqt= new P_Paquete();
        $plantilla_pqt->codigo='GTP'.$txt_day.$numero_con_ceros;

        $paquete=new P_Paquete();
        $paquete->codigo=$txt_code;
        $paquete->titulo=$txt_title;
        $paquete->duracion=$txt_day;
        $paquete->descripcion=$txta_description;
        $paquete->incluye=$txta_include;
        $paquete->noincluye=$txta_notinclude;
        $paquete->utilidad=40;
        $paquete->estado=1;
        $paquete->preciocosto=$totalItinerario;
        $paquete->save();

        $paquete_precio2=new P_PaquetePrecio();
        $paquete_precio2->estrellas=2;
        $paquete_precio2->precio_s=$amount_s2;
        $paquete_precio2->personas_s=1;
        $paquete_precio2->precio_m=$amount_d2;
        $paquete_precio2->personas_m=1;
        $paquete_precio2->precio_d=$amount_d2;
        $paquete_precio2->personas_d=1;
        $paquete_precio2->precio_t=$amount_t2;
        $paquete_precio2->personas_t=1;
        if($strellas_2==2)
            $paquete_precio2->estado=1;
        else
            $paquete_precio2->estado=0;
        $paquete_precio2->utilidad=$profit_2;
        $paquete_precio2->p_paquete_id=$paquete->id;
        $paquete_precio2->hotel_id=$hotel_id_2;
        $paquete_precio2->save();

        $paquete_precio3=new P_PaquetePrecio();
        $paquete_precio3->estrellas=3;
        $paquete_precio3->precio_s=$amount_s3;
        $paquete_precio3->personas_s=1;
        $paquete_precio3->precio_m=$amount_d3;
        $paquete_precio3->personas_m=1;
        $paquete_precio3->precio_d=$amount_d3;
        $paquete_precio3->personas_d=1;
        $paquete_precio3->precio_t=$amount_t3;
        $paquete_precio3->personas_t=1;
        if($strellas_3==3)
            $paquete_precio3->estado=1;
        else
            $paquete_precio3->estado=0;
        $paquete_precio3->utilidad=$profit_3;
        $paquete_precio3->p_paquete_id=$paquete->id;
        $paquete_precio3->hotel_id=$hotel_id_3;
        $paquete_precio3->save();

        $paquete_precio4=new P_PaquetePrecio();
        $paquete_precio4->estrellas=4;
        $paquete_precio4->precio_s=$amount_s4;
        $paquete_precio4->personas_s=1;
        $paquete_precio4->precio_m=$amount_d4;
        $paquete_precio4->personas_m=1;
        $paquete_precio4->precio_d=$amount_d4;
        $paquete_precio4->personas_d=1;
        $paquete_precio4->precio_t=$amount_t4;
        $paquete_precio4->personas_t=1;
        if($strellas_4==4)
            $paquete_precio4->estado=1;
        else
            $paquete_precio4->estado=0;
        $paquete_precio4->utilidad=$profit_4;
        $paquete_precio4->p_paquete_id=$paquete->id;
        $paquete_precio4->hotel_id=$hotel_id_4;
        $paquete_precio4->save();

        $paquete_precio5=new P_PaquetePrecio();
        $paquete_precio5->estrellas=5;
        $paquete_precio5->precio_s=$amount_s5;
        $paquete_precio5->personas_s=1;
        $paquete_precio5->precio_m=$amount_d5;
        $paquete_precio5->personas_m=1;
        $paquete_precio5->precio_d=$amount_d5;
        $paquete_precio5->personas_d=1;
        $paquete_precio5->precio_t=$amount_t5;
        $paquete_precio5->personas_t=1;
        if($strellas_5==5)
            $paquete_precio5->estado=1;
        else
            $paquete_precio5->estado=0;
        $paquete_precio5->utilidad=$profit_5;
        $paquete_precio5->p_paquete_id=$paquete->id;
        $paquete_precio5->hotel_id=$hotel_id_5;
        $paquete_precio5->save();
        $dia=0;
        foreach ($itinerarios_ as $itinerario_id){
            $dia_=$dia+1;
            $m_itineario=M_Itinerario::FindOrFail($itinerario_id);
            $p_itinerario=new P_Itinerario();
            $p_itinerario->titulo=$m_itineario->titulo;
            $p_itinerario->descripcion=$m_itineario->descripcion;
            $p_itinerario->dias=$dia_;
            $p_itinerario->precio=$m_itineario->precio;
            $p_itinerario->imagen=$m_itineario->imagen;
            $p_itinerario->sugerencia=$txt_sugerencia[$dia];
            $p_itinerario->estado=1;
            $p_itinerario->p_paquete_id=$paquete->id;
            $p_itinerario->save();
            $dia++;
            foreach ($m_itineario->destinos as $m_destinos){
                $p_destinos=new P_ItinerarioDestino();
                $p_destinos->codigo=$m_destinos->codigo;
                $p_destinos->destino=$m_destinos->destino;
                $p_destinos->region=$m_destinos->region;
                $p_destinos->pais=$m_destinos->pais;
                $p_destinos->descripcion=$m_destinos->descripcion;
                $p_destinos->imagen=$m_destinos->imagen;
                $p_destinos->estado=1;
                $p_destinos->p_itinerario_id=$p_itinerario->id;
                $p_destinos->save();
            }
            $st=0;
            foreach($m_itineario->itinerario_itinerario_servicios as $servicios){
                $p_servicio=new P_ItinerarioServicios();
                $p_servicio->nombre=$servicios->itinerario_servicios_servicio->nombre;
                $p_servicio->min_personas=$servicios->itinerario_servicios_servicio->min_personas;
                $p_servicio->max_personas=$servicios->itinerario_servicios_servicio->max_personas;
                $p_servicio->observacion='';
                if($servicios->itinerario_servicios_servicio->precio_grupo==1) {
                    $p_servicio->precio = round($servicios->itinerario_servicios_servicio->precio_venta / 2,2);
                    $p_servicio->precio_grupo = 1;
                }
                else{
                    $p_servicio->precio = $servicios->itinerario_servicios_servicio->precio_venta;
                    $p_servicio->precio_grupo=0;
                }
                $st+=$p_servicio->precio;
                $p_servicio->p_itinerario_id=$p_itinerario->id;
                $p_servicio->m_servicios_id=$servicios->itinerario_servicios_servicio->id;

                $p_servicio->save();
            }
            $p_itinerario->precio=$st;
            $p_itinerario->save();
        }
        $destinos=M_Destino::get();
        $itinerarios=M_Itinerario::get();
        $m_servicios=M_Servicio::get();
        $hotel=Hotel::get();
        return view('admin.package',['destinos'=>$destinos,'itinerarios'=>$itinerarios,'m_servicios'=>$m_servicios,'hotel'=>$hotel]);
    }
    public function itineraries()
    {
        $itineraries=P_Paquete::get();
        return view('admin.show-itineraries',['itineraries'=>$itineraries]);
    }
    public function show_itinerary($id)
    {
        $destinos=M_Destino::get();
        $itinerarios=M_Itinerario::get();
        $m_servicios=M_Servicio::get();
        $itinerary=P_Paquete::FindOrFail($id);
        return view('admin.show-itinerary',['itinerary'=>$itinerary,'destinos'=>$destinos,'itinerarios'=>$itinerarios,'m_servicios'=>$m_servicios,'paquete_id'=>$id]);
    }
    public function duplicate_itinerary($id)
    {
        $destinos=M_Destino::get();
        $itinerarios=M_Itinerario::get();
        $m_servicios=M_Servicio::get();
        $itinerary=P_Paquete::FindOrFail($id);
        return view('admin.duplicate-itinerary',['itinerary'=>$itinerary,'destinos'=>$destinos,'itinerarios'=>$itinerarios,'m_servicios'=>$m_servicios,'paquete_id'=>$id]);
    }

    public function itinerary_edit(Request $request)
    {
        $paquete_id=$request->input('paquete_id');
        $txt_day=strtoupper(($request->input('txt_day')));
        $txt_code=strtoupper(($request->input('txt_codigo')));
        $txt_title=strtoupper(($request->input('txt_title')));
        $txta_description=$request->input('txta_description');
        $txta_include=$request->input('txta_include');
        $txta_notinclude=$request->input('txta_notinclude');
        $totalItinerario=$request->input('totalItinerario');
        $itinerarios_=$request->input('itinerarios_');
        $txt_sugerencia=$request->input('txt_sugerencia');

        $strellas_2=$request->input('strellas_2');
        $strellas_3=$request->input('strellas_3');
        $strellas_4=$request->input('strellas_4');
        $strellas_5=$request->input('strellas_5');

        $amount_t2=$request->input('amount_t2');
        $amount_d2=$request->input('amount_d2');
        $amount_s2=$request->input('amount_s2');

        $amount_t3=$request->input('amount_t3');
        $amount_d3=$request->input('amount_d3');
        $amount_s3=$request->input('amount_s3');

        $amount_t4=$request->input('amount_t4');
        $amount_d4=$request->input('amount_d4');
        $amount_s4=$request->input('amount_s4');

        $amount_t5=$request->input('amount_t5');
        $amount_d5=$request->input('amount_d5');
        $amount_s5=$request->input('amount_s5');

        $profit_2=$request->input('profitt_2');
        $profit_3=$request->input('profitt_3');
        $profit_4=$request->input('profitt_4');
        $profit_5=$request->input('profitt_5');

        $hotel_id_2=$request->input('hotel_id_2');
        $hotel_id_3=$request->input('hotel_id_3');
        $hotel_id_4=$request->input('hotel_id_4');
        $hotel_id_5=$request->input('hotel_id_5');


//        dd('profit_2:'.$profit_2.',profit_3:'.$profit_3.',profit_4:'.$profit_4.',profit_5:'.$profit_5);
//        dd($txta_include.'_'.$txta_notinclude);
        $paquete=P_Paquete::FindOrFail($paquete_id);
        $paquete->codigo=$txt_code;
        $paquete->titulo=$txt_title;
        $paquete->duracion=$txt_day;
        $paquete->descripcion=$txta_description;
        $paquete->incluye=$txta_include;
        $paquete->noincluye=$txta_notinclude;
        $paquete->utilidad=40;
        $paquete->estado=1;
        $paquete->preciocosto=$totalItinerario;
        $paquete->save();

        $p_paquete_precio=P_PaquetePrecio::where('p_paquete_id',$paquete_id)->delete();
        $p_paquete_itinerario=P_Itinerario::where('p_paquete_id',$paquete_id)->delete();

        $paquete_precio2=new P_PaquetePrecio();
        $paquete_precio2->estrellas=2;
        $paquete_precio2->precio_s=$amount_s2;
        $paquete_precio2->personas_s=1;
        $paquete_precio2->precio_m=$amount_d2;
        $paquete_precio2->personas_m=1;
        $paquete_precio2->precio_d=$amount_d2;
        $paquete_precio2->personas_d=1;
        $paquete_precio2->precio_t=$amount_t2;
        $paquete_precio2->personas_t=1;
        if($strellas_2==2)
            $paquete_precio2->estado=1;
        else
            $paquete_precio2->estado=0;
        $paquete_precio2->utilidad=$profit_2;
        $paquete_precio2->p_paquete_id=$paquete->id;
        $paquete_precio2->hotel_id=$hotel_id_2;
        $paquete_precio2->save();

        $paquete_precio3=new P_PaquetePrecio();
        $paquete_precio3->estrellas=3;
        $paquete_precio3->precio_s=$amount_s3;
        $paquete_precio3->personas_s=1;
        $paquete_precio3->precio_m=$amount_d3;
        $paquete_precio3->personas_m=1;
        $paquete_precio3->precio_d=$amount_d3;
        $paquete_precio3->personas_d=1;
        $paquete_precio3->precio_t=$amount_t3;
        $paquete_precio3->personas_t=1;
        if($strellas_3==3)
            $paquete_precio3->estado=1;
        else
            $paquete_precio3->estado=0;
        $paquete_precio3->utilidad=$profit_3;
        $paquete_precio3->p_paquete_id=$paquete->id;
        $paquete_precio3->hotel_id=$hotel_id_3;
        $paquete_precio3->save();

        $paquete_precio4=new P_PaquetePrecio();
        $paquete_precio4->estrellas=4;
        $paquete_precio4->precio_s=$amount_s4;
        $paquete_precio4->personas_s=1;
        $paquete_precio4->precio_m=$amount_d4;
        $paquete_precio4->personas_m=1;
        $paquete_precio4->precio_d=$amount_d4;
        $paquete_precio4->personas_d=1;
        $paquete_precio4->precio_t=$amount_t4;
        $paquete_precio4->personas_t=1;
        if($strellas_4==4)
            $paquete_precio4->estado=1;
        else
            $paquete_precio4->estado=0;
        $paquete_precio4->utilidad=$profit_4;
        $paquete_precio4->p_paquete_id=$paquete->id;
        $paquete_precio4->hotel_id=$hotel_id_4;
        $paquete_precio4->save();

        $paquete_precio5=new P_PaquetePrecio();
        $paquete_precio5->estrellas=5;
        $paquete_precio5->precio_s=$amount_s5;
        $paquete_precio5->personas_s=1;
        $paquete_precio5->precio_m=$amount_d5;
        $paquete_precio5->personas_m=1;
        $paquete_precio5->precio_d=$amount_d5;
        $paquete_precio5->personas_d=1;
        $paquete_precio5->precio_t=$amount_t5;
        $paquete_precio5->personas_t=1;
        if($strellas_5==5)
            $paquete_precio5->estado=1;
        else
            $paquete_precio5->estado=0;
        $paquete_precio5->utilidad=$profit_5;
        $paquete_precio5->p_paquete_id=$paquete->id;
        $paquete_precio5->hotel_id=$hotel_id_5;
        $paquete_precio5->save();
        $dia=0;
        foreach ($itinerarios_ as $itinerario_id){
            $dia_=$dia+1;
            $m_itineario=M_Itinerario::FindOrFail($itinerario_id);
            $p_itinerario=new P_Itinerario();
            $p_itinerario->titulo=$m_itineario->titulo;
            $p_itinerario->descripcion=$m_itineario->descripcion;
            $p_itinerario->dias=$dia_;
            $p_itinerario->precio=$m_itineario->precio;
            $p_itinerario->imagen=$m_itineario->imagen;
            $p_itinerario->sugerencia=$txt_sugerencia[$dia];
            $p_itinerario->estado=1;
            $p_itinerario->p_paquete_id=$paquete->id;
            $p_itinerario->save();
            $dia++;
            foreach ($m_itineario->destinos as $m_destinos){
                $p_destinos=new P_ItinerarioDestino();
                $p_destinos->codigo=$m_destinos->codigo;
                $p_destinos->destino=$m_destinos->destino;
                $p_destinos->region=$m_destinos->region;
                $p_destinos->pais=$m_destinos->pais;
                $p_destinos->descripcion=$m_destinos->descripcion;
                $p_destinos->imagen=$m_destinos->imagen;
                $p_destinos->estado=1;
                $p_destinos->p_itinerario_id=$p_itinerario->id;
                $p_destinos->save();
            }
            $st=0;
            foreach($m_itineario->itinerario_itinerario_servicios as $servicios){
                $p_servicio=new P_ItinerarioServicios();
                $p_servicio->nombre=$servicios->itinerario_servicios_servicio->nombre;
                $p_servicio->min_personas=$servicios->itinerario_servicios_servicio->min_personas;
                $p_servicio->max_personas=$servicios->itinerario_servicios_servicio->max_personas;
                $p_servicio->observacion='';
                if($servicios->itinerario_servicios_servicio->precio_grupo==1) {
                    $p_servicio->precio = round($servicios->itinerario_servicios_servicio->precio_venta / 2,2);
                    $p_servicio->precio_grupo = 1;
                }
                else{
                    $p_servicio->precio = $servicios->itinerario_servicios_servicio->precio_venta;
                    $p_servicio->precio_grupo=0;
                }
                $st+=$p_servicio->precio;
                $p_servicio->p_itinerario_id=$p_itinerario->id;
                $p_servicio->m_servicios_id = $servicios->itinerario_servicios_servicio->id;
                $p_servicio->save();
            }
            $p_itinerario->precio=$st;
            $p_itinerario->save();
        }
        $itineraries=P_Paquete::get();
        return view('admin.show-itineraries',['itineraries'=>$itineraries]);
    }
    public function itinerary_duplicate(Request $request)
    {
//        $paquete_id=$request->input('paquete_id');
        $txt_day=strtoupper(($request->input('txt_day')));
        $txt_code=strtoupper(($request->input('txt_codigo')));
        $txt_title=strtoupper(($request->input('txt_title')));
        $txta_description=$request->input('txta_description');
        $txta_include=$request->input('txta_include');
        $txta_notinclude=$request->input('txta_notinclude');
        $totalItinerario=$request->input('totalItinerario');
        $itinerarios_=$request->input('itinerarios_');
        $txt_sugerencia=$request->input('txt_sugerencia');

        $strellas_2=$request->input('strellas_2');
        $strellas_3=$request->input('strellas_3');
        $strellas_4=$request->input('strellas_4');
        $strellas_5=$request->input('strellas_5');

        $amount_t2=$request->input('amount_t2');
        $amount_d2=$request->input('amount_d2');
        $amount_s2=$request->input('amount_s2');

        $amount_t3=$request->input('amount_t3');
        $amount_d3=$request->input('amount_d3');
        $amount_s3=$request->input('amount_s3');

        $amount_t4=$request->input('amount_t4');
        $amount_d4=$request->input('amount_d4');
        $amount_s4=$request->input('amount_s4');

        $amount_t5=$request->input('amount_t5');
        $amount_d5=$request->input('amount_d5');
        $amount_s5=$request->input('amount_s5');

        $profit_2=$request->input('profitt_2');
        $profit_3=$request->input('profitt_3');
        $profit_4=$request->input('profitt_4');
        $profit_5=$request->input('profitt_5');

//        dd('profit_2:'.$profit_2.',profit_3:'.$profit_3.',profit_4:'.$profit_4.',profit_5:'.$profit_5);
//        dd($txta_include.'_'.$txta_notinclude);
        $paquete=new P_Paquete();
        $paquete->codigo=$txt_code;
        $paquete->titulo=$txt_title;
        $paquete->duracion=$txt_day;
        $paquete->descripcion=$txta_description;
        $paquete->incluye=$txta_include;
        $paquete->noincluye=$txta_notinclude;
        $paquete->utilidad=40;
        $paquete->estado=1;
        $paquete->preciocosto=$totalItinerario;
        $paquete->save();

        $paquete_precio2=new P_PaquetePrecio();
        $paquete_precio2->estrellas=2;
        $paquete_precio2->precio_s=$amount_s2;
        $paquete_precio2->personas_s=1;
        $paquete_precio2->precio_m=$amount_d2;
        $paquete_precio2->personas_m=1;
        $paquete_precio2->precio_d=$amount_d2;
        $paquete_precio2->personas_d=1;
        $paquete_precio2->precio_t=$amount_t2;
        $paquete_precio2->personas_t=1;
        if($strellas_2==2)
            $paquete_precio2->estado=1;
        else
            $paquete_precio2->estado=0;
        $paquete_precio2->utilidad=$profit_2;
        $paquete_precio2->p_paquete_id=$paquete->id;
        $paquete_precio2->save();

        $paquete_precio3=new P_PaquetePrecio();
        $paquete_precio3->estrellas=3;
        $paquete_precio3->precio_s=$amount_s3;
        $paquete_precio3->personas_s=1;
        $paquete_precio3->precio_m=$amount_d3;
        $paquete_precio3->personas_m=1;
        $paquete_precio3->precio_d=$amount_d3;
        $paquete_precio3->personas_d=1;
        $paquete_precio3->precio_t=$amount_t3;
        $paquete_precio3->personas_t=1;
        if($strellas_3==3)
            $paquete_precio3->estado=1;
        else
            $paquete_precio3->estado=0;
        $paquete_precio3->utilidad=$profit_3;
        $paquete_precio3->p_paquete_id=$paquete->id;
        $paquete_precio3->save();

        $paquete_precio4=new P_PaquetePrecio();
        $paquete_precio4->estrellas=4;
        $paquete_precio4->precio_s=$amount_s4;
        $paquete_precio4->personas_s=1;
        $paquete_precio4->precio_m=$amount_d4;
        $paquete_precio4->personas_m=1;
        $paquete_precio4->precio_d=$amount_d4;
        $paquete_precio4->personas_d=1;
        $paquete_precio4->precio_t=$amount_t4;
        $paquete_precio4->personas_t=1;
        if($strellas_4==4)
            $paquete_precio4->estado=1;
        else
            $paquete_precio4->estado=0;
        $paquete_precio4->utilidad=$profit_4;
        $paquete_precio4->p_paquete_id=$paquete->id;
        $paquete_precio4->save();

        $paquete_precio5=new P_PaquetePrecio();
        $paquete_precio5->estrellas=5;
        $paquete_precio5->precio_s=$amount_s5;
        $paquete_precio5->personas_s=1;
        $paquete_precio5->precio_m=$amount_d5;
        $paquete_precio5->personas_m=1;
        $paquete_precio5->precio_d=$amount_d5;
        $paquete_precio5->personas_d=1;
        $paquete_precio5->precio_t=$amount_t5;
        $paquete_precio5->personas_t=1;
        if($strellas_5==5)
            $paquete_precio5->estado=1;
        else
            $paquete_precio5->estado=0;
        $paquete_precio5->utilidad=$profit_5;
        $paquete_precio5->p_paquete_id=$paquete->id;
        $paquete_precio5->save();
        $dia=0;
        foreach ($itinerarios_ as $itinerario_id){
            $dia_=$dia+1;
            $m_itineario=M_Itinerario::FindOrFail($itinerario_id);
            $p_itinerario=new P_Itinerario();
            $p_itinerario->titulo=$m_itineario->titulo;
            $p_itinerario->descripcion=$m_itineario->descripcion;
            $p_itinerario->dias=$dia_;
            $p_itinerario->precio=$m_itineario->precio;
            $p_itinerario->imagen=$m_itineario->imagen;
            $p_itinerario->sugerencia=$txt_sugerencia[$dia];
            $p_itinerario->estado=1;
            $p_itinerario->p_paquete_id=$paquete->id;
            $p_itinerario->save();
            $dia++;
            foreach ($m_itineario->destinos as $m_destinos){
                $p_destinos=new P_ItinerarioDestino();
                $p_destinos->codigo=$m_destinos->codigo;
                $p_destinos->destino=$m_destinos->destino;
                $p_destinos->region=$m_destinos->region;
                $p_destinos->pais=$m_destinos->pais;
                $p_destinos->descripcion=$m_destinos->descripcion;
                $p_destinos->imagen=$m_destinos->imagen;
                $p_destinos->estado=1;
                $p_destinos->p_itinerario_id=$p_itinerario->id;
                $p_destinos->save();
            }
            $st=0;
            foreach($m_itineario->itinerario_itinerario_servicios as $servicios){
                $p_servicio=new P_ItinerarioServicios();
                $p_servicio->nombre=$servicios->itinerario_servicios_servicio->nombre;
                $p_servicio->min_personas=$servicios->itinerario_servicios_servicio->min_personas;
                $p_servicio->max_personas=$servicios->itinerario_servicios_servicio->max_personas;
                $p_servicio->observacion='';
                if($servicios->itinerario_servicios_servicio->precio_grupo==1) {
                    $p_servicio->precio = round($servicios->itinerario_servicios_servicio->precio_venta / 2,2);
                    $p_servicio->precio_grupo = 1;
                }
                else{
                    $p_servicio->precio = $servicios->itinerario_servicios_servicio->precio_venta;
                    $p_servicio->precio_grupo=0;
                }
                $st+=$p_servicio->precio;
                $p_servicio->p_itinerario_id=$p_itinerario->id;
                $p_servicio->m_servicios_id = $servicios->itinerario_servicios_servicio->id;
                $p_servicio->save();
            }
            $p_itinerario->precio=$st;
            $p_itinerario->save();
        }

        $itineraries=P_Paquete::get();
        return view('admin.show-itineraries',['itineraries'=>$itineraries]);
    }
    public function delete(Request $request)
    {
        $paquete_id=$request->input('id');
        $eliminar=P_Paquete::FindOrFail($paquete_id)->delete();
        if($eliminar)
            return 1;
        else
            return 0;
    }
    public function pdf($id)
    {
        $paquetes = P_Paquete::where('id',$id)->get();
//        dd($paquetes);
        foreach ($paquetes as $paquete){
            $pdf = \PDF::loadView('admin.pdf-package', ['paquete'=>$paquete])->setPaper('a4')->setWarnings(true);
            return $pdf->download($paquete->codigo.' '.$paquete->nombre.'x'.$paquete->duracion.'.pdf');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
