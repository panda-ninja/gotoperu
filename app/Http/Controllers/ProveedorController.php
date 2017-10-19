<?php

namespace App\Http\Controllers;

use App\M_Category;
use App\M_Destino;
use App\M_Producto;
use App\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProveedorController extends Controller
{
    //
    public function index()
    {
        $destinations=M_Destino::get();
        $providers=Proveedor::get();
        $categorias=M_Category::get();
        return view('admin.database.provider',['destinations'=>$destinations,'providers'=>$providers,'categorias'=>$categorias]);
    }
    public function autocomplete()
    {
        $clave='';
//        dd($clave);
//        if ($request->ajax()) {
            $term = Input::get('term');
            $localizacion = Input::get('localizacion');
            $grupo= Input::get('grupo');


//            $rs =strtoupper($request->get('txt_provider_0'));
            $results = null;
            $results = [];
            $proveedor = Proveedor::where('codigo', 'like', '%' . $term . '%')
                ->orWhere('razon_social', 'like', '%' . $term . '%')
                ->get();

//            $queries = DB::table('users')
//                ->where('first_name', 'LIKE', '%'.$term.'%')
//                ->orWhere('last_name', 'LIKE', '%'.$term.'%')
//                ->take(5)->get();

            foreach ($proveedor as $query) {
//                $rpt1=strpos($query->codigo,$term);
//                $rpt2=strpos($query->razon_social,$term);
                if($grupo==$query->grupo){
//                    if($localizacion==$query->localizacion)
                        $results[] = ['id' => $query->id, 'value' => $query->codigo.' '.$query->razon_social];
                }
            }
            return response()->json($results);
//            $rs1=[];
//            $rs1[]=$localizacion;
//            $rs1[]=$grupo;
//            $rs1[]=$term;
//            return response()->json($rs1);
//        }

    }
    public function store(Request $request){
        if ($request->ajax()) {
            $txt_grupo=$request->input('txt_grupo');
            $txt_grupo_cod=substr($txt_grupo,0,1);
            $txt_localizacion=$request->input('txt_localizacion');
            $txt_localizacion_cod=substr($txt_localizacion,0,1);
            $txt_ruc=$request->input('txt_ruc');
            $txt_razon_social=strtoupper($request->input('txt_razon_social'));
            $txt_direccion=$request->input('txt_direccion');
            $txt_telefono=$request->input('txt_telefono');
            $txt_celular=$request->input('txt_celular');
            $txt_email=$request->input('txt_email');
            $txt_r_nombres=strtoupper($request->input('txt_r_nombres'));
            $txt_r_telefono=$request->input('txt_r_telefono');
            $txt_c_nombres=strtoupper($request->input('txt_c_nombres'));
            $txt_c_telefono=$request->input('txt_c_telefono');

//            echo $txt_grupo.'_'.$txt_grupo_cod.'_'.$txt_localizacion.'_'.$txt_localizacion_cod.'_'.$txt_ruc.'_'.$txt_razon_social.'_'.$txt_direccion.'_'.$txt_telefono.
//                '_'.$txt_celular.'_'.$txt_email.'_'.$txt_r_nombres.'_'.$txt_r_telefono.'_'.$txt_c_nombres.'_'.$txt_c_telefono;

            $proveedor=new Proveedor();
            $proveedor->ruc=$txt_ruc;
            $proveedor->razon_social=$txt_razon_social;
            $proveedor->direccion=$txt_direccion;
            $proveedor->telefono=$txt_telefono;
            $proveedor->celular=$txt_celular;
            $proveedor->email=$txt_email;
            $proveedor->r_nombres=$txt_r_nombres;
            $proveedor->r_telefono=$txt_r_telefono;
            $proveedor->c_nombres=$txt_c_nombres;
            $proveedor->c_telefono=$txt_c_telefono;
            $proveedor->localizacion=$txt_localizacion;
            $proveedor->grupo=$txt_grupo;
            if($proveedor->save()){
                $proveedor->codigo=$txt_grupo_cod.$txt_localizacion_cod.$proveedor->id;
                $proveedor->save();
                return '1_'.$proveedor->codigo.'_'.$proveedor->razon_social;
//                return response()->json($resp, 200);
            }
            else{
                return '0_'.$proveedor->codigo.'_'.$proveedor->razon_social;
//                return response()->json($resp, 200);
            }
        }
        else{
            return 'hola';
//            return response()->json('hola', 200);
        }
    }
    public function store_new(Request $request){

        $categorias=M_Category::get();
        foreach($categorias as $categoria){
            $tipoServicio[]=$categoria->nombre;
        }
        $nro_grupo=$request->input('posTipo');
        $txt_grupo=$tipoServicio[$nro_grupo];
        $txt_grupo_cod=substr($txt_grupo,0,2);
        $txt_localizacion=$request->input('txt_localizacion_'.$nro_grupo);
        $txt_localizacion_cod=substr($txt_localizacion,0,1);
        $txt_ruc=$request->input('txt_ruc_'.$nro_grupo);
        $txt_razon_social=strtoupper($request->input('txt_razon_social_'.$nro_grupo));
        $txt_direccion=$request->input('txt_direccion_'.$nro_grupo);
        $txt_telefono=$request->input('txt_telefono_'.$nro_grupo);
        $txt_celular=$request->input('txt_celular_'.$nro_grupo);
        $txt_email=$request->input('txt_email_'.$nro_grupo);
        $txt_r_nombres=strtoupper($request->input('txt_r_nombres_'.$nro_grupo));
        $txt_r_telefono=$request->input('txt_r_telefono_'.$nro_grupo);
        $txt_c_nombres=strtoupper($request->input('txt_c_nombres_'.$nro_grupo));
        $txt_c_telefono=$request->input('txt_c_telefono_'.$nro_grupo);
        $proveedor=new Proveedor();
        $proveedor->ruc=$txt_ruc;
        $proveedor->razon_social=$txt_razon_social;
        $proveedor->direccion=$txt_direccion;
        $proveedor->telefono=$txt_telefono;
        $proveedor->celular=$txt_celular;
        $proveedor->email=$txt_email;
        $proveedor->r_nombres=$txt_r_nombres;
        $proveedor->r_telefono=$txt_r_telefono;
        $proveedor->c_nombres=$txt_c_nombres;
        $proveedor->c_telefono=$txt_c_telefono;
        $proveedor->localizacion=$txt_localizacion;
        $proveedor->grupo=$txt_grupo;
        if($proveedor->save()){
            $proveedor->codigo=$txt_grupo_cod.$proveedor->id;
            $proveedor->save();
            $destinations=M_Destino::get();
            $providers=Proveedor::get();
            $categorias=M_Category::get();
            return view('admin.database.provider',['destinations'=>$destinations,'providers'=>$providers,'categorias'=>$categorias]);
        }
    }
    public function edit(Request $request){


        $id=$request->input('id');
        $grupo=$request->input('posTipoEditcost_'.$id);
//        $txt_grupo=$tipoServicio[$nro_grupo];
        $txt_grupo_cod=substr($grupo,0,2);
        $txt_localizacion=$request->input('txt_localizacion_');
        $txt_localizacion_cod=substr($txt_localizacion,0,1);
        $txt_ruc=$request->input('txt_ruc_');
        $txt_razon_social=strtoupper($request->input('txt_razon_social_'));
        $txt_direccion=$request->input('txt_direccion_');
        $txt_telefono=$request->input('txt_telefono_');
        $txt_celular=$request->input('txt_celular_');
        $txt_email=$request->input('txt_email_');
        $txt_r_nombres=strtoupper($request->input('txt_r_nombres_'));
        $txt_r_telefono=$request->input('txt_r_telefono_');
        $txt_c_nombres=strtoupper($request->input('txt_c_nombres_'));
        $txt_c_telefono=$request->input('txt_c_telefono_');
        $txt_categoria=$request->input('txt_categoria_');

        $proveedor=Proveedor::findOrFail($id);
        $proveedor->ruc=$txt_ruc;
        $proveedor->razon_social=$txt_razon_social;
        $proveedor->direccion=$txt_direccion;
        $proveedor->telefono=$txt_telefono;
        $proveedor->celular=$txt_celular;
        $proveedor->email=$txt_email;
        $proveedor->r_nombres=$txt_r_nombres;
        $proveedor->r_telefono=$txt_r_telefono;
        $proveedor->c_nombres=$txt_c_nombres;
        $proveedor->c_telefono=$txt_c_telefono;
        $proveedor->localizacion=$txt_localizacion;
        $proveedor->categoria=$txt_categoria;

//        $proveedor->codigo=$txt_grupo_cod.$proveedor->id;
        if($proveedor->save()){
            $proveedor->codigo=$txt_grupo_cod.$id;
            $destinations=M_Destino::get();
            $providers=Proveedor::get();
            $categorias=M_Category::get();
            return view('admin.database.provider',['destinations'=>$destinations,'providers'=>$providers,'categorias'=>$categorias]);
        }
    }
    public function delete(Request $request){
        $id=$request->input('id');
        $producto=Proveedor::FindOrFail($id);
        $producto_pro=M_Producto::where('proveedor_id',$id)->get();
        if(count($producto_pro)==0){
            if($producto->delete())
                return 1;
            else
                return 0;
        }
        else{
            return 2;
        }
    }
}
