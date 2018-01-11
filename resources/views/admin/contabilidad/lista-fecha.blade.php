@extends('layouts.admin.contabilidad')
@section('content')
    <div class="row margin-top-40">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Contabilidad</li>
            <li class="active">Reservas confirmadas</li>
        </ol>
    </div>
    {{--<div class="row">--}}
    {{--<div class="col-md-12">--}}
    {{--<div class="panel panel-default">--}}
    {{--<div class="panel-body">--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-12">--}}

    {{--<h2 class="panel-title pull-left" style="font-size:30px;">hida x 2 2017</h2>--}}
    {{--<b class="text-warning padding-left-10"> (X 6)</b>--}}


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
                    <div class="row">
                        <div class="col-lg-4">
                            <form action="">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Buscar Proveedor">
                                    <span class="input-group-btn"><button class="btn btn-default" type="button">Go!</button></span>
                                </div><!-- /input-group -->
                            </form>
                        </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                    {{--<hr>--}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-9">

                            <table class="table table-condensed table-bordered margin-top-20 table-hover">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-18 text-grey-goto text-center">Proveedor</th>
                                    <th class="text-18 text-grey-goto text-center">Servicio</th>
                                    <th class="text-18 text-grey-goto text-center">Cotización</th>
                                    <th class="text-18 text-grey-goto text-center">Fecha de llegada</th>
                                    <th class="text-18 text-grey-goto text-center">Fecha a Pagar</th>
                                    <th class="text-18 text-grey-goto text-center">Cont. Price</th>
                                    {{--<th class="text-18 text-grey-goto text-center">Pagado</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                {{--@foreach($cotizacion as $cotizaciones)--}}
                                    {{--@foreach($cotizaciones->paquete_cotizaciones as $paquetes)--}}
                                        {{--@foreach($paquetes->itinerario_cotizaciones as $itinerario)--}}
                                            {{--@foreach($itinerario->itinerario_servicios as $servicio)--}}
                                            {{--<tr>--}}
                                                {{--<td class="text-center"><input type="checkbox"></td>--}}
                                                {{--<td><b>{{ucwords(strtolower($servicio->nombre))}}</b></td>--}}
                                                {{--<td><b>{{ucwords(strtolower($servicio->nombre))}}</b></td>--}}
                                                {{--@foreach($cotizaciones->cotizaciones_cliente as $cotizaciones_clientes)--}}
                                                    {{--@foreach($cotizaciones_clientes->cliente as $cliente)--}}
                                                        {{--<td><b>{{ucwords(strtolower($cliente))}}</b></td>--}}
                                                    {{--@endforeach--}}

                                                {{--@endforeach--}}
                                                {{--@if(isset())--}}
                                                    {{--<td><b>{{ucwords(strtolower($cotizaciones->cotizaciones_cliente))}}</b></td>--}}
                                                {{--@else--}}
                                                    {{--<td><b></b></td>--}}
                                                {{--@endif--}}
                                                {{--<td class="text-right"><b>{{$cotizaciones->fecha}}</b></td>--}}
                                                {{--<td class="text-right"><b></b></td>--}}
                                                {{--<td class="text-right"><b><sup><small>$USS</small></sup></b></td>--}}
                                                {{--<td class="text-right"><b>{{$servicio->precio_c}}<sup><small>$USS</small></sup></b></td>--}}
                                                {{--<td class="text-center"><button class="btn btn-primary btn-sm">Pagar</button></td>--}}
                                            {{--</tr>--}}
                                            {{--@endforeach--}}
                                        {{--@endforeach--}}
                                    {{--@endforeach--}}
                                {{--@endforeach--}}

                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-3">
                            <div class="panel panel-default">
                                <div class="panel-body text-center">
                                    <h2 class="text-40"><sup><small>$usd</small></sup><b>5489</b></h2>
                                    <button class="btn btn-info display-block w-100">Seleccionar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<hr>--}}
                </div>
            </div>
        </div>
    </div>
@stop