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
use App\P_Itinerario;
use App\P_ItinerarioServicios;
use App\P_Paquete;
use App\P_PaquetePrecio;
use App\PaqueteCotizaciones;
use App\PaquetePrecio;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Mockery\Exception;
use PhpParser\Node\Expr\Array_;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Response;
use App\Http\Requests;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

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
        $date = date_create($request->input('txt_travel_date'));
        $fecha=date_format($date, 'jS F Y');
        $cotizacion=new Cotizacion();
        $cotizacion->nombre=strtoupper($request->input('txt_name')).' x'.$request->input('txt_travellers').' '.$fecha;
//        dd($cotizacion->nombre);
        $cotizacion->nropersonas=$request->input('txt_travellers');
        $cotizacion->duracion=$request->input('txt_days');
        $cotizacion->fecha=$request->input('txt_travel_date');
        $cotizacion->star_2=$request->input('strellas_2');
        $cotizacion->star_3=$request->input('strellas_3');
        $cotizacion->star_4=$request->input('strellas_4');
        $cotizacion->star_5=$request->input('strellas_5');
        $cotizacion->estado=0;
//        $cotizacion->users_id=auth()->guard('admin')->user()->id;
        $cotizacion->users_id=1;
        $cotizacion->save();
        $cotizacionGet=Cotizacion::where('id',$cotizacion->id)->get();
//        dd($cotizacionGet);
        $cotizacion_cliente=new CotizacionesCliente();
        $cotizacion_cliente->cotizaciones_id=$cotizacion->id;
        $cotizacion_cliente->clientes_id=$cliente->id;
        $cotizacion_cliente->estado=1;
        $cotizacion_cliente->save();
        $destinos=$request->input('destinos');
        $acomodacion_s=0;
        if($request->input('acomodacion_s'))
            $acomodacion_s=$request->input('acomodacion_s');

        $acomodacion_d=0;
        if($request->input('acomodacion_d'))
            $acomodacion_d=$request->input('acomodacion_d');

        $acomodacion_m=0;
        if($request->input('acomodacion_m'))
            $acomodacion_m=$request->input('acomodacion_m');

        $acomodacion_t=0;
        if($request->input('acomodacion_t'))
            $acomodacion_t=$request->input('acomodacion_t');

//        dd($destinos);

        $p_paquete=P_Paquete::where('duracion',$request->input('txt_days'))->get();
