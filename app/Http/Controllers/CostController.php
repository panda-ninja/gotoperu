<?php

namespace App\Http\Controllers;

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
//        dd($productos_hotels);
        return view('admin.database.costs',['productos_hotels'=>$productos_hotels,
            'productos_tours'=>$productos_tours,'productos_transp'=>$productos_transp,
            'productos_guides'=>$productos_guides,'productos_entrances'=>$productos_entrances,
            'productos_food'=>$productos_food,'productos_trains'=>$productos_trains,
            'productos_travels'=>$productos_travels,'productos_others'=>$productos_others,'destinations'=>$destinations]);
    }
    public function store(Request $request){
        $tipoServicio[0]='HOTELS';
        $tipoServicio[1]='TOURS';
        $tipoServicio[2]='TRANSPORTATION';
        $tipoServicio[3]='GUIDES_ASSIST';
        $tipoServicio[4]='ENTRANCES';
        $tipoServicio[5]='FOOD';
        $tipoServicio[6]='TRAINS';
        $tipoServicio[7]='TRAVELS';
        $tipoServicio[8]='OTHERS';
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
            $servicio=M_Servicio::where('codigo',$txt_code)->OrWhere('nombre',$txt_product)->get();
            if(count($servicio)==0){
                $new_sericio=new M_Servicio();
                $new_sericio->codigo=$txt_code;
                $new_sericio->localizacion=$txt_localizacion;
                $new_sericio->grupo=$tipoServicio[$posTipo];
                $new_sericio->tipoServicio=$tipoServicio[$posTipo];
                $new_sericio->nombre=$txt_product;
                $new_sericio->precio_venta=$txt_price;
                $new_sericio->save();
            }
            else{
                $lista_costos=M_Producto::where('codigo',$txt_code)->OrWhere('nombre',$txt_product)->get();
                $costo_max=0;
                foreach ($lista_costos as $costo){
                    if($costo->precio_costo>$costo_max)
                        $costo_max=$costo->precio_costo;
                }
                if($txt_price>$costo_max)
                    $costo_max=$txt_price;
                foreach ($servicio as $servicio1){
                    $servicio1->precio_venta=$costo_max;
                    $servicio1->save();
                }
            }
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
//        dd($productos_hotels);
            return view('admin.database.costs',['productos_hotels'=>$productos_hotels,
                'productos_tours'=>$productos_tours,'productos_transp'=>$productos_transp,
                'productos_guides'=>$productos_guides,'productos_entrances'=>$productos_entrances,
                'productos_food'=>$productos_food,'productos_trains'=>$productos_trains,
                'productos_travels'=>$productos_travels,'productos_others'=>$productos_others,'destinations'=>$destinations]);
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
        $posTipo=$request->input('posTipoEditcost_'.$id);
        $localizacion=strtoupper($request->input('txt_localizacion_'.$posTipo));
        $grupo=strtoupper($request->input('tipoServicio_'.$posTipo));
        $type=strtoupper($request->input('txt_type_'.$posTipo));
        $provider=explode(' ',$request->input('txt_provider_'.$posTipo));
        $producto_nombre=strtoupper($request->input('txt_product_'.$posTipo));
        $producto_code=strtoupper($request->input('txt_code_'.$posTipo));
        $price=strtoupper($request->input('txt_price_'.$posTipo));

        $proveedor=Proveedor::where('codigo',$provider[0])->get();
        if(count($proveedor)>0) {
            $proveedor_id=0;
            foreach ($proveedor as $pro){
                $proveedor_id=$pro->id;
            }
            $producto = M_Producto::FindOrFail($id);
            $producto->codigo = $producto_code;
            $producto->grupo = $grupo;
            $producto->localizacion = $localizacion;
            $producto->tipo_producto = $type;
            $producto->nombre = $producto_nombre;
//            $producto->descripcion = '';
            $producto->precio_costo = $price;
            $producto->proveedor_id = $proveedor_id;
            $producto->save();

            $servicio=M_Servicio::where('codigo',$producto_code)->OrWhere('nombre',$producto_nombre)->get();
            if(count($servicio)==0){
                $new_sericio=new M_Servicio();
                $new_sericio->codigo=$producto_code;
                $new_sericio->localizacion=$localizacion;
                $new_sericio->grupo=$grupo;
                $new_sericio->tipoServicio=$type;
                $new_sericio->nombre=$producto_nombre;
                $new_sericio->precio_venta=$price;
                $new_sericio->save();
            }
            else{
                $lista_costos=M_Producto::where('codigo',$producto_code)->OrWhere('nombre',$producto_nombre)->get();
                $costo_max=0;
                foreach ($lista_costos as $costo){
                    if($costo->precio_costo>$costo_max)
                        $costo_max=$costo->precio_costo;
                }
                if($price>$costo_max)
                    $costo_max=$price;
                foreach ($servicio as $servicio1){
                    $servicio1->precio_venta=$costo_max;
                    $servicio1->save();
                }
            }

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
//        dd($productos_hotels);
            return view('admin.database.costs',['productos_hotels'=>$productos_hotels,
                'productos_tours'=>$productos_tours,'productos_transp'=>$productos_transp,
                'productos_guides'=>$productos_guides,'productos_entrances'=>$productos_entrances,
                'productos_food'=>$productos_food,'productos_trains'=>$productos_trains,
                'productos_travels'=>$productos_travels,'productos_others'=>$productos_others,'destinations'=>$destinations]);
        }
    }
}
