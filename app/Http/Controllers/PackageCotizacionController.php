<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Cotizacion;
use App\CotizacionesCliente;
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
        $cotizacion->users_id=auth()->guard('admin')->user()->id;
        $cotizacion->save();

        $cotizacion_cliente=new CotizacionesCliente();
        $cotizacion_cliente->cotizaciones_id=$cotizacion->id;
        $cotizacion_cliente->clientes_id=$cliente->id;
        $cotizacion_cliente->estado=1;
        $cotizacion_cliente->save();

        $destinos=M_Destino::get();
        $itinerarios=M_Itinerario::get();
        $m_servicios=M_Servicio::get();
        return view('admin.package',['destinos'=>$destinos,'itinerarios'=>$itinerarios,'m_servicios'=>$m_servicios]);
    }
}