//        dd($p_paquete);

        return view('admin.quotes-planes',['cliente'=>$cliente,'cotizacion'=>$cotizacionGet,'destinos'=>$destinos,'acomodacion_s'=>$acomodacion_s,'acomodacion_d'=>$acomodacion_d,'acomodacion_m'=>$acomodacion_m,'acomodacion_t'=>$acomodacion_t,'p_paquete'=>$p_paquete]);
    }
    public function options($cotizacion_id,$destinos1,$acomodacion)
    {
//      dd($cotizacion_id);
        $destinos1=explode('$',$destinos1);
//      dd($destinos);
        $cotizacion=Cotizacion::with('cotizaciones_cliente')->where('id',$cotizacion_id)->get();
//      dd($cotizacion);
        $destinos=M_Destino::get();
        $itinerarios=M_Itinerario::get();
        $m_servicios=M_Servicio::get();
//      dd($servicios);
        return view('admin.quotes-package',['destinos'=>$destinos,'itinerarios'=>$itinerarios,'m_servicios'=>$m_servicios,'destinos1'=>$destinos1,'cotizacion'=>$cotizacion,'acomodacion_'=>$acomodacion]);
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

//        dd($itinerarios_);

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
        $acomodacion=$request->input('acomodacion');
        $acomodacion=explode('_',$acomodacion);
        $acomodacion_s=0;
        $acomodacion_d=0;
        $acomodacion_m=0;
        $acomodacion_t=0;

        if($acomodacion[0]==1)
            $acomodacion_s=1;
        if($acomodacion[1]==2)
            $acomodacion_d=1;
        if($acomodacion[2]==3)
            $acomodacion_t=1;
        if($acomodacion[3]==2)
            $acomodacion_m=1;


        $paquete=new PaqueteCotizaciones();
        $paquete->codigo=$txt_code;
        $paquete->titulo=$txt_title;
        $paquete->duracion=$txt_day;
        $paquete->descripcion=$txta_description;
        $paquete->incluye=$txta_include;
        $paquete->noincluye=$txta_notinclude;
        $paquete->utilidad=40;
        $paquete->estado=0;
        $paquete->preciocosto=$totalItinerario;
        $paquete->cotizaciones_id=$cotizacion_id;
        $paquete->save();

        $paquete_precio2=new PaquetePrecio();
        $paquete_precio2->estrellas=2;
        $paquete_precio2->precio_s=$amount_s2;
        $paquete_precio2->personas_s=$acomodacion_s;
        $paquete_precio2->precio_m=$amount_d2;
        $paquete_precio2->personas_m=$acomodacion_m;
        $paquete_precio2->precio_d=$amount_d2;
        $paquete_precio2->personas_d=$acomodacion_d;
        $paquete_precio2->precio_t=$amount_t2;
        $paquete_precio2->personas_t=$acomodacion_t;
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
        $paquete_precio3->personas_s=$acomodacion_s;
        $paquete_precio3->precio_m=$amount_d3;
        $paquete_precio3->personas_m=$acomodacion_m;
        $paquete_precio3->precio_d=$amount_d3;
        $paquete_precio3->personas_d=$acomodacion_d;
        $paquete_precio3->precio_t=$amount_t3;
        $paquete_precio3->personas_t=$acomodacion_t;
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
        $paquete_precio4->personas_s=$acomodacion_s;
        $paquete_precio4->precio_m=$amount_d4;
        $paquete_precio4->personas_m=$acomodacion_m;
        $paquete_precio4->precio_d=$amount_d4;
        $paquete_precio4->personas_d=$acomodacion_d;
        $paquete_precio4->precio_t=$amount_t4;
        $paquete_precio4->personas_t=$acomodacion_t;
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
        $paquete_precio5->personas_s=$acomodacion_s;
        $paquete_precio5->precio_m=$amount_d5;
        $paquete_precio5->personas_m=$acomodacion_m;
        $paquete_precio5->precio_d=$amount_d5;
        $paquete_precio5->personas_d=$acomodacion_d;
        $paquete_precio5->precio_t=$amount_t5;
        $paquete_precio5->personas_t=$acomodacion_t;
        if($strellas_5==5)
            $paquete_precio5->estado=1;
        else
            $paquete_precio5->estado=0;
        $paquete_precio5->utilidad=$profit_5;
        $paquete_precio5->paquete_cotizaciones_id=$paquete->id;
        $paquete_precio5->save();
        $dia=0;
        $dia_texto=1;

        foreach ($itinerarios_ as $itinerario_id){
//            dd('holaaaaaaa');
            $m_itineario=M_Itinerario::FindOrFail($itinerario_id);
            $p_itinerario=new ItinerarioCotizaciones();
            $p_itinerario->titulo=$m_itineario->titulo;
            $p_itinerario->descripcion=$m_itineario->descripcion;
            $p_itinerario->dias=$dia_texto;
            $p_itinerario->precio=$m_itineario->precio;
            $p_itinerario->imagen=$m_itineario->imagen;
            $p_itinerario->observaciones=$txt_sugerencia[$dia];
            $p_itinerario->estado=1;
            $p_itinerario->paquete_cotizaciones_id=$paquete->id;
            $p_itinerario->save();
            $dia++;
            $dia_texto++;
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

        $p_paquete=P_Paquete::where('duracion',$request->input('txt_day'))->get();
//        dd($p_paquete);
        return view('admin.quotes-planes',['cliente'=>$cliente,'cotizacion'=>$cotizacion,'destinos'=>$destinos,'acomodacion_s'=>$acomodacion_s,'acomodacion_d'=>$acomodacion_d,'acomodacion_m'=>$acomodacion_m,'acomodacion_t'=>$acomodacion_t,'p_paquete'=>$p_paquete]);

//        $destinos=M_Destino::get();
//        $itinerarios=M_Itinerario::get();
//        $m_servicios=M_Servicio::get();
//        return view('admin.quotes-package',['destinos'=>$destinos,'itinerarios'=>$itinerarios,'m_servicios'=>$m_servicios,'destinos1'=>$destinos1,'cotizacion'=>$cotizacion]);

    }
    public function save_cotizacion(Request $request)
    {
        $cotizacion_id=$request->input('cotizacion_id');
        $cotizacion=Cotizacion::with('paquete_cotizaciones')->where('id',$cotizacion_id)->get();
        $cotizacion_=null;
        foreach ($cotizacion as $cotizacion1){
            $cotizacion_=$cotizacion1;
        }
        if(count($cotizacion_->paquete_cotizaciones)>0){
                $cotizacion2=Cotizacion::FindOrFail($cotizacion_id);
                $cotizacion2->estado=1;
                $cotizacion2->save();
                foreach ($cotizacion_->paquete_cotizaciones as $paquete){
                    $paquete_=PaqueteCotizaciones::FindOrFail($paquete->id);
                    $paquete_->estado=1;
                    $paquete_->save();
                }
                $destinos=M_Destino::get();
                $itinerarios=M_Itinerario::get();
                $m_servicios=M_Servicio::get();
                return view('admin.quotes-new',['destinos'=>$destinos,'itinerarios'=>$itinerarios,'m_servicios'=>$m_servicios]);
        }
        else{
            $cliente_id=$request->input('cliente_id');
            $cliente=Cliente::FindOrFail($cliente_id);
            $destinos=$request->input('destinos');
            $cotizacion=Cotizacion::where('id',$cotizacion_id)->get();
            return view('admin.quotes-planes',['cliente'=>$cliente,'cotizacion'=>$cotizacion,'destinos'=>$destinos]);

        }

    }
    public function current_cotizacion()
    {
        $cotizacion=Cotizacion::get();

        return view('admin.quotes-current',['cotizacion'=>$cotizacion]);
    }
    public function autocomplete()
    {
        $term = Input::get('term');
        $results = null;
        $results = [];
        $proveedor = Cotizacion::where('nombre', 'like', '%' . $term . '%')->get();
        foreach ($proveedor as $query) {
            $results[] = ['id' => $query->id, 'value' => $query->nombre];
        }
        return response()->json($results);
    }
    public function show_cotizacion( Request $request)
    {
        $txt_name=$request->input('txt_name');
        $cotizacion=Cotizacion::where('nombre',$txt_name)->get();
        return view('admin.quotes-current',['cotizacion'=>$cotizacion]);

    }
    public function show_cotizacion_id($cotizacion_id)
    {
        $cotizacion=Cotizacion::where('id',$cotizacion_id)->get();
        return view('admin.quotes-current-details',['cotizacion'=>$cotizacion]);
    }


    public function show_paxs()
    {
        $destinos=M_Destino::get();
        return view('admin.database.destination1',['destinos'=>$destinos]);
    }
    public function activar_package( Request $request)
    {
        $package_id=$request->input('paquete_id');
        $cotizacion_id=$request->input('cotizacion_id');
        $cotizacion1=Cotizacion::FindOrFail($cotizacion_id);
        $cotizacion1->estado=2;
        $cotizacion1->save();
        $patCotizaciones=PaqueteCotizaciones::FindOrFail($package_id);
        $patCotizaciones->estado=2;
        $patCotizaciones->save();
//        $txt_name=$request->input('coti_nombre');

//        $cotizacion=Cotizacion::where('nombre',$txt_name)->get();
//        return view('admin.quotes-current',['cotizacion'=>$cotizacion]);
        return 1;
    }
    public function pdf($id)
    {
        $paquetes = PaqueteCotizaciones::with('paquete_precios')->get()->where('id', $id);
        foreach ($paquetes as $paquetes2){
            $paquete = PaqueteCotizaciones::with('paquete_precios')->get()->where('id', $id);
            $cotizacion = Cotizacion::where('id',$paquetes2->cotizaciones_id)->get();
            $cotizacion1='';
            foreach ($cotizacion as $cotizacion_){
                $cotizacion1=$cotizacion_;
            }
            $ee=CotizacionesCliente::with('cliente')->get();
//            dd($ee);
            $pdf = \PDF::loadView('admin.pdf-proposal', ['paquete'=>$paquete, 'cotizacion'=>$cotizacion])->setPaper('a4')->setWarnings(true);
            return $pdf->download($cotizacion1->nombre.'.pdf');
//            \File::delete('pdf/proposals_'.$id.'.pdf');
        }
    }
    public function getItineraryImageName($filename){
        $file = Storage::disk('itinerary')->get($filename);
        return new Response($file, 200);
    }
    public function probabilidad(Request $request)
    {
        $cotizacion_id=$request->input('cotizacion_id');
        $proba=$request->input('proba');
        $coti1=Cotizacion::FindOrFail($cotizacion_id);
        $coti1->posibilidad=$proba;
        $coti1->save();
        $cotizacion=Cotizacion::get();
        return view('admin.quotes-current',['cotizacion'=>$cotizacion]);
    }
    public function plan($id){
        $paquetes = PaqueteCotizaciones::with('paquete_precios')->get()->where('id', $id);
        foreach ($paquetes as $paquetes2){
            $paquete = PaqueteCotizaciones::with('paquete_precios')->get()->where('id', $id);
            $cotizacion = Cotizacion::where('id',$paquetes2->cotizaciones_id)->get();
            $cotizacion1='';
            foreach ($cotizacion as $cotizacion_){
                $cotizacion1=$cotizacion_;
            }
            return view('admin.plan-details', ['paquete'=>$paquete, 'cotizacion'=>$cotizacion]);
        }
    }
    public function escojer_precio_paquete(Request $request){
        $pos=$request->input('pos');
        $s=$request->input('s_'.$pos);
        $d=$request->input('d_'.$pos);
        $m=$request->input('m_'.$pos);
        $t=$request->input('t_'.$pos);
        $precio_paquete_id=$request->input('precio_paquete_id_'.$pos);
//        dd($precio_paquete_id);
        $paquetePrecio=PaquetePrecio::FindOrFail($precio_paquete_id);
        $paquetesPrecio=PaquetePrecio::where('paquete_cotizaciones_id',$paquetePrecio->paquete_cotizaciones_id)->get();
        foreach ($paquetesPrecio as $paquetePrecio_){
            $paquetePrecio_temp=PaquetePrecio::FindOrFail($paquetePrecio_->id);
            $paquetePrecio_temp->estado=1;
            $paquetePrecio_temp->save();
        }
        $paquetePrecio->personas_s=$s;
        $paquetePrecio->personas_d=$d;
        $paquetePrecio->personas_m=$m;
        $paquetePrecio->personas_t=$t;
        $paquetePrecio->estado=2;
        $paquetePrecio->save();

        $paquete=PaqueteCotizaciones::where('id',$paquetePrecio->paquete_cotizaciones_id)->get();
        foreach ($paquete as $paquete_){
            $paquete1=PaqueteCotizaciones::FindOrFail($paquete_->id);
            $paquete1->estado=2;
            $paquete1->save();

            $cotizaciones=Cotizacion::FindOrFail($paquete1->cotizaciones_id);
            $cotizaciones->estado=2;
            $cotizaciones->save();
            $cotizacion=Cotizacion::where('id',$cotizaciones->id)->get();
//            return view('admin.quotes-current-details',['cotizacion'=>$cotizacion]);
            return redirect()->route('cotizacion_id_show_path',[$cotizaciones->id]);
        }


    }
    public function cargar_paquete_enlatados(Request $request){
        $p_paquete_ids=$request->input('paquetes');
        $p_cotizacion_id=$request->input('p_cotizacion_id');
        $cotizaion=Cotizacion::FindOrFail($p_cotizacion_id);
        $datos=$request->input('datos');

        $datos=explode('_',$datos);
        $acomodacion_s=$datos[1];
        $acomodacion_d=$datos[2];
        $acomodacion_t=$datos[3];
        $acomodacion_m=$datos[4];
        $destinos=explode('$',$datos[0]);

        $estrella[2]=0;
        $estrella[3]=0;
        $estrella[4]=0;
        $estrella[5]=0;

        $estrella[2]=$cotizaion->star_2;
        $estrella[3]=$cotizaion->star_3;
        $estrella[4]=$cotizaion->star_4;
        $estrella[5]=$cotizaion->star_5;

        foreach ($p_paquete_ids as $p_paquete_id){
            $p_paquete=P_Paquete::where('id',$p_paquete_id)->get();
            foreach ($p_paquete as $p_paquete_){
                //-- creamos el nuevo paquete para la cotizacion
                $new_paquete=new PaqueteCotizaciones();
                $new_paquete->codigo=$p_paquete_->codigo;
                $new_paquete->titulo=$p_paquete_->titulo;
                $new_paquete->duracion=$p_paquete_->duracion;
                $new_paquete->preciocosto=$p_paquete_->preciocosto;
                $new_paquete->utilidad=$p_paquete_->utilidad;
                $new_paquete->precioventa=$p_paquete_->precioventa;
                $new_paquete->descripcion=$p_paquete_->descripcion;
                $new_paquete->incluye=$p_paquete_->incluye;
                $new_paquete->noincluye=$p_paquete_->noincluye;
                $new_paquete->opcional=$p_paquete_->opcional;
                $new_paquete->imagen=$p_paquete_->imagen;
                $new_paquete->posibilidad=$p_paquete_->posibilidad;
                $new_paquete->estado=1;
                $new_paquete->cotizaciones_id=$p_cotizacion_id;
                $new_paquete->save();
//                dd($new_paquete);
                foreach ($p_paquete_->itinerarios as $p_itinerario){
//                    dd($p_itinerario);
//                    dd($new_paquete->id);
                    $new_itinerario=new ItinerarioCotizaciones();
                    $new_itinerario->titulo=$p_itinerario->titulo;
                    $new_itinerario->descripcion=$p_itinerario->descripcion;
                    $new_itinerario->dias=$p_itinerario->dias;
                    $new_itinerario->fecha=$p_itinerario->fecha;
                    $new_itinerario->precio=$p_itinerario->precio;
                    $new_itinerario->imagen=$p_itinerario->imagen;
                    $new_itinerario->estado=1;
                    $new_itinerario->paquete_cotizaciones_id=$new_paquete->id;
                    $new_itinerario->save();
                    foreach ($p_itinerario->destinos as $p_destino){
                        $new_destino=new ItinerarioDestinos();
                        $new_destino->codigo=$p_destino->codigo;
                        $new_destino->destino=$p_destino->destino;
                        $new_destino->region=$p_destino->region;
                        $new_destino->departamento=$p_destino->departamento;
                        $new_destino->pais=$p_destino->pais;
                        $new_destino->descripcion=$p_destino->descripcion;
                        $new_destino->imagen=$p_destino->imagen;
                        $new_destino->estado=1;
                        $new_destino->itinerario_cotizaciones_id=$new_itinerario->id;
                        $new_destino->save();
                    }
                    foreach ($p_itinerario->serivicios as $serivicio){
                        $new_servicio=new ItinerarioServicios();
                        $new_servicio->nombre=$serivicio->nombre;
                        $new_servicio->observacion=$serivicio->observacion;
                        if($serivicio->precio_grupo==1) {
                            $new_servicio->min_personas=$serivicio->min_personas;
                            $new_servicio->max_personas=$serivicio->max_personas;
                            $new_servicio->precio = round($serivicio->precio / $cotizaion->nropersonas,2);
                            if($serivicio->min_personas<=$cotizaion->nropersonas && $cotizaion->nropersonas<=$serivicio->max_personas){
                                $new_servicio->estado_error=0;
                            }
                            else{
                                $new_servicio->mensaje_error='Borre este servicio, agrege uno de acuerdo a la cantidad({{$cotizaion->nropersonas}}) de pasajero';
                                $new_servicio->estado_error=1;
                            }
                        }else{
                            $new_servicio->estado_error=0;
                            $new_servicio->precio = $serivicio->precio;
                        }
                        $new_servicio->itinerario_cotizaciones_id=$new_itinerario->id;
//                        $new_servicio->user_id=auth()->guard('admin')->user()->id;
                        $new_servicio->user_id=1;
                        $new_servicio->save();
                    }
                }
                foreach ($p_paquete_->precios as $precios){
                    $new_paquete_precio=new PaquetePrecio();
                    $new_paquete_precio->estrellas=$precios->estrellas;
                    $new_paquete_precio->precio_s=$precios->precio_s;
                    $new_paquete_precio->personas_s=$acomodacion_s;
                    $new_paquete_precio->precio_d=$precios->precio_d;
                    $new_paquete_precio->personas_d=$acomodacion_d;
                    $new_paquete_precio->precio_m=$precios->precio_m;
                    $new_paquete_precio->personas_m=$acomodacion_m;
                    $new_paquete_precio->precio_t=$precios->precio_t;
                    $new_paquete_precio->personas_t=$acomodacion_t;
                    $new_paquete_precio->utilidad=$precios->utilidad;
                    $new_paquete_precio->paquete_cotizaciones_id=$new_paquete->id;
                    if($estrella[$precios->estrellas]==$precios->estrellas)
                        if($precios->estado==1)
                            $new_paquete_precio->estado=1;
                        else
                            $new_paquete_precio->estado=0;
                    else
                        $new_paquete_precio->estado=0;

                    $new_paquete_precio->save();
                }
            }
        }
        $request->input('paquetes');
        $cliente_id=$request->input('cliente_id_');
        $cliente=Cliente::FindOrFail($cliente_id);
        $cotizacion=Cotizacion::where('id',$p_cotizacion_id)->get();
        $p_paquete=P_Paquete::where('duracion',$request->input('txt_day_'))->get();
        return view('admin.quotes-planes',['cliente'=>$cliente,'cotizacion'=>$cotizacion,'destinos'=>$destinos,'acomodacion_s'=>$acomodacion_s,'acomodacion_d'=>$acomodacion_d,'acomodacion_m'=>$acomodacion_m,'acomodacion_t'=>$acomodacion_t,'p_paquete'=>$p_paquete]);
    }
    public function plan_newpackage($id){
        $paquetes = PaqueteCotizaciones::with('paquete_precios')->get()->where('id', $id);
        foreach ($paquetes as $paquetes2){
            $paquete = PaqueteCotizaciones::with('paquete_precios')->get()->where('id', $id);
            $cotizacion = Cotizacion::where('id',$paquetes2->cotizaciones_id)->get();
            $cotizacion1='';
            foreach ($cotizacion as $cotizacion_){
                $cotizacion1=$cotizacion_;
            }
            return view('admin.new_plan-details', ['paquete'=>$paquete, 'cotizacion'=>$cotizacion]);
        }
    }
    public function contabilidad()
    {
        return view('admin.contabilidad.categorizacion');
    }

}