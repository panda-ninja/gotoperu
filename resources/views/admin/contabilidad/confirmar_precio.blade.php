@php
    $arra_iconos['TOURS']='<i class="fa fa-map-o text-info" aria-hidden="true"></i>';
    $arra_iconos['MOVILID']='<i class="fa fa-bus text-warning" aria-hidden="true"></i>';
    $arra_iconos['REPRESENT']='<i class="fa fa-users text-success" aria-hidden="true"></i>';
    $arra_iconos['ENTRANCES']='<i class="fa fa-ticket text-warning" aria-hidden="true"></i>';
    $arra_iconos['FOOD']='<i class="fa fa-cutlery text-danger" aria-hidden="true"></i>';
    $arra_iconos['TRAINS']='<i class="fa fa-train text-info" aria-hidden="true"></i>';
    $arra_iconos['FLIGHTS']='<i class="fa fa-plane text-primary" aria-hidden="true"></i>';
    $arra_iconos['OTHERS']='<i class="fa fa-question text-success" aria-hidden="true"></i>';
    function fecha_letra($fecha){
        $fecha=explode('-',$fecha);
        $mes='';
        switch ($fecha[1]){
            case '01':
                $mes='ENERO';
                break;
            case '02':
                $mes='FEBRERO';
                break;
            case '03':
                $mes='MARZO';
                break;

            case '04':
                $mes='ABRIL';
                break;

            case '05':
                $mes='MAYO';
                break;
            case '06':
                $mes='JUNIO';
                break;

            case '07':
                $mes='JULIO';
                break;

            case '08':
                $mes='AGOSTO';
                break;
            case '09':
                $mes='SEPTIEMBRE';
                break;

            case '10':
                $mes='OCTUBRE';
                break;

            case '11':
                $mes='NOVIEMBRE';
                break;
            case '12':
                $mes='DICIEMBRE';
                break;
        }
        return $mes.' '.$fecha[2].' DEL '.$fecha[0];
    }
