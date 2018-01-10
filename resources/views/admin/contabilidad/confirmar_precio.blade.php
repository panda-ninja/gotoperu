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
                                    <h2 class="panel-title pull-left" style="font-size:30px;">{{$clientes->cliente->nombres}} {{$clientes->cliente->apellidos}} x {{$cotizaciones->nropersonas}} {{date_format(date_create($cotizaciones->fecha), ' l jS F Y')}}</h2>
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

                        <div class="col-md-12">
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
                    {{--<h4 class="text-right">--}}
                        {{--<a href="#" style="text-decoration:none;">--}}
                            {{--<strong class="text-warning text-25">Pending: 23.00$</strong>--}}
                        {{--</a>--}}
                    {{--</h4>--}}
                    {{--<hr>--}}

                    <table class="table table-condensed table-bordered margin-top-20 table-hover">
                        <thead>
                        <tr>
                            <th class="text-18 text-grey-goto text-center">Services</th>
                            <th class="text-18 text-grey-goto text-center">Quote Price</th>
                            <th class="text-18 text-grey-goto text-center">Book Price</th>
                            <th class="text-18 text-grey-goto text-center">Cont. Price</th>

                        </tr>
                        </thead>
                        <tbody>

                        {{csrf_field()}}

                        @foreach($cotizaciones->paquete_cotizaciones as $paquetes)
                            @if($paquetes->estado==2)
                                @foreach($paquetes->itinerario_cotizaciones as $itinerario)
                                    <tr>
                                        <td class="text-center bg-info" colspan="9"><b class="text-primary text-18">Dia {{$itinerario->dias}}: </b></td>
                                    </tr>
                                    @foreach($itinerario->itinerario_servicios as $servicios)
                                        <tr>

                                            <td><b>{{ucwords(strtolower($servicios->nombre))}}</b></td>
                                            <td class="text-right"><b class="text-18">

                                                    @if($servicios->precio_grupo==1)
                                                        {{$servicios->precio}}
                                                    @else
                                                       {{$cotizaciones->nropersonas}} X  {{$servicios->precio}} = {{$cotizaciones->nropersonas * $servicios->precio}}
                                                    @endif

                                                    <sup><small>$usd</small></sup></b></td>
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


            </script>


@stop