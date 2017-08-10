<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Cotizacion;
use App\CotizacionesCliente;
use App\ItinerarioCotizaciones;
use App\ItinerarioDestinos;
use App\ItinerarioServicios;
use App\M_Destino;
use App\M_Itinerario;
use App\M_Servicio;
use App\P_PaquetePrecio;
use App\PaqueteCotizaciones;
use App\PaquetePrecio;
use Illuminate\Http\Request;

class PackageCotizacionController extends Controller
{
    //
    public function store(Request $request)
    {
        //-- Datos del cliente
        $cliente=new Cliente();
        $cliente->nombres=strtoupper($request->input('txt_name'));
        $cliente->email=$request->input('txt_email');
        $cliente->nacionalidad=$request->input('txt_country');
        $cliente->telefono=$request->input('txt_phone');
        $cliente->save();

        //-- Datos de la cotizacion
        $cotizacion=new Cotizacion();
        $cotizacion->nropersonas=$request->input('txt_travellers');
        $cotizacion->duracion=$request->input('txt_days');
        $cotizacion->fecha=$request->input('txt_travel_date');
        $cotizacion->star_2=$request->input('strellas_2');
        $cotizacion->star_3=$request->input('strellas_3');
        $cotizacion->star_4=$request->input('strellas_4');
        $cotizacion->star_5=$request->input('strellas_5');
        $cotizacion->estado=1;
//        $cotizacion->users_id=auth()->guard('admin')->user()->id;
        $cotizacion->users_id=1;
        $cotizacion->save();
        $cotizacionGet=Cotizacion::where('id',$cotizacion->id)->get();
        $cotizacion_cliente=new CotizacionesCliente();
        $cotizacion_cliente->cotizaciones_id=$cotizacion->id;
        $cotizacion_cliente->clientes_id=$cliente->id;
        $cotizacion_cliente->estado=1;
        $cotizacion_cliente->save();
        $destinos=$request->input('destinos');
//        dd($destinos);
        return view('admin.quotes-planes',['cliente'=>$cliente,'cotizacion'=>$cotizacionGet,'destinos'=>$destinos]);
    }
    public function options($cotizacion_id,$destinos1)
    {
//        dd($cotizacion_id);
        $destinos1=explode('$',$destinos1);
//        dd($destinos);
        $cotizacion=Cotizacion::with('cotizaciones_cliente')->where('id',$cotizacion_id)->get();
//        dd($cotizacion);

        $destinos=M_Destino::get();
        $itinerarios=M_Itinerario::get();
        $m_servicios=M_Servicio::get();
//        dd($servicios);
        return view('admin.quotes-package',['destinos'=>$destinos,'itinerarios'=>$itinerarios,'m_servicios'=>$m_servicios,'destinos1'=>$destinos1,'cotizacion'=>$cotizacion]);
    }

