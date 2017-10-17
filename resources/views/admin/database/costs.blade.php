@extends('layouts.admin.admin')
@section('archivos-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .ui-autocomplete {
            z-index: 5000 !important;
        }
    </style>
@stop
@section('archivos-js')
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js")}}"></script>
@stop
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Database</li>
            <li class="active">Costs</li>
        </ol>
    </div>
    <div class="row margin-top-20">
        <a type="button" class="btn btn-primary" onclick="mostrar_new_cost()">
            New <i class="fa fa-plus-circle" aria-hidden="true"></i>
        </a>
        <div class="margin-top-20 panel panel-default panel-floating panel-floating-inline hide" id="modal_new_cost">
                        <div class="panel-body">
                        <form  action="{{route('costs_save_path')}}" method="post" id="service_save_id" enctype="multipart/form-data">
                        @foreach($categorias as $categoria)
                            <?php
                                $tipoServicio[]=$categoria->nombre;
                            ?>
                        @endforeach

                            <ul class="nav nav-tabs">
                                <?php
                                $pos=0;
                                ?>
                                @foreach($categorias as $categoria)
                                    <?php
                                        $activo_='';
                                    ?>
                                    @if($pos==0)
                                        <?php
                                        $activo_='active';
                                        ?>
                                    @endif
                                    <li class="{{$activo_}}"><a data-toggle="tab" href="#{{$categoria->nombre}}" onclick="escojerPos({{$pos}})">{{$categoria->nombre}}</a></li>
                                        <?php
                                        $pos++;
                                        ?>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                <?php
                                $pos0=0;
                                ?>
                                @foreach($categorias as $categoria)
                                        <?php
                                        $activo='';
                                        ?>
                                        @if($pos0==0)
                                        <?php
                                            $activo='in active';
                                        ?>
                                    @endif
                                    <div id="{{$categoria->nombre}}" class="tab-pane fade {{$activo}}">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="txt_codigo">Location</label>
                                                        {{--<input type="text" class="form-control" id="txt_localizacion_0" name="txt_localizacion_0" placeholder="Location">--}}
                                                        <select class="form-control" id="txt_localizacion_{{$pos0}}" name="txt_localizacion_{{$pos0}}" onchange="mostrar_hoteles('{{$pos0}}')">
                                                            @foreach($destinations as $destination)
                                                                <option value="{{$destination->destino}}">{{$destination->destino}}</option>
                                                            @endforeach
                                                        </select>

                                                        <input type="hidden" name="tipoServicio_{{$pos0}}" id="tipoServicio_{{$pos0}}" value="{{$categoria->nombre}}">
                                                    </div>
                                                </div>
                                                @if($categoria->nombre=='HOTELS')
                                                    <div class="col-md-4">
                                                        <div class="form-group col-md-9">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_{{$pos0}}" name="txt_provider_{{$pos0}}" placeholder="Provider" required>
                                                        </div>
                                                        <div class="col-md-3 margin-top-25 ">
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_new_provider" onclick="pasar_pos_provider('0')">
                                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($categoria->nombre=='HOTELS')
                                                    <div class="col-md-12">
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
                                                                <td><input type="number" name="S_2" id="S_2" class="form-control" min="0" step="0.01" value="0"></td>
                                                                <td><input type="number" name="S_3" id="S_3" class="form-control" min="0" step="0.01" value="0"></td>
                                                                <td><input type="number" name="S_4" id="S_4" class="form-control" min="0" step="0.01" value="0"></td>
                                                                <td><input type="number" name="S_5" id="S_5" class="form-control" min="0" step="0.01" value="0"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>DOUBLE</td>
                                                                <td><input type="number" name="D_2" id="D_2" class="form-control" min="0" step="0.01" value="0"></td>
                                                                <td><input type="number" name="D_3" id="D_3" class="form-control" min="0" step="0.01" value="0"></td>
                                                                <td><input type="number" name="D_4" id="D_4" class="form-control" min="0" step="0.01" value="0"></td>
                                                                <td><input type="number" name="D_5" id="D_5" class="form-control" min="0" step="0.01" value="0"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>MATRIMONIAL</td>
                                                                <td><input type="number" name="M_2" id="M_2" class="form-control" min="0" step="0.01" value="0"></td>
                                                                <td><input type="number" name="M_3" id="M_3" class="form-control" min="0" step="0.01" value="0"></td>
                                                                <td><input type="number" name="M_4" id="M_4" class="form-control" min="0" step="0.01" value="0"></td>
                                                                <td><input type="number" name="M_5" id="M_5" class="form-control" min="0" step="0.01" value="0"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>TRIPLE</td>
                                                                <td><input type="number" name="T_2" id="T_2" class="form-control" min="0" step="0.01" value="0"></td>
                                                                <td><input type="number" name="T_3" id="T_3" class="form-control" min="0" step="0.01" value="0"></td>
                                                                <td><input type="number" name="T_4" id="T_4" class="form-control" min="0" step="0.01" value="0"></td>
                                                                <td><input type="number" name="T_5" id="T_5" class="form-control" min="0" step="0.01" value="0"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>SUPERIOR SIMPLE</td>
                                                                <td><input type="number" name="SS_2" id="SS_2" class="form-control" min="0" step="0.01" value="0"></td>
                                                                <td><input type="number" name="SS_3" id="SS_3" class="form-control" min="0" step="0.01" value="0"></td>
                                                                <td><input type="number" name="SS_4" id="SS_4" class="form-control" min="0" step="0.01" value="0"></td>
                                                                <td><input type="number" name="SS_5" id="SS_5" class="form-control" min="0" step="0.01" value="0"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>SUPERIOR DOUBLE</td>
                                                                <td><input type="number" name="SD_2" id="SD_2" class="form-control" min="0" step="0.01" value="0"></td>
                                                                <td><input type="number" name="SD_3" id="SD_3" class="form-control" min="0" step="0.01" value="0"></td>
                                                                <td><input type="number" name="SD_4" id="SD_4" class="form-control" min="0" step="0.01" value="0"></td>
                                                                <td><input type="number" name="SD_5" id="SD_5" class="form-control" min="0" step="0.01" value="0"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>SUITE</td>
                                                                <td><input type="number" name="SU_2" id="SU_2" class="form-control" min="0" step="0.01" value="0"></td>
                                                                <td><input type="number" name="SU_3" id="SU_3" class="form-control" min="0" step="0.01" value="0"></td>
                                                                <td><input type="number" name="SU_4" id="SU_4" class="form-control" min="0" step="0.01" value="0"></td>
                                                                <td><input type="number" name="SU_5" id="SU_5" class="form-control" min="0" step="0.01" value="0"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>JR. SUITE</td>
                                                                <td><input type="number" name="JS_2" id="JS_2" class="form-control" min="0" step="0.01" value="0"></td>
                                                                <td><input type="number" name="JS_3" id="JS_3" class="form-control" min="0" step="0.01" value="0"></td>
                                                                <td><input type="number" name="JS_4" id="JS_4" class="form-control" min="0" step="0.01" value="0"></td>
                                                                <td><input type="number" name="JS_5" id="JS_5" class="form-control" min="0" step="0.01" value="0"></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @endif
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        {{--<label for="txt_type">Type</label>--}}
                                                        {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}

