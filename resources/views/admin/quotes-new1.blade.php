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
        <div class="row">
            <div class="col-lg-7">
                <b class="text-center text-30">DATES QUOTES</b>
                <form action="" id="frm_datos" name="frm_datos" method="post">
                    <div class="row caja_datos">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="txt_name">Name</label>
                            <input type="text" class="form-control" id="txt_name" name="txt_name" placeholder="Name" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="txt_country">Country</label>
                            <input type="text" class="form-control" id="txt_country" name="txt_country" placeholder="Country">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="txt_email">Email</label>
                            <input type="email" class="form-control" id="txt_email" name="txt_email" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="txt_phone">Phone</label>
                            <input type="text" class="form-control" id="txt_phone" name="txt_phone" placeholder="Phone">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="txt_travellers">Travellers</label>
                            <input type="number" class="form-control" id="txt_travellers" name="txt_travellers" placeholder="Travellers" min="1">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="txt_days">Days</label>
                            <input type="number" class="form-control" id="txt_days" name="txt_days" placeholder="Days" min="1">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="txt_travel_date">Travel date</label>
                            <input type="date" class="form-control" id="txt_travel_date" name="txt_travel_date" placeholder="Travel date">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox1">
                            <label class=" text-orange-goto">
                                <input class="destinospack2" type="radio" name="strellas[]" id="strellas_2" value="2" checked="checked" onchange="filtrar_estrellas1(2)">
                                2 <i class="fa fa-star-half-o fa-3x" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox1">
                            <label class=" text-orange-goto">
                                <input class="destinospack2" type="radio" name="strellas[]" id="strellas_3" value="3" onchange="filtrar_estrellas1(3)">
                                3 <i class="fa fa-star-half-o fa-3x" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox1">
                            <label class=" text-orange-goto">
                                <input class="destinospack2" type="radio" name="strellas[]" id="strellas_4" value="4" onchange="filtrar_estrellas1(4)">
                                4 <i class="fa fa-star-half-o fa-3x" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox1">
                            <label class=" text-orange-goto">
                                <input class="destinospack2" type="radio" name="strellas[]" id="strellas_5" value="5" onchange="filtrar_estrellas1(5)">
                                5 <i class="fa fa-star-half-o fa-3x" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="checkbox1 caja">
                            <label class="text-unset">
                                {{--<input class="destinospack" type="checkbox" name="acomodacion_s" id="acomodacion_s" value="1">--}}
                                <p><b class="text-20">0</b></p>
                                <b class="text-20px"><i class="fa fa-bed fa-2x" aria-hidden="true"></i></b>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <a href="#!" onclick="aumentar_acom('s','-')"><i class="fa fa-minus-circle fa-2x" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="col-lg-6">
                                        <a href="#!" onclick="aumentar_acom('s','+')"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="checkbox1 caja">
                            <label class="text-unset">
                                {{--<input class="destinospack" type="checkbox" name="acomodacion_s" id="acomodacion_s" value="1">--}}
                                <p><b class="text-20">0</b></p>
                                <b class="text-20px"><i class="fa fa-bed fa-2x" aria-hidden="true"></i> <i class="fa fa-bed fa-2x" aria-hidden="true"></i></b>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <a href="#!" onclick="aumentar_acom('d','-')"><i class="fa fa-minus-circle fa-2x" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="col-lg-6">
                                        <a href="#!" onclick="aumentar_acom('d','+')"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="checkbox1 caja">
                            <label class="text-unset">
                                {{--<input class="destinospack" type="checkbox" name="acomodacion_s" id="acomodacion_s" value="1">--}}
                                <p><b class="text-20">0</b></p>
                                <b class="text-20px"><i class="fa fa-venus-mars fa-2x" aria-hidden="true"></i></b>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <a href="#!" onclick="aumentar_acom('m','-')"><i class="fa fa-minus-circle fa-2x" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="col-lg-6">
                                        <a href="#!" onclick="aumentar_acom('m','+')"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                    <div class="checkbox1 caja">
                        <label class="text-unset">
                            {{--<input class="destinospack" type="checkbox" name="acomodacion_s" id="acomodacion_s" value="1">--}}
                            <p><b class="text-20">0</b></p>
                            <b class="text-20px"><i class="fa fa-bed fa-2x" aria-hidden="true"></i> <i class="fa fa-bed fa-2x" aria-hidden="true"></i> <i class="fa fa-bed fa-2x" aria-hidden="true"></i></b>
                            <div class="row">
                                <div class="col-lg-6">
                                    <a href="#!" onclick="aumentar_acom('t','-')"><i class="fa fa-minus-circle fa-2x" aria-hidden="true"></i></a>
                                </div>
                                <div class="col-lg-6">
                                    <a href="#!" onclick="aumentar_acom('t','+')"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
                    @php
                    $deti='';
                    @endphp
                    @foreach($destinos as $destino)
                        <div class="col-md-3">
                            <div class="checkbox1">
                                <label class=" text-unset">
                                    <input class="destinospack" type="checkbox" name="destinos[]" value="{{$destino->id}}" onchange="filtrar_itinerarios1()">
                                    {{$destino->destino}}
                                </label>
                            </div>
                        </div>
                        @php
                            $deti.=$destino->id.'/';
                        @endphp
                    @endforeach
                    @php
                        $deti=substr($deti,0,strlen($deti)-1);
                    @endphp
                </div>
                </form>
            </div>
            <input type="hidden" id="desti" value="{{$deti}}">
            <div class="col-lg-4">
                <b class="text-center text-30">ITINERARIES</b>
                <div class="col-lg-12">
                    <div class="row text-center">
                        <div class="col-lg-1"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
                        <div class="col-lg-3">
                            <div class="checkbox1">
                                <label class=" text-unset text-danger text-12">
                                    <input class="destinospack3" type="radio" name="pos_dias[]" value="0">
                                    <b><span id="dia_l">5</span>DAYS</b>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="checkbox1">
                                <label class=" text-unset text-danger text-12">
                                    <input class="destinospack3" type="radio" name="pos_dias[]" value="0">
                                    <b><span id="dia_c">5</span>DAYS</b>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="checkbox1">
                                <label class=" text-unset text-danger text-12">
                                    <input class="destinospack3" type="radio" name="pos_dias[]" value="0">
                                    <b><span id="dia_r">5</span>DAYS</b>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-1"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
                    </div>
                </div>
                <div class="row caja_itinerario" style="height: 480px; overflow-y: auto;">

                    @foreach($p_paquete as $p_paquete_)
                        <div class="col-md-12">
                            <div class="checkbox1">
                                <label class=" text-unset text-warning text-12">
                                    <input class="destinospack" type="checkbox" name="paquetes[]" value="{{$p_paquete_->id}}">
                                    {{$p_paquete_->duracion}} {{$p_paquete_->titulo}}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row caja_n_v">
                    <div class="col-lg-12 caja_negro">
                        3 STARS
                    </div>
                    <div class="col-lg-12 caja_verde">
                        <div class="row">
                            <div class="col-lg-3"><b class="text-20">GTP628</b></div>
                            <div class="col-lg-3"><b class="text-20">6d</b></div>
                            <div class="col-lg-3"><b class="text-20">$850</b></div>
                            <div class="col-lg-3 text-right margin-top-5 margin-bottom-5"><button class="btn btn-green">GO</button></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 margin-top-25">
                <b class="text-center text-30">NEW ITINERARY</b>
            </div>
            <div class="col-lg-4 margin-top-25">
                <div class="row caja_n_v">
                    <form action="{{route('nuevo_paquete_path')}}" method="post" id="form_nuevo_pqt" name="form_nuevo_pqt">
                        <div class="col-lg-12 caja_negro" id="estrellas">
                            2 STARS
                            {{csrf_field()}}
                            <input type="hidden" id="estrellas_from" name="estrellas_from" value="0">
                            <input type="hidden" id="a_s" name="a_s" value="0">
                            <input type="hidden" id="a_d" name="a_d" value="0">
                            <input type="hidden" id="a_m" name="a_m" value="0">
                            <input type="hidden" id="a_t" name="a_t" value="0">
                            <input type="hidden" name="txt_country1" id="txt_country1">
                            <input type="hidden" name="txt_name1" id="txt_name1">
                            <input type="hidden" name="txt_email1" id="txt_email1">
                            <input type="hidden" name="txt_phone1" id="txt_phone1">
                            <input type="hidden" name="txt_travelers1" id="txt_travelers1">
                            <input type="hidden" name="txt_days1" id="txt_days1">
                            <input type="hidden" name="txt_date1" id="txt_date1">
                            <input type="hidden" name="txt_destinos1" id="txt_destinos1">
                            <input type="hidden" name="lista_itinerarios1" id="lista_itinerarios1">

                        </div>
                        <div class="col-lg-12 caja_verde">
                            <div class="row">
                                <div class="col-lg-3"><b class="text-20">New</b></div>
                                <div class="col-lg-3"><b class="text-20" id="dias_html">0d</b></div>
                                <div class="col-lg-3">$<b class="text-20" id="st_new">850</b></div>
                                <div class="col-lg-3 text-right margin-top-5 margin-bottom-5"><button type="submit" class="btn btn-green" onclick="enviar_form1()">GO</button></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5" style="height: 500px; overflow-y: auto;">
                <div id="lista_itinerarios">
                    @php
                    $pos_itinerario=0;
                    @endphp
                    @foreach($destinos as $destino)
                        <div id="group_destino_{{$destino->id}}" class="hide">
                            <div class="row">
                                <b class="font-montserrat text-orange-goto text-20">{{$destino->destino}}</b>
                            </div>
                            @foreach($itinerarios_d->where('destino', $destino->destino) as $iti)
                                @foreach($itinerarios->where('id',$iti->m_itinerario_id) as $itinerario)
                                    @php
                                        $encontrado=1;
                                        $pos_itinerario++;
                                    @endphp
                                    @if($encontrado==1)
                                        <div id="itinerario{{$itinerario->id}}" class="row margin-bottom-5">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                @php
                                                    $servicios1='';
                                                    $precio_iti=0;
                                                    $destinos_iti='';
                                                @endphp
                                                    @foreach($itinerario->itinerario_itinerario_servicios as $servicios)
                                                        <?php
                                                        if($servicios->itinerario_servicios_servicio->grupo!='HOTELS'){
                                                            if($servicios->itinerario_servicios_servicio->precio_grupo==1){
                                                                $precio_iti+=round($servicios->itinerario_servicios_servicio->precio_venta/intval(2),2);
                                                                $servicios1.=$servicios->itinerario_servicios_servicio->nombre.'//'.round($servicios->itinerario_servicios_servicio->precio_venta/intval(2),2).'//'.$servicios->itinerario_servicios_servicio->precio_grupo.'*';
                                                            }
                                                            else{
                                                                $precio_iti+=$servicios->itinerario_servicios_servicio->precio_venta;
                                                                $servicios1.=$servicios->itinerario_servicios_servicio->nombre.'//'.$servicios->itinerario_servicios_servicio->precio_venta.'//'.$servicios->itinerario_servicios_servicio->precio_grupo.'*';

                                                            }
                                                        }
                                                        ?>
                                                    @endforeach
                                                    @foreach($itinerario->destinos as $destino)
                                                        <?php
                                                        $destinos_iti.=$destino->destino.'*';
                                                        ?>
                                                    @endforeach
                                                    <?php
                                                    $destinos_iti=substr($destinos_iti,0,strlen($destinos_iti)-1);
                                                    $servicios1=substr($servicios1,0,strlen($servicios1)-1);
                                                    ?>
                                                    <input class="itinerario" type="checkbox" aria-label="..." name="itinerarios" value="{{$itinerario->id}}_{{$destinos_iti}}_{{$itinerario->titulo}}_{{$itinerario->descripcion}}_{{$precio_iti}}_{{$servicios1}}">
                                                </span>
                                                <input type="text" class="form-control" aria-label="..." value="{{$itinerario->titulo}}" readonly>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapse_{{$pos_itinerario}}"><b>${{$precio_iti}}</b> <i class="fa fa-arrows-v" aria-hidden="true"></i></button>
                                                </span>
                                            </div>
                                            <div class="collapse clearfix" id="collapse_{{$pos_itinerario}}">
                                                <div class="col-md-12 well margin-top-5">
                                                    {{$itinerario->descripcion}}
                                                    <h5><b>Services</b></h5>
                                                    <table class="table table-condensed table-striped">
                                                        <thead>
                                                        <tr class="bg-grey-goto text-white">
                                                            <th colspan="2">Concepts</th>
                                                            <th>Prices</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($itinerario->itinerario_itinerario_servicios as $servicios)
                                                            <tr>
                                                                <td>{{$servicios->itinerario_servicios_servicio->nombre}}</td>
                                                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                                                                <td>
                                                                    @if($servicios->itinerario_servicios_servicio->precio_grupo==1)
                                                                        {{round($servicios->itinerario_servicios_servicio->precio_venta/2,2)}}
                                                                    @else
                                                                        {{$servicios->itinerario_servicios_servicio->precio_venta}}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @php
                                        $encontrado=0;
                                    @endphp
                                @endforeach
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-2">
                <a href="#!" class="btn btn-primary" onclick="Pasar_datos1()"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                <input type="hidden" name="nroItinerario" id="nroItinerario" value="0">
            </div>
            <div class="col-lg-4">
                <div class="grid ui-sortable" id="Lista_itinerario_g" onmouseup="ordenar_itinerarios1()">
                </div>
            </div>
        </div>
        <div class="hide">
        <div class="row">
            <div class="col-md-12">
                <h4 class="font-montserrat text-primary"><span class="label bg-primary">1</span> Client</h4>
                <div class="divider margin-bottom-20"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="txt_name">Name</label>
                    <input type="text" class="form-control" id="txt_name" name="txt_name" placeholder="Name" >
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="txt_email">Email</label>
                    <input type="email" class="form-control" id="txt_email" name="txt_email" placeholder="Email">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="txt_country">Country</label>
                    <input type="text" class="form-control" id="txt_country" name="txt_country" placeholder="Country">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="txt_phone">Phone</label>
                    <input type="text" class="form-control" id="txt_phone" name="txt_phone" placeholder="Phone">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="font-montserrat text-primary"><span class="label bg-primary">2</span> Details</h4>
                <div class="divider margin-bottom-20"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="txt_travellers">Travellers</label>
                    <input type="number" class="form-control" id="txt_travellers" name="txt_travellers" placeholder="Travellers" min="1">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="txt_days">Days</label>
                    <input type="number" class="form-control" id="txt_days" name="txt_days" placeholder="Days" min="1" onchange="pasar_dias()">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="txt_travel_date">Travel date</label>
                    <input type="date" class="form-control" id="txt_travel_date" name="txt_travel_date" placeholder="Travel date">
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="font-montserrat text-primary"><span class="label bg-primary">3</span> Categories</h4>
                <div class="divider margin-bottom-20"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="checkbox1">
                    <label class=" text-orange-goto">
                        <input class="destinospack" type="checkbox" name="strellas_2" id="strellas_2" value="2" onchange="filtrar_estrellas1(2)">
                        2 <i class="fa fa-star-half-o fa-3x" aria-hidden="true"></i>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkbox1">
                    <label class=" text-orange-goto">
                        <input class="destinospack" type="checkbox" name="strellas_3" id="strellas_3" value="3" onchange="filtrar_estrellas1(3)">
                        3 <i class="fa fa-star-half-o fa-3x" aria-hidden="true"></i>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkbox1">
                    <label class=" text-orange-goto">
                        <input class="destinospack" type="checkbox" name="strellas_4" id="strellas_4" value="4" onchange="filtrar_estrellas1(4)">
                        4 <i class="fa fa-star-half-o fa-3x" aria-hidden="true"></i>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkbox1">
                    <label class=" text-orange-goto">
                        <input class="destinospack" type="checkbox" name="strellas_5" id="strellas_5" value="5" onchange="filtrar_estrellas1(5)">
                        5 <i class="fa fa-star-half-o fa-3x" aria-hidden="true"></i>
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="font-montserrat text-primary"><span class="label bg-primary">4</span> Acomodacion</h4>
                <div class="divider margin-bottom-20"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="checkbox1">
                    <label class=" text-unset">
                        <input class="destinospack" type="checkbox" name="acomodacion_s" id="acomodacion_s" value="1">
                        <b class="text-20px"><i class="fa fa-bed fa-2x" aria-hidden="true"></i></b>
                    </label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="checkbox1">
                    <label class=" text-unset">
                        <input class="destinospack" type="checkbox" name="acomodacion_d" id="acomodacion_d" value="2">
                        <b class="text-20px"><i class="fa fa-bed fa-2x" aria-hidden="true"></i> <i class="fa fa-bed fa-2x" aria-hidden="true"></i></b>
                    </label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="checkbox1">
                    <label class=" text-unset">
                        <input class="destinospack" type="checkbox" name="acomodacion_m" id="acomodacion_m" value="2">
                        <b class="text-20px"><i class="fa fa-venus-mars fa-2x" aria-hidden="true"></i></b>
                    </label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="checkbox1">
                    <label class=" text-unset">
                        <input class="destinospack" type="checkbox" name="acomodacion_t" id="acomodacion_t" value="3">
                        <b class="text-20px"><i class="fa fa-bed fa-2x" aria-hidden="true"></i> <i class="fa fa-bed fa-2x" aria-hidden="true"></i> <i class="fa fa-bed fa-2x" aria-hidden="true"></i></b>

                    </label>
                </div>
            </div>

        </div>
        <div id="list-package"  class="row hide">
            <div class="col-md-3">
                <div class="portada-pdf">
                    <img src="{{asset('img/portada/new-proposal.jpg')}}" alt="" class="img-responsive">
                    <div class="box-dowload">
                        <b class="margin-top-5"><i class="fa fa-newspaper-o text-green-goto" aria-hidden="true"></i> New Package</b>
                        <a href="{{asset('pdf/proposals_1.pdf')}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                    </div>
                    <div class="box-letter-proposal text-center">
                        NEW
                    </div>
                </div>
            </div>
            <div class="col-md-3 hide">
                <div class="portada-pdf">
                    <img src="{{asset('img/portada/proposal-martin-pdf.jpg')}}" alt="" class="img-responsive">
                    <div class="box-dowload">
                        <b class="margin-top-5"><i class="fa fa-file-pdf-o text-danger" aria-hidden="true"></i> GTP900-B.jpg</b>
                        <a href="{{asset('pdf/proposals_1.pdf')}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a>
                    </div>
                    <div class="box-letter-proposal text-center">
                        B
                    </div>
                </div>
            </div>
            <div class="col-md-3 hide">
                <div class="portada-pdf">
                    <img src="{{asset('img/portada/proposal-martin-pdf.jpg')}}" alt="" class="img-responsive">
                    <div class="box-dowload">
                        <b class="margin-top-5"><i class="fa fa-file-pdf-o text-danger" aria-hidden="true"></i> GTP900-C.jpg</b>
                        <a href="{{asset('pdf/proposals_1.pdf')}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a>
                    </div>
                    <div class="box-letter-proposal text-center">
                        C
                    </div>
                </div>
            </div>
        </div>
        <div class="row margin-top-20">
            <div class="col-md-12">
                <h4 class="font-montserrat text-primary"><span class="label bg-primary">5</span> Destinations</h4>
                <div class="divider margin-bottom-20"></div>
            </div>
        </div>
        <div class="row">
            {{csrf_field()}}
            @foreach($destinos as $destino)
                <div class="col-md-3">
                    <div class="checkbox1">
                        <label class=" text-unset">
                            <input class="destinospack" type="checkbox" name="destinos[]" value="{{$destino->destino}}">
                            {{$destino->destino}}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row margin-top-20">
            <div class="col-md-12 text-center">
                {{csrf_field()}}
                <button type="submit" class="btn btn-lg btn-primary">Create package <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
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