@endphp
@extends('layouts.admin.contabilidad')
@section('content')
    <div class="row margin-top-40">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Contabilidad</li>
            <li class="active">Reservas confirmadas</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#detalle">Detalle</a></li>
                        <li><a data-toggle="tab" href="#resumen">Resumen</a></li>
                        <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="detalle" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-12">
                                    @foreach($cotizacion->cotizaciones_cliente as $clientes)
                                        @if($clientes->estado==1)
                                            {{--<h1 class="panel-title pull-left" style="font-size:30px;">Hidalgo <small>hidlgo@gmail.com</small></h1>--}}
                                            <h2 class="panel-title pull-left" style="font-size:30px;">{{$clientes->cliente->nombres}} {{$clientes->cliente->apellidos}} x {{$cotizacion->nropersonas}} {{date_format(date_create($cotizacion->fecha), ' l jS F Y')}}</h2>
                                            <b class="text-warning padding-left-10"> (X{{$cotizacion->nropersonas}})</b>
                                            @for($i=0;$i<$cotizacion->nropersonas;$i++)
                                                <i class="fa fa-male fa-2x"></i>
                                            @endfor
                                        @endif
                                    @endforeach
                                    <i class="fa fa-check hide text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Hidalgo esta activo"></i>
                                    <b class="text-success text-25">@if($cotizacion->categorizado=='C'){{'Con factura'}}@elseif($cotizacion->categorizado=='S'){{'Sin factura'}}@else{{'No esta filtrado'}}@endif</b>
                                    <div class="dropdown pull-right hide">
                                        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Opciones
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a href="#"><i class="fa fa-fw fa-database" aria-hidden="true"></i> Reservar todo</a></li>
                                            <li><a href="#"><i class="fa fa-fw fa-check" aria-hidden="true"></i> Friends</a></li>
                                            <li><a href="#">Work</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="#"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> Add a new aspect</a></li>
                                        </ul>
                                    </div>
                                </div>
                                @php
                                    $nro_servicios_total=0;
                                    $nro_servicios_reservados=0;
                                @endphp
                                @foreach($cotizacion->paquete_cotizaciones as $paquete)
                                    @if($paquete->estado==2)
                                        @foreach($paquete->itinerario_cotizaciones as $itinerario)
                                            @php
                                                $nro_servicios=0;
                                            @endphp
                                            @foreach($itinerario->itinerario_servicios as $servicios)
                                                @if($servicios->proveedor_id)
                                                    @if($servicios->proveedor_id>0)
                                                        @php
                                                            $nro_servicios_reservados++;
                                                        @endphp
                                                    @endif
                                                @endif
                                                @php
                                                    $nro_servicios_total++;
                                                @endphp
                                            @endforeach
                                            @foreach($itinerario->hotel as $hotel)
                                                @if($hotel->proveedor_id)
                                                    @if($hotel->proveedor_id>0)
                                                        @php
                                                            $nro_servicios_reservados++;
                                                        @endphp
                                                    @endif
                                                @endif
                                                @php
                                                    $nro_servicios_total++;
                                                @endphp
                                            @endforeach
                                        @endforeach
                                    @endif
                                @endforeach
                                @php
                                    $porc_avance=round($nro_servicios_reservados/$nro_servicios_total,2);
                                    $porc_avance=$porc_avance*100;
                                    $colo_progres='progress-bar-danger';
                                    if(25<$porc_avance&&$porc_avance<=50)
                                        $colo_progres='progress-bar-warning';

                                    if(50<$porc_avance&&$porc_avance<=75)
                                        $colo_progres='progress-bar-info';

                                    if(50<$porc_avance&&$porc_avance<=100)
                                        $colo_progres='progress-bar-success';

                                @endphp
                                <div class="col-md-12 margin-top-10">
                                    <input type="hidden" id="nro_servicios_reservados" value="{{$nro_servicios_reservados}}">
                                    <input type="hidden" id="nro_servicios_total" value="{{$nro_servicios_total}}">

                                    <div class="progress">
                                        <div id="barra_porc" class="progress-bar {{$colo_progres}} progress-bar-striped active" role="progressbar" aria-valuenow="{{$porc_avance}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$porc_avance}}%;min-width: 2em;">
                                            {{$porc_avance}}%
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 hide">
                        <span class="pull-left pax-nav">
                            <b>Travel date: no se</b>
                        </span>
                                    <span class="pull-right">
                            {{--<a href="#" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-lg fa-at" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Mention"></i></a>--}}
                                        {{--<a href="#" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-lg fa-envelope-o" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Message"></i></a>--}}
                                        <a href="#" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-lg fa-ban" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Ignore"></i></a>
                        </span>
                                </div>
                            </div>
                            <table class="table table-condensed table-bordered margin-top-20 table-hover">
                                <thead>
                                <tr>
                                    <th class="text-18 text-grey-goto text-center">Services</th>
                                    <th class="text-18 text-grey-goto text-center">Calculo</th>
                                    <th class="text-18 text-grey-goto text-center">Cotizado</th>
                                    <th class="text-18 text-grey-goto text-center">Reservado</th>
                                    <th class="text-18 text-grey-goto text-center">Contabilidad</th>
                                    <th class="text-18 text-grey-goto text-center">Pagado</th>
                                    <th class="text-18 text-grey-goto text-center">Por pagar</th>
                                </tr>
                                </thead>
                                <tbody>

                                {{csrf_field()}}
                                @php
                                    $sumaTotal_hotel= [];
                                    $pagadoTotal_hotel= [];
                                @endphp
                                @foreach($cotizacion->paquete_cotizaciones as $paquetes)
                                    @foreach($paquetes->pagos_hotel as $pagos_hotel)
                                        @if($pagos_hotel->estado=='1')
                                            @if(array_key_exists($pagos_hotel->proveedor_id,$pagadoTotal_hotel))
                                                @php
                                                    $pagadoTotal_hotel[$pagos_hotel->proveedor_id]+=$pagos_hotel->a_cuenta;
                                                @endphp
                                            @else
                                                @php
                                                    $pagadoTotal_hotel[$pagos_hotel->proveedor_id]=$pagos_hotel->a_cuenta;
                                                @endphp
                                            @endif
                                        @endif
                                    @endforeach
                                    @if($paquetes->estado==2)
                                        @foreach($paquetes->itinerario_cotizaciones as $itinerario)
                                            <tr>
                                                <td class=" bg-info" colspan="9"><b class="text-primary text-18">Dia {{$itinerario->dias}}: {{fecha_letra($itinerario->fecha)}}</b></td>
                                            </tr>
                                            @foreach($itinerario->itinerario_servicios as $servicios)
                                                <tr>
                                                    <td>
                                                        {!! $arra_iconos[$servicios->servicio->grupo]!!}
                                                        <b>{{ucwords(strtolower($servicios->nombre))}}</b>
                                                    </td>
                                                    @if($servicios->precio_grupo==1)
                                                        <td></td>
                                                        <td class="text-right"><b class="text-18">
                                                                {{$servicios->precio}}
                                                                <sup><small>$usd</small></sup></b></td>
                                                    @else
                                                        <td class="text-right col-sm-2"><b class="text-18">
                                                                {{$cotizacion->nropersonas}} X  {{$servicios->precio}}
                                                        </td>
                                                        <td class="text-right"><b class="text-18">
                                                                {{$cotizacion->nropersonas * $servicios->precio}}
                                                                <sup><small>$usd</small></sup></b></td>
                                                    @endif
                                                    <td class="text-right"><b class="text-18">{{$servicios->precio_proveedor}}<sup><small>$usd</small></sup></b></td>
                                                    <td class="col-lg-2">
                                                        @if($servicios->precio_c==0 OR $servicios->precio_c=='')
                                                            @php $precio_c =  $servicios->precio_proveedor; @endphp
                                                        @else
                                                            @php $precio_c =  $servicios->precio_c; @endphp
                                                        @endif
                                                        <div class="input-group">
                                                            <input type="text" class="form-control input-sm text-right text-18 text-green-goto font-weight-bold" id="p_conta_{{$servicios->id}}" value="{{$precio_c}}">
                                                            <span class="input-group-addon">$</span>
                                                        </div>
                                                    </td>
                                                    @php
                                                        $pagos_suma=0;
                                                    @endphp
                                                    @foreach($servicios->pagos as $pagos)
                                                        @if($pagos->estado=='1')
                                                            @php
                                                                $pagos_suma+=$pagos->a_cuenta;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <td class="text-center">
                                                        {{--<b>{{$pagos_suma}}</b>--}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{--                                                <b>{{$precio_c-$pagos_suma}}</b>--}}
                                                    </td>
                                                    <td class="text-center">
                                                        @if($servicios->precio_proveedor == 0)
                                                            <button class="btn btn-unset btn-sm"><i class="fa fa-clock-o text-18"></i></button>
                                                        @elseif($precio_c==$pagos_suma)
                                                            <button class="btn btn-success btn-sm"><i class="fa fa-check text-18"></i></button>
                                                        @elseif($servicios->precio_c > 0)
                                                            <button class="btn btn-warning display-block btn-sm hide" onclick="savePrice($('#p_conta_{{$servicios->id}}').val(),{{$servicios->id}})" id="btn_s_{{$servicios->id}}">Save</button>
                                                            <a href="{{route('pagar_servicios_conta_path', [$cotizacion->id, $servicios->id])}}" class="btn btn-primary display-block btn-sm" id="btn_p_{{$servicios->id}}">Pagar</a>
                                                            <i class="fa fa-spinner fa-pulse text-18 fa-fw hide" id="p_load_{{$servicios->id}}"></i>
                                                            <span class="sr-only">Loading...</span>
                                                        @else
                                                            <button class="btn btn-warning display-block btn-sm" onclick="savePrice($('#p_conta_{{$servicios->id}}').val(),{{$servicios->id}})" id="btn_s_{{$servicios->id}}">Save</button>
                                                            <a href="{{route('pagar_servicios_conta_path', [$cotizacion->id, $servicios->id])}}" class="btn btn-primary display-block btn-sm hide" id="btn_p_{{$servicios->id}}">Pagar</a>
                                                            <i class="fa fa-spinner fa-pulse text-18 fa-fw hide" id="p_load_{{$servicios->id}}"></i>
                                                            <span class="sr-only">Loading...</span>
                                                        @endif

                                                    </td>
                                                </tr>
                                            @endforeach
                                            @php
                                                $precio_s_c1=0;
                                                $precio_d_c1=0;
                                                $precio_m_c1=0;
                                                $precio_t_c1=0;
                                            @endphp
                                            @foreach($itinerario->hotel as $hotel)
                                                @if($hotel->proveedor_id>0 OR $hotel->proveedor_id!='')
                                                    @if($hotel->personas_s>0)
                                                        @if($hotel->precio_s_c>0 OR $hotel->precio_s_c!='')
                                                            @php $precio_s_c1=  $hotel->precio_s_c; @endphp
                                                        @else
                                                            @php $precio_s_c1 =  $hotel->precio_s_r; @endphp
                                                        @endif
                                                    @endif
                                                    @if($hotel->personas_d>0)
                                                        @if($hotel->precio_d_c>0 OR $hotel->precio_d_c!='')
                                                            @php $precio_d_c1=  $hotel->precio_d_c; @endphp
                                                        @else
                                                            @php $precio_d_c1 =  $hotel->precio_d_r; @endphp
                                                        @endif
                                                    @endif
                                                    @if($hotel->personas_m>0)
                                                        @if($hotel->precio_m_c>0 OR $hotel->precio_m_c!='')
                                                            @php $precio_m_c1=  $hotel->precio_m_c; @endphp
                                                        @else
                                                            @php $precio_m_c1 =  $hotel->precio_m_r; @endphp
                                                        @endif
                                                    @endif
                                                    @if($hotel->personas_t>0)
                                                        @if($hotel->precio_t_c>0 OR $hotel->precio_t_c!='')
                                                            @php $precio_t_c1=  $hotel->precio_t_c; @endphp
                                                        @else
                                                            @php $precio_t_c1 =  $hotel->precio_t_r; @endphp
                                                        @endif
                                                    @endif
                                                    @php
                                                        $total_ho=$precio_s_c1+$precio_d_c1+$precio_m_c1+$precio_t_c1;
                                                    @endphp
                                                    @if(array_key_exists($hotel->proveedor_id,$sumaTotal_hotel))
                                                        @php
                                                            $sumaTotal_hotel[$hotel->proveedor_id]+=$total_ho;
                                                        @endphp
                                                    @else
                                                        @php
                                                            $sumaTotal_hotel[$hotel->proveedor_id]=$total_ho;
                                                        @endphp
                                                    @endif
                                                    {{--<p>{{$hotel->proveedor_id}}-{{$precio_s_c1}}+{{$precio_d_c1}}+{{$precio_m_c1}}+{{$precio_t_c1}}->{{$sumaTotal_hotel[$hotel->proveedor_id]}}</p>--}}
                                                @endif
                                            @endforeach
                                            @foreach($itinerario->hotel as $hotel)
                                                <tr>
                                                    <td>
                                                        <b>
                                                            @if($hotel->personas_s>0)
                                                                <p>{{$hotel->personas_s}} <i class="fa fa-bed fa-2x" aria-hidden="true"></i></p>
                                                            @endif
                                                            @if($hotel->personas_d>0)
                                                                <p>{{$hotel->personas_d}} <i class="fa fa-bed fa-2x" aria-hidden="true"></i> <i class="fa fa-bed fa-2x" aria-hidden="true"></i></p>
                                                            @endif
                                                            @if($hotel->personas_m>0)
                                                                <p>{{$hotel->personas_m}} <i class="fa fa-bed fa-2x" aria-hidden="true"></i> <i class="fa fa-bed fa-2x" aria-hidden="true"></i></p>
                                                            @endif
                                                            @if($hotel->personas_t>0)
                                                                <p>{{$hotel->personas_t}} <i class="fa fa-bed fa-2x" aria-hidden="true"></i> <i class="fa fa-bed fa-2x" aria-hidden="true"></i> <i class="fa fa-bed fa-2x" aria-hidden="true"></i></p>
                                                            @endif
                                                        </b>
                                                    </td>
                                                    <td class="text-right"><b class="text-18">
                                                            @if($hotel->personas_s>0)
                                                                <p>{{$hotel->personas_s}} x {{$hotel->precio_s}}</p>
                                                            @endif
                                                            @if($hotel->personas_d>0)
                                                                <p> {{$hotel->personas_d}} x {{$hotel->precio_d}}</p>
                                                            @endif
                                                            @if($hotel->personas_m>0)
                                                                <p>{{$hotel->personas_m}} x {{$hotel->precio_m}}</p>
                                                            @endif
                                                            @if($hotel->personas_t>0)
                                                                <p>{{$hotel->personas_t}} x {{$hotel->precio_t}}</p>
                                                            @endif
                                                        </b>
                                                    </td>
                                                    <td class="text-right"><b class="text-18">
                                                            @if($hotel->personas_s>0)
                                                                <p>{{$hotel->personas_s*$hotel->precio_s}}<sup><small>$usd</small></sup></p>
                                                            @endif
                                                            @if($hotel->personas_d>0)
                                                                <p>{{$hotel->personas_d*$hotel->precio_d}}<sup><small>$usd</small></sup></p>
                                                            @endif
                                                            @if($hotel->personas_m>0)
                                                                <p>{{$hotel->personas_m*$hotel->precio_m}}<sup><small>$usd</small></sup></p>
                                                            @endif
                                                            @if($hotel->personas_t>0)
                                                                <p>{{$hotel->personas_t*$hotel->precio_t}}<sup><small>$usd</small></sup></p>
                                                            @endif
                                                        </b>
                                                    </td>

                                                    <td class="text-right">
                                                        <b class="text-18">
                                                            @if($hotel->personas_s>0)
                                                                <p>{{$hotel->personas_s*$hotel->precio_s_r}}<sup><small>$usd</small></sup></p>
                                                            @endif
                                                            @if($hotel->personas_d>0)
                                                                <p>{{$hotel->personas_d*$hotel->precio_d_r}}<sup><small>$usd</small></sup></p>
                                                            @endif
                                                            @if($hotel->personas_m>0)
                                                                <p>{{$hotel->personas_m*$hotel->precio_m_r}}<sup><small>$usd</small></sup></p>
                                                            @endif
                                                            @if($hotel->personas_t>0)
                                                                <p>{{$hotel->personas_t*$hotel->precio_t_r}}<sup><small>$usd</small></sup></p>
                                                            @endif

                                                        </b></td>
                                                    <td>
                                                        @if($hotel->precio_s_c>0 OR $hotel->precio_s_c!='')
                                                            @php $precio_s_c=  $hotel->precio_s_c; @endphp
                                                        @else
                                                            @php $precio_s_c =  $hotel->precio_s_r; @endphp
                                                        @endif

                                                        @if($hotel->precio_d_c>0 OR $hotel->precio_d_c!='')
                                                            @php $precio_d_c=  $hotel->precio_d_c; @endphp
                                                        @else
                                                            @php $precio_d_c =  $hotel->precio_d_r; @endphp
                                                        @endif

                                                        @if($hotel->precio_m_c>0 OR $hotel->precio_m_c!='')
                                                            @php $precio_m_c=  $hotel->precio_m_c; @endphp
                                                        @else
                                                            @php $precio_m_c =  $hotel->precio_m_r; @endphp
                                                        @endif

                                                        @if($hotel->precio_t_c>0 OR $hotel->precio_t_c!='')
                                                            @php $precio_t_c=  $hotel->precio_t_c; @endphp
                                                        @else
                                                            @php $precio_t_c =  $hotel->precio_t_r; @endphp
                                                        @endif
                                                        @php $s=0;$d=0;$m=0;$t=0; @endphp

                                                        @if($hotel->personas_s>0)
                                                            <div class="input-group">
                                                                <input type="text" class="form-control input-sm text-right text-18 text-green-goto font-weight-bold" id="p_conta_h_s_{{$hotel->id}}" value="{{$precio_s_c}}">
                                                                <span class="input-group-addon">$</span>
                                                            </div>
                                                            @php $s=$hotel->personas_s; @endphp
                                                        @endif
                                                        @if($hotel->personas_d>0)
                                                            <div class="input-group">
                                                                <input type="text" class="form-control input-sm text-right text-18 text-green-goto font-weight-bold" id="p_conta_h_d_{{$hotel->id}}" value="{{$precio_d_c}}">
                                                                <span class="input-group-addon">$</span>
                                                            </div>
                                                            @php $d=$hotel->personas_d; @endphp
                                                        @endif
                                                        @if($hotel->personas_m>0)
                                                            <div class="input-group">
                                                                <input type="text" class="form-control input-sm text-right text-18 text-green-goto font-weight-bold" id="p_conta_h_m_{{$hotel->id}}" value="{{$precio_m_c}}">
                                                                <span class="input-group-addon">$</span>
                                                            </div>
                                                            @php $m=$hotel->personas_m; @endphp
                                                        @endif
                                                        @if($hotel->personas_t>0)
                                                            <div class="input-group">
                                                                <input type="text" class="form-control input-sm text-right text-18 text-green-goto font-weight-bold" id="p_conta_h_t_{{$hotel->id}}" value="{{$precio_t_c}}">
                                                                <span class="input-group-addon">$</span>
                                                            </div>
                                                            @php $t=$hotel->personas_t; @endphp
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        {{--@if(array_key_exists($hotel->proveedor_id,$pagadoTotal_hotel))--}}
                                                        {{--<b>{{$pagadoTotal_hotel[$hotel->proveedor_id]}}</b>--}}
                                                        {{--@else--}}
                                                        {{--<b>0</b>--}}
                                                        {{--@endif--}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{--@if(array_key_exists($hotel->proveedor_id,$sumaTotal_hotel))--}}
                                                        {{--@if(array_key_exists($hotel->proveedor_id,$pagadoTotal_hotel))--}}
                                                        {{--<b>{{$sumaTotal_hotel[$hotel->proveedor_id]-$pagadoTotal_hotel[$hotel->proveedor_id]}}</b>--}}
                                                        {{--@else--}}
                                                        {{--<b>{{$sumaTotal_hotel[$hotel->proveedor_id]}}</b>--}}
                                                        {{--@endif--}}
                                                        {{--@else--}}
                                                        {{--<b>0</b>--}}
                                                        {{--@endif--}}
                                                    </td>
                                                    <td class="text-center">
                                                        @if($hotel->precio_s_c > 0 || $hotel->precio_d_c > 0 || $hotel->precio_m_c > 0 || $hotel->precio_t_c > 0)
                                                            <button class="btn btn-warning display-block btn-sm hide" onclick="savePrice_h({{$s}},{{$d}},{{$m}},{{$t}},{{$hotel->id}})" id="btn_s_h_{{$hotel->id}}">Save</button>
                                                            <a href="{{route('pagar_servicios_conta_hotel_path', [$cotizacion->id, $hotel->id,$paquetes->id,$hotel->proveedor_id])}}" class="btn btn-primary display-block btn-sm" id="btn_p_h{{$hotel->id}}">Pagar</a>
                                                            <i class="fa fa-spinner fa-pulse text-18 fa-fw hide" id="p_load_h{{$hotel->id}}"></i>
                                                            <span class="sr-only">Loading...</span>
                                                        @else
                                                            <button class="btn btn-warning display-block btn-sm" onclick="savePrice_h({{$s}},{{$d}},{{$m}},{{$t}},{{$hotel->id}})" id="btn_s_h{{$hotel->id}}">Save</button>
                                                            <a href="{{route('pagar_servicios_conta_hotel_path', [$cotizacion->id, $hotel->id,$paquetes->id,$hotel->proveedor_id])}}" class="btn btn-primary display-block btn-sm hide" id="btn_p_h{{$hotel->id}}">Pagar</a>
                                                            <i class="fa fa-spinner fa-pulse text-18 fa-fw hide" id="p_load_h{{$hotel->id}}"></i>
                                                            <span class="sr-only">Loading...</span>
                                                        @endif

                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @endif
                                @endforeach


                                </tbody>
                            </table>
                            <table class="table table-bordered hide">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th class="col-lg-2">Services</th>
                                    <th class="col-lg-1">Quote</th>
                                    <th class="col-lg-1">Book Price</th>
                                    <th class="col-lg-1">Cont. Price</th>
                                    <th class="col-lg-1">Verification Code</th>
                                    <th class="col-lg-1">Provider</th>
                                    <th class="col-lg-1">Fecha Venc.</th>
                                    <th class="col-lg-1">Estado</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sumatotal_v=0;
                                    $sumatotal_v_r=0;
                                    $sumatotal_v_c=0;
                                @endphp

                                </tbody>
                                <tbody>
                                <tr>
                                    <td colspan="2"><b>Total</b></td>
                                    <td class="text-right text-18 text-warning"><b>{{$sumatotal_v}} $</b></td>
                                    <td class="text-right text-18 text-info"><b>{{$sumatotal_v_r}} $</b></td>
                                    <td class="text-right text-18 text-warning"><b>{{$sumatotal_v_c}} $</b></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="resumen" class="tab-pane fade">
                            <table class="table table-bordered tb table-striped table-responsive table-hover">
                                <thead>
                                <tr>
                                    <th>GRUPO</th>
                                    <th>PROVEEDOR</th>
                                    <th>NOMBRE COMERCIAL</th>
                                    <th>FECHA DE SERVICIO</th>
                                    <th>CATEGORIA</th>
                                    <th>FECHA PROGRAMADA</th>
                                    <th>TOTAL</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ItinerarioServiciosAcumPagos->sortBy('grupo') as $ItinerarioServiciosAcumPago)
                                    <tr>
                                        <td>
                                            <span class="text-11">
                                            @if($ItinerarioServiciosAcumPago->grupo!='')
                                            {!! $arra_iconos[$ItinerarioServiciosAcumPago->grupo]!!}
                                            @endif
                                            {{$ItinerarioServiciosAcumPago->grupo}}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-11">
                                                @foreach($proveedores->where('id',$ItinerarioServiciosAcumPago->proveedor_id) as $proveedor)
                                                    {{$proveedor->r_nombres}}
                                                @endforeach
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-11">
                                            @foreach($proveedores->where('id',$ItinerarioServiciosAcumPago->proveedor_id) as $proveedor)
                                                {{$proveedor->razon_social}}
                                            @endforeach
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-11">
                                                {{$ItinerarioServiciosAcumPago->fecha_servicio}}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-11">
                                            @if($cotizacion->categorizado=='C')
                                                {{'Con factura'}}
                                            @elseif($cotizacion->categorizado=='S')
                                                {{'Sin factura'}}
                                            @endif
                                            </span>
                                        </td>
                                        <td>
                                            <input type="date" name="fecha_a_pagar" id="fecha_a_pagar" value="{{$ItinerarioServiciosAcumPago->fecha_a_pagar}}">
                                        </td>
                                        <td>{{$ItinerarioServiciosAcumPago->a_cuenta}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div id="menu2" class="tab-pane fade">
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <script>
                function savePrice(precio, id){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('[name="_token"]').val()
                        }
                    });

                    $("#btn_s_"+id).attr("disabled", true);


                    if (precio.length == 0 ){
                        $('#p_conta_'+id).css("border-bottom", "2px solid #FF0000");
                        var sendPrice = "false";
                    }else{
                        sendPrice = "true"
                    }

                    if(sendPrice == "true"){
                        var datos = {
                            "txt_precio" : precio,
                            "txt_id" : id
                        };
                        $.ajax({
                            data:  datos,
                            url:   "{{route('update_price_conta_path')}}",
                            type:  'post',

                            beforeSend: function () {
                                $('#btn_s_'+id).addClass('hide');
                                $('#p_load_'+id).removeClass('hide');

                            },
                            success:  function (response) {
                                // $('#d_form')[0].reset();
                                $('#p_load_'+id).addClass('hide');
                                $('#btn_s_'+id).addClass('hide');
                                $("#btn_p_"+id).removeClass("hide");
                            }
                        });
                    } else{
                        $("#btn_s_"+id).removeAttr("disabled");
                    }
                }
                function savePrice_h(s,d,m,t,id){
                    console.log('enviando pagos hotel');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('[name="_token"]').val()
                        }
                    });

                    $("#btn_s_h"+id).attr("disabled", true);

                    var p_s=0;
                    var p_d=0;
                    var p_m=0;
                    var p_t=0;
                    var i=1;
                    if(s>0) {
                        p_s=$("#p_conta_h_s_"+id).val()
                        if (p_s.length == 0) {
                            $('#p_conta_h_s_' + id).css("border-bottom", "2px solid #FF0000");
                            var sendPrice_s = "false";
                            i=i*1;
                            return false;
                        } else {
                            sendPrice_s = "true";
                            i=i*0;
                        }
                    }
                    if(d>0) {
                        p_d=$("#p_conta_h_d_"+id).val();
                        if (p_d.length == 0) {
                            $('#p_conta_h_d_' + id).css("border-bottom", "2px solid #FF0000");
                            var sendPrice_d = "false";
                            i=i*1;
                            return false;
                        } else {
                            sendPrice_d = "true";
                            i=i*0;
                        }
                    }
                    if(m>0) {
                        p_m=$("#p_conta_h_m_"+id).val();
                        if (p_m.length == 0) {
                            $('#p_conta_h_m_' + id).css("border-bottom", "2px solid #FF0000");
                            var sendPrice_m = "false";
                            i=i*1;
                            return false;
                        } else {
                            sendPrice_m = "true";
                            i=i*0;
                        }
                    }
                    if(t>0) {
                        p_t=$("#p_conta_h_t_"+id).val();
                        if (p_t.length == 0) {
                            $('#p_conta_h_t_' + id).css("border-bottom", "2px solid #FF0000");
                            var sendPrice_t = "false";
                            i=i*1;
                            return false;
                        } else {
                            sendPrice_t = "true";
                            i=i*0;
                        }
                    }

//                    if(i>0){
                        var datos = {
                            "txt_precio_s" : p_s,
                            "txt_precio_d" : p_d,
                            "txt_precio_m" : p_m,
                            "txt_precio_t" : p_t,
                            "txt_id" : id
                        };
                        $.ajax({
                            data:  datos,
                            url:   "{{route('update_price_conta_hotel_path')}}",
                            type:  'post',

                            beforeSend: function () {
                                $('#btn_s_h'+id).addClass('hide');
                                $('#p_load_h'+id).removeClass('hide');

                            },
                            success:  function (response) {
                                // $('#d_form')[0].reset();
                                $('#p_load_h'+id).addClass('hide');
                                $('#btn_s_h'+id).addClass('hide');
                                $("#btn_p_h"+id).removeClass("hide");
                            }
                        });
//                    } else{
//                        $("#btn_s_h"+id).removeAttr("disabled");
//                    }
                }

            </script>
@stop