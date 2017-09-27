<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Cotizacion;
use App\CotizacionesCliente;
use App\ItinerarioServicios;
use App\ItinerarioServiciosPagos;
use App\M_Producto;
use App\PaqueteCotizaciones;
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
    public function show($id)
    {
        $cotizacion=Cotizacion::FindOrFail($id);
        $productos=M_Producto::get();
        $proveedores=Proveedor::get();
        return view('admin.contabilidad.ven_detalle',['cotizacion'=>$cotizacion,'productos'=>$productos,'proveedores'=>$proveedores]);
    }
    public function confirmar(Request $request)
    {
        $id=$request->input('id');
        $precio=$request->input('precio');
        $fecha=$request->input('fecha');
        $servicio=ItinerarioServicios::FindOrFail($id);
        $servicio->precio_c=$precio;
        $servicio->fecha_venc =$fecha;
//        $servicio->save();
//        return 1;
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
//        $fecha_desde=$request->input('fecha_desde');
//        $fecha_hasta=$request->input('fecha_hasta');

        $cotizaciones=Cotizacion::with(['paquete_cotizaciones.itinerario_cotizaciones.itinerario_servicios.pagos'=> function ($query) use ($desde,$hasta) {
            $query->whereBetween('fecha_a_pagar', array($desde, $hasta))
                ->where('estado', 0);
        }])->get();
//        dd($cotizaciones);
        return view('admin.contabilidad.lista-fecha',['cotizaciones'=>$cotizaciones,'desde'=>$desde,'hasta'=>$hasta]);
    }
    public function listar_post(Request $request){
        $desde=$request->input('desde');
        $hasta=$request->input('hasta');

        $cotizaciones=Cotizacion::with(['paquete_cotizaciones.itinerario_cotizaciones.itinerario_servicios.pagos'=> function ($query) use ($desde,$hasta) {
            $query->whereBetween('fecha_a_pagar', array($desde, $hasta))
                ->where('estado', 0);
        }])->get();
//        dd($cotizaciones);
        return view('admin.contabilidad.lista-fecha',['cotizaciones'=>$cotizaciones,'desde'=>$desde,'hasta'=>$hasta]);
    }
}
