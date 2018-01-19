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
                                    <input type="date" class="form-control" id="txt_desde" name="txt_desde" required="required" value="{{date('Y-m-d')}}">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="txt_hasta">Hasta</label>
                                    <input type="date" class="form-control" id="txt_hasta" name="txt_hasta" required="required" value="{{date('Y-m-d')}}">
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
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        @foreach($cotizaciones->where('confirmado_r','ok') as $cotizacion)
                            @foreach($cotizacion->paquete_cotizaciones->where('estado','2') as $pqts)
                                @foreach($pqts->itinerario_cotizaciones->sortby('fecha') as $itinerario)
                                    @foreach($itinerario->itinerario_servicios->sortby('hora_llegada') as $servicio)
                                        <p>{{$itinerario->fecha}} {{$servicio->nombre}} {{$servicio->hora_llegada}}</p>
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
@stop