@extends('layouts.admin.book')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Reservas</li>
            <li class="active">New</li>
        </ol>
    </div>
    <div class="row">
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
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">

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
                                <div id="barra_porc" class="progress-bar {{$colo_progres}}" role="progressbar" aria-valuenow="{{$porc_avance}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$porc_avance}}%;min-width: 2em;">
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
                    <table class="table table-bordered tb table-striped table-responsive table-hover">
                        <thead>
                            <tr>
                                <th width="50px"></th>
                                <th>Services</th>
                                <th width="120px">Quote</th>
                                {{--<th>Math Price</th>--}}
                                <th width="120px">Book Price</th>
                                <th>Provider</th>
                                <th>Verification Code</th>
                                <th width="100px">Hora</th>
                                <th class="hide">S/P</th>
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
                                    <tr>
                                        {{--<td rowspan="{{$nro_servicios}}"><b class="text-primary">Day {{$itinerario->dias}}</b></td>--}}
                                        <td class="text-primary text-center" colspan="8"><b>Day {{$itinerario->dias}}: {{date("d/m/Y",strtotime($itinerario->fecha))}}</b></td>

                                    </tr>

                                    @foreach($itinerario->itinerario_servicios as $servicios)
                                        <tr>
                                            <td class="text-center">
                                                @php
                                                    $grupe='ninguno';
                                                    $destino='';
                                                    $tipoServicio='';
                                                @endphp
                                                @foreach($m_servicios->where('id',$servicios->m_servicios_id) as $m_ser)
                                                    @php
                                                        $grupe=$m_ser->grupo;
                                                        $destino=$m_ser->localizacion;
                                                        $tipoServicio=$m_ser->tipoServicio;
                                                    @endphp
                                                @endforeach
                                                @if($grupe=='TOURS')
                                                    <i class="fa fa-map-o text-info" aria-hidden="true"></i>
                                                @endif
                                                @if($grupe=='MOVILID')
                                                    <i class="fa fa-bus text-warning" aria-hidden="true"></i>
                                                @endif
                                                @if($grupe=='REPRESENT')
                                                    <i class="fa fa-users text-success" aria-hidden="true"></i>
                                                @endif
                                                @if($grupe=='ENTRANCES')
                                                    <i class="fa fa-ticket text-warning" aria-hidden="true"></i>
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
                                            </td>
                                            <td  class="lefts">
                                                <span class="text-11"><b>{{$servicios->nombre}}</b></span><br>
                                                <span class="text-10 text-warning">({{$destino}})</span>
                                                <span class="text-10 text-primary">{{$tipoServicio}}</span>
                                            </td>
                                            <td  class="rights">
                                                @php
                                                    $mate='';
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
                                                    $mate.="x ".$cotizacion->nropersonas."=";
                                                @endphp
                                                @if($servicios->precio_grupo==1)
                                                    @php
                                                        $mate.=$servicios->precio;
                                                        $sumatotal_v+=$servicios->precio;
                                                        $sumatotal_v_r+=$servicios->precio_proveedor;
                                                    @endphp
                                                @else
                                                    @php
                                                        $mate.=$servicios->precio*$cotizacion->nropersonas;
                                                        $sumatotal_v+=$servicios->precio*$cotizacion->nropersonas;
                                                        $sumatotal_v_r+=$servicios->precio_proveedor;
                                                    @endphp
                                                @endif
                                                @php
                                                    $mate.="$";
                                                @endphp
                                                @if($servicios->precio_grupo==1)
                                                    {{$mate}}
                                                @elseif($servicios->precio_grupo==0)
                                                    {{$mate}}
                                                @endif
                                                {{--<p class="@if($servicios->precio_grupo==1){{'hide'}}@endif"><i class="fa fa-male" aria-hidden="true"></i> {{$servicios->precio*$cotizacion->nropersonas}} $--}}
                                                    {{--<a id="ipropover_{{$servicios->id}}" data-toggle="popover" title="Detalle" data-content="{{$mate}}"> <i class="fa fa-calculator text-primary" aria-hidden="true"></i></a>--}}
                                                {{--</p>--}}
                                                {{--<p class="@if($servicios->precio_grupo==0){{'hide'}}@endif"><i class="fa fa-users" aria-hidden="true"></i> {{$servicios->precio}} $--}}
                                                    {{--<a id="propover_{{$servicios->id}}" data-toggle="popover" title="Detalle" data-content="{{$mate}}"> <i class="fa fa-calculator text-primary" aria-hidden="true"></i></a>--}}
                                                {{--</p>--}}
                                            </td>
                                            {{--<td class="text-right">@if($servicios->precio_grupo==1){{$servicios->precio*2}}@else {{$servicios->precio}}@endif x {{$cotizacion->nropersonas}} = @if($servicios->precio_grupo==1){{$servicios->precio*2*$cotizacion->nropersonas}}@else {{$servicios->precio*$cotizacion->nropersonas}}@endif $</td>--}}
                                            <td class="rights" id="book_precio_asig_{{$servicios->id}}">
                                                @if($servicios->precio_proveedor)
                                                    {{$servicios->precio_proveedor}} $
                                                @endif
                                            </td>
                                            <td class="boton">
                                                <b class="text-11" id="book_proveedor_{{$servicios->id}}">
                                                    @if($servicios->itinerario_proveedor)
                                                        {{$servicios->itinerario_proveedor->razon_social}}
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
                                                    <button id="boton_prove_{{$servicios->id}}" type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal_{{$servicios->id}}">
                                                        Proveedor
                                                    </button>
                                                    <div class="modal fade" id="myModal_{{$servicios->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form id="asignar_proveedor_path_{{$servicios->id}}" action="{{route('asignar_proveedor_path')}}" method="post">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title" id="myModalLabel">
                                                                            @if($grupe=='TOURS')
                                                                                <i class="fa fa-map-o text-info" aria-hidden="true"></i>
                                                                            @endif
                                                                            @if($grupe=='MOVILID')
                                                                                <i class="fa fa-bus text-warning" aria-hidden="true"></i>
                                                                            @endif
                                                                            @if($grupe=='REPRESENT')
                                                                                <i class="fa fa-users text-success" aria-hidden="true"></i>
                                                                            @endif
                                                                            @if($grupe=='ENTRANCES')
                                                                                <i class="fa fa-ticket text-warning" aria-hidden="true"></i>
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
                                                                    </div>
                                                                    <div class="modal-body clearfix">
                                                                        <div class="col-md-12">
                                                                            @if($productos->where('m_servicios_id',$servicios->m_servicios_id)->count()==0)
                                                                                <b class="text-danger text-15">No tenemos proveedores disponibles!</b>
                                                                            @elseif($servicios->servicio)
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
                                                                                        @if(($servicios->precio*$valor) < $producto->precio_costo)
                                                                                            <div class="col-md-6">
                                                                                                <div class="checkbox11 caja_dia">
                                                                                                    <label class="text-danger">
                                                                                                        <p class="text-primary" >{{$producto->proveedor->razon_social}}</p>
                                                                                                        <input type="hidden" id="proveedor_servicio_{{$producto->id}}" value="{{$producto->proveedor->razon_social}}">
                                                                                                        <input class="grupo" type="radio" onchange="dato_producto({{$producto->id}})" name="precio[]" value="{{$cotizacion->id}}_{{$servicios->id}}_{{$producto->proveedor->id}}_{{$precio_book}}">
                                                                                                        @if($producto->precio_grupo==1)
                                                                                                            {{$producto->precio_costo*1}}
                                                                                                            <input type="hidden" id="book_price_{{$producto->id}}" value="{{$producto->precio_costo*1}}">
                                                                                                        @else
                                                                                                            {{$producto->precio_costo}}x{{$cotizacion->nropersonas}}={{$producto->precio_costo*$cotizacion->nropersonas}}
                                                                                                            <input type="hidden" id="book_price_{{$producto->id}}" value="{{$producto->precio_costo}}x{{$cotizacion->nropersonas}}={{$producto->precio_costo*$cotizacion->nropersonas}}">
                                                                                                        @endif
                                                                                                        $
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            <div class="col-md-6">
                                                                                                <div class="checkbox11 caja_dia">
                                                                                                    <label class="text-green-goto">
                                                                                                        <p class="text-primary">{{$producto->proveedor->razon_social}}</p>
                                                                                                        <input type="hidden" id="proveedor_servicio_{{$producto->id}}" value="{{$producto->proveedor->razon_social}}">
                                                                                                        <input class="grupo" type="radio" onchange="dato_producto({{$producto->id}})" name="precio[]" value="{{$cotizacion->id}}_{{$servicios->id}}_{{$producto->proveedor->id}}_{{$precio_book}}">
                                                                                                        @if($producto->precio_grupo==1)
                                                                                                            {{$producto->precio_costo*1}}
                                                                                                            <input type="hidden" id="book_price_{{$producto->id}}" value="{{$producto->precio_costo*1}}">
                                                                                                        @else
                                                                                                            {{$producto->precio_costo}}x{{$cotizacion->nropersonas}}={{$producto->precio_costo*$cotizacion->nropersonas}}
                                                                                                            <input type="hidden" id="book_price_{{$producto->id}}" value="{{$producto->precio_costo}}x{{$cotizacion->nropersonas}}={{$producto->precio_costo*$cotizacion->nropersonas}}">
                                                                                                        @endif $
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endif
                                                                                @endforeach
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <b id="rpt_book_proveedor_{{$servicios->id}}" class="text-success text-14"></b>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        {{csrf_field()}}
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                        <button type="button" class="btn btn-primary" onclick="Guardar_proveedor({{$servicios->id}})">Guardar cambios</button>
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
                                                    $mostrar='hide';
                                                @endphp
                                                @if($grupe!='ENTRANCES')
                                                    @php
                                                        $mostrar='';
                                                    @endphp
                                                @endif
                                                <form id="add_cod_verif_path_{{$servicios->id}}" class="form-inline" action="{{route('add_cod_verif_path')}}" method="post">
                                                    <div class="row">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="id" value="{{$servicios->id}}">
                                                        <input type="hidden" name="coti_id" value="{{$cotizacion->id}}">
                                                        <div class="col-lg-12">
                                                            <div class="input-group">
                                                                <input class="form-control" type="text" id="code_{{$servicios->id}}" name="code_{{$servicios->id}}" value="{{$servicios->codigo_verificacion}}">
                                                                <span class="input-group-btn">
                                                                        <button type="submit"  onclick="Enviar_codigo_reserva({{$servicios->id}})" id="btn_{{$servicios->id}}"  class="btn btn-{{$codigo}}"><i class="fa fa-{{$icon}}" aria-hidden="true"></i></button>
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
                                                            <div class="input-group">
                                                                <input class="form-control" type="text" id="hora_{{$servicios->id}}" name="hora_{{$servicios->id}}" value="{{$servicios->hora_llegada}}">
                                                                <span class="input-group-btn">
                                                                    <button type="submit" id="btn_hora_{{$servicios->id}}" onclick="Enviar_hora_reserva({{$servicios->id}})" class="btn btn-{{$codigo_h}}"><i class="fa fa-{{$icon_h}}" aria-hidden="true"></i></button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                            <td class="hide">
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
                                            <td class="boton" id="estado_proveedor_serv_{{$servicios->id}}">
                                                @if($servicios->itinerario_proveedor)
                                                        <i class="fa fa-check fa-2x text-success"></i>
                                                @else
                                                    <i class="fa fa-clock-o fa-2x text-unset"></i>
                                                @endif
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
                                                {{--{{$hotel->id}}--}}
                                                @php
                                                    $total=0;
                                                    $total_book=0;
                                                    $cadena_total='';
                                                    $cadena_total_book='';
                                                @endphp
                                                @if($hotel->personas_s>0)
                                                    @php
                                                        $total+=$hotel->personas_s*$hotel->precio_s;
                                                        $total_book+=$hotel->personas_s*$hotel->precio_s_r;
                                                        $cadena_total.="<span>".$hotel->personas_s." x ".$hotel->precio_s." =".($hotel->personas_s*$hotel->precio_s*1)."$</span><br>";
                                                        if($hotel->precio_s_r)
                                                            $cadena_total_book.="<span>".$hotel->personas_s." x ".$hotel->precio_s_r." =".($hotel->personas_s*$hotel->precio_s_r*1)."$</span><br>";

                                                        $sumatotal_v+=$hotel->personas_s*$hotel->precio_s;
{{--                                                        $sumatotal_v_r+=$hotel->personas_s*$hotel->precio_s_r;--}}
                                                    @endphp
                                                    <span class="margin-bottom-5"><b>{{$hotel->personas_s}}</b> <span class="stick"><i class="fa fa-bed" aria-hidden="true"></i></span></span>
                                                    <br>
                                                @endif
                                                @if($hotel->personas_d>0)
                                                    @php
                                                        $total+=$hotel->personas_d*$hotel->precio_d;
                                                        $total_book+=$hotel->personas_d*$hotel->precio_d_r;
                                                        $cadena_total.="<span>".$hotel->personas_d." x ".($hotel->precio_d)." =".($hotel->personas_d*$hotel->precio_d)."$</span><br>";
                                                        if($hotel->precio_d_r)
                                                        $cadena_total_book.="<span>".$hotel->personas_d." x ".($hotel->precio_d_r)." =".($hotel->personas_d*$hotel->precio_d_r)."$</span><br>";

                                                        $sumatotal_v+=$hotel->personas_d*$hotel->precio_d;
{{--                                                        $sumatotal_v_r+=$hotel->personas_d*$hotel->precio_d_r;--}}
                                                    @endphp
                                                    <span class="margin-bottom-5"><b>{{$hotel->personas_d}}</b> <span class="stick"><i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i></span></span>
                                                    <br>
                                                @endif
                                                @if($hotel->personas_m>0)
                                                    @php
                                                        $total+=$hotel->personas_m*$hotel->precio_m;
                                                        $total_book+=$hotel->personas_m*$hotel->precio_m_r;
                                                        $cadena_total.="<p>".$hotel->personas_m." x ".($hotel->precio_m)." =".($hotel->personas_m*$hotel->precio_m)."$</p><br>";
                                                        if($hotel->precio_m_r)
                                                        $cadena_total_book.="<p>".$hotel->personas_m." x ".($hotel->precio_m_r)." =".($hotel->personas_m*$hotel->precio_m_r)."$</p><br>";

                                                        $sumatotal_v+=$hotel->personas_m*$hotel->precio_m;
{{--                                                        $sumatotal_v_r+=$hotel->personas_m*$hotel->precio_m_r;--}}
                                                    @endphp
                                                    <span class="margin-bottom-5"><b>{{$hotel->personas_m}}</b> <span class="stick"><i class="fa fa-venus-mars" aria-hidden="true"></i></span></span>
                                                    <br>
                                                @endif
                                                @if($hotel->personas_t>0)
                                                    @php
                                                        $total+=$hotel->personas_t*$hotel->precio_t;
                                                        $total_book+=$hotel->personas_t*$hotel->precio_t_r;
                                                        $cadena_total.="<span>".$hotel->personas_t." x ".($hotel->precio_t)." =".($hotel->personas_t*$hotel->precio_t)."$</span><br>";
                                                        if($hotel->precio_t_r)
                                                        $cadena_total_book.="<span>".$hotel->personas_t." x ".($hotel->precio_t_r)." =".($hotel->personas_t*$hotel->precio_t_r)."$</span><br>";

                                                        $sumatotal_v+=$hotel->personas_t*$hotel->precio_t;
{{--                                                        $sumatotal_v_r+=$hotel->personas_t*$hotel->precio_t_r;--}}
                                                    @endphp
                                                    <span class="margin-bottom-5"><b>{{$hotel->personas_t}}</b> <span class="stick"><i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i></span></span>
                                                @endif
                                            </td>
                                            <td class="rights">
                                                {!! $cadena_total !!}
                                                <p class="hide"><i class="fa fa-users" aria-hidden="true"></i> {{$total}}
                                                    <a id="hpropover_{{$hotel->id}}" data-toggle="popover" title="Detalle" data-content="{{$cadena_total}}"> <i class="fa fa-calculator text-primary" aria-hidden="true"></i></a>
                                                </p>
                                            </td>
                                            {{--<td class="text-right">@if($servicios->precio_grupo==1){{$servicios->precio*2}}@else {{$servicios->precio}}@endif x {{$cotizacion->nropersonas}} = @if($servicios->precio_grupo==1){{$servicios->precio*2*$cotizacion->nropersonas}}@else {{$servicios->precio*$cotizacion->nropersonas}}@endif $</td>--}}
                                            @php
                                                $sumatotal_v_r+=$total_book
                                            @endphp
                                            <td id="book_precio_asig_hotel_{{$hotel->id}}"  class="rights">
                                                {!! $cadena_total_book !!}
                                                <p class="hide"> {{$total_book}}
                                                    <a id="h_rpropover_{{$hotel->id}}" data-toggle="popover" title="Detalle" data-content="{{$cadena_total_book}}"> <i class="fa fa-calculator text-primary" aria-hidden="true"></i></a>
                                                </p>
                                            </td>
                                            <td class="boton">
                                                <b class="text-11" id="book_proveedor_hotel_{{$hotel->id}}">
                                                    @if($hotel->proveedor)
                                                        {{$hotel->proveedor->razon_social}}
                                                    @endif
                                                </b>
                                                @if(!$hotel->proveedor)
                                                    <button id="boton_prove_hotel_{{$hotel->id}}" type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal_h_{{$hotel->id}}">
                                                        Proveedor
                                                    </button>
                                                    <div class="modal fade" id="myModal_h_{{$hotel->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form id="asignar_proveedor_hotel_path_{{$hotel->id}}" action="{{route('asignar_proveedor_hotel_path')}}" method="post">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-building" aria-hidden="true"></i> Lista de proveedores para el hotel</h4>
                                                                    </div>
                                                                    <div class="modal-body clearfix">
                                                                        <div class="col-md-12">
                                                                            @foreach($hotel_proveedor->where('hotel_id',$hotel->hotel_id) as $hotel_proveedor_)
                                                                                {{--
                                                                                                                                                                {{--@if($hotel_proveedor_->estrellas==$paquete->estrellas)--}}
                                                                                <div class="col-md-6">
                                                                                    <div class="checkbox11 text-left bg-info">
                                                                                        <label class="text-primary">
                                                                                            <input class="grupo" onchange="dato_producto_hotel({{$hotel_proveedor_->id}})" type="radio" name="precio[]" value="{{$cotizacion->id}}_{{$hotel->id}}_{{$hotel_proveedor_->proveedor_id}}_{{$hotel_proveedor_->id}}">
                                                                                            <b>{{$hotel_proveedor_->proveedor->razon_social}} | {{$hotel_proveedor_->estrellas}}<i class="fa fa-star text-warning" aria-hidden="true"></i></>
                                                                                            <span class="hide" id="proveedor_servicio_hotel_{{$hotel_proveedor_->id}}">
                                                                                                    {{$hotel_proveedor_->proveedor->razon_social}}
                                                                                                </span>
                                                                                        </label>
                                                                                        @if($hotel->personas_s>0)
                                                                                            <p class="text-green-goto">Single: ${{($hotel_proveedor_->single*$hotel->personas_s)}}</p>
                                                                                        @endif
                                                                                        @if($hotel->personas_d>0)
                                                                                            <p class="text-green-goto">Double: ${{$hotel_proveedor_->doble*$hotel->personas_d}}</p>
                                                                                        @endif
                                                                                        @if($hotel->personas_m>0)
                                                                                            <p class="text-green-goto">Matrimonial: ${{$hotel_proveedor_->matrimonial*$hotel->personas_m}}</p>
                                                                                        @endif
                                                                                        @if($hotel->personas_t>0)
                                                                                            <p class="text-green-goto">Triple: ${{$hotel_proveedor_->triple*$hotel->personas_t}}</p>
                                                                                        @endif
                                                                                        <span class="hide" id="book_price_hotel_{{$hotel_proveedor_->id}}">
                                                                                                @if($hotel->personas_s>0)
                                                                                                <p class="text-green-goto">{{$hotel->personas_s}} x {{$hotel_proveedor_->single}} ={{($hotel_proveedor_->single*$hotel->personas_s)}}$</p>
                                                                                            @endif
                                                                                            @if($hotel->personas_d>0)
                                                                                                <p class="text-green-goto">{{$hotel->personas_d}} x {{$hotel_proveedor_->doble}} ={{$hotel_proveedor_->doble*$hotel->personas_d}}$</p>
                                                                                            @endif
                                                                                            @if($hotel->personas_m>0)
                                                                                                <p class="text-green-goto">{{$hotel->personas_m}} x {{$hotel_proveedor_->matrimonial}} ={{$hotel_proveedor_->matrimonial*$hotel->personas_m}}$</p>
                                                                                            @endif
                                                                                            @if($hotel->personas_t>0)
                                                                                                <p class="text-green-goto">{{$hotel->personas_t}} x {{$hotel_proveedor_->triple}} ={{$hotel_proveedor_->triple*$hotel->personas_t}}$</p>
                                                                                            @endif
                                                                                            </span>

                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <b id="rpt_book_proveedor_hotel_{{$hotel->id}}" class="text-success text-14"></b>
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
                                            <td class="boton">
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
                                                        <div class="col-lg-12">
                                                            <div class="input-group">
                                                                <input class="form-control" type="text" id="code_{{$hotel->id}}" name="code_{{$hotel->id}}" value="{{$hotel->codigo_verificacion}}">
                                                                <span class="input-group-btn">
                                                                     <button type="submit" onclick="Enviar_codigo_reserva_hotel({{$hotel->id}})" id="btn_h_{{$hotel->id}}" class="btn btn-{{$codigo_ho}}"><i class="fa fa-{{$icon_ho}}" aria-hidden="true"></i></button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                            <td class="boton">
                                                <form id="add_hora_hotel_path" class="form-inline" action="{{route('add_hora_hotel_path')}}" method="post">
                                                    <div class="row">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="id" value="{{$hotel->id}}">
                                                        <input type="hidden" name="coti_id" value="{{$cotizacion->id}}">
                                                        <div class="col-lg-12">
                                                            <div class="input-group">
                                                                <input class="form-control" type="text" id="hora_{{$hotel->id}}" name="hora_{{$hotel->id}}" value="{{$hotel->hora_llegada}}">
                                                                <span class="input-group-btn">
                                                                     <button type="submit" onclick="Enviar_hora_reserva_hotel({{$hotel->id}})" id="btn_hora_h_{{$hotel->id}}" class="btn btn-{{$codigo_hora}}"><i class="fa fa-{{$icon_hora}}" aria-hidden="true"></i></button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                            <td class="boton" id="estado_proveedor_serv_hotel_{{$hotel->id}}">
                                                @if($hotel->proveedor)
                                                    <i class="fa fa-check fa-2x text-success"></i>
                                                @else
                                                    <i class="fa fa-clock-o fa-2x text-unset"></i>
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
                                <td colspan="2"><b>Total</b></td>
                                <td class="text-right text-18 text-warning"><b>{{$sumatotal_v}} $</b></td>
                                <td class="text-right text-18 text-info"><b>{{$sumatotal_v_r}} $</b></td>
                            </tr>
                        </tbody>
                    </table>
                    <form action="{{route('confirmar_reserva_path')}}" method="post">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <input type="hidden" name="cotizacion_id" value="{{$cotizacion->id}}">
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-lg btn-success">Guardar reserva
                                    <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>

    </div>
    <script>
        $(document).ready(function() {

//                $('[data-toggle="popover"]').popover()

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