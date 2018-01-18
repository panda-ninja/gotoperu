<?php

namespace App\Http\Controllers;

use App\Cotizacion;
use Illuminate\Http\Request;

class OperacionesController extends Controller
{
    //
    public function index()
    {
        $desde=date('Y-m-d');
        $hasta=date('Y-m-d');
//        dd($desde);
//        dd($hasta);
        $cotizaciones=Cotizacion::with(['paquete_cotizaciones.itinerario_cotizaciones'=> function ($query) use ($desde,$hasta) {
            $query->whereBetween('fecha', array($desde, $hasta));
        }])
            ->where('confirmado_r','ok')
            ->get();
        return view('admin.operaciones.operaciones',compact('cotizaciones'));
    }
    public function Lista_fechas(Request $request)
    {
        $desde=$request->input('txt_desde');
        $hasta=$request->input('txt_hasta');
//        dd($desde);
//        dd($hasta);

        $cotizaciones=Cotizacion::with(['paquete_cotizaciones.itinerario_cotizaciones'=> function ($query) use ($desde,$hasta) {
            $query->whereBetween('fecha', array($desde, $hasta));
        }])
            ->where('confirmado_r','ok')
            ->get();
        return view('admin.operaciones.operaciones',compact('cotizaciones'));
    }

}
