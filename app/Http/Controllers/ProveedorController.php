<?php

namespace App\Http\Controllers;

use App\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    //
    public function autocomplete(Request $request)
    {
        if ($request->ajax()) {
            $rs = $request->get('txt_provider_0');
            $results = [];
            $proveedor = Proveedor::where('codigo', 'like', '%' . $rs . '%')
                ->orWhere('razon_social', 'like', '%' . $rs . '%')
//                ->orWhere('apellidos','like','%'.$dni.'%')
                ->get();
            foreach ($proveedor as $query) {
                $results[] = ['id' => $query->id, 'value' => $query->codigo.' '.$query->razon_social];
            }
            return response()->json($results);
        }

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

}
