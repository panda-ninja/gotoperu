@extends('layouts.admin')
@section('archivos-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
@stop
@section('archivos-js')
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js")}}"></script>
@stop
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Quotes</li>
            <li class="active">Current</li>
        </ol>
    </div>
    @foreach($paquete as $paquete)
        <div class="text-center ">
            @foreach($cotizacion as $cotizaciones)
                @php $pasajeros = $cotizaciones->nropersonas; @endphp
                @php
                $date = date_create($cotizaciones->fecha);
                $fecha=date_format($date, 'jS F Y');
                @endphp
                @foreach($cotizaciones->cotizaciones_cliente as $cliente_cotizaciones)
                    {{--                {{dd($cliente_cotizaciones->cliente)}}--}}
                    @if($cliente_cotizaciones->estado == 1)
                        @foreach($cotizaciones->cotizaciones_cliente as $cliente_coti)
                            @if($cliente_coti->estado=='1')
                                <b class="text-30 text-green-goto">{{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizaciones->nropersonas}} {{$fecha}}</b>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @endforeach
        </div>
        <div class="text-center">
            <h2><b class="text-orange-goto">Package Travel: {{$paquete->titulo}}</b></h2>
            <p class="text-grey-goto"><b>Package Code:</b> {{$paquete->codigo}} | <b>Package Duration:</b> {{$paquete->duracion}} | <b>Numero de pasajeros:</b> {{$pasajeros}}</p>
        </div>
        {{--<div>--}}
        {{--<p>{{$paquete->descripcion}}</p>--}}
        {{--</div>--}}
        <div>
            <h3 class="text-orange-goto">Outline</h3>
            @foreach($paquete->itinerario_cotizaciones->sortBy('dias') as $itinerario)
                <span class="text-13">Day {{$itinerario->dias}} - {{$itinerario->titulo}}</span><br>
            @endforeach
        </div>
        <div>
            <h3 class="text-orange-goto">Incluye</h3>
            <p>{{$paquete->incluye}}</p>
            <h3 class="text-orange-goto">No Incluye</h3>
            <p>{{$paquete->noincluye}}</p>
            {{--<h3>Opcional</h3>--}}
            {{--<p>{{$paquete->opcional}}</p>--}}
        </div>

        <div>
            <h3 class="no-margin text-orange-goto">Itinerary for days</h3>
            @foreach($paquete->itinerario_cotizaciones->sortBy('dias') as $itinerario)
                <h4 class="text-green-goto">Day {{$itinerario->dias}} - {{$itinerario->titulo}}</h4>
                <p>{{$itinerario->descripcion}}</p>
                @if (Storage::disk('itinerary')->has($itinerario->imagen))
                    <img
                            src="{{route('itinerary_image_path', ['filename' => $itinerario->imagen])}}" class="responsive-img" alt="" width="60%" height="60%">
                @endif

                {{--<img src="{{asset('img/itinerary/'.str_replace(' ','-',$itinerario->titulo).'')}}.jpg" class="responsive-img" alt="">--}}
                <h4>Servicios:</h4>
                <table id="example0" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th data-field="id">Concepto</th>
                        <th data-field="name">Observaciones</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($itinerario->itinerario_servicios as $servicios)
                        <tr>
                            <td class="text-align-left">{{$servicios->nombre}}</td>
                            <td>{{$servicios->observacion}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            @endforeach
        </div>

        <div>
            <h3 class="text-orange-goto"><b>Destinos incluidos:</b></h3>
            @php
                $array_destinos[]=null
            @endphp
            @foreach($paquete->itinerario_cotizaciones as $itinerarios_destino)
                @foreach($itinerarios_destino->itinerario_destinos as $destino)
                    @if(in_array($destino->destino,$array_destinos))
                    @else
                        @php
                            $array_destinos[]=$destino->destino;
                        @endphp
                    @endif
                @endforeach
            @endforeach
            <ul>
                @foreach($array_destinos as $destino)
                    @if($destino!=null)
                        <li>{{$destino}}</li>
                    @endif
                @endforeach
            </ul>
            {{--@foreach($paquete->itinerario_cotizaciones as $itinerarios_destino)--}}
                {{--<ul>--}}
                {{--@foreach($itinerarios_destino->itinerario_destinos as $destino)--}}
                    {{--                    <img src="{{asset('img/destinations/'.$destino->imagen.'')}}" class="margin-bottom-3" width="347" alt="">--}}
                    {{--@if (Storage::disk('destination')->has($destino->imagen))--}}
                    {{--<img--}}
                    {{--src="{{route('destination_image_path', ['filename' => $destino->imagen])}}" class="margin-bottom-3" width="347" alt="">--}}
                    {{--@endif--}}
                    {{--<li>{{$destino->destino}}</li>--}}
                {{--@endforeach--}}
                {{--</ul>--}}
            {{--@endforeach--}}
        </div>

        <div>
            <h3  class="text-orange-goto"><b>Precios:</b></h3>
            <p>Los precios son por persona. La cotizacion fue realizado para <b class="blue-text">{{$pasajeros}} personas</b>.</p>
            @php $servicio = 0; @endphp
            @foreach($paquete->itinerario_cotizaciones as $paquete_itinerario)
                @foreach($paquete_itinerario->itinerario_servicios as $orden_cotizaciones)
                    @php
                        $total = $orden_cotizaciones->precio + $servicio;
                        $servicio = $total;
                    @endphp
                @endforeach
            @endforeach
            @foreach($paquete->paquete_precios as $precio_paquete2)
                @if($paquete->estado==2)
                    @if($precio_paquete2->estado == 2)
                        <div>
                            <h5 class="no-margin"><b>CATEGORIA: {{$precio_paquete2->estrellas}} ESTRELLAS</b></h5>
                            <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Acomodacion</th>
                                    <th class="text-right">Total ($)</th>
                                    <th class="text-right">Estado</th>
                                </tr>
                                @if($precio_paquete2->personas_s > 0)
                                    <tr>
                                        <td class="text-left"><b>Simple</b></td>
                                        <td class="text-right">
                                            @php
                                                $precio_s = (($precio_paquete2->precio_s)* 1) * ($paquete->duracion - 1);
                                                $total_costo = $precio_s + $total;
                                                $total_utilidad = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                            @endphp
                                            {{number_format(ceil($total_utilidad), 2, '.', '')}}
                                        </td>
                                        @if($paquete->estado==1)
                                            @if($precio_paquete2->estado==2)
                                                <td rowspan="3" class="text-center"><a href="#" class="text-success"><i class="fa fa-check-square-o fa-5x" aria-hidden="true"></i></a></td>
                                            @else
                                                <td rowspan="3" class="text-center"><a href="#" class="text-muted"><i class="fa fa-clock-o fa-5x" aria-hidden="true"></i></a></td>
                                            @endif
                                        @else
                                            @if($precio_paquete2->estado==2)
                                                <td rowspan="3" class="text-center"><a href="#" class="text-success"><i class="fa fa-check-square-o fa-5x" aria-hidden="true"></i></a></td>
                                            @else
                                                <td rowspan="3" class="text-center"><a href="#" class="text-muted"><i class="fa fa-clock-o fa-5x" aria-hidden="true"></i></a></td>
                                            @endif
                                        @endif
                                    </tr>
                                    {{--<tr>--}}
                                    {{--<td colspan="2">--}}
                                    {{--<i class="text-11">- {{$precio_paquete2->personas_s}} habitaciones con acomodacion simple, total de pasajeros {{$precio_paquete2->personas_s * 1}}, precio por persona ${{$total_utilidad / ($precio_paquete2->personas_s * 1)}}, numero de dias en hotel {{$paquete->duracion - 1}}</i>--}}
                                    {{--</td>--}}
                                    {{--</tr>--}}
                                @else
                                    @php
                                        $precio_s = 0;
                                    @endphp
                                @endif
                                @if($precio_paquete2->personas_d > 0)
                                    <tr>
                                        <td class="text-left"><b>Doble/Matrimonial</b></td>
                                        <td class="text-right">
                                            @php
                                                $precio_d = ceil(($precio_paquete2->precio_d)* (1/2)) * ($paquete->duracion - 1);
                                                $total_costo = $precio_d + $total;
                                                $total_utilidad = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                            @endphp
                                            {{number_format(ceil($total_utilidad), 2, '.', '')}}
                                        </td>
                                    </tr>
                                    {{--<tr>--}}
                                    {{--<td colspan="2">--}}
                                    {{--<i class="text-11">- {{$precio_paquete2->personas_d}} habitaciones con acomodacion doble, total de pasajeros {{$precio_paquete2->personas_d * 2}}, precio por persona ${{$total_utilidad / ($precio_paquete2->personas_d * 2)}}, numero de dias en hotel {{$paquete->duracion - 1}}</i>--}}
                                    {{--</td>--}}
                                    {{--</tr>--}}
                                @else
                                    @php
                                        $precio_d = 0;
                                    @endphp
                                @endif
                                {{--@if($precio_paquete2->personas_m > 0)--}}
                                {{--<tr>--}}
                                {{--<td class="text-left"><b>Matrimonial</b></td>--}}
                                {{--<td class="text-right">--}}
                                {{--@php--}}
                                {{--$precio_m = ceil(($precio_paquete2->precio_m)* (1/2)) * ($paquete->duracion - 1);--}}
                                {{--$total_costo = $precio_m + $total;--}}
                                {{--$total_utilidad = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));--}}
                                {{--@endphp--}}
                                {{--{{number_format(ceil($total_utilidad), 2, '.', '')}}--}}
                                {{--</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                {{--<td colspan="2">--}}
                                {{--<i class="text-11">- {{$precio_paquete2->personas_m}} habitaciones con acomodacion matrimonial, total de pasajeros {{$precio_paquete2->personas_m * 2}}, precio por persona ${{$total_utilidad / ($precio_paquete2->personas_m * 2)}}, numero de dias en hotel {{$paquete->duracion - 1}}</i>--}}
                                {{--</td>--}}
                                {{--</tr>--}}
                                {{--@else--}}
                                {{--@php--}}
                                {{--$precio_m = 0;--}}
                                {{--@endphp--}}
                                {{--@endif--}}
                                @if($precio_paquete2->personas_t > 0)
                                    <tr>
                                        <td class="text-left"><b>Triple</b></td>
                                        <td class="text-right">
                                            @php
                                                $precio_t = ceil(($precio_paquete2->precio_t)* (1/3)) * ($paquete->duracion - 1);
                                                $total_costo = $precio_t + $total;
                                                $total_utilidad = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                            @endphp
                                            {{number_format(ceil($total_utilidad), 2, '.', '')}}
                                        </td>
                                    </tr>
                                    {{--<tr>--}}
                                    {{--<td colspan="2">--}}
                                    {{--<i class="text-11">- {{$precio_paquete2->personas_t}} habitaciones con acomodacion matrimonial, total de pasajeros {{$precio_paquete2->personas_t * 3}}, precio por persona ${{$total_utilidad / ($precio_paquete2->personas_t * 3)}}, numero de dias en hotel {{$paquete->duracion - 1}}</i>--}}
                                    {{--</td>--}}
                                    {{--</tr>--}}
                                @else
                                    @php
                                        $precio_t = 0;
                                    @endphp
                                @endif
                                </thead>
                            </table>
                        </div>
                    @endif
                @else
                    @if($precio_paquete2->estado == 1)
                        <div>
                            <h5 class="no-margin"><b>CATEGORIA: {{$precio_paquete2->estrellas}} ESTRELLAS</b></h5>
                            <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Acomodacion</th>
                                    <th class="text-right">Total ($)</th>
                                    <th class="text-right">Estado</th>
                                </tr>
                                @if($precio_paquete2->personas_s > 0)
                                    <tr>
                                        <td class="text-left"><b>Simple</b></td>
                                        <td class="text-right">
                                            @php
                                                $precio_s = (($precio_paquete2->precio_s)* 1) * ($paquete->duracion - 1);
                                                $total_costo = $precio_s + $total;
                                                $total_utilidad = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                            @endphp
                                            {{number_format(ceil($total_utilidad), 2, '.', '')}}
                                        </td>
                                        @if($paquete->estado==1)
                                            @if($precio_paquete2->estado==2)
                                                <td rowspan="3" class="text-center"><a href="#" class="text-success"><i class="fa fa-check-square-o fa-5x" aria-hidden="true"></i></a></td>
                                            @else
                                                <td rowspan="3" class="text-center"><a href="#" class="text-muted"><i class="fa fa-clock-o fa-5x" aria-hidden="true"></i></a></td>
                                            @endif
                                        @else
                                            @if($precio_paquete2->estado==2)
                                                <td rowspan="3" class="text-center"><a href="#" class="text-success"><i class="fa fa-check-square-o fa-5x" aria-hidden="true"></i></a></td>
                                            @else
                                                <td rowspan="3" class="text-center"><a href="#" class="text-muted"><i class="fa fa-clock-o fa.5x" aria-hidden="true"></i></a></td>
                                            @endif
                                        @endif
                                    </tr>
                                @else
                                    @php
                                        $precio_s = 0;
                                    @endphp
                                @endif
                                @if($precio_paquete2->personas_d > 0)
                                    <tr>
                                        <td class="text-left"><b>Doble/Matrimonial</b></td>
                                        <td class="text-right">
                                            @php
                                                $precio_d = ceil(($precio_paquete2->precio_d)* (1/2)) * ($paquete->duracion - 1);
                                                $total_costo = $precio_d + $total;
                                                $total_utilidad = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                            @endphp
                                            {{number_format(ceil($total_utilidad), 2, '.', '')}}
                                        </td>
                                    </tr>
                                @else
                                    @php
                                        $precio_d = 0;
                                    @endphp
                                @endif
                                @if($precio_paquete2->personas_t > 0)
                                    <tr>
                                        <td class="text-left"><b>Triple</b></td>
                                        <td class="text-right">
                                            @php
                                                $precio_t = ceil(($precio_paquete2->precio_t)* (1/3)) * ($paquete->duracion - 1);
                                                $total_costo = $precio_t + $total;
                                                $total_utilidad = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                            @endphp
                                            {{number_format(ceil($total_utilidad), 2, '.', '')}}
                                        </td>
                                    </tr>
                                @else
                                    @php
                                        $precio_t = 0;
                                    @endphp
                                @endif
                                </thead>
                            </table>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
    @endforeach

@stop