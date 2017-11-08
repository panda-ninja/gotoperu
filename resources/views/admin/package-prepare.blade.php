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
    @php
        $cliente='';
    @endphp

    @foreach($cotizaciones as $cotizacion)
        @foreach($cotizacion->cotizaciones_cliente as $coti_cliente)
            @php
                $cliente=$coti_cliente->cliente->nombres.' '.$coti_cliente->cliente->apellidos;
            @endphp
        @endforeach
    @endforeach
        <div class="row">
        <div class="col-lg-6">
            <h3>{{$cliente}} {{$cliente}}</h3>
            @php
                $s=0;
                $d=0;
                $m=0;
                $t=0;
            @endphp
            @foreach($cotizaciones as $cotizacion)
                <b class="text-warning text-25">{{$cotizacion->nropersonas}} PAXS {{$cotizacion->star_2}}{{$cotizacion->star_3}}{{$cotizacion->star_4}}{{$cotizacion->star_5}} STARS:</b>
                @foreach($cotizacion->paquete_cotizaciones as $paquete)
                    @foreach($paquete->paquete_precios as $precio)
                        <b class="text-unset text-20">
                            @if($precio->personas_s>0)
                                SINGLE
                                @php
                                    $s=1;
                                @endphp
                            @endif
                            @if($precio->personas_d>0)
                                DOUBLE
                                @php
                                    $d=1;
                                @endphp
                            @endif
                            @if($precio->personas_m>0)
                                MATRIMONIAL
                                @php
                                    $m=1;
                                @endphp
                            @endif
                            @if($precio->personas_t>0)
                                TRIPLE
                                @php
                                    $t=1;
                                @endphp
                            @endif
                        </b>
                    @endforeach
                @endforeach
            @endforeach
        </div>
        <div class="col-lg-6">
            <div class="col-lg-2"></div>
            <div class="col-lg-1 caja_paso_activo text-30 text-center"><b>1</b></div>
            <div class="col-lg-1 caja_paso_activo text-30 text-center"><b>2</b></div>
            <div class="col-lg-2"></div>
        </div>
    </div>
    @php
        $nroPersonas=0;
        $nro_dias=0;
        $precio_iti=0;
        $precio_hotel_s=0;
        $precio_hotel_d=0;
        $precio_hotel_m=0;
        $precio_hotel_t=0;
        $plan[1]='PLAN A';
        $plan[2]='PLAN B';
        $plan[3]='PLAN C';
        $plan[4]='PLAN D';
        $plan[5]='PLAN E';
        $plan[6]='PLAN F';
        $plan[7]='PLAN G';
        $pos_plan=1;
        $dias=1;
        $codigo='';
        $destinos1=array();
    @endphp
    {{--{{dd($cotizaciones)}}--}}
    <form action="{{route('editar_cotizacion1_path')}}" method="post">
        @foreach($cotizaciones as $cotizacion)
            @php
                $pos_plan=count($cotizacion->paquete_cotizaciones);
                $dias=$cotizacion->duracion;
            @endphp
            @foreach($cotizacion->paquete_cotizaciones->where('id',$paquete_precio_id) as $paquete)
                @php
                    $codigo=$paquete->codigo
                @endphp
                @foreach($paquete->itinerario_cotizaciones as $itinerario)
                    @foreach($itinerario->itinerario_destinos as $destinos)
                        @php
                            $destinos1[]=$destinos->destino;
                        @endphp
                    @endforeach
                @endforeach
            @endforeach
        @endforeach
        <div class="row">
            <div class="col-lg-6">
                <p class="text-15"><b>{{$plan[$pos_plan]}}</b></p>
                <p class="text-15"><b>{{$dias}} DAYS</b></p>
                <p class="text-15"><b>CODE:{{$codigo}}</b></p>
                @foreach($destinos1 as $destino)
                    <div class="col-md-3">
                        <div class="checkbox1">
                            <label class=" text-unset">
                                <input class="destinospack" type="checkbox" name="destinos[]" checked="checked">
                                {{$destino}}
                            </label>
                        </div>
                    </div>
                @endforeach
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="txt_country">Title</label>
                        <input type="text" class="form-control" id="txt_titulo" name="txt_titulo" placeholder="Titulo">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="txt_country">Description</label>
                        <textarea class="form-control" name="descripcion" id="descripcion" cols="10" rows="5"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="txt_country">Include</label>
                        <textarea class="form-control" name="incluye" id="incluye" cols="10" rows="5"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="txt_country">not Include</label>
                        <textarea class="form-control" name="no_incluye" id="no_incluye" cols="10" rows="5"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                @php
                    $nroPersonas=0;
                    $nro_dias=0;
                    $precio_iti=0;
                    $precio_hotel_s=0;
                    $precio_hotel_d=0;
                    $precio_hotel_m=0;
                    $precio_hotel_t=0;
                    $cotizacion_id='';
                @endphp
                @foreach($cotizaciones as $cotizacion)
                    @foreach($cotizacion->paquete_cotizaciones->where('id',$paquete_precio_id) as $paquete)
                        @foreach($paquete->paquete_precios as $precio)
                            @if($precio->personas_s>0)
                                @php
                                    $s=1;
                                @endphp
                            @endif
                            @if($precio->personas_d>0)
                                @php
                                    $d=1;
                                @endphp
                            @endif
                            @if($precio->personas_m>0)
                                @php
                                    $m=1;
                                @endphp
                            @endif
                            @if($precio->personas_t>0)
                                @php
                                    $t=1;
                                @endphp
                            @endif
                        @endforeach
                        @foreach($paquete->itinerario_cotizaciones as $itinerario)
                            @foreach($itinerario->hotel as $hotel)
                                @if($hotel->personas_s>0)
                                    @php
                                        $precio_hotel_s+=$hotel->precio_s;
                                    @endphp
                                @endif
                                @if($hotel->personas_d>0)
                                    @php
                                        $precio_hotel_d+=$hotel->precio_d/2;
                                    @endphp
                                @endif
                                @if($hotel->personas_m>0)
                                    @php
                                        $precio_hotel_m+=$hotel->precio_m/2;
                                    @endphp
                                @endif
                                @if($hotel->personas_t>0)
                                    @php
                                        $precio_hotel_t+=$hotel->precio_t/2;
                                    @endphp
                                @endif
                            @endforeach
                            <div id="itinerario_" class="caja_itineario">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <b class="dias" id="dias_"+total_Itinerarios+>Dia :{{$itinerario->dias}}</b> {{$itinerario->titulo}}
                                    </div>
                                    <div class="col-lg-3">
                                        <b>$ {{$itinerario->precio}}</b>
                                    </div>
                                </div>
                            </div>
                            @foreach($itinerario->itinerario_destinos as $destinos)
                                @php
                                    $destinos1[]=$destinos->destino;
                                @endphp
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach

                @php
                    $precio_hotel_s+=$precio_iti;
                    $precio_hotel_d+=$precio_iti;
                    $precio_hotel_m+=$precio_iti;
                    $precio_hotel_t+=$precio_iti;
                @endphp
                <div class="col-lg-12">
                    <div class="row ">
                        <div class="col-lg-4">
                            <b CLASS="text-warning text-15">PRICE PER PERSON</b>
                        </div>
                        <div class="col-lg-2 @if($s==0) hide @endif">
                            <b CLASS="text-unset text-15">SINGLE</b>
                        </div>
                        <div class="col-lg-2" @if($d==0) hide @endif>
                            <b CLASS="text-unset text-15">DOUBLE</b>
                        </div>
                        <div class="col-lg-2 @if($m==0) hide @endif">
                            <b CLASS="text-unset text-15">MATRINONIAL</b>
                        </div>
                        <div class="col-lg-2 @if($t==0) hide @endif">
                            <b CLASS="text-unset text-15">TRIPLE</b>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-lg-4">
                            <b CLASS="text-warning text-15">COST</b>
                        </div>
                        <div class="col-lg-2 @if($s==0) hide @endif">
                            <b CLASS="text-unset text-15">$</b>
                        </div>
                        <div class="col-lg-2" @if($d==0) hide @endif>
                            <b CLASS="text-unset text-15">$</b>
                        </div>
                        <div class="col-lg-2 @if($m==0) hide @endif">
                            <b CLASS="text-unset text-15">$</b>
                        </div>
                        <div class="col-lg-2 @if($t==0) hide @endif">
                            <b CLASS="text-unset text-15">$</b>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-lg-4">
                            <b CLASS="text-warning text-15">PROFIT</b>
                        </div>
                        <div class="col-lg-2 @if($s==0) hide @endif">
                            <b CLASS="text-unset text-15">$<span>{{$precio_hotel_s}}</span></b>
                            <b CLASS="text-warning text-15">%</b>
                        </div>
                        <div class="col-lg-2" @if($d==0) hide @endif>
                            <b CLASS="text-unset text-15">$<span>{{$precio_hotel_d}}</span></b>
                            <b CLASS="text-warning text-15">%</b>
                        </div>
                        <div class="col-lg-2 @if($m==0) hide @endif">
                            <b CLASS="text-unset text-15">$<span>{{$precio_hotel_m}}</span></b>
                            <b CLASS="text-warning text-15">%</b>
                        </div>
                        <div class="col-lg-2 @if($t==0) hide @endif">
                            <b CLASS="text-unset text-15">$<span>{{$precio_hotel_t}}</span></b>
                            <b CLASS="text-warning text-15">%</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
    <script>
        $(document).ready(function() {
            calcular_resumen();
        } );
    </script>
@stop