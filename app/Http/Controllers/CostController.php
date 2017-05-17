<?php

namespace App\Http\Controllers;

use App\M_Producto;
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
        $productos_others=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','OTHERS');}])->get();
//        dd($productos_hotels);
        return view('admin.database.costs',['productos_hotels'=>$productos_hotels,
            'productos_tours'=>$productos_tours,'productos_transp'=>$productos_transp,
            'productos_guides'=>$productos_guides,'productos_entrances'=>$productos_entrances,
            'productos_food'=>$productos_food,'productos_others'=>$productos_others]);
    }
    public function store(Request $request){
        $tipoServicio[0]='HOTELS';
        $tipoServicio[1]='TOURS';
        $tipoServicio[2]='TRANSPORTATION';
        $tipoServicio[3]='GUIDES_ASSIST';
        $tipoServicio[4]='ENTRANCES';
        $tipoServicio[5]='FOOD';
        $tipoServicio[6]='OTHERS';
        $posTipo=$request->input('posTipo');
        $localizacion='txt_localizacion_'.$posTipo;
        $type='txt_type_'.$posTipo;
        $provider='txt_provider_'.$posTipo;
        $product='txt_product_'.$posTipo;
        $code='txt_code_'.$posTipo;
        $price='txt_price_'.$posTipo;

        $txt_localizacion=strtoupper($request->input($localizacion));
        $txt_type=$request->input($type);
        $txt_provider=explode(' ',$request->input($provider));
        $txt_product=strtoupper($request->input($product));
        $txt_code=strtoupper($request->input($code));
        $txt_price=$request->input($price);
        $proveedor=Proveedor::where('codigo',$txt_provider[0])->get();
        if(count($proveedor)>0) {
            $proveedor_id=0;
            foreach ($proveedor as $pro){
                $proveedor_id=$pro->id;
            }
            $producto = new M_Producto();
            $producto->codigo = $txt_code;
            $producto->grupo = $tipoServicio[$posTipo];
            $producto->localizacion = $txt_localizacion;
            $producto->tipo_producto = $txt_type;
            $producto->nombre = $txt_product;
            $producto->descripcion = '';
            $producto->precio_costo = $txt_price;
            $producto->proveedor_id = $proveedor_id;
            $producto->save();
            $valor='';
            $productos_hotels=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','HOTELS');}])->get();
            $productos_tours=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','TOURS');}])->get();
            $productos_transp=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','TRANSPORTATION');}])->get();
            $productos_guides=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','GUIDES_ASSIST');}])->get();
            $productos_entrances=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','ENTRANCES');}])->get();
            $productos_food=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','FOOD');}])->get();
            $productos_others=Proveedor::with(['productos'=>function($query)use($valor){$query->where('grupo','OTHERS');}])->get();
//        dd($productos_hotels);
            return view('admin.database.costs',['productos_hotels'=>$productos_hotels,
                'productos_tours'=>$productos_tours,'productos_transp'=>$productos_transp,
                'productos_guides'=>$productos_guides,'productos_entrances'=>$productos_entrances,
                'productos_food'=>$productos_food,'productos_others'=>$productos_others]);
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
