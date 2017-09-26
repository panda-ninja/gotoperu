@extends('layouts.admin.contabilidad')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Contabilidad</li>
            <li class="active">Reservas confirmadas</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <label for="">Desde:</label>
            <input type="text" name="fecha_desde" value="{{date("Y-m-d")}}">
        </div>
        <div class="col-lg-6">

        </div>
    </div>
    {{--<div class="row">--}}
        {{--<div class="col-md-12">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-body">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-12">--}}
                            {{--@foreach($cotizacion->cotizaciones_cliente as $clientes)--}}
                                {{--@if($clientes->estado==1)--}}
                                    {{--<h1 class="panel-title pull-left" style="font-size:30px;">Hidalgo <small>hidlgo@gmail.com</small></h1>--}}
                                    {{--<h2 class="panel-title pull-left" style="font-size:30px;">{{$clientes->cliente->nombres}} {{$clientes->cliente->apellidos}} x {{$cotizacion->nropersonas}} {{date_format(date_create($cotizacion->fecha), ' l jS F Y')}}</h2>--}}
                                    {{--<b class="text-warning padding-left-10"> (X{{$cotizacion->nropersonas}})</b>--}}
                                    {{--@if($cotizacion->nropersonas==1)--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                    {{--@elseif($cotizacion->nropersonas==2)--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                    {{--@elseif($cotizacion->nropersonas==3)--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                    {{--@elseif($cotizacion->nropersonas==4)--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                    {{--@elseif($cotizacion->nropersonas==5)--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                    {{--@elseif($cotizacion->nropersonas==6)--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                    {{--@elseif($cotizacion->nropersonas==7)--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                    {{--@elseif($cotizacion->nropersonas==8)--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--<i class="fa fa-male fa-2x"></i>--}}
                                    {{--@endif--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                            {{--<i class="fa fa-check text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Hidalgo esta activo"></i>--}}
                            {{--<div class="dropdown pull-right">--}}
                                {{--<button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">--}}
                                    {{--Opciones--}}
                                    {{--<span class="caret"></span>--}}
                                {{--</button>--}}
                                {{--<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">--}}
                                    {{--<li><a href="?page=update"><i class="fa fa-fw fa-database" aria-hidden="true"></i> Actualizar Datos</a></li>--}}
                                    {{--<li><a href="#"><i class="fa fa-fw fa-check" aria-hidden="true"></i> Friends</a></li>--}}
                                    {{--<li><a href="#">Work</a></li>--}}
                                    {{--<li role="separator" class="divider"></li>--}}
                                    {{--<li><a href="#"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> Add a new aspect</a></li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-12 margin-top-20">--}}
                            {{--<div class="progress">--}}

                                {{--<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">--}}
                                    {{--Datos del pasajero 60%--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="col-md-12">--}}
                            {{--<span class="pull-left pax-nav">--}}
                                {{--<b>Travel date: no se</b>--}}
                            {{--</span>--}}
                            {{--<span class="pull-right">--}}
                                 {{--<a href="#" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-lg fa-ban" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Ignore"></i></a>--}}
                            {{--</span>--}}
                        {{--</div>--}}


                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<hr>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4 class="text-right">
                        <a href="#" style="text-decoration:none;">
                            <strong class="text-warning text-25">Pending: 23.00$</strong>
                        </a>
                    </h4>
                    <hr>
                    <table class="table table-bordered">
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
                        @foreach($cotizaciones  as $cotizacion)
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
                                        <td colspan="2"><b class="text-primary">Day {{$itinerario->dias}} : {{date("d-m-Y",strtotime($itinerario->fecha))}}</b></td>
                                        <td colspan="6"></td>
                                    </tr>
                                    @foreach($itinerario->itinerario_servicios as $servicios)
                                        <tr>
                                            <td></td>
                                            <td>{{$servicios->id}} {{$servicios->nombre}}</td>
                                            <td class="text-right">@if($servicios->precio_grupo==1){{$servicios->precio*2}}@else {{$servicios->precio}}@endif x {{$cotizacion->nropersonas}} = @if($servicios->precio_grupo==1){{$servicios->precio*2*$cotizacion->nropersonas}}@else {{$servicios->precio*$cotizacion->nropersonas}}@endif $</td>
                                            <td class="text-right">{{$servicios->precio_proveedor}} $</td>
                                            @if($servicios->precio_c==0)
                                                @php
                                                    $precio=$servicios->precio_proveedor;
                                                @endphp
                                            @else
                                                @php
                                                    $precio=$servicios->precio_c;
                                                @endphp
                                            @endif
                                            <td><input id="precio_c_{{$servicios->id}}" class="form-control" type="number" value="{{$precio}}" step="0.01" min="0"></td>
                                            <td>{{$servicios->codigo_verificacion}}</td>
                                            <td>
                                                @if($servicios->itinerario_proveedor)
                                                    {{$servicios->itinerario_proveedor->razon_social}}
                                                @else
                                                    No asignado
                                                @endif
                                            </td>
                                            <th><input class="form-control" type="date" id="fecha_pago_{{$servicios->id}}" value="{{date("Y-m-d")}}"></th>
                                            <th>
                                                {{csrf_field()}}
                                                @if($servicios->precio_c>0)
                                                    <button id="servicio_{{$servicios->id}}" type="button" class="btn btn-success">confirmada</button>
                                                @else
                                                    <button id="servicio_{{$servicios->id}}" type="button" class="btn btn-primary" onclick="confirmar_fecha('{{$servicios->id}}')">Pendiente</button>
                                                @endif
                                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal_{{$servicios->id}}">
                                                    <i class="fa fa-usd" aria-hidden="true"></i> Pagar
                                                </button>
                                                <div class="modal fade" id="myModal_{{$servicios->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form id="fo_{{$servicios->id}}" name="fo_{{$servicios->id}}" action="{{route('pagar_proveedor_path')}}" method="post">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel">Pago del servicio</h4>
                                                                </div>
                                                                <div class="modal-body clearfix">
                                                                    <div class="col-md-12">
                                                                        <h4 class="text-success">{{$servicios->nombre}}</h4>
                                                                        <table id="for_{{$servicios->id}}">
                                                                            <tr>
                                                                                <td class="col-lg-2">Total:</td>
                                                                                <td class="col-lg-2" id="total_{{$servicios->id}}">{{$servicios->precio_c}}</td>
                                                                                <td class="col-lg-8"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="col-lg-2">a pagar:</td>
                                                                                <td class="col-lg-3"><input type="number" min="0" max="{{$servicios->precio_c}}"  class="form-control" name="a_cuenta" id="serv_acta_{{$servicios->id}}" placeholder="Monto $" value="{{$servicios->precio_c}}" onchange="calcular_saldo({{$servicios->id}})">
                                                                                </td>
                                                                                <td class="col-lg-7"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="col-lg-2">Saldo:</td>
                                                                                <td class="col-lg-2">
                                                                                    <input type="text" class="form-control" name="saldo" id="saldo_{{$servicios->id}}" value="0" readonly></td>
                                                                                <td class="col-lg-2 hide" id="ifecha_pago_{{$servicios->id}}"><input type="date" id="prox_fecha_{{$servicios->id}}" name="prox_fecha" class="form-control"></td>
                                                                                <td class="col-lg-6"></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                    <div id="result_{{$servicios->id}}" class="text-15"></div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    {{csrf_field()}}
                                                                    <input type="hidden" name="itineraio_servicios_id" value="{{$servicios->id}}">
                                                                    <input type="hidden" name="total" id="itotal_{{$servicios->id}}" value="{{$servicios->precio_c}}">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary" onclick="enviar_form('{{$servicios->id}}')">Save changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endif
                        @endforeach
                        @endforeach
                        </tbody>
                        <tbody>
                        <tr>
                            <td colspan="2"><b>Total</b></td>
                            <td class="text-right text-18 text-warning"><b>1322.00 $</b></td>
                            <td class="text-right text-18 text-info"><b>343.00 $</b></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@stop