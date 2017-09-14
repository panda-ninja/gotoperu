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
                                        @if($cotizacion->nropersonas==1)
                                            <i class="fa fa-male fa-2x"></i>
                                        @elseif($cotizacion->nropersonas==2)
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                        @elseif($cotizacion->nropersonas==3)
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                        @elseif($cotizacion->nropersonas==4)
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                        @elseif($cotizacion->nropersonas==5)
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                        @elseif($cotizacion->nropersonas==6)
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                        @elseif($cotizacion->nropersonas==7)
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                        @elseif($cotizacion->nropersonas==8)
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                            <i class="fa fa-male fa-2x"></i>
                                        @endif
                                    @endif
                            @endforeach
                            <i class="fa fa-check text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Hidalgo esta activo"></i>
                            <div class="dropdown pull-right">
                                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Opciones
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="?page=update"><i class="fa fa-fw fa-database" aria-hidden="true"></i> Actualizar Datos</a></li>
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

                        <div class="col-md-12">
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
                    <h4 class="text-right">
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
                                <th>Math Price</th>
                                <th>Real Price</th>
                                <th>Verification Code</th>
                                <th>Provider</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
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
                                        <td ><b class="text-primary">Day {{$itinerario->dias}}</b></td>
                                        <td colspan="7"></td>
                                    </tr>

                                    @foreach($itinerario->itinerario_servicios as $servicios)
                                        <tr>
                                            <td></td>
                                            <td>{{$servicios->id}} {{$servicios->nombre}}</td>
                                            <td class="text-right"><p class="@if($servicios->precio_grupo==1){{'hide'}}@endif"><i class="fa fa-male" aria-hidden="true"></i> {{$servicios->precio}} $</p><p class="@if($servicios->precio_grupo==0){{'hide'}}@endif"><i class="fa fa-users" aria-hidden="true"></i> {{$servicios->precio*$cotizacion->nropersonas*2}} $</p></td>
                                            <td class="text-right">@if($servicios->precio_grupo==1){{$servicios->precio*2}}@else {{$servicios->precio}}@endif x {{$cotizacion->nropersonas}} = @if($servicios->precio_grupo==1){{$servicios->precio*2*$cotizacion->nropersonas}}@else {{$servicios->precio*$cotizacion->nropersonas}}@endif $</td>
                                            <td class="text-right">{{$servicios->precio_proveedor}} $</td>
                                            <td>Code verificacion</td>
                                            <td>
                                            @if($servicios->itinerario_proveedor)
                                                {{$servicios->itinerario_proveedor->razon_social}}
                                                    {{--@foreach($$proveedores as $proveedor_)--}}
                                                    {{--{{dd($servicios_->itinerario_proveedor)}}--}}
                                                    {{--@if($servicios->itinerario_proveedor->proveedor_id=$proveedor->id)--}}
                                                        {{--{{$proveedor->razon_social}}--}}
                                                    {{--@endif--}}
                                                {{--@endforeach--}}
                                            @else
                                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal_{{$servicios->id}}">
                                                    Proveedor
                                                    </button>
                                                    <div class="modal fade" id="myModal_{{$servicios->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form action="{{route('asignar_proveedor_path')}}" method="post">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
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
                                                                                    @if(($servicios->precio*$valor) < $producto->precio_costo)
                                                                                    <div class="col-md-12">
                                                                                        <div class="checkbox11">
                                                                                            <label class="text-danger">
                                                                                                <input class="grupo" type="radio" name="precio[]" value="{{$cotizacion->id}}_{{$servicios->id}}_{{$producto->proveedor->id}}_{{$producto->precio_costo}}">
                                                                                                @if($producto->precio_grupo==1){{$producto->precio_costo*2}}@else{{$producto->precio_costo}} @endif $ <span class="text-primary">by {{$producto->proveedor->razon_social}}</span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    @else
                                                                                    <div class="col-md-12">
                                                                                        <div class="checkbox11">
                                                                                            <label class="text-green-goto">
                                                                                                <input class="grupo" type="radio" name="precio[]" value="{{$cotizacion->id}}_{{$servicios->id}}_{{$producto->proveedor->id}}_{{$producto->precio_costo}}">
                                                                                                @if($producto->precio_grupo==1){{$producto->precio_costo*2}}@else{{$producto->precio_costo}} @endif $ <span class="text-primary">by {{$producto->proveedor->razon_social}}</span>
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
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
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

                                @endforeach
                            @endif
                        @endforeach

                            {{--<tr>--}}
                                {{--<td rowspan="4"><b>Day 1</b></td>--}}
                            {{--</tr>--}}
                            {{--<tr>--}}
                                {{--<td>Transfers</td>--}}
                                {{--<td class="text-right">1322.00 $</td>--}}
                                {{--<td class="text-right">1234.00 $</td>--}}
                                {{--<td>dfhdklhj</td>--}}
                                {{--<td>Romario</td>--}}
                                {{--<td><i class="fa fa-check fa-2x text-success"></i></td>--}}
                            {{--</tr>--}}
                            {{--<tr>--}}
                                {{--<td>Transfers</td>--}}
                                {{--<td class="text-right">1322.00 $</td>--}}
                                {{--<td class="text-right">343.00 $</td>--}}
                                {{--<td>dfhdklhj</td>--}}
                                {{--<td>--}}
                                    {{--<a href="" class="btn btn-sm btn-warning">Proveedor</a>--}}
                                    {{--<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal">--}}
                                        {{--Proveedor--}}
                                    {{--</button>--}}
                                {{--</td>--}}
                                {{--<td><i class="fa fa-warning fa-2x text-warning"></i></td>--}}
                                {{--<!-- Modal -->--}}


                            {{--</tr>--}}

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