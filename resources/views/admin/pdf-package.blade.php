@extends('layouts.quotes_pdf')

@section('content')
    <div class="firstpage">
        <img src="{{asset('img/portada/proposal-martin-pdf.jpg')}}" class="responsive-img position-absolute" alt="">
    </div>
        <div class="text-center">
            <h2><b>Package Travel: {{$paquete->titulo}}</b></h2>
            <p><b>Package Code:</b> {{$paquete->codigo}} | <b>Package Duration:</b> {{$paquete->duracion}} | <b>Numero de pasajeros:</b> 1</p>
        </div>
        <div>
            <h3>Outline</h3>
            @foreach($paquete->itinerarios->sortBy('dias') as $itinerario)
                <h4>Day {{$itinerario->dias}} - {{$itinerario->titulo}}</h4>
            @endforeach
        </div>
        <div>
            <h3>Incluye</h3>
            <p>{{$paquete->incluye}}</p>
            <h3>No Incluye</h3>
            <p>{{$paquete->noincluye}}</p>
        </div>
        <div>
            <h3 class="no-margin">Itinerary for days</h3>
            @foreach($paquete->itinerarios->sortBy('dias') as $itinerario)
                <h4>Day {{$itinerario->dias}} - {{$itinerario->titulo}}</h4>
                <p>{{$itinerario->descripcion}}</p>
                @if (Storage::disk('itinerary')->has($itinerario->imagen))
                    <img
                            src="{{route('itinerary_image_path', ['filename' => $itinerario->imagen])}}" class="responsive-img" alt="">
                @endif
                <h4>Servicios:</h4>
                <table class="table-price-accommodation margin-bottom-20">
                    <thead>
                    <tr>
                        <th data-field="id">Concepto</th>
                        <th data-field="name">Observaciones</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($itinerario->serivicios as $servicios)
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
            <h3><b>Destinos incluidos:</b></h3>
            @php
                $array_destinos[]=null
            @endphp
            @foreach($paquete->itinerarios as $itinerarios_destino)
                @foreach($itinerarios_destino->destinos as $destino)
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
            <h3><b>Precios:</b></h3>
            <p>Los precios son por persona. La cotizacion fue realizado para <b class="blue-text">{{1}} person</b>.</p>
            @php $servicio = 0; @endphp
            @foreach($paquete->itinerarios as $paquete_itinerario)
                @foreach($paquete_itinerario->serivicios as $orden_cotizaciones)
                    @php
                        $total = $orden_cotizaciones->precio + $servicio;
                        $servicio = $total;
                    @endphp
                @endforeach
            @endforeach
            @foreach($paquete->precios as $precio_paquete2)
                @if($precio_paquete2->estado == 1)
                    <div>
                        <h5 class="no-margin"><b>CATEGORIA: {{$precio_paquete2->estrellas}} ESTRELLAS</b></h5>
                        <table class="table-price-accommodation margin-bottom-20">
                            <thead>
                            <tr>
                                <th>Acomodacion</th>
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
            @endforeach
        </div>
@stop