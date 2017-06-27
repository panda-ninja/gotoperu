<?php

namespace App\Http\Controllers;

use App\M_Category;
use App\M_Servicio;
use App\M_Destino;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{
    //
    public function index(){
        $destinations=M_Destino::get();
        $servicios=M_Servicio::get();
        $categorias=M_Category::get();
        return view('admin.database.services',['servicios'=>$servicios,'categorias'=>$categorias,'destinations'=>$destinations]);
    }
    public function store(Request $request){
        $categorias=M_Category::get();

        foreach ($categorias as $categoria){
            $cate[]=$categoria->nombre;
        }
        $posTipo=$request->input('posTipo');
        $txt_localizacion=$request->input('txt_localizacion_'.$posTipo);
        $txt_type=$request->input('txt_type_'.$posTipo);
        $txt_acomodacion=$request->input('txt_acomodacion_'.$posTipo);
        $txt_product=$request->input('txt_product_'.$posTipo);
        $txt_price=$request->input('txt_price_'.$posTipo);

        $destino=new M_Servicio();
        $destino->grupo=$cate[$posTipo];
        $destino->localizacion=$txt_localizacion;
        $destino->tipo_servicio=$txt_type;
        $destino->acomodacion=$txt_acomodacion;
        $destino->nombre=$txt_product;
        $destino->precio_venta=$txt_price;
        $found_destino=M_Servicio::where('nombre',$txt_product)->get();
        if(count($found_destino)==0)
        {
            $destino->save();
            $destino->codigo=$destino->id;
            $destino->save();
            $destinations=M_Destino::get();
            $servicios=M_Servicio::get();
            $categorias=M_Category::get();
            return view('admin.database.services',['servicios'=>$servicios,'categorias'=>$categorias,'destinations'=>$destinations]);
        }
        else{
            $destinations=M_Destino::get();
            $servicios=M_Servicio::get();
            $categorias=M_Category::get();
            return view('admin.database.services',['servicios'=>$servicios,'categorias'=>$categorias,'destinations'=>$destinations]);
        }
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
        $posTipo=$request->input('posTipo');
        $txt_localizacion=$request->input('txt_localizacion_'.$posTipo);
        $txt_type=$request->input('txt_type_'.$posTipo);
        $txt_acomodacion=$request->input('txt_acomodacion_'.$posTipo);
        $txt_product=$request->input('txt_product_'.$posTipo);
        $txt_price=$request->input('txt_price_'.$posTipo);


        $destino=M_Servicio::FindOrFail($id);
        $destino->localizacion=$txt_localizacion;
        $destino->tipo_servicio=$txt_type;
        $destino->acomodacion=$txt_acomodacion;
        $destino->nombre=$txt_product;
        $destino->precio_venta=$txt_price;
        $destino->save();
        $destinations=M_Destino::get();
        $servicios=M_Servicio::get();
        $categorias=M_Category::get();
        return view('admin.database.services',['servicios'=>$servicios,'categorias'=>$categorias,'destinations'=>$destinations]);
    }
}
