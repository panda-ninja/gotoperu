<?php

namespace App\Http\Controllers;

use App\Hotel;
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
        $hotel=Hotel::get();
//        dd($servicios);
        return view('admin.database.services',['servicios'=>$servicios,'categorias'=>$categorias,'destinations'=>$destinations,'hotel'=>$hotel]);
    }
    public function store(Request $request){
        $categorias=M_Category::get();

        foreach ($categorias as $categoria){
            $cate[]=$categoria->nombre;
        }
        $posTipo=$request->input('posTipo');
        $txt_localizacion=$request->input('txt_localizacion_'.$posTipo);
        if($posTipo==0){
            $S_2=$request->input('S_2');
            $D_2=$request->input('D_2');
            $M_2=$request->input('M_2');
            $T_2=$request->input('T_2');
            $SS_2=$request->input('SS_2');
            $SD_2=$request->input('SD_2');
            $SU_2=$request->input('SU_2');
            $JS_2=$request->input('JS_2');

            $S_3=$request->input('S_3');
            $D_3=$request->input('D_3');
            $M_3=$request->input('M_3');
            $T_3=$request->input('T_3');
            $SS_3=$request->input('SS_3');
            $SD_3=$request->input('SD_3');
            $SU_3=$request->input('SU_3');
            $JS_3=$request->input('JS_3');

            $S_4=$request->input('S_4');
            $D_4=$request->input('D_4');
            $M_4=$request->input('M_4');
            $T_4=$request->input('T_4');
            $SS_4=$request->input('SS_4');
            $SD_4=$request->input('SD_4');
            $SU_4=$request->input('SU_4');
            $JS_4=$request->input('JS_4');

            $S_5=$request->input('S_5');
            $D_5=$request->input('D_5');
            $M_5=$request->input('M_5');
            $T_5=$request->input('T_5');
            $SS_5=$request->input('SS_5');
            $SD_5=$request->input('SD_5');
            $SU_5=$request->input('SU_5');
            $JS_5=$request->input('JS_5');

            //-- GUARDAMOS LOS DATOS DE LOS HOTELES


            $hotel_proveedor=new Hotel();
            $hotel_proveedor->localizacion=$txt_localizacion;
            $hotel_proveedor->estrellas=2;
            $hotel_proveedor->single=$S_2;
            $hotel_proveedor->doble=$D_2;
            $hotel_proveedor->matrimonial=$M_2;
            $hotel_proveedor->triple=$T_2;
            $hotel_proveedor->superior_s=$SS_2;
            $hotel_proveedor->superior_d=$SD_2;
            $hotel_proveedor->suite=$SU_2;
            $hotel_proveedor->jr_suite=$JS_2;
            $hotel_proveedor->estado=1;
            $hotel_proveedor->save();

            $hotel_proveedor_3=new Hotel();
            $hotel_proveedor_3->localizacion=$txt_localizacion;
            $hotel_proveedor_3->estrellas=3;
            $hotel_proveedor_3->single=$S_3;
            $hotel_proveedor_3->doble=$D_3;
            $hotel_proveedor_3->matrimonial=$M_3;
            $hotel_proveedor_3->triple=$T_3;
            $hotel_proveedor_3->superior_s=$SS_3;
            $hotel_proveedor_3->superior_d=$SD_3;
            $hotel_proveedor_3->suite=$SU_3;
            $hotel_proveedor_3->jr_suite=$JS_3;
            $hotel_proveedor_3->estado=1;
            $hotel_proveedor_3->save();

            $hotel_proveedor_4=new Hotel();
            $hotel_proveedor_4->localizacion=$txt_localizacion;
            $hotel_proveedor_4->estrellas=4;
            $hotel_proveedor_4->single=$S_4;
            $hotel_proveedor_4->doble=$D_4;
            $hotel_proveedor_4->matrimonial=$M_4;
            $hotel_proveedor_4->triple=$T_4;
            $hotel_proveedor_4->superior_s=$SS_4;
            $hotel_proveedor_4->superior_d=$SD_4;
            $hotel_proveedor_4->suite=$SU_4;
            $hotel_proveedor_4->jr_suite=$JS_4;
            $hotel_proveedor_4->estado=1;
            $hotel_proveedor_4->save();

            $hotel_proveedor_5=new Hotel();
            $hotel_proveedor_5->localizacion=$txt_localizacion;
            $hotel_proveedor_5->estrellas=5;
            $hotel_proveedor_5->single=$S_5;
            $hotel_proveedor_5->doble=$D_5;
            $hotel_proveedor_5->matrimonial=$M_5;
            $hotel_proveedor_5->triple=$T_5;
            $hotel_proveedor_5->superior_s=$SS_5;
            $hotel_proveedor_5->superior_d=$SD_5;
            $hotel_proveedor_5->suite=$SU_5;
            $hotel_proveedor_5->jr_suite=$JS_5;
            $hotel_proveedor_5->estado=1;
            $hotel_proveedor_5->save();

            $destinations=M_Destino::get();
            $servicios=M_Servicio::get();
            $categorias=M_Category::get();
            $hotel=Hotel::get();
            return view('admin.database.services',['servicios'=>$servicios,'categorias'=>$categorias,'destinations'=>$destinations,'hotel'=>$hotel]);
        }
        elseif($posTipo!=0) {
            $txt_type = $request->input('txt_type_' . $posTipo);
            $txt_acomodacion = $request->input('txt_acomodacion_' . $posTipo);
            $txt_product = $request->input('txt_product_' . $posTipo);
            $txt_price = $request->input('txt_price_' . $posTipo);
            $txt_tipo_grupo = $request->input('txt_tipo_grupo_' . $posTipo);
            $txt_salida = $request->input('txt_salida_' . $posTipo);
            $txt_llegada = $request->input('txt_llegada_' . $posTipo);
            $txt_min_personas = $request->input('txt_min_personas_' . $posTipo);
            $txt_max_personas = $request->input('txt_max_personas_' . $posTipo);

            $destino = new M_Servicio();
            $destino->grupo = $cate[$posTipo];
            $destino->localizacion = $txt_localizacion;
            $destino->tipoServicio = $txt_type;
            $destino->acomodacion = $txt_acomodacion;
            $destino->nombre = $txt_product;
            $destino->precio_venta = $txt_price;
            $destino->salida = $txt_salida;
            $destino->llegada = $txt_llegada;
            $destino->min_personas = $txt_min_personas;
            $destino->max_personas = $txt_max_personas;

            if ($txt_tipo_grupo == 'Absoluto')
                $destino->precio_grupo = 1;
            elseif ($txt_tipo_grupo == 'Individual')
                $destino->precio_grupo = 0;
//        $found_destino=M_Servicio::where('nombre',$txt_product)->get();
//        if(count($found_destino)==0)
            {
                $destino->save();
                $destino->codigo = $destino->id;
                $destino->save();
                $destinations=M_Destino::get();
                $servicios=M_Servicio::get();
                $categorias=M_Category::get();
                $hotel=Hotel::get();
                return view('admin.database.services',['servicios'=>$servicios,'categorias'=>$categorias,'destinations'=>$destinations,'hotel'=>$hotel]);
            }
//        else{
//            $destinations=M_Destino::get();
//            $servicios=M_Servicio::get();
//            $categorias=M_Category::get();
//            return view('admin.database.services',['servicios'=>$servicios,'categorias'=>$categorias,'destinations'=>$destinations]);
//        }
        }
    }
    public function edit_hotel(Request $request){
        $id=$request->input('id');
        $S_2=$request->input('eS_2');
        $D_2=$request->input('eD_2');
        $M_2=$request->input('eM_2');
        $T_2=$request->input('eT_2');
        $SS_2=$request->input('eSS_2');
        $SD_2=$request->input('eSD_2');
        $SU_2=$request->input('eSU_2');
        $JS_2=$request->input('eJS_2');


        $hotel_proveedor=Hotel::FindOrFail($id);
        $hotel_proveedor->single=$S_2;
        $hotel_proveedor->doble=$D_2;
        $hotel_proveedor->matrimonial=$M_2;
        $hotel_proveedor->triple=$T_2;
        $hotel_proveedor->superior_s=$SS_2;
        $hotel_proveedor->superior_d=$SD_2;
        $hotel_proveedor->suite=$SU_2;
        $hotel_proveedor->jr_suite=$JS_2;
        $hotel_proveedor->estado=1;
        $hotel_proveedor->save();
        $destinations=M_Destino::get();
        $servicios=M_Servicio::get();
        $categorias=M_Category::get();
        $hotel=Hotel::get();
        return view('admin.database.services',['servicios'=>$servicios,'categorias'=>$categorias,'destinations'=>$destinations,'hotel'=>$hotel]);
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
        $txt_salida=$request->input('txt_salida_'.$posTipo);
        $txt_llegada=$request->input('txt_llegada_'.$posTipo);
        $txt_min_personas=$request->input('txt_min_personas_'.$posTipo);
        $txt_max_personas=$request->input('txt_max_personas_'.$posTipo);

        $destino=M_Servicio::FindOrFail($id);
        $destino->localizacion=$txt_localizacion;
        $destino->tipoServicio=$txt_type;
        $destino->acomodacion=$txt_acomodacion;
        $destino->nombre=$txt_product;
        $destino->precio_venta=$txt_price;
        $destino->salida=$txt_salida;
        $destino->llegada=$txt_llegada;
        $destino->min_personas=$txt_min_personas;
        $destino->max_personas=$txt_max_personas;
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
                $results[] = ['id' => $query->id, 'value' => $query->codigo.' '.$query->nombre.' '.$query->tipoServicio.'->con precio '.$pre];
            }
          }
        }
        return response()->json($results);
    }
}
