@php
    $arra_prov_pagos=[];
    function fecha_peru($fecha){
        $f1=explode('-',$fecha);
        return $f1[2].'-'.$f1[1].'-'.$f1[0];
    }
@endphp

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <form action="{{route('list_fechas_hotel_show_path')}}" method="post">
                            {{csrf_field()}}
                        <div class="col-lg-9">

                            <table class="table table-condensed table-bordered margin-top-20 table-hover">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-18 text-grey-goto text-center">Cotización</th>
                                    <th class="text-18 text-grey-goto text-center">Proveedor</th>
                                    <th class="text-18 text-grey-goto text-center">Fecha de Servicio</th>
                                    <th class="text-18 text-grey-goto text-center">Fecha a Pagar</th>
                                    <th class="text-18 text-grey-goto text-center">Costo Cont.</th>
                                    <th class="text-18 text-grey-goto text-center">Pagado</th>
                                    <th class="text-18 text-grey-goto text-center">Saldo</th>
                                    {{--<th class="text-18 text-grey-goto text-center">Pagado</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                {{--@php--}}
                                        {{--$ini = date(2018-01-19);--}}
                                        {{--$fin = date('2018-01-19');--}}
                                {{--@endphp--}}
                                @foreach($cotizacion->where('estado','2') as $cotizaciones)
                                    @foreach($cotizaciones->paquete_cotizaciones->where('estado','2') as $paquetes)
                                        @php
                                            $arra_prov_total=[];
                                            $arra_fecha_serv=[];
                                            $arra_fecha_venc=[];

                                        @endphp
                                        @foreach($paquetes->itinerario_cotizaciones as $itinerario)
                                            @php
                                                $dia = $itinerario->dias - 1;
                                                $fecha = date($cotizaciones->fecha);
                                                $fecha_servicio = strtotime ( '+'.$dia.' day' , strtotime ( $fecha ) ) ;
                                                $fecha_servicio = date ( 'Y-m-d' , $fecha_servicio );

                                                $dia_pago = 7;
                                                $fecha_p = date($fecha_servicio);
                                                $fecha_pago = strtotime ( '-'.$dia_pago.' day' , strtotime ( $fecha_p ) ) ;
                                                $fecha_pago = date ( 'Y-m-d' , $fecha_pago );
                                            @endphp
                                                @foreach($itinerario->hotel as $hotel)
                                                    @if(date($ini)<=$hotel->fecha_venc and $hotel->fecha_venc <= date($fin))
                                                        @php
                                                            $total_h=0;
                                                            $precio_c_confirm=0;
                                                            $precio_c_confirm2=0;
                                                        @endphp
                                                        @if(!array_key_exists($hotel->proveedor_id,$arra_fecha_serv))
                                                            @php
                                                                $arra_fecha_serv[$hotel->proveedor_id]=$itinerario->fecha;
                                                            @endphp
                                                        @endif
                                                        @if(!array_key_exists($hotel->proveedor_id,$arra_fecha_venc))
                                                            @php
                                                                $arra_fecha_venc[$hotel->proveedor_id]=$hotel->fecha_venc;
                                                            @endphp
                                                        @endif

                                                        @if($hotel->personas_s>0)
                                                            @php
                                                                $precio_c_confirm++;
                                                            @endphp
                                                            @if($hotel->precio_s_c>0)
                                                                @php
                                                                    $total_h+=$hotel->personas_s*$hotel->precio_s_c;
                                                                    $precio_c_confirm2++;
                                                                @endphp
                                                            @endif
                                                            @if(array_key_exists($hotel->proveedor_id,$arra_prov_total))
                                                                @php
                                                                    $arra_prov_total[$hotel->proveedor_id]+=$total_h;
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $arra_prov_total[$hotel->proveedor_id]=$total_h;
                                                                @endphp
                                                            @endif
                                                        @endif
                                                        @if($hotel->personas_d>0)
                                                            @php
                                                                $precio_c_confirm++;
                                                            @endphp
                                                            @if($hotel->precio_d_c>0)
                                                                @php
                                                                    $total_h+=$hotel->personas_d*$hotel->precio_d_c;
                                                                    $precio_c_confirm2++;
                                                                @endphp
                                                            @endif
                                                            @if(array_key_exists($hotel->proveedor_id,$arra_prov_total))
                                                                @php
                                                                    $arra_prov_total[$hotel->proveedor_id]+=$total_h;
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $arra_prov_total[$hotel->proveedor_id]=$total_h;
                                                                @endphp
                                                            @endif
                                                        @endif
                                                        @if($hotel->personas_m>0)
                                                            @php
                                                                $precio_c_confirm++;
                                                            @endphp
                                                            @if($hotel->precio_m_c>0)
                                                                @php
                                                                    $total_h+=$hotel->personas_m*$hotel->precio_m_c;
                                                                    $precio_c_confirm2++;
                                                                @endphp
                                                            @endif
                                                            @if(array_key_exists($hotel->proveedor_id,$arra_prov_total))
                                                                @php
                                                                    $arra_prov_total[$hotel->proveedor_id]+=$total_h;
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $arra_prov_total[$hotel->proveedor_id]=$total_h;
                                                                @endphp
                                                            @endif
                                                        @endif
                                                        @if($hotel->personas_t>0)
                                                            @php
                                                                $precio_c_confirm++;
                                                            @endphp
                                                            @if($hotel->precio_t_c>0)
                                                                @php
                                                                    $total_h+=$hotel->personas_t*$hotel->precio_t_c;
                                                                    $precio_c_confirm2++;
                                                                @endphp
                                                            @endif
                                                            @if(array_key_exists($hotel->proveedor_id,$arra_prov_total))
                                                                @php
                                                                    $arra_prov_total[$hotel->proveedor_id]+=$total_h;
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $arra_prov_total[$hotel->proveedor_id]=$total_h;
                                                                @endphp
                                                            @endif
                                                        @endif
                                                        @php $total = 0; $total2 = 0; $j=0;@endphp
                                                        {{--@foreach($hotel->pagos->where('estado', 1) as $pagos)--}}
                                                            {{--@php $total = $total + $pagos->a_cuenta; @endphp--}}
                                                        {{--@endforeach--}}

                                                        {{--@foreach($hotel->pagos as $pagos)--}}
                                                            {{--@php $total2 = $total2 + $pagos->a_cuenta; @endphp--}}
                                                        {{--@endforeach--}}

                                                        {{--@if($total == 0)--}}
                                                            @php $pago_a_cuenta = $total_h;@endphp
                                                        {{--@else--}}
                                                            {{--@foreach($hotel->pagos->where('estado', 0) as $pagos)--}}
                                                                {{--@php $pago_a_cuenta = $pagos->a_cuenta;@endphp--}}
                                                            {{--@endforeach--}}
                                                        {{--@endif--}}

                                                        {{--@if($precio_c_confirm==$precio_c_confirm2)--}}
                                                        @if($total == 0)

                                                        @else
                                                            {{--@if($pagos->fecha_a_pagar >= date($ini) AND  $pagos->fecha_a_pagar <= date($fin))--}}
                                                                {{--@if($pagos->estado == 0)--}}
                                                                    {{--<tr>--}}
                                                                        {{--<td class="text-center"><input type="checkbox"  onclick="if (this.checked) sumar({{$pago_a_cuenta}}); else restar({{$pago_a_cuenta}})" name="chk_id[]" value="{{$hotel->id}}"></td>--}}
                                                                        {{--@if(isset($hotel->proveedor))--}}
                                                                            {{--<td><b>{{ucwords(strtolower($hotel->proveedor->razon_social))}}</b></td>--}}
                                                                        {{--@else--}}
                                                                            {{--<td><b></b></td>--}}
                                                                        {{--@endif--}}
                                                                        {{--<td><b>{{ucwords(strtolower($servicio->nombre))}}</b></td>--}}
                                                                        {{--@foreach($cotizaciones->cotizaciones_cliente as $cotizaciones_clientes)--}}
                                                                            {{--<td><b>{{ucwords(strtolower($cotizaciones_clientes->cliente->nombres))}} X{{$cotizaciones->nropersonas}}</b></td>--}}
                                                                        {{--@endforeach--}}
                                                                        {{--<td class="text-right"><b>{{$fecha_servicio}}</b></td>--}}
                                                                        {{--<td class="text-right"><b>{{$pagos->fecha_a_pagar}}</b></td>--}}
                                                                        {{--<td class="text-right"><b><sup><small>$USS</small></sup></b></td>--}}
                                                                        {{--<td class="text-right"><b>{{$total_h}}<sup><small>$USS</small></sup></b></td>--}}
                                                                        {{--<td class="text-center"><button class="btn btn-primary btn-sm">Pagar</button></td>--}}
                                                                        {{--<td class="text-right">--}}
                                                                            {{--<b>--}}
                                                                                {{--{{$total}}--}}
                                                                            {{--</b>--}}
                                                                        {{--</td>--}}
                                                                        {{--<td class="text-right"><b>{{$pagos->a_cuenta}}</b></td>--}}
                                                                    {{--</tr>--}}
                                                                {{--@endif--}}
                                                            {{--@endif--}}
                                                        @endif
                                                    @endif
                                                @endforeach
                                        @endforeach
                                        @foreach($arra_prov_total as $key => $arra_prov_total_)

                                            @php
                                            $pagado=$pagos->where('paquete_cotizaciones_id',$paquetes->id)->where('proveedor_id',$key)->where('estado','1')->sum('a_cuenta');
                                            @endphp
                                        {{--@endforeach--}}
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox"  onclick="if (this.checked) sumar({{$arra_prov_total_}}); else restar({{$arra_prov_total_}})" name="chk_id[]" value="{{$paquetes->id}}_{{$key}}_{{$arra_prov_total_}}">
                                            </td>
                                            <td>
                                                @php
                                                    $titulo='';
                                                @endphp
                                                @foreach($cotizaciones->cotizaciones_cliente->where('estado','1') as $cliente)
                                                    @php
                                                        $titulo=$cliente->cliente->nombres.' '.$cliente->cliente->apellidos ;
                                                    @endphp
                                                @endforeach
                                                <b class="text-primary">{{$titulo}} <span class="text-warning">x</span> {{$cotizaciones->nropersonas}} <span class="text-warning">(</span>{{$cotizaciones->duracion}} dias<span class="text-warning">)</span></b>                                                          </td>
                                            <td>
                                                @foreach($proveedores->where('id',$key) as $proveedor)
                                                    <b>{{ucwords(strtolower($proveedor->nombre_comercial))}}</b>
                                                @endforeach
                                            </td>
                                            {{--<td><b>{{ucwords(strtolower($servicio->nombre))}}</b></td>--}}
                                            {{--@foreach($cotizaciones->cotizaciones_cliente as $cotizaciones_clientes)--}}
                                            {{--<td><b>{{ucwords(strtolower($cotizaciones_clientes->cliente->nombres))}} X{{$cotizaciones->nropersonas}}</b></td>--}}
                                            {{--@endforeach--}}
                                            <td class="text-right"><b>{{fecha_peru($arra_fecha_serv[$key])}}</b></td>
                                            <td class="text-right"><b>{{fecha_peru($arra_fecha_venc[$key])}}</b></td>
                                            {{--<td class="text-right"><b><sup><small>$USS</small></sup></b></td>--}}
                                            <td class="text-right"><b>{{$arra_prov_total_}}<sup><small>$USS</small></sup></b></td>
                                            {{--<td class="text-center"><button class="btn btn-primary btn-sm">Pagar</button></td>--}}
                                            <td class="text-right">
                                                <b>
                                                    {{$pagado}}<sup><small>$USS</small></sup>
                                                </b>
                                            </td>
                                            <td class="text-right">
                                                <b>
                                                    {{$arra_prov_total_-$pagado}}<sup><small>$USS</small></sup>
                                                </b>
                                            </td>
                                        </tr>
                                        @endforeach <!-- cierre para la lsita de proveedores con sus respectivos datos -->
                                    @endforeach <!-- cierre para pqts -->
                                @endforeach <!-- cierrempara cotis -->
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-3">
                            <div class="panel panel-default">
                                <div class="panel-body text-center">
                                    <h2 class="text-40"><sup><small>$usd</small></sup><b id="s_total">Monto</b></h2>
                                    <button class="btn btn-info display-block w-100">Seleccionar</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    {{--<hr>--}}
                </div>
            </div>
        </div>
    </div>


    <script>
        var total=0;

        function sumar(valor) {
            total += valor;
            // document.formulario.total.value=total;
            document.getElementById('s_total').innerHTML   = total;
        }

        function restar(valor) {
            total-=valor;
            // document.formulario.total.value=total;
            document.getElementById('s_total').innerHTML   = total;
        }

        {{--function rango_fecha() {--}}
            {{--var ini = $('#f_ini').val();--}}
            {{--var fin = $('#f_fin').val();--}}
            {{--window.location = "{{route('list_fechas_path', ['1','2'])}}";--}}
                {{--// window.location.href--}}
        {{--}--}}
    </script>