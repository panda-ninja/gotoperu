@php
    function fecha_letra($fecha){
        $fecha=explode('-',$fecha);
        $mes='';
        switch ($fecha[1]){
            case '01':
                $mes='ENERO';
                break;
            case '02':
                $mes='FEBRERO';
                break;
            case '03':
                $mes='MARZO';
                break;

            case '04':
                $mes='ABRIL';
                break;

            case '05':
                $mes='MAYO';
                break;
            case '06':
                $mes='JUNIO';
                break;

            case '07':
                $mes='JULIO';
                break;

            case '08':
                $mes='AGOSTO';
                break;
            case '09':
                $mes='SEPTIEMBRE';
                break;

            case '10':
                $mes='OCTUBRE';
                break;

            case '11':
                $mes='NOVIEMBRE';
                break;
            case '12':
                $mes='DICIEMBRE';
                break;
        }
        return $mes.' '.$fecha[2].' DEL '.$fecha[0];
    }
@endphp
@extends('layouts.admin.contabilidad')
@section('content')
    <div class="row margin-top-40">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Contabilidad</li>
            <li class="active">Reservas confirmadas</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($cotizacion as $cotizaciones)
                                @foreach($cotizaciones->cotizaciones_cliente as $clientes)
                                    <h2 class="panel-title pull-left" style="font-size:30px;">{{$clientes->cliente->nombres}} {{$clientes->cliente->apellidos}} x {{$cotizaciones->nropersonas}} {{fecha_letra($cotizaciones->fecha)}}</h2>
                                    <b class="text-warning padding-left-10"> (X{{$cotizaciones->nropersonas}})</b>
                                @endforeach
                                {{--@foreach($cotizacion->cotizaciones_cliente as $clientes)--}}
                                    {{--@if($clientes->estado==1)--}}
                                        {{--<h1 class="panel-title pull-left" style="font-size:30px;">Hidalgo <small>hidlgo@gmail.com</small></h1>--}}
                                        {{--<h2 class="panel-title pull-left" style="font-size:30px;">{{$clientes->cliente->nombres}} {{$clientes->cliente->apellidos}} x {{$cotizaciones->nropersonas}} {{date_format(date_create($cotizaciones->fecha), ' l jS F Y')}}</h2>--}}
                                        {{--<b class="text-warning padding-left-10"> (X{{$cotizacion->nropersonas}})</b>--}}
                                        {{--@if($cotizacion->nropersonas==1)--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--@elseif($cotizacion->nropersonas==2)--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--@elseif($cotizacion->nropersonas==3)--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--@elseif($cotizacion->nropersonas==4)--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--@elseif($cotizacion->nropersonas==5)--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--@elseif($cotizacion->nropersonas==6)--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--@elseif($cotizacion->nropersonas==7)--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--@elseif($cotizacion->nropersonas==8)--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                            {{--<i class="fa fa-male fa-2x"></i>--}}
                                        {{--@endif--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            @endforeach

                            <i class="fa fa-check text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Hidalgo esta activo"></i>
                            <div class="dropdown pull-right">
                                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Opciones
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="?page=update"><i class="fa fa-fw fa-database" aria-hidden="true"></i> Actualizar Datos</a></li>
                                    <li><a href="#"><i class="fa fa-fw fa-check" aria-hidden="true"></i> Friends</a></li>
                                    <li><a href="#">Work</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> Add a new aspect</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-12 margin-top-20">
                            <div class="progress">

                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                    Datos del pasajero 60%
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 hide">
                            <span class="pull-left pax-nav">
                                <b>Travel date: no se</b>
                            </span>
                            <span class="pull-right">
                                 <a href="#" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-lg fa-ban" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Ignore"></i></a>
                            </span>
                        </div>


                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    <table class="table table-condensed table-bordered margin-top-20 table-hover">
                        <thead>
                        <tr>
                            <th class="text-18 text-grey-goto text-center">Services</th>
                            <th class="text-18 text-grey-goto text-center">Calculo</th>
                            <th class="text-18 text-grey-goto text-center">Cotizado</th>
                            <th class="text-18 text-grey-goto text-center">Reservado</th>
                            <th class="text-18 text-grey-goto text-center">Contabilidad</th>
                            <th class="text-18 text-grey-goto text-center">Pagado</th>
                            <th class="text-18 text-grey-goto text-center">Por pagar</th>
                        </tr>
                        </thead>
                        <tbody>

                        {{csrf_field()}}

                        @foreach($cotizaciones->paquete_cotizaciones as $paquetes)
                            @if($paquetes->estado==2)
                                @foreach($paquetes->itinerario_cotizaciones as $itinerario)
                                    <tr>
                                        <td class=" bg-info" colspan="9"><b class="text-primary text-18">Dia {{$itinerario->dias}}: {{fecha_letra($itinerario->fecha)}}</b></td>
                                    </tr>
                                    @foreach($itinerario->itinerario_servicios as $servicios)
                                        <tr>
                                            <td><b>{{ucwords(strtolower($servicios->nombre))}}</b></td>
                                            @if($servicios->precio_grupo==1)
                                                <td></td>
                                                <td class="text-right"><b class="text-18">
                                                {{$servicios->precio}}
                                                        <sup><small>$usd</small></sup></b></td>
                                            @else
                                                <td class="text-right"><b class="text-18">
                                                        {{$cotizaciones->nropersonas}} X  {{$servicios->precio}}
                                                        <sup><small>$usd</small></sup></b></td>
                                                <td class="text-right"><b class="text-18">
                                                    {{$cotizaciones->nropersonas * $servicios->precio}}
                                                <sup><small>$usd</small></sup></b></td>
                                            @endif
                                            <td class="text-right"><b class="text-18">{{$servicios->precio_proveedor}}<sup><small>$usd</small></sup></b></td>
                                            <td>
                                                @if($servicios->precio_c==0 OR $servicios->precio_c=='')
                                                    @php $precio_c =  $servicios->precio_proveedor; @endphp
                                                @else
                                                    @php $precio_c =  $servicios->precio_c; @endphp
                                                @endif
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm text-right text-18 text-green-goto font-weight-bold" id="p_conta_{{$servicios->id}}" value="{{$precio_c}}">
                                                    <span class="input-group-addon">$</span>
                                                </div>
                                            </td>
                                            <td>

                                            </td>
                                            <td></td>
                                            <td class="text-center">
                                                @if($servicios->precio_c > 0)
                                                    <button class="btn btn-warning display-block btn-sm hide" onclick="savePrice($('#p_conta_{{$servicios->id}}').val(),{{$servicios->id}})" id="btn_s_{{$servicios->id}}">Save</button>
                                                    <a href="{{route('pagar_servicios_conta_path', [$cotizaciones->id, $servicios->id])}}" class="btn btn-primary display-block btn-sm" id="btn_p_{{$servicios->id}}">Pagar</a>
                                                    <i class="fa fa-spinner fa-pulse text-18 fa-fw hide" id="p_load_{{$servicios->id}}"></i>
                                                    <span class="sr-only">Loading...</span>
                                                @else
                                                    <button class="btn btn-warning display-block btn-sm" onclick="savePrice($('#p_conta_{{$servicios->id}}').val(),{{$servicios->id}})" id="btn_s_{{$servicios->id}}">Save</button>
                                                    <a href="{{route('pagar_servicios_conta_path', [$cotizaciones->id, $servicios->id])}}" class="btn btn-primary display-block btn-sm hide" id="btn_p_{{$servicios->id}}">Pagar</a>
                                                    <i class="fa fa-spinner fa-pulse text-18 fa-fw hide" id="p_load_{{$servicios->id}}"></i>
                                                    <span class="sr-only">Loading...</span>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                    @foreach($itinerario->hotel as $hotel)
                                        <tr>
                                            <td>
                                                <b>
                                                    @if($hotel->personas_s>0)
                                                        <p>{{$hotel->personas_s}} <i class="fa fa-bed fa-2x" aria-hidden="true"></i></p>
                                                    @endif
                                                    @if($hotel->personas_d>0)
                                                        <p>{{$hotel->personas_d}} <i class="fa fa-bed fa-2x" aria-hidden="true"></i> <i class="fa fa-bed fa-2x" aria-hidden="true"></i></p>
                                                    @endif
                                                    @if($hotel->personas_m>0)
                                                        <p>{{$hotel->personas_m}} <i class="fa fa-bed fa-2x" aria-hidden="true"></i> <i class="fa fa-bed fa-2x" aria-hidden="true"></i></p>
                                                    @endif
                                                    @if($hotel->personas_t>0)
                                                        <p>{{$hotel->personas_t}} <i class="fa fa-bed fa-2x" aria-hidden="true"></i> <i class="fa fa-bed fa-2x" aria-hidden="true"></i> <i class="fa fa-bed fa-2x" aria-hidden="true"></i></p>
                                                    @endif
                                                </b>
                                            </td>
                                            <td class="text-right"><b class="text-18">
                                                    @if($hotel->personas_s>0)
                                                        <p>{{$hotel->personas_s}} x {{$hotel->precio_s}}</p>
                                                    @endif
                                                    @if($hotel->personas_d>0)
                                                        <p> {{$hotel->personas_d}} x {{$hotel->precio_d}}</p>
                                                    @endif
                                                    @if($hotel->personas_m>0)
                                                        <p>{{$hotel->personas_m}} x {{$hotel->precio_m}}</p>
                                                    @endif
                                                    @if($hotel->personas_t>0)
                                                        <p>{{$hotel->personas_t}} x {{$hotel->precio_t}}</p>
                                                    @endif
                                                </b>
                                            </td>
                                            <td class="text-right"><b class="text-18">
                                                    @if($hotel->personas_s>0)
                                                        <p>{{$hotel->personas_s*$hotel->precio_s}}<sup><small>$usd</small></sup></p>
                                                    @endif
                                                    @if($hotel->personas_d>0)
                                                        <p>{{$hotel->personas_d*$hotel->precio_d}}<sup><small>$usd</small></sup></p>
                                                    @endif
                                                    @if($hotel->personas_m>0)
                                                        <p>{{$hotel->personas_m*$hotel->precio_m}}<sup><small>$usd</small></sup></p>
                                                    @endif
                                                    @if($hotel->personas_t>0)
                                                        <p>{{$hotel->personas_t*$hotel->precio_t}}<sup><small>$usd</small></sup></p>
                                                    @endif
                                                </b>
                                            </td>

                                            <td class="text-right">
                                                <b class="text-18">
                                                    @if($hotel->personas_s>0)
                                                        <p>{{$hotel->personas_s*$hotel->precio_s_r}}<sup><small>$usd</small></sup></p>
                                                    @endif
                                                    @if($hotel->personas_d>0)
                                                        <p>{{$hotel->personas_d*$hotel->precio_d_r}}<sup><small>$usd</small></sup></p>
                                                    @endif
                                                    @if($hotel->personas_m>0)
                                                        <p>{{$hotel->personas_m*$hotel->precio_m_r}}<sup><small>$usd</small></sup></p>
                                                    @endif
                                                    @if($hotel->personas_t>0)
                                                        <p>{{$hotel->personas_t*$hotel->precio_t_r}}<sup><small>$usd</small></sup></p>
                                                    @endif

                                                </b></td>
                                            <td>
                                                @if($hotel->precio_s_c>0 OR $hotel->precio_s_c!='')
                                                    @php $precio_s_c=  $hotel->precio_s_c; @endphp
                                                @else
                                                    @php $precio_s_c =  $hotel->precio_s_r; @endphp
                                                @endif

                                                @if($hotel->precio_d_c>0 OR $hotel->precio_d_c!='')
                                                    @php $precio_d_c=  $hotel->precio_d_c; @endphp
                                                @else
                                                    @php $precio_d_c =  $hotel->precio_d_r; @endphp
                                                @endif

                                                @if($hotel->precio_m_c>0 OR $hotel->precio_m_c!='')
                                                    @php $precio_m_c=  $hotel->precio_m_c; @endphp
                                                @else
                                                    @php $precio_m_c =  $hotel->precio_m_r; @endphp
                                                @endif

                                                @if($hotel->precio_t_c>0 OR $hotel->precio_t_c!='')
                                                    @php $precio_t_c=  $hotel->precio_t_c; @endphp
                                                @else
                                                    @php $precio_t_c =  $hotel->precio_t_r; @endphp
                                                @endif
                                                @php $s=0;$d=0;$m=0;$t=0; @endphp

                                                @if($hotel->personas_s>0)
                                                    <div class="input-group">
                                                        <input type="text" class="form-control input-sm text-right text-18 text-green-goto font-weight-bold" id="p_conta_h_s_{{$hotel->id}}" value="{{$precio_s_c}}">
                                                        <span class="input-group-addon">$</span>
                                                    </div>
                                                    @php $s=$hotel->personas_s; @endphp
                                                @endif
                                                @if($hotel->personas_d>0)
                                                    <div class="input-group">
                                                        <input type="text" class="form-control input-sm text-right text-18 text-green-goto font-weight-bold" id="p_conta_h_d_{{$hotel->id}}" value="{{$precio_d_c}}">
                                                        <span class="input-group-addon">$</span>
                                                    </div>
                                                    @php $d=$hotel->personas_d; @endphp
                                                @endif
                                                @if($hotel->personas_m>0)
                                                    <div class="input-group">
                                                        <input type="text" class="form-control input-sm text-right text-18 text-green-goto font-weight-bold" id="p_conta_h_m_{{$hotel->id}}" value="{{$precio_m_c}}">
                                                        <span class="input-group-addon">$</span>
                                                    </div>
                                                    @php $m=$hotel->personas_m; @endphp
                                                @endif
                                                @if($hotel->personas_t>0)
                                                    <div class="input-group">
                                                        <input type="text" class="form-control input-sm text-right text-18 text-green-goto font-weight-bold" id="p_conta_h_t_{{$hotel->id}}" value="{{$precio_t_c}}">
                                                        <span class="input-group-addon">$</span>
                                                    </div>
                                                    @php $t=$hotel->personas_t; @endphp
                                                @endif

                                            </td>
                                            <td class="text-center">
                                                @if($hotel->precio_s_c > 0)
                                                    <button class="btn btn-warning display-block btn-sm hide" onclick="savePrice_h({{$s}},{{$d}},{{$m}},{{$t}},{{$hotel->id}})" id="btn_s_h_{{$hotel->id}}">Save</button>
                                                    <a href="{{route('pagar_servicios_conta_hotel_path', [$cotizaciones->id, $hotel->id])}}" class="btn btn-primary display-block btn-sm" id="btn_p_h{{$hotel->id}}">Pagar</a>
                                                    <i class="fa fa-spinner fa-pulse text-18 fa-fw hide" id="p_load_h{{$hotel->id}}"></i>
                                                    <span class="sr-only">Loading...</span>
                                                @else
                                                    <button class="btn btn-warning display-block btn-sm" onclick="savePrice_h({{$s}},{{$d}},{{$m}},{{$t}},{{$hotel->id}})" id="btn_s_h{{$hotel->id}}">Save</button>
                                                    <a href="{{route('pagar_servicios_conta_hotel_path', [$cotizaciones->id, $hotel->id])}}" class="btn btn-primary display-block btn-sm hide" id="btn_p_h{{$hotel->id}}">Pagar</a>
                                                    <i class="fa fa-spinner fa-pulse text-18 fa-fw hide" id="p_load_h{{$hotel->id}}"></i>
                                                    <span class="sr-only">Loading...</span>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endif
                        @endforeach


                        </tbody>
                    </table>


                    <table class="table table-bordered hide">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="col-lg-2">Services</th>
                                <th class="col-lg-1">Quote</th>
                                <th class="col-lg-1">Book Price</th>
                                <th class="col-lg-1">Cont. Price</th>
                                <th class="col-lg-1">Verification Code</th>
                                <th class="col-lg-1">Provider</th>
                                <th class="col-lg-1">Fecha Venc.</th>
                                <th class="col-lg-1">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $sumatotal_v=0;
                            $sumatotal_v_r=0;
                            $sumatotal_v_c=0;
                        @endphp

                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan="2"><b>Total</b></td>
                                <td class="text-right text-18 text-warning"><b>{{$sumatotal_v}} $</b></td>
                                <td class="text-right text-18 text-info"><b>{{$sumatotal_v_r}} $</b></td>
                                <td class="text-right text-18 text-warning"><b>{{$sumatotal_v_c}} $</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>


            <script>
                function savePrice(precio, id){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('[name="_token"]').val()
                        }
                    });

                    $("#btn_s_"+id).attr("disabled", true);


                    if (precio.length == 0 ){
                        $('#p_conta_'+id).css("border-bottom", "2px solid #FF0000");
                        var sendPrice = "false";
                    }else{
                        sendPrice = "true"
                    }

                    if(sendPrice == "true"){
                        var datos = {
                            "txt_precio" : precio,
                            "txt_id" : id
                        };
                        $.ajax({
                            data:  datos,
                            url:   "{{route('update_price_conta_path')}}",
                            type:  'post',

                            beforeSend: function () {
                                $('#btn_s_'+id).addClass('hide');
                                $('#p_load_'+id).removeClass('hide');

                            },
                            success:  function (response) {
                                // $('#d_form')[0].reset();
                                $('#p_load_'+id).addClass('hide');
                                $('#btn_s_'+id).addClass('hide');
                                $("#btn_p_"+id).removeClass("hide");
                            }
                        });
                    } else{
                        $("#btn_s_"+id).removeAttr("disabled");
                    }
                }
                function savePrice_h(s,d,m,t,id){
                    console.log('enviando pagos hotel');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('[name="_token"]').val()
                        }
                    });

                    $("#btn_s_h"+id).attr("disabled", true);

                    var p_s=$("#p_conta_h_s_"+id).val();
                    var p_d=$("#p_conta_h_d_"+id).val();
                    var p_m=$("#p_conta_h_m_"+id).val();
                    var p_t=$("#p_conta_h_t_"+id).val();
                    var i=1;
                    if(s>0) {
                        if (p_s.length == 0) {
                            $('#p_conta_h_s_' + id).css("border-bottom", "2px solid #FF0000");
                            var sendPrice_s = "false";
                            i=i*1;
                            return false;
                        } else {
                            sendPrice_s = "true";
                            i=i*0;
                        }
                    }
                    if(d>0) {
                        if (p_d.length == 0) {
                            $('#p_conta_h_d_' + id).css("border-bottom", "2px solid #FF0000");
                            var sendPrice_d = "false";
                            i=i*1;
                            return false;
                        } else {
                            sendPrice_d = "true";
                            i=i*0;
                        }
                    }
                    if(m>0) {
                        if (p_m.length == 0) {
                            $('#p_conta_h_m_' + id).css("border-bottom", "2px solid #FF0000");
                            var sendPrice_m = "false";
                            i=i*1;
                            return false;
                        } else {
                            sendPrice_m = "true";
                            i=i*0;
                        }
                    }
                    if(t>0) {
                        if (p_t.length == 0) {
                            $('#p_conta_h_t_' + id).css("border-bottom", "2px solid #FF0000");
                            var sendPrice_t = "false";
                            i=i*1;
                            return false;
                        } else {
                            sendPrice_t = "true";
                            i=i*0;
                        }
                    }

//                    if(i>0){
                        var datos = {
                            "txt_precio_s" : p_s,
                            "txt_precio_d" : p_d,
                            "txt_precio_m" : p_m,
                            "txt_precio_t" : p_t,
                            "txt_id" : id
                        };
                        $.ajax({
                            data:  datos,
                            url:   "{{route('update_price_conta_hotel_path')}}",
                            type:  'post',

                            beforeSend: function () {
                                $('#btn_s_h'+id).addClass('hide');
                                $('#p_load_h'+id).removeClass('hide');

                            },
                            success:  function (response) {
                                // $('#d_form')[0].reset();
                                $('#p_load_h'+id).addClass('hide');
                                $('#btn_s_h'+id).addClass('hide');
                                $("#btn_p_h"+id).removeClass("hide");
                            }
                        });
//                    } else{
//                        $("#btn_s_h"+id).removeAttr("disabled");
//                    }
                }

            </script>


@stop