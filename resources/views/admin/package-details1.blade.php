@extends('layouts.admin.admin')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Quotes</li>
            <li class="active">New</li>
        </ol>
    </div>
    {{--<form action="{{route('package_cotizacion_save_path')}}" method="post" id="package_new_path_id">--}}
    <div class="row">
        <div class="col-lg-6">
            <h3>{{$cliente->nombres}} {{$cliente->apellidos}}</h3>
            @foreach($cotizaciones as $cotizacion)
                <b class="text-warning text-25">{{$cotizacion->nropersonas}} PAXS {{$cotizacion->star_2}}{{$cotizacion->star_3}}{{$cotizacion->star_4}}{{$cotizacion->star_5}} STARS:</b>
                @foreach($cotizacion->paquete_cotizaciones as $paquete)
                    @foreach($paquete->paquete_precios as $precio)
                        <b class="text-unset text-20">
                            @if($precio->personas_s>0)
                                SINGLE
                            @endif
                            @if($precio->personas_d>0)
                                DOUBLE
                            @endif
                            @if($precio->personas_m>0)
                                MATRIMONIAL
                            @endif
                            @if($precio->personas_t>0)
                                TRIPLE
                            @endif
                        </b>
                    @endforeach
                @endforeach
            @endforeach
        </div>
        <div class="col-lg-6">
            <div>1</div>
            <div>2</div>
        </div>
    </div>
    @foreach($cotizaciones as $cotizacion)
        @foreach($cotizacion->paquete_cotizaciones as $paquete)
            @foreach($paquete->itinerario_cotizaciones as $itinerario)
                <div class="row">
                    <div class="col-lg-1 caja_dia_indice">
                        DAY {{$itinerario->dias}}
                    </div>
                    <div class="col-lg-5">
                        <div class="row caja_dia">
                            <div class="col-lg-9">{{$itinerario->titulo}}</div>
                            <div class="col-lg-1">S</div>
                            <div class="col-lg-1">D</div>
                            <div class="col-lg-1">T</div>
                        </div>
                        <div class="row caja_detalle">
                            @foreach($itinerario->itinerario_servicios as $servicios)
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-10">{{$servicios->nombre}}</div>
                                        <div class="col-lg-2"><a href="#!"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1">$10</div>
                                <div class="col-lg-1">$20</div>
                                <div class="col-lg-1">$30</div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <textarea name="" id="" cols="40" rows="5">{{$itinerario->descripcion}}</textarea>
                    </div>
                </div>
                {{--@foreach($itinerario->itinerario_servicios as $servicios)--}}
                    {{--{{$servicios->nombre}}--}}
                {{--@endforeach--}}
            @endforeach
        @endforeach
    @endforeach


    {{--</form>--}}
    <script>
        $(document).ready(function() {
            calcular_resumen();
        } );
    </script>
@stop