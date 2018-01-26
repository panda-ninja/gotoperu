<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\ConsultaPago;
use App\Cotizacion;
use App\CotizacionesCliente;
use App\HotelProveedor;
use App\ItinerarioServicioProveedor;
use App\ItinerarioServicios;
use App\ItinerarioServiciosPagos;
use App\M_Producto;
use App\PaqueteCotizaciones;
use App\PrecioHotelReserva;
use App\PrecioHotelReservaPagos;
use App\Proveedor;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class ContabilidadController extends Controller
{
    //
    public function index()
    {
        $cotizacion=Cotizacion::where('confirmado_r','ok')->get();
        return view('admin.contabilidad.index',['cotizacion'=>$cotizacion]);
    }
    public function list_proveedores()
    {
        $pagos = ItinerarioServiciosPagos::get();
        $proveedor = ItinerarioServicioProveedor::get();
        $servicios = ItinerarioServicios::with('itinerario_servicio_proveedor')->get();

        return view('admin.contabilidad.lista-proveedor',['proveedor'=>$proveedor, 'servicios'=>$servicios, 'pagos'=>$pagos]);
    }

    public function rango_fecha(){
        $consulta = ConsultaPago::all();
        return view('admin.contabilidad.rango-fecha', ['consulta'=>$consulta]);
    }

    public function list_fechas_rango(){
        $ini = $_POST['txt_ini'];
        $fin = $_POST['txt_fin'];

        return redirect()->route('list_fechas_path', [$ini, $fin]);
    }

    public function list_fechas($fecha_i, $fecha_f)
    {
        $ini = $fecha_i;
        $fin = $fecha_f;
        $cotizacion=Cotizacion::get();
        $pagos = ItinerarioServiciosPagos::get();
        $proveedor = ItinerarioServicioProveedor::get();
        $servicios = ItinerarioServicios::with('itinerario_servicio_proveedor')->get();

        return view('admin.contabilidad.lista-fecha',['proveedor'=>$proveedor, 'servicios'=>$servicios, 'pagos'=>$pagos, 'cotizacion'=>$cotizacion, 'ini'=>$ini, 'fin'=>$fin]);
    }

    public function list_fechas_show(){
        if (isset($_POST['chk_id'])){
            $ids = $_POST['chk_id'];
        }else{
            $ids = 0;
        }
        if (isset($_POST['txt_codigos'])){
            $codigos = $_POST['txt_codigos'];
        }else{
            $codigos = 0;
        }

//        foreach ($ids as $ids=>$value) {
//            $ids = $value.'-';
//        }
        $cotizacion=Cotizacion::get();
        $pagos = ItinerarioServiciosPagos::get();
        $proveedor = ItinerarioServicioProveedor::get();
        $servicios = ItinerarioServicios::with('itinerario_servicio_proveedor')->get();
        $consulta = ConsultaPago::where('id', $codigos)->get();
        return view('admin.contabilidad.lista-fecha-rango', ['proveedor'=>$proveedor, 'servicios'=>$servicios, 'pagos'=>$pagos, 'cotizacion'=>$cotizacion, 'ids'=>$ids, 'codigos'=>$codigos, 'consulta'=>$consulta]);
    }

    public function consulta_delete($id){
        $consulta=ConsultaPago::findOrFail($id);
        $consulta->delete();

        Session::flash('message', 'La consulta fue eliminada satisfactoriamente');

        return redirect()->route('rango_fecha_path');
    }

    public function pagar_consulta(){
        $idservicio = $_POST['txt_idservicio'];
        $saldo = $_POST['txt_saldo'];
        $pagado = $_POST['txt_pagado'];
        $fvpago = $_POST['txt_fvpago'];
        $medio = $_POST['txt_medio'];
        $cuenta = $_POST['txt_cuenta'];
        $transaccion = $_POST['txt_transaccion'];

        $mcuenta = $_POST['txt_mcuenta'];
        $idpago = $_POST['txt_idpago'];
//        $itinerario_servicio_pago = ItinerarioServiciosPagos::where('itinerario_servicios_id', $idservicio)->get();

        $pago = $mcuenta - $saldo;


        if ($idpago == 0){

            if ($mcuenta == $saldo){
                $p_servicio = new ItinerarioServiciosPagos;
                $p_servicio->a_cuenta = $saldo;
                $p_servicio->medio = $medio;
                $p_servicio->cuenta = $cuenta;
                $p_servicio->transaccion = $transaccion;
                $p_servicio->estado = 1;
                $p_servicio->itinerario_servicios_id = $idservicio;
                $p_servicio->save();

                return "cuenta = 0 id = 0/".$p_servicio->id;
            }else{

                $p_servicio_1 = new ItinerarioServiciosPagos;
                $p_servicio_1->a_cuenta = $saldo;
                $p_servicio_1->medio = $medio;
                $p_servicio_1->cuenta = $cuenta;
                $p_servicio_1->transaccion = $transaccion;
                $p_servicio_1->estado = 1;
                $p_servicio_1->itinerario_servicios_id = $idservicio;
                $p_servicio_1->save();

                $p_servicio_2 = new ItinerarioServiciosPagos;
                $p_servicio_2->a_cuenta = $pago;
                $p_servicio_2->fecha_a_pagar = $fvpago;
                $p_servicio_2->estado = 0;
                $p_servicio_2->itinerario_servicios_id = $idservicio;
                $p_servicio_2->save();

                return "cuenta <> 0 id = 0/".$p_servicio_1->id;

            }

        }else{
            if ($mcuenta == $saldo) {
                $p_servicio_1 = ItinerarioServiciosPagos::FindOrFail($idpago);
                $p_servicio_1->a_cuenta = $saldo;
                $p_servicio_1->medio = $medio;
                $p_servicio_1->cuenta = $cuenta;
                $p_servicio_1->transaccion = $transaccion;
                $p_servicio_1->estado = 1;
                $p_servicio_1->save();

                return "cuenta = 0  id <> 0 /".$p_servicio_1->id;
            }else{
                $p_servicio_1 = ItinerarioServiciosPagos::FindOrFail($idpago);
                $p_servicio_1->a_cuenta = $saldo;
                $p_servicio_1->medio = $medio;
                $p_servicio_1->cuenta = $cuenta;
                $p_servicio_1->transaccion = $transaccion;
                $p_servicio_1->estado = 1;
                $p_servicio_1->save();

                $p_servicio_2 = new ItinerarioServiciosPagos;
                $p_servicio_2->a_cuenta = $pago;
                $p_servicio_2->fecha_a_pagar = $fvpago;
                $p_servicio_2->estado = 0;
                $p_servicio_2->itinerario_servicios_id = $idservicio;
                $p_servicio_2->save();

                return "cuenta <> 0  id <> 0 ".$idpago."/".$p_servicio_1->id;

            }
        }

    }

    public function show($id)
    {
        $cotizacion=Cotizacion::where('id', $id)->get();
//        dd($cotizacion);
        $productos=M_Producto::get();
        $proveedores=Proveedor::get();
        $hotel_proveedor=HotelProveedor::get();

        return view('admin.contabilidad.confirmar_precio',['cotizacion'=>$cotizacion,'productos'=>$productos,'proveedores'=>$proveedores,'hotel_proveedor'=>$hotel_proveedor]);
    }

    public function update_price_conta(){
        $id = $_POST['txt_id'];
        $precio = $_POST['txt_precio'];

        $i_servicio=ItinerarioServicios::FindOrFail($id);
        $i_servicio->precio_c=$precio;

        $i_servicio->save();
        return ("ok");
    }

    public function pagar_servicios_conta($idcotizacion, $idservicio)
    {
        $cotizacion=Cotizacion::where('id', $idcotizacion)->get();
        $servicio = ItinerarioServicios::where('id', $idservicio)->get();
//        dd($cotizacion);
//        $productos=M_Producto::get();
//        $proveedores=Proveedor::get();
//        $hotel_proveedor=HotelProveedor::get();

        return view('admin.contabilidad.pagar_servicio',['cotizacion'=>$cotizacion,'servicio'=>$servicio, 'idcotizacion'=>$idcotizacion]);
    }

    public function pay_price_conta(){
        $id = $_POST['txt_id'];
        $idpago = $_POST['txt_idpago'];
//        $idcot = $_POST['txt_idcot'];
        $medio = $_POST['txt_medio'];
        $transaccion = $_POST['txt_transaccion'];
        $fecha = $_POST['txt_fecha'];
        $pago = $_POST['txt_pago'];

        if ($idpago>0){
            $p_servicio = ItinerarioServiciosPagos::FindOrFail($idpago);
            $p_servicio->a_cuenta = $pago;
            $p_servicio->fecha_a_pagar = $fecha;
            $p_servicio->medio = $medio;
            $p_servicio->transaccion = $transaccion;
            $p_servicio->estado = 1;
            $p_servicio->itinerario_servicios_id = $id;

            $p_servicio->save();
            return "ok update";
        }else{
            $p_servicio = new ItinerarioServiciosPagos;
            $p_servicio->a_cuenta = $pago;
            $p_servicio->fecha_a_pagar = $fecha;
            $p_servicio->medio = $medio;
            $p_servicio->transaccion = $transaccion;
            $p_servicio->estado = 1;
            $p_servicio->itinerario_servicios_id = $id;

            $p_servicio->save();
            return "ok save";
        }

//        return redirect()->route('pagar_servicios_conta_path', [$idcot, $id]);

    }

    public function pay_a_cuenta(){
        $id = $_POST['txt_id'];
//        $idcot = $_POST['txt_idcot'];
        $fecha = $_POST['txt_fecha'];
        $pago = $_POST['txt_pago'];

        $p_servicio = new ItinerarioServiciosPagos;
        $p_servicio->a_cuenta = $pago;
        $p_servicio->fecha_a_pagar = $fecha;
        $p_servicio->estado = 0;
        $p_servicio->itinerario_servicios_id = $id;

        $p_servicio->save();

//        return redirect()->route('pagar_servicios_conta_path', [$idcot, $id]);
        return "ok";

    }

    public function consulta_save(){
        $cod = $_POST['txt_codigos'];

        $consulta = new ConsultaPago();
        $consulta->codigos = $cod;
        $consulta->save();

        return 'ok';
    }









//    public function confirmar_servicios_conta($id, $sd)
//    {
//        $cotizacion=Cotizacion::where('id', $id)->get();
////        dd($cotizacion);
//        $productos=M_Producto::get();
//        $proveedores=Proveedor::get();
//        $hotel_proveedor=HotelProveedor::get();
//
//        return view('admin.contabilidad.pagar_servicio',['cotizacion'=>$cotizacion,'productos'=>$productos,'proveedores'=>$proveedores,'hotel_proveedor'=>$hotel_proveedor]);
//    }

    public function confirmar(Request $request)
    {
        $id=$request->input('id');
        $precio=$request->input('precio');
        $fecha=$request->input('fecha');
        $servicio=ItinerarioServicios::FindOrFail($id);
        $servicio->precio_c=$precio;
        $servicio->fecha_venc =$fecha;
        if($servicio->save()){
            $pagos=new ItinerarioServiciosPagos();
            $pagos->a_cuenta=$precio;
            $pagos->fecha_a_pagar=$fecha;
            $pagos->estado=0;
            $pagos->itinerario_servicios_id=$id;
            if($pagos->save())
                return '1_'.$pagos->id;
            else
                return 0;
        }
        else
            return 0;
    }
    public function pagar(Request $request)
    {
        $id=$request->input('itineraio_servicios_id');
        $pago_id=$request->input('servicio_pago');
        $total=$request->input('total');
        $a_cuenta=$request->input('a_cuenta');

        $pagos=ItinerarioServiciosPagos::FindOrFail($pago_id);
        $pagos->a_cuenta=$a_cuenta;
        $pagos->fecha_a_pagar=date("Y-m-d");
        $pagos->estado=1;
        $pagos->itinerario_servicios_id=$id;

        if($pagos->save()){
            if($a_cuenta<$total) {
                $pagos2=new ItinerarioServiciosPagos();
                $pagos2->a_cuenta=$request->input('saldo');
                $pagos2->fecha_a_pagar=$request->input('prox_fecha');
                $pagos2->estado=0;
                $pagos2->itinerario_servicios_id=$id;
                if($pagos2->save())
                    return 1;
                else
                    return 0;
            }
            else
                return 1;
        }
        else
            return 0;
    }
    public function listar($desde,$hasta){
        $cotizaciones=Cotizacion::with(['paquete_cotizaciones.itinerario_cotizaciones.itinerario_servicios.pagos'=> function ($query) use ($desde,$hasta) {
            $query->whereBetween('fecha_a_pagar', array($desde, $hasta))
                ->where('estado', 0);
        }])->get();
        return view('admin.contabilidad.lista-fecha',['cotizaciones'=>$cotizaciones,'desde'=>$desde,'hasta'=>$hasta]);
    }
    public function listar_post(Request $request){
        $desde=$request->input('desde');
        $hasta=$request->input('hasta');
        $cotizaciones=Cotizacion::with(['paquete_cotizaciones.itinerario_cotizaciones.itinerario_servicios.pagos'=> function ($query) use ($desde,$hasta) {
            $query->whereBetween('fecha_a_pagar', array($desde, $hasta))
                ->where('estado', 0);
        }])->get();
        return view('admin.contabilidad.lista-fecha',['cotizaciones'=>$cotizaciones,'desde'=>$desde,'hasta'=>$hasta]);
    }
    public function confirmar_h(Request $request)
    {
        $id=$request->input('id');
        $precio=$request->input('precio');
        $fecha=$request->input('fecha');
        $servicio=PrecioHotelReserva::FindOrFail($id);
        $servicio_r=PrecioHotelReserva::FindOrFail($id);
        $servicio->precio_s_c=$servicio_r->precio_s_r;
        $servicio->precio_d_c=$servicio_r->precio_d_r;
        $servicio->precio_m_c=$servicio_r->precio_m_r;
        $servicio->precio_t_c=$servicio_r->precio_t_r;
        $servicio->fecha_venc =$fecha;

        if($servicio->save()){
            $pagos=new PrecioHotelReservaPagos();
            $pagos->a_cuenta=$precio;
            $pagos->fecha_a_pagar=$fecha;
            $pagos->estado=0;
            $pagos->precio_hotel_reserva_id=$id;
            if($pagos->save())
                return '1_'.$pagos->id;
            else
                return 0;
        }
        else
            return 0;
    }
    public function guardar_imagen_pago(Request $request)
    {
//        dd($request->all());
        $id=$request->input('id');
        $imagen=$request->file('foto');
//        dd($request->file('input_file'));

        if($imagen){
            $objeto=ItinerarioServiciosPagos::FindOrFail($id);
            $filename ='pago-servicio-'.$id.'.jpg';
            $objeto->imagen=$filename;
            $objeto->save();
            Storage::disk('imagen_pago_servicio')->put($filename,  File::get($imagen));
            return json_encode(1);
        }
        else{
            return json_encode(0);
        }

    }
    public function getImageName($filename){
        $file = Storage::disk('imagen_pago_servicio')->get($filename);
        return new Response($file, 200);
    }
    public function update_price_conta_hotel(){
        $id = $_POST['txt_id'];
        $i_hotel=PrecioHotelReserva::FindOrFail($id);
        if($i_hotel->personas_s>0) {
            $precio_s_c = $_POST['txt_precio_s'];
            $i_hotel->precio_s_c = $precio_s_c;
        }
        if($i_hotel->personas_d>0) {
            $precio_d_c = $_POST['txt_precio_d'];
            $i_hotel->precio_d_c = $precio_d_c;
        }
        if($i_hotel->personas_m>0) {
            $precio_m_c = $_POST['txt_precio_m'];
            $i_hotel->precio_m_c = $precio_m_c;
        }
        if($i_hotel->personas_t>0) {
            $precio_t_c = $_POST['txt_precio_t'];
            $i_hotel->precio_t_c = $precio_t_c;
        }
        $i_hotel->save();
        return ("ok");
    }
    public function pagar_servicios_conta_hotel($idcotizacion, $idhotel)
    {
        $cotizacion=Cotizacion::where('id', $idcotizacion)->get();
        $hotel =PrecioHotelReserva::where('id', $idhotel)->get();
//        dd($cotizacion);
//        $productos=M_Producto::get();
//        $proveedores=Proveedor::get();
//        $hotel_proveedor=HotelProveedor::get();

        return view('admin.contabilidad.pagar_servicio_hotel',['cotizacion'=>$cotizacion,'hotel'=>$hotel, 'idcotizacion'=>$idcotizacion]);
    }
}
