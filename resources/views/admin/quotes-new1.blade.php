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
            <div class="col-md-12 no-margin no-padding">
                <form action="" id="frm_datos" name="frm_datos" method="get">
                    <div class="row caja_datos">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-md-2 padding-1 no-margin">
                                    <div class="form-group">
                                        <label for="txt_name">Name</label>
                                        <input type="text" class="form-control" id="txt_name" name="txt_name" placeholder="Ingrese el nombre" onkeypress="return runScript(event)" value="{{$nombres}}" required>
                                    </div>
                                </div>
                                <div class="col-md-1 padding-1 no-margin">
                                    <div class="form-group">
                                        <label for="txt_country">Country</label>
                                        <input type="text" class="form-control" id="txt_country" name="txt_country" placeholder="Country" value="{{$nacionalidad}}">
                                    </div>
                                </div>
                                <div class="col-md-2 padding-1 no-margin">
                                    <div class="form-group">
                                        <label for="txt_email">Email</label>
                                        <input type="email" class="form-control" id="txt_email" name="txt_email" placeholder="Email" value="{{$email}}">
                                    </div>
                                </div>
                                <div class="col-md-1 padding-1 no-margin">
                                    <div class="form-group">
                                        <label for="txt_phone">Phone</label>
                                        <input type="text" class="form-control" id="txt_phone" name="txt_phone" placeholder="Phone" value="{{$telefono}}">
                                    </div>
                                </div>
                                <div class="col-md-1 padding-1 no-margin">
                                    <div class="form-group">
                                        <label for="txt_travellers">Travellers</label>
                                        <input type="number" class="form-control" id="txt_travellers" name="txt_travellers" placeholder="Travellers" min="1" onclick="sumar_servicios_itinerario()" value="{{$travelers}}">
                                    </div>
                                </div>
                                <div class="col-md-1 padding-1 no-margin">
                                    <div class="form-group">
                                        <label for="txt_days">Days</label>
                                        <input type="number" class="form-control" id="txt_days" name="txt_days" placeholder="Days" min="1" onchange="poner_dias()" value="{{$days}}">
                                    </div>
                                </div>
                                <div class="col-md-2 padding-1 no-margin">
                                    <div class="form-group">
                                        <label for="txt_travel_date">Travel date</label>
                                        <input type="date" class="form-control" id="txt_travel_date" name="txt_travel_date" placeholder="Travel date" value="{{$fecha}}">
                                    </div>
                                </div>
                                <div class="col-md-2 padding-1 no-margin">
                                        <div class="form-group">
                                            <label for="txt_travel_date">Pagina de origen</label>
                                            <select name="web" id="web" class="form-control">
                                                <option value="gotoperu.com" @if($web=='gotoperu.com') selected @endif>gotoperu.com</option>
                                                <option value="gotoperu.com.pe" @if($web=='gotoperu.com.pe') selected @endif>gotoperu.com.pe</option>
                                                <option value="andesviagens.com" @if($web=='andesviagens.com') selected @endif>andesviagens.com</option>
                                                <option value="machupicchu-galapagos.com" @if($web=='machupicchu-galapagos.com') selected @endif>machupicchu-galapagos.com</option>
                                                <option value="gotolatinamerica.com" @if($web=='gotolatinamerica.com') selected @endif>gotolatinamerica.com</option>
                                            </select>
                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                            <label class="text-orange-goto">
                                                <input type="radio" name="strellas[]" id="strellas_2" value="2" checked="checked" onchange="filtrar_estrellas1('2')">2 <i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i>
                                            </label>
                                            <label class="text-orange-goto">
                                                <input type="radio" name="strellas[]" id="strellas_3" value="3" onchange="filtrar_estrellas1('3')">3 <i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i>
                                            </label>
                                            <label class="text-orange-goto">
                                                <input type="radio" name="strellas[]" id="strellas_4" value="4" onchange="filtrar_estrellas1('4')">4 <i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i>
                                            </label>
                                            <label class="text-orange-goto">
                                                <input type="radio" name="strellas[]" id="strellas_5" value="5" onchange="filtrar_estrellas1('5')">5 <i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i>
                                            </label>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="caja no-padding no-margin">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <b class="text-20" id="a_s_1">0</b>
                                                        <b class="text-20px"><i class="fa fa-bed fa-2x" aria-hidden="true"></i></b>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <a href="#!" onclick="aumentar_acom('s','-')"><i class="fa fa-minus-circle fa-2x" aria-hidden="true"></i></a>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <a href="#!" onclick="aumentar_acom('s','+')"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="caja">
                                                {{--<input class="destinospack" type="checkbox" name="acomodacion_s" id="acomodacion_s" value="1">--}}
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <b class="text-20" id="a_d_1">0</b>
                                                        <b class="text-20px"><i class="fa fa-bed fa-2x" aria-hidden="true"></i> <i class="fa fa-bed fa-2x" aria-hidden="true"></i></b>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <a href="#!" onclick="aumentar_acom('d','-')"><i class="fa fa-minus-circle fa-2x" aria-hidden="true"></i></a>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <a href="#!" onclick="aumentar_acom('d','+')"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="caja">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <b class="text-20" id="a_m_1">0</b>
                                                    <b class="text-20px"><i class="fa fa-venus-mars fa-2x" aria-hidden="true"></i></b>
                                                </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-lg-6">
                                                        <a href="#!" onclick="aumentar_acom('m','-')"><i class="fa fa-minus-circle fa-2x" aria-hidden="true"></i></a>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <a href="#!" onclick="aumentar_acom('m','+')"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="caja">
                                            {{--<input class="destinospack" type="checkbox" name="acomodacion_s" id="acomodacion_s" value="1">--}}
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <b class="text-20" id="a_t_1">0</b>
                                                    <b class="text-20px"><i class="fa fa-bed fa-2x" aria-hidden="true"></i> <i class="fa fa-bed fa-2x" aria-hidden="true"></i> <i class="fa fa-bed fa-2x" aria-hidden="true"></i></b>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <a href="#!" onclick="aumentar_acom('t','-')"><i class="fa fa-minus-circle fa-2x" aria-hidden="true"></i></a>
                                                </div>
                                                <div class="col-lg-6">
                                                    <a href="#!" onclick="aumentar_acom('t','+')"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                            $h2_s=0;
                            $h2_d=0;
                            $h2_m=0;
                            $h2_t=0;

                            $h3_s=0;
                            $h3_d=0;
                            $h3_m=0;
                            $h3_t=0;

                            $h4_s=0;
                            $h4_d=0;
                            $h4_m=0;
                            $h4_t=0;

                            $h5_s=0;
                            $h5_d=0;
                            $h5_m=0;
                            $h5_t=0;
                            $hotel_id_2=0;
                            $hotel_id_3=0;
                            $hotel_id_4=0;
                            $hotel_id_5=0;
                            @endphp
                            @foreach($hotel->where('localizacion','CUSCO')->take(4) as $hotels)
                                @if($hotels->estrellas=='2')
                                  @php
                                      $h2_s=$hotels->single;
                                      $h2_d=$hotels->doble;
                                      $h2_m=$hotels->matrimonial;
                                      $h2_t=$hotels->triple;
                                      $hotel_id_2=$hotels->id;
                                  @endphp
                                @endif

                                    @if($hotels->estrellas=='3')
                                        @php
                                            $h3_s=$hotels->single;
                                            $h3_d=$hotels->doble;
                                            $h3_m=$hotels->matrimonial;
                                            $h3_t=$hotels->triple;
                                            $hotel_id_3=$hotels->id;
                                        @endphp
                                    @endif

                                    @if($hotels->estrellas=='4')
                                        @php
                                            $h4_s=$hotels->single;
                                            $h4_d=$hotels->doble;
                                            $h4_m=$hotels->matrimonial;
                                            $h4_t=$hotels->triple;
                                            $hotel_id_4=$hotels->id;
                                        @endphp
                                    @endif

                                    @if($hotels->estrellas=='5')
                                        @php
                                            $h5_s=$hotels->single;
                                            $h5_d=$hotels->doble;
                                            $h5_m=$hotels->matrimonial;
                                            $h5_t=$hotels->triple;
                                            $hotel_id_5=$hotels->id;
                                        @endphp
                                    @endif
                            @endforeach
                            <input type="hidden" name="h2_s" id="h2_s" value="{{$h2_s}}">
                            <input type="hidden" name="h2_d" id="h2_d" value="{{$h2_d}}">
                            <input type="hidden" name="h2_m" id="h2_m" value="{{$h2_m}}">
                            <input type="hidden" name="h2_t" id="h2_t" value="{{$h2_t}}">

                            <input type="hidden" name="h3_s" id="h3_s" value="{{$h3_s}}">
                            <input type="hidden" name="h3_d" id="h3_d" value="{{$h3_d}}">
                            <input type="hidden" name="h3_m" id="h3_m" value="{{$h3_m}}">
                            <input type="hidden" name="h3_t" id="h3_t" value="{{$h3_t}}">

                            <input type="hidden" name="h4_s" id="h4_s" value="{{$h4_s}}">
                            <input type="hidden" name="h4_d" id="h4_d" value="{{$h4_d}}">
                            <input type="hidden" name="h4_m" id="h4_m" value="{{$h4_m}}">
                            <input type="hidden" name="h4_t" id="h4_t" value="{{$h4_t}}">

                            <input type="hidden" name="h5_s" id="h5_s" value="{{$h5_s}}">
                            <input type="hidden" name="h5_d" id="h5_d" value="{{$h5_d}}">
                            <input type="hidden" name="h5_m" id="h5_m" value="{{$h5_m}}">
                            <input type="hidden" name="h5_t" id="h5_t" value="{{$h5_t}}">

                            <div class="margin-top-15"></div>
                            <div class="row">
                                <div class="col-lg-2 text-center">
                                    <label>
                                        <b class="text-18">DAYS</b></br>
                                        <b id="dias3" class="text-18">0</b>
                                    </label>
                                </div>
                                <div class="col-lg-10">
                                    @php
                                        $deti='';
                                    @endphp
                                    @foreach($destinos as $destino)
                                        <div class="col-md-3">
                                            <div class="checkbox1">
                                                <label class=" text-unset">
                                                    <input class="destinospack" type="checkbox" name="destinos[]" value="{{$destino->id.'_'.$destino->destino}}" onchange="filtrar_itinerarios1()">
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
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <input type="hidden" id="desti" value="{{$deti}}">

            <div class="col-sm-12">
                <ul class="nav nav-tabs nav-justified" role="tablist">
                    <li role="presentation" class="nav-quotes active" data-toggle="tooltip" data-placement="top" title="Database"><a href="#database" aria-controls="database" role="tab" data-toggle="tab">PACKAGES</a></li>
                    <li role="presentation" class="nav-quotes" data-toggle="tooltip" data-placement="top" title="Database"><a href="#new" aria-controls="new" role="tab" data-toggle="tab">NEW</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="database">
                        {{--<div class="row caja_itinerario" style="height: 600px; overflow-y: auto;">--}}
                        <div class="row caja_itinerario">
                            <div class="text-center"><i id="caja_load" class="fa fa-spinner hide" aria-hidden="true"></i></div>
                            @php
                                $pos=0;
                                $precio_hotel_s=0;
                                $precio_hotel_d=0;
                                $precio_hotel_m=0;
                                $precio_hotel_t=0;
                            @endphp
                            @foreach($p_paquete as $p_paquete_)
                                @php
                                    $iti_total=0;
                                        $pos++;
                                        $array_destinos1='';
                                        $array_destinos2=array();
                                @endphp
                                @foreach($p_paquete_->itinerarios as $itinerarios0)
                                    @foreach($itinerarios0->destinos as $destino0)
                                        @php
                                            $array_destinos2[$destino0->destino]=$destino0->destino;
                                        @endphp
                                    @endforeach
                                @endforeach
                                @foreach($array_destinos2 as $destino12)
                                    @php
                                        $array_destinos1.=$destino12.'/';
                                    @endphp
                                @endforeach

                                @php
                                    $array_destinos1=substr($array_destinos1,0,(strlen($array_destinos1)-1));
                                @endphp

                                <div class="col-md-4 hide" id="itinerario3_{{$pos}}">
                                    <div class="col-lg-12 checkbox1">
                                        @php
                                            $hotel0='';
                                            $cadena_hiden='';
                                        @endphp
                                        @foreach($p_paquete_->precios as $precio0)
                                            @php
                                               $hotel0.=$precio0->precio_s.'_'.$precio0->precio_d.'_'.$precio0->precio_m.'_'.$precio0->precio_t.'/';
                                            @endphp
                                        @endforeach
                                        @foreach($p_paquete_->itinerarios as $itinerarios0)
                                            @foreach($itinerarios0->serivicios as $serivicios0)
                                                @if($serivicios0->precio_grupo==1)
                                                    @php
                                                        $iti_total+=$serivicios0->precio;
                                                        $cadena_hiden.=($serivicios0->precio*2).'_g/';
                                                    @endphp
                                                @else
                                                    @php
                                                        $iti_total+=$serivicios0->precio;
                                                        $cadena_hiden.=$serivicios0->precio.'_i/';
                                                    @endphp
                                                @endif
                                            @endforeach

                                        @endforeach
                                        <label class=" text-unset text-warning text-12 lista_itinerarios2">
                                            <input class="lista_itinerarios3" type="hidden"  value="{{$p_paquete_->id.'_'.$p_paquete_->duracion.'_'.$array_destinos1}}">
                                            <input class="paquetespack" type="radio" name="paquetes[]" value="{{$p_paquete_->id.'_'.$p_paquete_->duracion.'_'.$array_destinos1}}" onchange="mostrar_datos('{{$p_paquete_->id.'_'.$p_paquete_->duracion.'_'.$iti_total}}')">
                                            <input type="hidden" name="datos_paquete_{{$p_paquete_->id}}" id="datos_paquete_{{$p_paquete_->id}}" value="{{$hotel0}}">
                                            <input type="hidden" class="lista_itinerarios4" id="lista_servicios_{{$p_paquete_->id}}" value="{{$cadena_hiden}}">
                                            {{$p_paquete_->duracion}} {{$p_paquete_->titulo}}
                                        </label>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="collapse in" id="collapseExample_{{$p_paquete_->id}}">
                                            <div class="card card-body">
                                                <div class="caja_itineario">
                                                    @foreach($p_paquete_->itinerarios as $itinerarios0)
                                                        <div class="row">
                                                            <div class="col-lg-12 text-10">
                                                                <b class="dias">Dia {{$itinerarios0->dias}}</b> {{$itinerarios0->titulo}}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-right ">
                                        <b class="text-15 text-green-goto margin-right-15">${{$iti_total}}</b>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row caja_n_v">
                            <form action="{{route('nuevo_paquete_plantilla_path')}}" method="post" id="form_nuevo_pqt_" name="form_nuevo_pqt_">
                                <div class="col-lg-12 caja_negro">
                                    <span  id="estrellas_">2 STARS</span>
                                    {{csrf_field()}}
                                    <input type="hidden" id="estrellas_from_" name="estrellas_from_" value="2">
                                    <input type="hidden" id="a_s_" name="a_s_" value="0">
                                    <input type="hidden" id="a_d_" name="a_d_" value="0">
                                    <input type="hidden" id="a_m_" name="a_m_" value="0">
                                    <input type="hidden" id="a_t_" name="a_t_" value="0">
                                    <input type="hidden" name="txt_country1_" id="txt_country1_">
                                    <input type="hidden" name="txt_name1_" id="txt_name1_">
                                    <input type="hidden" name="txt_email1_" id="txt_email1_">
                                    <input type="hidden" name="txt_phone1_" id="txt_phone1_">
                                    <input type="hidden" name="txt_travelers1_" id="txt_travelers1_">
                                    <input type="hidden" name="txt_days1_" id="txt_days1_">
                                    <input type="hidden" name="txt_date1_" id="txt_date1_">
                                    <input type="hidden" name="txt_destinos1_" id="txt_destinos1_">
                                    <input type="hidden" name="pqt_id" id="pqt_id" value="0">
                                    <input type="hidden" name="plan" id="plan" value="{{$plan}}">
                                    <input type="hidden" name="cotizacion_id_" id="cotizacion_id_" value="{{$coti_id}}">
                                    <input type="hidden" name="cliente_id_" id="cliente_id_" value="{{$cliente_id}}">
                                    <input type="hidden" name="web_" id="web_" value="gotoperu.com">

                                </div>
                                <div class="col-lg-12 caja_verde">
                                    <div class="row">
                                        <div class="col-lg-3"><b class="text-20">New</b></div>
                                        <div class="col-lg-3"><b class="text-20" id="dias_html_0">{{$days}}d</b></div>
                                        <div class="col-lg-3"><b class="text-20" id="precio_plantilla">$0</b></div>
                                        <div class="col-lg-3 text-right margin-top-5 margin-bottom-5"><button type="submit" class="btn btn-green" onclick="enviar_form2()">GO</button></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="new">
                        <div class="col-lg-5 margin-top-25">
                            <b class="text-center text-30 hide">NEW ITINERARY</b>
                            <div class="col-lg-12" style="height: 500px; overflow-y: auto;">
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
                                                        <div id="itinerario{{$itinerario->id}}" class="row margin-bottom-0">
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
                                                                $precio_iti+=round($servicios->itinerario_servicios_servicio->precio_venta/intval(1),2);
                                                                $servicios1.=$servicios->itinerario_servicios_servicio->id.'//'.$servicios->itinerario_servicios_servicio->nombre.'//'.round($servicios->itinerario_servicios_servicio->precio_venta/intval(1),2).'//'.$servicios->itinerario_servicios_servicio->precio_grupo.'*';
                                                            }
                                                            else{
                                                                $precio_iti+=$servicios->itinerario_servicios_servicio->precio_venta;
                                                                $servicios1.=$servicios->itinerario_servicios_servicio->id.'//'.$servicios->itinerario_servicios_servicio->nombre.'//'.$servicios->itinerario_servicios_servicio->precio_venta.'//'.$servicios->itinerario_servicios_servicio->precio_grupo.'*';

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
                                                                                        {{round($servicios->itinerario_servicios_servicio->precio_venta/1,2)}}
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
                        </div>
                        <div class="col-lg-2 margin-top-40">
                            <a href="#!" class="btn btn-primary" onclick="Pasar_datos1()"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                            <input type="hidden" name="nroItinerario" id="nroItinerario" value="0">
                        </div>
                        <div class="col-lg-4 margin-top-25">
                            <div class="row caja_n_v">
                                <form action="{{route('nuevo_paquete_path')}}" method="post" id="form_nuevo_pqt" name="form_nuevo_pqt">
                                    <div class="col-lg-12 caja_negro">
                                        <span  id="estrellas">2 STARS</span>
                                        {{csrf_field()}}
                                        <input type="hidden" id="estrellas_from" name="estrellas_from" value="2">
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
                                        <input type="hidden" name="totalItinerario" id="totalItinerario" value="0">
                                        <input type="hidden" name="plan1" id="plan1" value="{{$plan}}">
                                        <input type="hidden" name="cotizacion_id_1" id="cotizacion_id_1" value="{{$coti_id}}">
                                        <input type="hidden" name="cliente_id_1" id="cliente_id_1" value="{{$cliente_id}}">
                                        <input type="hidden" name="web1" id="web1" value="gotoperu.com">

                                        <input type="hidden" name="h2_s_" id="h2_s_" value="{{$h2_s}}">
                                        <input type="hidden" name="h2_d_" id="h2_d_" value="{{$h2_d}}">
                                        <input type="hidden" name="h2_m_" id="h2_m_" value="{{$h2_m}}">
                                        <input type="hidden" name="h2_t_" id="h2_t_" value="{{$h2_t}}">

                                        <input type="hidden" name="h3_s_" id="h3_s_" value="{{$h3_s}}">
                                        <input type="hidden" name="h3_d_" id="h3_d_" value="{{$h3_d}}">
                                        <input type="hidden" name="h3_m_" id="h3_m_" value="{{$h3_m}}">
                                        <input type="hidden" name="h3_t_" id="h3_t_" value="{{$h3_t}}">

                                        <input type="hidden" name="h4_s_" id="h4_s_" value="{{$h4_s}}">
                                        <input type="hidden" name="h4_d_" id="h4_d_" value="{{$h4_d}}">
                                        <input type="hidden" name="h4_m_" id="h4_m_" value="{{$h4_m}}">
                                        <input type="hidden" name="h4_t_" id="h4_t_" value="{{$h4_t}}">

                                        <input type="hidden" name="h5_s_" id="h5_s_" value="{{$h5_s}}">
                                        <input type="hidden" name="h5_d_" id="h5_d_" value="{{$h5_d}}">
                                        <input type="hidden" name="h5_m_" id="h5_m_" value="{{$h5_m}}">
                                        <input type="hidden" name="h5_t_" id="h5_t_" value="{{$h5_t}}">

                                        <input type="hidden" name="hotel_id_2" id="hotel_id_2" value="{{$hotel_id_2}}">
                                        <input type="hidden" name="hotel_id_3" id="hotel_id_3" value="{{$hotel_id_3}}">
                                        <input type="hidden" name="hotel_id_4" id="hotel_id_4" value="{{$hotel_id_4}}">
                                        <input type="hidden" name="hotel_id_5" id="hotel_id_5" value="{{$hotel_id_5}}">


                                    </div>
                                    <div class="col-lg-12 caja_verde">
                                        <div class="row">
                                            <div class="col-lg-3"><b class="text-20">New</b></div>
                                            <div class="col-lg-3"><b class="text-20" id="dias_html">{{$days}}d</b></div>
                                            <div class="col-lg-3">$<b class="text-20" id="st_new">0</b></div>
                                            <div class="col-lg-3 text-right margin-top-5 margin-bottom-5"><button type="submit" class="btn btn-green" onclick="enviar_form1()">GO</button></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class='col-md-12 box-list-book2'>
                                            <li value="0" class="borar_stetica">
                                                <ol id="Lista_itinerario_g" class='simple_with_animation vertical no-padding no-margin'>

                                                </ol>
                                            </li>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-4 hide">
                <b class="text-center text-30">ITINERARIES</b>
                <div class="col-lg-12 hide">
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
                    <label for="txt_name2">Name</label>
                    <input type="text" class="form-control" id="txt_name2" name="txt_name2" placeholder="Name" >
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
                        <input class="destinospack4" type="checkbox" name="strellas_2" id="strellas_2" value="2" onchange="filtrar_estrellas1(2)">
                        2 <i class="fa fa-star-half-o fa-3x" aria-hidden="true"></i>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkbox1">
                    <label class=" text-orange-goto">
                        <input class="destinospack4" type="checkbox" name="strellas_3" id="strellas_3" value="3" onchange="filtrar_estrellas1(3)">
                        3 <i class="fa fa-star-half-o fa-3x" aria-hidden="true"></i>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkbox1">
                    <label class=" text-orange-goto">
                        <input class="destinospack4" type="checkbox" name="strellas_4" id="strellas_4" value="4" onchange="filtrar_estrellas1(4)">
                        4 <i class="fa fa-star-half-o fa-3x" aria-hidden="true"></i>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkbox1">
                    <label class=" text-orange-goto">
                        <input class="destinospack4" type="checkbox" name="strellas_5" id="strellas_5" value="5" onchange="filtrar_estrellas1(5)">
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
                        <input class="destinospack5" type="checkbox" name="acomodacion_s" id="acomodacion_s" value="1">
                        <b class="text-20px"><i class="fa fa-bed fa-2x" aria-hidden="true"></i></b>
                    </label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="checkbox1">
                    <label class=" text-unset">
                        <input class="destinospack5" type="checkbox" name="acomodacion_d" id="acomodacion_d" value="2">
                        <b class="text-20px"><i class="fa fa-bed fa-2x" aria-hidden="true"></i> <i class="fa fa-bed fa-2x" aria-hidden="true"></i></b>
                    </label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="checkbox1">
                    <label class=" text-unset">
                        <input class="destinospack5" type="checkbox" name="acomodacion_m" id="acomodacion_m" value="2">
                        <b class="text-20px"><i class="fa fa-venus-mars fa-2x" aria-hidden="true"></i></b>
                    </label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="checkbox1">
                    <label class=" text-unset">
                        <input class="destinospack5" type="checkbox" name="acomodacion_t" id="acomodacion_t" value="3">
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

        $(function()
        {
            $( "#txt_name" ).autocomplete({
                source: "../../../quotes/autocomplete",
                minLength: 2,
                select: function(event, ui) {
                    $('#txt_name').val(ui.item.value);
                }
            });
        });


    </script>
    <script>
        var adjustment;

        $("ol.simple_with_animation").sortable({
            group: 'simple_with_animation',
            pullPlaceholder: false,
            tolerance: 6,
            // animation on drop
            onDrop: function  ($item, container, _super) {

                var $clonedItem = $('<li/>').css({height: 0});
                $item.before($clonedItem);
                $clonedItem.animate({'height': $item.height()});

                var s_cotizacion = $item.val();
                var s_porcentaje = $item.parent().parent().val();


                $item.animate($clonedItem.position(), function  () {
                    $clonedItem.detach();
                    _super($item, container);
                });

                var datos = {
                    "txt_cotizacion" : s_cotizacion,
                    "txt_porcentaje" : s_porcentaje
                };
                {{--$.ajaxSetup({--}}
                    {{--headers: {--}}
                        {{--'X-CSRF-TOKEN': $('[name="_token"]').val()--}}
                    {{--}--}}
                {{--});--}}
                {{--$.ajax({--}}
                    {{--data:  datos,--}}
                    {{--url:   "{{route('agregar_probabilidad_path')}}",--}}
                    {{--type:  'post',--}}

                {{--});--}}
                var cont=1;
                $(".dias_iti_c2").each(function (index) {
                    $(this).html('Dia '+cont+':');
                    cont++;
                });
            },

            // set $item relative to cursor position
            onDragStart: function ($item, container, _super) {

                var offset = $item.offset(),
                    pointer = container.rootGroup.pointer;

                adjustment = {
                    left: pointer.left - offset.left,
                    top: pointer.top - offset.top
                };

                _super($item, container);

            },
            onDrag: function ($item, position) {
                $item.css({
                    left: position.left - adjustment.left,
                    top: position.top - adjustment.top
                });

            }
        });
    </script>
@stop