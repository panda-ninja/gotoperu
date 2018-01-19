<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Cotizacion;
use App\ItinerarioServicios;
use App\M_Servicio;
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
        $clientes2=Cliente::get();
        $m_servicios=M_Servicio::get();
        return view('admin.operaciones.operaciones',compact('cotizaciones','desde','hasta','clientes2','m_servicios'));
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
        $clientes2=Cliente::get();
        $m_servicios=M_Servicio::get();
        return view('admin.operaciones.operaciones',compact('cotizaciones','desde','hasta','clientes2','m_servicios'));
    }
    public function sp($id1,$id,$sp)
    {
        $iti=ItinerarioServicios::FindOrFail($id);
        $iti->s_p=$sp;
        $iti->save();
        return redirect()->route('book_show_path',$id1);
    }

}
