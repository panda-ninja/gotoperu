<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Cotizacion;
use App\CotizacionesCliente;
use App\CotizacionesPagos;
use App\M_Destino;
use App\M_Itinerario;
use App\M_ItinerarioDestino;
use App\M_Servicio;
use App\P_Paquete;
use App\PaqueteCotizaciones;
use Illuminate\Http\Request;

class QouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.quotes');
    }

    public function proposal()
    {
        return view('admin.quotes-pdf');
    }
    public function options()
    {
        return view('admin.quotes-option');
    }
    public function pax()
    {
        $cotizacion = Cotizacion::with('cotizaciones_cliente')->get();
//        $cotizacion = CotizacionesCliente::all();
        $clients = Cliente::all();
        return view('admin.quote-pax', ['cotizacion'=>$cotizacion, 'clients'=>$clients]);
    }
    public function paxshow(Request $request, $id)
    {

        $cotizacion = Cotizacion::with('cotizaciones_cliente')->where('id', $id)->get();
        $pagos = CotizacionesPagos::where('cotizaciones_id', $id)->get();
        $count_pagos = $pagos->count();
//        dd($count_pagos)
//        dd($quote_client);
        $clients = Cliente::all();
        $paquete = PaqueteCotizaciones::where('cotizaciones_id', $id)->where('estado',2)->get();

        if ($request->ajax()){
            $url = explode('page=', $request->fullUrl())[1];
            return response()->json(view('admin.pax.'.$url.'', ['cotizacion'=>$cotizacion, 'clients'=>$clients, 'paquete'=>$paquete, 'pagos'=>$pagos, 'count_pagos'=>$count_pagos, 'id_cot'=>$id])->render());
        }

        return view('admin.quote-pax-show', ['cotizacion'=>$cotizacion, 'clients'=>$clients, 'paquete'=>$paquete, 'pagos'=>$pagos, 'count_pagos'=>$count_pagos, 'id_cot'=>$id]);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    public function nuevo()
    {
        $destinos=M_Destino::get();
        $itinerarios=M_Itinerario::get();
        $m_servicios=M_Servicio::get();
//        dd($servicios);
        return view('admin.quotes-new',['destinos'=>$destinos,'itinerarios'=>$itinerarios,'m_servicios'=>$m_servicios]);
    }
    public function nuevo1()
    {
        $destinos=M_Destino::get();
        $itinerarios=M_Itinerario::get();
        $itinerarios_d=M_ItinerarioDestino::get();
        $m_servicios=M_Servicio::get();
        $p_paquete=P_Paquete::get();
//        dd($servicios);
        return view('admin.quotes-new1',['destinos'=>$destinos,'itinerarios'=>$itinerarios,'m_servicios'=>$m_servicios,'p_paquete'=>$p_paquete, 'itinerarios_d'=>$itinerarios_d]);
    }
}
