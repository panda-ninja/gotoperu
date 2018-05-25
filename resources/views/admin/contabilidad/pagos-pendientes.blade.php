@php
    function fecha_peru($fecha){
    $fecha=explode('-',$fecha);
    return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
    }
@endphp
@extends('layouts.admin.contabilidad')
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
            <li>Contabilidad</li>
            <li>Operaciones</li>
            <li class="active">Pagos pendientes</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">HOTELS</a></li>
                        <li><a data-toggle="tab" href="#menu1">MOVILID</a></li>
                        <li><a data-toggle="tab" href="#menu2">REPRESENT</a></li>
                        <li><a data-toggle="tab" href="#menu3">ENTRANCES</a></li>
                        <li><a data-toggle="tab" href="#menu4">FOOD</a></li>
                        <li><a data-toggle="tab" href="#menu5">TRAINS</a></li>
                        <li><a data-toggle="tab" href="#menu6">FLIGHTS</a></li>
                        <li><a data-toggle="tab" href="#menu7">OTHERS</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-12 form-inline">

                                                    {{--<form action="{{route('list_fechas_rango_hotel_path')}}" method="post" class="form-inline">--}}
                                                        {{csrf_field()}}
                                                        <div class="form-group">
                                                            <label for="f_ini">From</label>
                                                            <input type="date" class="form-control" placeholder="from" name="txt_ini" id="f_ini" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="f_fin">To</label>
                                                            <input type="date" class="form-control" placeholder="to" name="txt_fin" id="f_fin" required>
                                                        </div>
                                                        <button type="button" class="btn btn-default" onclick="buscar_hoteles_pagos_pendientes($('#f_ini').val(),$('#f_fin').val())">Filtrar</button>
                                                    {{--</form>--}}
                                                </div>
                                            </div><!-- /.row -->
                                            {{--<hr>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="rpt_hotel">
                                </div>
                            </div>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <h3>Menu 1</h3>
                            <p>Some content in menu 1.</p>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <h3>Menu 2</h3>
                            <p>Some content in menu 1.</p>
                        </div>
                        <div id="menu3" class="tab-pane fade">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table id="lista_liquidaciones"  class="table table-bordered table-striped table-responsive table-hover">
                                        <thead>
                                        <tr>
                                            <th class="hide">ID</th>
                                            <th>DESDE</th>
                                            <th>HASTA</th>
                                            <th>ENVIADO POR</th>
                                            <th>TOTAL</th>
                                            <th>PAGADO</th>
                                            <th>SALDO</th>
                                            <th>ESTADO</th>
                                            <th>OPERACIONES</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($liquidaciones->where('estado',1)->sortByDesc('id') as $liquidacion)
                                            @php
                                                $total=0;
                                                $total_pagado=0;
                                                $total_monto=0;
                                                $total_pagado_monto=0;
                                            @endphp
                                            @foreach($cotizaciones as $cotizacion)
                                                @foreach($cotizacion->paquete_cotizaciones->where('estado',2) as $paquete_cotizaciones)
                                                    @foreach($paquete_cotizaciones->itinerario_cotizaciones->where('fecha','>=',$liquidacion->ini)->where('fecha','<=',$liquidacion->fin)->sortBy('fecha') as $itinerario_cotizacion)
                                                        @foreach($itinerario_cotizacion->itinerario_servicios as $itinerario_servicio)
                                                            @foreach($servicios->where('id',$itinerario_servicio->m_servicios_id) as $serv)
                                                                @if($serv->clase=='BTG' || $serv->clase=='CAT'||$serv->clase=='KORI'||$serv->clase=='MAPI'||$serv->clase=='OTROS')
                                                                    @php
                                                                        $total+=1;
                                                                        $total_monto+=$itinerario_servicio->precio_proveedor;
                                                                    @endphp
                                                                    @if($itinerario_servicio->liquidacion==2)
                                                                        @php
                                                                            $total_pagado+=1;
                                                                            $total_pagado_monto+=$itinerario_servicio->precio_proveedor;
                                                                        @endphp
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                            @foreach($servicios_movi->where('id',$itinerario_servicio->m_servicios_id) as $serv)
                                                                @if($serv->clase=='BOLETO')
                                                                    @php
                                                                        $total+=1;
                                                                        $total_monto+=$itinerario_servicio->precio_proveedor;
                                                                    @endphp
                                                                    @if($itinerario_servicio->liquidacion==2)
                                                                        @php
                                                                            $total_pagado+=1;
                                                                            $total_pagado_monto+=$itinerario_servicio->precio_proveedor;
                                                                        @endphp
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                            <tr id="lista_liquidaciones_{{$liquidacion->id}}">
                                                <td class="hide">{{$liquidacion->id}}</td>
                                                <td>{{fecha_peru($liquidacion->ini)}}</td>
                                                <td>{{fecha_peru($liquidacion->fin)}}</td>
                                                <td>
                                                    @foreach($users->where('id',$liquidacion->user_id) as $user)
                                                        {{$user->name}} {{$liquidacion->tipo_user}}
                                                    @endforeach
                                                </td>
                                                <td>{{$total_monto}}$</td>
                                                <td>{{$total_pagado_monto}}$</td>
                                                <td>{{$total_monto-$total_pagado_monto}}$</td>

                                                <td>
                                                    @if($total==0)
                                                        @php
                                                            $total=1;
                                                        @endphp
                                                    @endif
                                                    @php
                                                        $pagado_porc=round(($total_pagado/$total)*100,2);
                                                        $color_porc='progress-bar-danger';
                                                    @endphp
                                                    @if(25<$pagado_porc&&$pagado_porc<=50)
                                                        @php
                                                            $color_porc='progress-bar-warning';
                                                        @endphp
                                                    @endif
                                                    @if(50<$pagado_porc&&$pagado_porc<=75)
                                                        @php
                                                            $color_porc='progress-bar-info';
                                                        @endphp
                                                    @endif
                                                    @if(75<$pagado_porc&&$pagado_porc<=100)
                                                        @php
                                                            $color_porc='progress-bar-success';
                                                        @endphp
                                                    @endif
                                                    <div class="progress">
                                                        <div class="progress-bar {{$color_porc}} progress-bar-striped" role="progressbar" aria-valuenow="{{$pagado_porc}}" aria-valuemin="0" aria-valuemax="100"  style="min-width: 3em; width: {{$pagado_porc}}%">
                                                            {{$pagado_porc}}%
                                                        </div>
                                                    </div>
                                                </td>
                                                @php
                                                    $nro_cheque_s='Ninguno';
                                                    $nro_cheque_c='Ninguno';

                                                @endphp
                                                @if(strlen($liquidacion->nro_cheque_s)>0 || $liquidacion->nro_cheque_s || $liquidacion->nro_cheque_s!='')
                                                    @php
                                                        $nro_cheque_s=$liquidacion->nro_cheque_s;
                                                    @endphp
                                                @endif
                                                @if(strlen($liquidacion->nro_cheque_c)>0 || $liquidacion->nro_cheque_c || $liquidacion->nro_cheque_c!='')
                                                    @php
                                                        $nro_cheque_c=$liquidacion->nro_cheque_c;
                                                    @endphp
                                                @endif
                                                <td>
                                                    <a href="{{route('contabilidad_ver_liquidacion_path',[$liquidacion->id,$nro_cheque_s,$nro_cheque_c,$liquidacion->ini,$liquidacion->fin,'C'])}}" class="btn btn-primary"><i class="fa fa-eye-slash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="menu4" class="tab-pane fade">
                            <h3>Menu 4</h3>
                            <p>Some content in menu 1.</p>
                        </div>
                        <div id="menu5" class="tab-pane fade">
                            <h3>Menu 5</h3>
                            <p>Some content in menu 1.</p>
                        </div>
                        <div id="menu6" class="tab-pane fade">
                            <h3>Menu 6</h3>
                            <p>Some content in menu 2.</p>
                        </div>
                        <div id="menu7" class="tab-pane fade">
                            <h3>Menu 7</h3>
                            <p>Some content in menu 2.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var total=0;
        function sumar(valor) {
            total += valor;
            document.getElementById('s_total').innerHTML   = total;
        }
        function restar(valor) {
            total-=valor;
            document.getElementById('s_total').innerHTML   = total;
        }

        $(document).ready(function() {
            $('#lista_liquidaciones').DataTable({
                "order": [[ 0, "desc" ]]
            });
        });
    </script>
@stop