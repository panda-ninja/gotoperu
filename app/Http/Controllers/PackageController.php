<?php

namespace App\Http\Controllers;

use App\M_Destino;
use App\P_Paquete;
use App\P_PaquetePrecio;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //--
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $destinos=M_Destino::get();
        return view('admin.package',['destinos'=>$destinos]);
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
        $txt_day=strtoupper(($request->input('txt_day')));
        $txt_code=strtoupper(($request->input('txt_code')));
        $txt_title=strtoupper(($request->input('txt_title')));
        $txta_description=$request->input('txta_description');
        $txta_include=$request->input('txta_include');
        $txta_notinclude=$request->input('txta_notinclude');
        $amount_t2=$request->input('amount_t2');
        $amount_d2=$request->input('amount_d2');
        $amount_s2=$request->input('amount_s2');
        $amount_t3=$request->input('amount_t3');
        $amount_d3=$request->input('amount_d3');
        $amount_s3=$request->input('amount_s3');
        $amount_t4=$request->input('amount_t4');
        $amount_d4=$request->input('amount_d4');
        $amount_s4=$request->input('amount_s4');
        $amount_t5=$request->input('amount_t5');
        $amount_d5=$request->input('amount_d5');
        $amount_s5=$request->input('amount_s5');

        $profit_2=$request->input('profit_2');
        $profit_3=$request->input('profit_3');
        $profit_4=$request->input('profit_4');
        $profit_5=$request->input('profit_5');

        $profit_2=$request->input('profit_2');

        $paquete=new P_Paquete();
        $paquete->codigo=$txt_code;
        $paquete->titulo=$txt_title;
        $paquete->duracion=$txt_day;
        $paquete->descripcion=$txta_description;
        $paquete->incluye=$txta_include;
        $paquete->noincluye=$txta_notinclude;
        $paquete->estado=1;
        $paquete->save();

        $paquete_precio=new P_PaquetePrecio();
        $paquete_precio->estrella=2;
        $paquete_precio->precio_s=$amount_s2;
        $paquete_precio->personas_s=1;
        $paquete_precio->precio_m=$amount_d2;
        $paquete_precio->personas_m=1;
        $paquete_precio->precio_d=$amount_d2;
        $paquete_precio->personas_s=1;
        $paquete_precio->precio_t=$amount_t2;
        $paquete_precio->personas_t=1;
        $paquete_precio->estado=1;
        $paquete_precio->utilida=$profit_2;
        $paquete_precio->p_paquete_id=$paquete->id;
        $paquete_precio->save();


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
}
