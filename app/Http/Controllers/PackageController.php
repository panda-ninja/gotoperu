<?php

namespace App\Http\Controllers;

use App\M_Destino;
use App\M_Itinerario;
use App\M_Servicio;
use App\P_Itinerario;
use App\P_ItinerarioDestino;
use App\P_ItinerarioServicios;
use App\P_Paquete;
use App\P_PaquetePrecio;
use Illuminate\Http\Request;

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
//        dd($servicios);
        return view('admin.package',['destinos'=>$destinos,'itinerarios'=>$itinerarios,'m_servicios'=>$m_servicios]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $txt_day=strtoupper(($request->input('txt_day')));
        $txt_code=strtoupper(($request->input('txt_codigo')));
        $txt_title=strtoupper(($request->input('txt_title')));
        $txta_description=$request->input('txta_description');
        $txta_include=$request->input('txta_include');
        $txta_notinclude=$request->input('txta_notinclude');
//        $destinos=$request->input('destinos[]');
        $totalItinerario=$request->input('totalItinerario');
        $itinerarios_=$request->input('itinerarios_');
        $utilidad=$request->input('txt_utilidad');
        $preciox_n_dias_venta=$request->input('totalItinerario_venta');
//
//        $amount_t3=$request->input('amount_t3');
//        $amount_d3=$request->input('amount_d3');
//        $amount_s3=$request->input('amount_s3');
//        $amount_t4=$request->input('amount_t4');
//        $amount_d4=$request->input('amount_d4');
//        $amount_s4=$request->input('amount_s4');
//        $amount_t5=$request->input('amount_t5');
//        $amount_d5=$request->input('amount_d5');
//        $amount_s5=$request->input('amount_s5');
//
//        $profit_2=$request->input('profit_2');
//        $profit_3=$request->input('profit_3');
//        $profit_4=$request->input('profit_4');
//        $profit_5=$request->input('profit_5');
//
//        $profit_2=$request->input('profit_2');

        $paquete=new P_Paquete();
        $paquete->codigo=$txt_code;
        $paquete->titulo=$txt_title;
        $paquete->duracion=$txt_day;
        $paquete->descripcion=$txta_description;
        $paquete->incluye=$txta_include;
        $paquete->noincluye=$txta_notinclude;
        $paquete->utilidad=$utilidad;
        $paquete->estado=1;
        $paquete->preciocosto=$totalItinerario;
//        $preciox_n_dias=$totalItinerario*($txt_day-1);
//        $preciox_n_dias_venta=$preciox_n_dias+ceil($preciox_n_dias*0.40);

        $paquete->precio_venta=$preciox_n_dias_venta;
        $paquete->save();

//        $paquete_precio=new P_PaquetePrecio();
//        $paquete_precio->estrella=2;
//        $paquete_precio->precio_s=$amount_s2;
//        $paquete_precio->personas_s=1;
//        $paquete_precio->precio_m=$amount_d2;
//        $paquete_precio->personas_m=1;
//        $paquete_precio->precio_d=$amount_d2;
//        $paquete_precio->personas_s=1;
//        $paquete_precio->precio_t=$amount_t2;
//        $paquete_precio->personas_t=1;
//        $paquete_precio->estado=1;
//        $paquete_precio->utilida=$profit_2;
//        $paquete_precio->p_paquete_id=$paquete->id;
//        $paquete_precio->save();
        $dia=0;
        foreach ($itinerarios_ as $itinerario_id){
            $dia++;
            $m_itineario=M_Itinerario::FindOrFail($itinerario_id);
            $p_itinerario=new P_Itinerario();
            $p_itinerario->titulo=$m_itineario->titulo;
            $p_itinerario->descripcion=$m_itineario->titulo;
            $p_itinerario->dias=$dia;
            $p_itinerario->precio=$m_itineario->precio;
            $p_itinerario->imagen=$m_itineario->imagen;
            $p_itinerario->estado=1;
            $p_itinerario->p_paquete_id=$paquete->id;
            $p_itinerario->save();
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

            foreach($m_itineario->itinerario_itinerario_servicios as $servicios){
                $p_servicio=new P_ItinerarioServicios();
                $p_servicio->nombre=$servicios->itinerario_servicios_servicio->nombre;
                $p_servicio->observacion='';
                $p_servicio->precio=$servicios->itinerario_servicios_servicio->precio_venta;
                $p_servicio->p_itinerario_id=$p_itinerario->id;
                $p_servicio->save();
            }


        }
        $destinos=M_Destino::get();
        $itinerarios=M_Itinerario::get();
        return view('admin.package',['destinos'=>$destinos,'itinerarios'=>$itinerarios]);
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
