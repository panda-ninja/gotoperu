<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Cotizacion;
use App\CotizacionesCliente;
use App\HotelProveedor;
use App\ItinerarioServicios;
use App\M_Producto;
use App\PaqueteCotizaciones;
use App\PrecioHotelReserva;
use App\Proveedor;
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
        return view('admin.book.book', ['paquete_cotizacion'=>$paquete_cotizacion, 'cot_cliente'=>$cot_cliente, 'cliente'=>$cliente,'cotizacion_cat'=>$cotizacion_cat]);
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
        $cotizacion=Cotizacion::FindOrFail($id);
        $productos=M_Producto::get();
        $proveedores=Proveedor::get();
        $hotel_proveedor=HotelProveedor::get();
        return view('admin.book.services',['cotizacion'=>$cotizacion,'productos'=>$productos,'proveedores'=>$proveedores,'hotel_proveedor'=>$hotel_proveedor]);
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
//        dd($dat);
        $dato=explode('_',$dat);
//        dd($dato);
        $itinerario=ItinerarioServicios::FindOrFail($dato[1]);
        $itinerario->precio_proveedor=$dato[3];
        $itinerario->proveedor_id=$dato[2];
        $itinerario->save();

        $cotizacion=Cotizacion::FindOrFail($dato[0]);
        $productos=M_Producto::get();
        $proveedores=Proveedor::get();
        $hotel_proveedor=HotelProveedor::get();
        return view('admin.book.services',['cotizacion'=>$cotizacion,'productos'=>$productos,'proveedores'=>$proveedores,'hotel_proveedor'=>$hotel_proveedor]);
    }
    function asignar_proveedor_hotel(Request $request){
        $dat=$request->input('precio')[0];
//        dd($dat);
        //0=
        //1=PrecioHotelReserva_id
        //2=proveedor_id
        //3=HotelProveedor_id
        $dato=explode('_',$dat);
//        dd($dato);
        $hotel_proveedor=HotelProveedor::FindOrFail($dato[3]);
//        dd($hotel_proveedor);
        $hotel_reservado=PrecioHotelReserva::FindOrFail($dato[1]);
        $hotel_reservado->precio_s_r=$hotel_proveedor->single;
        $hotel_reservado->precio_d_r=$hotel_proveedor->doble;
        $hotel_reservado->precio_m_r=$hotel_proveedor->matrimonial;
        $hotel_reservado->precio_t_r=$hotel_proveedor->triple;
        $hotel_reservado->proveedor_id=$dato[2];
        $hotel_reservado->save();

        $cotizacion=Cotizacion::FindOrFail($dato[0]);
        $productos=M_Producto::get();
        $proveedores=Proveedor::get();
        $hotel_proveedor=HotelProveedor::get();
        return view('admin.book.services',['cotizacion'=>$cotizacion,'productos'=>$productos,'proveedores'=>$proveedores,'hotel_proveedor'=>$hotel_proveedor]);
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
        return view('admin.book.services',['cotizacion'=>$cotizacion,'productos'=>$productos,'proveedores'=>$proveedores,'hotel_proveedor'=>$hotel_proveedor]);

    }
}
