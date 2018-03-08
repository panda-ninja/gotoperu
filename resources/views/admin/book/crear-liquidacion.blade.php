@extends('layouts.admin.book')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Reservas</li>
            <li>Liquidacion</li>
            <li class="active">Crear Liquidacion</li>
        </ol>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{route('filtrar_liquidacion_reservas_path')}}" method="post">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="txt_name">Desde:</label>
                        <input type="date" class="form-control" id="fecha_ini" name="fecha_ini" value="{{date("Y-m-d")}}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="txt_name">Hasta:</label>
                        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="{{date("Y-m-d")}}">
                    </div>
                </div>
                <div class="col-lg-3 margin-top-25">
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-primary" id="buscar" name="buscar">Buscar</button>
                </div>
            </form>
            <div class="col-lg-12">
                <table class="table table-bordered table-striped table-responsive table-hover">
                    <thead>
                    <tr>
                        <th>FECHA</th>
                        <th>CLASE</th>
                        <th>AD</th>
                        <th>PAX</th>
                        <th>$ AD</th>
                        <th>TOTAL</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($liquidaciones as $liquidacion)
                        @foreach($liquidacion->paquete_cotizaciones as $paquete_cotizacion)
                            @foreach($paquete_cotizacion->itinerario_cotizaciones->where('fecha','>=',$fecha_ini)->where('fecha','<=',$fecha_fin) as $itinerario_cotizacion)
                                @foreach($itinerario_cotizacion->itinerario_servicios->where('clase','BTG') as $itinerario_servicio)
                                    <tr>
                                        <td>{{$itinerario_cotizacion->fecha}}</td>
                                        <td>{{$itinerario_servicio->clase}}</td>
                                        <td>{{$liquidacion->nropersonas}}</td>
                                        <td>
                                            @foreach($liquidacion->cotizaciones_cliente as $cotizaciones_cliente)
                                                {{$cotizaciones_cliente->cliente->nombres}} x {{$liquidacion->nropersonas}}
                                            @endforeach
                                        </td>
                                        <td>${{$itinerario_servicio->precio_proveedor/$liquidacion->nropersonas}}</td>
                                        <td>${{$itinerario_servicio->precio_proveedor}}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
                <div class="col-lg-12 text-right">
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-primary" id="buscar" name="buscar">Enviar liquidacion</button>
                </div>
            </div>
        </div>
    </div>
@stop