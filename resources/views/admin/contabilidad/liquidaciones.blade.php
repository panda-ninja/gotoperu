@php
    function fecha_peru($fecha){
    $fecha=explode('-',$fecha);
    return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
    }
@endphp
@extends('layouts.admin.book')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Reservas</li>
            <li>Liquidacion</li>
            <li class="active">Liquidaciones</li>
        </ol>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <table  class="table table-bordered table-striped table-responsive table-hover">
                <thead>
                <tr>
                    <th>DESDE</th>
                    <th>HASTA</th>
                    <th>ENVIADO POR</th>
                    <th>TOTAL</th>
                    <th>SALDO</th>
                    <th>ESTADO</th>
                    <th>OPERACIONES</th>
                </tr>
                </thead>
                <tbody>
                @foreach($liquidaciones->where('estado',1)->sortByDesc('ini') as $liquidacion)
                    @php
                        $total=0;
                        $total_pagado=0;
                        $total_monto=0;
                        $total_pagado_monto=0;
                    @endphp
                    @foreach($cotizaciones as $cotizacion)
                        @foreach($cotizacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizaciones)
                            @foreach($paquete_cotizaciones->itinerario_cotizaciones->where('fecha','>=',$liquidacion->ini)->where('fecha','<=',$liquidacion->fin)->sortBy('fecha') as $itinerario_cotizacion)
                                @foreach($itinerario_cotizacion->itinerario_servicios as $itinerario_servicio)
                                    @foreach($servicios->where('id',$itinerario_servicio->m_servicios_id) as $serv)
                                        @if($serv->clase=='BTG' || $serv->clase=='CAT'||$serv->clase=='KORI'||$serv->clase=='MAPI'||$serv->clase=='OTROS')
                                            @php
                                                $total+=1;
                                                $total_monto+=$itinerario_servicio->precio_proveedor;
                                            @endphp
                                            @if($itinerario_servicio->liquidacion==2)
                                                @php
                                                    $total_pagado+=1;
                                                    $total_pagado_monto+=$itinerario_servicio->precio_proveedor;
                                                @endphp
                                            @endif
                                        @endif
                                    @endforeach
                                    @foreach($servicios_movi->where('id',$itinerario_servicio->m_servicios_id) as $serv)
                                        @if($serv->clase=='BOLETO')
                                            @php
                                                $total+=1;
                                                $total_monto+=$itinerario_servicio->precio_proveedor;
                                            @endphp
                                            @if($itinerario_servicio->liquidacion==2)
                                                @php
                                                    $total_pagado+=1;
                                                    $total_pagado_monto+=$itinerario_servicio->precio_proveedor;
                                                @endphp
                                            @endif
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                    <tr>
                        <td>{{fecha_peru($liquidacion->ini)}}</td>
                        <td>{{fecha_peru($liquidacion->fin)}}</td>
                        <td>
                            @foreach($users->where('id',$liquidacion->user_id) as $user)
                                {{$user->name}} {{$liquidacion->tipo_user}}
                            @endforeach
                        </td>
                        <td>${{$total_monto}}</td>
                        <td>${{$total_monto-$total_pagado_monto}}</td>

                        <td>
                            @if($total==0)
                                @php
                                    $total=1;
                                @endphp
                            @endif
                            @php
                                $pagado_porc=round(($total_pagado/$total)*100,2);
                                $color_porc='progress-bar-danger';
                            @endphp
                            @if(25<$pagado_porc&&$pagado_porc<=50)
                                @php
                                    $color_porc='progress-bar-warning';
                                @endphp
                            @endif
                            @if(50<$pagado_porc&&$pagado_porc<=75)
                                @php
                                    $color_porc='progress-bar-info';
                                @endphp
                            @endif
                            @if(75<$pagado_porc&&$pagado_porc<=100)
                                @php
                                    $color_porc='progress-bar-success';
                                @endphp
                            @endif
                            <div class="progress">
                                <div class="progress-bar {{$color_porc}} progress-bar-striped" role="progressbar" aria-valuenow="{{$pagado_porc}}" aria-valuemin="0" aria-valuemax="100"  style="min-width: 3em; width: {{$pagado_porc}}%">
                                    {{$pagado_porc}}%
                                </div>
                            </div>
                        </td>
                        <td><a href="{{route('contabilidad_ver_liquidacion_path',[$liquidacion->ini,$liquidacion->fin])}}" class="btn btn-primary"><i class="fa fa-eye-slash"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop