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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">Lista de opraciones de <span class="bg-primary text-15">{{fecha_peru($desde)}}</span> a <span class="bg-primary text-15">{{fecha_peru($hasta)}}</span></div>
            <!-- Table -->
            <table class="table table-striped table-responsive table-bordered table-hover">
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
                        <td>SERVICIO</td>
                        <td>HOTEL</td>
                        <td>ROOM</td>
                        <td>MOV</td>
                        <td>GUIA</td>
                        <td>TRF</td>
                        <td>OBSERVACIONES</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($cotizaciones->where('confirmado_r','ok') as $cotizacion)
                    @foreach($cotizacion->paquete_cotizaciones->where('estado','2') as $pqts)
                        @foreach($pqts->itinerario_cotizaciones->sortby('fecha') as $itinerario)
                            @foreach($itinerario->itinerario_servicios->sortby('hora_llegada') as $servicio)
                                {{--<p>{{$itinerario->fecha}} {{$servicio->nombre}} {{$servicio->hora_llegada}}</p>--}}
                                <tr class="success">
                                    <td>{{$itinerario->fecha}}</td>
                                    <td>{{$cotizacion->nropersonas}}</td>
                                    <td>{{$servicio->nombre}}</td>
                                    <td>{{$cotizacion->web}}</td>
                                    <td>S/P</td>
                                    <td>ID</td>
                                    <td>DESTINO</td>
                                    <td>{{$servicio->hora_llegada}}</td>
                                    <td>SERVICIO</td>
                                    <td>HOTEL</td>
                                    <td>ROOM</td>
                                    <td>MOV</td>
                                    <td>GUIA</td>
                                    <td>TRF</td>
                                    <td>OBSERVACIONES</td>
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