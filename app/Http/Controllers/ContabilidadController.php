<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Cotizacion;
use App\CotizacionesCliente;
use App\ItinerarioServicios;
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
//        $id=$request->input('id');
//        $precio=$request->input('precio');
//        $fecha=$request->input('fecha');
//        $servicio=ItinerarioServicios::FindOrFail($id)->get();
//        $servicio->precio_c=$precio;
//        $servicio->fecha_venc =$fecha;
//        $servicio->save();
        return 1;
//        if($servicio->save())
//            return 1;
//        else
//            return 0;
    }
}
