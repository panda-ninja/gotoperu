<?php

namespace App\Http\Controllers;

use App\M_Category;
use App\M_Destino;
use App\M_Producto;
use App\M_Servicio;
use App\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class CostController extends Controller
{
    //
    public function index(){
        $valor='';
        $productos_hotels=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','HOTELS');}])->get();
        $productos_tours=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','TOURS');}])->get();
        $productos_transp=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','TRANSPORTATION');}])->get();
        $productos_guides=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','GUIDES_ASSIST');}])->get();
        $productos_entrances=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','ENTRANCES');}])->get();
        $productos_food=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','FOOD');}])->get();
        $productos_trains=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','TRAINS');}])->get();
        $productos_travels=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','TRAVELS');}])->get();
        $productos_others=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','OTHERS');}])->get();
        $destinations=M_Destino::get();
        $categorias=M_Category::get();
        $productos=Proveedor::with(['productos'])->get();
//        dd($productos_hotels);
        return view('admin.database.costs',['productos_hotels'=>$productos_hotels,
            'productos_tours'=>$productos_tours,'productos_transp'=>$productos_transp,
            'productos_guides'=>$productos_guides,'productos_entrances'=>$productos_entrances,
            'productos_food'=>$productos_food,'productos_trains'=>$productos_trains,
            'productos_travels'=>$productos_travels,'productos_others'=>$productos_others,
            'destinations'=>$destinations,'categorias'=>$categorias,
            'productos'=>$productos]);
    }
    public function store(Request $request){
        $categorias=M_Category::get();
        foreach($categorias as $categoria){
            $tipoServicio[]=$categoria->nombre;
        }

        $posTipo=$request->input('posTipo');
//        $posTipo=0;
        $localizacion='txt_localizacion_'.$posTipo;
        $type='txt_type_'.$posTipo;
        $provider='txt_provider_'.$posTipo;
        $product='txt_product_'.$posTipo;
        $code='txt_code_'.$posTipo;
        $price='txt_price_'.$posTipo;
        $acomodacion='txt_acomodacion_'.$posTipo;
        $tipo_grupo='txt_tipo_grupo_'.$posTipo;
        $txt_tipo_grupo=$request->input($tipo_grupo);

        if($txt_tipo_grupo=='Absoluto')
            $txt_price_chb=1;
        else
            $txt_price_chb=0;

        $txt_acomodacion=$request->input($acomodacion);
        if(strlen($txt_acomodacion)>0)
            $txt_acomodacion=$txt_acomodacion;
        else
            $txt_acomodacion='';

        $txt_localizacion=strtoupper($request->input($localizacion));
        $txt_type=$request->input($type);
        $txt_provider=explode(' ',$request->input($provider));
        $txt_product=explode(' ',strtoupper($request->input($product)));
        $txt_code=$txt_product[0];
        $txt_price=$request->input($price);

        $proveedor=Proveedor::where('codigo',$txt_provider[0])->get();
        $prod=M_Servicio::where('codigo',$txt_product[0])->get();
//        dd($proveedor);
        if(count($proveedor)>0) {
            $proveedor_id=0;
            foreach ($proveedor as $pro){
                $proveedor_id=$pro->id;
            }
            $prod__precio_g=0;
            $prod_nombre='';
            foreach ($prod as $pro){
                $prod__precio_g=$pro->precio_grupo;
                $prod_nombre=$pro->nombre;
            }
            $producto = new M_Producto();
            $producto->codigo = $txt_code;
            $producto->grupo = $tipoServicio[$posTipo];
            $producto->localizacion = $txt_localizacion;
            $producto->tipo_producto = $txt_type;
            $producto->nombre = $prod_nombre;
            $producto->descripcion = '';
            $producto->precio_costo = $txt_price;
            $producto->acomodacion = $txt_acomodacion;
            $producto->precio_grupo = $prod__precio_g;
            $producto->proveedor_id = $proveedor_id;
            $producto->save();

            $valor='';
            $productos_hotels=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','HOTELS');}])->get();
            $productos_tours=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','TOURS');}])->get();
            $productos_transp=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','TRANSPORTATION');}])->get();
            $productos_guides=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','GUIDES_ASSIST');}])->get();
            $productos_entrances=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','ENTRANCES');}])->get();
            $productos_food=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','FOOD');}])->get();
            $productos_trains=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','TRAINS');}])->get();
            $productos_travels=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','TRAVELS');}])->get();
            $productos_others=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','OTHERS');}])->get();
            $destinations=M_Destino::get();
            $categorias=M_Category::get();
            $productos=Proveedor::with(['productos'])->get();
//        dd($productos_hotels);
            return view('admin.database.costs',['productos_hotels'=>$productos_hotels,
                'productos_tours'=>$productos_tours,'productos_transp'=>$productos_transp,
                'productos_guides'=>$productos_guides,'productos_entrances'=>$productos_entrances,
                'productos_food'=>$productos_food,'productos_trains'=>$productos_trains,
                'productos_travels'=>$productos_travels,'productos_others'=>$productos_others,
                'destinations'=>$destinations,'categorias'=>$categorias,
                'productos'=>$productos]);
        }

    }
    public function delete(Request $request){
        $id=$request->input('id');
        $producto=M_Producto::FindOrFail($id);
        if($producto->delete())
            return 1;
        else
            return 0;
    }
    public function edit(Request $request){
        $categorias=M_Category::get();
        foreach($categorias as $categoria){
            $tipoServicio[]=$categoria->nombre;
        }

//        $posTipo=$request->input('posTipo');
        $id=$request->input('id');
        $posTipo=0;
        $localizacion='txt_localizacion_'.$posTipo;
        $type='txt_type_'.$posTipo;
        $provider='txt_provider_'.$posTipo;
        $product='txt_product_'.$posTipo;
        $code='txt_code_'.$posTipo;
        $price='txt_price_'.$posTipo;
        $acomodacion='txt_acomodacion_'.$posTipo;
        $tipo_grupo='txt_tipo_grupo_'.$posTipo;
        $txt_tipo_grupo=$request->input($tipo_grupo);

        if($txt_tipo_grupo=='Absoluto')
            $txt_price_chb=1;
        else
            $txt_price_chb=0;

        $txt_acomodacion=$request->input($acomodacion);
        if(strlen($txt_acomodacion)>0)
            $txt_acomodacion=$txt_acomodacion;
        else
            $txt_acomodacion='';

        $txt_localizacion=strtoupper($request->input($localizacion));
        $txt_type=$request->input($type);
        $txt_provider=explode(' ',$request->input($provider));
        $txt_product=explode(' ',strtoupper($request->input($product)));
        $txt_code=$txt_product[0];
        $txt_price=$request->input($price);

        $proveedor=Proveedor::where('codigo',$txt_provider[0])->get();
        $prod=M_Servicio::where('codigo',$txt_product[0])->get();

//        dd($proveedor);
        if(count($proveedor)>0) {
            $proveedor_id=0;
            foreach ($proveedor as $pro){
                $proveedor_id=$pro->id;
            }
            $prod__precio_g=0;
            $prod_nombre='';
            foreach ($prod as $pro){
                $prod__precio_g=$pro->precio_grupo;
                $prod_nombre=$pro->nombre;
            }
            $producto = M_Producto::FindOrFail($id);
            $producto->codigo = $txt_code;
            $producto->grupo = $tipoServicio[$posTipo];
            $producto->localizacion = $txt_localizacion;
            $producto->tipo_producto = $txt_type;
            $producto->nombre = $prod_nombre;
            $producto->descripcion = '';
            $producto->precio_costo = $txt_price;
            $producto->acomodacion = $txt_acomodacion;
            $producto->precio_grupo = $prod__precio_g;
            $producto->proveedor_id = $proveedor_id;
            $producto->save();

            $valor='';
            $productos_hotels=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','HOTELS');}])->get();
            $productos_tours=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','TOURS');}])->get();
            $productos_transp=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','TRANSPORTATION');}])->get();
            $productos_guides=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','GUIDES_ASSIST');}])->get();
            $productos_entrances=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','ENTRANCES');}])->get();
            $productos_food=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','FOOD');}])->get();
            $productos_trains=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','TRAINS');}])->get();
            $productos_travels=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','TRAVELS');}])->get();
            $productos_others=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','OTHERS');}])->get();
            $destinations=M_Destino::get();
            $categorias=M_Category::get();
            $productos=Proveedor::with(['productos'])->get();
//        dd($productos_hotels);
            return view('admin.database.costs',['productos_hotels'=>$productos_hotels,
                'productos_tours'=>$productos_tours,'productos_transp'=>$productos_transp,
                'productos_guides'=>$productos_guides,'productos_entrances'=>$productos_entrances,
                'productos_food'=>$productos_food,'productos_trains'=>$productos_trains,
                'productos_travels'=>$productos_travels,'productos_others'=>$productos_others,
                'destinations'=>$destinations,'categorias'=>$categorias,
                'productos'=>$productos]);
        }
    }
}
