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
        <div class="col-lg-6">
            <h3>{{$cliente->nombres}} {{$cliente->apellidos}}</h3>
            @php
                $s=0;
                $d=0;
                $m=0;
                $t=0;
            @endphp
            @foreach($cotizaciones as $cotizacion)
                <b class="text-warning text-25">{{$cotizacion->nropersonas}} PAXS {{$cotizacion->star_2}}{{$cotizacion->star_3}}{{$cotizacion->star_4}}{{$cotizacion->star_5}} STARS:</b>
                @foreach($cotizacion->paquete_cotizaciones as $paquete)
                    @foreach($paquete->paquete_precios as $precio)
                        <b class="text-unset text-20">
                            @if($precio->personas_s>0)
                                SINGLE
                                @php
                                    $s=1;
                                @endphp
                            @endif
                            @if($precio->personas_d>0)
                                DOUBLE
                                @php
                                    $d=1;
                                @endphp
                            @endif
                            @if($precio->personas_m>0)
                                MATRIMONIAL
                                @php
                                    $m=1;
                                @endphp
                            @endif
                            @if($precio->personas_t>0)
                                TRIPLE
                                @php
                                    $t=1;
                                @endphp
                            @endif
                        </b>
                    @endforeach
                @endforeach
            @endforeach
        </div>
        <div class="col-lg-6">
            <div class="col-lg-2"></div>
            <div class="col-lg-1 caja_paso_activo text-30 text-center"><b>1</b></div>
            <div class="col-lg-1 caja_paso_noactivo text-30 text-center"><b>2</b></div>
            <div class="col-lg-2"></div>
        </div>
    </div>
    @foreach($cotizaciones as $cotizacion)
        @foreach($cotizacion->paquete_cotizaciones as $paquete)
            @foreach($paquete->itinerario_cotizaciones as $itinerario)
                <div class="row caja_items">
                    <div class="col-lg-1 caja_dia_indice">
                        DAY {{$itinerario->dias}}
                    </div>
                    <div class="col-lg-5">
                        <div class="row caja_dia">
                            <div class="col-lg-9">{{$itinerario->titulo}}</div>
                            <div class="col-lg-1 @if($s==0) hide @endif">S</div>
                            <div class="col-lg-1 @if($d==0) hide @endif">D</div>
                            <div class="col-lg-1 @if($t==0) hide @endif">T</div>
                        </div>
                        <div class="row caja_detalle">
                            @foreach($itinerario->itinerario_servicios as $servicios)
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-10">{{$servicios->nombre}}</div>
                                        <div class="col-lg-2">
                                            <a class="btn" data-toggle="modal" data-target="#modal_new_destination1_{{$servicios->id}}">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            <!-- Modal -->
                                            <div class="modal fade bd-example-modal-lg" id="modal_new_destination1_{{$servicios->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <form action="{{route('destination_save_path')}}" method="post" id="destination_save_id" enctype="multipart/form-data">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Editar Servicio</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @php
                                                                    $grupo='';
                                                                    $loca='';
                                                                @endphp
                                                                @foreach($m_servicios->where('id',$servicios->m_servicios_id) as $servicio)
                                                                    @php
                                                                        $grupo='';
                                                                        $loca='';
                                                                    @endphp
                                                                @endforeach
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="txt_codigo">Codigo</label>
                                                                            <input type="text" class="form-control" id="txt_codigo" name="txt_codigo" placeholder="Codigo">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 ">
                                                                        <div class="form-group">
                                                                            <label for="txt_destino">Destino</label>
                                                                            <input type="text" class="form-control" id="txt_destino" name="txt_destino" placeholder="Destino">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="txt_descripcion">Descripcion</label>
                                                                            <input type="text" class="form-control" id="txt_descripcion" name="txt_descripcion" placeholder="Descripcion">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="txt_pais">Pais</label>
                                                                            <input type="text" class="form-control" id="txt_pais" name="txt_pais" placeholder="Pais" VALUE="PERÚ">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 hide">
                                                                        <div class="form-group">
                                                                            <label for="txt_region">Region</label>
                                                                            <select class="custom-select form-control" id="txt_region" name="txt_region" >
                                                                                <option selected>Abrir menu</option>
                                                                                <option value="COSTA">COSTA</option>
                                                                                <option value="SIERRA">SIERRA</option>
                                                                                <option value="SELVA">SELVA</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 hide">
                                                                        <div class="form-group">
                                                                            <label for="txt_departamento">Departamento</label>
                                                                            <select class="custom-select form-control" id="txt_departamento" name="txt_departamento" >
                                                                                <option selected>Abrir menu</option>
                                                                                <option value="AMAZONAS">AMAZONAS</option>
                                                                                <option value="ANCASH">ANCASH</option>
                                                                                <option value="APURIMAC">APURIMAC</option>
                                                                                <option value="AREQUIPA">AREQUIPA</option>
                                                                                <option value="AYACUCHO">AYACUCHO</option>
                                                                                <option value="CAJAMARCA">CAJAMARCA</option>
                                                                                <option value="CALLAO">CALLAO</option>
                                                                                <option value="CUSCO">CUSCO</option>
                                                                                <option value="HUANCAVELICA">HUANCAVELICA</option>
                                                                                <option value="HUANUCO">HUANUCO</option>
                                                                                <option value="ICA">ICA</option>
                                                                                <option value="JUNIN">JUNIN</option>
                                                                                <option value="LA LIBERTAD">LA LIBERTAD</option>
                                                                                <option value="LAMBAYEQUE">LAMBAYEQUE</option>
                                                                                <option value="LIMA">LIMA</option>
                                                                                <option value="LORETO">LORETO</option>
                                                                                <option value="MADRE DE DIOS">MADRE DE DIOS</option>
                                                                                <option value="MOQUEGUA">MOQUEGUA</option>
                                                                                <option value="PASCO">PASCO</option>
                                                                                <option value="PIURA">PIURA</option>
                                                                                <option value="PUNO">PUNO</option>
                                                                                <option value="SAN MARTIN">SAN MARTIN</option>
                                                                                <option value="TACNA">TACNA</option>
                                                                                <option value="TUMBES">TUMBES</option>
                                                                                <option value="UCAYALI">UCAYALI</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="txt_imagen">Imagen</label>
                                                                            <input type="file" class="form-control" id="txt_imagen" name="txt_imagen" placeholder="Imagen">
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                {{csrf_field()}}
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1 @if($s==0) hide @endif">${{$servicios->precio}}</div>
                                <div class="col-lg-1 @if($d==0) hide @endif">${{$servicios->precio}}</div>
                                <div class="col-lg-1 @if($t==0) hide @endif">${{$servicios->precio}}</div>
                            @endforeach
                        </div>
                            @foreach($itinerario->hotel as $hotel)
                            <div class="row caja_detalle_hotel margin-bottom-15">
                            <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-10">HOTEL</div>
                                        <div class="col-lg-2">
                                            <a class="btn" data-toggle="modal" data-target="#modal_new_destination_{{$hotel->id}}">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            <!-- Modal -->
                                            <div class="modal fade bd-example-modal-lg" id="modal_new_destination_{{$hotel->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <form action="{{route('destination_save_path')}}" method="post" id="destination_save_id" enctype="multipart/form-data">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">New destination</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="txt_codigo">Codigo</label>
                                                                            <input type="text" class="form-control" id="txt_codigo" name="txt_codigo" placeholder="Codigo">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 ">
                                                                        <div class="form-group">
                                                                            <label for="txt_destino">Destino</label>
                                                                            <input type="text" class="form-control" id="txt_destino" name="txt_destino" placeholder="Destino">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="txt_descripcion">Descripcion</label>
                                                                            <input type="text" class="form-control" id="txt_descripcion" name="txt_descripcion" placeholder="Descripcion">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="txt_pais">Pais</label>
                                                                            <input type="text" class="form-control" id="txt_pais" name="txt_pais" placeholder="Pais" VALUE="PERÚ">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 hide">
                                                                        <div class="form-group">
                                                                            <label for="txt_region">Region</label>
                                                                            <select class="custom-select form-control" id="txt_region" name="txt_region" >
                                                                                <option selected>Abrir menu</option>
                                                                                <option value="COSTA">COSTA</option>
                                                                                <option value="SIERRA">SIERRA</option>
                                                                                <option value="SELVA">SELVA</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 hide">
                                                                        <div class="form-group">
                                                                            <label for="txt_departamento">Departamento</label>
                                                                            <select class="custom-select form-control" id="txt_departamento" name="txt_departamento" >
                                                                                <option selected>Abrir menu</option>
                                                                                <option value="AMAZONAS">AMAZONAS</option>
                                                                                <option value="ANCASH">ANCASH</option>
                                                                                <option value="APURIMAC">APURIMAC</option>
                                                                                <option value="AREQUIPA">AREQUIPA</option>
                                                                                <option value="AYACUCHO">AYACUCHO</option>
                                                                                <option value="CAJAMARCA">CAJAMARCA</option>
                                                                                <option value="CALLAO">CALLAO</option>
                                                                                <option value="CUSCO">CUSCO</option>
                                                                                <option value="HUANCAVELICA">HUANCAVELICA</option>
                                                                                <option value="HUANUCO">HUANUCO</option>
                                                                                <option value="ICA">ICA</option>
                                                                                <option value="JUNIN">JUNIN</option>
                                                                                <option value="LA LIBERTAD">LA LIBERTAD</option>
                                                                                <option value="LAMBAYEQUE">LAMBAYEQUE</option>
                                                                                <option value="LIMA">LIMA</option>
                                                                                <option value="LORETO">LORETO</option>
                                                                                <option value="MADRE DE DIOS">MADRE DE DIOS</option>
                                                                                <option value="MOQUEGUA">MOQUEGUA</option>
                                                                                <option value="PASCO">PASCO</option>
                                                                                <option value="PIURA">PIURA</option>
                                                                                <option value="PUNO">PUNO</option>
                                                                                <option value="SAN MARTIN">SAN MARTIN</option>
                                                                                <option value="TACNA">TACNA</option>
                                                                                <option value="TUMBES">TUMBES</option>
                                                                                <option value="UCAYALI">UCAYALI</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="txt_imagen">Imagen</label>
                                                                            <input type="file" class="form-control" id="txt_imagen" name="txt_imagen" placeholder="Imagen">
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                {{csrf_field()}}
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1 @if($hotel->personas_s==0) hide @endif">${{$hotel->precio_s}}</div>
                                <div class="col-lg-1 @if($hotel->personas_d==0) hide @endif">${{$hotel->precio_d}}</div>
                                <div class="col-lg-1 @if($hotel->personas_t==0) hide @endif">${{$hotel->precio_t}}</div>

                            </div>
                        @endforeach

                    </div>
                    <div class="col-lg-6">
                        <textarea name="" id="" cols="70" rows="8">{{$itinerario->descripcion}}</textarea>
                    </div>
                </div>

                {{--@foreach($itinerario->itinerario_servicios as $servicios)--}}
                    {{--{{$servicios->nombre}}--}}
                {{--@endforeach--}}
            @endforeach
        @endforeach
    @endforeach


    {{--</form>--}}
    <script>
        $(document).ready(function() {
            calcular_resumen();
        } );
    </script>
@stop