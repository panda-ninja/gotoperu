@extends('.layouts.admin.admin')
@section('archivos-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .ui-autocomplete {
            z-index: 5000 !important;
        }
    </style>
@stop
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Quotes</li>
            <li class="active">Current planes</li>
        </ol>
    </div>
    <form class="hide"  action="{{route('cotizacion_show_path')}}" method="post" id="package_new_path_id">
        <div class="row">
            <div class="col-md-12">
                <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">1</span> Search client</h4>
                <div class="divider margin-bottom-20"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="txt_name">Name</label>
                    <input type="text" class="form-control" id="txt_name" name="txt_name" placeholder="Name" required>
                </div>
            </div>
            <div class="col-md-3 text-center margin-top-20">
                {{csrf_field()}}
                <button type="submit" class="btn btn-lg btn-primary">Search <i class="fa fa-search-plus" aria-hidden="true"></i></button>
            </div>
        </div>

    </form>
    <div id="lista_cotizacione" class="margin-top-10">
        <?php
        $planes[]='A';
        $planes[]='B';
        $planes[]='C';
        $planes[]='D';
        $planes[]='E';
        $planes[]='F';
        $planes[]='G';
        $planes[]='H';
        $planes[]='I';
        $planes[]='K';
        $planes[]='L';
        $planes[]='M';
        $planes[]='N';
        $planes[]='O';
        $planes[]='P';
        $planes[]='Q';
        $planes[]='R';
        $planes[]='S';
        $pos_plan=0;
        $cotizacion_=null;
        ?>
        @if($cotizacion!=null)
            @foreach($cotizacion as $cotizacion1)
                @php
                $cotizacion_=$cotizacion1;
                @endphp
            @endforeach

            @foreach($cotizacion_->paquete_cotizaciones as $paquete)
                @php
                    $total=0;
                    $servicio = 0;
                    $precio_hotel=0;
                    $precio_profit=0
                @endphp
                @foreach($paquete->itinerario_cotizaciones as $paquete_itinerario)
                    @foreach($paquete_itinerario->itinerario_servicios as $orden_cotizaciones)
                        @if($orden_cotizaciones->precio_grupo==1)
                            @php
                                $servicio += $orden_cotizaciones->precio;
                            @endphp
                        @else
                            @php
                                $servicio += ($orden_cotizaciones->precio*$cotizacion_->nropersonas);
                            @endphp
                        @endif
                    @endforeach
                    @foreach($paquete_itinerario->hotel as $hotel)
                        @if($hotel->personas_s>0)
                            @php
                                $precio_hotel+=$hotel->personas_s*$hotel->precio_s;
                                $precio_profit=$hotel->utilidad_s;
                            @endphp
                        @endif
                        @if($hotel->personas_d>0)
                            @php
                                $precio_hotel+=$hotel->personas_d*$hotel->precio_d;
                                $precio_profit=$hotel->utilidad_s;
                            @endphp
                        @endif
                        @if($hotel->personas_m>0)
                            @php
                                $precio_hotel+=$hotel->personas_m*$hotel->precio_m;
                            @endphp
                        @endif
                        @if($hotel->personas_t>0)
                            @php
                                $precio_hotel+=$hotel->personas_t*$hotel->precio_t;
                            @endphp
                        @endif
                    @endforeach
                @endforeach
                @if($cotizacion_->estado==2)
                    @if($paquete->estado==2)
                        @php
                            $sumatotal=0;
                            $total_utilidad_s=0;
                            $total_utilidad_d=0;
                            $total_utilidad_m=0;
                            $total_utilidad_t=0;
                        @endphp
                        @foreach($paquete->paquete_precios as $precio_paquete2)

                            @if($precio_paquete2->estado == 2)
                                @if($precio_paquete2->personas_s > 0)
                                    @php
                                        $precio_s = (($precio_paquete2->precio_s)* ($precio_paquete2->personas_s)*1) * ($paquete->duracion - 1);
                                        $total_costo = $precio_s + $total;
                                        $total_utilidad_s = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                    @endphp
                                @else
                                    @php
                                        $precio_s = 0;
                                        $total_utilidad_s=0;
                                    @endphp
                                @endif
                                @if($precio_paquete2->personas_d > 0)
                                    @php
                                        $precio_d = ceil(($precio_paquete2->precio_d)* ($precio_paquete2->personas_d)*2) * ($paquete->duracion - 1);
                                        $total_costo = $precio_d + $total;
                                        $total_utilidad_d = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                    @endphp
                                @else
                                    @php
                                        $precio_d = 0;
                                        $total_utilidad_d=0;
                                    @endphp
                                @endif
                                @if($precio_paquete2->personas_m > 0)
                                    @php
                                        $precio_m = ceil(($precio_paquete2->precio_d)* ($precio_paquete2->personas_m)*2) * ($paquete->duracion - 1);
                                        $total_costo = $precio_m + $total;
                                        $total_utilidad_m = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                    @endphp
                                @else
                                    @php
                                        $precio_m = 0;
                                        $total_utilidad_m=0;
                                    @endphp
                                @endif
                                @if($precio_paquete2->personas_t > 0)
                                    @php
                                        $precio_t = ceil(($precio_paquete2->precio_t)* ($precio_paquete2->personas_t)*3) * ($paquete->duracion - 1);
                                        $total_costo = $precio_t + $total;
                                        $total_utilidad_t = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                    @endphp
                                @else
                                    @php
                                        $precio_t = 0;
                                        $total_utilidad_t=0;
                                    @endphp
                                @endif
                            @endif
                        @endforeach
                        @php
                            $sumatotal=$total_utilidad_s+$total_utilidad_d+$total_utilidad_m+$total_utilidad_t;
                        @endphp
                        <div class="col-md-3 margin-top-10">
                            <div class="btn-primary text-center text-13">
                                @php
                                    $date = date_create($cotizacion_->fecha);
                                    $fecha=date_format($date, 'jS F Y');
                                    $titulo='';
                                @endphp
                                @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                                    @if($cliente_coti->estado=='1')
                                        @php
                                        $titulo=$cliente_coti->cliente->nombres.' '.$cliente_coti->cliente->apellidos.' x '.$cotizacion_->nropersonas.' '.$fecha;
                                        @endphp
                                        <strong>
                                            <img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">
                                            {{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizacion_->nropersonas}} {{$fecha}}
                                        </strong>
                                    @endif
                                @endforeach
                            </div>
                            <div class="portada-pdf">
                                <img src="{{asset('img/portada/proposal-martin-pdf.jpg')}}" alt="" class="img-responsive">
                                <div class="box-dowload1">
                                    <b class="margin-top-5"><i class="fa fa-file-pdf-o text-danger" aria-hidden="true"></i> Plan</b>
                                    <form id="generar_plantilla" name="generar_plantilla" action="{{route('generar_pantilla_path')}}" method="post">
                                        {{csrf_field()}}
                                        <input type="hidden" name="pqt_id" id="pqt_id" value="{{$paquete->id}}">
                                        <input type="hidden" name="coti_id" id="coti_id" value="{{$cotizacion_->id}}">
                                        <button class=" pull-right btn btn-default btn-sm"><i class="fa fa-files-o" aria-hidden="true"></i></button>
                                    </form>
                                    <a href="{{route('quotes_pdf_path',$paquete->id)}}" class=" pull-right btn btn-default btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a>
                                    <a href="{{route('mostar_planes_excel_path',$paquete->id)}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
                                    <a href="{{route('mostar_planes_path',$paquete->id)}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    @if($paquete->estado==2)
                                        <a href="{{route('escojer_pqt_plan',$paquete->id)}}" class="pull-right btn btn-success btn-sm"><i class="fa fa-check" aria-hidden="true"></i></a>
                                    @else
                                        <a href="{{route('escojer_pqt_plan',$paquete->id)}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-check" aria-hidden="true"></i></a>
                                    @endif
                                </div>
                                <div class="box-letter-proposal text-center">
                                    <span class="text-orange-goto">{{$planes[$pos_plan]}}</span>
                                    <span class="hide text-orange-goto text-40">${{number_format(ceil($sumatotal), 2, '.', '')}}</span>
                                </div>
                            </div>
                        </div>
                    @elseif($paquete->estado==1)
                        <div class="col-md-3 margin-top-10">
                            <div class="btn-primary text-center text-13">
                                @php
                                    $date = date_create($cotizacion_->fecha);
                                    $fecha=date_format($date, 'jS F Y');
                                    $titulo='';
                                @endphp
                                @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                                    @if($cliente_coti->estado=='1')
                                        @php
                                            $titulo=$cliente_coti->cliente->nombres.' '.$cliente_coti->cliente->apellidos.' x '.$cotizacion_->nropersonas.' '.$fecha;
                                        @endphp
                                        <strong>
                                            <img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">
                                            {{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizacion_->nropersonas}} {{$fecha}}
                                        </strong>
                                    @endif
                                @endforeach
                            </div>
                            <div class="portada-pdf">
                                <img src="{{asset('img/portada/proposal-martin-pdf.jpg')}}" alt="" class="img-responsive">
                                <div class="box-dowload">
                                    <b class="margin-top-5"><i class="fa fa-file-pdf-o text-danger" aria-hidden="true"></i> Plan</b>
                                    <form id="generar_plantilla" name="generar_plantilla" action="{{route('generar_pantilla_path')}}" method="post">
                                        {{csrf_field()}}
                                        <input type="hidden" name="pqt_id" id="pqt_id" value="{{$paquete->id}}">
                                        <input type="hidden" name="coti_id" id="coti_id" value="{{$cotizacion_->id}}">
                                        <button class=" pull-right btn btn-default btn-sm" ><i class="fa fa-files-o" aria-hidden="true"></i></button>
                                    </form>
                                    <a href="{{route('quotes_pdf_path',$paquete->id)}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a>
                                    <a href="{{route('mostar_planes_excel_path',$paquete->id)}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
                                    <a href="{{route('mostar_planes_path',$paquete->id)}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    @if($paquete->estado==2)
                                        <a href="{{route('escojer_pqt_plan',$paquete->id)}}" class="pull-right btn btn-success btn-sm"><i class="fa fa-check" aria-hidden="true"></i></a>
                                    @else
                                        <a href="{{route('escojer_pqt_plan',$paquete->id)}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-check" aria-hidden="true"></i></a>
                                    @endif
                                </div>
                                <div class="box-letter-proposal text-center">
                                    <span class="text-orange-goto">{{$planes[$pos_plan]}}</span>
                                </div>
                            </div>
                        </div>

                    @endif
                @else
                    @if($paquete->estado==2)
                        <div class="col-md-3 margin-top-10">
                            <div class="btn-primary text-center text-13">
                                @php
                                    $date = date_create($cotizacion_->fecha);
                                    $fecha=date_format($date, 'jS F Y');
                                    $titulo='';
                                @endphp
                                @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                                    @if($cliente_coti->estado=='1')
                                        @php
                                            $titulo=$cliente_coti->cliente->nombres.' '.$cliente_coti->cliente->apellidos.' x '.$cotizacion_->nropersonas.' '.$fecha;
                                        @endphp
                                        <strong>
                                            <img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">
                                            {{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizacion_->nropersonas}} {{$fecha}}
                                        </strong>
                                    @endif
                                @endforeach
                            </div>
                            <div class="portada-pdf">
                                <img src="{{asset('img/portada/proposal-martin-pdf.jpg')}}" alt="" class="img-responsive">
                                <div class="box-dowload1">
                                    <b class="margin-top-5"><i class="fa fa-file-pdf-o text-danger" aria-hidden="true"></i> Plan</b>
                                    <form id="generar_plantilla" name="generar_plantilla" action="{{route('generar_pantilla_path')}}" method="post">
                                        {{csrf_field()}}
                                        <input type="hidden" name="pqt_id" id="pqt_id" value="{{$paquete->id}}">
                                        <input type="hidden" name="coti_id" id="coti_id" value="{{$cotizacion_->id}}">
                                        <button class=" pull-right btn btn-default btn-sm" ><i class="fa fa-files-o" aria-hidden="true"></i></button>
                                    </form>
                                    <a href="{{route('quotes_pdf_path',$paquete->id)}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a>
                                    <a href="{{route('mostar_planes_excel_path',$paquete->id)}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
                                    <a href="{{route('mostar_planes_path',$paquete->id)}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    @if($paquete->estado==2)
                                        <a href="{{route('escojer_pqt_plan',$paquete->id)}}" class="pull-right btn btn-success btn-sm"><i class="fa fa-check" aria-hidden="true"></i></a>
                                    @else
                                        <a href="{{route('escojer_pqt_plan',$paquete->id)}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-check" aria-hidden="true"></i></a>
                                    @endif
                                </div>
                                <div class="box-letter-proposal text-center">
                                    <span class="text-orange-goto">{{$planes[$pos_plan]}}</span>
                                </div>
                            </div>
                        </div>
                    @elseif($paquete->estado==1)
                        <div class="col-md-3 margin-top-10">
                            <div class="btn-primary text-center text-13">
                                @php
                                    $date = date_create($cotizacion_->fecha);
                                    $fecha=date_format($date, 'jS F Y');
                                    $titulo='';
                                @endphp
                                @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                                    @if($cliente_coti->estado=='1')
                                        @php
                                            $titulo=$cliente_coti->cliente->nombres.' '.$cliente_coti->cliente->apellidos.' x '.$cotizacion_->nropersonas.' '.$fecha;
                                        @endphp
                                        <strong>
                                            <img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">
                                            {{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizacion_->nropersonas}} {{$fecha}}
                                        </strong>
                                    @endif
                                @endforeach
                            </div>
                            <div class="portada-pdf">
                                <img src="{{asset('img/portada/proposal-martin-pdf.jpg')}}" alt="" class="img-responsive">
                                <div class="box-dowload">
                                    <b class="margin-top-5"><i class="fa fa-file-pdf-o text-danger" aria-hidden="true"></i> Plan</b>
                                    {{csrf_field()}}
                                    <form id="generar_plantilla" name="generar_plantilla" action="{{route('generar_pantilla_path')}}" method="post">
                                        {{csrf_field()}}
                                        <input type="hidden" name="pqt_id" id="pqt_id" value="{{$paquete->id}}">
                                        <input type="hidden" name="coti_id" id="coti_id" value="{{$cotizacion_->id}}">
                                        <button class=" pull-right btn btn-default btn-sm"><i class="fa fa-files-o" aria-hidden="true"></i></button>
                                    </form>
                                    <a href="{{route('quotes_pdf_path',$paquete->id)}}" class=" pull-right btn btn-default btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a>
                                    <a href="{{route('mostar_planes_excel_path',$paquete->id)}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
                                    <a href="{{route('mostar_planes_path',$paquete->id)}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a href="#" class="hide pull-right btn btn-default btn-sm" data-toggle="modal" data-target="#modal_planes_{{$paquete->id}}"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                                    {{--<form action="{{route('escojer_pqt_plan')}}" method="post">--}}
{{--                                        {{csrf_field()}}--}}
                                        {{--<input type="hidden" name="id" value="{{$paquete->id}}">--}}
                                        @if($paquete->estado==2)
                                            <a href="{{route('escojer_pqt_plan',$paquete->id)}}" class="pull-right btn btn-success btn-sm"><i class="fa fa-check" aria-hidden="true"></i></a>
                                        @else
                                            <a href="{{route('escojer_pqt_plan',$paquete->id)}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-check" aria-hidden="true"></i></a>
                                        @endif
                                    {{--</form>--}}
                                    {{--<button type="button" id="plan_{{$pos_plan}}"  class="planes pull-right btn btn-danger btn-sm" onclick="activarPlan('{{$paquete->id}}','{{$cotizacion_->nombre}}','{{$cotizacion_->id}}','{{$pos_plan}}')">--}}
                                        {{--<i class="fa fa-toggle-off" aria-hidden="true"></i>--}}
                                    {{--</button>--}}
                                </div>
                                <div class="box-letter-proposal text-center">
                                    <span class="text-orange-goto">{{$planes[$pos_plan]}}</span>
                                </div>
                            </div>
                        </div>

                    @endif
                @endif


                    @php
                        $servicio = 0;
                        $st_precio=0;
                    @endphp
                    @foreach($paquete->itinerario_cotizaciones as $paquete_itinerario)
                        @foreach($paquete_itinerario->itinerario_servicios as $orden_cotizaciones)
                            {{--@if($orden_cotizaciones->precio_grupo==1)--}}
                                {{--$st_precio+=$orden_cotizaciones->precio;--}}
                            {{--@endif--}}
                            @php
                                $total = $orden_cotizaciones->precio + $servicio;
                                $servicio = $total;
                            @endphp
                        @endforeach
                    @endforeach
                <div class="modal fade bd-example-modal-lg" id="modal_planes_{{$paquete->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form action="{{route('escojer_precio_paquete_path')}}" method="post" id="destination_edit_id" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        <?php
                                        $date = date_create($cotizacion_->fecha);
                                        $fecha=date_format($date, 'jS F Y');
                                        ?>
                                        @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                                            @if($cliente_coti->estado=='1')
                                                <b class="text-primary">{{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizacion_->nropersonas}} {{$fecha}} del plan {{$planes[$pos_plan]}}</b>
                                            @endif
                                        @endforeach

                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txt_codigo">Category</label>
                                                <select class="form-control" id="categoria" name="categoria">
                                                    @php
                                                        $array_acomodacion=array();
                                                    @endphp
                                                    @if($cotizacion_->star_2==2)
                                                        <option value="2">2 STARS</option>
                                                    @endif
                                                    @if($cotizacion_->star_3==3)
                                                        <option value="3">3 STARS</option>
                                                    @endif
                                                    @if($cotizacion_->star_4==4)
                                                        <option value="4">4 STARS</option>
                                                    @endif
                                                    @if($cotizacion_->star_5==5)
                                                        <option value="5">5 STARS</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txt_codigo">Travelers </label>
                                                <input type="number" class="form-control" id="travelers" name="travelers" min="0" value="{{$cotizacion_->nropersonas}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3 margin-top-25">
                                            <button type="button" class="btn btn-primary" onclick="mostrar_categoria('{{$paquete->id}}')">Show</button>
                                        </div>
                                    </div>
                                    @php
                                        $array_2='';
                                        $array_3='';
                                        $array_4='';
                                        $array_5='';
                                    @endphp
                                    @foreach($paquete->paquete_precios as $precio_paquete2)
                                        @if($precio_paquete2->estado == 1)
                                            <div id="star_{{$precio_paquete2->estrellas}}" class="hide">
                                                <h5 class="no-margin"><b>CATEGORIA: {{$precio_paquete2->estrellas}} ESTRELLAS</b></h5>
                                                <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                                                    <thead>
                                                    <tr>
                                                        <th>Nro</th>
                                                        <th>Acomodacion</th>
                                                        <th class="text-right">Total ($)</th>
                                                    </tr>

                                                    @if($precio_paquete2->personas_s > 0)
                                                        @if($precio_paquete2->estrellas==2)
                                                            @php
                                                                $array_2.='1_';
                                                            @endphp
                                                        @endif
                                                        @if($precio_paquete2->estrellas==3)
                                                            @php
                                                                $array_3.='1_';
                                                            @endphp
                                                        @endif
                                                        @if($precio_paquete2->estrellas==4)
                                                            @php
                                                                $array_4.='1_';
                                                            @endphp
                                                        @endif
                                                        @if($precio_paquete2->estrellas==5)
                                                            @php
                                                                $array_5.='1_';
                                                            @endphp
                                                        @endif
                                                        <tr width="50px">
                                                            <td class="col-md-1"><input class="form-control" type="number" name="s_{{$precio_paquete2->estrellas}}" id="s_{{$precio_paquete2->estrellas}}" min="0"></td>
                                                            <td class="text-left"><b>Simple</b></td>
                                                            <td class="text-right">
                                                                @php
                                                                    $precio_s = (($precio_paquete2->precio_s)* 1) * ($paquete->duracion - 1);
                                                                    $total_costo = $precio_s + $total;
                                                                    $total_utilidad = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                                                @endphp
                                                                <span id="detalle_p_s_{{$precio_paquete2->estrellas}}"></span>
                                                                <span class="hide" id="hp_s_{{$precio_paquete2->estrellas}}">{{number_format(ceil($total_utilidad), 2, '.', '')}}</span>
                                                                <span id="p_s_{{$precio_paquete2->estrellas}}">{{number_format(ceil($total_utilidad), 2, '.', '')}}</span>
                                                            </td>

                                                        </tr>
                                                    @else
                                                        @php
                                                            $precio_s = 0;
                                                        @endphp
                                                    @endif
                                                    @if($precio_paquete2->personas_d > 0)
                                                        @if($precio_paquete2->estrellas==2)
                                                            @php
                                                                $array_2.='2_';
                                                            @endphp
                                                        @endif
                                                        @if($precio_paquete2->estrellas==3)
                                                            @php
                                                                $array_3.='2_';
                                                            @endphp
                                                        @endif
                                                        @if($precio_paquete2->estrellas==4)
                                                            @php
                                                                $array_4.='2_';
                                                            @endphp
                                                        @endif
                                                        @if($precio_paquete2->estrellas==5)
                                                            @php
                                                                $array_5.='2_';
                                                            @endphp
                                                        @endif
                                                        <tr>
                                                            <td ><input class="form-control" type="number" name="d_{{$precio_paquete2->estrellas}}" id="d_{{$precio_paquete2->estrellas}}" min="0"></td>

                                                            <td class="text-left"><b>Doble</b></td>
                                                            <td class="text-right">
                                                                @php
                                                                    $precio_d = ceil(($precio_paquete2->precio_d)* (1/2)) * ($paquete->duracion - 1);
                                                                    $total_costo = $precio_d + $total;
                                                                    $total_utilidad = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                                                @endphp
                                                                <span id="detalle_p_d_{{$precio_paquete2->estrellas}}"></span>
                                                                <span class="hide" id="hp_d_{{$precio_paquete2->estrellas}}">{{number_format(ceil($total_utilidad), 2, '.', '')}}</span>
                                                                <span id="p_d_{{$precio_paquete2->estrellas}}">{{number_format(ceil($total_utilidad), 2, '.', '')}}</span>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        @php
                                                            $precio_d = 0;
                                                        @endphp
                                                    @endif
                                                    @if($precio_paquete2->personas_m > 0)
                                                        @if($precio_paquete2->estrellas==2)
                                                            @php
                                                                $array_2.='4_';
                                                            @endphp
                                                        @endif
                                                        @if($precio_paquete2->estrellas==3)
                                                            @php
                                                                $array_3.='4_';
                                                            @endphp
                                                        @endif
                                                        @if($precio_paquete2->estrellas==4)
                                                            @php
                                                                $array_4.='4_';
                                                            @endphp
                                                        @endif
                                                        @if($precio_paquete2->estrellas==5)
                                                            @php
                                                                $array_5.='4_';
                                                            @endphp
                                                        @endif
                                                        <tr>
                                                            <td ><input class="form-control" type="number" name="m_{{$precio_paquete2->estrellas}}" id="m_{{$precio_paquete2->estrellas}}" min="0"></td>

                                                            <td class="text-left"><b>Matrimonial</b></td>
                                                            <td class="text-right">
                                                                @php
                                                                    $precio_m = ceil(($precio_paquete2->precio_d)* (1/2)) * ($paquete->duracion - 1);
                                                                    $total_costo = $precio_m + $total;
                                                                    $total_utilidad = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                                                @endphp
                                                                <span id="detalle_p_m_{{$precio_paquete2->estrellas}}"></span>
                                                                <span class="hide" id="hp_m_{{$precio_paquete2->estrellas}}">{{number_format(ceil($total_utilidad), 2, '.', '')}}</span>
                                                                <span id="p_m_{{$precio_paquete2->estrellas}}">{{number_format(ceil($total_utilidad), 2, '.', '')}}</span>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        @php
                                                            $precio_m = 0;
                                                        @endphp
                                                    @endif
                                                    @if($precio_paquete2->personas_t > 0)
                                                        @if($precio_paquete2->estrellas==2)
                                                            @php
                                                                $array_2.='3_';
                                                            @endphp
                                                        @endif
                                                        @if($precio_paquete2->estrellas==3)
                                                            @php
                                                                $array_3.='3_';
                                                            @endphp
                                                        @endif
                                                        @if($precio_paquete2->estrellas==4)
                                                            @php
                                                                $array_4.='3_';
                                                            @endphp
                                                        @endif
                                                        @if($precio_paquete2->estrellas==5)
                                                            @php
                                                                $array_5.='3_';
                                                            @endphp
                                                        @endif
                                                        <tr>
                                                            <td><input class="form-control" type="number" name="t_{{$precio_paquete2->estrellas}}" id="t_{{$precio_paquete2->estrellas}}" min="0"></td>

                                                            <td class="text-left"><b>Triple</b></td>
                                                            <td class="text-right">
                                                                @php
                                                                    $precio_t = ceil(($precio_paquete2->precio_t)* (1/3)) * ($paquete->duracion - 1);
                                                                    $total_costo = $precio_t + $total;
                                                                    $total_utilidad = $total_costo + ($total_costo * (($precio_paquete2->utilidad)/100));
                                                                @endphp
                                                                <span id="detalle_p_t_{{$precio_paquete2->estrellas}}"></span>
                                                                <span class="hide" id="hp_t_{{$precio_paquete2->estrellas}}">{{number_format(ceil($total_utilidad), 2, '.', '')}}</span>
                                                                <span id="p_t_{{$precio_paquete2->estrellas}}">{{number_format(ceil($total_utilidad), 2, '.', '')}}</span>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        @php
                                                            $precio_t = 0;
                                                        @endphp
                                                    @endif
                                                    </thead>
                                                </table>
                                                <div class="text-right">
                                                    <b class="text-25">Precio del paquete: $<span id="total_{{$precio_paquete2->estrellas}}" class=" text-success"></span></b>
                                                </div>
                                                <input type="hidden" id="precio_paquete_id" name="precio_paquete_id_{{$precio_paquete2->estrellas}}"   value="{{$precio_paquete2->id}}">
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                                <div class="modal-footer">
                                    <input type="text" name="plan_{{$paquete->id}}_2" id="plan_{{$paquete->id}}_2" value="{{$array_2}}">
                                    <input type="text" name="plan_{{$paquete->id}}_3" id="plan_{{$paquete->id}}_3" value="{{$array_3}}">
                                    <input type="text" name="plan_{{$paquete->id}}_4" id="plan_{{$paquete->id}}_4" value="{{$array_4}}">
                                    <input type="text" name="plan_{{$paquete->id}}_5" id="plan_{{$paquete->id}}_5" value="{{$array_5}}">
                                    {{csrf_field()}}
                                    <input type="hidden" id="pos" name="pos" value="0">

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                    <?php
                    $pos_plan++;
                    ?>
                {{--@endif--}}
            @endforeach


            <input type="hidden" name="nro_planes" id="nro_planes" value="{{$pos_plan}}">
        @endif
            <div class="col-md-3 margin-top-10">
                <a href="{{route('new_plan_cotizacion_path',$cotizacion_->id)}}" class="btn btn-primary">NUEVO PLAN</a>
            </div>
    </div>

    <script>
        $(function () {
            $('#txt_name').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "buscar-cotizacion",
                        dataType: "json",
                        data: {
                            term : request.term
                            {{--localizacion : $("#localizacion1_{{$i}}").val(),--}}
                            {{--grupo : '{{$tipoServicio_}}'--}}
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                minLength: 1
            });
        });
    </script>
@stop
