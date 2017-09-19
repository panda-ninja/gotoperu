@extends('layouts.quotes_pdf')

@section('content')
    @php
    $datos_cliente='hola';
    @endphp
        @foreach($cotizacion as $cotizaciones)
            @php $pasajeros = $cotizaciones->nropersonas; @endphp
            @foreach($cotizaciones->cotizaciones_cliente as $cliente_cotizaciones)
                @if($cliente_cotizaciones->estado == 1)
                    @php
                        $datos_cliente=$cliente_cotizaciones->cliente->nombres.', '.$cliente_cotizaciones->cliente->apellidos;
                    @endphp
                @endif
            @endforeach
        @endforeach
        <div class="firstpage">
            <img src="{{asset('img/portada/proposal-pdf.jpg')}}" class="responsive-img position-absolute" alt="">
        </div>
        <div class="bienvenida">
            <h1>Dear {{$datos_cliente}}</h1>
            <b class="text-justify text-white text-20">
            Thank your for choosing GotoPeru! we have created the following travel plans for you to review. I hope you find everything to your satistaction and please remember that we can further customize any aspect of your itinerary.</b>
        </div>
        {{--<div class="pie">--}}
            {{--<div class="col-lg-2">--}}
                {{--<div class="row">--}}
                    {{--<p class="text-grey-goto text-15">--}}
                        {{--<span>Juan Perez</span><br>--}}
                        {{--<span>TRAVEL ADVISOR</span>--}}
                    {{--</p>--}}
                    {{--<p class="text-grey-goto">--}}
                        {{--<span>doriam@gotoperu.com</span><br>--}}
                        {{--<span>(202) 996-3000</span>--}}
                    {{--</p>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="cabecera_pdf">--}}
        {{--</div>--}}
        {{--<div class="cuerpo_pdf">--}}
            {{--<h1>Dear {{$datos_cliente}}</h1>--}}
            {{--<span>Thank your choosing GotoPeru! We have created the following travel plans for you to review. I hope you find everything to your satifaction and please remmember </span>--}}
        {{--</div>--}}
        {{--<div class="pie_pdf">--}}
            {{--<img src="{{asset('img/portada/proposal-pie-pdf.jpg')}}" class="responsive-img position-absolute" alt="">--}}
        {{--</div>--}}


    @foreach($paquete as $paquete)
        @foreach($cotizacion as $cotizaciones)
            @php $pasajeros = $cotizaciones->nropersonas; @endphp
            @foreach($cotizaciones->cotizaciones_cliente as $cliente_cotizaciones)
{{--                {{dd($cliente_cotizaciones->cliente)}}--}}
                @if($cliente_cotizaciones->estado == 1)
{{--                    <b>Cliente: {{$cliente_cotizaciones->cliente->nombres}} X {{$pasajeros}}</b>--}}
                @endif
            @endforeach
        @endforeach

        <div class="text-center">
            <h2><b>Package Travel: {{$paquete->titulo}}</b></h2>
            <p><b>Package Code:</b> {{$paquete->codigo}} | <b>Travel Lenght:</b> {{$paquete->duracion}} | <b># Travellers:</b> {{$pasajeros}}</p>
        </div>
        {{--<div>--}}
        {{--<p>{{$paquete->descripcion}}</p>--}}
        {{--</div>--}}
        <div>
            <h3>Outline</h3>
            @foreach($paquete->itinerario_cotizaciones->sortBy('dias') as $itinerario)
                <h4>Day {{$itinerario->dias}} - {{$itinerario->titulo}}</h4>
            @endforeach
        </div>
        <div>
            <h3>Included</h3>
            <p>{{$paquete->incluye}}</p>
            <h3>Not Included</h3>
            <p>{{$paquete->noincluye}}</p>
            {{--<h3>Opcional</h3>--}}
            {{--<p>{{$paquete->opcional}}</p>--}}
        </div>

        <div>
            <h3 class="no-margin">Itinerary for days</h3>
            @foreach($paquete->itinerario_cotizaciones->sortBy('dias') as $itinerario)
                <h4>Day {{$itinerario->dias}} - {{$itinerario->titulo}}</h4>
                <p>{{$itinerario->descripcion}}</p>
                @if (Storage::disk('itinerary')->has($itinerario->imagen))
                        <img
                            src="{{route('itinerary_image_path', ['filename' => $itinerario->imagen])}}" class="responsive-img" alt="">
               @endif

                {{--<img src="{{asset('img/itinerary/'.str_replace(' ','-',$itinerario->titulo).'')}}.jpg" class="responsive-img" alt="">--}}
                {{--<h4>Servicios:</h4>--}}
                {{--<table class="table-price-accommodation margin-bottom-20">--}}
                {{--<thead>--}}
                {{--<tr>--}}
                {{--<th data-field="id">Concepto</th>--}}
                {{--<th data-field="name">Observaciones</th>--}}
                {{--</tr>--}}
                {{--</thead>--}}
                {{--<tbody>--}}
                {{--@foreach($itinerario->itinerario_servicios as $servicios)--}}
                {{--<tr>--}}
                {{--<td class="text-align-left">{{$servicios->nombre}}</td>--}}
                {{--<td>{{$servicios->observacion}}</td>--}}
                {{--</tr>--}}
                {{--@endforeach--}}
                {{--</tbody>--}}
                {{--</table>--}}

            @endforeach
        </div>

        <div>
            <h3><b>Destinations:</b></h3>
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
            @foreach($array_destinos as $destino)
                @if($destino!=null)
                    - {{$destino}}<br>
                @endif
            @endforeach

            {{--@foreach($paquete->itinerario_cotizaciones as $itinerarios_destino)--}}
                {{--@foreach($itinerarios_destino->itinerario_destinos as $destino)--}}
{{--                    <img src="{{asset('img/destinations/'.$destino->imagen.'')}}" class="margin-bottom-3" width="347" alt="">--}}
                    {{--@if (Storage::disk('destination')->has($destino->imagen))--}}
                            {{--<img--}}
                                    {{--src="{{route('destination_image_path', ['filename' => $destino->imagen])}}" class="margin-bottom-3" width="347" alt="">--}}
                    {{--@endif--}}
                    {{--- {{$destino->destino}}<br>--}}
                {{--@endforeach--}}
            {{--@endforeach--}}
        </div>

        <div>
            <h3><b>Price:</b></h3>
            <p>The Prices are per person under USD $ dollars.
                {{--<b class="blue-text hide">{{$pasajeros}} traveller</b>.</p>--}}
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
                @if($precio_paquete2->estado == 1)

                    <div>
                        <h5 class="no-margin"><b>CATEGORY: {{$precio_paquete2->estrellas}} STARS</b></h5>
                        <table class="table-price-accommodation margin-bottom-20">
                            <thead>
                            <tr>
                                <th>Acomodation</th>
                                <th class="text-right">Total ($)</th>
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
                            @if($precio_paquete2->personas_m > 0)
                                <tr>
                                    <td class="text-left"><b>Matrimonial</b></td>
                                    <td class="text-right">
                                        @php
                                            $precio_m = ceil(($precio_paquete2->precio_m)* (1/2)) * ($paquete->duracion - 1);
                                            $total_costo = $precio_m + $total;
                                            $total_utilidad = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                        @endphp
                                        {{number_format(ceil($total_utilidad), 2, '.', '')}}
                                    </td>
                                </tr>
                                {{--<tr>--}}
                                {{--<td colspan="2">--}}
                                {{--<i class="text-11">- {{$precio_paquete2->personas_m}} habitaciones con acomodacion matrimonial, total de pasajeros {{$precio_paquete2->personas_m * 2}}, precio por persona ${{$total_utilidad / ($precio_paquete2->personas_m * 2)}}, numero de dias en hotel {{$paquete->duracion - 1}}</i>--}}
                                {{--</td>--}}
                                {{--</tr>--}}
                            @else
                                @php
                                    $precio_m = 0;
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
            @endforeach
        </div>

        {{--<div>--}}
        {{--<h3>Itinerary for hours</h3>--}}
        {{--<table class="table-price-accommodation text-left">--}}
        {{--<tbody>--}}
        {{--@foreach($paquete->itinerario_cotizaciones->sortBy('dias') as $itinerario)--}}
        {{--<tr>--}}
        {{--<td><b>Day {{$itinerario->dias}} - {{$itinerario->titulo}}</b> <br> <span class="hour-text">({{$itinerario->fecha}})</span></td>--}}
        {{--<td>--}}
        {{--<ul>--}}
        {{--@foreach($itinerario->horas_cotizaciones->sortBy('hora') as $horas)--}}
        {{--<li>--}}
        {{--<b>{{$horas->hora}}</b> - {{$horas->descripcion}})--}}
        {{--</li>--}}
        {{--@endforeach--}}
        {{--</ul>--}}
        {{--</td>--}}
        {{--</tr>--}}
        {{--@endforeach--}}
        {{--</tbody>--}}
        {{--</table>--}}
        {{--</div>--}}

        {{--<div>--}}
        {{--<h3 class="margin-top-40">Services</h3>--}}
        {{--@foreach($paquete->itinerario_cotizaciones->sortBy('dias') as $itinerario)--}}
        {{--<h4>Day {{$itinerario->dias}} - {{$itinerario->titulo}} ({{$itinerario->fecha}})</h4>--}}

        {{--<table class="table-price-accommodation margin-bottom-20">--}}
        {{--<thead>--}}
        {{--<tr>--}}
        {{--<th data-field="id">Concepto</th>--}}
        {{--<th data-field="name">Observaciones</th>--}}
        {{--<th data-field="price">Precio</th>--}}
        {{--</tr>--}}
        {{--</thead>--}}

        {{--<tbody>--}}
        {{--@foreach($itinerario->servicios_cotizaciones as $servicios)--}}
        {{--<tr>--}}
        {{--<td>{{$servicios->tiposervicio}}</td>--}}
        {{--<td>{{$servicios->observaciones}}</td>--}}
        {{--<td>${{$servicios->precio}}</td>--}}
        {{--</tr>--}}
        {{--@endforeach--}}
        {{--</tbody>--}}
        {{--</table>--}}

        {{--@endforeach--}}
        {{--</div>--}}

    @endforeach

@stop