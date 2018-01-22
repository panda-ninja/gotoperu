@php
    function fecha_peru($fecha){
        $fecha_temp='';
        $fecha_temp=explode('-',$fecha);
        return $fecha_temp[2].'/'.$fecha_temp[1].'/'.$fecha_temp[0];
    }
@endphp

@extends('layouts.admin.operaciones')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Operaciones</li>
            <li class="active">Lista</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{route('operaciones_lista_path')}}" method="post">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="txt_desde">Desde</label>
                                    <input type="date" class="form-control" id="txt_desde" name="txt_desde" required="required" value="{{$desde}}">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="txt_hasta">Hasta</label>
                                    <input type="date" class="form-control" id="txt_hasta" name="txt_hasta" required="required" value="{{$hasta}}">
                                </div>
                            </div>
                            <div class="col-lg-2 margin-top-20">
                                {{csrf_field()}}
                                <input type="submit" class="btn btn-primary btn-lg" name="Buscar">
                            </div>

                            <div class="col-lg-2 margin-top-20">
                                <a href="#" class="btn btn-success btn-lg">
                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        <div class="panel panel-default table-responsive">
            <!-- Default panel contents -->
            <div class="panel-heading">Lista de operaciones de <span class="bg-primary text-15">{{fecha_peru($desde)}}</span> a <span class="bg-primary text-15">{{fecha_peru($hasta)}}</span></div>
            <!-- Table -->
            <table class="table table-striped table-responsive table-bordered table-hover text-10">
                <thead>
                    <tr class="bg-primary">
                        <td>FECHA</td>
                        <td>N°</td>
                        <td>NOMBRE</td>
                        <td>CTA</td>
                        <td>S/P</td>
                        <td>ID</td>
                        <td>DESTINO</td>
                        <td>HORA</td>
                        <td>TOUR</td>
                        <td>REPRESENT</td>
                        <td>HOTEL</td>
                        <td>MOVILIDAD</td>
                        {{--<td>ENTRANCES</td>--}}
                        <td>FOOD</td>
                        <td>TRAIN</td>
                        <td>FLIGHT</td>
                        <td>OBSERVACIONES</td>
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
                                        {{$cli}}</br>
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
                                                <p class="text-primary">{{$prov_rs}}<br>{{$prov_celular}}</p>
                                            </td>
                                        @else
                                            <td></td>
                                        @endif

                                        @if($serv->grupo=='REPRESENT' && $serv->tipoServicio=='TRANSFER')
                                            <td>
                                                <p>{{$serv->nombre}}</p>
                                                <p class="text-primary">{{$prov_rs}}<br>{{$prov_celular}}</p>
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>HOTEL</td>
                                        @if($serv->grupo=='MOVILID')
                                            <td>
                                                <p>{{$serv->nombre}}</p>
                                                <p class="text-primary">{{$prov_rs}}<br>{{$prov_celular}}</p>
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                        @if($serv->grupo=='FOOD')
                                            <td>
                                                <p>{{$serv->nombre}}</p>
                                                <p class="text-primary">{{$prov_rs}}<br>{{$prov_celular}}</p>
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                        @if($serv->grupo=='TRAINS')
                                            <td>
                                                <p>{{$serv->nombre}}</p>
                                                <p class="text-primary">{{$prov_rs}}<br>{{$prov_celular}}</p>
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                        @if($serv->grupo=='FLIGHTS')
                                            <td>
                                                <p>{{$serv->nombre}}</p>
                                                <p class="text-primary">{{$prov_rs}}<br>{{$prov_celular}}</p>
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                        @if($serv->grupo=='OTHERS')
                                            <td>
                                                <p>{{$serv->nombre}}</p>
                                                <p class="text-primary">{{$prov_rs}}<br>{{$prov_celular}}</p>
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