{{--                                                        @if($categoria->nombre=='HOTELS')--}}
                                                            {{--<select class="form-control" id="txt_type_0" name="txt_type_{{$pos0}}">--}}
                                                                {{--<option value="2 STARS">2 STARS</option>--}}
                                                                {{--<option value="3 STARS">3 STARS</option>--}}
                                                                {{--<option value="4 STARS">4 STARS</option>--}}
                                                                {{--<option value="5 STARS">5 STARS</option>--}}
                                                            {{--</select>--}}
                                                        {{--@endif--}}
                                                        @if($categoria->nombre=='TOURS')
                                                            <label for="txt_type">Type</label>
                                                            <select class="form-control" id="txt_type_0" name="txt_type_{{$pos0}}">
                                                                <option value="GROUP">GROUP</option>
                                                                <option value="PRIVATE">PRIVATE</option>
                                                            </select>
                                                        @endif
                                                        @if($categoria->nombre=='MOVILID')
                                                            <label for="txt_type">Type</label>
                                                            <select class="form-control" id="txt_type_0" name="txt_type_{{$pos0}}">
                                                                <option value="AUTO">AUTO</option>
                                                                <option value="SUBARU">SUBARU</option>
                                                                <option value="VAN">VAN</option>
                                                                <option value="H1">H1</option>
                                                                <option value="SPRINTER">SPRINTER</option>
                                                            </select>
                                                        @endif
                                                        @if($categoria->nombre=='REPRESENT')
                                                            <label for="txt_type">Type</label>
                                                            <select class="form-control" id="txt_type_0" name="txt_type_{{$pos0}}">
                                                                <option value="GUIDE">GUIDE</option>
                                                                <option value="TRANSFER">TRANSFER</option>
                                                                <option value="ASSISTANCE">ASSISTANCE</option>
                                                            </select>
                                                        @endif
                                                        @if($categoria->nombre=='ENTRANCES')
                                                            <label for="txt_type">Type</label>
                                                            <select class="form-control" id="txt_type_0" name="txt_type_{{$pos0}}">
                                                                <option value="EXTRANJERO">EXTRANJERO</option>
                                                                <option value="NATIONAL">NATIONAL</option>
                                                            </select>
                                                        @endif
                                                        @if($categoria->nombre=='FOOD')
                                                            <label for="txt_type">Type</label>
                                                            <select class="form-control" id="txt_type_0" name="txt_type_{{$pos0}}">
                                                                <option value="LUNCH">LUNCH</option>
                                                                <option value="DINNER">DINNER</option>
                                                                <option value="BOX LUNCH">BOX LUNCH</option>
                                                            </select>
                                                        @endif
                                                        @if($categoria->nombre=='TRAINS')
                                                            <label for="txt_type">Type</label>
                                                            <select class="form-control" id="txt_type_0" name="txt_type_{{$pos0}}">
                                                                <option value="EXPEDITION">EXPEDITION</option>
                                                                <option value="VISITADOME">VISITADOME</option>
                                                                <option value="HIRAN BINGHAN">BOX LUNCH</option>
                                                                <option value="EJECUTIVO">EJECUTIVO</option>
                                                                <option value="PRIMERA CLASE">PRIMERA CLASE</option>
                                                            </select>
                                                        @endif
                                                        @if($categoria->nombre=='FLIGHTS')
                                                            <label for="txt_type">Type</label>
                                                            <select class="form-control" id="txt_type_0" name="txt_type_{{$pos0}}">
                                                                <option value="NATIONAL">NATIONAL</option>
                                                                <option value="INTERNATIONAL">INTERNATIONAL</option>
                                                            </select>
                                                        @endif
                                                        @if($categoria->nombre=='OTHERS')
                                                            <input type="text" class="form-control" id="txt_type_0" name="txt_type_{{$pos0}}" placeholder="Type">
                                                        @endif

                                                    </div>
                                                </div>
                                                {{--@if($categoria->nombre=='HOTELS')--}}
                                                {{--<div class="col-md-4">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label for="txt_type">Accommodation</label>--}}
                                                        {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                        {{--<select class="form-control" id="txt_acomodacion_0" name="txt_acomodacion_{{$pos0}}">--}}
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
                                                {{--@endif--}}
                                                @if($categoria->nombre!='HOTELS')
                                                <div class="col-md-4">
                                                    <div class="form-group col-md-9">
                                                        <label for="txt_precio">Provider</label>
                                                        <input type="text" class="form-control" id="txt_provider_{{$pos0}}" name="txt_provider_{{$pos0}}" placeholder="Provider">
                                                    </div>
                                                    <div class="col-md-3 margin-top-25 ">
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_new_provider" onclick="pasar_pos_provider('0')">
                                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="txt_product">Product</label>
                                                        <input type="text" class="form-control" id="txt_product_{{$pos0}}" name="txt_product_{{$pos0}}" placeholder="Product">
                                                    </div>
                                                </div>

                                                <div class="col-md-4 hide">
                                                    <div class="form-group">
                                                        <label for="txt_code">Code product</label>
                                                        <input type="text" class="form-control" id="txt_code_0" name="txt_code_{{$pos0}}" placeholder="Code product">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="txt_price">Price</label>
                                                        <input type="number" class="form-control" id="txt_price_0" name="txt_price_{{$pos0}}" placeholder="Price" min="0.00" step="0.01">
                                                    </div>
                                                </div>
                                                @endif
                                                <div class="col-md-4 hide">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class=" text-green-goto">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos0}}" value="Absoluto" checked="checked">
                                                                Precio es absoluto
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class=" text-green-goto">
                                                                <input type="radio" name="txt_tipo_grupo_{{$pos0}}" value="Individual">
                                                                Precio es individual
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                <?php
                                $pos0++;
                                ?>
                                @endforeach

                            </div>
                            {{csrf_field()}}
                            <input type="hidden" name="posTipo" id="posTipo" value="0">
                            <input type="text" name="hotel_id_2" id="hotel_id_2" value="0">
                            <input type="text" name="hotel_id_3" id="hotel_id_3" value="0">
                            <input type="text" name="hotel_id_4" id="hotel_id_4" value="0">
                            <input type="text" name="hotel_id_5" id="hotel_id_5" value="0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                    </div>
                    </div>

    </div>
    <div class="row margin-top-20">
        <div class="col-lg-12">
            <ul class="nav nav-tabs">
                <?php
                $pos=0;
                ?>
                @foreach($categorias as $categoria)
                    <?php
                    $activo_='';
                    ?>
                    @if($pos==0)
                        <?php
                        $activo_='active';
                        ?>
                    @endif
                    <li class="{{$activo_}}"><a data-toggle="tab" href="#t_{{$categoria->nombre}}">{{$categoria->nombre}}</a></li>
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
                    $activo_='';
                    ?>
                    @if($pos==0)
                        <?php
                        $activo_='in active';
                        ?>
                    @endif
                    @if($categoria->nombre!='HOTELS')
                        <div id="t_{{$categoria->nombre}}" class="tab-pane fade {{$activo_}}">
                            <div class="margin-top-20">
                                <table id="tb_{{$categoria->nombre}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Location</th>
                                        <th>Type</th>
                                        <th>Provider</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Operations</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Location</th>
                                        <th>Type</th>
                                        <th>Provider</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Operations</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($productos as $proveedor)
                                        @foreach($proveedor->productos  as $producto)
                                            @if($producto->grupo==$categoria->nombre)
                                            <tr id="lista_services_{{$producto->id}}">
                                                <td><b class="text-success"><i class="fa fa-bus fa-2x" aria-hidden="true"></i></b></td>
                                                <td>{{$producto->localizacion}}</td>
                                                <td>{{$producto->tipo_producto}}</td>
                                                <td><b class="bg-green-goto text-grey-goto">{{$proveedor->codigo}}</b> {{$proveedor->razon_social}}</td>
                                                <td><b class="bg-orange-goto text-grey-goto">{{$producto->codigo}}</b>{{$producto->nombre}}</td>
                                                <td>${{$producto->precio_costo}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-warning"  data-toggle="modal" data-target="#modal_edit_cost_{{$producto->id}}">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger" onclick="eliminar_producto('{{$producto->id}}','{{$producto->nombre}}')">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div id="t_{{$categoria->nombre}}" class="tab-pane fade {{$activo_}}">
                            <div class="margin-top-20">
                                <table id="tb_{{$categoria->nombre}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Location</th>
                                        <th>Provider</th>
                                        <th>Operations</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Location</th>
                                        <th>Provider</th>
                                        <th>Operations</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @php
                                        $pos=0;
                                    @endphp
                                    @foreach($proveedores as $proveedores_)
                                        @php
                                          $pos++;
                                          $dato=explode('_',$proveedores_);
                                        @endphp
{{--                                        @foreach($hotel->where('Proveedores_id',$proveedores_) as $hotel_)--}}
                                        <tr>
                                            <td></td>
                                            <td>{{$dato[0]}}</td>
                                            <td>{{$dato[1]}}</td>
                                            <td>
                                                <button type="button" class="btn btn-warning"  data-toggle="modal" data-target="#modal_edit_cost_hotel_{{$pos}}">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger" onclick="eliminar_hotel_pro('{{$pos}}','{{$dato[1]}}')">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        {{--@endforeach--}}
                                    @endforeach
                                    {{--@foreach($productos as $proveedor)--}}
                                        {{--@foreach($proveedor->productos  as $producto)--}}
                                            {{--@if($producto->grupo==$categoria->nombre)--}}
                                                {{--<tr id="lista_services_{{$producto->id}}">--}}
                                                    {{--<td><b class="text-success"><i class="fa fa-bus fa-2x" aria-hidden="true"></i></b></td>--}}
                                                    {{--<td>{{$producto->localizacion}}</td>--}}
                                                    {{--<td>{{$producto->tipo_producto}}</td>--}}
                                                    {{--<td><b class="bg-green-goto text-grey-goto">{{$proveedor->codigo}}</b> {{$proveedor->razon_social}}</td>--}}
                                                    {{--<td><b class="bg-orange-goto text-grey-goto">{{$producto->codigo}}</b>{{$producto->nombre}}</td>--}}
                                                    {{--<td>${{$producto->precio_costo}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--<button type="button" class="btn btn-warning"  data-toggle="modal" data-target="#modal_edit_cost_{{$producto->id}}">--}}
                                                            {{--<i class="fa fa-pencil-square-o" aria-hidden="true"></i>--}}
                                                        {{--</button>--}}
                                                        {{--<button type="button" class="btn btn-danger" onclick="eliminar_producto('{{$producto->id}}','{{$producto->nombre}}')">--}}
                                                            {{--<i class="fa fa-trash-o" aria-hidden="true"></i>--}}
                                                        {{--</button>--}}
                                                    {{--</td>--}}
                                                {{--</tr>--}}
                                            {{--@endif--}}
                                        {{--@endforeach--}}
                                    {{--@endforeach--}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                    <?php
                        $pos++;
                    ?>
                @endforeach
            </div>
            @php
                $pos=0;
            @endphp
            @foreach($proveedores as $proveedores_)
                @php
                    $pos++;
                    $dato=explode('_',$proveedores_);
                @endphp
                @foreach($hotel->where('localizacion',$dato[0])->where('proveedores_id',$dato[1])->where('estrellas','3') as $hotel_)
                {{dd($hotel_)}}
                @endforeach
                <div class="modal fade bd-example-modal-lg" id="modal_edit_cost_hotel_{{$pos}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form action="{{route('costs_edit_hotel_path')}}" method="post" id="service_save_id" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Cost</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {{csrf_field()}}
                                <input type="hidden" name="id" id="id" value="{{$producto->id}}">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        <?php
            $pos0=0;
            ?>
            @foreach($productos as $proveedor)
                @foreach($proveedor->productos  as $producto)
                    <!-- Modal -->
                    <div class="modal fade bd-example-modal-lg" id="modal_edit_cost_{{$producto->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <form action="{{route('costs_edit_path')}}" method="post" id="service_save_id" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Cost</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a data-toggle="tab" href="#e_{{$producto->grupo}}_{{$producto->id}}">{{$producto->grupo}}</a></li>
                                              </ul>
                                            <div class="tab-content">
                                                 <div id="e_{{$producto->grupo}}_{{$producto->id}}" class="tab-pane fade in active">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_codigo">Location</label>
                                                                {{--<input type="text" class="form-control" id="txt_localizacion_0" name="txt_localizacion_0" placeholder="Location">--}}
                                                                <select class="form-control" id="etxt_localizacion_{{$pos0}}" name="txt_localizacion_0">
                                                                    @foreach($destinations as $destination)
                                                                        <option value="{{$destination->destino}}" @if($destination->destino==$producto->localizacion) {{'selected'}} @endif>{{$destination->destino}}</option>
                                                                    @endforeach
                                                                </select>

                                                                <input type="hidden" name="tipoServicio_{{$pos0}}" id="tipoServicio_{{$pos0}}" value="{{$categoria->nombre}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_type">Type</label>
                                                                {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}

                                                                @if($producto->grupo=='HOTELS')
                                                                    <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                        <option value="2 STARS" @if($producto->tipo_producto=='2 STARS') {{'selected'}} @endif>2 STARS</option>
                                                                        <option value="3 STARS" @if($producto->tipo_producto=='3 STARS') {{'selected'}} @endif>3 STARS</option>
                                                                        <option value="4 STARS" @if($producto->tipo_producto=='4 STARS') {{'selected'}} @endif>4 STARS</option>
                                                                        <option value="5 STARS" @if($producto->tipo_producto=='5 STARS') {{'selected'}} @endif>5 STARS</option>
                                                                    </select>
                                                                @endif
                                                                @if($producto->grupo=='TOURS')
                                                                    <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                        <option value="GROUP" @if($producto->tipo_producto=='GROUP') {{'selected'}} @endif>GROUP</option>
                                                                        <option value="PRIVATE" @if($producto->tipo_producto=='PRIVATE') {{'selected'}} @endif>PRIVATE</option>
                                                                    </select>
                                                                @endif
                                                                @if($producto->grupo=='MOVILID')
                                                                    <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                        <option value="AUTO" @if($producto->tipo_producto=='AUTO') {{'selected'}} @endif>AUTO</option>
                                                                        <option value="SUBARU" @if($producto->tipo_producto=='SUBARU') {{'selected'}} @endif>SUBARU</option>
                                                                        <option value="VAN" @if($producto->tipo_producto=='VAN') {{'selected'}} @endif>VAN</option>
                                                                        <option value="H1" @if($producto->tipo_producto=='H1') {{'selected'}} @endif>H1</option>
                                                                        <option value="SPRINTER" @if($producto->tipo_producto=='SPRINTER') {{'selected'}} @endif>SPRINTER</option>
                                                                    </select>
                                                                @endif
                                                                @if($producto->grupo=='REPRESENT')
                                                                    <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                        <option value="GUIDE" @if($producto->tipo_producto=='GUIDE') {{'selected'}} @endif>GUIDE</option>
                                                                        <option value="TRANSFER" @if($producto->tipo_producto=='TRANSFER') {{'selected'}} @endif>TRANSFER</option>
                                                                        <option value="ASSISTANCE" @if($producto->tipo_producto=='ASSISTANCE') {{'selected'}} @endif>ASSISTANCE</option>
                                                                    </select>
                                                                @endif
                                                                @if($producto->grupo=='ENTRANCES')
                                                                    <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                        <option value="EXTRANJERO" @if($producto->tipo_producto=='EXTRANJERO') {{'selected'}} @endif>EXTRANJERO</option>
                                                                        <option value="NATIONAL" @if($producto->tipo_producto=='NATIONAL') {{'selected'}} @endif>NATIONAL</option>
                                                                    </select>
                                                                @endif
                                                                @if($producto->grupo=='FOOD')
                                                                    <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                        <option value="LUNCH" @if($producto->tipo_producto=='LUNCH') {{'selected'}} @endif>LUNCH</option>
                                                                        <option value="DINNER" @if($producto->tipo_producto=='DINNER') {{'selected'}} @endif>DINNER</option>
                                                                        <option value="BOX LUNCH" @if($producto->tipo_producto=='BOX LUNCH') {{'selected'}} @endif>BOX LUNCH</option>
                                                                    </select>
                                                                @endif
                                                                @if($producto->grupo=='TRAINS')
                                                                    <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                        <option value="EXPEDITION" @if($producto->tipo_producto=='EXPEDITION') {{'selected'}} @endif>EXPEDITION</option>
                                                                        <option value="VISITADOME" @if($producto->tipo_producto=='VISITADOME') {{'selected'}} @endif>VISITADOME</option>
                                                                        <option value="HIRAN BINGHAN" @if($producto->tipo_producto=='HIRAN BINGHAN') {{'selected'}} @endif>BOX LUNCH</option>
                                                                        <option value="EJECUTIVO" @if($producto->tipo_producto=='EJECUTIVO') {{'selected'}} @endif>EJECUTIVO</option>
                                                                        <option value="PRIMERA CLASE" @if($producto->tipo_producto=='PRIMERA CLASE') {{'selected'}} @endif>PRIMERA CLASE</option>
                                                                    </select>
                                                                @endif
                                                                @if($producto->grupo=='FLIGHTS')
                                                                    <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                        <option value="NATIONAL" @if($producto->tipo_producto=='NATIONAL') {{'selected'}} @endif>NATIONAL</option>
                                                                        <option value="INTERNATIONAL" @if($producto->tipo_producto=='INTERNATIONAL') {{'selected'}} @endif>INTERNATIONAL</option>
                                                                    </select>
                                                                @endif
                                                                @if($producto->grupo=='OTHERS')
                                                                    <input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type" value="{{$producto->tipo_producto}}">
                                                                @endif

                                                            </div>
                                                        </div>
                                                        @if($producto->grupo=='HOTELS')
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_type">Accommodation</label>
                                                                    {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                                    <select class="form-control" id="txt_acomodacion_0" name="txt_acomodacion_0">
                                                                        <option value="S" @if($producto->acomodacion=='S') {{'selected'}} @endif>SIMPLE</option>
                                                                        <option value="D" @if($producto->acomodacion=='D') {{'selected'}} @endif>DOBLE</option>
                                                                        <option value="M" @if($producto->acomodacion=='M') {{'selected'}} @endif>MATRIMONIAL</option>
                                                                        <option value="T" @if($producto->acomodacion=='T') {{'selected'}} @endif>TRIPLE</option>
                                                                        <option value="SS" @if($producto->acomodacion=="SS")  {{'selected'}} @endif>SUPERIOR SIMPLE</option>
                                                                        <option value="SD" @if($producto->acomodacion=="SD")  {{'selected'}} @endif>SUPERIOR DOBLE</option>
                                                                        <option value="SU" @if($producto->acomodacion=="SU")  {{'selected'}} @endif>SUITE</option>
                                                                        <option value="JS" @if($producto->acomodacion=="JR")  {{'selected'}} @endif>JR. SUITE</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="col-md-4">
                                                            <div class="form-group col-md-9">
                                                                <label for="txt_precio">Provider</label>
                                                                <input type="text" class="form-control" id="e_txt_provider_{{$pos0}}" name="txt_provider_0" placeholder="Provider" value="{{$proveedor->codigo.' '.$proveedor->razon_social}}">
                                                            </div>
                                                            <div class="col-md-3 margin-top-25 ">
                                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_new_provider" onclick="pasar_pos_provider('0')">
                                                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_product">Product</label>
                                                                <input type="text" class="form-control" id="e_txt_product_{{$pos0}}" name="txt_product_0" placeholder="Product" value="{{$producto->codigo.' '.$producto->nombre}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 hide">
                                                            <div class="form-group">
                                                                <label for="txt_code">Code product</label>
                                                                <input type="text" class="form-control" id="txt_code_0" name="txt_code_0" placeholder="Code product" value="{{$producto->codigo}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_price">Price</label>
                                                                <input type="text" class="form-control" id="txt_price_0" name="txt_price_0" placeholder="Price" value="{{$producto->precio_costo}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 hide">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class=" text-green-goto">
                                                                        <input type="radio" name="txt_tipo_grupo_{{$pos0}}" value="Absoluto" checked="checked">
                                                                        Precio es absoluto
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class=" text-green-goto">
                                                                        <input type="radio" name="txt_tipo_grupo_{{$pos0}}" value="Individual">
                                                                        Precio es individual
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                              </div>
                                        </div>
                                        <div class="modal-footer">
                                            {{csrf_field()}}
                                            <input type="hidden" name="posTipoEditcost_{{$producto->id}}" id="posTipoEditcost_{{$producto->id}}" value="0">
                                            <input type="hidden" name="id" id="id" value="{{$producto->id}}">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                        $pos0++;
                        ?>
                @endforeach
            @endforeach

            <input type="hidden" id="localizacion1_0" name="localizacion1_0" value="CUSCO">
            <input type="hidden" id="localizacion1_1" name="localizacion1_1" value="CUSCO">
            <input type="hidden" id="localizacion1_2" name="localizacion1_2" value="CUSCO">
            <input type="hidden" id="localizacion1_3" name="localizacion1_3" value="CUSCO">
            <input type="hidden" id="localizacion1_4" name="localizacion1_4" value="CUSCO">
            <input type="hidden" id="localizacion1_5" name="localizacion1_5" value="CUSCO">
            <input type="hidden" id="localizacion1_6" name="localizacion1_6" value="CUSCO">
            <input type="hidden" id="localizacion1_7" name="localizacion1_7" value="CUSCO">
            <input type="hidden" id="localizacion1_8" name="localizacion1_8" value="CUSCO">
            <?php
            $pos0=0;
            ?>

            @foreach($productos as $proveedor)
                @foreach($proveedor->productos  as $producto)
                    <input type="hidden" id="e_localizacion_{{$pos0}}" value="CUSCO">
                    <?php
                    $pos0++;
                    ?>
                @endforeach
            @endforeach
        </div>
    </div>

    <script>
        $(document).ready(function() {
            <?php
                $i=0;
            ?>
            @foreach($tipoServicio as $tipoServicio_)
            $("select[id=txt_localizacion_{{$i}}]").change(function(){
                $('#localizacion1_{{$i}}').val($('select[id=txt_localizacion_{{$i}}]').val());
            });

            <?php
                $i++;
            ?>
            $('#tb_{{$tipoServicio_}}').DataTable();
            @endforeach


            <?php
            $pos0=0;
            ?>

            @foreach($productos as $proveedor)
                @foreach($proveedor->productos  as $producto)
                    $("select[id=etxt_localizacion_{{$pos0}}]").change(function(){
                        $('#e_localizacion_{{$pos0}}').val($('select[id=etxt_localizacion_{{$pos0}}]').val());
                     });
                <?php
                $pos0++;
                ?>
                @endforeach
            @endforeach



        } );
        $(function () {
            <?php
                $i=0;
            ?>
        @foreach($tipoServicio as $tipoServicio_)
            $('#txt_provider_{{$i}}').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "buscar-proveedor",
                        dataType: "json",
                        data: {
                            term : request.term,
                            localizacion : $("#localizacion1_{{$i}}").val(),
                            grupo : '{{$tipoServicio_}}'
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                minLength: 1
            });
            <?php
                $i++;
            ?>
        @endforeach

        <?php
        $pos10=0;
        ?>
        @foreach($productos as $proveedor1)
            @foreach($proveedor1->productos  as $producto1)
            $('#e_txt_provider_{{$pos10}}').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "buscar-proveedor",
                        dataType: "json",
                        data: {
                            term : request.term,
                            localizacion : $("#e_localizacion_{{$pos10}}").val(),
                            grupo : '{{$producto1->grupo}}'
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                minLength: 1
            });
            <?php
                $pos10++;
            ?>
            @endforeach
        @endforeach

        <?php
            $i=0;
        ?>
        @foreach($tipoServicio as $tipoServicio_)
            $('#txt_product_{{$i}}').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "buscar-product",
                        dataType: "json",
                        data: {
                            term : request.term,
                            localizacion : $("#localizacion1_{{$i}}").val(),
                            grupo : '{{$tipoServicio_}}'
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                minLength: 1
            });
            <?php
                $i++;
            ?>
        @endforeach
        <?php
        $pos10=0;
        ?>
        @foreach($productos as $proveedor1)
            @foreach($proveedor1->productos  as $producto1)
            $('#e_txt_product_{{$pos10}}').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "buscar-product",
                        dataType: "json",
                        data: {
                            term : request.term,
                            localizacion : $("#e_localizacion_{{$pos10}}").val(),
                            grupo : '{{$producto1->grupo}}'
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                minLength: 1
            });
            <?php
            $pos10++;
            ?>
            @endforeach
        @endforeach
        });
    </script>
@stop