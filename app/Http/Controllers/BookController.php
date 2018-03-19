<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Cotizacion;
use App\CotizacionesCliente;
use App\HotelProveedor;
use App\ItinerarioCotizaciones;
use App\ItinerarioServicioProveedor;
use App\ItinerarioServicios;
use App\ItinerarioServiciosAcumPago;
use App\Liquidacion;
use App\M_Producto;
use App\M_Servicio;
use App\PaqueteCotizaciones;
use App\PrecioHotelReserva;
use App\PrecioHotelReservaPagos;
use App\Proveedor;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paquete_cotizacion = PaqueteCotizaciones::where('estado', 2)->get();
        $cot_cliente = CotizacionesCliente::with('cliente')->where('estado', 1)->get();
        $cliente = Cliente::get();
        $cotizacion_cat=Cotizacion::where('estado',2)
            ->whereBetween('categorizado',['C','S'])->get();
        session()->put('menu', 'reservas');
        return view('admin.book.book', ['paquete_cotizacion'=>$paquete_cotizacion, 'cot_cliente'=>$cot_cliente, 'cliente'=>$cliente,'cotizacion_cat'=>$cotizacion_cat]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear_liquidacion()
    {
        $fecha_ini=date("Y-m-d");
        $fecha_fin=date("Y-m-d");
        $liquidaciones=Cotizacion::where('liquidacion',0)->get();
        $servicios=M_Servicio::where('grupo','ENTRANCES')->get();
        $servicios_movi=M_Servicio::where('grupo','MOVILID')->where('clase','BOLETO')->get();
        return view('admin.book.crear-liquidacion',['liquidaciones'=>$liquidaciones,'fecha_ini'=>$fecha_ini,'fecha_fin'=>$fecha_fin,'servicios'=>$servicios,'servicios_movi'=>$servicios_movi]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cotizacion=Cotizacion::FindOrFail($id);
        $productos=M_Producto::get();
        $proveedores=Proveedor::get();
        $hotel_proveedor=HotelProveedor::get();
        $m_servicios=M_Servicio::get();

        $pqt_coti=PaqueteCotizaciones::where('cotizaciones_id',$id)->where('estado',2)->get();
        $pqt_id=0;
        foreach ($pqt_coti as $pqt){
            $pqt_id=$pqt->id;
        }
        $ItinerarioServiciosAcumPagos=ItinerarioServiciosAcumPago::where('paquete_cotizaciones_id',$pqt_id)->get();
        $ItinerarioHotleesAcumPagos=PrecioHotelReservaPagos::where('paquete_cotizaciones_id',$pqt_id)->get();


        return view('admin.book.services',['cotizacion'=>$cotizacion,'productos'=>$productos,'proveedores'=>$proveedores,'hotel_proveedor'=>$hotel_proveedor,'m_servicios'=>$m_servicios,'ItinerarioServiciosAcumPagos'=>$ItinerarioServiciosAcumPagos,'ItinerarioHotleesAcumPagos'=>$ItinerarioHotleesAcumPagos]);
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
    function asignar_proveedor(Request $request){
        $dat=$request->input('precio')[0];
        $dato=explode('_',$dat);
        $itinerario=ItinerarioServicios::FindOrFail($dato[1]);
        $proveedor=Proveedor::FindOrFail($dato[2]);
        $itinerario_serv_pro=new ItinerarioServicioProveedor();
        $itinerario_serv_pro->codigo=$proveedor->codigo;
        $itinerario_serv_pro->grupo=$proveedor->grupo;
        $itinerario_serv_pro->localizacion=$proveedor->localizacion;
        $itinerario_serv_pro->nombre=$itinerario->nombre;
        $itinerario_serv_pro->proveedor_razon_social=$proveedor->razon_social;
        $itinerario_serv_pro->ruc=$proveedor->ruc;
        $itinerario_serv_pro->razon_social=$proveedor->razon_social;
        $itinerario_serv_pro->direccion=$proveedor->direccion;
        $itinerario_serv_pro->telefono=$proveedor->telefono;
        $itinerario_serv_pro->celular=$proveedor->celular;
        $itinerario_serv_pro->email=$proveedor->email;
        $itinerario_serv_pro->r_nombres=$proveedor->r_nombres;
        $itinerario_serv_pro->r_telefono=$proveedor->r_telefono;
        $itinerario_serv_pro->c_nombres=$proveedor->c_nombres;
        $itinerario_serv_pro->c_telefono=$proveedor->c_telefono;
        $itinerario_serv_pro->save();
        $itinerario1=ItinerarioServicios::FindOrFail($dato[1]);
        $itinerario1->precio_proveedor=$dato[3];
        $itinerario1->proveedor_id=$dato[2];
        $itinerario1->proveedor_id_nuevo=$itinerario_serv_pro->id;

        if($itinerario1->save())
            return 1;
        else
            return 0;

//        return redirect()->route('book_show_path',$dato[0]);

//        $cotizacion=Cotizacion::FindOrFail($dato[0]);
//        $productos=M_Producto::get();
//        $proveedores=Proveedor::get();
//        $hotel_proveedor=HotelProveedor::get();
//        return view('admin.book.services',['cotizacion'=>$cotizacion,'productos'=>$productos,'proveedores'=>$proveedores,'hotel_proveedor'=>$hotel_proveedor]);
    }
    function asignar_proveedor_hotel(Request $request){
        $dat=$request->input('precio')[0];
        $dato=explode('_',$dat);
        $hotel_proveedor=HotelProveedor::FindOrFail($dato[3]);
        $hotel_reservado=PrecioHotelReserva::FindOrFail($dato[1]);
        $hotel_reservado->precio_s_r=$hotel_proveedor->single;
        $hotel_reservado->precio_d_r=$hotel_proveedor->doble;
        $hotel_reservado->precio_m_r=$hotel_proveedor->matrimonial;
        $hotel_reservado->precio_t_r=$hotel_proveedor->triple;
        $hotel_reservado->proveedor_id=$dato[2];
        if($hotel_reservado->save())
            return 1;
        else
            return 0;

//        $cotizacion=Cotizacion::FindOrFail($dato[0]);
//        $productos=M_Producto::get();
//        $proveedores=Proveedor::get();
//        $hotel_proveedor=HotelProveedor::get();
//        $m_servicios=M_Servicio::get();
//        return view('admin.book.services',['cotizacion'=>$cotizacion,'productos'=>$productos,'proveedores'=>$proveedores,'hotel_proveedor'=>$hotel_proveedor,'m_servicios'=>$m_servicios]);
    }
    public function confirmar(Request $request){
        $cotizacion_id=$request->input('cotizacion_id');
        $coti=Cotizacion::FindOrFail($cotizacion_id);
        $coti->confirmado_r='ok';
        $coti->save();
        $cotizacion=Cotizacion::FindOrFail($cotizacion_id);
        $productos=M_Producto::get();
        $proveedores=Proveedor::get();
        $hotel_proveedor=HotelProveedor::get();
        $m_servicios=M_Servicio::get();
//        dd($cotizacion_id);
        //-- guardaremos los servicios por grupo y proveedor siempre que se haya terminado de guardar todo
        $paquete_cotizacion=PaqueteCotizaciones::with('itinerario_cotizaciones')->where('cotizaciones_id',$cotizacion_id)->where('estado',2)->get();
//        dd($paquete_cotizacion);
        $array_servicios=[];
        $array_servicios_grupo=[];
        $array_servicios_fecha=[];
        $array_hotel=[];
        $array_hotel_fecha=[];

        foreach ($paquete_cotizacion as $pqt){
            foreach ($pqt->itinerario_cotizaciones as $itinerario_cotizaciones){
                foreach ($itinerario_cotizaciones->itinerario_servicios as $itinerario_servicios){
                    if($itinerario_servicios->servicio->grupo!='ENTRANCES'){
                        if($itinerario_servicios->servicio->grupo=='MOVILID'){
                            if($itinerario_servicios->servicio->clase!='BOLETO'){
                                $ids=$itinerario_servicios->servicio->grupo.'_'.$itinerario_servicios->proveedor_id;
                                if(!array_key_exists($ids,$array_servicios)) {
                                    if ($itinerario_servicios->precio_grupo == 1) {
                                        $array_servicios[$ids] = $itinerario_servicios->precio_proveedor;
                                        $array_servicios_grupo[$ids]=$itinerario_servicios->servicio->grupo;
                                    }
                                    elseif ($itinerario_servicios->precio_grupo == 0) {
                                        $array_servicios[$ids] = $itinerario_servicios->precio_proveedor;/* * $coti->nropersonas;*/
                                        $array_servicios_grupo[$ids]=$itinerario_servicios->servicio->grupo;
                                    }
                                    $array_servicios_fecha[$ids]=$itinerario_cotizaciones->fecha;
                                }
                                else{
                                    if ($itinerario_servicios->precio_grupo == 1) {
                                        $array_servicios[$ids] += $itinerario_servicios->precio_proveedor;
                                        $array_servicios_grupo[$ids]=$itinerario_servicios->servicio->grupo;
                                    }
                                    elseif ($itinerario_servicios->precio_grupo == 0) {
                                        $array_servicios[$ids] += $itinerario_servicios->precio_proveedor;/* * $coti->nropersonas;*/
                                        $array_servicios_grupo[$ids]=$itinerario_servicios->servicio->grupo;
                                    }
                                }
                            }
                        }
                        else{
                            $ids=$itinerario_servicios->servicio->grupo.'_'.$itinerario_servicios->proveedor_id;
                            if(!array_key_exists($ids,$array_servicios)) {
                                if ($itinerario_servicios->precio_grupo == 1) {
                                    $array_servicios[$ids] = $itinerario_servicios->precio_proveedor;
                                    $array_servicios_grupo[$ids]=$itinerario_servicios->servicio->grupo;
                                }
                                elseif ($itinerario_servicios->precio_grupo == 0) {
                                    $array_servicios[$ids] = $itinerario_servicios->precio_proveedor;/* * $coti->nropersonas;*/
                                    $array_servicios_grupo[$ids]=$itinerario_servicios->servicio->grupo;
                                }
                                $array_servicios_fecha[$ids]=$itinerario_cotizaciones->fecha;
                            }
                            else{
                                if ($itinerario_servicios->precio_grupo == 1) {
                                    $array_servicios[$ids] += $itinerario_servicios->precio_proveedor;
                                    $array_servicios_grupo[$ids]=$itinerario_servicios->servicio->grupo;
                                }
                                elseif ($itinerario_servicios->precio_grupo == 0) {
                                    $array_servicios[$ids] += $itinerario_servicios->precio_proveedor; /* * $coti->nropersonas;*/
                                    $array_servicios_grupo[$ids]=$itinerario_servicios->servicio->grupo;
                                }
                            }
                        }

                    }
                    else{
                        $proveedor=Proveedor::FindOrFail($itinerario_servicios->proveedor_id);
                        $iti_temp=ItinerarioServicios::findOrfail($itinerario_servicios->id);
                        $iti_temp->fecha_uso=$itinerario_cotizaciones->fecha;
                        $fecha= Carbon::createFromFormat('Y-m-d',$itinerario_cotizaciones->fecha);
                        if($proveedor->desci='antes')
                            $fecha->subDays($proveedor->plazo);
                        else
                            $fecha->addDays($proveedor->plazo);

                        $iti_temp->fecha_venc=$fecha->toDateString();
                        $iti_temp->save();
                    }
                }
                $sutbTotal=0;
                foreach ($itinerario_cotizaciones->hotel as $hotel){
                    if($hotel->personas_s>0)
                        $sutbTotal+=$hotel->personas_s*$hotel->precio_s_r;
                    if($hotel->personas_d>0)
                        $sutbTotal+=$hotel->personas_d*$hotel->precio_d_r;
                    if($hotel->personas_m>0)
                        $sutbTotal+=$hotel->personas_m*$hotel->precio_m_r;
                    if($hotel->personas_t>0)
                        $sutbTotal+=$hotel->personas_t*$hotel->precio_t_r;
                    if(!array_key_exists($hotel->proveedor_id,$array_hotel)) {
                        $array_hotel[$hotel->proveedor_id] = $sutbTotal;
                        $array_hotel_fecha[$hotel->proveedor_id]=$itinerario_cotizaciones->fecha;
                    }
                    else{
                        $array_hotel[$hotel->proveedor_id] += $sutbTotal;
                    }
                }
            }
        }
//        dd($array_servicios);
        $pqt_coti=0;
        foreach ($paquete_cotizacion as $paquete_cotizacion_){
            $pqt_coti=$paquete_cotizacion_->id;
        }
//        dd($pqt_coti);
        //-- agregarmos para itinerario_servicios_acum_pago
        $id='';
        foreach ($array_servicios as $key => $array_servicio) {
            $proveedor_id = explode('_', $key);
            if($proveedor_id[1]> 0) {
                $itinerario_servicios_acum_pago_=ItinerarioServiciosAcumPago::where('proveedor_id',$proveedor_id[1])
                    ->where('paquete_cotizaciones_id',$pqt_coti)
                    ->where('grupo',$array_servicios_grupo[$key])
                    ->whereIn('estado',[-2,-1])->get();
                if(count($itinerario_servicios_acum_pago_)>0){
                    $itinerario_servicios_acum_pago_->a_cuenta = $array_servicio;
                    $itinerario_servicios_acum_pago_->save();
                }
                else{
                    $proveedor=Proveedor::FindOrFail($key);
                    $fecha= Carbon::createFromFormat('Y-m-d',$array_servicios_fecha[$key]);
                    if($proveedor->desci='antes')
                        $fecha->subDays($proveedor->plazo);
                    else
                        $fecha->addDays($proveedor->plazo);

                    $itinerario_servicios_acum_pago=new ItinerarioServiciosAcumPago();
                    $itinerario_servicios_acum_pago->a_cuenta=$array_servicio;
                    $itinerario_servicios_acum_pago->estado=-2;
                    $itinerario_servicios_acum_pago->proveedor_id=$proveedor_id[1];
                    $itinerario_servicios_acum_pago->paquete_cotizaciones_id=$pqt_coti;
                    $itinerario_servicios_acum_pago->grupo=$array_servicios_grupo[$key];
                    $itinerario_servicios_acum_pago->fecha_servicio=$array_servicios_fecha[$key];
                    $itinerario_servicios_acum_pago->fecha_a_pagar=$fecha;
                    $itinerario_servicios_acum_pago->save();
                }
            }
        }
        //-- agregarmos para itinerario_servicios_acum_pago
        foreach ($array_hotel as $key => $array_hotel_){
            if($key>0){
                $precio_hotel_reserv_=PrecioHotelReservaPagos::where('proveedor_id',$key)
                    ->where('paquete_cotizaciones_id',$pqt_coti)->get();
                if(count($precio_hotel_reserv_)>0){
                    $precio_hotel_reserv_->a_cuenta=$array_hotel_;
                    $precio_hotel_reserv_->save();
                }
                else
                {
                    $proveedor=Proveedor::FindOrFail($key);
                    $fecha= Carbon::createFromFormat('Y-m-d',$array_hotel_fecha[$key]);
                    if($proveedor->desci='antes')
                        $fecha->subDays($proveedor->plazo);
                    else
                        $fecha->addDays($proveedor->plazo);

                    $precio_hotel_reserv=new PrecioHotelReservaPagos();
                    $precio_hotel_reserv->a_cuenta=$array_hotel_;
                    $precio_hotel_reserv->estado=-2;
                    $precio_hotel_reserv->proveedor_id=$key;
                    $precio_hotel_reserv->paquete_cotizaciones_id=$pqt_coti;
                    $precio_hotel_reserv->grupo='HOTELS';
                    $precio_hotel_reserv->fecha_servicio=$array_hotel_fecha[$key];
                    $precio_hotel_reserv->fecha_a_pagar=$fecha;
                    $precio_hotel_reserv->save();
                }
            }
        }

//        dd($array_servicios);
        return view('admin.book.services',['cotizacion'=>$cotizacion,'productos'=>$productos,'proveedores'=>$proveedores,'hotel_proveedor'=>$hotel_proveedor,'m_servicios'=>$m_servicios]);
    }
    function crear_liquidacion_storage(Request $request){
        $fecha_ini=$request->input('fecha_ini');
        $fecha_fin=$request->input('fecha_fin');
        $liquidaciones=Cotizacion::get();
        $servicios=M_Servicio::where('grupo','ENTRANCES')->get();
        $servicios_movi=M_Servicio::where('grupo','MOVILID')->where('clase','BOLETO')->get();
        return view('admin.book.crear-liquidacion',['liquidaciones'=>$liquidaciones,'fecha_ini'=>$fecha_ini,'fecha_fin'=>$fecha_fin,'servicios'=>$servicios,'servicios_movi'=>$servicios_movi]);
    }
    function guardar_liquidacion_storage(Request $request){
        $cotis=$request->input('cotis');
        $cotizaciones_ids=explode('_',$cotis);
//        dd($cotizaciones_ids);
        if(count($cotizaciones_ids)>0) {
            //-- se guardara el rango de fechas donde se envia la liquidacion semanal
            $fecha_ini = $request->input('desde');
            $fecha_fin = $request->input('hasta');
            $liquidaciones = new Liquidacion();
            $liquidaciones->ini = $fecha_ini;
            $liquidaciones->fin = $fecha_fin;
            $liquidaciones->user_id = auth()->guard('admin')->user()->id;
            $liquidaciones->estado = 1;
            $liquidaciones->save();
            //-- se cmbiara como estado =1 los servicios(entrances,tikects) para ser liquidados por contablidad
            $servicio_liquidacion = $request->input('servicio_liquidacion');
            foreach ($servicio_liquidacion as $servicio_liquidacion_) {
                $iti_servicio = ItinerarioServicios::findOrfail($servicio_liquidacion_);
                $iti_servicio->liquidacion = 1;
                $iti_servicio->save();
            }
            foreach ($cotizaciones_ids as $cotizaciones_id) {
                $cotizacion_temp = Cotizacion::findOrfail($cotizaciones_id);
                $cotizacion_temp->liquidacion = 1;
                $cotizacion_temp->save();
            }
            return redirect()->route('liquidaciones_hechas_path');
        }
    }
    function liquidaciones(){
        $cotizaciones=Cotizacion::where('liquidacion',1)->get();
        $servicios=M_Servicio::where('grupo','ENTRANCES')->get();
        $servicios_movi=M_Servicio::where('grupo','MOVILID')->where('clase','BOLETO')->get();
        $liquidaciones=Liquidacion::where('estado',1)->get();
        $users=User::get();

        return view('admin.book.liquidaciones',['cotizaciones'=>$cotizaciones,'servicios'=>$servicios,'servicios_movi'=>$servicios_movi,'liquidaciones'=>$liquidaciones,'users'=>$users]);
    }
    function ver_liquidaciones($fecha_ini,$fecha_fin){
        $liquidaciones=Cotizacion::get();
        $servicios=M_Servicio::where('grupo','ENTRANCES')->get();
        $servicios_movi=M_Servicio::where('grupo','MOVILID')->where('clase','BOLETO')->get();
        return view('admin.book.ver-liquidacion',['liquidaciones'=>$liquidaciones,'fecha_ini'=>$fecha_ini,'fecha_fin'=>$fecha_fin,'servicios'=>$servicios,'servicios_movi'=>$servicios_movi]);
    }

}