    public function store_package(Request $request)
    {
        $cotizacion_id=$request->input('cotizacion_id');
        $txt_day=strtoupper(($request->input('txt_day')));
        $txt_code=strtoupper(($request->input('txt_codigo')));
        $txt_title=strtoupper(($request->input('txt_title')));
        $txta_description=$request->input('txta_description');
        $txta_include=$request->input('txta_include');
        $txta_notinclude=$request->input('txta_notinclude');
        $totalItinerario=$request->input('totalItinerario');
        $itinerarios_=$request->input('itinerarios_');
        $txt_sugerencia=$request->input('txt_sugerencia');
        $nro_personas=$request->input('nro_personitas');
        $cliente_id=$request->input('cliente_id');


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

        $paquete=new PaqueteCotizaciones();
        $paquete->codigo=$txt_code;
        $paquete->titulo=$txt_title;
        $paquete->duracion=$txt_day;
        $paquete->descripcion=$txta_description;
        $paquete->incluye=$txta_include;
        $paquete->noincluye=$txta_notinclude;
        $paquete->utilidad=40;
        $paquete->estado=1;
        $paquete->preciocosto=$totalItinerario;
        $paquete->cotizaciones_id=$cotizacion_id;
        $paquete->save();

        $paquete_precio2=new PaquetePrecio();
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
        $paquete_precio2->paquete_cotizaciones_id=$paquete->id;
        $paquete_precio2->save();

        $paquete_precio3=new PaquetePrecio();
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
        $paquete_precio3->paquete_cotizaciones_id=$paquete->id;
        $paquete_precio3->save();

        $paquete_precio4=new PaquetePrecio();
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
        $paquete_precio4->paquete_cotizaciones_id=$paquete->id;
        $paquete_precio4->save();

        $paquete_precio5=new PaquetePrecio();
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
        $paquete_precio5->paquete_cotizaciones_id=$paquete->id;
        $paquete_precio5->save();
        $dia=0;
        foreach ($itinerarios_ as $itinerario_id){
            $m_itineario=M_Itinerario::FindOrFail($itinerario_id);
            $p_itinerario=new ItinerarioCotizaciones();
            $p_itinerario->titulo=$m_itineario->titulo;
            $p_itinerario->descripcion=$m_itineario->titulo;
            $p_itinerario->dias=$dia;
            $p_itinerario->precio=$m_itineario->precio;
            $p_itinerario->imagen=$m_itineario->imagen;
            $p_itinerario->observaciones=$txt_sugerencia[$dia];
            $p_itinerario->estado=1;
            $p_itinerario->paquete_cotizaciones_id=$paquete->id;
            $p_itinerario->save();
            $dia++;
            foreach ($m_itineario->destinos as $m_destinos){
                $p_destinos=new ItinerarioDestinos();
                $p_destinos->codigo=$m_destinos->codigo;
                $p_destinos->destino=$m_destinos->destino;
                $p_destinos->region=$m_destinos->region;
                $p_destinos->pais=$m_destinos->pais;
                $p_destinos->descripcion=$m_destinos->descripcion;
                $p_destinos->imagen=$m_destinos->imagen;
                $p_destinos->estado=1;
                $p_destinos->itinerario_cotizaciones_id=$p_itinerario->id;
                $p_destinos->save();
            }
            $st=0;
            foreach($m_itineario->itinerario_itinerario_servicios as $servicios){
                $p_servicio=new ItinerarioServicios();
                $p_servicio->nombre=$servicios->itinerario_servicios_servicio->nombre;
                $p_servicio->observacion='';
                if($servicios->itinerario_servicios_servicio->precio_grupo==1)
                    $p_servicio->precio=ceil($servicios->itinerario_servicios_servicio->precio_venta/$nro_personas);
                else
                    $p_servicio->precio=$servicios->itinerario_servicios_servicio->precio_venta;
                $st+=$p_servicio->precio;
                $p_servicio->itinerario_cotizaciones_id=$p_itinerario->id;
//                $p_servicio->user_id=auth()->guard('admin')->user()->id;
                $p_servicio->user_id=1;
                $p_servicio->estado=1;
                $p_servicio->save();
            }
            $p_itinerario->precio=$st;
            $p_itinerario->save();

        }
        $cliente=Cliente::FindOrFail($cliente_id);
        $destinos=$request->input('destinos');
        $cotizacion=Cotizacion::where('id',$cotizacion_id)->get();


        return view('admin.quotes-planes',['cliente'=>$cliente,'cotizacion'=>$cotizacion,'destinos'=>$destinos]);

//        $destinos=M_Destino::get();
//        $itinerarios=M_Itinerario::get();
//        $m_servicios=M_Servicio::get();
//        return view('admin.quotes-package',['destinos'=>$destinos,'itinerarios'=>$itinerarios,'m_servicios'=>$m_servicios,'destinos1'=>$destinos1,'cotizacion'=>$cotizacion]);

    }
}
