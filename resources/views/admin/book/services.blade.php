@extends('layouts.admin.book')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Database</li>
            <li class="active">Destination</li>
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
                        <div class="col-md-12 margin-top-20">
                            <div class="progress">

                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                    Datos del pasajero 60%
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
                </div>
            </div>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4 class="text-right hide ">
                        <a href="#" style="text-decoration:none;">
                            {{--<strong>Price x peson: 123.00$</strong>--}}
                            <strong class="text-warning text-25">Pending: 23.00$</strong>
                        </a>
                    </h4>
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Services</th>
                                <th>Quote</th>
                                {{--<th>Math Price</th>--}}
                                <th>Book Price</th>
                                <th>Verification Code</th>
                                <th>Hora</th>
                                <th>Provider</th>
                                <th>S/P</th>
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
                                        <td colspan="2"><b class="text-primary">Day {{$itinerario->dias}}: {{date("d/m/Y",strtotime($itinerario->fecha))}}</b></td>
                                        <td colspan="6"></td>
                                    </tr>

                                    @foreach($itinerario->itinerario_servicios as $servicios)
                                        <tr>
                                            <td>
                                                @php
                                                    $grupe='ninguno';
                                                @endphp
                                                @foreach($m_servicios->where('id',$servicios->m_servicios_id) as $m_ser)
                                                    @php
                                                        $grupe=$m_ser->grupo;
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
                                            <td>{{$servicios->nombre}}</td>
                                            <td class="text-right">
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

                                                <p class="@if($servicios->precio_grupo==1){{'hide'}}@endif"><i class="fa fa-male" aria-hidden="true"></i> {{$servicios->precio*$cotizacion->nropersonas}} $
                                                    <a id="ipropover_{{$servicios->id}}" data-toggle="popover" title="Detalle" data-content="{{$mate}}"> <i class="fa fa-calculator text-primary" aria-hidden="true"></i></a>
                                                </p>
                                                <p class="@if($servicios->precio_grupo==0){{'hide'}}@endif"><i class="fa fa-users" aria-hidden="true"></i> {{$servicios->precio}} $
                                                    <a id="propover_{{$servicios->id}}" data-toggle="popover" title="Detalle" data-content="{{$mate}}"> <i class="fa fa-calculator text-primary" aria-hidden="true"></i></a>
                                                </p>
                                            </td>
                                            {{--<td class="text-right">@if($servicios->precio_grupo==1){{$servicios->precio*2}}@else {{$servicios->precio}}@endif x {{$cotizacion->nropersonas}} = @if($servicios->precio_grupo==1){{$servicios->precio*2*$cotizacion->nropersonas}}@else {{$servicios->precio*$cotizacion->nropersonas}}@endif $</td>--}}
                                            <td class="text-right">{{$servicios->precio_proveedor}} $</td>
                                            <td>
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
                                                <form class="form-inline" action="{{route('add_cod_verif_path')}}" method="post">
                                                    <div class="row">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="id" value="{{$servicios->id}}">
                                                        <input type="hidden" name="coti_id" value="{{$cotizacion->id}}">
                                                        <div class="col-lg-12">
                                                            <div class="input-group">
                                                                <input class="form-control" type="text" id="code_{{$servicios->id}}" name="code_{{$servicios->id}}" value="{{$servicios->codigo_verificacion}}">
                                                                <span class="input-group-btn">
                                                                        <button type="submit" class="btn btn-{{$codigo}}"><i class="fa fa-{{$icon}}" aria-hidden="true"></i></button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <form class="{{$mostrar}} form-inline" action="{{route('add_time_path')}}" method="post">
                                                    <div class="row">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="id" value="{{$servicios->id}}">
                                                        <input type="hidden" name="coti_id" value="{{$cotizacion->id}}">
                                                        <div class="col-lg-12">
                                                            <div class="input-group">
                                                                <input class="form-control" type="time" id="hora_{{$servicios->id}}" name="hora_{{$servicios->id}}" value="{{$servicios->hora_llegada}}" min="00:00" max="24:59">
                                                                <span class="input-group-btn">
                                                                        <button type="submit" class="btn btn-{{$codigo_h}}"><i class="fa fa-{{$icon_h}}" aria-hidden="true"></i></button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                            @if($servicios->itinerario_proveedor)
                                                {{$servicios->itinerario_proveedor->razon_social}}
                                            @else
                                                @php
                                                $grupe='ninguno';
                                                @endphp
                                                @foreach($m_servicios->where('id',$servicios->m_servicios_id) as $m_ser)
                                                        @php
                                                            $grupe=$m_ser->grupo;
                                                        @endphp
                                                @endforeach
                                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal_{{$servicios->id}}">
                                                    Proveedor
                                                    </button>
                                                    <div class="modal fade" id="myModal_{{$servicios->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form action="{{route('asignar_proveedor_path')}}" method="post">
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
                                                                        {{--{{dd($servicios)}}--}}
                                                                        @if($servicios->servicio)
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
                                                                                    <div class="col-md-12">
                                                                                        <div class="checkbox11">
                                                                                            <label class="text-danger">
                                                                                                <input class="grupo" type="radio" name="precio[]" value="{{$cotizacion->id}}_{{$servicios->id}}_{{$producto->proveedor->id}}_{{$precio_book}}">
                                                                                                @if($producto->precio_grupo==1){{$producto->precio_costo*1}}@else{{$producto->precio_costo}}x{{$cotizacion->nropersonas}}={{$producto->precio_costo*$cotizacion->nropersonas}} @endif $ <span class="text-primary">by {{$producto->proveedor->razon_social}}</span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    @else
                                                                                    <div class="col-md-12">
                                                                                        <div class="checkbox11">
                                                                                            <label class="text-green-goto">
                                                                                                <input class="grupo" type="radio" name="precio[]" value="{{$cotizacion->id}}_{{$servicios->id}}_{{$producto->proveedor->id}}_{{$precio_book}}">
                                                                                                @if($producto->precio_grupo==1){{$producto->precio_costo*1}}@else{{$producto->precio_costo}}x{{$cotizacion->nropersonas}}={{$producto->precio_costo*$cotizacion->nropersonas}}  @endif $ <span class="text-primary">by {{$producto->proveedor->razon_social}}</span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endif
                                                                            @endforeach
                                                                        @endif
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    {{csrf_field()}}
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                            @endif
                                            </td>
                                            <td>
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
                                            <td>
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
                                            <td></td>
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
                                                        $cadena_total.="<p>Single: ".$hotel->personas_s." x ".$hotel->precio_s." =".($hotel->personas_s*$hotel->precio_s*1)."</p>";
                                                        $cadena_total_book.="<p>Single: ".$hotel->personas_s." x ".$hotel->precio_s_r." =".($hotel->personas_s*$hotel->precio_s_r*1)."</p>";
                                                        $sumatotal_v+=$hotel->personas_s*$hotel->precio_s;
{{--                                                        $sumatotal_v_r+=$hotel->personas_s*$hotel->precio_s_r;--}}
                                                    @endphp
                                                    <b class="text-success">{{$hotel->personas_s}} Single Room </b><span class="text-info"> | </span>
                                                @endif
                                                @if($hotel->personas_d>0)
                                                    @php
                                                        $total+=$hotel->personas_d*$hotel->precio_d;
                                                        $total_book+=$hotel->personas_d*$hotel->precio_d_r;
                                                        $cadena_total.="<p>Double: ".$hotel->personas_d." x ".($hotel->precio_d)." =".($hotel->personas_d*$hotel->precio_d)."</p>";
                                                        $cadena_total_book.="<p>Double: ".$hotel->personas_d." x ".($hotel->precio_d_r)." =".($hotel->personas_d*$hotel->precio_d_r)."</p>";
                                                        $sumatotal_v+=$hotel->personas_d*$hotel->precio_d;
{{--                                                        $sumatotal_v_r+=$hotel->personas_d*$hotel->precio_d_r;--}}
                                                    @endphp
                                                    <b class="text-success">{{$hotel->personas_d}} Double Room </b><span class="text-info"> | </span>
                                                @endif
                                                @if($hotel->personas_m>0)
                                                    @php
                                                        $total+=$hotel->personas_m*$hotel->precio_m;
                                                        $total_book+=$hotel->personas_m*$hotel->precio_m_r;
                                                        $cadena_total.="<p>Matrimonial: ".$hotel->personas_m." x ".($hotel->precio_m)." =".($hotel->personas_m*$hotel->precio_m)."</p>";
                                                        $cadena_total_book.="<p>Matrimonial: ".$hotel->personas_m." x ".($hotel->precio_m_r)." =".($hotel->personas_m*$hotel->precio_m_r)."</p>";
                                                        $sumatotal_v+=$hotel->personas_m*$hotel->precio_m;
{{--                                                        $sumatotal_v_r+=$hotel->personas_m*$hotel->precio_m_r;--}}
                                                    @endphp
                                                    <b class="text-success">{{$hotel->personas_m}} Matrimonial Room </b><span class="text-info"> | </span>
                                                @endif
                                                @if($hotel->personas_t>0)
                                                    @php
                                                        $total+=$hotel->personas_t*$hotel->precio_t;
                                                        $total_book+=$hotel->personas_t*$hotel->precio_t_r;
                                                        $cadena_total.="<p>Triple: ".$hotel->personas_t." x ".($hotel->precio_t)." =".($hotel->personas_t*$hotel->precio_t)."</p>";
                                                        $cadena_total_book.="<p>Triple: ".$hotel->personas_t." x ".($hotel->precio_t_r)." =".($hotel->personas_t*$hotel->precio_t_r)."</p>";
                                                        $sumatotal_v+=$hotel->personas_t*$hotel->precio_t;
{{--                                                        $sumatotal_v_r+=$hotel->personas_t*$hotel->precio_t_r;--}}
                                                    @endphp
                                                    <b class="text-success">{{$hotel->personas_t}} Triple Room </b><span class="text-info"> | </span>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <p><i class="fa fa-users" aria-hidden="true"></i> {{$total}} $
                                                    <a id="hpropover_{{$hotel->id}}" data-toggle="popover" title="Detalle" data-content="{{$cadena_total}}"> <i class="fa fa-calculator text-primary" aria-hidden="true"></i></a>
                                                </p>
                                            </td>
                                            {{--<td class="text-right">@if($servicios->precio_grupo==1){{$servicios->precio*2}}@else {{$servicios->precio}}@endif x {{$cotizacion->nropersonas}} = @if($servicios->precio_grupo==1){{$servicios->precio*2*$cotizacion->nropersonas}}@else {{$servicios->precio*$cotizacion->nropersonas}}@endif $</td>--}}
                                            @php
                                                $sumatotal_v_r+=$total_book
                                            @endphp
                                            <td class="text-right">
                                                <p> {{$total_book}} $
                                                    <a id="h_rpropover_{{$hotel->id}}" data-toggle="popover" title="Detalle" data-content="{{$cadena_total_book}}"> <i class="fa fa-calculator text-primary" aria-hidden="true"></i></a>
                                                </p>
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
                                                <form class="form-inline" action="{{route('add_cod_verif_hotel_path')}}" method="post">
                                                    <div class="row">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="id" value="{{$hotel->id}}">
                                                        <input type="hidden" name="coti_id" value="{{$cotizacion->id}}">
                                                        <div class="col-lg-12">
                                                            <div class="input-group">
                                                                <input class="form-control" type="text" id="code_{{$hotel->id}}" name="code_{{$hotel->id}}" value="{{$hotel->codigo_verificacion}}">
                                                                <span class="input-group-btn">
                                                                     <button type="submit" class="btn btn-{{$codigo_ho}}"><i class="fa fa-{{$icon_ho}}" aria-hidden="true"></i></button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <form class="form-inline" action="{{route('add_hora_hotel_path')}}" method="post">
                                                    <div class="row">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="id" value="{{$hotel->id}}">
                                                        <input type="hidden" name="coti_id" value="{{$cotizacion->id}}">
                                                        <div class="col-lg-12">
                                                            <div class="input-group">
                                                                <input class="form-control" type="time" id="hora_{{$hotel->id}}" name="hora_{{$hotel->id}}" value="{{$hotel->hora_llegada}}">
                                                                <span class="input-group-btn">
                                                                     <button type="submit" class="btn btn-{{$codigo_hora}}"><i class="fa fa-{{$icon_hora}}" aria-hidden="true"></i></button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                @if($hotel->proveedor)
                                                    {{$hotel->proveedor->razon_social}}
                                                @else
                                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal_h_{{$hotel->id}}">
                                                        Proveedor
                                                    </button>
                                                    <div class="modal fade" id="myModal_h_{{$hotel->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form action="{{route('asignar_proveedor_hotel_path')}}" method="post">
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
                                                                                                <input class="grupo" type="radio" name="precio[]" value="{{$cotizacion->id}}_{{$hotel->id}}_{{$hotel_proveedor_->proveedor_id}}_{{$hotel_proveedor_->id}}">
                                                                                                <b>{{$hotel_proveedor_->proveedor->razon_social}} | {{$hotel_proveedor_->estrellas}}<i class="fa fa-star text-warning" aria-hidden="true"></i></>
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

                                                                                        </div>
                                                                                    </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        {{csrf_field()}}
                                                                        <input type="hidden" name="id" value="{{$hotel->id}}">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                            </td>
                                            <td>
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