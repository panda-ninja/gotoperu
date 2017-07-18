<?php

namespace App\Http\Controllers;

use App\M_Category;
use App\M_Servicio;
use App\M_Destino;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
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
        $txt_tipo_grupo=$request->input('txt_tipo_grupo_'.$posTipo);
        $destino=new M_Servicio();
        $destino->grupo=$cate[$posTipo];
        $destino->localizacion=$txt_localizacion;
        $destino->tipoServicio=$txt_type;
        $destino->acomodacion=$txt_acomodacion;
        $destino->nombre=$txt_product;
        $destino->precio_venta=$txt_price;
        if($txt_tipo_grupo=='Absoluto')
            $destino->precio_grupo=1;
        elseif($txt_tipo_grupo=='Individual')
            $destino->precio_grupo=0;
//        $found_destino=M_Servicio::where('nombre',$txt_product)->get();
//        if(count($found_destino)==0)
        {
            $destino->save();
            $destino->codigo=$destino->id;
            $destino->save();
            $destinations=M_Destino::get();
            $servicios=M_Servicio::get();
            $categorias=M_Category::get();
            return view('admin.database.services',['servicios'=>$servicios,'categorias'=>$categorias,'destinations'=>$destinations]);
        }
//        else{
//            $destinations=M_Destino::get();
//            $servicios=M_Servicio::get();
//            $categorias=M_Category::get();
//            return view('admin.database.services',['servicios'=>$servicios,'categorias'=>$categorias,'destinations'=>$destinations]);
//        }
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
        $txt_tipo_grupo=$request->input('txt_tipo_grupo_'.$posTipo);

        $destino=M_Servicio::FindOrFail($id);
        $destino->localizacion=$txt_localizacion;
        $destino->tipoServicio=$txt_type;
        $destino->acomodacion=$txt_acomodacion;
        $destino->nombre=$txt_product;
        $destino->precio_venta=$txt_price;
        if($txt_tipo_grupo=='Absoluto')
            $destino->precio_grupo=1;
        elseif($txt_tipo_grupo=='Individual')
            $destino->precio_grupo=0;
        $destino->save();
        $destinations=M_Destino::get();
        $servicios=M_Servicio::get();
        $categorias=M_Category::get();
        return view('admin.database.services',['servicios'=>$servicios,'categorias'=>$categorias,'destinations'=>$destinations]);
    }
    public function autocomplete()
    {
        $term = Input::get('term');
        $localizacion = Input::get('localizacion');
        $grupo= Input::get('grupo');
        $results = null;
        $results = [];
        $proveedor = M_Servicio::where('codigo', 'like', '%' . $term . '%')
            ->orWhere('nombre', 'like', '%' . $term . '%')
            ->get();
        foreach ($proveedor as $query) {
          if($grupo==$query->grupo){
            if($localizacion==$query->localizacion){
                $pre='Invididual';
                if($query->precio_grupo==1)
                    $pre='Absoluto';
                $results[] = ['id' => $query->id, 'value' => $query->codigo.' '.$query->nombre.'->con precio '.$pre];
            }
          }
        }
        return response()->json($results);
    }
}
