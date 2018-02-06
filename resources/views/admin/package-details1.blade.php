@extends('layouts.admin.admin')
@section('content')
    @if(isset($id_serv))
        @php
            $id_serv=$id_serv;
        @endphp
    @else
        @php
            $id_serv='';
        @endphp
    @endif
    <script type="text/JavaScript">
        window.onload=new function() {if (window.location.href.indexOf('#')==-1) window.location.href='#lista_servicios_{{$id_serv}}';}
    </script>
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
            @php
                $s=0;
                $d=0;
                $m=0;
                $t=0;
            @endphp
            @foreach($cotizaciones as $cotizacion)
                <p><b>Pagina de origen {{$cotizacion->web}}</b></p>
                <b class="text-warning text-25">{{$cotizacion->nropersonas}} PAXS {{$cotizacion->star_2}}{{$cotizacion->star_3}}{{$cotizacion->star_4}}{{$cotizacion->star_5}} STARS:</b>
                @foreach($cotizacion->paquete_cotizaciones->where('id',$paquete_precio_id) as $paquete)
                    @foreach($paquete->paquete_precios as $precio)
                        <b class="text-unset text-20">
                            @if($precio->personas_s>0)
                                S |
                                @php
                                    $s=1;
                                @endphp
                            @endif
                            @if($precio->personas_d>0)
                                D |
                                @php
                                    $d=1;
                                @endphp
                            @endif
                            @if($precio->personas_m>0)
                                M |
                                @php
                                    $m=1;
                                @endphp
                            @endif
                            @if($precio->personas_t>0)
                                T
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
            <div class="col-lg-1 caja_paso_noactivo text-30 text-center"><b>2</b></div>
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
    $cotizacion_id='';
    @endphp
        @foreach($cotizaciones as $cotizacion)
            @php
                $cotizacion_id=$cotizacion->id;
            @endphp
            @foreach($cotizacion->paquete_cotizaciones->where('id',$paquete_precio_id) as $paquete)
                @if($paquete->id==$paquete_precio_id)
                    @foreach($paquete->itinerario_cotizaciones as $itinerario)
                        <div class="row caja_items">
                            <div class="col-lg-1 caja_dia_indice">
                                DAY {{$itinerario->dias}}
                            </div>
                            <div class="col-lg-5">
                                <div class="row caja_dia">
                                    <div class="col-lg-7">
                                        {{$itinerario->titulo}}
                                    </div>
                                    <div class="col-lg-1 @if($s==0) hide @endif">S</div>
                                    <div class="col-lg-1 @if($d==0) hide @endif">D</div>
                                    <div class="col-lg-1 @if($m==0) hide @endif">M</div>
                                    <div class="col-lg-1 @if($t==0) hide @endif">T</div>
                                    <div class="col-lg-2 hide"></div>
                                </div>
                                <div class="row caja_detalle">


                                    @foreach($itinerario->itinerario_servicios as $servicios)
                                        @php
                                            $rango='';
                                            $preciom=0;
                                        @endphp
                                        {{--@if($servicios->precio_grupo==1)--}}
                                            {{--@php--}}
                                                {{--$precio_iti+=($servicios->precio/2)/$cotizacion->nropersonas;--}}
                                                {{--$preciom=($servicios->precio/2)/$cotizacion->nropersonas;--}}
                                            {{--@endphp--}}
                                        {{--@else--}}
                                        @if($servicios->min_personas<= $cotizacion->nropersonas&&$cotizacion->nropersonas <=$servicios->max_personas)

                                        @else
                                            @if($servicios->servicio->grupo=='MOVILID')
                                                @php
                                                    $rango=' text-danger';
                                                @endphp
                                            @endif
                                        @endif

                                        @if($servicios->precio_grupo==1)
                                        @php
                                            $precio_iti+=round($servicios->precio/$cotizacion->nropersonas,1);
                                                $preciom=round($servicios->precio/$cotizacion->nropersonas,1);
                                        @endphp
                                        @else
                                            @php
                                                $precio_iti+=round($servicios->precio,1);
                                                $preciom=round($servicios->precio,1);
                                            @endphp
                                        @endif
                                        {{--@endif--}}
                                        <div class="row" id="lista_servicios_{{$servicios->id}}">
                                            <div class="col-lg-7">
                                                <div class="row">
                                                    <div class="col-lg-10{{$rango}}">
                                                        @if($servicios->servicio->grupo=='TOURS')
                                                            <b class="text-primary text-13"><i class="fa fa-map-o" aria-hidden="true"></i></b>
                                                        @endif
                                                        @if($servicios->servicio->grupo=='MOVILID')
                                                            <b class="text-primary text-13"><i class="fa fa-bus" aria-hidden="true"></i></b>
                                                        @endif
                                                        @if($servicios->servicio->grupo=='REPRESENT')
                                                            <b class="text-primary text-13"><i class="fa fa-users" aria-hidden="true"></i></b>
                                                        @endif
                                                        @if($servicios->servicio->grupo=='ENTRANCES')
                                                            <b class="text-primary text-13"><i class="fa fa-ticket" aria-hidden="true"></i></b>
                                                        @endif
                                                        @if($servicios->servicio->grupo=='FOOD')
                                                            <b class="text-primary text-13"><i class="fa fa-cutlery" aria-hidden="true"></i></b>
                                                        @endif
                                                        @if($servicios->servicio->grupo=='TRAINS')
                                                            <b class="text-primary text-13"><i class="fa fa-train" aria-hidden="true"></i></b>
                                                        @endif
                                                        @if($servicios->servicio->grupo=='FLIGHTS')
                                                            <b class="text-primary text-13"><i class="fa fa-plane" aria-hidden="true"></i></b>
                                                        @endif
                                                        @if($servicios->servicio->grupo=='OTHERS')
                                                            <b class="text-primary text-13"><i class="fa fa-question" aria-hidden="true"></i></b>
                                                        @endif
                                                        {{$servicios->nombre}}
                                                        @if($servicios->servicio->grupo=='MOVILID')
                                                                <b class="text-primary text-12">{{$servicios->servicio->tipoServicio}} [{{$servicios->min_personas}} - {{$servicios->max_personas}}] p.p.</b>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 @if($s==0) hide @endif">$<input type="hidden" class="precio_servicio_s" value="{{explode('.00',$preciom)[0]}}">{{explode('.00',$preciom)[0]}}</div>
                                            <div class="col-lg-1 @if($d==0) hide @endif">$<input type="hidden" class="precio_servicio_d" value="{{explode('.00',$preciom)[0]}}">{{explode('.00',$preciom)[0]}}</div>
                                            <div class="col-lg-1 @if($m==0) hide @endif">$<input type="hidden" class="precio_servicio_d" value="{{explode('.00',$preciom)[0]}}">{{explode('.00',$preciom)[0]}}</div>
                                            <div class="col-lg-1 @if($t==0) hide @endif">$<input type="hidden" class="precio_servicio_t" value="{{explode('.00',$preciom)[0]}}">{{explode('.00',$preciom)[0]}}</div>
                                            <div class="col-lg-1">
                                                <a class="btn" data-toggle="modal" data-target="#modal_new_destination1_{{$servicios->id}}">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </a>
                                                <!-- Modal -->
                                                <div class="modal fade bd-example-modal-lg" id="modal_new_destination1_{{$servicios->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <form action="{{route('step1_edit_path', $servicios->id)}}" method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="_method" value="patch">
                                                                <input type="hidden" name="id_cotizacion" value="{{$cotizacion->id}}">
                                                                <input type="hidden" name="id_client" value="{{$cliente->id}}">
                                                                <input type="hidden" name="id_paquete" value="{{$paquete->id}}">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Editar Servicio</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="box-services-field">

                                                                    @php
                                                                        $grupo='';
                                                                        $loca='';
                                                                    @endphp
                                                                    @foreach($m_servicios->where('id',$servicios->m_servicios_id) as $servicio)
                                                                        @php
                                                                            $grupo=$servicio->grupo;
                                                                            $loca=$servicio->localizacion;
                                                                        @endphp
                                                                    @endforeach
                                                                    @foreach($m_servicios->where('grupo',$grupo)->where('localizacion',$loca) as $servicio)
                                                                            {{--{{$cotizacion->nropersonas}}  -  {{$servicio->max_personas}}--}}
                                                                        @if($servicio->min_personas<=$cotizacion->nropersonas AND $cotizacion->nropersonas <= $servicio->max_personas)
                                                                                @php
                                                                                    $precio_simgle=0;
                                                                                @endphp
                                                                                @if($servicio->precio_grupo==1)
                                                                                    @php
                                                                                        $precio_simgle=round($servicio->precio_venta/$cotizacion->nropersonas,1);
                                                                                    @endphp
                                                                                @else
                                                                                    @php
                                                                                        $precio_simgle=round($servicio->precio_venta,1);
                                                                                    @endphp
                                                                                @endif
                                                                                <div class="checkbox1">
                                                                                    <label>
                                                                                        <input type="radio" name="op_services" id="serv_{{$servicio->id}}" value="{{$servicio->id}}" @if($servicios->codigo == $servicio->codigo) checked @endif>
                                                                                        {{$servicio->nombre}}<br>
                                                                                        <span class="padding-left-10 text-primary">
                                                                                        @if($grupo=='TOURS')
                                                                                            <i class="fa fa-map-o text-info" aria-hidden="true"></i>
                                                                                        @endif
                                                                                        @if($grupo=='MOVILID')
                                                                                            <i class="fa fa-bus text-warning" aria-hidden="true"></i>
                                                                                        @endif
                                                                                            @if($grupo=='REPRESENT')
                                                                                                <i class="fa fa-users text-success" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupo=='ENTRANCES')
                                                                                                <i class="fa fa-ticket text-warning" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupo=='FOOD')
                                                                                                <i class="fa fa-cutlery text-danger" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupo=='TRAINS')
                                                                                                <i class="fa fa-train text-info" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupo=='FLIGHTS')
                                                                                                <i class="fa fa-plane text-primary" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            @if($grupo=='OTHERS')
                                                                                                <i class="fa fa-question text-success" aria-hidden="true"></i>
                                                                                            @endif
                                                                                            {{$servicio->tipoServicio}}
                                                                                        </span><b class="text-warning"> | </b><span class="text-green-goto">${{$precio_simgle}}</span><b class="text-warning"> | </b><span class="text-primary">[{{$servicio->min_personas}} - {{$servicio->max_personas}}] person</span>
                                                                                    </label>
                                                                                </div>
                                                                        @endif
                                                                    @endforeach

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
                                            </div>
                                            <div class="col-lg-1">
                                                <b class="text-danger puntero" onclick="borrar_serv_quot_paso1('{{$servicios->id}}','{{$servicios->nombre}}')">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </b>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
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
                                                $precio_hotel_t+=$hotel->precio_t/3;
                                            @endphp
                                        @endif
                                    <div id="caja_detalle_{{$hotel->id}}" class="row caja_detalle_hotel margin-bottom-15">
                                    <div class="col-lg-7">
                                            <div class="row">
                                                <div class="col-lg-10">HOTEL</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 @if($hotel->personas_s==0) hide @endif">${{round(explode('.00',$hotel->precio_s)[0],2)}}</div>
                                        <div class="col-lg-1 @if($hotel->personas_d==0) hide @endif">${{round(explode('.00',$hotel->precio_d)[0]/2,2)}}</div>
                                        <div class="col-lg-1 @if($hotel->personas_m==0) hide @endif">${{round(explode('.00',$hotel->precio_m)[0]/2,2)}}</div>
                                        <div class="col-lg-1 @if($hotel->personas_t==0) hide @endif">${{round(explode('.00',$hotel->precio_t)[0]/3,2)}}</div>
                                        <input type="hidden" class="precio_servicio_s_h" value="{{explode('.00',$hotel->precio_s)[0]}}">
                                        <input type="hidden" class="precio_servicio_d_h" value="{{explode('.00',$hotel->precio_d)[0]/2}}">
                                        <input type="hidden" class="precio_servicio_m_h" value="{{explode('.00',$hotel->precio_m)[0]/2}}">
                                        <input type="hidden" class="precio_servicio_t_h" value="{{explode('.00',$hotel->precio_t)[0]/3}}">
                                        <div class="col-lg-1">
                                            <a class="btn" data-toggle="modal" data-target="#modal_new_destinationh_{{$hotel->id}}">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            <div class="modal fade bd-example-modal-m" id="modal_new_destinationh_{{$hotel->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-m" role="document">
                                                    <div class="modal-content">
                                                        <form action="{{route('step1_edit_hotel_path', $hotel->id)}}" method="post" enctype="multipart/form-data">
                                                            <input type="hidden" name="_method" value="patch">
                                                            <input type="hidden" name="id_cotizacion" value="{{$cotizacion->id}}">
                                                            <input type="hidden" name="id_client" value="{{$cliente->id}}">
                                                            <input type="hidden" name="id_paquete" value="{{$paquete->id}}">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Editar Precio hotel</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row  caja_dia">
                                                                    <div class="col-lg-4">
                                                                        <div class="row">
                                                                            <div class="col-lg-10">Acomodacion</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-2 @if($hotel->personas_s==0) hide @endif">S</div>
                                                                    <div class="col-lg-2 @if($hotel->personas_d==0) hide @endif">D</div>
                                                                    <div class="col-lg-2 @if($hotel->personas_m==0) hide @endif">M</div>
                                                                    <div class="col-lg-2 @if($hotel->personas_t==0) hide @endif">T</div>
                                                                </div>
                                                                <div class="row  caja_detalle_hotel">
                                                                    <div class="col-lg-4">
                                                                        <div class="row">
                                                                            <div class="col-lg-10">HOTEL</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-2 @if($hotel->personas_s==0) hide @endif">
                                                                        <input class="form-control" type="number" name="precio_s" value="{{explode('.00',$hotel->precio_s)[0]/1}}">
                                                                    </div>
                                                                    <div class="col-lg-2 @if($hotel->personas_d==0) hide @endif">
                                                                        <input class="form-control" type="number" name="precio_d" value="{{explode('.00',$hotel->precio_d)[0]/2}}">
                                                                    </div>
                                                                    <div class="col-lg-2 @if($hotel->personas_m==0) hide @endif">
                                                                        <input class="form-control" type="number" name="precio_m" value="{{explode('.00',$hotel->precio_m)[0]/2}}">
                                                                    </div>
                                                                    <div class="col-lg-2 @if($hotel->personas_t==0) hide @endif">
                                                                        <input class="form-control" type="number" name="precio_t" value="{{explode('.00',$hotel->precio_t)[0]/3}}">
                                                                    </div>
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
                                        </div>
                                        <div class="col-lg-1 text-right">
                                            <b class="text-right text-danger puntero" onclick="borrar_hotel_quot_paso1('{{$hotel->id}}','{{$itinerario->dias}}')">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </b>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="col-lg-6">
                                <textarea name="" id="" cols="70" rows="8">{{$itinerario->descripcion}}</textarea>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endforeach
        @endforeach
        @php
            $precio_hotel_s+=$precio_iti;
            $precio_hotel_d+=$precio_iti;
            $precio_hotel_m+=$precio_iti;
            $precio_hotel_t+=$precio_iti;
        @endphp
    {{--<form action="{{route('show_step2_path',[$cotizacion_id,$paquete_precio_id,'no'])}}" method="get">--}}
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-1">
                </div>
                <div class="col-lg-5">
                    <div class="row caja_dia">
                        <div class="col-lg-7"><b>COST</b></div>
                        <div class="col-lg-1 text-warning @if($s==0) hide @endif"><b>$<span id="cost_s">{{ceil($precio_hotel_s)}}</span></b></div>
                        <div class="col-lg-1 text-warning @if($d==0) hide @endif"><b>$<span id="cost_d">{{ceil($precio_hotel_d)}}</span></b></div>
                        <div class="col-lg-1 text-warning @if($m==0) hide @endif"><b>$<span id="cost_d">{{ceil($precio_hotel_m)}}</span></b></div>
                        <div class="col-lg-1 text-warning @if($t==0) hide @endif"><b>$<span id="cost_t">{{ceil($precio_hotel_t)}}</span></b></div>
                        <div class="col-lg-2"></div>
                    </div>
                    <div class="col-lg-12 text-right text-warninggit">PRICE PER PERSON</div>
                </div>
                <div class="col-lg-6 text-right">
                    {{csrf_field()}}
                    {{--<input type="hidden" name="paquete_precio_id" value="{{$paquete_precio_id}}">--}}
                    {{--<input type="hidden" name="cotizacion_id" value="{{$cotizacion_id}}">--}}
                    {{--<input type="hidden" name="imprimir" value="no">--}}
                    <a href="{{route('show_step2_path',[$cotizacion_id,$paquete_precio_id,'no'])}}" class="btn btn-warning btn-lg" type="submit" name="create">CREATE</a>
                </div>
            </div>
        </div>
    {{--</form>--}}
    <script>
        $(document).ready(function() {
            calcular_resumen();
        } );
    </script>
@stop