@extends('layouts.admin.book')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white m-0">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item">Reservas</li>
            <li class="breadcrumb-item active">New</li>
        </ol>
    </nav>
    <hr>
    <div class="row">
        <div class="col">
            @php
                $estrellas=2;
            @endphp
            @if($cotizacion->star_2=='2')
                @php
                    $estrellas=2;
                @endphp
            @elseif($cotizacion->star_3=='3')
                @php
                    $estrellas=3;
                @endphp
            @elseif($cotizacion->star_4=='4')
                @php
                    $estrellas=4;
                @endphp
            @elseif($cotizacion->star_5=='5')
                @php
                    $estrellas=5;
                @endphp
            @endif
            @foreach($cotizacion->cotizaciones_cliente as $clientes)
                @if($clientes->estado==1)
                    {{--<h1 class="panel-title pull-left" style="font-size:30px;">Hidalgo <small>hidlgo@gmail.com</small></h1>--}}
                    <h2 class="panel-title float-left" style="font-size:30px;">{{$clientes->cliente->nombres}} {{$clientes->cliente->apellidos}} x {{$cotizacion->nropersonas}} {{date_format(date_create($cotizacion->fecha), ' l jS F Y')}}</h2>
                    <b class="text-warning"> (X{{$cotizacion->nropersonas}})</b>
                    @for($i=0;$i<$cotizacion->nropersonas;$i++)
                        <i class="fa fa-male fa-2x"></i>
                    @endfor
                @endif
            @endforeach
            <b class="text-success text-25">@if($cotizacion->categorizado=='C'){{'Con factura'}}@elseif($cotizacion->categorizado=='S'){{'Sin factura'}}@else{{'No esta filtrado'}}@endif</b>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="nav-item active">
                            <a data-toggle="tab" href="#itinerario" class="nav-link show active">Itinerario</a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="tab" href="#hoja" class="nav-link">Hoja de ruta</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-3">
                        <div id="itinerario" class="tab-pane fade show active">
                            <div class="row">
                                <div class="col-12 d-none">
                                    <i class="fa fa-check d-none text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Hidalgo esta activo"></i>
                                    <b class="text-success text-25">@if($cotizacion->categorizado=='C'){{'Con factura'}}@elseif($cotizacion->categorizado=='S'){{'Sin factura'}}@else{{'No esta filtrado'}}@endif</b>
                                    <div class="dropdown pull-right d-none">
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
                                <div class="col-12">
                                    <input type="hidden" id="nro_servicios_reservados" value="{{$nro_servicios_reservados}}">
                                    <input type="hidden" id="nro_servicios_total" value="{{$nro_servicios_total}}">

                                    <div class="progress my-3">
                                        <div id="barra_porc" class="progress-bar {{$colo_progres}} progress-bar-striped active" role="progressbar" aria-valuenow="{{$porc_avance}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$porc_avance}}%;min-width: 2em;">
                                            {{$porc_avance}}%
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-none">
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
                            <div class="row">
                                <div class="col">
                                    <table class="table table-bordered table-hover table-sm">
                                        <thead>
                                        <tr class="small">
                                            <th></th>
                                            <th class="d-none">GROUP</th>
                                            <th>SERVICE</th>
                                            <th>DESTINATION</th>
                                            <th>TYPE</th>
                                            <th>CALCULO</th>
                                            <th>SALES</th>
                                            <th>RESERVED</th>
                                            <th>PROVIDER</th>
                                            <th>VERIFICATION CODE</th>
                                            <th>HOUR</th>
                                            <th class="d-none">S/P</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $sumatotal_v=0;
                                            $sumatotal_v_r=0;
                                        @endphp
                                        @foreach($cotizacion->paquete_cotizaciones as $paquete)
                                            @if($paquete->estado==2)
                                                @foreach($paquete->itinerario_cotizaciones as $itinerario)
                                                    @php
                                                        $nro_servicios=0;
                                                    @endphp
                                                    @foreach($itinerario->itinerario_servicios as $servicios)
                                                        @if($servicios->itinerario_proveedor)
                                                            @foreach($servicios->itinerario_proveedor as $proveedor)
                                                                @php
                                                                    $nro_servicios++;
                                                                @endphp
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    <tr class="small">
                                                        {{--<td rowspan="{{$nro_servicios}}"><b class="text-primary">Day {{$itinerario->dias}}</b></td>--}}
                                                        <td class="bg-g-dark text-white" colspan="12">
                                                            <div class="row align-items-center">
                                                                <div class="col">
                                                                    <b>Day {{$itinerario->dias}}</b>
                                                                </div>
                                                                <div class="col text-center">
                                                                    <b>{{date("d/m/Y",strtotime($itinerario->fecha))}}</b>
                                                                </div>
                                                                <div class="col text-right">
                                                                    <a href="{{route('servicios_add_path',[$cotizacion->id,$itinerario->id,$itinerario->dias])}}"  class="btn btn-sm text-primary">
                                                                        <i class="fa fa-plus"></i> Servicio
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    @foreach($itinerario->itinerario_servicios->sortBy('pos') as $servicios)
                                                        <tr id="servicio_{{$servicios->id}}">
                                                            <td class="text-center">
                                                                @php
                                                                    $grupe='ninguno';
                                                                    $destino='';
                                                                    $tipoServicio='';
                                                                    $clase='';
                                                                @endphp
                                                                @foreach($m_servicios->where('id',$servicios->m_servicios_id) as $m_ser)
                                                                    @php
                                                                        $grupe=$m_ser->grupo;
                                                                        $destino=$m_ser->localizacion;
                                                                        $tipoServicio=$m_ser->tipoServicio;
                                                                        $clase=$m_ser->clase;
                                                                    @endphp
                                                                @endforeach
                                                                @if($grupe=='TOURS')
                                                                    <i class="fas fa-map text-info"></i>
                                                                @endif
                                                                @if($grupe=='MOVILID')
                                                                    @if($clase=='BOLETO')
                                                                        <i class="fas fa-ticket-alt text-warning"></i>
                                                                    @else
                                                                        <i class="fa fa-bus text-warning"></i>
                                                                    @endif
                                                                @endif
                                                                @if($grupe=='REPRESENT')
                                                                    <i class="fa fa-users text-success"></i>
                                                                @endif
                                                                @if($grupe=='ENTRANCES')
                                                                    <i class="fas fa-ticket-alt text-warning"></i>
                                                                @endif
                                                                @if($grupe=='FOOD')
                                                                    <i class="fa fa-cutlery text-danger"></i>
                                                                @endif
                                                                @if($grupe=='TRAINS')
                                                                    <i class="fa fa-train text-info"></i>
                                                                @endif
                                                                @if($grupe=='FLIGHTS')
                                                                    <i class="fa fa-plane text-primary"></i>
                                                                @endif
                                                                @if($grupe=='OTHERS')
                                                                    <i class="fa fa-question fa-text-success"></i>
                                                                @endif
                                                            </td>
                                                            <td class="d-none">{{$grupe}}</td>
                                                            <td class="lefts">
                                                                <span class="small"><b>{{$servicios->nombre}}</b>
                                                                    @if($grupe=='TRAINS')
                                                                        <b class="text-g-green">[Sal: {{$servicios->salida}}-Lleg: {{$servicios->llegada}}]</b>
                                                                    @endif
                                                                </span>
                                                            </td>
                                                            <td><span class="small text-warning">({{$destino}})</span></td>
                                                            <td><span class="small text-primary">{{$tipoServicio}}</span></td>
                                                            @php
                                                                $mate='<sup>$</sup>';
                                                                $mate_SALE='$';
                                                            @endphp
                                                            @if($servicios->precio_grupo==1)
                                                                @php
                                                                    $mate.=round($servicios->precio/$cotizacion->nropersonas,2);
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $mate.=$servicios->precio;
                                                                @endphp
                                                            @endif
                                                            @php
                                                                $person='<b class="text-primary small">'.$cotizacion->nropersonas.'<i class="fa fa-male"></i></b>';
                                                            @endphp
                                                            {{--@for($i=1;$i<=$cotizacion->nropersonas;$i++)--}}
                                                                {{--@php--}}
                                                                    {{--$person.=' <i class="fa fa-male"></i>';--}}
                                                                {{--@endphp--}}
                                                            {{--@endfor--}}

                                                            @php
                                                                $mate.="x".$person;
                                                            @endphp
                                                            @if($servicios->precio_grupo==1)
                                                                @php
                                                                    $mate_SALE.=$servicios->precio;
                                                                    $sumatotal_v+=$servicios->precio;
                                                                    $sumatotal_v_r+=$servicios->precio_proveedor;
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $mate_SALE.=$servicios->precio*$cotizacion->nropersonas;
                                                                    $sumatotal_v+=$servicios->precio*$cotizacion->nropersonas;
                                                                    $sumatotal_v_r+=$servicios->precio_proveedor;
                                                                @endphp
                                                            @endif

                                                            <td  class="text-right small">
                                                                @if($servicios->precio_grupo==1)
                                                                    {!! $mate !!}
                                                                @elseif($servicios->precio_grupo==0)
                                                                    {!! $mate !!}
                                                                @endif
                                                                {{--<p class="@if($servicios->precio_grupo==1){{'d-none'}}@endif"><i class="fa fa-male" aria-hidden="true"></i> {{$servicios->precio*$cotizacion->nropersonas}} $--}}
                                                                {{--<a id="ipropover_{{$servicios->id}}" data-toggle="popover" title="Detalle" data-content="{{$mate}}"> <i class="fa fa-calculator text-primary" aria-hidden="true"></i></a>--}}
                                                                {{--</p>--}}
                                                                {{--<p class="@if($servicios->precio_grupo==0){{'d-none'}}@endif"><i class="fa fa-users" aria-hidden="true"></i> {{$servicios->precio}} $--}}
                                                                {{--<a id="propover_{{$servicios->id}}" data-toggle="popover" title="Detalle" data-content="{{$mate}}"> <i class="fa fa-calculator text-primary" aria-hidden="true"></i></a>--}}
                                                                {{--</p>--}}
                                                            </td>
                                                            <td  class="text-right small">
                                                                {{$mate_SALE}}
                                                            </td>
                                                            {{--<td class="text-right">@if($servicios->precio_grupo==1){{$servicios->precio*2}}@else {{$servicios->precio}}@endif x {{$cotizacion->nropersonas}} = @if($servicios->precio_grupo==1){{$servicios->precio*2*$cotizacion->nropersonas}}@else {{$servicios->precio*$cotizacion->nropersonas}}@endif $</td>--}}
                                                            <td class="text-right" id="book_precio_asig_{{$servicios->id}}">
                                                                @if($servicios->precio_proveedor)
                                                                    <small class="font-weight-bold float-left" id="costo_servicio_{{$servicios->id}}"><sup>$</sup>{{$servicios->precio_proveedor}}</small>
                                                                    <a href="#!" id="boton_prove_costo_{{$servicios->id}}" data-toggle="modal" data-target="#myModal_costo_{{$servicios->id}}" class="float-right">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                    <div class="modal fade" id="myModal_costo_{{$servicios->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <form id="asignar_proveedor_costo_path_{{$servicios->id}}" action="{{route('asignar_proveedor_costo_path')}}" method="post">
                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title" id="myModalLabel">
                                                                                            @if($grupe=='TOURS')
                                                                                                <i class="fas fa-map text-info" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupe=='MOVILID')
                                                                                                <i class="fa fa-bus text-warning" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupe=='REPRESENT')
                                                                                                <i class="fa fa-users text-success" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupe=='ENTRANCES')
                                                                                                <i class="fas fa-ticket-alt text-warning" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupe=='FOOD')
                                                                                                <i class="fa fa-cutlery text-danger" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupe=='TRAINS')
                                                                                                <i class="fa fa-train text-info" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupe=='FLIGHTS')
                                                                                                <i class="fa fa-plane text-primary" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupe=='OTHERS')
                                                                                                <i class="fa fa-question fa-text-success" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            Editar Costo</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                    </div>
                                                                                    <div class="modal-body clearfix">
                                                                                        <div class="row">
                                                                                            <div class="col text-left">

                                                                                                <div class="form-group">
                                                                                                    <label for="txt_name" class="font-weight-bold text-secondary">Costo actual</label>
                                                                                                    <input type="number" class="form-control text-right" id="book_price_edit_{{$servicios->id}}" name="txt_costo_edit" value="{{$servicios->precio_proveedor}}">
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="txt_name" class="font-weight-bold text-secondary">Justificacion</label>
                                                                                                    <input type="text" class="form-control" id="txt_justificacion_{{$servicios->id}}" name="txt_justificacion" value="{{$servicios->justificacion_precio_proveedor}}">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-12">
                                                                                                <b id="rpt_book_proveedor_costo_{{$servicios->id}}" class="text-success"></b>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        {{csrf_field()}}
                                                                                        <input type="hidden" name="id" value="{{$servicios->id}}">
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                                        <button type="button" class="btn btn-primary" onclick="Guardar_proveedor_costo({{$servicios->id}})">Guardar cambios</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                {{--@else--}}
                                                                    {{--<span id="book_precio_asig_{{$servicios->id}}"></span>--}}
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                <b class="small" id="book_proveedor_{{$servicios->id}}">
                                                                    @if($servicios->itinerario_proveedor)
                                                                        {{$servicios->itinerario_proveedor->nombre_comercial}}
                                                                    @endif
                                                                </b>
                                                                @if(!$servicios->itinerario_proveedor)
                                                                    @php
                                                                        $grupe='ninguno';
                                                                    @endphp
                                                                    @foreach($m_servicios->where('id',$servicios->m_servicios_id) as $m_ser)
                                                                        @php
                                                                            $grupe=$m_ser->grupo;
                                                                        @endphp
                                                                    @endforeach
                                                                    <a href="#!" id="boton_prove_{{$servicios->id}}" data-toggle="modal" data-target="#myModal_{{$servicios->id}}">
                                                                        <i class="fa fa-plus-circle"></i>
                                                                    </a>
                                                                    <div class="modal fade" id="myModal_{{$servicios->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <form id="asignar_proveedor_path_{{$servicios->id}}" action="{{route('asignar_proveedor_path')}}" method="post">
                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title" id="myModalLabel">
                                                                                            @if($grupe=='TOURS')
                                                                                                <i class="fas fa-map text-info" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupe=='MOVILID')
                                                                                                <i class="fa fa-bus text-warning" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupe=='REPRESENT')
                                                                                                <i class="fa fa-users text-success" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupe=='ENTRANCES')
                                                                                                <i class="fas fa-ticket-alt text-warning" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupe=='FOOD')
                                                                                                <i class="fa fa-cutlery text-danger" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupe=='TRAINS')
                                                                                                <i class="fa fa-train text-info" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupe=='FLIGHTS')
                                                                                                <i class="fa fa-plane text-primary" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupe=='OTHERS')
                                                                                                <i class="fa fa-question fa-text-success" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            Lista de proveedores</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                    </div>
                                                                                    <div class="modal-body clearfix">
                                                                                        <div class="row">
                                                                                            <div class="col-md-12">
                                                                                                @if($productos->where('m_servicios_id',$servicios->m_servicios_id)->count()==0)
                                                                                                    <b class="text-danger text-15">No tenemos proveedores disponibles!</b>
                                                                                                @elseif($servicios->servicio)
                                                                                                    <p class="d-none">{{$productos->where('m_servicios_id',$servicios->m_servicios_id)->count()}} - {{$servicios->m_servicios_id}}</p>
                                                                                                    @foreach($productos as $producto)
                                                                                                        @if($producto->m_servicios_id==$servicios->m_servicios_id)
                                                                                                            @if($producto->precio_grupo==1)
                                                                                                                @php
                                                                                                                    $valor=$cotizacion->nropersonas;
                                                                                                                @endphp
                                                                                                            @else
                                                                                                                @php
                                                                                                                    $valor=1;
                                                                                                                @endphp
                                                                                                            @endif
                                                                                                            @php
                                                                                                                $precio_book=$producto->precio_costo*1;
                                                                                                            @endphp
                                                                                                            @if($producto->precio_grupo==0)
                                                                                                                @php
                                                                                                                    $precio_book=$producto->precio_costo*$cotizacion->nropersonas;
                                                                                                                @endphp
                                                                                                            @endif
                                                                                                            <div class="row">
                                                                                                                <div class="col">
                                                                                                                    <div class="checkbox11 text-left">
                                                                                                                        <div class="row">
                                                                                                                            <div class="col-12 bg-g-green">
                                                                                                                                <b class="d-block">{{$producto->nombre}}</b>
                                                                                                                                <small class="text-white">({{$producto->localizacion}})</small>
                                                                                                                                <small class="text-white">{{$producto->tipo_producto}}</small>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="row">
                                                                                                                            <div class="col bg-g-yellow">
                                                                                                                                <label class="text-g-dark">
                                                                                                                                    <p class="text-g-dark m-0">{{$producto->proveedor->nombre_comercial}}
                                                                                                                                        @if($producto->grupo=='TRAINS')
                                                                                                                                            <span class="small text-g-dark" >[Sal: {{$servicios->salida}} - Lleg:{{$servicios->llegada}}]</span>
                                                                                                                                        @endif
                                                                                                                                    </p>
                                                                                                                                    <input type="hidden" id="proveedor_servicio_{{$producto->id}}" value="{{$producto->proveedor->nombre_comercial}}">
                                                                                                                                    <input class="grupo" type="radio" onchange="dato_producto({{$producto->id}})" name="precio[]" value="{{$cotizacion->id}}_{{$servicios->id}}_{{$producto->proveedor->id}}_{{$precio_book}}">
                                                                                                                                    <sup>$</sup>
                                                                                                                                    @if($producto->precio_grupo==1)
                                                                                                                                        {{$producto->precio_costo*1}}
                                                                                                                                        <input type="hidden" id="book_price_{{$producto->id}}" value="{{$producto->precio_costo*1}}">
                                                                                                                                    @else
                                                                                                                                        {{$producto->precio_costo}}x{{$cotizacion->nropersonas}}={{$producto->precio_costo*$cotizacion->nropersonas}}
                                                                                                                                        {{--<input type="hidden" id="book_price_{{$producto->id}}" value="{{$producto->precio_costo}}x{{$cotizacion->nropersonas}}={{$producto->precio_costo*$cotizacion->nropersonas}}">--}}
                                                                                                                                        <input type="hidden" id="book_price_{{$producto->id}}" value="{{$producto->precio_costo*$cotizacion->nropersonas}}">
                                                                                                                                    @endif
                                                                                                                                </label>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            {{--@endif--}}
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                @endif
                                                                                            </div>
                                                                                            <div class="col-md-12">
                                                                                                <b id="rpt_book_proveedor_{{$servicios->id}}" class="text-success"></b>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        {{csrf_field()}}
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                                        <button type="button" class="btn btn-primary" onclick="Guardar_proveedor('{{$servicios->id}}','{{route('asignar_proveedor_costo_path')}}','{{csrf_token()}}')">Guardar cambios1</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <a id="boton_prove_{{$servicios->id}}" href="#" class="float-right" data-toggle="modal" data-target="#myModal_{{$servicios->id}}">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                    <div class="modal fade" id="myModal_{{$servicios->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <form id="asignar_proveedor_path_{{$servicios->id}}" action="{{route('asignar_proveedor_path')}}" method="post">
                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title" id="myModalLabel">
                                                                                            @if($grupe=='TOURS')
                                                                                                <i class="fas fa-map text-info" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupe=='MOVILID')
                                                                                                <i class="fa fa-bus text-warning" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupe=='REPRESENT')
                                                                                                <i class="fa fa-users text-success" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupe=='ENTRANCES')
                                                                                                <i class="fas fa-ticket-alt text-warning" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupe=='FOOD')
                                                                                                <i class="fa fa-cutlery text-danger" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupe=='TRAINS')
                                                                                                <i class="fa fa-train text-info" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupe=='FLIGHTS')
                                                                                                <i class="fa fa-plane text-primary" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupe=='OTHERS')
                                                                                                <i class="fa fa-question fa-text-success" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            Lista de proveedores</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div class="row">
                                                                                            <div class="col-12">
                                                                                                @if($productos->where('m_servicios_id',$servicios->m_servicios_id)->count()==0)
                                                                                                    <b class="text-danger text-15">No tenemos proveedores disponibles!</b>
                                                                                                @elseif($servicios->servicio)

                                                                                                    @foreach($productos as $producto)
                                                                                                        @php
                                                                                                            $valor_chk='';
                                                                                                        @endphp
                                                                                                        @if($producto->proveedor_id==$servicios->proveedor_id)
                                                                                                            @php
                                                                                                                $valor_chk='checked=\'checked\'';
                                                                                                            @endphp
                                                                                                        @endif
                                                                                                        @if($producto->m_servicios_id==$servicios->m_servicios_id)
                                                                                                            @if($producto->precio_grupo==1)
                                                                                                                @php
                                                                                                                    $valor=$cotizacion->nropersonas;
                                                                                                                @endphp
                                                                                                            @else
                                                                                                                @php
                                                                                                                    $valor=1;
                                                                                                                @endphp
                                                                                                            @endif
                                                                                                            @php
                                                                                                                $precio_book=$producto->precio_costo*1;
                                                                                                            @endphp
                                                                                                            @if($producto->precio_grupo==0)
                                                                                                                @php
                                                                                                                    $precio_book=$producto->precio_costo*$cotizacion->nropersonas;
                                                                                                                @endphp
                                                                                                            @endif
                                                                                                            <div class="row">
                                                                                                            <div class="col">
                                                                                                                <div class="checkbox11 text-left">
                                                                                                                    <div class="row">
                                                                                                                        <div class="col-12 bg-green-goto">
                                                                                                                            <b class="small text-g-dark text-center">{{$producto->nombre}}</b><br>
                                                                                                                            <span class="small text-white">({{$producto->localizacion}})</span>
                                                                                                                            <span class="small text-white">{{$producto->tipo_producto}}</span>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="row">
                                                                                                                        <div class="col-12 bg-g-yellow">
                                                                                                                            <label class="text-g-dark ">
                                                                                                                                <p class="m-0">{{$producto->proveedor->nombre_comercial}}
                                                                                                                                    @if($producto->grupo=='TRAINS')
                                                                                                                                        <span class="small text-g-dark " >[Sal: {{$servicios->salida}} - Lleg:{{$servicios->llegada}}]</span>
                                                                                                                                    @endif
                                                                                                                                </p>
                                                                                                                                <input type="hidden" id="proveedor_servicio_{{$producto->id}}" value="{{$producto->proveedor->nombre_comercial}}">
                                                                                                                                <input class="grupo" type="radio" onchange="dato_producto({{$producto->id}})" name="precio[]" value="{{$cotizacion->id}}_{{$servicios->id}}_{{$producto->proveedor->id}}_{{$precio_book}}" {!! $valor_chk !!}>
                                                                                                                                <sup>$</sup>
                                                                                                                                @if($producto->precio_grupo==1)
                                                                                                                                    {{$producto->precio_costo*1}}
                                                                                                                                    <input type="hidden" id="book_price_{{$producto->id}}" value="{{$producto->precio_costo*1}}">
                                                                                                                                @else
                                                                                                                                    {{$producto->precio_costo}}x{{$cotizacion->nropersonas}}={{$producto->precio_costo*$cotizacion->nropersonas}}
                                                                                                                                    {{--<input type="hidden" id="book_price_{{$producto->id}}" value="{{$producto->precio_costo}}x{{$cotizacion->nropersonas}}={{$producto->precio_costo*$cotizacion->nropersonas}}">--}}
                                                                                                                                    <input type="hidden" id="book_price_{{$producto->id}}" value="{{$producto->precio_costo*$cotizacion->nropersonas}}">
                                                                                                                                @endif
                                                                                                                            </label>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            {{--@endif--}}
                                                                                                            </div>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                @endif
                                                                                            </div>
                                                                                            <div class="col-12">
                                                                                                <b id="rpt_book_proveedor_{{$servicios->id}}" class="text-success"></b>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        {{csrf_field()}}
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                                        <button type="button" class="btn btn-primary" onclick="Guardar_proveedor('{{$servicios->id}}','{{route('asignar_proveedor_costo_path')}}','{{csrf_token()}}')">Guardar cambios</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </td>
                                                            <td class="boton">
                                                                @php
                                                                    $codigo='primary';
                                                                    $icon='save';
                                                                    $codigo_h='primary';
                                                                    $icon_h='save';
                                                                @endphp
                                                                @if($servicios->codigo_verificacion!='')
                                                                    @php
                                                                        $codigo='warning';
                                                                        $icon='edit';
                                                                    @endphp
                                                                @endif
                                                                @if($servicios->hora_llegada!='')
                                                                    @php
                                                                        $codigo_h='warning';
                                                                        $icon_h='edit';
                                                                    @endphp
                                                                @endif
                                                                @php
                                                                    $mostrar='';
                                                                @endphp
                                                                @if($grupe=='ENTRANCES' || ($grupe=='MOVILID' && $clase=='BOLETO'))
                                                                    @php
                                                                        $mostrar='d-none';
                                                                    @endphp
                                                                @endif
                                                                <form id="add_cod_verif_path_{{$servicios->id}}" class="form-inline" action="{{route('add_cod_verif_path')}}" method="post">
                                                                    <div class="row margin-left-0">
                                                                        {{csrf_field()}}
                                                                        <input type="hidden" name="id" value="{{$servicios->id}}">
                                                                        <input type="hidden" name="coti_id" value="{{$cotizacion->id}}">
                                                                        <div class="col-lg-12 ">
                                                                            <div class="input-group">
                                                                                <input class="form-control form-control-sm" type="text" id="code_{{$servicios->id}}" name="code_{{$servicios->id}}" value="{{$servicios->codigo_verificacion}}">
                                                                                <span class="input-group-btn">
                                                                                    <button type="submit"  onclick="Enviar_codigo_reserva({{$servicios->id}})" id="btn_{{$servicios->id}}"  class="btn btn-{{$codigo}} btn-sm"><i class="fa fa-{{$icon}}" aria-hidden="true"></i></button>
                                                                                </span>
                                                                            </div>

                                                                        </div>

                                                                    </div>
                                                                </form>
                                                            </td>
                                                            <td class="boton">
                                                                <form id="add_time_path_{{$servicios->id}}" class="{{$mostrar}} form-inline" action="{{route('add_time_path')}}" method="post">
                                                                    <div class="row">
                                                                        {{csrf_field()}}
                                                                        <input type="hidden" name="id" value="{{$servicios->id}}">
                                                                        <input type="hidden" name="coti_id" value="{{$cotizacion->id}}">
                                                                        <div class="col-lg-12">
                                                                            <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
                                                                                <input class="form-control form-control-sm" type="text" id="hora_{{$servicios->id}}" name="hora_{{$servicios->id}}" value="{{$servicios->hora_llegada}}">
                                                                                <span class="input-group-btn">
                                                                                    <button type="submit" id="btn_hora_{{$servicios->id}}" onclick="Enviar_hora_reserva({{$servicios->id}})" class="btn btn-{{$codigo_h}} btn-sm"><i class="fa fa-{{$icon_h}}" aria-hidden="true"></i></button>
                                                                                </span>
                                                                            </div>
                                                                            {{--<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">--}}
                                                                            {{--<input type="text" class="form-control" value="09:30">--}}
                                                                            {{--<span class="input-group-addon">--}}
                                                                            {{--<span class="glyphicon glyphicon-time"></span>--}}
                                                                            {{--</span>--}}
                                                                            {{--</div>--}}
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </td>
                                                            <td class="d-none">
                                                                @php
                                                                    $esServ='false';
                                                                @endphp
                                                                @foreach($m_servicios->where('id',$servicios->m_servicios_id) as $serv)
                                                                    @if($serv->grupo=='TOURS')
                                                                        @php
                                                                            $esServ='true';
                                                                        @endphp
                                                                    @elseif($serv->grupo=='REPRESENT')
                                                                        @if($serv->tipoServicio=='TRANSFER')

                                                                            @php
                                                                                $esServ='true';
                                                                            @endphp
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                                @if($esServ=='true')
                                                                    @if($servicios->s_p=='PC')
                                                                        <a class="btn btn-success" href="{{route('sp_path',[$cotizacion->id,$servicios->id,'SIC'])}}">PC</a>
                                                                    @elseif($servicios->s_p=='SIC')
                                                                        <a class="btn btn-primary" href="{{route('sp_path',[$cotizacion->id,$servicios->id,'PC'])}}">SIC</a>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            <td class="text-center" id="estado_proveedor_serv_{{$servicios->id}}">
                                                                @if($servicios->itinerario_proveedor)
                                                                    <i class="fa fa-check text-success"></i>
                                                                @else
                                                                    <i class="far fa-clock"></i>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                @php
                                                                    $localizacion='';
                                                                    $grupo='';
                                                                @endphp
                                                                @foreach($m_servicios->where('id',$servicios->m_servicios_id) as $res)
                                                                    @php
                                                                        $localizacion=$res->localizacion;
                                                                        $grupo=$res->grupo;
                                                                    @endphp
                                                                @endforeach
                                                                <button type="button" class="btn btn-danger btn-sm" onclick="eliminar_servicio_reservas('{{$servicios->id}}','{{$servicios->nombre}}')">
                                                                    <i class="fas fa-trash" aria-hidden="true"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_servicio_{{$servicios->id}}" onclick="traer_servicios('{{$itinerario->id}}','{{$servicios->id}}','{{$localizacion}}','{{$grupo}}')">
                                                                    <i class="fas fa-exchange-alt"></i>
                                                                </button>
                                                                <!-- Modal -->
                                                                <div class="modal fade bd-example-modal-lg" id="modal_servicio_{{$servicios->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <form action="{{route('cambiar_servicio_path')}}" method="post">
            {{--                                                                <form action="{{route('destination_save_path')}}" method="post" id="destination_save_id" enctype="multipart/form-data">--}}
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">Cambiar servicio <span class="text-success"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$localizacion}}</span></h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12">
                                                                                            <div class="panel panel-default">
                                                                                                <div id="list_servicios_grupo_{{$servicios->id}}" class="panel-body">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    {{csrf_field()}}
                                                                                    <input type="hidden" id="servicio_pos_{{$servicios->id}}" name="pos" value="{{$servicios->pos}}">
                                                                                    <input type="hidden" name="impu" name="impu" value="servicio_cambiar_{{$itinerario->id}}_{{$grupo}}">
                                                                                    <input type="hidden" id="servicio_antiguo_{{$servicios->id}}" name="id_antiguo" value="{{$servicios->id}}">
                                                                                    <input type="hidden" name="p_itinerario_id" value="{{$itinerario->id}}">
                                                                                    <input type="hidden" name="cotizacion_id" value="{{$cotizacion->id}}">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    {{--{{dd($itinerario->hotel)}}--}}
                                                    @foreach($itinerario->hotel as $hotel)
                                                        <tr>
                                                            <td class="text-center">
                                                                <b>{{$hotel->estrellas}} <i class="fa fa-star text-warning" aria-hidden="true"></i></b>
                                                            </td>
                                                            <td>
                                                                {{--</td>--}}
                                                                {{--<td>--}}
                                                                {{--{{$hotel->id}}--}}
                                                                @php
                                                                    $total=0;
                                                                    $total_book=0;
                                                                    $cadena_total='';
                                                                    $cadena_total_book='';
                                                                $cadena_total_coti='';
                                                                @endphp
                                                                @if($hotel->personas_s>0)
                                                                    @php
                                                                        $total+=$hotel->personas_s*$hotel->precio_s;
                                                                        $total_book+=$hotel->personas_s*$hotel->precio_s_r;
                                                                        $cadena_total.="<span>$".$hotel->precio_s." x ".$hotel->personas_s."</span><br>";
                                                                        $cadena_total_coti.="<span>$".$hotel->personas_s*$hotel->precio_s."</span><br>";
                                                                        if($hotel->precio_s_r){
                                                                            $cadena_total_book.="<span>$".$hotel->personas_s*$hotel->precio_s_r."</span><br>";
                                                                        }
                                                                        $sumatotal_v+=$hotel->personas_s*$hotel->precio_s;
                                                                    @endphp
                                                                    <span class="margin-bottom-5"><b>{{$hotel->personas_s}}</b> <span class="stick"><i class="fa fa-bed" aria-hidden="true"></i></span></span>
                                                                    <br>
                                                                @endif
                                                                @if($hotel->personas_d>0)
                                                                    @php
                                                                        $total+=$hotel->personas_d*$hotel->precio_d;
                                                                        $total_book+=$hotel->personas_d*$hotel->precio_d_r;
                                                                        $cadena_total.="<span>$".$hotel->precio_d." x ".$hotel->personas_d." </span><br>";
                                                                        $cadena_total_coti.="<span>$".($hotel->personas_d*$hotel->precio_d)."</span><br>";
                                                                        if($hotel->precio_d_r){
                                                                        $cadena_total_book.="<span>$".($hotel->personas_d*$hotel->precio_d_r)."</span><br>";
                                                                        }
                                                                        $sumatotal_v+=$hotel->personas_d*$hotel->precio_d;
                                                                    @endphp
                                                                    <span class="margin-bottom-5"><b>{{$hotel->personas_d}}</b> <span class="stick"><i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i></span></span>
                                                                    <br>
                                                                @endif
                                                                @if($hotel->personas_m>0)
                                                                    @php
                                                                        $total+=$hotel->personas_m*$hotel->precio_m;
                                                                        $total_book+=$hotel->personas_m*$hotel->precio_m_r;
                                                                        $cadena_total.="<p>$".$hotel->precio_m." x ".($hotel->personas_m)."</p><br>";
                                                                        $cadena_total_coti.="<p>$".$hotel->personas_m." x ".($hotel->precio_m)." </p><br>";
                                                                        if($hotel->precio_m_r){
                                                                            $cadena_total_book.="<p>$".$hotel->personas_m." x ".($hotel->precio_m_r)." </p><br>";
                                                                        }
                                                                        $sumatotal_v+=$hotel->personas_m*$hotel->precio_m;
                                                                    @endphp
                                                                    <span class="margin-bottom-5"><b>{{$hotel->personas_m}}</b> <span class="stick"><i class="fa fa-venus-mars" aria-hidden="true"></i></span></span>
                                                                    <br>
                                                                @endif
                                                                @if($hotel->personas_t>0)
                                                                    @php
                                                                        $total+=$hotel->personas_t*$hotel->precio_t;
                                                                        $total_book+=$hotel->personas_t*$hotel->precio_t_r;
                                                                        $cadena_total.="<span>$".$hotel->precio_t." x ".($hotel->personas_t)."</span><br>";
                                                                        $cadena_total_coti.="<span>$".$hotel->personas_t." x ".($hotel->precio_t)."</span><br>";
                                                                        if($hotel->precio_t_r){
                                                                            $cadena_total_book.="<span>$".$hotel->personas_t." x ".($hotel->precio_t_r)."</span><br>";
                                                                        }
                                                                        $sumatotal_v+=$hotel->personas_t*$hotel->precio_t;
                                                                    @endphp
                                                                    <span class="margin-bottom-5"><b>{{$hotel->personas_t}}</b> <span class="stick"><i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i></span></span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <span class="small text-warning">({{$hotel->localizacion}})</span>
                                                            </td>
                                                            <td>
                                                                <span class="small text-primary">HOTEL</span>

                                                            </td>
                                                            <td class="text-right">
                                                                {!! $cadena_total !!}
                                                                <p class="d-none"><i class="fa fa-users" aria-hidden="true"></i> {{$total}}
                                                                    <a id="hpropover_{{$hotel->id}}" data-toggle="popover" title="Detalle" data-content="{{$cadena_total}}"> <i class="fa fa-calculator text-primary" aria-hidden="true"></i></a>
                                                                </p>
                                                            </td>
                                                            <td class="text-right">
                                                                {!! $cadena_total_coti !!}
                                                            </td>
                                                            {{--<td class="text-right">@if($servicios->precio_grupo==1){{$servicios->precio*2}}@else {{$servicios->precio}}@endif x {{$cotizacion->nropersonas}} = @if($servicios->precio_grupo==1){{$servicios->precio*2*$cotizacion->nropersonas}}@else {{$servicios->precio*$cotizacion->nropersonas}}@endif $</td>--}}
                                                            @php
                                                                $sumatotal_v_r+=$total_book
                                                            @endphp
                                                            <td id="book_precio_asig_hotel_{{$hotel->id}}"  class="text-right">
                                                                @if($hotel->personas_s>0)
                                                                    @if($hotel->precio_s_r>0)
                                                                        <p id="book_price_edit_h_s_{{$hotel->id}}">${{$hotel->precio_s_r}}</p>
                                                                    @endif
                                                                @endif
                                                                @if($hotel->personas_d>0)
                                                                    @if($hotel->precio_d_r>0)
                                                                        <p id="book_price_edit_h_d_{{$hotel->id}}">${{$hotel->precio_d_r}}</p>
                                                                    @endif
                                                                @endif
                                                                @if($hotel->personas_m>0)
                                                                    @if($hotel->precio_m_r>0)
                                                                        <p id="book_price_edit_h_m_{{$hotel->id}}">${{$hotel->precio_m_r}}</p>
                                                                    @endif
                                                                @endif
                                                                @if($hotel->personas_t>0)
                                                                    @if($hotel->precio_t_r>0)
                                                                        <p id="book_price_edit_h_t_{{$hotel->id}}">${{$hotel->precio_t_r}}</p>
                                                                    @endif
                                                                @endif

                                                                {{--{!! $cadena_total_book !!}--}}
                                                                @if($hotel->proveedor)
                                                                    <a href="#!" id="boton_prove_hotel_edit_cost_{{$hotel->id}}" data-toggle="modal" data-target="#myModal_edit_cost_h_{{$hotel->id}}">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                    <div class="modal fade" id="myModal_edit_cost_h_{{$hotel->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <form id="asignar_proveedor_hotel_path_{{$hotel->id}}" action="{{route('asignar_proveedor_hotel_path')}}" method="post">
                                                                                    <div class="modal-header">
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-building" aria-hidden="true"></i> Editar costo del hotel</h4>
                                                                                    </div>
                                                                                    <div class="modal-body clearfix">
                                                                                        <table>

                                                                                            @php
                                                                                                $s=0;
                                                                                                $d=0;
                                                                                                $m=0;
                                                                                                $t=0;
                                                                                            @endphp

                                                                                            @if($hotel->personas_s>0)

                                                                                                @php
                                                                                                    $s=$hotel->personas_s;
                                                                                                @endphp
                                                                                                @if($hotel->precio_s_r>0)
                                                                                                    <tr class="text-left">
                                                                                                        <td width="100px">
                                                                                                            <span class="margin-bottom-5">
                                                                                                                <b>{{$hotel->personas_s}}</b>
                                                                                                                <span class="stick">
                                                                                                                    <i class="fa fa-bed" aria-hidden="true"></i>
                                                                                                                </span>
                                                                                                            </span>
                                                                                                        </td>
                                                                                                        <td width="100px">
                                                                                                            <input type="number" class="form-control" id="book_price_edit_h_s_p_{{$hotel->id}}" name="txt_costo_edit_s" value="{{$hotel->precio_s_r}}">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                @endif
                                                                                            @endif
                                                                                            @if($hotel->personas_d>0)
                                                                                                @php
                                                                                                    $d=$hotel->personas_d;
                                                                                                @endphp
                                                                                                @if($hotel->precio_d_r>0)
                                                                                                    <tr class="text-left">
                                                                                                        <td width="100px">
                                                                                                        <span class="margin-bottom-5">
                                                                                                            <b>{{$hotel->personas_d}}</b>
                                                                                                            <span class="stick">
                                                                                                                <i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i>
                                                                                                            </span>
                                                                                                        </span>
                                                                                                        </td>
                                                                                                        <td width="100px">
                                                                                                            <input type="number" class="form-control" id="book_price_edit_h_d_p_{{$hotel->id}}" name="txt_costo_edit_d" value="{{$hotel->precio_d_r}}">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                @endif
                                                                                            @endif
                                                                                            @if($hotel->personas_m>0)
                                                                                                @php
                                                                                                    $m=$hotel->personas_m;
                                                                                                @endphp
                                                                                                @if($hotel->precio_m_r>0)
                                                                                                    <tr class="text-left">
                                                                                                        <td width="100px">
                                                                                                            <span class="margin-bottom-5">
                                                                                                                <b>{{$hotel->personas_m}}</b>
                                                                                                                <span class="stick">
                                                                                                                    <i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i>
                                                                                                                </span>
                                                                                                            </span>
                                                                                                        </td>
                                                                                                        <td width="100px">
                                                                                                            <input type="number" class="form-control" id="book_price_edit_h_m_p_{{$hotel->id}}" name="txt_costo_edit_d" value="{{$hotel->precio_m_r}}">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                @endif
                                                                                            @endif
                                                                                            @if($hotel->personas_t>0)
                                                                                                @php
                                                                                                    $t=$hotel->personas_t;
                                                                                                @endphp
                                                                                                @if($hotel->precio_t_r>0)
                                                                                                    <tr class="text-left">
                                                                                                        <td width="100px">
                                                                                                            <span class="margin-bottom-5">
                                                                                                                <b>{{$hotel->personas_t}}</b>
                                                                                                                <span class="stick">
                                                                                                                    <i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i>
                                                                                                                </span>
                                                                                                            </span>
                                                                                                        </td>
                                                                                                        <td width="100px">
                                                                                                            <input type="number" class="form-control" id="book_price_edit_h_t_p_{{$hotel->id}}" name="txt_costo_edit_t" value="{{$hotel->precio_t_r}}">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                @endif
                                                                                            @endif
                                                                                        </table>
                                                                                        <div class="col-md-12">
                                                                                            <b id="rpt_precio_proveedor_hotel_{{$hotel->id}}" class="text-success"></b>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        {{csrf_field()}}
                                                                                        <input type="hidden" name="id" value="{{$hotel->id}}">
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                                        <button type="button" class="btn btn-primary" onclick="Guardar_proveedor_hotel_costo('{{$hotel->id}}','{{$s}}','{{$d}}','{{$m}}','{{$t}}')">Guardar cambios</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                <p class="d-none"> {{$total_book}}
                                                                    <a id="h_rpropover_{{$hotel->id}}" data-toggle="popover" title="Detalle" data-content="{{$cadena_total_book}}"> <i class="fa fa-calculator text-primary" aria-hidden="true"></i></a>
                                                                </p>
                                                            </td>
                                                            <td class="text-center">
                                                                <b class="small" id="book_proveedor_hotel_{{$hotel->id}}">
                                                                    @if($hotel->proveedor)
                                                                        {{$hotel->proveedor->nombre_comercial}}
                                                                    @endif
                                                                </b>
                                                                @if($hotel->proveedor)
                                                                    <a href="#!" id="boton_prove_hotel_{{$hotel->id}}" data-toggle="modal" data-target="#myModal_h_{{$hotel->id}}">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                    <div class="modal fade" id="myModal_h_{{$hotel->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <form id="asignar_proveedor_hotel_path_{{$hotel->id}}" action="{{route('asignar_proveedor_hotel_path')}}" method="post">
                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-building" aria-hidden="true"></i> Lista de proveedores para el hotel</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                    </div>
                                                                                    <div class="modal-body clearfix">
                                                                                        <div class="row">
                                                                                            <div class="col-md-12">
                                                                                                @foreach($hotel_proveedor->where('hotel_id',$hotel->hotel_id) as $hotel_proveedor_)
                                                                                                    @php
                                                                                                        $valor_class='';
                                                                                                    @endphp
                                                                                                    @if($hotel_proveedor_->proveedor_id==$hotel->proveedor_id)
                                                                                                        @php
                                                                                                            $valor_class='checked=\'checked\'';
                                                                                                        @endphp
                                                                                                    @endif
                                                                                                    {{--
                                                                                                                                                                                    {{--@if($hotel_proveedor_->estrellas==$paquete->estrellas)--}}
                                                                                                    <div class="col-6">
                                                                                                        <div class="text-left bg-light card p-2">
                                                                                                            <label class="text-primary">
                                                                                                                <input class="grupo" onchange="dato_producto_hotel({{$hotel_proveedor_->id}})" type="radio" name="precio[]" value="{{$cotizacion->id}}_{{$hotel->id}}_{{$hotel_proveedor_->proveedor_id}}_{{$hotel_proveedor_->id}}" {!! $valor_class !!}>
                                                                                                                <b>{{$hotel_proveedor_->proveedor->nombre_comercial}} | {{$hotel_proveedor_->estrellas}}<i class="fa fa-star text-warning" aria-hidden="true"></i></b>
                                                                                                                <span class="d-none" id="proveedor_servicio_hotel_{{$hotel_proveedor_->id}}">
                                                                                                                {{$hotel_proveedor_->proveedor->nombre_comercial}}
                                                                                                            </span>
                                                                                                            </label>
                                                                                                            @php
                                                                                                                $s=0;
                                                                                                                $d=0;
                                                                                                                $m=0;
                                                                                                                $t=0;
                                                                                                            @endphp
                                                                                                            @if($hotel->personas_s>0)
                                                                                                                <p class="text-g-green">Single: ${{($hotel_proveedor_->single*$hotel->personas_s)}}</p>
                                                                                                            @endif
                                                                                                            @if($hotel->personas_d>0)
                                                                                                                <p class="text-g-green">Double: ${{$hotel_proveedor_->doble*$hotel->personas_d}}</p>
                                                                                                            @endif
                                                                                                            @if($hotel->personas_m>0)
                                                                                                                <p class="text-g-green">Matrimonial: ${{$hotel_proveedor_->matrimonial*$hotel->personas_m}}</p>
                                                                                                            @endif
                                                                                                            @if($hotel->personas_t>0)
                                                                                                                <p class="text-g-green">Triple: ${{$hotel_proveedor_->triple*$hotel->personas_t}}</p>
                                                                                                            @endif
                                                                                                            <span class="d-none" id="book_price_hotel_{{$hotel_proveedor_->id}}">
                                                                                                            @if($hotel->personas_s>0)
                                                                                                                    <p class="text-g-green">${{($hotel_proveedor_->single*$hotel->personas_s)}}</p>
                                                                                                                @endif
                                                                                                                @if($hotel->personas_d>0)
                                                                                                                    <p class="text-g-green">${{$hotel_proveedor_->doble*$hotel->personas_d}}</p>
                                                                                                                @endif
                                                                                                                @if($hotel->personas_m>0)
                                                                                                                    <p class="text-g-green">${{$hotel_proveedor_->matrimonial*$hotel->personas_m}}</p>
                                                                                                                @endif
                                                                                                                @if($hotel->personas_t>0)
                                                                                                                    <p class="text-g-green">${{$hotel_proveedor_->triple*$hotel->personas_t}}</p>
                                                                                                                @endif
                                                                                                        </span>

                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endforeach
                                                                                            </div>
                                                                                            <div class="col-12">
                                                                                                <b id="rpt_book_proveedor_hotel_{{$hotel->id}}" class="text-success"></b>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        {{csrf_field()}}
                                                                                        <input type="hidden" name="id" value="{{$hotel->id}}">
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                                        <button type="button" class="btn btn-primary" onclick="Guardar_proveedor_hotel({{$hotel->id}})">Guardar cambios</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if(!$hotel->proveedor)
                                                                    <a href="#!" id="boton_prove_hotel_{{$hotel->id}}" class="" data-toggle="modal" data-target="#myModal_h_{{$hotel->id}}">
                                                                        <i class="fa fa-plus-circle"></i>
                                                                    </a>
                                                                    <div class="modal fade" id="myModal_h_{{$hotel->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <form id="asignar_proveedor_hotel_path_{{$hotel->id}}" action="{{route('asignar_proveedor_hotel_path')}}" method="post">
                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-building" aria-hidden="true"></i> Lista de proveedores para el hotel</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                    </div>
                                                                                    <div class="modal-body clearfix">
                                                                                        <div class="row">
                                                                                            <div class="col-12">
                                                                                                <div class="row">
                                                                                                @foreach($hotel_proveedor->where('hotel_id',$hotel->hotel_id) as $hotel_proveedor_)
                                                                                                    {{--
                                                                                                                                                                                    {{--@if($hotel_proveedor_->estrellas==$paquete->estrellas)--}}
                                                                                                    <div class="col-6 mb-3">
                                                                                                        <div class="text-left bg-light card p-2">
                                                                                                            <label class="text-primary">
                                                                                                                <input class="grupo" onchange="dato_producto_hotel({{$hotel_proveedor_->id}})" type="radio" name="precio[]" value="{{$cotizacion->id}}_{{$hotel->id}}_{{$hotel_proveedor_->proveedor_id}}_{{$hotel_proveedor_->id}}">
                                                                                                                <b>{{$hotel_proveedor_->proveedor->nombre_comercial}} | {{$hotel_proveedor_->estrellas}}<i class="fa fa-star text-warning" aria-hidden="true"></i></b>
                                                                                                                <span class="d-none" id="proveedor_servicio_hotel_{{$hotel_proveedor_->id}}">
                                                                                                                {{$hotel_proveedor_->proveedor->nombre_comercial}}
                                                                                                                </span>
                                                                                                            </label>
                                                                                                            @if($hotel->personas_s>0)
                                                                                                                <p class="text-g-green">Single: ${{($hotel_proveedor_->single*$hotel->personas_s)}}</p>
                                                                                                            @endif
                                                                                                            @if($hotel->personas_d>0)
                                                                                                                <p class="text-g-green">Double: ${{$hotel_proveedor_->doble*$hotel->personas_d}}</p>
                                                                                                            @endif
                                                                                                            @if($hotel->personas_m>0)
                                                                                                                <p class="text-g-green">Matrimonial: ${{$hotel_proveedor_->matrimonial*$hotel->personas_m}}</p>
                                                                                                            @endif
                                                                                                            @if($hotel->personas_t>0)
                                                                                                                <p class="text-g-green">Triple: ${{$hotel_proveedor_->triple*$hotel->personas_t}}</p>
                                                                                                            @endif
                                                                                                            <span class="d-none" id="book_price_hotel_{{$hotel_proveedor_->id}}">
                                                                                                            @if($hotel->personas_s>0)
                                                                                                                    <p class="text-g-green">${{($hotel_proveedor_->single*$hotel->personas_s)}}</p>
                                                                                                                @endif
                                                                                                                @if($hotel->personas_d>0)
                                                                                                                    <p class="text-g-green">${{$hotel_proveedor_->doble*$hotel->personas_d}}</p>
                                                                                                                @endif
                                                                                                                @if($hotel->personas_m>0)
                                                                                                                    <p class="text-g-green">${{$hotel_proveedor_->matrimonial*$hotel->personas_m}}</p>
                                                                                                                @endif
                                                                                                                @if($hotel->personas_t>0)
                                                                                                                    <p class="text-g-green">${{$hotel_proveedor_->triple*$hotel->personas_t}}</p>
                                                                                                                @endif
                                                                                                        </span>

                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endforeach
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-12">
                                                                                                <b id="rpt_book_proveedor_hotel_{{$hotel->id}}" class="text-success"></b>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        {{csrf_field()}}
                                                                                        <input type="hidden" name="id" value="{{$hotel->id}}">
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                                        <button type="button" class="btn btn-primary" onclick="Guardar_proveedor_hotel({{$hotel->id}})">Guardar cambios</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @php
                                                                    $codigo_ho='primary';
                                                                    $icon_ho='save';
                                                                    $codigo_hora='primary';
                                                                    $icon_hora='save';
                                                                @endphp
                                                                @if($hotel->codigo_verificacion!='')
                                                                    @php
                                                                        $codigo_ho='warning';
                                                                        $icon_ho='edit';
                                                                    @endphp
                                                                @endif
                                                                @if($hotel->hora_llegada!='')
                                                                    @php
                                                                        $codigo_hora='warning';
                                                                        $icon_hora='edit';
                                                                    @endphp
                                                                @endif
                                                                <form id="add_cod_verif_hotel_path_{{$hotel->id}}" class="form-inline" action="{{route('add_cod_verif_hotel_path')}}" method="post">
                                                                    <div class="row">
                                                                        {{csrf_field()}}
                                                                        <input type="hidden" name="id" value="{{$hotel->id}}">
                                                                        <input type="hidden" name="coti_id" value="{{$cotizacion->id}}">
                                                                        <div class="col-12">
                                                                            <div class="input-group">
                                                                                <input class="form-control form-control-sm" type="text" id="code_{{$hotel->id}}" name="code_{{$hotel->id}}" value="{{$hotel->codigo_verificacion}}">
                                                                                <span class="input-group-btn">
                                                                             <button type="submit" onclick="Enviar_codigo_reserva_hotel({{$hotel->id}})" id="btn_h_{{$hotel->id}}" class="btn btn-{{$codigo_ho}} btn-sm"><i class="fa fa-{{$icon_ho}}" aria-hidden="true"></i></button>
                                                                        </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </td>
                                                            <td>
                                                                <form id="add_hora_hotel_path_{{$hotel->id}}" class="form-inline" action="{{route('add_hora_hotel_path')}}" method="post">
                                                                    <div class="row">
                                                                        {{csrf_field()}}
                                                                        <input type="hidden" name="id" value="{{$hotel->id}}">
                                                                        <input type="hidden" name="coti_id" value="{{$cotizacion->id}}">
                                                                        <div class="col-12">
                                                                            <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
                                                                                <input class="form-control form-control-sm" type="text" id="hora_{{$hotel->id}}" name="hora_{{$hotel->id}}" value="{{$hotel->hora_llegada}}">
                                                                                <span class="input-group-btn">
                                                                             <button type="submit" onclick="Enviar_hora_reserva_hotel({{$hotel->id}})" id="btn_hora_h_{{$hotel->id}}" class="btn btn-{{$codigo_hora}} btn-sm"><i class="fa fa-{{$icon_hora}}" aria-hidden="true"></i></button>
                                                                        </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </td>
                                                            <td id="estado_proveedor_serv_hotel_{{$hotel->id}}" class="text-center">
                                                                @if($hotel->proveedor)
                                                                    <i class="fa fa-check text-success"></i>
                                                                @else
                                                                    <i class="far fa-clock"></i>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            @endif
                                        @endforeach
                                        </tbody>
                                        <tbody>
                                        <tr>
                                            <td colspan="5"><b>Total</b></td>
                                            <td class="text-right text-18 text-warning"><b><sup>$</sup>{{$sumatotal_v}}</b></td>
                                            <td class="text-right text-18 text-info"><b><sup>$</sup>{{$sumatotal_v_r}}</b></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col text-center">
                                    <form id="form_guardar_reserva" action="{{route('confirmar_reserva_path')}}" method="post">
                                        <input type="hidden" name="cotizacion_id" value="{{$cotizacion->id}}">
                                        {{csrf_field()}}
                                        <button type="submit" class="btn btn-lg btn-success">Guardar reserva
                                            <i class="far fa-thumbs-up" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="panel panel-default d-none">
                                <div class="panel-body">
                                    <ul class="nav nav-tabs nav-justified">
                                        <li class="active"><a data-toggle="tab" href="#detalle">Detalle</a></li>
                                        <li><a data-toggle="tab" href="#resumen">Resumen</a></li>
                                        <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
                                    </ul>
                                    <div class="tab-content mt-3">
                                        <div id="detalle" class="tab-pane fade show active">
                                        </div>
                                        <div id="resumen" class="tab-pane fade ">
                                            {{--<table class="table table-bordered tb table-striped table-responsive table-hover">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                            {{--<th>GRUPO</th>--}}
                                            {{--<th>PROVEEDOR</th>--}}
                                            {{--<th>NOMBRE COMERCIAL</th>--}}
                                            {{--<th>FECHA DE SERVICIO</th>--}}
                                            {{--<th>CATEGORIA</th>--}}
                                            {{--<th>FECHA PROGRAMADA</th>--}}
                                            {{--<th>TOTAL</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($ItinerarioServiciosAcumPagos as $ItinerarioServiciosAcumPago)--}}
                                            {{--<tr>--}}
                                            {{--<th>{{$ItinerarioServiciosAcumPago->grupo}}</th>--}}
                                            {{--<th>--}}
                                            {{--@foreach($proveedores->where('id',$ItinerarioServiciosAcumPago->proveedor_id) as $proveedor)--}}
                                            {{--{{$proveedor->r_nombres}}--}}
                                            {{--@endforeach--}}
                                            {{--</th>--}}
                                            {{--<th>--}}
                                            {{--@foreach($proveedores->where('id',$ItinerarioServiciosAcumPago->proveedor_id) as $proveedor)--}}
                                            {{--{{$proveedor->nombre_comercial}}--}}
                                            {{--@endforeach--}}
                                            {{--</th>--}}
                                            {{--<th>{{$ItinerarioServiciosAcumPago->fecha_servicio}}</th>--}}
                                            {{--<th>--}}
                                            {{--@if($cotizacion->categorizado=='C')--}}
                                            {{--Con factura--}}
                                            {{--@else@if($cotizacion->categorizado=='S')--}}
                                            {{--sin factura--}}
                                            {{--@endif--}}
                                            {{--</th>--}}
                                            {{--<th>{{$ItinerarioServiciosAcumPago->fecha_a_pagar}}</th>--}}
                                            {{--<th>{{$ItinerarioServiciosAcumPago->a_cuenta}}</th>--}}
                                            {{--</tr>--}}
                                            {{--@endforeach--}}
                                            {{--</tbody>--}}
                                            {{--</table>--}}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div id="hoja" class="tab-pane fade">
                            <div class="row">
                                <div class="col-12 d-none">
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
                                    <i class="fa fa-check d-none text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Hidalgo esta activo"></i>
                                    <b class="text-success text-25">@if($cotizacion->categorizado=='C'){{'Con factura'}}@elseif($cotizacion->categorizado=='S'){{'Sin factura'}}@else{{'No esta filtrado'}}@endif</b>
                                    <div class="dropdown pull-right d-none">
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
                                <div class="col-12 my-3">
                                    <input type="hidden" id="nro_servicios_reservados" value="{{$nro_servicios_reservados}}">
                                    <input type="hidden" id="nro_servicios_total" value="{{$nro_servicios_total}}">

                                    <div class="progress">
                                        <div id="barra_porc" class="progress-bar {{$colo_progres}} progress-bar-striped active" role="progressbar" aria-valuenow="{{$porc_avance}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$porc_avance}}%;min-width: 2em;">
                                            {{$porc_avance}}%
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 d-none">
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

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">NOMBRES</th>
                                    <th class="text-center">NACIONALIDAD</th>
                                    <th class="text-center">NRO DOC.</th>
                                    <th class="text-center">SEXO</th>
                                    <th class="text-center">HOTEL</th>
                                    <th class="text-center">EDAD</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cotizacion->cotizaciones_cliente as $coti_cliente)
                                    @foreach($clientes1->where('id',$coti_cliente->clientes_id) as $cliente)
                                        <tr>
                                            <td>{{$cliente->nombres}} {{$cliente->apellidos}}</td>
                                            <td>{{$cliente->nacionalidad}}</td>
                                            <td>{{$cliente->pasaporte}}</td>
                                            <td>{{$cliente->sexo}}</td>
                                            <td>
                                                @foreach($cotizacion->paquete_cotizaciones as $paquete)
                                                    @if($paquete->estado==2)
                                                        @if($paquete->paquete_precios->count()==0)
                                                            CTA PAXS
                                                        @else
                                                            @foreach($paquete->paquete_precios as $pqt_precio)
                                                                @if($pqt_precio->personas_s>0)
                                                                    <span class="text-warning">SINGLE</span>
                                                                @endif
                                                                @if($pqt_precio->personas_d>0)
                                                                       | <span class="text-warning">DOBLE</span>
                                                                    @endif
                                                                @if($pqt_precio->personas_m>0)
                                                                       | <span class="text-warning">MATRIMONIAL</span>
                                                                    @endif
                                                                @if($pqt_precio->personas_t>0)
                                                                       | <span class="text-warning">TRIPLE</span>
                                                                    @endif
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{\Carbon\Carbon::parse($cliente->fechanacimiento)->age }} años</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                            <table class="table table-bordered table-sm">
                                <thead>
                                <tr>
                                    <th class="text-center">DIA</th>
                                    <th class="text-center">DATE</th>
                                    <th class="text-center">HOUR</th>
                                    <th class="text-center">SERVICE</th>
                                    <th class="text-center">PROVEEDOR</th>
                                    <th class="text-center">HOTEL</th>
                                    <th class="text-center">OBSERVACIONES</th>
                                    <th class="text-center">CONF.</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cotizacion->paquete_cotizaciones as $paquete)
                                    @if($paquete->estado==2)

                                        @foreach($paquete->itinerario_cotizaciones as $itinerario)
                                            @php
                                                $primera_coincidencia=0;
                                                $primera_hora='0';
                                                $nro_filas=0;
                                                $recorrido_hotel=0;
                                            @endphp

                                                @foreach($itinerario->itinerario_servicios->sortby('hora_llegada') as $servicios)
                                                @if($servicios->servicio->grupo!='ENTRANCES'|| ($servicios->servicio->grupo=='MOVILID' &&$servicios->servicio->clase=='BOLETO'))
                                                    @php
                                                        $nro_filas=0;
                                                        $nro_filas_hotel=0;
                                                        $color='bg-info';
                                                        $recorrido_hotel++;
                                                    @endphp
                                                    @foreach($itinerario->itinerario_servicios->sortby('hora_llegada') as $servicios1)
                                                        @if($servicios1->servicio->grupo!='ENTRANCES'|| ($servicios1->servicio->grupo=='MOVILID' &&$servicios1->servicio->clase=='BOLETO'))
                                                            @if($servicios->hora_llegada==$servicios1->hora_llegada)
                                                                @php
                                                                    $nro_filas++;
                                                                @endphp
                                                            @endif
                                                            @php
                                                                $nro_filas_hotel++;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    {{--@if($recorrido_hotel==1)--}}
                                                        {{--@php--}}
                                                            {{--$primera_coincidencia_hotel==1;--}}
                                                        {{--@endphp--}}
                                                    {{--@else--}}
                                                        {{--@php--}}
                                                            {{--$primera_coincidencia_hotel==0;--}}
                                                        {{--@endphp--}}
                                                    {{--@endif--}}
                                                    @if($servicios->hora_llegada!=$primera_hora)
                                                        @php
                                                            $primera_hora=$servicios->hora_llegada;
                                                            $primera_coincidencia=1;

                                                        @endphp
                                                    @else
                                                        @php
                                                            $primera_coincidencia=0;

                                                        @endphp
                                                    @endif
                                                    @if($itinerario->dias%2==0)
                                                        @php
                                                        $color='gb-color-zebra';
                                                        @endphp
                                                    @else
                                                        @php
                                                        $color='';
                                                        @endphp
                                                @endif

                                                    <tr>
                                                        <td  @if($primera_coincidencia==1) rowspan="{{$nro_filas}}" class="{{$color}} text-center" @else class="d-none" @endif>
                                                            <span class="d-none text-warning">
                                                             @if($primera_coincidencia==1) rowspan="{{$nro_filas}}" @else ocultar @endif
                                                            </span> <b>{{$itinerario->dias}}</b>
                                                        </td>
                                                        <td  @if($primera_coincidencia==1) rowspan="{{$nro_filas}}" class="{{$color}} text-center" @else class="d-none" @endif>
                                                            <b>{{date("d/m/Y",strtotime($itinerario->fecha))}}</b>
                                                        </td>
                                                        <td @if($primera_coincidencia==1) rowspan="{{$nro_filas}}" class="{{$color}} text-center" @else class="d-none" @endif>
                                                            <b>{{$servicios->hora_llegada}}</b>
                                                        </td>

                                                        <td class="{{$color}}">
                                                            <table class="table mb-0">
                                                                <tr>
                                                                    <td>
                                                                        @if($servicios->servicio->grupo=='FOOD' ||$servicios->servicio->grupo=='MOVILID' || $servicios->servicio->grupo=='REPRESENT' || $servicios->servicio->grupo=='FLIGHT' || $servicios->servicio->grupo=='TOURS' || $servicios->servicio->grupo=='TRAINS')
                                                                            @if($servicios->servicio->grupo=='TOURS')
                                                                                <i class="fas fa-map text-info" aria-hidden="true"></i>
                                                                            @endif
                                                                            @if($servicios->servicio->grupo=='MOVILID' &&$servicios->servicio->clase!='BOLETO')
                                                                                <i class="fa fa-bus text-warning" aria-hidden="true"></i>
                                                                            @endif
                                                                            @if($servicios->servicio->grupo=='REPRESENT')
                                                                                <i class="fa fa-users text-success" aria-hidden="true"></i>
                                                                            @endif
                                                                            @if($servicios->servicio->grupo=='ENTRANCES')
                                                                                <i class="fas fa-ticket-alt text-warning" aria-hidden="true"></i>
                                                                            @endif
                                                                            @if($servicios->servicio->grupo=='FOOD')
                                                                                <i class="fa fa-cutlery text-danger" aria-hidden="true"></i>
                                                                            @endif
                                                                            @if($servicios->servicio->grupo=='TRAINS')
                                                                                <i class="fa fa-train text-info" aria-hidden="true"></i>
                                                                            @endif
                                                                            @if($servicios->servicio->grupo=='FLIGHTS')
                                                                                <i class="fa fa-plane text-primary" aria-hidden="true"></i>
                                                                            @endif
                                                                            @if($servicios->servicio->grupo=='OTHERS')
                                                                                <i class="fa fa-question fa-text-success" aria-hidden="true"></i>
                                                                            @endif
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if($servicios->servicio->grupo=='FOOD'|| ($servicios->servicio->grupo=='MOVILID' &&$servicios->servicio->clase!='BOLETO') || $servicios->servicio->grupo=='REPRESENT' || $servicios->servicio->grupo=='FLIGHT' || $servicios->servicio->grupo=='TOURS' || $servicios->servicio->grupo=='TRAINS')
                                                                             <b>Nom:</b> {{$servicios->nombre}} <span class="small text-warning">@if($servicios->servicio->grupo=='REPRESENT') ({{$servicios->servicio->tipoServicio}}) @endif</span>         <!-- para transfer,flight,tours,treins --> <br>
                                                                        @endif
                                                                        @if($servicios->servicio->grupo=='TOURS')
                                                                             <b>Tipo Servicio:</b> {{$servicios->servicio->tipoServicio}}<!-- para tours --> <br>
                                                                        @endif
                                                                        @if($servicios->servicio->grupo=='FLIGHT' || $servicios->servicio->grupo=='TRAINS')
                                                                             <b>Hora:</b> {{$servicios->salida}} {{$servicios->llegada}}<!-- para flights,trains -->
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        @if($servicios->servicio->grupo=='TOURS'||($servicios->servicio->grupo=='MOVILID'&&$servicios->servicio->clase!='BOLETO')||$servicios->servicio->grupo=='REPRESENT')
                                                        <td @if($primera_coincidencia==1)  class="{{$color}}" @else class="d-none" @endif>

                                                            @if($servicios->servicio->grupo=='MOVILID')
                                                                @foreach($proveedores->where('id',$servicios->proveedor_id)  as $proveedor_serv)
                                                                        <i class="fa fa-bus text-warning" aria-hidden="true"></i> {{$proveedor_serv->nombre_comercial}}
                                                                @endforeach
                                                            @endif
                                                            @if($servicios->servicio->grupo=='REPRESENT')
                                                                @foreach($proveedores->where('id',$servicios->proveedor_id)  as $proveedor_serv)
                                                                        <i class="fa fa-users text-success" aria-hidden="true"></i> {{$proveedor_serv->nombre_comercial}}
                                                                @endforeach
                                                            @endif
                                                            @if($servicios->servicio->grupo=='TOURS')
                                                                @foreach($proveedores->where('id',$servicios->proveedor_id)  as $proveedor_serv)
                                                                        <i class="fas fa-map text-info" aria-hidden="true"></i> {{$proveedor_serv->nombre_comercial}}
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                            @if($primera_coincidencia==0)
                                                                <td class="{{$color}}"></td>
                                                            @endif
                                                        @else
                                                            <td @if($primera_coincidencia==1)  class="{{$color}}" @else class="{{$color}}" @endif></td>
                                                        @endif
                                                        <td valign="middle" @if($recorrido_hotel==1) rowspan="{{$nro_filas_hotel}}" class="{{$color}} text-center" @else class="d-none" @endif>
                                                            @foreach($itinerario->hotel as $hotel)
                                                                @foreach($proveedores->where('id',$hotel->proveedor_id)  as $proveedor_serv)
                                                                    <i class="fa fa-building text-primary" aria-hidden="true"></i> {{$proveedor_serv->nombre_comercial}}
                                                                @endforeach
                                                            @endforeach
                                                        </td>
                                                        @if($servicios->servicio->grupo=='TOURS'||($servicios->servicio->grupo=='MOVILID'&&$servicios->servicio->clase!='BOLETO')||$servicios->servicio->grupo=='REPRESENT')
                                                            <td @if($primera_coincidencia==1)  class="{{$color}} text-center" @else class="d-none" @endif>
                                                                <span id="obs_{{$servicios->id}}">{{$servicios->observacion_hoja_ruta}}</span>
                                                                <a href="#!" id="boton_prove_costo_{{$servicios->id}}" data-toggle="modal" data-target="#myModal_observaciones_r_{{$servicios->id}}">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <div class="modal fade" id="myModal_observaciones_r_{{$servicios->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <form id="ingresar_observaciones_hoja_path_{{$servicios->id}}" action="{{route('asignar_proveedor_observaciones_path')}}" method="post">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title" id="myModalLabel">
                                                                                        Ingrese sus observaciones
                                                                                    </h4>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                </div>
                                                                                <div class="modal-body clearfix">
                                                                                    <div class="row">
                                                                                    <div class="col-12">
                                                                                        <div class="form-group">
                                                                                            <label for="txt_name">Observacion</label>
                                                                                            <textarea class="form-control" name="txt_observacion_hoja_ruta" id="txt_observacion_hoja_ruta_{{$servicios->id}}" cols="40" rows="10">
                                                                                                {{$servicios->observacion_hoja_ruta}}
                                                                                            </textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <b id="rpt_book_hoja_costo_{{$servicios->id}}" class="text-success"></b>
                                                                                    </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    {{csrf_field()}}
                                                                                    <input type="hidden" name="id" value="{{$servicios->id}}">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                                    <button type="button" class="btn btn-primary" onclick="Guardar_observacion_hoja({{$servicios->id}})">Guardar observacion</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        @endif
                                                        @if($primera_coincidencia==0)
                                                            <td class="{{$color}}"></td>
                                                        @endif

                                                        @if($servicios->servicio->grupo=='TOURS'||($servicios->servicio->grupo=='MOVILID'&&$servicios->servicio->clase!='BOLETO')||$servicios->servicio->grupo=='REPRESENT')
                                                            <td @if($primera_coincidencia==1)  class="{{$color}} text-center" @else class="d-none" @endif>
                                                                @if($servicios->confimacion_envio)
                                                                    <input type="hidden" id="estado_send_{{$servicios->id}}" value="0">
                                                                    <button id="confirm_send_{{$servicios->id}}" type="button" class="btn btn-success" onclick="confirma_envio_servicio_reservas('{{$servicios->id}}','0')">
                                                                        <i class="far fa-share-square" aria-hidden="true"></i>
                                                                    </button>
                                                                @else
                                                                    <input type="hidden" id="estado_send_{{$servicios->id}}" value="1">
                                                                    <button id="confirm_send_{{$servicios->id}}" type="button" class="btn btn-unset" onclick="confirma_envio_servicio_reservas('{{$servicios->id}}','1')">
                                                                        <i class="far fa-share-square" aria-hidden="true"></i>
                                                                    </button>
                                                                @endif
                                                            </td>
                                                        @endif
                                                        @if($primera_coincidencia==0)
                                                            <td class="{{$color}}"></td>
                                                        @endif
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        $(document).ready(function() {
            $('.clockpicker').clockpicker()
                .find('input').change(function(){
                // TODO: time changed
                console.log(this.value);
            });

            @foreach($cotizacion->paquete_cotizaciones as $paquete)
                @if($paquete->estado==2)
                    @foreach($paquete->itinerario_cotizaciones as $itinerario)
                        @foreach($itinerario->itinerario_servicios as $servicios)
                            $('#ipropover_{{$servicios->id}}').popover({html: true, placement: "rigth", trigger: "click"});
                            $('#propover_{{$servicios->id}}').popover({html: true, placement: "rigth", trigger: "click"});
                        @endforeach
                        @foreach($itinerario->hotel as $hotel)
                            $('#hpropover_{{$hotel->id}}').popover({html: true, placement: "left", trigger: "click"});
                            $('#h_rpropover_{{$hotel->id}}').popover({html: true, placement: "rigth", trigger: "click"});
                        @endforeach
                    @endforeach
                @endif
            @endforeach

        });

    </script>
@stop