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
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_codigo">Codigo</label>
                                                    <?php
                                                    $auto=1;
                                                    if(count($servicios)>0)
                                                        $auto=($servicios->last()->id)+1;
                                                    ?>
                                                    <input type="text" class="form-control" id="txt_codigo" name="txt_codigo" value="{{$auto}}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_codigo">Location</label>
                                                    {{--<input type="text" class="form-control" id="txt_localizacion_0" name="txt_localizacion_0" placeholder="Location">--}}
                                                    <select class="form-control" id="txt_localizacion_{{$pos}}" name="txt_localizacion_{{$pos}}">
                                                        @foreach($destinations as $destination)
                                                            <option value="{{$destination->destino}}">{{$destination->destino}}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="tipoServicio_{{$pos}}" id="tipoServicio_{{$pos}}" value="{{$categoria->nombre}}">
                                                </div>
                                            </div>
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
                            <div class="col-lg-4">
                                <select name="Destinos_{{$categoria->nombre}}" id="Destinos_{{$categoria->nombre}}" class="form-control" onchange="mostrar_tabla_destino('{{$categoria->nombre}}')">
                                    <option value="0">Escoja la localizacion</option>
                                    @foreach($destinations as $destination)
                                        <option value="{{$destination->id}}_{{$categoria->nombre}}">{{$destination->destino}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @foreach($destinations as $destination)
                            <table id="tb_{{$destination->id}}_{{$categoria->nombre}}" class="{{$categoria->nombre}} table table-striped table-bordered table-responsive hide" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Localizacion</th>
                                <th>@if($categoria->nombre=='TRAINS') Clase @else Tipo @endif</th>
                                <th>@if($categoria->nombre=='TRAINS') Ruta @else Nombre @endif</th>
                                @if($categoria->nombre=='TRAINS') <th>Horario</th> @endif
                                <th>Precio</th>
                                <th>Operaciones</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Codigo</th>
                                <th>Localizacion</th>
                                <th>@if($categoria->nombre=='TRAINS') Clase @else Tipo @endif</th>
                                <th>@if($categoria->nombre=='TRAINS') Ruta @else Nombre @endif</th>
                                @if($categoria->nombre=='TRAINS') <th>Horario</th> @endif
                                <th>Precio</th>
                                <th>Operaciones</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($servicios->where('localizacion',$destination->destino) as $servicio)
                                @if($servicio->grupo==$categoria->nombre)
                                    <?php
                                    $acom='';
                                    ?>
                                    @if($servicio->acomodacion=='S')
                                        <?php
                                        $acom='SIMPLE';
                                        ?>
                                    @endif
                                    @if($servicio->acomodacion=='D')
                                        <?php
                                        $acom='DOBLE';
                                        ?>
                                    @endif
                                    @if($servicio->acomodacion=='T')
                                        <?php
                                        $acom='TRIPLE';
                                        ?>
                                    @endif
                                    @if($servicio->acomodacion=='M')
                                        <?php
                                        $acom='MATRIMONIAL';
                                        ?>
                                    @endif
                                    @if($servicio->acomodacion=='SS')
                                        <?php
                                        $acom='SUPERIOR SIMPLE';
                                        ?>
                                    @endif
                                    @if($servicio->acomodacion=='SD')
                                        <?php
                                        $acom='SUPERIOR DOBLE';
                                        ?>
                                    @endif
                                    @if($servicio->acomodacion=='SU')
                                        <?php
                                        $acom='SUITE';
                                        ?>
                                    @endif
                                    @if($servicio->acomodacion=='JR')
                                        <?php
                                        $acom='JR. SUITE';
                                        ?>
                                    @endif

                                    {{--<tr class="{{$servicio->localizacion}}" id="lista_services_{{$servicio->localizacion}}_{{$servicio->id}}">--}}
                                    <tr class="{{$servicio->localizacion}}" id="lista_services_{{$servicio->id}}">
                                    <td class="text-green-goto">{{$servicio->codigo}}</td>
                                        <td class="lista_mo">{{$servicio->localizacion}}</td>
                                        <td>{{$servicio->tipoServicio}} {{$acom}}</td>
                                        <td>{{$servicio->nombre}}</td>
                                        @if($categoria->nombre=='TRAINS') <td>{{$servicio->salida}} - {{$servicio->llegada}}</td> @endif
                                        <td>${{$servicio->precio_venta}}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning"  data-toggle="modal" data-target="#modal_edit_destination_{{$servicio->id}}">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </button>
                                            {{--<button type="button" class="btn btn-danger" onclick="eliminar_servicio('{{$servicio->localizacion}}',{{$servicio->id}}','{{$servicio->nombre}}')">--}}
                                            <button type="button" class="btn btn-danger" onclick="eliminar_servicio('{{$servicio->localizacion}}','{{$servicio->id}}','{{$servicio->nombre}}')">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        @endforeach
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
                            <div class="modal-dialog modal-lg" role="document">
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
    @foreach($servicios as $servicio)
        <div class="modal fade bd-example-modal-lg" id="modal_edit_destination_{{$servicio->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="{{route('service_edit_path')}}" method="post" id="service_save_id" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
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
                                    $active='hide';
                                    $tipoServicio[]=$categoria->nombre;
                                    if($servicio->grupo==$categoria->nombre){
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
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_codigo">Codigo</label>
                                                    <input type="text" class="form-control" id="txt_codigo" name="txt_codigo" value="{{($servicio->id)}}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_codigo">Location</label>
                                                    {{--<input type="text" class="form-control" id="txt_localizacion_0" name="txt_localizacion_0" placeholder="Location">--}}
                                                    <select class="form-control" id="txt_localizacion_{{$pos}}" name="txt_localizacion_{{$pos}}">
                                                        @foreach($destinations as $destination)
                                                            <option value="{{$destination->destino}}" @if($servicio->localizacion==$destination->destino) selected @endif>{{$destination->destino}}</option>
                                                        @endforeach
                                                    </select>

                                                    <input type="hidden" name="tipoServicio_{{$pos}}" id="tipoServicio_{{$pos}}" value="{{$categoria->nombre}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}

                                                    @if($servicio->grupo=='HOTELS')
                                                        <label for="txt_type">Type</label>
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="2 STARS" @if($servicio->tipoServicio=="2 STARS") selected @endif>2 STARS</option>
                                                            <option value="3 STARS" @if($servicio->tipoServicio=="3 STARS") selected @endif>3 STARS</option>
                                                            <option value="4 STARS" @if($servicio->tipoServicio=="4 STARS") selected @endif>4 STARS</option>
                                                            <option value="5 STARS" @if($servicio->tipoServicio=="5 STARS") selected @endif>5 STARS</option>
                                                        </select>
                                                    @endif
                                                    @if($servicio->grupo=='TOURS')
                                                        <label for="txt_type">Type</label>
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="GROUP" @if($servicio->tipoServicio=="GROUP") selected @endif>GROUP</option>
                                                            <option value="PRIVATE"  @if($servicio->tipoServicio=="PRIVATE") selected @endif>PRIVATE</option>
                                                        </select>
                                                    @endif
                                                    @if($servicio->grupo=='MOVILID')
                                                        <label for="txt_type">Type</label>
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="AUTO" @if($servicio->tipoServicio=="AUTO") selected @endif>AUTO</option>
                                                            <option value="SUV" @if($servicio->tipoServicio=="SUV") selected @endif>SUV</option>
                                                            <option value="VAN" @if($servicio->tipoServicio=="VAN") selected @endif>VAN</option>
                                                            <option value="H1" @if($servicio->tipoServicio=="H1") selected @endif>H1</option>
                                                            <option value="SPRINTER" @if($servicio->tipoServicio=="SPRINTER") selected @endif>SPRINTER</option>
                                                            <option value="BUS" @if($servicio->tipoServicio=="BUS") selected @endif>BUS</option>
                                                        </select>
                                                    @endif
                                                    @if($servicio->grupo=='REPRESENT')
                                                        <label for="txt_type">Type</label>
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="GUIDE" @if($servicio->tipoServicio=="GUIDE") selected @endif>GUIDE</option>
                                                            <option value="TRANSFER" @if($servicio->tipoServicio=="TRANSFER") selected @endif>TRANSFER</option>
                                                            <option value="ASSISTANCE" @if($servicio->tipoServicio=="ASSISTANCE") selected @endif>ASSISTANCE</option>
                                                        </select>
                                                    @endif
                                                    @if($servicio->grupo=='ENTRANCES')
                                                        <label for="txt_type">Type</label>
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="EXTRANJERO" @if($servicio->tipoServicio=="EXTRANJERO") selected @endif>EXTRANJERO</option>
                                                            <option value="NATIONAL" @if($servicio->tipoServicio=="NATIONAL") selected @endif>NATIONAL</option>
                                                        </select>
                                                    @endif
                                                    @if($servicio->grupo=='FOOD')
                                                        <label for="txt_type">Type</label>
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="LUNCH" @if($servicio->tipoServicio=="LUNCH") selected @endif>LUNCH</option>
                                                            <option value="DINNER" @if($servicio->tipoServicio=="DINNDER") selected @endif>DINNER</option>
                                                            <option value="BOX LUNCH" @if($servicio->tipoServicio=="BOX LUNCH") selected @endif>BOX LUNCH</option>
                                                        </select>
                                                    @endif
                                                    @if($servicio->grupo=='TRAINS')
                                                        <label for="txt_type">Class</label>
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="EXPEDITION" @if($servicio->tipoServicio=="EXPEDITION") selected @endif>EXPEDITION</option>
                                                            <option value="VISITADOME" @if($servicio->tipoServicio=="VISITADOME") selected @endif>VISITADOME</option>
                                                            <option value="EJECUTIVO" @if($servicio->tipoServicio=="EJECUTIVO") selected @endif>EJECUTIVO</option>
                                                            <option value="FIRST CLASS" @if($servicio->tipoServicio=="FIRST CLASS") selected @endif>PRIMERA CLASE</option>
                                                            <option value="HIRAN BINGHAN" @if($servicio->tipoServicio=="HIRAN BINGHAN") selected @endif>HIRAN BINGHAN</option>
                                                            <option value="PRESIDENTIAL" @if($servicio->tipoServicio=="PRESIDENTIAL") selected @endif>PRESIDENTIAL</option>
                                                        </select>
                                                    @endif
                                                    @if($servicio->grupo=='FLIGHTS')
                                                        <label for="txt_type">Type</label>
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="NATIONAL" @if($servicio->tipoServicio=="NATIONAL") selected @endif>NATIONAL</option>
                                                            <option value="INTERNATIONAL" @if($servicio->tipoServicio=="INTERNATIONAL") selected @endif>INTERNATIONAL</option>
                                                        </select>
                                                    @endif
                                                    @if($servicio->grupo=='OTHERS')
                                                        <label for="txt_type">Type</label>
                                                        <input type="text" class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}" placeholder="Type" value="{{$servicio->tipoServicio}}">
                                                    @endif

                                                </div>
                                            </div>
                                            @if($servicio->grupo=='HOTELS')
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="txt_type">Accommodation</label>
                                                        {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                        <select class="form-control" id="txt_acomodacion_{{$pos}}" name="txt_acomodacion_{{$pos}}">
                                                            <option value="S" @if($servicio->acomodacion=="S") selected @endif>SIMPLE</option>
                                                            <option value="D" @if($servicio->acomodacion=="D") selected @endif>DOBLE</option>
                                                            <option value="M" @if($servicio->acomodacion=="M") selected @endif>MATRIMONIAL</option>
                                                            <option value="T" @if($servicio->acomodacion=="T") selected @endif>TRIPLE</option>
                                                            <option value="SS" @if($servicio->acomodacion=="SS") selected @endif>SUPERIOR SIMPLE</option>
                                                            <option value="SD" @if($servicio->acomodacion=="SD") selected @endif>SUPERIOR DOBLE</option>
                                                            <option value="SU" @if($servicio->acomodacion=="SU") selected @endif>SUITE</option>
                                                            <option value="JS" @if($servicio->acomodacion=="JR") selected @endif>JR. SUITE</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    @if($servicio->grupo=='TRAINS' || $servicio->grupo=='FLIGHTS')
                                                        <label for="txt_product">Ruta</label>
                                                    @else
                                                        <label for="txt_product">Product</label>
                                                    @endif
                                                    <input type="text" class="form-control" id="txt_product_{{$pos}}" name="txt_product_{{$pos}}" placeholder="Product" value="{{$servicio->nombre}}">
                                                </div>
                                            </div>
                                            @if($servicio->grupo=='TRAINS' || $servicio->grupo=='FLIGHTS')
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="txt_price">Salida</label>
                                                        <input type="text" class="form-control" id="txt_salida_{{$pos}}" name="txt_salida_{{$pos}}" placeholder="Salida"  value="{{$servicio->salida}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="txt_price">Llegada</label>
                                                        <input type="text" class="form-control" id="txt_llegada_{{$pos}}" name="txt_llegada_{{$pos}}" placeholder="Llegada"  value="{{$servicio->llegada}}">
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-md-4 hide">
                                                <div class="form-group">
                                                    <label for="txt_code">Code product</label>
                                                    <input type="text" class="form-control" id="txt_code_{{$pos}}" name="txt_code_{{$pos}}" placeholder="Code product"  value="{{$servicio->codigo}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_price">Price</label>
                                                    <input type="number" class="form-control" id="txt_price_{{$pos}}" name="txt_price_{{$pos}}" placeholder="Price"  value="{{$servicio->precio_venta}}" min="0">
                                                </div>
                                            </div>
                                            @if($servicio->grupo=='MOVILID')
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="txt_price">Min Personas</label>
                                                        <input type="number" class="form-control" id="txt_min_personas_{{$pos}}" name="txt_min_personas_{{$pos}}" placeholder="Min" min="0" value="{{$servicio->min_personas}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="txt_price">Max Personas</label>
                                                        <input type="number" class="form-control" id="txt_max_personas_{{$pos}}" name="txt_max_personas_{{$pos}}" placeholder="Min" min="0" value="{{$servicio->max_personas}}">
                                                    </div>
                                                </div>
                                            @endif
                                            @if($servicio->grupo=='HOTELS')
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        @if($servicio->precio_grupo==1)
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
                                                        @else
                                                            <div class="col-md-6">
                                                                <label class=" text-green-goto">
                                                                    <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto">
                                                                    Precio es absoluto
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class=" text-green-goto">
                                                                    <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual" checked="checked">
                                                                    Precio es individual
                                                                </label>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                            @if($servicio->grupo=='TOURS')
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        @if($servicio->precio_grupo==1)
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
                                                        @else
                                                            <div class="col-md-6">
                                                                <label class=" text-green-goto">
                                                                    <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto">
                                                                    Precio es absoluto
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class=" text-green-goto">
                                                                    <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual" checked="checked">
                                                                    Precio es individual
                                                                </label>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                            @if($servicio->grupo=='MOVILID')
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        @if($servicio->precio_grupo==1)
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
                                                        @else
                                                            <div class="col-md-6">
                                                                <label class=" text-green-goto">
                                                                    <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto">
                                                                    Precio es absoluto
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class=" text-green-goto">
                                                                    <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual" checked="checked">
                                                                    Precio es individual
                                                                </label>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                            @if($servicio->grupo=='REPRESENT')
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        @if($servicio->precio_grupo==1)
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
                                                        @else
                                                            <div class="col-md-6">
                                                                <label class=" text-green-goto">
                                                                    <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto">
                                                                    Precio es absoluto
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class=" text-green-goto">
                                                                    <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual" checked="checked">
                                                                    Precio es individual
                                                                </label>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                            @if($servicio->grupo=='ENTRANCES')
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        @if($servicio->precio_grupo==1)
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
                                                        @else
                                                            <div class="col-md-6 hide">
                                                                <label class=" text-green-goto">
                                                                    <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto">
                                                                    Precio es absoluto
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class=" text-green-goto">
                                                                    <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual" checked="checked">
                                                                    Precio es individual
                                                                </label>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                            @if($servicio->grupo=='FOOD')
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        @if($servicio->precio_grupo==1)
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
                                                        @else
                                                            <div class="col-md-6 hide">
                                                                <label class=" text-green-goto">
                                                                    <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto">
                                                                    Precio es absoluto
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class=" text-green-goto">
                                                                    <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual" checked="checked">
                                                                    Precio es individual
                                                                </label>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                            @if($servicio->grupo=='TRAINS')
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        @if($servicio->precio_grupo==1)
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
                                                        @else
                                                            <div class="col-md-6 hide">
                                                                <label class=" text-green-goto">
                                                                    <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto">
                                                                    Precio es absoluto
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class=" text-green-goto">
                                                                    <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual" checked="checked">
                                                                    Precio es individual
                                                                </label>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                            @if($servicio->grupo=='FLIGHTS')
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        @if($servicio->precio_grupo==1)
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
                                                        @else
                                                            <div class="col-md-6 hide">
                                                                <label class=" text-green-goto">
                                                                    <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto">
                                                                    Precio es absoluto
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class=" text-green-goto">
                                                                    <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual" checked="checked">
                                                                    Precio es individual
                                                                </label>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                            @if($servicio->grupo=='OTHERS')
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        @if($servicio->precio_grupo==1)
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
                                                        @else
                                                            <div class="col-md-6">
                                                                <label class=" text-green-goto">
                                                                    <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Absoluto">
                                                                    Precio es absoluto
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class=" text-green-goto">
                                                                    <input type="radio" name="txt_tipo_grupo_{{$pos}}" value="Individual" checked="checked">
                                                                    Precio es individual
                                                                </label>
                                                            </div>
                                                        @endif
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
                            <input type="hidden" name="id" value="{{$servicio->id}}">
                            <input type="hidden" name="posTipo" id="posTipo" value="0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    <script>
        $(document).ready(function() {
            {{--@foreach($destinations as $destination)--}}
                {{--@foreach($categorias as $categoria)--}}
                {{--$('#tb_{{$destination->id}}_{{$categoria->nombre}}').DataTable();--}}
                {{--@endforeach--}}
            {{--@endforeach--}}
            @foreach($categorias as $categoria)
                $('#tb_{{$categoria->nombre}}').DataTable();
            @endforeach
        } );
    </script>
@stop