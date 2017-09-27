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
            $destino_s_2 = new M_Servicio();
            $destino_s_2->grupo = $cate[$posTipo];
            $destino_s_2->localizacion = $txt_localizacion;
            $destino_s_2->tipoServicio = '2 STARS';
            $destino_s_2->acomodacion = 'S';
            $destino_s_2->nombre = 'SINGLE ROOM';
            $destino_s_2->precio_venta = $S_2;
            $destino_s_2->salida = '';
            $destino_s_2->llegada = '';
            $destino_s_2->min_personas = 1;
            $destino_s_2->max_personas = 1;
            $destino_s_2->save();
            $destino_s_2->codigo = $destino_s_2->id;
            $destino_s_2->save();

            $destino_d_2 = new M_Servicio();
            $destino_d_2->grupo = $cate[$posTipo];
            $destino_d_2->localizacion = $txt_localizacion;
            $destino_d_2->tipoServicio = '2 STARS';
            $destino_d_2->acomodacion = 'D';
            $destino_d_2->nombre = 'DOUBLE ROOM';
            $destino_d_2->precio_venta = $D_2;
            $destino_d_2->salida = '';
            $destino_d_2->llegada = '';
            $destino_d_2->min_personas = 1;
            $destino_d_2->max_personas = 2;
            $destino_d_2->save();
            $destino_d_2->codigo = $destino_d_2->id;
            $destino_d_2->save();

            $destino_m_2 = new M_Servicio();
            $destino_m_2->grupo = $cate[$posTipo];
            $destino_m_2->localizacion = $txt_localizacion;
            $destino_m_2->tipoServicio = '2 STARS';
            $destino_m_2->acomodacion = 'M';
            $destino_m_2->nombre = 'MATRIMONIAL ROOM';
            $destino_m_2->precio_venta = $M_2;
            $destino_m_2->salida = '';
            $destino_m_2->llegada = '';
            $destino_m_2->min_personas = 1;
            $destino_m_2->max_personas = 2;
            $destino_m_2->save();
            $destino_m_2->codigo = $destino_m_2->id;
            $destino_m_2->save();

            $destino_t_2 = new M_Servicio();
            $destino_t_2->grupo = $cate[$posTipo];
            $destino_t_2->localizacion = $txt_localizacion;
            $destino_t_2->tipoServicio = '2 STARS';
            $destino_t_2->acomodacion = 'T';
            $destino_t_2->nombre = 'TRIPLE ROOM';
            $destino_t_2->precio_venta = $T_2;
            $destino_t_2->salida = '';
            $destino_t_2->llegada = '';
            $destino_t_2->min_personas = 1;
            $destino_t_2->max_personas = 3;
            $destino_t_2->save();
            $destino_t_2->codigo = $destino_t_2->id;
            $destino_t_2->save();

            $destino_ss_2 = new M_Servicio();
            $destino_ss_2->grupo = $cate[$posTipo];
            $destino_ss_2->localizacion = $txt_localizacion;
            $destino_ss_2->tipoServicio = '2 STARS';
            $destino_ss_2->acomodacion = 'SS';
            $destino_ss_2->nombre = 'SUPERIOR ROOM';
            $destino_ss_2->precio_venta = $SS_2;
            $destino_ss_2->salida = '';
            $destino_ss_2->llegada = '';
            $destino_ss_2->min_personas = 1;
            $destino_ss_2->max_personas = 1;
            $destino_ss_2->save();
            $destino_ss_2->codigo = $destino_ss_2->id;
            $destino_ss_2->save();

            $destino_sd_2 = new M_Servicio();
            $destino_sd_2->grupo = $cate[$posTipo];
            $destino_sd_2->localizacion = $txt_localizacion;
            $destino_sd_2->tipoServicio = '2 STARS';
            $destino_sd_2->acomodacion = 'SD';
            $destino_sd_2->nombre = 'SUPERIOR DOUBLE ROOM';
            $destino_sd_2->precio_venta = $SD_2;
            $destino_sd_2->salida = '';
            $destino_sd_2->llegada = '';
            $destino_sd_2->min_personas = 1;
            $destino_sd_2->max_personas = 2;
            $destino_sd_2->save();
            $destino_sd_2->codigo = $destino_sd_2->id;
            $destino_sd_2->save();

            $destino_su_2 = new M_Servicio();
            $destino_su_2->grupo = $cate[$posTipo];
            $destino_su_2->localizacion = $txt_localizacion;
            $destino_su_2->tipoServicio = '2 STARS';
            $destino_su_2->acomodacion = 'SU';
            $destino_su_2->nombre = 'SUITE ROOM';
            $destino_su_2->precio_venta = $SD_2;
            $destino_su_2->salida = '';
            $destino_su_2->llegada = '';
            $destino_su_2->min_personas = 1;
            $destino_su_2->max_personas = 2;
            $destino_su_2->save();
            $destino_su_2->codigo = $destino_su_2->id;
            $destino_su_2->save();

            $destino_js_2 = new M_Servicio();
            $destino_js_2->grupo = $cate[$posTipo];
            $destino_js_2->localizacion = $txt_localizacion;
            $destino_js_2->tipoServicio = '2 STARS';
            $destino_js_2->acomodacion = 'JS';
            $destino_js_2->nombre = 'JR. SUITE ROOM';
            $destino_js_2->precio_venta = $JS_2;
            $destino_js_2->salida = '';
            $destino_js_2->llegada = '';
            $destino_js_2->min_personas = 1;
            $destino_js_2->max_personas = 2;
            $destino_js_2->save();
            $destino_js_2->codigo = $destino_js_2->id;
            $destino_js_2->save();

            $destino_s_3 = new M_Servicio();
            $destino_s_3->grupo = $cate[$posTipo];
            $destino_s_3->localizacion = $txt_localizacion;
            $destino_s_3->tipoServicio = '3 STARS';
            $destino_s_3->acomodacion = 'S';
            $destino_s_3->nombre = 'SINGLE ROOM';
            $destino_s_3->precio_venta = $S_3;
            $destino_s_3->salida = '';
            $destino_s_3->llegada = '';
            $destino_s_3->min_personas = 1;
            $destino_s_3->max_personas = 1;
            $destino_s_3->save();
            $destino_s_3->codigo = $destino_s_3->id;
            $destino_s_3->save();

            $destino_d_3 = new M_Servicio();
            $destino_d_3->grupo = $cate[$posTipo];
            $destino_d_3->localizacion = $txt_localizacion;
            $destino_d_3->tipoServicio = '3 STARS';
            $destino_d_3->acomodacion = 'D';
            $destino_d_3->nombre = 'DOUBLE ROOM';
            $destino_d_3->precio_venta = $D_3;
            $destino_d_3->salida = '';
            $destino_d_3->llegada = '';
            $destino_d_3->min_personas = 1;
            $destino_d_3->max_personas = 2;
            $destino_d_3->save();
            $destino_d_3->codigo = $destino_d_3->id;
            $destino_d_3->save();

            $destino_m_3 = new M_Servicio();
            $destino_m_3->grupo = $cate[$posTipo];
            $destino_m_3->localizacion = $txt_localizacion;
            $destino_m_3->tipoServicio = '3 STARS';
            $destino_m_3->acomodacion = 'M';
            $destino_m_3->nombre = 'MATRIMONIAL ROOM';
            $destino_m_3->precio_venta = $M_3;
            $destino_m_3->salida = '';
            $destino_m_3->llegada = '';
            $destino_m_3->min_personas = 1;
            $destino_m_3->max_personas = 2;
            $destino_m_3->save();
            $destino_m_3->codigo = $destino_m_3->id;
            $destino_m_3->save();

            $destino_t_3 = new M_Servicio();
            $destino_t_3->grupo = $cate[$posTipo];
            $destino_t_3->localizacion = $txt_localizacion;
            $destino_t_3->tipoServicio = '3 STARS';
            $destino_t_3->acomodacion = 'T';
            $destino_t_3->nombre = 'TRIPLE ROOM';
            $destino_t_3->precio_venta = $T_3;
            $destino_t_3->salida = '';
            $destino_t_3->llegada = '';
            $destino_t_3->min_personas = 1;
            $destino_t_3->max_personas = 3;
            $destino_t_3->save();
            $destino_t_3->codigo = $destino_t_3->id;
            $destino_t_3->save();

            $destino_ss_3 = new M_Servicio();
            $destino_ss_3->grupo = $cate[$posTipo];
            $destino_ss_3->localizacion = $txt_localizacion;
            $destino_ss_3->tipoServicio = '3 STARS';
            $destino_ss_3->acomodacion = 'SS';
            $destino_ss_3->nombre = 'SUPERIOR ROOM';
            $destino_ss_3->precio_venta = $SS_3;
            $destino_ss_3->salida = '';
            $destino_ss_3->llegada = '';
            $destino_ss_3->min_personas = 1;
            $destino_ss_3->max_personas = 1;
            $destino_ss_3->save();
            $destino_ss_3->codigo = $destino_ss_3->id;
            $destino_ss_3->save();

            $destino_sd_3 = new M_Servicio();
            $destino_sd_3->grupo = $cate[$posTipo];
            $destino_sd_3->localizacion = $txt_localizacion;
            $destino_sd_3->tipoServicio = '3 STARS';
            $destino_sd_3->acomodacion = 'SD';
            $destino_sd_3->nombre = 'SUPERIOR DOUBLE ROOM';
            $destino_sd_3->precio_venta = $SD_3;
            $destino_sd_3->salida = '';
            $destino_sd_3->llegada = '';
            $destino_sd_3->min_personas = 1;
            $destino_sd_3->max_personas = 2;
            $destino_sd_3->save();
            $destino_sd_3->codigo = $destino_sd_3->id;
            $destino_sd_3->save();

            $destino_su_3 = new M_Servicio();
            $destino_su_3->grupo = $cate[$posTipo];
            $destino_su_3->localizacion = $txt_localizacion;
            $destino_su_3->tipoServicio = '3 STARS';
            $destino_su_3->acomodacion = 'SU';
            $destino_su_3->nombre = 'SUITE ROOM';
            $destino_su_3->precio_venta = $SD_3;
            $destino_su_3->salida = '';
            $destino_su_3->llegada = '';
            $destino_su_3->min_personas = 1;
            $destino_su_3->max_personas = 2;
            $destino_su_3->save();
            $destino_su_3->codigo = $destino_su_3->id;
            $destino_su_3->save();

            $destino_js_3 = new M_Servicio();
            $destino_js_3->grupo = $cate[$posTipo];
            $destino_js_3->localizacion = $txt_localizacion;
            $destino_js_3->tipoServicio = '3 STARS';
            $destino_js_3->acomodacion = 'JS';
            $destino_js_3->nombre = 'JR. SUITE ROOM';
            $destino_js_3->precio_venta = $JS_3;
            $destino_js_3->salida = '';
            $destino_js_3->llegada = '';
            $destino_js_3->min_personas = 1;
            $destino_js_3->max_personas = 2;
            $destino_js_3->save();
            $destino_js_3->codigo = $destino_js_3->id;
            $destino_js_3->save();

            $destino_s_4 = new M_Servicio();
            $destino_s_4->grupo = $cate[$posTipo];
            $destino_s_4->localizacion = $txt_localizacion;
            $destino_s_4->tipoServicio = '4 STARS';
            $destino_s_4->acomodacion = 'S';
            $destino_s_4->nombre = 'SINGLE ROOM';
            $destino_s_4->precio_venta = $S_4;
            $destino_s_4->salida = '';
            $destino_s_4->llegada = '';
            $destino_s_4->min_personas = 1;
            $destino_s_4->max_personas = 1;
            $destino_s_4->save();
            $destino_s_4->codigo = $destino_s_4->id;
            $destino_s_4->save();

            $destino_d_4 = new M_Servicio();
            $destino_d_4->grupo = $cate[$posTipo];
            $destino_d_4->localizacion = $txt_localizacion;
            $destino_d_4->tipoServicio = '4 STARS';
            $destino_d_4->acomodacion = 'D';
            $destino_d_4->nombre = 'DOUBLE ROOM';
            $destino_d_4->precio_venta = $D_4;
            $destino_d_4->salida = '';
            $destino_d_4->llegada = '';
            $destino_d_4->min_personas = 1;
            $destino_d_4->max_personas = 2;
            $destino_d_4->save();
            $destino_d_4->codigo = $destino_d_4->id;
            $destino_d_4->save();

            $destino_m_4 = new M_Servicio();
            $destino_m_4->grupo = $cate[$posTipo];
            $destino_m_4->localizacion = $txt_localizacion;
            $destino_m_4->tipoServicio = '4 STARS';
            $destino_m_4->acomodacion = 'M';
            $destino_m_4->nombre = 'MATRIMONIAL ROOM';
            $destino_m_4->precio_venta = $M_4;
            $destino_m_4->salida = '';
            $destino_m_4->llegada = '';
            $destino_m_4->min_personas = 1;
            $destino_m_4->max_personas = 2;
            $destino_m_4->save();
            $destino_m_4->codigo = $destino_m_4->id;
            $destino_m_4->save();

            $destino_t_4 = new M_Servicio();
            $destino_t_4->grupo = $cate[$posTipo];
            $destino_t_4->localizacion = $txt_localizacion;
            $destino_t_4->tipoServicio = '4 STARS';
            $destino_t_4->acomodacion = 'T';
            $destino_t_4->nombre = 'TRIPLE ROOM';
            $destino_t_4->precio_venta = $T_4;
            $destino_t_4->salida = '';
            $destino_t_4->llegada = '';
            $destino_t_4->min_personas = 1;
            $destino_t_4->max_personas = 3;
            $destino_t_4->save();
            $destino_t_4->codigo = $destino_t_4->id;
            $destino_t_4->save();

            $destino_ss_4 = new M_Servicio();
            $destino_ss_4->grupo = $cate[$posTipo];
            $destino_ss_4->localizacion = $txt_localizacion;
            $destino_ss_4->tipoServicio = '4 STARS';
            $destino_ss_4->acomodacion = 'SS';
            $destino_ss_4->nombre = 'SUPERIOR ROOM';
            $destino_ss_4->precio_venta = $SS_4;
            $destino_ss_4->salida = '';
            $destino_ss_4->llegada = '';
            $destino_ss_4->min_personas = 1;
            $destino_ss_4->max_personas = 1;
            $destino_ss_4->save();
            $destino_ss_4->codigo = $destino_ss_4->id;
            $destino_ss_4->save();

            $destino_sd_4 = new M_Servicio();
            $destino_sd_4->grupo = $cate[$posTipo];
            $destino_sd_4->localizacion = $txt_localizacion;
            $destino_sd_4->tipoServicio = '4 STARS';
            $destino_sd_4->acomodacion = 'SD';
            $destino_sd_4->nombre = 'SUPERIOR DOUBLE ROOM';
            $destino_sd_4->precio_venta = $SD_4;
            $destino_sd_4->salida = '';
            $destino_sd_4->llegada = '';
            $destino_sd_4->min_personas = 1;
            $destino_sd_4->max_personas = 2;
            $destino_sd_4->save();
            $destino_sd_4->codigo = $destino_sd_4->id;
            $destino_sd_4->save();

            $destino_su_4 = new M_Servicio();
            $destino_su_4->grupo = $cate[$posTipo];
            $destino_su_4->localizacion = $txt_localizacion;
            $destino_su_4->tipoServicio = '4 STARS';
            $destino_su_4->acomodacion = 'SU';
            $destino_su_4->nombre = 'SUITE ROOM';
            $destino_su_4->precio_venta = $SD_4;
            $destino_su_4->salida = '';
            $destino_su_4->llegada = '';
            $destino_su_4->min_personas = 1;
            $destino_su_4->max_personas = 2;
            $destino_su_4->save();
            $destino_su_4->codigo = $destino_su_4->id;
            $destino_su_4->save();

            $destino_js_4 = new M_Servicio();
            $destino_js_4->grupo = $cate[$posTipo];
            $destino_js_4->localizacion = $txt_localizacion;
            $destino_js_4->tipoServicio = '4 STARS';
            $destino_js_4->acomodacion = 'JS';
            $destino_js_4->nombre = 'JR. SUITE ROOM';
            $destino_js_4->precio_venta = $JS_4;
            $destino_js_4->salida = '';
            $destino_js_4->llegada = '';
            $destino_js_4->min_personas = 1;
            $destino_js_4->max_personas = 2;
            $destino_js_4->save();
            $destino_js_4->codigo = $destino_js_4->id;
            $destino_js_4->save();

            $destino_s_5 = new M_Servicio();
            $destino_s_5->grupo = $cate[$posTipo];
            $destino_s_5->localizacion = $txt_localizacion;
            $destino_s_5->tipoServicio = '5 STARS';
            $destino_s_5->acomodacion = 'S';
            $destino_s_5->nombre = 'SINGLE ROOM';
            $destino_s_5->precio_venta = $S_5;
            $destino_s_5->salida = '';
            $destino_s_5->llegada = '';
            $destino_s_5->min_personas = 1;
            $destino_s_5->max_personas = 1;
            $destino_s_5->save();
            $destino_s_5->codigo = $destino_s_5->id;
            $destino_s_5->save();

            $destino_d_5 = new M_Servicio();
            $destino_d_5->grupo = $cate[$posTipo];
            $destino_d_5->localizacion = $txt_localizacion;
            $destino_d_5->tipoServicio = '5 STARS';
            $destino_d_5->acomodacion = 'D';
            $destino_d_5->nombre = 'DOUBLE ROOM';
            $destino_d_5->precio_venta = $D_5;
            $destino_d_5->salida = '';
            $destino_d_5->llegada = '';
            $destino_d_5->min_personas = 1;
            $destino_d_5->max_personas = 2;
            $destino_d_5->save();
            $destino_d_5->codigo = $destino_d_5->id;
            $destino_d_5->save();

            $destino_m_5 = new M_Servicio();
            $destino_m_5->grupo = $cate[$posTipo];
            $destino_m_5->localizacion = $txt_localizacion;
            $destino_m_5->tipoServicio = '5 STARS';
            $destino_m_5->acomodacion = 'M';
            $destino_m_5->nombre = 'MATRIMONIAL ROOM';
            $destino_m_5->precio_venta = $M_5;
            $destino_m_5->salida = '';
            $destino_m_5->llegada = '';
            $destino_m_5->min_personas = 1;
            $destino_m_5->max_personas = 2;
            $destino_m_5->save();
            $destino_m_5->codigo = $destino_m_5->id;
            $destino_m_5->save();

            $destino_t_5 = new M_Servicio();
            $destino_t_5->grupo = $cate[$posTipo];
            $destino_t_5->localizacion = $txt_localizacion;
            $destino_t_5->tipoServicio = '5 STARS';
            $destino_t_5->acomodacion = 'T';
            $destino_t_5->nombre = 'TRIPLE ROOM';
            $destino_t_5->precio_venta = $T_5;
            $destino_t_5->salida = '';
            $destino_t_5->llegada = '';
            $destino_t_5->min_personas = 1;
            $destino_t_5->max_personas = 3;
            $destino_t_5->save();
            $destino_t_5->codigo = $destino_t_5->id;
            $destino_t_5->save();

            $destino_ss_5 = new M_Servicio();
            $destino_ss_5->grupo = $cate[$posTipo];
            $destino_ss_5->localizacion = $txt_localizacion;
            $destino_ss_5->tipoServicio = '5 STARS';
            $destino_ss_5->acomodacion = 'SS';
            $destino_ss_5->nombre = 'SUPERIOR ROOM';
            $destino_ss_5->precio_venta = $SS_5;
            $destino_ss_5->salida = '';
            $destino_ss_5->llegada = '';
            $destino_ss_5->min_personas = 1;
            $destino_ss_5->max_personas = 1;
            $destino_ss_5->save();
            $destino_ss_5->codigo = $destino_ss_5->id;
            $destino_ss_5->save();

            $destino_sd_5 = new M_Servicio();
            $destino_sd_5->grupo = $cate[$posTipo];
            $destino_sd_5->localizacion = $txt_localizacion;
            $destino_sd_5->tipoServicio = '5 STARS';
            $destino_sd_5->acomodacion = 'SD';
            $destino_sd_5->nombre = 'SUPERIOR DOUBLE ROOM';
            $destino_sd_5->precio_venta = $SD_5;
            $destino_sd_5->salida = '';
            $destino_sd_5->llegada = '';
            $destino_sd_5->min_personas = 1;
            $destino_sd_5->max_personas = 2;
            $destino_sd_5->save();
            $destino_sd_5->codigo = $destino_sd_5->id;
            $destino_sd_5->save();

            $destino_su_5 = new M_Servicio();
            $destino_su_5->grupo = $cate[$posTipo];
            $destino_su_5->localizacion = $txt_localizacion;
            $destino_su_5->tipoServicio = '5 STARS';
            $destino_su_5->acomodacion = 'SU';
            $destino_su_5->nombre = 'SUITE ROOM';
            $destino_su_5->precio_venta = $SD_5;
            $destino_su_5->salida = '';
            $destino_su_5->llegada = '';
            $destino_su_5->min_personas = 1;
            $destino_su_5->max_personas = 2;
            $destino_su_5->save();
            $destino_su_5->codigo = $destino_su_5->id;
            $destino_su_5->save();

            $destino_js_5 = new M_Servicio();
            $destino_js_5->grupo = $cate[$posTipo];
            $destino_js_5->localizacion = $txt_localizacion;
            $destino_js_5->tipoServicio = '5 STARS';
            $destino_js_5->acomodacion = 'JS';
            $destino_js_5->nombre = 'JR. SUITE ROOM';
            $destino_js_5->precio_venta = $JS_5;
            $destino_js_5->salida = '';
            $destino_js_5->llegada = '';
            $destino_js_5->min_personas = 1;
            $destino_js_5->max_personas = 2;
            $destino_js_5->save();
            $destino_js_5->codigo = $destino_js_5->id;
            $destino_js_5->save();

            $destinations = M_Destino::get();
            $servicios = M_Servicio::get();
            $categorias = M_Category::get();
            return view('admin.database.services', ['servicios' => $servicios, 'categorias' => $categorias, 'destinations' => $destinations]);

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
                $destinations = M_Destino::get();
                $servicios = M_Servicio::get();
                $categorias = M_Category::get();
                return view('admin.database.services', ['servicios' => $servicios, 'categorias' => $categorias, 'destinations' => $destinations]);
            }
//        else{
//            $destinations=M_Destino::get();
//            $servicios=M_Servicio::get();
//            $categorias=M_Category::get();
//            return view('admin.database.services',['servicios'=>$servicios,'categorias'=>$categorias,'destinations'=>$destinations]);
//        }
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
