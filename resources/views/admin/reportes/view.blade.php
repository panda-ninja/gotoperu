@php
    function fecha_peru($fecha){
        $fecha_temp='';
        $fecha_temp=explode('-',$fecha);
        return $fecha_temp[2].'/'.$fecha_temp[1].'/'.$fecha_temp[0];
    }
    function fecha_texto($fecha){
        $fecha_temp='';
        $fecha_temp=explode('-',$fecha);
        $mes='';
        switch ($fecha_temp[1]){
        case '01':
            $mes='Ene';
            break;
        case '02':
            $mes='Feb';
            break;
        case '03':
            $mes='Mar';
            break;
        case '04':
            $mes='Abr';
            break;
        case '05':
            $mes='May';
            break;
        case '06':
            $mes='Jun';
            break;
        case '07':
            $mes='Jul';
            break;
        case '08':
            $mes='Ago';
            break;
        case '09':
            $mes='Sep';
            break;
        case '10':
            $mes='Oct';
            break;
        case '11':
            $mes='Nov';
            break;
        case '12':
            $mes='Dic';
            break;
        }
        return $fecha_temp[2].' de '.$mes.' del '.$fecha_temp[0];
    }

@endphp

@extends('layouts.admin.reportes')
@section('content')
    @php
        $hotel_p_coti_t=0;
        $hotel_p_res_t=0;
        $signo_coti_res='';
        $p_coti_res=0;
        $hotel_p_con_t=0;
        $signo_res_con='';
        $p_res_con=0;

        $tours_p_coti_t=0;
        $tours_p_res_t=0;
        $tours_signo_coti_res='';
        $tours_p_coti_res=0;
        $tours_p_con_t=0;
        $tours_signo_res_con='';
        $tours_p_res_con=0;

        $movilid_p_coti_t=0;
        $movilid_p_res_t=0;
        $movilid_signo_coti_res='';
        $movilid_p_coti_res=0;
        $movilid_p_con_t=0;
        $movilid_signo_res_con='';
        $movilid_p_res_con=0;

        $represent_p_coti_t=0;
        $represent_p_res_t=0;
        $represent_signo_coti_res='';
        $represent_p_coti_res=0;
        $represent_p_con_t=0;
        $represent_signo_res_con='';
        $represent_p_res_con=0;

        $entr_p_coti_t=0;
        $entr_p_res_t=0;
        $entr_signo_coti_res='';
        $entr_p_coti_res=0;
        $entr_p_con_t=0;
        $entr_signo_res_con='';
        $entr_p_res_con=0;

        $food_p_coti_t=0;
        $food_p_res_t=0;
        $food_signo_coti_res='';
        $food_p_coti_res=0;
        $food_p_con_t=0;
        $food_signo_res_con='';
        $food_p_res_con=0;

        $train_p_coti_t=0;
        $train_p_res_t=0;
        $train_signo_coti_res='';
        $train_p_coti_res=0;
        $train_p_con_t=0;
        $train_signo_res_con='';
        $train_p_res_con=0;

        $flight_p_coti_t=0;
        $flight_p_res_t=0;
        $flight_signo_coti_res='';
        $flight_p_coti_res=0;
        $flight_p_con_t=0;
        $flight_signo_res_con='';
        $flight_p_res_con=0;

        $other_p_coti_t=0;
        $other_p_res_t=0;
        $other_signo_coti_res='';
        $other_p_coti_res=0;
        $other_p_con_t=0;
        $other_signo_res_con='';
        $other_p_res_con=0;

        $coti_total=0;
        $res_total=0;
        $con_total=0;

        $hotel_confirm=0;
        $hotel_confirm_c=0;
        $hotel_total=0;
        $tour_confirm=0;
        $tour_confirm_c=0;
        $tour_total=0;
        $movilid_confirm=0;
        $movilid_confirm_c=0;
        $movilid_total=0;
        $represent_confirm=0;
        $represent_confirm_c=0;
        $represent_total=0;
        $entr_confirm=0;
        $entr_confirm_c=0;
        $entr_total=0;
        $food_confirm=0;
        $food_confirm_c=0;
        $food_total=0;
        $train_confirm=0;
        $train_confirm_c=0;
        $train_total=0;
        $flight_confirm=0;
        $flight_confirm_c=0;
        $flight_total=0;
        $other_confirm=0;
        $other_confirm_=0;
        $other_total=0;

    $total_servicios_confirm=0;
    $total_srevicios=0;
    $profit=0;
    @endphp
    @foreach($cotizacion->paquete_cotizaciones->where('estado','2') as $pqt)
        @foreach($pqt->paquete_precios as $paquete_precios)
            @if($paquete_precios->personas_s>0)
                @php
                    $profit+=$paquete_precios->personas_s*$paquete_precios->precio_s;
                @endphp
            @endif
            @if($paquete_precios->personas_d>0)
                @php
                    $profit+=$paquete_precios->personas_d*$paquete_precios->precio_d;
                @endphp
            @endif
            @if($paquete_precios->personas_m>0)
                @php
                    $profit+=$paquete_precios->personas_m*$paquete_precios->precio_m;
                @endphp
            @endif
            @if($paquete_precios->personas_t>0)
                @php
                    $profit+=$paquete_precios->personas_t*$paquete_precios->precio_t;
                @endphp
            @endif
        @endforeach
        @foreach($pqt->itinerario_cotizaciones as $iti)
            @foreach($iti->hotel as $hotel)
                @if($hotel->personas_s>0)
                    @php
                        $hotel_p_coti_t+=$hotel->personas_s*$hotel->precio_s;
                        $hotel_p_res_t+=$hotel->personas_s*$hotel->precio_s_r;
                        $hotel_p_con_t+=$hotel->personas_s*$hotel->precio_s_c;
                    @endphp
                @endif
                @if($hotel->personas_d>0)
                    @php
                        $hotel_p_coti_t+=$hotel->personas_d*$hotel->precio_d;
                        $hotel_p_res_t+=$hotel->personas_d*$hotel->precio_d_r;
                        $hotel_p_con_t+=$hotel->personas_d*$hotel->precio_d_c;
                    @endphp
                @endif
                @if($hotel->personas_m>0)
                    @php
                        $hotel_p_coti_t+=$hotel->personas_m*$hotel->precio_m;
                        $hotel_p_res_t+=$hotel->personas_m*$hotel->precio_m_r;
                        $hotel_p_con_t+=$hotel->personas_m*$hotel->precio_m_c;
                    @endphp
                @endif
                @if($hotel->personas_t>0)
                    @php
                        $hotel_p_coti_t+=$hotel->personas_t*$hotel->precio_t;
                        $hotel_p_res_t+=$hotel->personas_s*$hotel->precio_t_r;
                        $hotel_p_con_t+=$hotel->personas_s*$hotel->precio_t_c;
                    @endphp
                @endif
                @if($hotel->proveedor_id>0 )
                    @php
                        $hotel_confirm++;
                    @endphp
                @endif
                @if($hotel->precio_t_c>0 )
                    @php
                        $hotel_confirm_c++;
                    @endphp
                @endif
                @php
                    $hotel_total++;
                @endphp
            @endforeach

            @foreach($iti->itinerario_servicios as $servicio)
                @if($servicio->servicio->grupo=='TOURS')
                    @if($servicio->proveedor_id)
                        @if($servicio->proveedor_id>0)
                            @php
                                $tour_confirm++;
                            @endphp
                        @endif
                    @endif
                    @if($servicio->precio_grupo==1)
                        @php
                            $tours_p_coti_t+=$servicio->precio;
                            $tours_p_res_t+=$servicio->precio_proveedor;
                            $tours_p_con_t+=$servicio->precio_c;
                        @endphp
                    @else
                        @php
                            $tours_p_coti_t+=$servicio->precio*$cotizacion->nropersonas;
                            $tours_p_res_t+=$servicio->precio_proveedor*$cotizacion->nropersonas;
                            $tours_p_con_t+=$servicio->precio_c*$cotizacion->nropersonas;
                        @endphp
                    @endif
                    @if($servicio->precio_c>0)
                        @php
                            $tour_confirm_c++;
                        @endphp
                    @endif
                    @php
                        $tour_total++;
                    @endphp
                @endif
                @if($servicio->servicio->grupo=='MOVILID')
                    @php
                        $movilid_total++;
                    @endphp
                    @if($servicio->proveedor_id)
                        @if($servicio->proveedor_id>0)
                            @php
                                $movilid_confirm++;
                            @endphp
                        @endif
                    @endif
                    @if($servicio->precio_grupo==1)
                        @php
                            $movilid_p_coti_t+=$servicio->precio;
                            $movilid_p_res_t+=$servicio->precio_proveedor;
                            $movilid_p_con_t+=$servicio->precio_c;
                        @endphp
                    @else
                        @php
                            $movilid_p_coti_t+=$servicio->precio*$cotizacion->nropersonas;
                            $movilid_p_res_t+=$servicio->precio_proveedor*$cotizacion->nropersonas;
                            $movilid_p_con_t+=$servicio->precio_c*$cotizacion->nropersonas;
                        @endphp
                    @endif
                    @if($servicio->precio_c>0)
                        @php
                            $movilid_confirm_c++;
                        @endphp
                    @endif
                @endif
                @if($servicio->servicio->grupo=='REPRESENT')
                    @php
                        $represent_total++;
                    @endphp
                    @if($servicio->proveedor_id)
                        @if($servicio->proveedor_id>0)
                            @php
                                $represent_confirm++;
                            @endphp
                        @endif
                    @endif
                    @if($servicio->precio_c>0)
                        @php
                            $represent_confirm_c++;
                        @endphp
                    @endif
                    @if($servicio->precio_grupo==1)
                        @php
                            $represent_p_coti_t+=$servicio->precio;
                            $represent_p_res_t+=$servicio->precio_proveedor;
                            $represent_p_con_t+=$servicio->precio_c;
                        @endphp
                    @else
                        @php
                            $represent_p_coti_t+=$servicio->precio*$cotizacion->nropersonas;
                            $represent_p_res_t+=$servicio->precio_proveedor*$cotizacion->nropersonas;
                            $represent_p_con_t+=$servicio->precio_c*$cotizacion->nropersonas;
                        @endphp
                    @endif
                @endif
                @if($servicio->servicio->grupo=='ENTRANCES')
                    @php
                        $entr_total++;
                    @endphp
                    @if($servicio->proveedor_id)
                        @if($servicio->proveedor_id>0)
                            @php
                                $entr_confirm++;
                            @endphp
                        @endif
                    @endif
                    @if($servicio->precio_c>0)
                        @php
                            $entr_confirm_c++;
                        @endphp
                    @endif
                    @if($servicio->precio_grupo==1)
                        @php
                            $entr_p_coti_t+=$servicio->precio;
                            $entr_p_res_t+=$servicio->precio_proveedor;
                            $entr_p_con_t+=$servicio->precio_c;
                        @endphp
                    @else
                        @php
                            $entr_p_coti_t+=$servicio->precio*$cotizacion->nropersonas;
                            $entr_p_res_t+=$servicio->precio_proveedor*$cotizacion->nropersonas;
                            $entr_p_con_t+=$servicio->precio_c*$cotizacion->nropersonas;
                        @endphp
                    @endif
                @endif
                @if($servicio->servicio->grupo=='FOOD')
                    @php
                        $food_total++;
                    @endphp
                    @if($servicio->proveedor_id)
                        @if($servicio->proveedor_id>0)
                            @php
                                $food_confirm++;
                            @endphp
                        @endif
                    @endif
                    @if($servicio->precio_c>0)
                        @php
                            $food_confirm_c++;
                        @endphp
                    @endif
                    @if($servicio->precio_grupo==1)
                        @php
                            $food_p_coti_t+=$servicio->precio;
                            $food_p_res_t+=$servicio->precio_proveedor;
                            $food_p_con_t+=$servicio->precio_c;
                        @endphp
                    @else
                        @php
                            $food_p_coti_t+=$servicio->precio*$cotizacion->nropersonas;
                            $food_p_res_t+=$servicio->precio_proveedor*$cotizacion->nropersonas;
                            $food_p_con_t+=$servicio->precio_c*$cotizacion->nropersonas;
                        @endphp
                    @endif
                @endif
                @if($servicio->servicio->grupo=='TRAINS')
                    @php
                        $train_total++;
                    @endphp
                    @if($servicio->proveedor_id)
                        @if($servicio->proveedor_id>0)
                            @php
                                $train_confirm++;
                            @endphp
                        @endif
                    @endif
                    @if($servicio->precio_c>0)
                        @php
                            $train_confirm_c++;
                        @endphp
                    @endif
                    @if($servicio->precio_grupo==1)
                        @php
                            $train_p_coti_t+=$servicio->precio;
                            $train_p_res_t+=$servicio->precio_proveedor;
                            $train_p_con_t+=$servicio->precio_c;
                        @endphp
                    @else
                        @php
                            $train_p_coti_t+=$servicio->precio*$cotizacion->nropersonas;
                            $train_p_res_t+=$servicio->precio_proveedor*$cotizacion->nropersonas;
                            $train_p_con_t+=$servicio->precio_c*$cotizacion->nropersonas;
                        @endphp
                    @endif
                @endif
                @if($servicio->servicio->grupo=='FLIGHTS')
                    @php
                        $flight_total++;
                    @endphp
                    @if($servicio->proveedor_id)
                        @if($servicio->proveedor_id>0)
                            @php
                                $flight_confirm++;
                            @endphp
                        @endif
                    @endif
                    @if($servicio->precio_c>0)
                        @php
                            $flight_confirm_c++;
                        @endphp
                    @endif
                    @if($servicio->precio_grupo==1)
                        @php
                            $flight_p_coti_t+=$servicio->precio;
                            $flight_p_res_t+=$servicio->precio_proveedor;
                            $flight_p_con_t+=$servicio->precio_c;
                        @endphp
                    @else
                        @php
                            $flight_p_coti_t+=$servicio->precio*$cotizacion->nropersonas;
                            $flight_p_res_t+=$servicio->precio_proveedor*$cotizacion->nropersonas;
                            $flight_p_con_t+=$servicio->precio_c*$cotizacion->nropersonas;
                        @endphp
                    @endif
                @endif
                @if($servicio->servicio->grupo=='OTHERS')
                    @php
                        $other_total++;
                    @endphp
                    @if($servicio->proveedor_id)
                        @if($servicio->proveedor_id>0)
                            @php
                                $other_confirm++;
                            @endphp
                        @endif
                    @endif
                    @if($servicio->precio_c>0)
                        @php
                            $other_confirm_c++;
                        @endphp
                    @endif
                    @if($servicio->precio_grupo==1)
                        @php
                            $other_p_coti_t+=$servicio->precio;
                            $other_p_res_t+=$servicio->precio_proveedor;
                            $other_p_con_t+=$servicio->precio_c;
                        @endphp
                    @else
                        @php
                            $other_p_coti_t+=$servicio->precio*$cotizacion->nropersonas;
                            $other_p_res_t+=$servicio->precio_proveedor*$cotizacion->nropersonas;
                            $other_p_con_t+=$servicio->precio_c*$cotizacion->nropersonas;
                        @endphp
                    @endif
                @endif
            @endforeach
        @endforeach
    @endforeach
    {{--calculos para hotel--}}
    @php
        $p_coti_res=($hotel_p_coti_t-$hotel_p_res_t);
    @endphp
    @if($p_coti_res>0)
        @php
            $signo_coti_res='+';
        @endphp
        @elseif($p_coti_res<0)
        @php
            $signo_coti_res='-';
        @endphp
    @endif

    @php
        $p_res_con=($hotel_p_res_t-$hotel_p_con_t);
    @endphp
    @if($p_res_con>0)
        @php
            $signo_res_con='+';
        @endphp
    @elseif($p_res_con<0)
        @php
            $signo_res_con='-';
        @endphp
    @endif

    {{--calculos para tours--}}
    @php
        $tours_p_coti_res=($tours_p_coti_t-$tours_p_res_t);
    @endphp
    @if($tours_p_coti_res>0)
        @php
            $tours_signo_coti_res='+';
        @endphp
    @elseif($tours_p_coti_res<0)
        @php
            $tours_signo_coti_res='-';
        @endphp
    @endif

    @php
        $tours_p_res_con=($tours_p_res_t-$tours_p_con_t);
    @endphp
    @if($tours_p_res_con>0)
        @php
            $tours_p_res_con='+';
        @endphp
    @elseif($tours_p_res_con<0)
        @php
            $tours_p_res_con='-';
        @endphp
    @endif

    {{--calculos para movilid--}}
    @php
        $movilid_p_coti_res=($movilid_p_coti_t-$movilid_p_res_t);
    @endphp
    @if($movilid_p_coti_res>0)
        @php
            $movilid_signo_coti_res='+';
        @endphp
    @elseif($movilid_p_coti_res<0)
        @php
            $movilid_signo_coti_res='-';
        @endphp
    @endif

    @php
        $movilid_p_res_con=($movilid_p_res_t-$movilid_p_con_t);
    @endphp
    @if($movilid_p_res_con>0)
        @php
            $movilid_p_res_con='+';
        @endphp
    @elseif($movilid_p_res_con<0)
        @php
            $movilid_p_res_con='-';
        @endphp
    @endif

    {{--calculos para entr--}}
    @php
        $entr_p_coti_res=($entr_p_coti_t-$entr_p_res_t);
    @endphp
    @if($entr_p_coti_res>0)
        @php
            $entr_signo_coti_res='+';
        @endphp
    @elseif($entr_p_coti_res<0)
        @php
            $entr_signo_coti_res='-';
        @endphp
    @endif

    @php
        $entr_p_res_con=($entr_p_res_t-$entr_p_con_t);
    @endphp
    @if($entr_p_res_con>0)
        @php
            $entr_signo_res_con='+';
        @endphp
    @elseif($entr_p_res_con<0)
        @php
            $entr_signo_res_con='-';
        @endphp
    @endif

    {{--calculos para food--}}
    @php
        $food_p_coti_res=($food_p_coti_t-$food_p_res_t);
    @endphp
    @if($food_p_coti_res>0)
        @php
            $food_signo_coti_res='+';
        @endphp
    @elseif($food_p_coti_res<0)
        @php
            $food_signo_coti_res='-';
        @endphp
    @endif

    @php
        $food_p_res_con=($food_p_res_t-$food_p_con_t);
    @endphp
    @if($food_p_res_con>0)
        @php
            $food_signo_res_con='+';
        @endphp
    @elseif($food_p_res_con<0)
        @php
            $food_signo_res_con='-';
        @endphp
    @endif

    {{--calculos para train--}}
    @php
        $train_p_coti_res=($train_p_coti_t-$train_p_res_t);
    @endphp
    @if($train_p_coti_res>0)
        @php
            $train_signo_coti_res='+';
        @endphp
    @elseif($train_p_coti_res<0)
        @php
            $train_signo_coti_res='-';
        @endphp
    @endif

    @php
        $train_p_res_con=($train_p_res_t-$train_p_con_t);
    @endphp
    @if($train_p_res_con>0)
        @php
            $train_signo_res_con='+';
        @endphp
    @elseif($train_p_res_con<0)
        @php
            $train_signo_res_con='-';
        @endphp
    @endif

    {{--calculos para flight--}}
    @php
        $flight_p_coti_res=($flight_p_coti_t-$flight_p_res_t);
    @endphp
    @if($flight_p_coti_res>0)
        @php
            $flight_signo_coti_res='+';
        @endphp
    @elseif($flight_p_coti_res<0)
        @php
            $flight_signo_coti_res='-';
        @endphp
    @endif

    @php
        $flight_p_res_con=($flight_p_res_t-$flight_p_con_t);
    @endphp
    @if($flight_p_res_con>0)
        @php
            $flight_p_res_con='+';
        @endphp
    @elseif($flight_p_res_con<0)
        @php
            $flight_p_res_con='-';
        @endphp
    @endif

    {{--calculos para other--}}
    @php
        $other_p_coti_res=($other_p_coti_t-$other_p_res_t);
    @endphp
    @if($other_p_coti_res>0)
        @php
            $other_signo_coti_res='+';
        @endphp
    @elseif($other_p_coti_res<0)
        @php
            $other_signo_coti_res='-';
        @endphp
    @endif

    @php
        $other_p_res_con=($other_p_res_t-$other_p_con_t);
    @endphp
    @if($other_p_res_con>0)
        @php
            $other_p_res_con='+';
        @endphp
    @elseif($other_p_res_con<0)
        @php
            $other_p_res_con='-';
        @endphp
    @endif

    @php
    $porc_hotel=0;
    $porc_tour=0;
    $porc_movilid=0;
    $porc_represent=0;
    $porc_entr=0;
    $porc_food=0;
    $porc_train=0;
    $porc_flight=0;
    $porc_other=0;

    $porc_hotel_c=0;
    $porc_tour_c=0;
    $porc_movilid_c=0;
    $porc_represent_c=0;
    $porc_entr_c=0;
    $porc_food_c=0;
    $porc_train_c=0;
    $porc_flight_c=0;
    $porc_other_c=0;
    @endphp
    @if($hotel_total>0)@php$porc_hotel=round(($hotel_confirm/$hotel_total)*100); @endphp @endif
    @if($tour_total>0)@php$porc_tour=round(($tour_confirm/$tour_total)*100); @endphp @endif
    @if($movilid_total>0)@php$porc_movilid=round(($movilid_confirm/$movilid_total)*100); @endphp @endif
    @if($represent_total>0)@php$porc_represent=round(($represent_confirm/$represent_total)*100); @endphp @endif
    @if($entr_total>0)@php$porc_entr=round(($entr_confirm/$entr_total)*100); @endphp @endif
    @if($food_total>0)@php$porc_food=round(($food_confirm/$food_total)*100); @endphp @endif
    @if($train_total>0)@php$porc_train=round(($train_confirm/$train_total)*100); @endphp @endif
    @if($flight_total>0)@php$porc_flight=round(($flight_confirm/$flight_total)*100); @endphp @endif
    @if($other_total>0)@php$porc_other=round(($other_confirm/$other_total)*100); @endphp @endif

    @if($hotel_total>0)@php$porc_hotel_c=round(($hotel_confirm_c/$hotel_total)*100); @endphp @endif
    @if($tour_total>0)@php$porc_tour_c=round(($tour_confirm_c/$tour_total)*100); @endphp @endif
    @if($movilid_total>0)@php$porc_movilid_c=round(($movilid_confirm_c/$movilid_total)*100); @endphp @endif
    @if($represent_total>0)@php$porc_represent_c=round(($represent_confirm_c/$represent_total)*100); @endphp @endif
    @if($entr_total>0)@php$porc_entr_c=round(($entr_confirm_c/$entr_total)*100); @endphp @endif
    @if($food_total>0)@php$porc_food_c=round(($food_confirm_c/$food_total)*100); @endphp @endif
    @if($train_total>0)@php$porc_train_c=round(($train_confirm_c/$train_total)*100); @endphp @endif
    @if($flight_total>0)@php$porc_flight_c=round(($flight_confirm_c/$flight_total)*100); @endphp @endif
    @if($other_total>0)@php$porc_other_c=round(($other_confirm_c/$other_total)*100); @endphp @endif

    @php
        $porc_reserva_total=$porc_hotel+$porc_tour+$porc_movilid+$porc_represent+$porc_entr+$porc_food+$porc_train+$porc_flight+$porc_other;
        $porc_reserva_total=round($porc_reserva_total/9);

        $porc_conta_total=$porc_hotel_c+$porc_tour_c+$porc_movilid_c+$porc_represent_c+$porc_entr_c+$porc_food_c+$porc_train_c+$porc_flight_c+$porc_other;
        $porc_conta_total=round($porc_conta_total/9);
    @endphp
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-1 cabecera-res bg-sombra">%</div>
                <div class="col-lg-2 cabecera-res bg-sombra">SERVICIO</div>
                <div class="col-lg-2 cabecera-res bg-sombra">COTIZACION</div>
                <div class="col-lg-3 cabecera-res bg-sombra">RESERVAS</div>
                <div class="col-lg-3 cabecera-res bg-sombra">CONTABILIDAD</div>
            </div>
            <div class="row">
                <div class="col-lg-1 cabecera-res-lat"><b>{{$porc_hotel}}%</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>HOTELS</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>$</b><b>{{$hotel_p_coti_t}}</b></div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="@if($signo_coti_res=='+')text-success @elseif($signo_coti_res=='-') text-danger @endif">{{$signo_coti_res}}$</b><b class="@if($signo_coti_res=='+')text-success @elseif($signo_coti_res=='-') text-danger @endif">@if($signo_coti_res=='-'){{(-1)*$p_coti_res}}@else{{$p_coti_res}}@endif</b></div>
                        <div class="col-lg-8"><b>$</b><b>{{$hotel_p_res_t}}</b></div>
                    </div>
                </div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="@if($signo_res_con=='+')text-success @elseif($signo_res_con=='-') text-danger @endif">{{$signo_res_con}}$</b><b class="@if($signo_res_con=='+')text-success @elseif($signo_res_con=='-') text-danger @endif">@if($signo_res_con=='-'){{(-1)*$p_res_con}}@else{{$p_res_con}}@endif</b></div>
                        <div class="col-lg-8"><b>$</b><b>{{$hotel_p_con_t}}</b></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 cabecera-res-lat"><b>{{$porc_hotel}}%</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>TOURS</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>$</b><b>{{$tours_p_coti_t}}</b></div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="@if($tours_signo_coti_res=='+')text-success @elseif($tours_signo_coti_res=='-') text-danger @endif">{{$tours_signo_coti_res}}$</b><b class="@if($tours_signo_coti_res=='+')text-success @elseif($tours_signo_coti_res=='-') text-danger @endif">@if($tours_signo_coti_res=='-'){{(-1)*$tours_p_coti_res}}@else{{$tours_p_coti_res}}@endif</b></div>
                        <div class="col-lg-8"><b>$</b><b>{{$tours_p_res_t}}</b></div>
                    </div>
                </div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="@if($tours_signo_res_con=='+')text-success @elseif($tours_signo_res_con=='-') text-danger @endif">{{$tours_signo_res_con}}$</b><b class="@if($tours_signo_res_con=='+')text-success @elseif($tours_signo_res_con=='-') text-danger @endif">@if($tours_signo_res_con=='-'){{(-1)*$tours_p_res_con}}@else{{$tours_p_res_con}}@endif</b></div>
                        <div class="col-lg-8"><b>$</b><b>{{$tours_p_con_t}}</b></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 cabecera-res-lat"><b>{{$porc_movilid}}%</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>MOVILID</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>$</b><b>{{$movilid_p_coti_t}}</b></div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="@if($movilid_signo_coti_res=='+')text-success @elseif($movilid_signo_coti_res=='-') text-danger @endif">{{$movilid_signo_coti_res}}$</b><b class="@if($movilid_signo_coti_res=='+')text-success @elseif($movilid_signo_coti_res=='-') text-danger @endif">@if($movilid_signo_coti_res=='-'){{(-1)*$movilid_p_coti_res}}@else{{$movilid_p_coti_res}}@endif</b></div>
                        <div class="col-lg-8"><b>$</b><b>{{$movilid_p_res_t}}</b></div>
                    </div>
                </div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="@if($movilid_signo_res_con=='+')text-success @elseif($movilid_signo_res_con=='-') text-danger @endif">{{$movilid_signo_res_con}}$</b><b class="@if($movilid_signo_res_con=='+')text-success @elseif($movilid_signo_res_con=='-') text-danger @endif">@if($movilid_signo_res_con=='-'){{(-1)*$movilid_p_res_con}}@else{{$movilid_p_res_con}}@endif</b></div>
                        <div class="col-lg-8"><b>$</b><b>{{$movilid_p_con_t}}</b></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 cabecera-res-lat"><b>{{$porc_represent}}%</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>REPRESENT</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>$</b><b>{{$represent_p_coti_t}}</b></div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="@if($represent_signo_coti_res=='+')text-success @elseif($represent_signo_coti_res=='-') text-danger @endif">{{$represent_signo_coti_res}}$</b><b class="@if($represent_signo_coti_res=='+')text-success @elseif($represent_signo_coti_res=='-') text-danger @endif">@if($represent_signo_coti_res=='-'){{(-1)*$represent_p_coti_res}}@else{{$represent_p_coti_res}}@endif</b></div>
                        <div class="col-lg-8"><b>$</b><b>{{$represent_p_res_t}}</b></div>
                    </div>
                </div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="@if($represent_signo_res_con=='+')text-success @elseif($represent_signo_res_con=='-') text-danger @endif">{{$represent_signo_res_con}}$</b><b class="@if($represent_signo_res_con=='+')text-success @elseif($represent_signo_res_con=='-') text-danger @endif">@if($represent_signo_res_con=='-'){{(-1)*$represent_p_res_con}}@else{{$represent_p_res_con}}@endif</b></div>
                        <div class="col-lg-8"><b>$</b><b>{{$represent_p_con_t}}</b></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 cabecera-res-lat"><b>{{$porc_entr}}%</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>ENTRANCES</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>$</b><b>{{$entr_p_coti_t}}</b></div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="@if($entr_signo_coti_res=='+')text-success @elseif($entr_signo_coti_res=='-') text-danger @endif">{{$entr_signo_coti_res}}$</b><b class="@if($entr_signo_coti_res=='+')text-success @elseif($entr_signo_coti_res=='-') text-danger @endif">@if($entr_signo_coti_res=='-'){{(-1)*$entr_p_coti_res}}@else{{$entr_p_coti_res}}@endif</b></div>
                        <div class="col-lg-8"><b>$</b><b>{{$entr_p_res_t}}</b></div>
                    </div>
                </div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="@if($entr_signo_res_con=='+')text-success @elseif($entr_signo_res_con=='-') text-danger @endif">{{$entr_signo_res_con}}$</b><b class="@if($entr_signo_res_con=='+')text-success @elseif($entr_signo_res_con=='-') text-danger @endif">@if($entr_signo_res_con=='-'){{(-1)*$entr_p_res_con}}@else{{$entr_p_res_con}}@endif</b></div>
                        <div class="col-lg-8"><b>$</b><b>{{$entr_p_con_t}}</b></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 cabecera-res-lat"><b>{{$porc_food}}%</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>FOOD</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>$</b><b>{{$food_p_coti_t}}</b></div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="@if($food_signo_coti_res=='+')text-success @elseif($food_signo_coti_res=='-') text-danger @endif">{{$food_signo_coti_res}}$</b><b class="@if($food_signo_coti_res=='+')text-success @elseif($food_signo_coti_res=='-') text-danger @endif">@if($food_signo_coti_res=='-'){{(-1)*$food_p_coti_res}}@else{{$food_p_coti_res}}@endif</b></div>
                        <div class="col-lg-8"><b>$</b><b>{{$food_p_res_t}}</b></div>
                    </div>
                </div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="@if($food_signo_res_con=='+')text-success @elseif($food_signo_res_con=='-') text-danger @endif">{{$food_signo_res_con}}$</b><b class="@if($food_signo_res_con=='+')text-success @elseif($food_signo_res_con=='-') text-danger @endif">@if($food_signo_res_con=='-'){{(-1)*$food_p_res_con}}@else{{$food_p_res_con}}@endif</b></div>
                        <div class="col-lg-8"><b>$</b><b>{{$food_p_con_t}}</b></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 cabecera-res-lat"><b>{{$porc_train}}%</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>TRAINS</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>$</b><b>{{$train_p_coti_t}}</b></div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="@if($train_signo_coti_res=='+')text-success @elseif($train_signo_coti_res=='-') text-danger @endif">{{$train_signo_coti_res}}$</b><b class="@if($train_signo_coti_res=='+')text-success @elseif($train_signo_coti_res=='-') text-danger @endif">@if($train_signo_coti_res=='-'){{(-1)*$train_p_coti_res}}@else{{$train_p_coti_res}}@endif</b></div>
                        <div class="col-lg-8"><b>$</b><b>{{$train_p_res_t}}</b></div>
                    </div>
                </div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="@if($train_signo_res_con=='+')text-success @elseif($train_signo_res_con=='-') text-danger @endif">{{$train_signo_res_con}}$</b><b class="@if($train_signo_res_con=='+')text-success @elseif($train_signo_res_con=='-') text-danger @endif">@if($train_signo_res_con=='-'){{(-1)*$train_p_res_con}}@else{{$train_p_res_con}}@endif</b></div>
                        <div class="col-lg-8"><b>$</b><b>{{$train_p_con_t}}</b></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 cabecera-res-lat"><b>{{$porc_flight}}%</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>FLIGHTS</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>$</b><b>{{$flight_p_coti_t}}</b></div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="@if($flight_signo_coti_res=='+')text-success @elseif($flight_signo_coti_res=='-') text-danger @endif">{{$flight_signo_coti_res}}$</b><b class="@if($flight_signo_coti_res=='+')text-success @elseif($flight_signo_coti_res=='-') text-danger @endif">@if($flight_signo_coti_res=='-'){{(-1)*$flight_p_coti_res}}@else{{$flight_p_coti_res}}@endif</b></div>
                        <div class="col-lg-8"><b>$</b><b>{{$flight_p_res_t}}</b></div>
                    </div>
                </div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="@if($flight_signo_res_con=='+')text-success @elseif($flight_signo_res_con=='-') text-danger @endif">{{$flight_signo_res_con}}$</b><b class="@if($flight_signo_res_con=='+')text-success @elseif($flight_signo_res_con=='-') text-danger @endif">@if($flight_signo_res_con=='-'){{(-1)*$flight_p_res_con}}@else{{$flight_p_res_con}}@endif</b></div>
                        <div class="col-lg-8"><b>$</b><b>{{$flight_p_con_t}}</b></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 cabecera-res-lat"><b>{{$porc_other}}%</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>OTHERS</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>$</b><b>{{$other_p_coti_t}}</b></div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="@if($other_signo_coti_res=='+')text-success @elseif($other_signo_coti_res=='-') text-danger @endif">{{$other_signo_coti_res}}$</b><b class="@if($other_signo_coti_res=='+')text-success @elseif($other_signo_coti_res=='-') text-danger @endif">@if($other_signo_coti_res=='-'){{(-1)*$other_p_coti_res}}@else{{$other_p_coti_res}}@endif</b></div>
                        <div class="col-lg-8"><b>$</b><b>{{$other_p_res_t}}</b></div>
                    </div>
                </div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="@if($other_signo_res_con=='+')text-success @elseif($other_signo_res_con=='-') text-danger @endif">{{$other_signo_res_con}}$</b><b class="@if($other_signo_res_con=='+')text-success @elseif($other_signo_res_con=='-') text-danger @endif">@if($other_signo_res_con=='-'){{(-1)*$other_p_res_con}}@else{{$other_p_res_con}}@endif</b></div>
                        <div class="col-lg-8"><b>$</b><b>{{$other_p_con_t}}</b></div>
                    </div>
                </div>
            </div>
            <div class="row">
                @php
                $t_r=($p_coti_res+$tours_p_coti_res+$movilid_p_coti_res+$represent_p_coti_res+$entr_p_coti_res+$food_p_coti_res+$train_p_coti_res+$flight_p_coti_res+$other_p_coti_res);
                $t_c=($p_res_con+$tours_p_res_con+$movilid_p_res_con+$represent_p_res_con+$entr_p_res_con+$food_p_res_con+$train_p_res_con+$flight_p_res_con+$other_p_res_con);
                $total_cotizado=($hotel_p_coti_t+$tours_p_coti_t+$movilid_p_coti_t+$represent_p_coti_t+$entr_p_coti_t+$food_p_coti_t+$train_p_coti_t+$flight_p_coti_t+$other_p_coti_t);
                $total_cotizado+=$profit;
                $total_reservado=($hotel_p_res_t+$tours_p_res_t+$movilid_p_res_t+$represent_p_res_t+$entr_p_res_t+$food_p_res_t+$train_p_res_t+$flight_p_res_t+$other_p_res_t);
                $total_contabilizado=($hotel_p_con_t+$tours_p_con_t+$movilid_p_con_t+$represent_p_con_t+$entr_p_con_t+$food_p_con_t+$train_p_con_t+$flight_p_con_t+$other_p_con_t);
                @endphp
                <div class="col-lg-1 cabecera-res-lat-invi"></div>
                <div class="col-lg-2 cabecera-res-lat-invi"></div>
                <div class="col-lg-2 cabecera-res-total"><b>$</b><b>{{$total_cotizado}}</b></div>
                <div class="col-lg-3 cabecera-res-total">
                    <div class="row">
                        <div class="col-lg-6"><b class="@if($t_r>0){{'text-success'}} @elseif($t_r==0){{''}}@else {{'text-danger'}}@endif">@if($t_r>0){{'+'}} @elseif($t_r==0){{''}}@else {{'-'}}@endif$</b><b class="@if($t_r>0){{'text-success'}} @elseif($t_r==0){{''}}@else {{'text-danger'}}@endif">{{$t_r}}</b></div>
                        <div class="col-lg-6"><b>$</b><b>{{$total_reservado}}</b></div>
                    </div>
                </div>
                <div class="col-lg-3 cabecera-res-total">
                    <div class="row">
                        <div class="col-lg-6"><b class="@if($t_c>0){{'text-success'}} @elseif($t_c==0){{''}}@else {{'text-danger'}}@endif">@if($t_c>0){{'+'}} @elseif($t_c==0){{''}}@else {{'-'}}@endif$</b><b class="@if($t_c>0){{'text-success'}} @elseif($t_c==0){{''}}@else {{'text-danger'}}@endif">{{$t_c}}</b></div>
                        <div class="col-lg-6"><b>$</b><b>{{$total_contabilizado}}</b></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 cabecera-res-lat-invi"><b></b></div>
                <div class="col-lg-2 cabecera-res-lat-invi"><b></b></div>
                <div class="col-lg-2 cabecera-res-lat-invi"><b></b><b></b></div>
                <div class="col-lg-3 cabecera-res-total-por bg-verde">
                    <b>{{$porc_reserva_total}}</b><b>%</b>
                </div>
                <div class="col-lg-3 cabecera-res-total-por bg-naranja">
                    <b>{{$porc_conta_total}}</b><b>%</b>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <h2 class=" text-center">
                @foreach($cotizacion->cotizaciones_cliente as $clientes)
                    @if($clientes->estado==1)
                        {{$clientes->cliente->nombres}} {{$clientes->cliente->apellidos}} x {{$cotizacion->nropersonas}}
                    @endif
                @endforeach
            </h2>
            <p class="text-center">{{fecha_texto($cotizacion->fecha)}}</p>
            <div class="divider"></div>
            <div class="row">
                <div class="col-lg-6">VENTAS</div>
                <div class="col-lg-4"><b>$</b><b>{{$total_cotizado}}</b></div>
                <div class="col-lg-4"></div>
            </div>
            <div class="row">
                <div class="col-lg-6">CONTABILIDAD</div>
                <div class="col-lg-4"><b>$</b><b>{{$total_contabilizado}}</b></div>
                <div class="col-lg-2 bg-naranja"><b>{{$porc_conta_total}}</b><b>%</b></div>
            </div>
            <div class="row borde-verde">
                <div class="col-lg-6">PROFIT</div>
                <div class="col-lg-4"><b>$</b><b>{{$total_cotizado-$total_contabilizado}}</b></div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>
@stop