@php
    function concatenar($texto,$nro){
        $top=4-strlen($nro);
        $valor='';
        for($i=0;$i<$top;$i++){
            $valor.='0';
        }
        return $texto.$valor.$nro;
    }
    $destinos_usados=array();
@endphp
@foreach($hotel as $hotel_)
    @if(!in_array($hotel_->localizacion,$destinos_usados))
        @php
            $destinos_usados[]=$hotel_->localizacion;
        @endphp
    @endif
@endforeach
@extends('layouts.admin.admin')
@section('archivos-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
@stop
@section('archivos-js')
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js")}}"></script>
@stop
@section('content')
    @php

    $todo_destinos='';
    @endphp
    @foreach($destinations as $destination)
        @php
            $todo_destinos.=$destination->id.'_';
        @endphp
    @endforeach
    @php
        $todo_destinos=substr($todo_destinos,0,strlen($todo_destinos)-1);
    @endphp
    <input type="hidden" name="todos_destinos" id="todos_destinos" value="{{$todo_destinos}}">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Database</li>
            <li class="active">Products</li>
        </ol>
    </div>
    <div class="row margin-top-20">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#modal_new_destination">
            New <i class="fa fa-plus-circle" aria-hidden="true"></i>
        </button>

        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="modal_new_destination" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="{{route('service_save_path')}}" method="post" id="service_save_id" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Service</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <ul class="nav nav-tabs">
                                <?php
                                $pos=0;
                                ?>
                                @foreach($categorias as $categoria)
                                    <?php
                                    $active='';
                                    $tipoServicio[]=$categoria->nombre;
                                    if($pos==0){
                                        $active='active';
                                    }
                                    ?>
                                    <li class="{{$active}}"><a data-toggle="tab" href="#{{$categoria->nombre}}" onclick="escojerPos({{$pos}},'{{$categoria->nombre}}')">{{$categoria->nombre}}</a></li>
                                    <?php
                                    $pos++;
                                    ?>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                <?php
                                $pos=0;
                                ?>
                                @foreach($categorias as $categoria)
                                    <?php
                                    $activo='';
                                    ?>
                                    @if($pos==0)
                                        <?php
                                        $activo='in active';
                                        ?>
                                    @endif
                                    <div id="{{$categoria->nombre}}" class="tab-pane fade {{$activo}}">
                                        <div class="row">
                                            @if($categoria->nombre!='HOTELS')
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="txt_codigo">Codigo</label>
                                                        <?php
                                                        $auto=concatenar(substr($categoria->nombre,0,3),strval(1));
                                                        if(count($servicios->where('grupo',$categoria->nombre))>0)
                                                            $auto=concatenar(substr($categoria->nombre,0,3),strval(count($servicios->where('grupo',$categoria->nombre))+1));
                                                        ?>
                                                        <input type="text" class="form-control" id="txt_codigo" name="txt_codigo_{{$pos}}" value="{{$auto}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="txt_codigo">Location</label>
                                                        {{--<input type="text" class="form-control" id="txt_localizacion_0" name="txt_localizacion_0" placeholder="Location">--}}
                                                        <select class="form-control" id="txt_localizacion_{{$pos}}" name="txt_localizacion_{{$pos}}" onchange="">
                                                            @foreach($destinations as $destination)
                                                                <option value="{{$destination->destino}}">{{$destination->destino}}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" name="tipoServicio_{{$pos}}" id="tipoServicio_{{$pos}}" value="{{$categoria->nombre}}">
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='HOTELS')
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="txt_codigo">Location</label>
                                                        {{--<input type="text" class="form-control" id="txt_localizacion_0" name="txt_localizacion_0" placeholder="Location">--}}
                                                        <select class="form-control" id="txt_localizacion_{{$pos}}" name="txt_localizacion_{{$pos}}">
                                                            <option value="0">Escoja el destino</option>
                                                            @foreach($destinations as $destination)
                                                                @if(!in_array($destination->destino,$destinos_usados))
                                                                    <option value="{{$destination->destino}}">{{$destination->destino}}</option>
                                                                @else
                                                                    <option value="{{$destination->destino}}" disabled="disabled">{{$destination->destino}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" name="tipoServicio_{{$pos}}" id="tipoServicio_{{$pos}}" value="{{$categoria->nombre}}">
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-md-12">
                                                @if($categoria->nombre=='HOTELS')
                                                    <table class="table table-responsive table-striped table-condensed">
                                                        <thead>
                                                        <tr>
                                                            <th class="col-lg-2 text-primary">ACOMODATION</th>
                                                            <th class="col-lg-2 text-warning text-center text-15">2 <i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i></th>
                                                            <th class="col-lg-2 text-warning text-center text-15">3 <i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i></th>
                                                            <th class="col-lg-2 text-warning text-center text-15">4 <i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i></th>
                                                            <th class="col-lg-2 text-warning text-center text-15">5 <i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>SIMGLE</td>
                                                            <td><input type="number" name="S_2" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="S_3" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="S_4" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="S_5" class="form-control" min="0" step="0.01" value="0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>DOUBLE</td>
                                                            <td><input type="number" name="D_2" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="D_3" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="D_4" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="D_5" class="form-control" min="0" step="0.01" value="0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>MATRIMONIAL</td>
                                                            <td><input type="number" name="M_2" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="M_3" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="M_4" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="M_5" class="form-control" min="0" step="0.01" value="0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>TRIPLE</td>
                                                            <td><input type="number" name="T_2" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="T_3" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="T_4" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="T_5" class="form-control" min="0" step="0.01" value="0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>SUPERIOR SIMPLE</td>
                                                            <td><input type="number" name="SS_2" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="SS_3" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="SS_4" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="SS_5" class="form-control" min="0" step="0.01" value="0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>SUPERIOR DOUBLE</td>
                                                            <td><input type="number" name="SD_2" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="SD_3" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="SD_4" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="SD_5" class="form-control" min="0" step="0.01" value="0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>SUITE</td>
                                                            <td><input type="number" name="SU_2" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="SU_3" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="SU_4" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="SU_5" class="form-control" min="0" step="0.01" value="0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>JR. SUITE</td>
                                                            <td><input type="number" name="JS_2" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="JS_3" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="JS_4" class="form-control" min="0" step="0.01" value="0"></td>
                                                            <td><input type="number" name="JS_5" class="form-control" min="0" step="0.01" value="0"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    @if($categoria->nombre=='HOTELS')

                                                    @endif
                                                    @if($categoria->nombre=='TOURS')
                                                        <label for="txt_type">Type</label>
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="GROUP">GROUP</option>
                                                            <option value="PRIVATE">PRIVATE</option>
                                                        </select>
                                                    @endif
                                                    @if($categoria->nombre=='MOVILID')
                                                        <label for="txt_type">Type</label>
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="AUTO">AUTO</option>
                                                            <option value="SUV">SUV</option>
                                                            <option value="VAN">VAN</option>
                                                            <option value="H1">H1</option>
                                                            <option value="SPRINTER">SPRINTER</option>
                                                            <option value="BUS">BUS</option>
                                                        </select>
                                                    @endif
                                                    @if($categoria->nombre=='REPRESENT')
                                                        <label for="txt_type">Type</label>
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="GUIDE">GUIDE</option>
                                                            <option value="TRANSFER">TRANSFER</option>
                                                            <option value="ASSISTANCE">ASSISTANCE</option>
                                                        </select>
                                                    @endif
                                                    @if($categoria->nombre=='ENTRANCES')
                                                        <label for="txt_type">Type</label>
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="EXTRANJERO">EXTRANJERO</option>
                                                            <option value="NATIONAL">NATIONAL</option>
                                                        </select>
                                                    @endif
                                                    @if($categoria->nombre=='FOOD')
                                                        <label for="txt_type">Type</label>
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="LUNCH">LUNCH</option>
                                                            <option value="DINNER">DINNER</option>
                                                            <option value="BOX LUNCH">BOX LUNCH</option>
                                                        </select>
                                                    @endif
                                                    @if($categoria->nombre=='TRAINS')
                                                        <label for="txt_type">Class</label>
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="EXPEDITION">EXPEDITION</option>
                                                            <option value="VISITADOME">VISITADOME</option>
                                                            <option value="EJECUTIVO">EJECUTIVO</option>
                                                            <option value="FIRST CLASS">FIRST CLASS</option>
                                                            <option value="HIRAN BINGHAN">HIRAN BINGHAN</option>
                                                            <option value="PRESIDENTIAL">PRESIDENTIAL</option>
                                                        </select>
                                                    @endif
                                                    @if($categoria->nombre=='FLIGHTS')
                                                        <label for="txt_type">Type</label>
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="NATIONAL">NATIONAL</option>
                                                            <option value="INTERNATIONAL">INTERNATIONAL</option>
                                                        </select>
                                                    @endif
                                                    @if($categoria->nombre=='OTHERS')
                                                        <label for="txt_type">Type</label>
                                                        <input type="text" class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}" placeholder="Type">
                                                    @endif

                                                </div>
                                            </div>
                                            @if($categoria->nombre=='HOTELS')
                                                {{--<div class="col-md-4">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label for="txt_type">Accommodation</label>--}}
                                                        {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                        {{--<select class="form-control" id="txt_acomodacion_{{$pos}}" name="txt_acomodacion_{{$pos}}">--}}
                                                            {{--<option value="S">SIMPLE</option>--}}
                                                            {{--<option value="D">DOBLE</option>--}}
                                                            {{--<option value="M">MATRIMONIAL</option>--}}
                                                            {{--<option value="T">TRIPLE</option>--}}
                                                            {{--<option value="SS">SUPERIOR SIMPLE</option>--}}
                                                            {{--<option value="SD">SUPERIOR DOBLE</option>--}}
                                                            {{--<option value="SU">SUITE</option>--}}
                                                            {{--<option value="JS">JR. SUITE</option>--}}

                                                        {{--</select>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            @endif

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    @if($categoria->nombre=='TRAINS'||$categoria->nombre=='FLIGHTS')
                                                        <label for="txt_product">Ruta</label>
                                                        <input type="text" class="form-control" id="txt_product_{{$pos}}" name="txt_product_{{$pos}}" placeholder="Product">
                                                    @elseif($categoria->nombre!='HOTELS')
                                                        <label for="txt_product">Product</label>
                                                        <input type="text" class="form-control" id="txt_product_{{$pos}}" name="txt_product_{{$pos}}" placeholder="Product">
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="col-md-4 hide">
                                                <div class="form-group">
                                                    <label for="txt_code">Code product</label>
                                                    <input type="text" class="form-control" id="txt_code_{{$pos}}" name="txt_code_{{$pos}}" placeholder="Code product">
                                                </div>
                                            </div>
                                            @if($categoria->nombre=='TRAINS'||$categoria->nombre=='FLIGHTS')
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="txt_price">Salida</label>
                                                        <input type="text" class="form-control" id="txt_salida_{{$pos}}" name="txt_salida_{{$pos}}" placeholder="Salida">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="txt_price">Llegada</label>
                                                        <input type="text" class="form-control" id="txt_llegada_{{$pos}}" name="txt_llegada_{{$pos}}" placeholder="Llegada">
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre!='HOTELS')
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_price">Price</label>
                                                    <input type="number" class="form-control" id="txt_price_{{$pos}}" name="txt_price_{{$pos}}" placeholder="Price" min="0">
                                                </div>
                                            </div>
                                            @endif
                                            @if($categoria->nombre=='MOVILID')
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="txt_price">Min Personas</label>
                                                        <input type="number" class="form-control" id="txt_min_personas_{{$pos}}" name="txt_min_personas_{{$pos}}" placeholder="Min" min="0">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="txt_price">Max Personas</label>
                                                        <input type="number" class="form-control" id="txt_max_personas_{{$pos}}" name="txt_max_personas_{{$pos}}" placeholder="Min" min="0">
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='HOTELS')
                                                {{--<div class="col-md-6">--}}
                                                    {{--<div class="row">--}}
                                                        {{--<div class="col-md-6">--}}
                                                            {{--<label class=" text-green-goto">--}}
                                                                {{--<input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto" checked="checked">--}}
                                                                {{--Precio es absoluto--}}
                                                            {{--</label>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col-md-6">--}}
                                                            {{--<label class=" text-green-goto">--}}
                                                                {{--<input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual">--}}
                                                                {{--Precio es individual--}}
                                                            {{--</label>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            @endif
                                            @if($categoria->nombre=='TOURS')
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class=" text-green-goto">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto" checked="checked">
                                                                Precio es absoluto
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class=" text-green-goto">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual">
                                                                Precio es individual
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='MOVILID')
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class=" text-green-goto">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto" checked="checked">
                                                                Precio es absoluto
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class=" text-green-goto">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual">
                                                                Precio es individual
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='REPRESENT')
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class=" text-green-goto">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto" checked="checked">
                                                                Precio es absoluto
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6 hide">
                                                            <label class=" text-green-goto">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual">
                                                                Precio es individual
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='ENTRANCES')
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-6 hide">
                                                            <label class=" text-green-goto">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto" >
                                                                Precio es absoluto
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class=" text-green-goto">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual" checked="checked">
                                                                Precio es individual
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='FOOD')
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-6 hide">
                                                            <label class=" text-green-goto">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto" >
                                                                Precio es absoluto
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class=" text-green-goto">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual" checked="checked">
                                                                Precio es individual
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='TRAINS')
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-6 hide">
                                                            <label class=" text-green-goto">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto" >
                                                                Precio es absoluto
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class=" text-green-goto">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual" checked="checked">
                                                                Precio es individual
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='FLIGHTS')
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-6 hide">
                                                            <label class=" text-green-goto">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto" >
                                                                Precio es absoluto
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class=" text-green-goto">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual" checked="checked">
                                                                Precio es individual
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($categoria->nombre=='OTHERS')
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class=" text-green-goto">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto" >
                                                                Precio es absoluto
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class=" text-green-goto">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual" checked="checked">
                                                                Precio es individual
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <?php
                                    $pos++;
                                    ?>
                                @endforeach

                            </div>


                        </div>
                        <div class="modal-footer">
                            {{csrf_field()}}
                            <input type="hidden" name="posTipo" id="posTipo" value="0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row margin-top-20">
        <ul class="nav nav-tabs">
            <?php
            $pos=0;
            ?>
            @foreach($categorias as $categoria)
                <?php
                $activo='';
                ?>
                @if($pos==0)
                    <?php
                    $activo='active';
                    ?>
                @endif
                <li class="{{$activo}}"><a data-toggle="tab" href="#t_{{$categoria->nombre}}" onclick="escojerPos({{$pos}},'{{$categoria->nombre}}')">{{$categoria->nombre}}</a></li>
                <?php
                $pos++;
                ?>
            @endforeach
        </ul>
        <div class="tab-content margin-top-20">
            <?php
            $pos=0;
            ?>
            @foreach($categorias as $categoria)
                <?php
                $activo='';
                ?>
                @if($pos==0)
                    <?php
                    $activo='in active';
                    ?>
                @endif
                <div id="t_{{$categoria->nombre}}" class="tab-pane fade {{$activo}}">

                    @if($categoria->nombre!='HOTELS')
                        <div class="col-lg-12">
                            <div class="col-lg-4 padding-left-0">
                                <select name="Destinos_{{$categoria->nombre}}" id="Destinos_{{$categoria->nombre}}" class="form-control" onchange="mostrar_tabla_destino('{{$categoria->nombre}}')">
                                    <option value="0">Escoja la localizacion</option>
                                    @foreach($destinations as $destination)
                                        <option value="{{$destination->id}}_{{$categoria->nombre}}_{{$destination->destino}}">{{$destination->destino}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="tb_datos_{{$categoria->nombre}}">
                        </div>
                    @else

                        <table id="tb_{{$categoria->nombre}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Localizacion</th>
                                <th>Estrellas</th>
                                <th>Operaciones</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Localizacion</th>
                                <th>Estrellas</th>
                                <th>Operaciones</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($hotel->sortBy('localizacion') as $hotel_)
                                <tr id="lista_services_h_{{$hotel_->id}}">
                                    <td class="text-green-goto">{{$hotel_->localizacion}}</td>
                                    <td class="text-green-goto">{{$hotel_->estrellas}} <b class="text-warning"><i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i></b></td>
                                    <td>
                                        <button type="button" class="btn btn-warning"  data-toggle="modal" data-target="#modal_edit_destination_h_{{$hotel_->id}}">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" onclick="eliminar_servicio_h('{{$hotel_->id}}','{{$hotel_->nombre}}')">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        @foreach($hotel->sortBy('localizacion') as $hotel_)
                            <div class="modal fade bd-example-modal-sm" id="modal_edit_destination_h_{{$hotel_->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <form action="{{route('hotel_edit_path')}}" method="post" id="service_save_id" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Hotel</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <table class="table table-responsive table-striped table-condensed">
                                                        <thead>
                                                        <tr>
                                                            <th class="col-lg-2 text-primary">ACOMODATION</th>
                                                            <th class="col-lg-2 text-warning text-center text-15">{{$hotel_->estrellas}} <i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>SIMGLE</td>
                                                            <td><input type="number" name="eS_2" class="form-control" min="0" step="0.01" value="{{$hotel_->single}}"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>DOUBLE</td>
                                                            <td><input type="number" name="eD_2" class="form-control" min="0" step="0.01" value="{{$hotel_->doble}}"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>MATRIMONIAL</td>
                                                            <td><input type="number" name="eM_2" class="form-control" min="0" step="0.01" value="{{$hotel_->matrimonial}}"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>TRIPLE</td>
                                                            <td><input type="number" name="eT_2" class="form-control" min="0" step="0.01" value="{{$hotel_->triple}}"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>SUPERIOR SIMPLE</td>
                                                            <td><input type="number" name="eSS_2" class="form-control" min="0" step="0.01" value="{{$hotel_->superior_s}}"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>SUPERIOR DOUBLE</td>
                                                            <td><input type="number" name="eSD_2" class="form-control" min="0" step="0.01" value="{{$hotel_->superior_d}}"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>SUITE</td>
                                                            <td><input type="number" name="eSU_2" class="form-control" min="0" step="0.01" value="{{$hotel_->suite}}"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>JR. SUITE</td>
                                                            <td><input type="number" name="eJS_2" class="form-control" min="0" step="0.01" value="{{$hotel_->jr_suite}}"></td>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            {{csrf_field()}}
                                            <input type="hidden" name="id" value="{{$hotel_->id}}">
                                            <input type="hidden" name="posTipo" id="posTipo" value="0">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    @endif
                </div>
                <?php
                $pos++;
                ?>
            @endforeach
        </div>
    </div>
    <script>
        $(document).ready(function() {
            @foreach($destinations as $destination)
                @foreach($categorias as $categoria)
                $('#tb_{{$destination->id}}_{{$categoria->nombre}}').DataTable();
                @endforeach
            @endforeach
            @foreach($categorias as $categoria)
                $('#tb_{{$categoria->nombre}}').DataTable();
            @endforeach
        } );
        function editar_producto(id){
            $('#modal_edit_producto_'+id).submit(function() {
                // Enviamos el formulario usando AJAX
                var grupo=$('#grupo_'+id).val();
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: new FormData($("#modal_edit_producto_"+id)[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    // Mostramos un mensaje con la respuesta de PHP
                    success:  function (response) {
                    var datox=response.split('_');
                    console.log(datox);
// if(response==1){
//                            $('#result_'+id).removeClass('text-danger');
//                            $('#result_'+id).addClass('text-success');
                            $('#result_'+id).html('producto guardado Correctamente!');
                        if(grupo=='MOVILID')
                            $('#tipo_'+id).html(datox[0]+' ['+datox[1]+'-'+datox[2]+']');
                        else
                            $('#tipo_'+id).html(datox[0]);

                        if(grupo=='TRAINS')
                            $('#horario_'+id).html(datox[2]);
                        $('#precio_'+id).html(datox[3]);
                        $('#nombre_'+id).html(datox[4]);

//                        }
//                        else{
//                            $('#result_'+id).removeClass('text-success');
//                            $('#result_'+id).addClass('text-danger');
//                            $('#result_'+id).html('Error al guardar la imagen, intentelo de nuevo');
//                        }
                    }
                })
                // esto es para que no se reenvie el formulario
                return false;
            });
        }
    </script>
@stop