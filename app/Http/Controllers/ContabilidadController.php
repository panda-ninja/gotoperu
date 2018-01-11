<?php

namespace App\Http\Controllers;

use App\Cliente;
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
use Illuminate\Http\Request;

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

    public function list_fechas()
    {
        $cotizacion=Cotizacion::all();
        $pagos = ItinerarioServiciosPagos::get();
        $proveedor = ItinerarioServicioProveedor::get();
        $servicios = ItinerarioServicios::with('itinerario_servicio_proveedor')->get();

        return view('admin.contabilidad.lista-fecha',['proveedor'=>$proveedor, 'servicios'=>$servicios, 'pagos'=>$pagos, 'cotizacion'=>$cotizacion]);
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
}
