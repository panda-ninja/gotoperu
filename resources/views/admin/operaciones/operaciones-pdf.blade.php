@extends('layouts.quotes_pdf')
@php
    function fecha_peru($fecha){
        $fecha_temp=explode('-',$fecha);
        return $fecha_temp[2].'/'.$fecha_temp[1].'/'.$fecha_temp[0];
    }
@endphp
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default table-responsive">
                <!-- Default panel contents -->
                <div class="panel-heading">

                    Lista de operaciones de <span class="bg-primary text-15">{{fecha_peru($desde)}}</span> a <span class="bg-primary text-15">{{fecha_peru($hasta)}}</span>

                </div>
                <!-- Table -->
                <table>
                    <thead>
                    <tr class="caption">
                        <th>FECHA</th>
                        <th>N°</th>
                        <th>NOMBRE</th>
                        <th>CTA</th>
                        <th>S/P</th>
                        <th>ID</th>
                        <th>DESTINO</th>
                        <th>HORA</th>
                        <th>TOUR</th>
                        <th>REPRESENT</th>
                        <th>HOTEL</th>
                        <th>MOVILIDAD</th>
                        {{--<td>ENTRANCES</td>--}}
                        <th>FOOD</th>
                        <th>TRAIN</th>
                        <th>FLIGHT</th>
                        <th>OBSERVACIONES</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cotizaciones->where('confirmado_r','ok') as $cotizacion)
                        @php
                            $clientes_=array();
                        @endphp
                        @foreach($cotizacion->cotizaciones_cliente as $cotizacion_cliente)
                            @foreach($clientes2->where('id',$cotizacion_cliente->clientes_id) as $cliente)
                                @php
                                    $clientes_[]=$cliente->nombres." ".$cliente->apellidos;
                                @endphp
                            @endforeach
                        @endforeach
                        @foreach($cotizacion->paquete_cotizaciones->where('estado','2') as $pqts)
                            @foreach($pqts->itinerario_cotizaciones->sortby('fecha') as $itinerario)
                                @foreach($itinerario->itinerario_servicios->sortby('hora_llegada') as $servicio)
                                    <tr>
                                        <td>{{fecha_peru($itinerario->fecha)}}</td>
                                        <td>{{$cotizacion->nropersonas}}</td>
                                        <td>
                                            @foreach($clientes_ as $cli)
                                            <p>{{$cli}}</p>
                                            @endforeach
                                        </td>
                                        <td>{{$cotizacion->web}}</td>
                                        <td>S/P</td>
                                        <td>ID</td>
                                        @php
                                            $serv_txt='';
                                            $valor='';
                                        @endphp
                                        @foreach($m_servicios->where('id',$servicio->m_servicios_id) as $serv)
                                            @php
                                                $serv_txt=$serv->localizacion;
                                            @endphp
                                            <td>{{$serv_txt}}</td>
                                            <td>{{$servicio->hora_llegada}}</td>
                                            @php
                                                $prov_rs='';
                                                $prov_celular='';
                                            @endphp
                                            @foreach($proveedores->where('id',$servicio->proveedor_id) as $prov)
                                                @php
                                                    $prov_rs=$prov->razon_social;
                                                    $prov_celular=$prov->celular;
                                                @endphp
                                            @endforeach
                                            @if($serv->grupo=='TOURS')
                                                <td>
                                                    <p>{{$serv->nombre}}</p>
                                                    <p class="table-proveedor">{{$prov_rs}}<br>{{$prov_celular}}</p>
                                                </td>
                                            @else
                                                <td></td>
                                            @endif

                                            @if($serv->grupo=='REPRESENT' && $serv->tipoServicio=='TRANSFER')
                                                <td>
                                                    <p>{{$serv->nombre}}</p>
                                                    <p class="table-proveedor">{{$prov_rs}}<br>{{$prov_celular}}</p>
                                                </td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td>HOTEL</td>
                                            @if($serv->grupo=='MOVILID')
                                                <td>
                                                    <p>{{$serv->nombre}}</p>
                                                    <p class="table-proveedor">{{$prov_rs}}<br>{{$prov_celular}}</p>
                                                </td>
                                            @else
                                                <td></td>
                                            @endif
                                            @if($serv->grupo=='FOOD')
                                                <td>
                                                    <p>{{$serv->nombre}}</p>
                                                    <p class="table-proveedor">{{$prov_rs}}<br>{{$prov_celular}}</p>
                                                </td>
                                            @else
                                                <td></td>
                                            @endif
                                            @if($serv->grupo=='TRAINS')
                                                <td>
                                                    <p>{{$serv->nombre}}</p>
                                                    <p class="table-proveedor">{{$prov_rs}}<br>{{$prov_celular}}</p>
                                                </td>
                                            @else
                                                <td></td>
                                            @endif
                                            @if($serv->grupo=='FLIGHTS')
                                                <td>
                                                    <p>{{$serv->nombre}}</p>
                                                    <p class="table-proveedor">{{$prov_rs}}<br>{{$prov_celular}}</p>
                                                </td>
                                            @else
                                                <td></td>
                                            @endif
                                            @if($serv->grupo=='OTHERS')
                                                <td>
                                                    <p>{{$serv->nombre}}</p>
                                                    <p class="table-proveedor">{{$prov_rs}}<br>{{$prov_celular}}</p>
                                                </td>
                                            @endif
                                            <td>OBSERVACIONES</td>

                                        @endforeach
                                    </tr>
                                @endforeach

                            @endforeach
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop