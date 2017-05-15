<?php

namespace App\Http\Controllers;

use App\M_Servicio;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{
    //
    public function index(){
        $servicios=M_Servicio::get();
        return view('admin.database.services',['servicios'=>$servicios]);
    }
    public function store(Request $request){
        $posTipo=$request->input('posTipo');
        $codigo='txt_codigo_'.$posTipo;
        $nombre='txt_nombre_'.$posTipo;
        $tipo='tipoServicio_'.$posTipo;
        $precio='txt_precio_'.$posTipo;

        $txt_codigo=strtoupper($request->input($codigo));
        $txt_nombre=strtoupper($request->input($nombre));
        $txt_tipo=$request->input($tipo);
        $txt_precio=$request->input($precio);

        $destino=new M_Servicio();
        $destino->codigo=$txt_codigo;
        $destino->nombre=$txt_nombre;
        $destino->tipoServicio=$txt_tipo;
        $destino->precio=$txt_precio;
        $destino->save();
        $servicios=M_Servicio::get();
        return view('admin.database.services',['servicios'=>$servicios]);
    }
    public function delete(Request $request){
        $id=$request->input('id');
        $servicio=M_Servicio::FindOrFail($id);
        if($servicio->delete())
            return 1;
        else
            return 0;
    }
    public function edit(Request $request){
        $id=$request->input('id');
        $posTipo=$request->input('posTipoEdit_'.$id);
        $codigo=$id.'_txt_codigo_'.$posTipo;
        $nombre=$id.'_txt_nombre_'.$posTipo;
        $tipo=$id.'_tipoServicio_'.$posTipo;
        $precio=$id.'_txt_precio_'.$posTipo;

        $txt_codigo=strtoupper($request->input($codigo));
        $txt_nombre=strtoupper($request->input($nombre));
        $txt_tipo=$request->input($tipo);
        $txt_precio=$request->input($precio);

        $destino=M_Servicio::FindOrFail($id);
        $destino->codigo=$txt_codigo;
        $destino->nombre=$txt_nombre;
        $destino->tipoServicio=$txt_tipo;
        $destino->precio=$txt_precio;
        $destino->save();
        $servicios=M_Servicio::get();
        return view('admin.database.services',['servicios'=>$servicios]);
    }
}
