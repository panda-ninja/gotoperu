@extends('.layouts.admin')
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
            <li class="active">Cost</li>
        </ol>
    </div>
    <div class="row margin-top-20">
        <a type="button" class="btn btn-primary" onclick="mostrar_new_cost()">
            New <i class="fa fa-plus-circle" aria-hidden="true"></i>
        </a>
        <div class="margin-top-20 panel panel-default panel-floating panel-floating-inline hide" id="modal_new_cost">
                        <div class="panel-body">
                        <form  action="{{route('costs_save_path')}}" method="post" id="service_save_id" enctype="multipart/form-data">

                        <?php
                        $tipoServicio[0]='HOTELS';
                        $tipoServicio[1]='TOURS';
                        $tipoServicio[2]='TRANSPORTATION';
                        $tipoServicio[3]='GUIDES_ASSIST';
                        $tipoServicio[4]='ENTRANCES';
                        $tipoServicio[5]='FOOD';
                        $tipoServicio[6]='OTHERS';
                        ?>
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#{{$tipoServicio[0]}}" onclick="escojerPos(0)">{{$tipoServicio[0]}}</a></li>
                                <li><a data-toggle="tab" href="#{{$tipoServicio[1]}}" onclick="escojerPos(1)">{{$tipoServicio[1]}}</a></li>
                                <li><a data-toggle="tab" href="#{{$tipoServicio[2]}}" onclick="escojerPos(2)">{{$tipoServicio[2]}}</a></li>
                                <li><a data-toggle="tab" href="#{{$tipoServicio[3]}}" onclick="escojerPos(3)">{{$tipoServicio[3]}}</a></li>
                                <li><a data-toggle="tab" href="#{{$tipoServicio[4]}}" onclick="escojerPos(4)">{{$tipoServicio[4]}}</a></li>
                                <li><a data-toggle="tab" href="#{{$tipoServicio[5]}}" onclick="escojerPos(5)">{{$tipoServicio[5]}}</a></li>
                                <li><a data-toggle="tab" href="#{{$tipoServicio[6]}}" onclick="escojerPos(6)">{{$tipoServicio[6]}}</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="{{$tipoServicio[0]}}" class="tab-pane fade in active">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Location</label>
                                                <input type="text" class="form-control" id="txt_localizacion_0" name="txt_localizacion_0" placeholder="Location">
                                                <input type="hidden" name="tipoServicio_0" id="tipoServicio_0" value="{{$tipoServicio[0]}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_type">Type</label>
                                                {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                    <option value="2 STARS">2 STARS</option>
                                                    <option value="3 STARS">3 STARS</option>
                                                    <option value="4 STARS">4 STARS</option>
                                                    <option value="5 STARS">5 STARS</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group col-md-9">
                                                <label for="txt_precio">Provider</label>
                                                <input type="text" class="form-control" id="txt_provider_0" name="txt_provider_0" placeholder="Provider">
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
                                                <input type="text" class="form-control" id="txt_product_0" name="txt_product_0" placeholder="Product">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_code">Code product</label>
                                                <input type="text" class="form-control" id="txt_code_0" name="txt_code_0" placeholder="Code product">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Price</label>
                                                <input type="text" class="form-control" id="txt_price_0" name="txt_price_0" placeholder="Price">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div id="{{$tipoServicio[1]}}" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Location</label>
                                                <input type="text" class="form-control" id="txt_localizacion_1" name="txt_localizacion_1" placeholder="Location">
                                                <input type="hidden" name="tipoServicio_1" id="tipoServicio_1" value="{{$tipoServicio[1]}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_type">Type</label>
                                                <select class="form-control" id="txt_type_1" name="txt_type_1">
                                                    <option value="GROUP">GROUP</option>
                                                    <option value="PRIVATE">PRIVATE</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group col-md-9">
                                                <label for="txt_precio">Provider</label>
                                                <input type="text" class="form-control" id="txt_provider_1" name="txt_provider_1" placeholder="Provider">
                                            </div>
                                            <div class="col-md-3 margin-top-25 ">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_new_provider" onclick="pasar_pos_provider('1')">
                                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_product">Product</label>
                                                <input type="text" class="form-control" id="txt_product_1" name="txt_product_1" placeholder="Product">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_code">Code product</label>
                                                <input type="text" class="form-control" id="txt_code_1" name="txt_code_1" placeholder="Code product">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Price</label>
                                                <input type="text" class="form-control" id="txt_price_1" name="txt_price_1" placeholder="Price">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div id="{{$tipoServicio[2]}}" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Location</label>
                                                <input type="text" class="form-control" id="txt_localizacion_2" name="txt_localizacion_2" placeholder="Location">
                                                <input type="hidden" name="tipoServicio_2" id="tipoServicio_2" value="{{$tipoServicio[2]}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_type">Type</label>
                                                <select class="form-control" id="txt_type_2" name="txt_type_2">
                                                    <option value="AUTO">AUTO</option>
                                                    <option value="VAN">VAN</option>
                                                    <option value="SPRINTER">SPRINTER</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group col-md-9">
                                                <label for="txt_precio">Provider</label>
                                                <input type="text" class="form-control" id="txt_provider_2" name="txt_provider_2" placeholder="Provider">
                                            </div>
                                            <div class="col-md-3 margin-top-25 ">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_new_provider" onclick="pasar_pos_provider('2')">
                                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_product">Product</label>
                                                <input type="text" class="form-control" id="txt_product_2" name="txt_product_2" placeholder="Product">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_code">Code product</label>
                                                <input type="text" class="form-control" id="txt_code_2" name="txt_code_2" placeholder="Code product">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Price</label>
                                                <input type="text" class="form-control" id="txt_price_2" name="txt_price_2" placeholder="Price">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div id="{{$tipoServicio[3]}}" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Location</label>
                                                <input type="text" class="form-control" id="txt_localizacion_3" name="txt_localizacion_3" placeholder="Location">
                                                <input type="hidden" name="tipoServicio_3" id="tipoServicio_3" value="{{$tipoServicio[3]}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_type">Type</label>
                                                <select class="form-control" id="txt_type_3" name="txt_type_3">
                                                    <option value="GUIDE">GUIDE</option>
                                                    <option value="TRANSFER">TRANSFER</option>
                                                    <option value="ASSISTANCE">ASSISTANCE</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group col-md-9">
                                                <label for="txt_precio">Provider</label>
                                                <input type="text" class="form-control" id="txt_provider_3" name="txt_provider_3" placeholder="Provider">
                                            </div>
                                            <div class="col-md-3 margin-top-25 ">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_new_provider" onclick="pasar_pos_provider('3')">
                                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_product">Product</label>
                                                <input type="text" class="form-control" id="txt_product_3" name="txt_product_3" placeholder="Product">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_code">Code product</label>
                                                <input type="text" class="form-control" id="txt_code_3" name="txt_code_3" placeholder="Code product">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Price</label>
                                                <input type="text" class="form-control" id="txt_price_3" name="txt_price_3" placeholder="Price">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div id="{{$tipoServicio[4]}}" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Location</label>
                                                <input type="text" class="form-control" id="txt_localizacion_4" name="txt_localizacion_4" placeholder="Location">
                                                <input type="hidden" name="tipoServicio_4" id="tipoServicio_4" value="{{$tipoServicio[4]}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_type">Type</label>
                                                <select class="form-control" id="txt_type_4" name="txt_type_4">
                                                    <option value="EXTRANJERO">EXTRANJERO</option>
                                                    <option value="NATIONAL">NATIONAL</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group col-md-9">
                                                <label for="txt_precio">Provider</label>
                                                <input type="text" class="form-control" id="txt_provider_4" name="txt_provider_4" placeholder="Provider">
                                            </div>
                                            <div class="col-md-3 margin-top-25 ">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_new_provider" onclick="pasar_pos_provider('4')">
                                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_product">Product</label>
                                                <input type="text" class="form-control" id="txt_product_4" name="txt_product_4" placeholder="Product">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_code">Code product</label>
                                                <input type="text" class="form-control" id="txt_code_4" name="txt_code_4" placeholder="Code product">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Price</label>
                                                <input type="text" class="form-control" id="txt_price_4" name="txt_price_4" placeholder="Price">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div id="{{$tipoServicio[5]}}" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Location</label>
                                                <input type="text" class="form-control" id="txt_localizacion_5" name="txt_localizacion_5" placeholder="Location">
                                                <input type="hidden" name="tipoServicio_5" id="tipoServicio_5" value="{{$tipoServicio[5]}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_type">Type</label>
                                                <select class="form-control" id="txt_type_5" name="txt_type_5">
                                                    <option value="LUNCH">LUNCH</option>
                                                    <option value="DINNER">DINNER</option>
                                                    <option value="BOX LUNCH">BOX LUNCH</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group col-md-9">
                                                <label for="txt_precio">Provider</label>
                                                <input type="text" class="form-control" id="txt_provider_5" name="txt_provider_5" placeholder="Provider">
                                            </div>
                                            <div class="col-md-3 margin-top-25 ">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_new_provider" onclick="pasar_pos_provider('5')">
                                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_product">Product</label>
                                                <input type="text" class="form-control" id="txt_product_5" name="txt_product_5" placeholder="Product">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_code">Code product</label>
                                                <input type="text" class="form-control" id="txt_code_5" name="txt_code_5" placeholder="Code product">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Price</label>
                                                <input type="text" class="form-control" id="txt_price_5" name="txt_price_5" placeholder="Price">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div id="{{$tipoServicio[6]}}" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Location</label>
                                                <input type="text" class="form-control" id="txt_localizacion_6" name="txt_localizacion_6" placeholder="Location">
                                                <input type="hidden" name="tipoServicio_6" id="tipoServicio_6" value="{{$tipoServicio[6]}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_type">Type</label>
                                                <input type="text" class="form-control" id="txt_type_6" name="txt_type_6" placeholder="Type">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group col-md-9">
                                                <label for="txt_precio">Provider</label>
                                                <input type="text" class="form-control" id="txt_provider_6" name="txt_provider_6" placeholder="Provider">
                                            </div>
                                            <div class="col-md-3 margin-top-25 ">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_new_provider" onclick="pasar_pos_provider('6')">
                                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_product">Product</label>
                                                <input type="text" class="form-control" id="txt_product_6" name="txt_product_6" placeholder="Product">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_code">Code product</label>
                                                <input type="text" class="form-control" id="txt_code_6" name="txt_code_6" placeholder="Code product">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Price</label>
                                                <input type="text" class="form-control" id="txt_price_6" name="txt_price_6" placeholder="Price">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{csrf_field()}}
                            <input type="hidden" name="posTipo" id="posTipo" value="0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>

                    </form>
                    </div>
                    </div>

        {{-- primer popup --}}
        <div class="modal fade bd-example-modal-lg" id="modal_new_provider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form  id="service_save_id"  method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New provider</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Servicio</label>
                                                <select class="form-control" id="txt_grupo" name="txt_grupo">
                                                    @foreach($tipoServicio as $tipoServicio_)
                                                        <option value="{{$tipoServicio_}}">{{$tipoServicio_}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Location</label>
                                                <select class="form-control" id="txt_localizacion" name="txt_localizacion">
                                                    @foreach($destinations as $destination)
                                                        <option value="{{$destination->destino}}">{{$destination->destino}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Ruc</label>
                                                <input type="text" class="form-control" id="txt_ruc" name="txt_ruc" placeholder="Ruc">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_type">Razon social</label>
                                                <input type="text" class="form-control" id="txt_razon_social" name="txt_razon_social" placeholder="Razon social">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_precio">Direccion</label>
                                                <input type="text" class="form-control" id="txt_direccion" name="txt_direccion" placeholder="Direccion">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_product">Telefono</label>
                                                <input type="text" class="form-control" id="txt_telefono" name="txt_telefono" placeholder="Telefono">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_code">Celular</label>
                                                <input type="text" class="form-control" id="txt_celular" name="txt_celular" placeholder="Celular">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Email</label>
                                                <input type="email" class="form-control" id="txt_email" name="txt_email" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Reservas Contacto</label>
                                                <input type="text" class="form-control" id="txt_r_nombres" name="txt_r_nombres" placeholder="Nombres, apellidos">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Reservas Tel/Cel</label>
                                                <input type="text" class="form-control" id="txt_r_telefono" name="txt_r_telefono" placeholder="Tel. o Cel.">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Contabilidad Contacto</label>
                                                <input type="text" class="form-control" id="txt_c_nombres" name="txt_c_nombres" placeholder="Nombres, apellidos">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Contabilidad Tel/Cel</label>
                                                <input type="text" class="form-control" id="txt_c_telefono" name="txt_c_telefono" placeholder="Tel. o Cel.">
                                            </div>
                                        </div>
                                        <div id="rpt" class="col-ms-12"></div>
                                    </div>
                        </div>
                        <div class="modal-footer">
                            {{csrf_field()}}
                            <input type="hidden" name="grupo_provider" id="grupo_provider" value="0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="envia()">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div class="row margin-top-20">
        <div class="col-lg-12">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#t_{{$tipoServicio[0]}}">{{$tipoServicio[0]}}</a></li>
                <li><a data-toggle="tab" href="#t_{{$tipoServicio[1]}}" onclick="escojerPos(1)">{{$tipoServicio[1]}}</a></li>
                <li><a data-toggle="tab" href="#t_{{$tipoServicio[2]}}" onclick="escojerPos(2)">{{$tipoServicio[2]}}</a></li>
                <li><a data-toggle="tab" href="#t_{{$tipoServicio[3]}}" onclick="escojerPos(3)">{{$tipoServicio[3]}}</a></li>
                <li><a data-toggle="tab" href="#t_{{$tipoServicio[4]}}" onclick="escojerPos(4)">{{$tipoServicio[4]}}</a></li>
                <li><a data-toggle="tab" href="#t_{{$tipoServicio[5]}}" onclick="escojerPos(5)">{{$tipoServicio[5]}}</a></li>
                <li><a data-toggle="tab" href="#t_{{$tipoServicio[6]}}" onclick="escojerPos(6)">{{$tipoServicio[6]}}</a></li>
            </ul>
            <div class="tab-content">
                <div id="t_{{$tipoServicio[0]}}" class="tab-pane fade in active">
                    <div class="margin-top-20">
                        <table id="tb_{{$tipoServicio[0]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
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
                        @foreach($productos_hotels as $proveedor)
                            @foreach($proveedor->productos  as $producto)
                                <tr id="lista_services_{{$producto->id}}">
                                    <td><b class="text-success"><i class="fa fa-bus fa-2x" aria-hidden="true"></i></b></td>
                                    <td>{{$producto->localizacion}}</td>
                                    <td>{{$producto->tipo_producto}}</td>
                                    <td>{{$proveedor->razon_social}} <b class="bg-green-goto text-grey-goto">{{$proveedor->codigo}}</b></td>
                                    <td>{{$producto->nombre}} <b class="bg-orange-goto text-grey-goto">{{$producto->codigo}}</b></td>
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
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
                <div id="t_{{$tipoServicio[1]}}" class="tab-pane fade">
                    <div class="margin-top-20">
                        <table id="tb_{{$tipoServicio[1]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
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
                            @foreach($productos_tours as $proveedor)
                                @foreach($proveedor->productos  as $producto)
                                    <tr id="lista_services_{{$producto->id}}">
                                        <td><b class="text-success"><i class="fa fa-bus fa-2x" aria-hidden="true"></i></b></td>
                                        <td>{{$producto->localizacion}}</td>
                                        <td>{{$producto->tipo_producto}}</td>
                                        <td>{{$proveedor->razon_social}} <b class="bg-green-goto text-grey-goto">{{$proveedor->codigo}}</b></td>
                                        <td>{{$producto->nombre}} <b class="bg-orange-goto text-grey-goto">{{$producto->codigo}}</b></td>
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
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="t_{{$tipoServicio[2]}}" class="tab-pane fade">
                    <div class="margin-top-20">
                        <table id="tb_{{$tipoServicio[2]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
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
                            @foreach($productos_transp as $proveedor)
                                @foreach($proveedor->productos  as $producto)
                                    <tr id="lista_services_{{$producto->id}}">
                                        <td><b class="text-success"><i class="fa fa-bus fa-2x" aria-hidden="true"></i></b></td>
                                        <td>{{$producto->localizacion}}</td>
                                        <td>{{$producto->tipo_producto}}</td>
                                        <td>{{$proveedor->razon_social}} <b class="bg-green-goto text-grey-goto">{{$proveedor->codigo}}</b></td>
                                        <td>{{$producto->nombre}} <b class="bg-orange-goto text-grey-goto">{{$producto->codigo}}</b></td>
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
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="t_{{$tipoServicio[3]}}" class="tab-pane fade">
                    <div class="margin-top-20">
                        <table id="tb_{{$tipoServicio[3]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
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
                            @foreach($productos_guides as $proveedor)
                                @foreach($proveedor->productos  as $producto)
                                    <tr id="lista_services_{{$producto->id}}">
                                        <td><b class="text-success"><i class="fa fa-bus fa-2x" aria-hidden="true"></i></b></td>
                                        <td>{{$producto->localizacion}}</td>
                                        <td>{{$producto->tipo_producto}}</td>
                                        <td>{{$proveedor->razon_social}} <b class="bg-green-goto text-grey-goto">{{$proveedor->codigo}}</b></td>
                                        <td>{{$producto->nombre}} <b class="bg-orange-goto text-grey-goto">{{$producto->codigo}}</b></td>
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
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="t_{{$tipoServicio[4]}}" class="tab-pane fade">
                    <div class="margin-top-20">
                        <table id="tb_{{$tipoServicio[4]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
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
                            @foreach($productos_entrances as $proveedor)
                                @foreach($proveedor->productos  as $producto)
                                    <tr id="lista_services_{{$producto->id}}">
                                        <td><b class="text-success"><i class="fa fa-bus fa-2x" aria-hidden="true"></i></b></td>
                                        <td>{{$producto->localizacion}}</td>
                                        <td>{{$producto->tipo_producto}}</td>
                                        <td>{{$proveedor->razon_social}} <b class="bg-green-goto text-grey-goto">{{$proveedor->codigo}}</b></td>
                                        <td>{{$producto->nombre}} <b class="bg-orange-goto text-grey-goto">{{$producto->codigo}}</b></td>
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
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="t_{{$tipoServicio[5]}}" class="tab-pane fade">
                    <div class="margin-top-20">
                        <table id="tb_{{$tipoServicio[5]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
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
                            @foreach($productos_food as $proveedor)
                                @foreach($proveedor->productos  as $producto)
                                    <tr id="lista_services_{{$producto->id}}">
                                        <td><b class="text-success"><i class="fa fa-bus fa-2x" aria-hidden="true"></i></b></td>
                                        <td>{{$producto->localizacion}}</td>
                                        <td>{{$producto->tipo_producto}}</td>
                                        <td>{{$proveedor->razon_social}} <b class="bg-green-goto text-grey-goto">{{$proveedor->codigo}}</b></td>
                                        <td>{{$producto->nombre}} <b class="bg-orange-goto text-grey-goto">{{$producto->codigo}}</b></td>
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
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="t_{{$tipoServicio[6]}}" class="tab-pane fade">
                    <div class="margin-top-20">
                        <table id="tb_{{$tipoServicio[6]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
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
                            @foreach($productos_others as $proveedor)
                                @foreach($proveedor->productos  as $producto)
                                    <tr id="lista_services_{{$producto->id}}">
                                        <td><b class="text-success"><i class="fa fa-bus fa-2x" aria-hidden="true"></i></b></td>
                                        <td>{{$producto->localizacion}}</td>
                                        <td>{{$producto->tipo_producto}}</td>
                                        <td>{{$proveedor->razon_social}} <b class="bg-green-goto text-grey-goto">{{$proveedor->codigo}}</b></td>
                                        <td>{{$producto->nombre}} <b class="bg-orange-goto text-grey-goto">{{$producto->codigo}}</b></td>
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
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @foreach($productos_hotels as $proveedor)
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
                                        <?php
                                        $act_menu0='hide';
                                        $act_menu1='hide';
                                        $act_menu2='hide';
                                        $act_menu3='hide';
                                        $act_menu4='hide';
                                        $act_menu5='hide';
                                        $act_menu6='hide';

                                        $act_tabmenu0='';
                                        $act_tabmenu1='';
                                        $act_tabmenu2='';
                                        $act_tabmenu3='';
                                        $act_tabmenu4='';
                                        $act_tabmenu5='';
                                        $act_tabmenu6='';

                                        if($tipoServicio[0]==$producto->grupo){
                                            $act_menu0='active';
                                            $act_tabmenu0='in active';
                                            }
                                        if($tipoServicio[1]==$producto->grupo){
                                            $act_menu1='active';
                                            $act_tabmenu1='in active';
                                        }
                                        if($tipoServicio[2]==$producto->grupo){
                                            $act_menu2='active';
                                            $act_tabmenu2='in active';
                                        }
                                        if($tipoServicio[3]==$producto->grupo){
                                            $act_menu3='active';
                                            $act_tabmenu3='in active';
                                        }
                                        if($tipoServicio[4]==$producto->grupo){
                                            $act_menu4='active';
                                            $act_tabmenu4='in active';
                                        }
                                        if($tipoServicio[5]==$producto->grupo){
                                            $act_menu5='active';
                                            $act_tabmenu5='in active';
                                        }
                                        if($tipoServicio[6]==$producto->grupo){
                                            $act_menu6='active';
                                            $act_tabmenu6='in active';
                                        }
                                        ?>
                                        <div class="modal-body">
                                            <ul class="nav nav-tabs">
                                                <li class="<?php echo $act_menu0;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[0]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','0')">{{$tipoServicio[0]}}</a></li>
                                                <li class="<?php echo $act_menu1;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[1]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','1')">{{$tipoServicio[1]}}</a></li>
                                                <li class="<?php echo $act_menu2;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[2]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','2')">{{$tipoServicio[2]}}</a></li>
                                                <li class="<?php echo $act_menu3;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[3]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','3')">{{$tipoServicio[3]}}</a></li>
                                                <li class="<?php echo $act_menu4;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[4]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','4')">{{$tipoServicio[4]}}</a></li>
                                                <li class="<?php echo $act_menu5;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[5]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','5')">{{$tipoServicio[5]}}</a></li>
                                                <li class="<?php echo $act_menu6;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[6]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','6')">{{$tipoServicio[6]}}</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div id="e_{{$tipoServicio[0]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu0;?>">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_codigo">Location</label>
                                                                <input type="text" class="form-control" id="txt_localizacion_0" name="txt_localizacion_0" placeholder="Location" value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->localizacion;?>">
                                                                <input type="hidden" name="tipoServicio_0" id="tipoServicio_0" value="{{$tipoServicio[0]}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_type">Type</label>
                                                                {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                                <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                    <option value="2 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                    <option value="3 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                    <option value="4 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                    <option value="5 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_precio">Provider</label>
                                                                <input type="text" class="form-control" id="txt_provider_0" name="txt_provider_0" placeholder="Provider" value="<?php if($tipoServicio[0]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_product">Product</label>
                                                                <input type="text" class="form-control" id="txt_product_0" name="txt_product_0" placeholder="Product"  value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->nombre;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_code">Code product</label>
                                                                <input type="text" class="form-control" id="txt_code_0" name="txt_code_0" placeholder="Code product"  value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->codigo;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_price">Price</label>
                                                                <input type="text" class="form-control" id="txt_price_0" name="txt_price_0" placeholder="Price"  value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->precio_costo;?>">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div id="e_{{$tipoServicio[1]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu1;?>">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_codigo">Location</label>
                                                                <input type="text" class="form-control" id="txt_localizacion_1" name="txt_localizacion_1" placeholder="Location" value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->localizacion;?>">
                                                                <input type="hidden" name="tipoServicio_1" id="tipoServicio_1" value="{{$tipoServicio[1]}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_type">Type</label>
                                                                {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                                <select class="form-control" id="txt_type_1" name="txt_type_1">
                                                                    <option value="2 STARS" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                    <option value="3 STARS" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                    <option value="4 STARS" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                    <option value="5 STARS" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_precio">Provider</label>
                                                                <input type="text" class="form-control" id="txt_provider_1" name="txt_provider_1" placeholder="Provider" value="<?php if($tipoServicio[1]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_product">Product</label>
                                                                <input type="text" class="form-control" id="txt_product_1" name="txt_product_1" placeholder="Product"  value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->nombre;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_code">Code product</label>
                                                                <input type="text" class="form-control" id="txt_code_1" name="txt_code_1" placeholder="Code product"  value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->codigo;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_price">Price</label>
                                                                <input type="text" class="form-control" id="txt_price_1" name="txt_price_1" placeholder="Price"  value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->precio_costo;?>">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div id="e_{{$tipoServicio[2]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu2;?>">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_codigo">Location</label>
                                                                <input type="text" class="form-control" id="txt_localizacion_2" name="txt_localizacion_2" placeholder="Location" value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->localizacion;?>">
                                                                <input type="hidden" name="tipoServicio_2" id="tipoServicio_2" value="{{$tipoServicio[2]}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_type">Type</label>
                                                                {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                                <select class="form-control" id="txt_type_2" name="txt_type_2">
                                                                    <option value="2 STARS" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                    <option value="3 STARS" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                    <option value="4 STARS" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                    <option value="5 STARS" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_precio">Provider</label>
                                                                <input type="text" class="form-control" id="txt_provider_2" name="txt_provider_2" placeholder="Provider" value="<?php if($tipoServicio[2]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_product">Product</label>
                                                                <input type="text" class="form-control" id="txt_product_2" name="txt_product_2" placeholder="Product"  value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->nombre;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_code">Code product</label>
                                                                <input type="text" class="form-control" id="txt_code_2" name="txt_code_2" placeholder="Code product"  value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->codigo;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_price">Price</label>
                                                                <input type="text" class="form-control" id="txt_price_2" name="txt_price_2" placeholder="Price"  value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->precio_costo;?>">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div id="e_{{$tipoServicio[3]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu3;?>">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_codigo">Location</label>
                                                                <input type="text" class="form-control" id="txt_localizacion_3" name="txt_localizacion_3" placeholder="Location" value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->localizacion;?>">
                                                                <input type="hidden" name="tipoServicio_3" id="tipoServicio_3" value="{{$tipoServicio[3]}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_type">Type</label>
                                                                {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                                <select class="form-control" id="txt_type_3" name="txt_type_3">
                                                                    <option value="2 STARS" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                    <option value="3 STARS" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                    <option value="4 STARS" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                    <option value="5 STARS" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_precio">Provider</label>
                                                                <input type="text" class="form-control" id="txt_provider_3" name="txt_provider_3" placeholder="Provider" value="<?php if($tipoServicio[3]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_product">Product</label>
                                                                <input type="text" class="form-control" id="txt_product_3" name="txt_product_3" placeholder="Product"  value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->nombre;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_code">Code product</label>
                                                                <input type="text" class="form-control" id="txt_code_3" name="txt_code_3" placeholder="Code product"  value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->codigo;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_price">Price</label>
                                                                <input type="text" class="form-control" id="txt_price_3" name="txt_price_3" placeholder="Price"  value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->precio_costo;?>">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div id="e_{{$tipoServicio[4]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu4;?>">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_codigo">Location</label>
                                                                <input type="text" class="form-control" id="txt_localizacion_4" name="txt_localizacion_4" placeholder="Location" value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->localizacion;?>">
                                                                <input type="hidden" name="tipoServicio_4" id="tipoServicio_4" value="{{$tipoServicio[4]}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_type">Type</label>
                                                                {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                                <select class="form-control" id="txt_type_4" name="txt_type_4">
                                                                    <option value="2 STARS" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                    <option value="3 STARS" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                    <option value="4 STARS" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                    <option value="5 STARS" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_precio">Provider</label>
                                                                <input type="text" class="form-control" id="txt_provider_4" name="txt_provider_4" placeholder="Provider" value="<?php if($tipoServicio[4]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_product">Product</label>
                                                                <input type="text" class="form-control" id="txt_product_4" name="txt_product_4" placeholder="Product"  value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->nombre;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_code">Code product</label>
                                                                <input type="text" class="form-control" id="txt_code_4" name="txt_code_4" placeholder="Code product"  value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->codigo;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_price">Price</label>
                                                                <input type="text" class="form-control" id="txt_price_4" name="txt_price_4" placeholder="Price"  value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->precio_costo;?>">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div id="e_{{$tipoServicio[5]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu5;?>">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_codigo">Location</label>
                                                                <input type="text" class="form-control" id="txt_localizacion_5" name="txt_localizacion_5" placeholder="Location" value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->localizacion;?>">
                                                                <input type="hidden" name="tipoServicio_5" id="tipoServicio_5" value="{{$tipoServicio[5]}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_type">Type</label>
                                                                {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                                <select class="form-control" id="txt_type_5" name="txt_type_5">
                                                                    <option value="2 STARS" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                    <option value="3 STARS" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                    <option value="4 STARS" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                    <option value="5 STARS" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_precio">Provider</label>
                                                                <input type="text" class="form-control" id="txt_provider_5" name="txt_provider_5" placeholder="Provider" value="<?php if($tipoServicio[5]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_product">Product</label>
                                                                <input type="text" class="form-control" id="txt_product_5" name="txt_product_5" placeholder="Product"  value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->nombre;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_code">Code product</label>
                                                                <input type="text" class="form-control" id="txt_code_5" name="txt_code_5" placeholder="Code product"  value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->codigo;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_price">Price</label>
                                                                <input type="text" class="form-control" id="txt_price_5" name="txt_price_5" placeholder="Price"  value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->precio_costo;?>">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div id="e_{{$tipoServicio[6]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu6;?>">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_codigo">Location</label>
                                                                <input type="text" class="form-control" id="txt_localizacion_6" name="txt_localizacion_6" placeholder="Location" value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->localizacion;?>">
                                                                <input type="hidden" name="tipoServicio_6" id="tipoServicio_6" value="{{$tipoServicio[6]}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_type">Type</label>
                                                                {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                                <select class="form-control" id="txt_type_6" name="txt_type_6">
                                                                    <option value="2 STARS" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                    <option value="3 STARS" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                    <option value="4 STARS" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                    <option value="5 STARS" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_precio">Provider</label>
                                                                <input type="text" class="form-control" id="txt_provider_6" name="txt_provider_6" placeholder="Provider" value="<?php if($tipoServicio[6]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_product">Product</label>
                                                                <input type="text" class="form-control" id="txt_product_6" name="txt_product_6" placeholder="Product"  value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->nombre;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_code">Code product</label>
                                                                <input type="text" class="form-control" id="txt_code_6" name="txt_code_6" placeholder="Code product"  value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->codigo;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_price">Price</label>
                                                                <input type="text" class="form-control" id="txt_price_6" name="txt_price_6" placeholder="Price"  value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->precio_costo;?>">
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
                @endforeach
            @endforeach

            @foreach($productos_tours as $proveedor)
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
                                    <?php
                                    $act_menu0='hide';
                                    $act_menu1='hide';
                                    $act_menu2='hide';
                                    $act_menu3='hide';
                                    $act_menu4='hide';
                                    $act_menu5='hide';
                                    $act_menu6='hide';

                                    $act_tabmenu0='';
                                    $act_tabmenu1='';
                                    $act_tabmenu2='';
                                    $act_tabmenu3='';
                                    $act_tabmenu4='';
                                    $act_tabmenu5='';
                                    $act_tabmenu6='';

                                    if($tipoServicio[0]==$producto->grupo){
                                        $act_menu0='active';
                                        $act_tabmenu0='in active';
                                    }
                                    if($tipoServicio[1]==$producto->grupo){
                                        $act_menu1='active';
                                        $act_tabmenu1='in active';
                                    }
                                    if($tipoServicio[2]==$producto->grupo){
                                        $act_menu2='active';
                                        $act_tabmenu2='in active';
                                    }
                                    if($tipoServicio[3]==$producto->grupo){
                                        $act_menu3='active';
                                        $act_tabmenu3='in active';
                                    }
                                    if($tipoServicio[4]==$producto->grupo){
                                        $act_menu4='active';
                                        $act_tabmenu4='in active';
                                    }
                                    if($tipoServicio[5]==$producto->grupo){
                                        $act_menu5='active';
                                        $act_tabmenu5='in active';
                                    }
                                    if($tipoServicio[6]==$producto->grupo){
                                        $act_menu6='active';
                                        $act_tabmenu6='in active';
                                    }
                                    ?>
                                    <div class="modal-body">
                                        <ul class="nav nav-tabs">
                                            <li class="<?php echo $act_menu0;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[0]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','0')">{{$tipoServicio[0]}}</a></li>
                                            <li class="<?php echo $act_menu1;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[1]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','1')">{{$tipoServicio[1]}}</a></li>
                                            <li class="<?php echo $act_menu2;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[2]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','2')">{{$tipoServicio[2]}}</a></li>
                                            <li class="<?php echo $act_menu3;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[3]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','3')">{{$tipoServicio[3]}}</a></li>
                                            <li class="<?php echo $act_menu4;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[4]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','4')">{{$tipoServicio[4]}}</a></li>
                                            <li class="<?php echo $act_menu5;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[5]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','5')">{{$tipoServicio[5]}}</a></li>
                                            <li class="<?php echo $act_menu6;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[6]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','6')">{{$tipoServicio[6]}}</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="e_{{$tipoServicio[0]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu0;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_0" name="txt_localizacion_0" placeholder="Location" value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_0" id="tipoServicio_0" value="{{$tipoServicio[0]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                <option value="2 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_0" name="txt_provider_0" placeholder="Provider" value="<?php if($tipoServicio[0]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_0" name="txt_product_0" placeholder="Product"  value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_0" name="txt_code_0" placeholder="Code product"  value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_0" name="txt_price_0" placeholder="Price"  value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[1]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu1;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_1" name="txt_localizacion_1" placeholder="Location" value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_1" id="tipoServicio_1" value="{{$tipoServicio[1]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_1" name="txt_type_1">
                                                                <option value="GROUP" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='GROUP') echo 'selected';}?>>GROUP</option>
                                                                <option value="PRIVATE" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='PRIVATE') echo 'selected';}?>>PRIVATE</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_1" name="txt_provider_1" placeholder="Provider" value="<?php if($tipoServicio[1]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_1" name="txt_product_1" placeholder="Product"  value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_1" name="txt_code_1" placeholder="Code product"  value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_1" name="txt_price_1" placeholder="Price"  value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[2]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu2;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_2" name="txt_localizacion_2" placeholder="Location" value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_2" id="tipoServicio_2" value="{{$tipoServicio[2]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_2" name="txt_type_2">
                                                                <option value="2 STARS" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_2" name="txt_provider_2" placeholder="Provider" value="<?php if($tipoServicio[2]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_2" name="txt_product_2" placeholder="Product"  value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_2" name="txt_code_2" placeholder="Code product"  value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_2" name="txt_price_2" placeholder="Price"  value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[3]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu3;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_3" name="txt_localizacion_3" placeholder="Location" value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_3" id="tipoServicio_3" value="{{$tipoServicio[3]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_3" name="txt_type_3">
                                                                <option value="2 STARS" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_3" name="txt_provider_3" placeholder="Provider" value="<?php if($tipoServicio[3]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_3" name="txt_product_3" placeholder="Product"  value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_3" name="txt_code_3" placeholder="Code product"  value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_3" name="txt_price_3" placeholder="Price"  value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[4]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu4;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_4" name="txt_localizacion_4" placeholder="Location" value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_4" id="tipoServicio_4" value="{{$tipoServicio[4]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_4" name="txt_type_4">
                                                                <option value="2 STARS" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_4" name="txt_provider_4" placeholder="Provider" value="<?php if($tipoServicio[4]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_4" name="txt_product_4" placeholder="Product"  value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_4" name="txt_code_4" placeholder="Code product"  value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_4" name="txt_price_4" placeholder="Price"  value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[5]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu5;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_5" name="txt_localizacion_5" placeholder="Location" value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_5" id="tipoServicio_5" value="{{$tipoServicio[5]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_5" name="txt_type_5">
                                                                <option value="2 STARS" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_5" name="txt_provider_5" placeholder="Provider" value="<?php if($tipoServicio[5]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_5" name="txt_product_5" placeholder="Product"  value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_5" name="txt_code_5" placeholder="Code product"  value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_5" name="txt_price_5" placeholder="Price"  value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[6]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu6;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_6" name="txt_localizacion_6" placeholder="Location" value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_6" id="tipoServicio_6" value="{{$tipoServicio[6]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_6" name="txt_type_6">
                                                                <option value="2 STARS" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_6" name="txt_provider_6" placeholder="Provider" value="<?php if($tipoServicio[6]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_6" name="txt_product_6" placeholder="Product"  value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_6" name="txt_code_6" placeholder="Code product"  value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_6" name="txt_price_6" placeholder="Price"  value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->precio_costo;?>">
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
                @endforeach
            @endforeach

            @foreach($productos_transp as $proveedor)
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
                                    <?php
                                    $act_menu0='hide';
                                    $act_menu1='hide';
                                    $act_menu2='hide';
                                    $act_menu3='hide';
                                    $act_menu4='hide';
                                    $act_menu5='hide';
                                    $act_menu6='hide';

                                    $act_tabmenu0='';
                                    $act_tabmenu1='';
                                    $act_tabmenu2='';
                                    $act_tabmenu3='';
                                    $act_tabmenu4='';
                                    $act_tabmenu5='';
                                    $act_tabmenu6='';

                                    if($tipoServicio[0]==$producto->grupo){
                                        $act_menu0='active';
                                        $act_tabmenu0='in active';
                                    }
                                    if($tipoServicio[1]==$producto->grupo){
                                        $act_menu1='active';
                                        $act_tabmenu1='in active';
                                    }
                                    if($tipoServicio[2]==$producto->grupo){
                                        $act_menu2='active';
                                        $act_tabmenu2='in active';
                                    }
                                    if($tipoServicio[3]==$producto->grupo){
                                        $act_menu3='active';
                                        $act_tabmenu3='in active';
                                    }
                                    if($tipoServicio[4]==$producto->grupo){
                                        $act_menu4='active';
                                        $act_tabmenu4='in active';
                                    }
                                    if($tipoServicio[5]==$producto->grupo){
                                        $act_menu5='active';
                                        $act_tabmenu5='in active';
                                    }
                                    if($tipoServicio[6]==$producto->grupo){
                                        $act_menu6='active';
                                        $act_tabmenu6='in active';
                                    }
                                    ?>
                                    <div class="modal-body">
                                        <ul class="nav nav-tabs">
                                            <li class="<?php echo $act_menu0;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[0]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','0')">{{$tipoServicio[0]}}</a></li>
                                            <li class="<?php echo $act_menu1;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[1]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','1')">{{$tipoServicio[1]}}</a></li>
                                            <li class="<?php echo $act_menu2;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[2]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','2')">{{$tipoServicio[2]}}</a></li>
                                            <li class="<?php echo $act_menu3;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[3]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','3')">{{$tipoServicio[3]}}</a></li>
                                            <li class="<?php echo $act_menu4;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[4]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','4')">{{$tipoServicio[4]}}</a></li>
                                            <li class="<?php echo $act_menu5;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[5]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','5')">{{$tipoServicio[5]}}</a></li>
                                            <li class="<?php echo $act_menu6;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[6]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','6')">{{$tipoServicio[6]}}</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="e_{{$tipoServicio[0]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu0;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_0" name="txt_localizacion_0" placeholder="Location" value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_0" id="tipoServicio_0" value="{{$tipoServicio[0]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                <option value="2 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_0" name="txt_provider_0" placeholder="Provider" value="<?php if($tipoServicio[0]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_0" name="txt_product_0" placeholder="Product"  value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_0" name="txt_code_0" placeholder="Code product"  value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_0" name="txt_price_0" placeholder="Price"  value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[1]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu1;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_1" name="txt_localizacion_1" placeholder="Location" value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_1" id="tipoServicio_1" value="{{$tipoServicio[1]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_1" name="txt_type_1">
                                                                <option value="2 STARS" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_1" name="txt_provider_1" placeholder="Provider" value="<?php if($tipoServicio[1]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_1" name="txt_product_1" placeholder="Product"  value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_1" name="txt_code_1" placeholder="Code product"  value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_1" name="txt_price_1" placeholder="Price"  value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[2]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu2;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_2" name="txt_localizacion_2" placeholder="Location" value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_2" id="tipoServicio_2" value="{{$tipoServicio[2]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_2" name="txt_type_2">
                                                                <option value="AUTO" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='AUTO') echo 'selected';}?>>AUTO</option>
                                                                <option value="VAN" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='VAN') echo 'selected';}?>>VAN</option>
                                                                <option value="SPRINTER" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='SPRINTER') echo 'selected';}?>>SPRINTER</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_2" name="txt_provider_2" placeholder="Provider" value="<?php if($tipoServicio[2]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_2" name="txt_product_2" placeholder="Product"  value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_2" name="txt_code_2" placeholder="Code product"  value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_2" name="txt_price_2" placeholder="Price"  value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[3]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu3;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_3" name="txt_localizacion_3" placeholder="Location" value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_3" id="tipoServicio_3" value="{{$tipoServicio[3]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_3" name="txt_type_3">
                                                                <option value="2 STARS" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_3" name="txt_provider_3" placeholder="Provider" value="<?php if($tipoServicio[3]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_3" name="txt_product_3" placeholder="Product"  value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_3" name="txt_code_3" placeholder="Code product"  value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_3" name="txt_price_3" placeholder="Price"  value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[4]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu4;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_4" name="txt_localizacion_4" placeholder="Location" value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_4" id="tipoServicio_4" value="{{$tipoServicio[4]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_4" name="txt_type_4">
                                                                <option value="2 STARS" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_4" name="txt_provider_4" placeholder="Provider" value="<?php if($tipoServicio[4]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_4" name="txt_product_4" placeholder="Product"  value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_4" name="txt_code_4" placeholder="Code product"  value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_4" name="txt_price_4" placeholder="Price"  value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[5]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu5;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_5" name="txt_localizacion_5" placeholder="Location" value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_5" id="tipoServicio_5" value="{{$tipoServicio[5]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_5" name="txt_type_5">
                                                                <option value="2 STARS" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_5" name="txt_provider_5" placeholder="Provider" value="<?php if($tipoServicio[5]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_5" name="txt_product_5" placeholder="Product"  value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_5" name="txt_code_5" placeholder="Code product"  value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_5" name="txt_price_5" placeholder="Price"  value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[6]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu6;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_6" name="txt_localizacion_6" placeholder="Location" value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_6" id="tipoServicio_6" value="{{$tipoServicio[6]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_6" name="txt_type_6">
                                                                <option value="2 STARS" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_6" name="txt_provider_6" placeholder="Provider" value="<?php if($tipoServicio[6]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_6" name="txt_product_6" placeholder="Product"  value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_6" name="txt_code_6" placeholder="Code product"  value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_6" name="txt_price_6" placeholder="Price"  value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->precio_costo;?>">
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
                @endforeach
            @endforeach

            @foreach($productos_guides as $proveedor)
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
                                    <?php
                                    $act_menu0='hide';
                                    $act_menu1='hide';
                                    $act_menu2='hide';
                                    $act_menu3='hide';
                                    $act_menu4='hide';
                                    $act_menu5='hide';
                                    $act_menu6='hide';

                                    $act_tabmenu0='';
                                    $act_tabmenu1='';
                                    $act_tabmenu2='';
                                    $act_tabmenu3='';
                                    $act_tabmenu4='';
                                    $act_tabmenu5='';
                                    $act_tabmenu6='';

                                    if($tipoServicio[0]==$producto->grupo){
                                        $act_menu0='active';
                                        $act_tabmenu0='in active';
                                    }
                                    if($tipoServicio[1]==$producto->grupo){
                                        $act_menu1='active';
                                        $act_tabmenu1='in active';
                                    }
                                    if($tipoServicio[2]==$producto->grupo){
                                        $act_menu2='active';
                                        $act_tabmenu2='in active';
                                    }
                                    if($tipoServicio[3]==$producto->grupo){
                                        $act_menu3='active';
                                        $act_tabmenu3='in active';
                                    }
                                    if($tipoServicio[4]==$producto->grupo){
                                        $act_menu4='active';
                                        $act_tabmenu4='in active';
                                    }
                                    if($tipoServicio[5]==$producto->grupo){
                                        $act_menu5='active';
                                        $act_tabmenu5='in active';
                                    }
                                    if($tipoServicio[6]==$producto->grupo){
                                        $act_menu6='active';
                                        $act_tabmenu6='in active';
                                    }
                                    ?>
                                    <div class="modal-body">
                                        <ul class="nav nav-tabs">
                                            <li class="<?php echo $act_menu0;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[0]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','0')">{{$tipoServicio[0]}}</a></li>
                                            <li class="<?php echo $act_menu1;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[1]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','1')">{{$tipoServicio[1]}}</a></li>
                                            <li class="<?php echo $act_menu2;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[2]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','2')">{{$tipoServicio[2]}}</a></li>
                                            <li class="<?php echo $act_menu3;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[3]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','3')">{{$tipoServicio[3]}}</a></li>
                                            <li class="<?php echo $act_menu4;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[4]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','4')">{{$tipoServicio[4]}}</a></li>
                                            <li class="<?php echo $act_menu5;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[5]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','5')">{{$tipoServicio[5]}}</a></li>
                                            <li class="<?php echo $act_menu6;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[6]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','6')">{{$tipoServicio[6]}}</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="e_{{$tipoServicio[0]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu0;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_0" name="txt_localizacion_0" placeholder="Location" value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_0" id="tipoServicio_0" value="{{$tipoServicio[0]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                <option value="2 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_0" name="txt_provider_0" placeholder="Provider" value="<?php if($tipoServicio[0]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_0" name="txt_product_0" placeholder="Product"  value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_0" name="txt_code_0" placeholder="Code product"  value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_0" name="txt_price_0" placeholder="Price"  value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[1]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu1;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_1" name="txt_localizacion_1" placeholder="Location" value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_1" id="tipoServicio_1" value="{{$tipoServicio[1]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_1" name="txt_type_1">
                                                                <option value="2 STARS" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_1" name="txt_provider_1" placeholder="Provider" value="<?php if($tipoServicio[1]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_1" name="txt_product_1" placeholder="Product"  value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_1" name="txt_code_1" placeholder="Code product"  value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_1" name="txt_price_1" placeholder="Price"  value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[2]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu2;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_2" name="txt_localizacion_2" placeholder="Location" value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_2" id="tipoServicio_2" value="{{$tipoServicio[2]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_2" name="txt_type_2">
                                                                <option value="2 STARS" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_2" name="txt_provider_2" placeholder="Provider" value="<?php if($tipoServicio[2]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_2" name="txt_product_2" placeholder="Product"  value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_2" name="txt_code_2" placeholder="Code product"  value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_2" name="txt_price_2" placeholder="Price"  value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[3]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu3;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_3" name="txt_localizacion_3" placeholder="Location" value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_3" id="tipoServicio_3" value="{{$tipoServicio[3]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_3" name="txt_type_3">
                                                                <option value="GUIDE" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='GUIDE') echo 'selected';}?>>GUIDE</option>
                                                                <option value="TRANSFER" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='TRANSFER') echo 'selected';}?>>TRANSFER</option>
                                                                <option value="ASSISTANCE" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='ASSISTANCE') echo 'selected';}?>>ASSISTANCE</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_3" name="txt_provider_3" placeholder="Provider" value="<?php if($tipoServicio[3]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_3" name="txt_product_3" placeholder="Product"  value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_3" name="txt_code_3" placeholder="Code product"  value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_3" name="txt_price_3" placeholder="Price"  value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[4]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu4;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_4" name="txt_localizacion_4" placeholder="Location" value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_4" id="tipoServicio_4" value="{{$tipoServicio[4]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_4" name="txt_type_4">
                                                                <option value="2 STARS" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_4" name="txt_provider_4" placeholder="Provider" value="<?php if($tipoServicio[4]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_4" name="txt_product_4" placeholder="Product"  value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_4" name="txt_code_4" placeholder="Code product"  value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_4" name="txt_price_4" placeholder="Price"  value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[5]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu5;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_5" name="txt_localizacion_5" placeholder="Location" value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_5" id="tipoServicio_5" value="{{$tipoServicio[5]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_5" name="txt_type_5">
                                                                <option value="2 STARS" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_5" name="txt_provider_5" placeholder="Provider" value="<?php if($tipoServicio[5]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_5" name="txt_product_5" placeholder="Product"  value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_5" name="txt_code_5" placeholder="Code product"  value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_5" name="txt_price_5" placeholder="Price"  value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[6]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu6;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_6" name="txt_localizacion_6" placeholder="Location" value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_6" id="tipoServicio_6" value="{{$tipoServicio[6]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_6" name="txt_type_6">
                                                                <option value="2 STARS" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_6" name="txt_provider_6" placeholder="Provider" value="<?php if($tipoServicio[6]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_6" name="txt_product_6" placeholder="Product"  value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_6" name="txt_code_6" placeholder="Code product"  value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_6" name="txt_price_6" placeholder="Price"  value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->precio_costo;?>">
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
                @endforeach
            @endforeach

            @foreach($productos_entrances as $proveedor)
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
                                    <?php
                                    $act_menu0='hide';
                                    $act_menu1='hide';
                                    $act_menu2='hide';
                                    $act_menu3='hide';
                                    $act_menu4='hide';
                                    $act_menu5='hide';
                                    $act_menu6='hide';

                                    $act_tabmenu0='';
                                    $act_tabmenu1='';
                                    $act_tabmenu2='';
                                    $act_tabmenu3='';
                                    $act_tabmenu4='';
                                    $act_tabmenu5='';
                                    $act_tabmenu6='';

                                    if($tipoServicio[0]==$producto->grupo){
                                        $act_menu0='active';
                                        $act_tabmenu0='in active';
                                    }
                                    if($tipoServicio[1]==$producto->grupo){
                                        $act_menu1='active';
                                        $act_tabmenu1='in active';
                                    }
                                    if($tipoServicio[2]==$producto->grupo){
                                        $act_menu2='active';
                                        $act_tabmenu2='in active';
                                    }
                                    if($tipoServicio[3]==$producto->grupo){
                                        $act_menu3='active';
                                        $act_tabmenu3='in active';
                                    }
                                    if($tipoServicio[4]==$producto->grupo){
                                        $act_menu4='active';
                                        $act_tabmenu4='in active';
                                    }
                                    if($tipoServicio[5]==$producto->grupo){
                                        $act_menu5='active';
                                        $act_tabmenu5='in active';
                                    }
                                    if($tipoServicio[6]==$producto->grupo){
                                        $act_menu6='active';
                                        $act_tabmenu6='in active';
                                    }
                                    ?>
                                    <div class="modal-body">
                                        <ul class="nav nav-tabs">
                                            <li class="<?php echo $act_menu0;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[0]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','0')">{{$tipoServicio[0]}}</a></li>
                                            <li class="<?php echo $act_menu1;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[1]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','1')">{{$tipoServicio[1]}}</a></li>
                                            <li class="<?php echo $act_menu2;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[2]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','2')">{{$tipoServicio[2]}}</a></li>
                                            <li class="<?php echo $act_menu3;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[3]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','3')">{{$tipoServicio[3]}}</a></li>
                                            <li class="<?php echo $act_menu4;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[4]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','4')">{{$tipoServicio[4]}}</a></li>
                                            <li class="<?php echo $act_menu5;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[5]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','5')">{{$tipoServicio[5]}}</a></li>
                                            <li class="<?php echo $act_menu6;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[6]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','6')">{{$tipoServicio[6]}}</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="e_{{$tipoServicio[0]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu0;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_0" name="txt_localizacion_0" placeholder="Location" value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_0" id="tipoServicio_0" value="{{$tipoServicio[0]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                <option value="2 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_0" name="txt_provider_0" placeholder="Provider" value="<?php if($tipoServicio[0]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_0" name="txt_product_0" placeholder="Product"  value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_0" name="txt_code_0" placeholder="Code product"  value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_0" name="txt_price_0" placeholder="Price"  value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[1]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu1;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_1" name="txt_localizacion_1" placeholder="Location" value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_1" id="tipoServicio_1" value="{{$tipoServicio[1]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_1" name="txt_type_1">
                                                                <option value="2 STARS" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_1" name="txt_provider_1" placeholder="Provider" value="<?php if($tipoServicio[1]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_1" name="txt_product_1" placeholder="Product"  value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_1" name="txt_code_1" placeholder="Code product"  value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_1" name="txt_price_1" placeholder="Price"  value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[2]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu2;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_2" name="txt_localizacion_2" placeholder="Location" value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_2" id="tipoServicio_2" value="{{$tipoServicio[2]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_2" name="txt_type_2">
                                                                <option value="2 STARS" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_2" name="txt_provider_2" placeholder="Provider" value="<?php if($tipoServicio[2]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_2" name="txt_product_2" placeholder="Product"  value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_2" name="txt_code_2" placeholder="Code product"  value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_2" name="txt_price_2" placeholder="Price"  value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[3]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu3;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_3" name="txt_localizacion_3" placeholder="Location" value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_3" id="tipoServicio_3" value="{{$tipoServicio[3]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_3" name="txt_type_3">
                                                                <option value="2 STARS" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_3" name="txt_provider_3" placeholder="Provider" value="<?php if($tipoServicio[3]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_3" name="txt_product_3" placeholder="Product"  value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_3" name="txt_code_3" placeholder="Code product"  value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_3" name="txt_price_3" placeholder="Price"  value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[4]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu4;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_4" name="txt_localizacion_4" placeholder="Location" value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_4" id="tipoServicio_4" value="{{$tipoServicio[4]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_4" name="txt_type_4">
                                                                <option value="EXTRANJERO" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='EXTRANJERO') echo 'selected';}?>>EXTRANJERO</option>
                                                                <option value="NATIONAL" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='NATIONAL') echo 'selected';}?>>NATIONAL</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_4" name="txt_provider_4" placeholder="Provider" value="<?php if($tipoServicio[4]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_4" name="txt_product_4" placeholder="Product"  value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_4" name="txt_code_4" placeholder="Code product"  value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_4" name="txt_price_4" placeholder="Price"  value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[5]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu5;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_5" name="txt_localizacion_5" placeholder="Location" value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_5" id="tipoServicio_5" value="{{$tipoServicio[5]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_5" name="txt_type_5">
                                                                <option value="2 STARS" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_5" name="txt_provider_5" placeholder="Provider" value="<?php if($tipoServicio[5]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_5" name="txt_product_5" placeholder="Product"  value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_5" name="txt_code_5" placeholder="Code product"  value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_5" name="txt_price_5" placeholder="Price"  value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[6]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu6;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_6" name="txt_localizacion_6" placeholder="Location" value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_6" id="tipoServicio_6" value="{{$tipoServicio[6]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_6" name="txt_type_6">
                                                                <option value="2 STARS" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_6" name="txt_provider_6" placeholder="Provider" value="<?php if($tipoServicio[6]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_6" name="txt_product_6" placeholder="Product"  value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_6" name="txt_code_6" placeholder="Code product"  value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_6" name="txt_price_6" placeholder="Price"  value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->precio_costo;?>">
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
                @endforeach
            @endforeach

            @foreach($productos_food as $proveedor)
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
                                    <?php
                                    $act_menu0='hide';
                                    $act_menu1='hide';
                                    $act_menu2='hide';
                                    $act_menu3='hide';
                                    $act_menu4='hide';
                                    $act_menu5='hide';
                                    $act_menu6='hide';

                                    $act_tabmenu0='';
                                    $act_tabmenu1='';
                                    $act_tabmenu2='';
                                    $act_tabmenu3='';
                                    $act_tabmenu4='';
                                    $act_tabmenu5='';
                                    $act_tabmenu6='';

                                    if($tipoServicio[0]==$producto->grupo){
                                        $act_menu0='active';
                                        $act_tabmenu0='in active';
                                    }
                                    if($tipoServicio[1]==$producto->grupo){
                                        $act_menu1='active';
                                        $act_tabmenu1='in active';
                                    }
                                    if($tipoServicio[2]==$producto->grupo){
                                        $act_menu2='active';
                                        $act_tabmenu2='in active';
                                    }
                                    if($tipoServicio[3]==$producto->grupo){
                                        $act_menu3='active';
                                        $act_tabmenu3='in active';
                                    }
                                    if($tipoServicio[4]==$producto->grupo){
                                        $act_menu4='active';
                                        $act_tabmenu4='in active';
                                    }
                                    if($tipoServicio[5]==$producto->grupo){
                                        $act_menu5='active';
                                        $act_tabmenu5='in active';
                                    }
                                    if($tipoServicio[6]==$producto->grupo){
                                        $act_menu6='active';
                                        $act_tabmenu6='in active';
                                    }
                                    ?>
                                    <div class="modal-body">
                                        <ul class="nav nav-tabs">
                                            <li class="<?php echo $act_menu0;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[0]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','0')">{{$tipoServicio[0]}}</a></li>
                                            <li class="<?php echo $act_menu1;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[1]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','1')">{{$tipoServicio[1]}}</a></li>
                                            <li class="<?php echo $act_menu2;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[2]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','2')">{{$tipoServicio[2]}}</a></li>
                                            <li class="<?php echo $act_menu3;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[3]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','3')">{{$tipoServicio[3]}}</a></li>
                                            <li class="<?php echo $act_menu4;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[4]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','4')">{{$tipoServicio[4]}}</a></li>
                                            <li class="<?php echo $act_menu5;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[5]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','5')">{{$tipoServicio[5]}}</a></li>
                                            <li class="<?php echo $act_menu6;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[6]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','6')">{{$tipoServicio[6]}}</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="e_{{$tipoServicio[0]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu0;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_0" name="txt_localizacion_0" placeholder="Location" value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_0" id="tipoServicio_0" value="{{$tipoServicio[0]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                <option value="2 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_0" name="txt_provider_0" placeholder="Provider" value="<?php if($tipoServicio[0]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_0" name="txt_product_0" placeholder="Product"  value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_0" name="txt_code_0" placeholder="Code product"  value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_0" name="txt_price_0" placeholder="Price"  value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[1]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu1;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_1" name="txt_localizacion_1" placeholder="Location" value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_1" id="tipoServicio_1" value="{{$tipoServicio[1]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_1" name="txt_type_1">
                                                                <option value="2 STARS" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_1" name="txt_provider_1" placeholder="Provider" value="<?php if($tipoServicio[1]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_1" name="txt_product_1" placeholder="Product"  value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_1" name="txt_code_1" placeholder="Code product"  value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_1" name="txt_price_1" placeholder="Price"  value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[2]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu2;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_2" name="txt_localizacion_2" placeholder="Location" value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_2" id="tipoServicio_2" value="{{$tipoServicio[2]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_2" name="txt_type_2">
                                                                <option value="2 STARS" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_2" name="txt_provider_2" placeholder="Provider" value="<?php if($tipoServicio[2]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_2" name="txt_product_2" placeholder="Product"  value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_2" name="txt_code_2" placeholder="Code product"  value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_2" name="txt_price_2" placeholder="Price"  value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[3]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu3;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_3" name="txt_localizacion_3" placeholder="Location" value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_3" id="tipoServicio_3" value="{{$tipoServicio[3]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_3" name="txt_type_3">
                                                                <option value="2 STARS" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_3" name="txt_provider_3" placeholder="Provider" value="<?php if($tipoServicio[3]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_3" name="txt_product_3" placeholder="Product"  value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_3" name="txt_code_3" placeholder="Code product"  value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_3" name="txt_price_3" placeholder="Price"  value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[4]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu4;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_4" name="txt_localizacion_4" placeholder="Location" value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_4" id="tipoServicio_4" value="{{$tipoServicio[4]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_4" name="txt_type_4">
                                                                <option value="2 STARS" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_4" name="txt_provider_4" placeholder="Provider" value="<?php if($tipoServicio[4]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_4" name="txt_product_4" placeholder="Product"  value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_4" name="txt_code_4" placeholder="Code product"  value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_4" name="txt_price_4" placeholder="Price"  value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[5]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu5;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_5" name="txt_localizacion_5" placeholder="Location" value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_5" id="tipoServicio_5" value="{{$tipoServicio[5]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_5" name="txt_type_5">
                                                                <option value="LUNCH" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='LUNCH') echo 'selected';}?>>LUNCH</option>
                                                                <option value="DINNER" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='DINNER') echo 'selected';}?>>DINNER</option>
                                                                <option value="BOX LUNCH" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='BOX LUNCH') echo 'selected';}?>>BOX LUNCH</option></select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_5" name="txt_provider_5" placeholder="Provider" value="<?php if($tipoServicio[5]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_5" name="txt_product_5" placeholder="Product"  value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_5" name="txt_code_5" placeholder="Code product"  value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_5" name="txt_price_5" placeholder="Price"  value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[6]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu6;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_6" name="txt_localizacion_6" placeholder="Location" value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_6" id="tipoServicio_6" value="{{$tipoServicio[6]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_6" name="txt_type_6">
                                                                <option value="2 STARS" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_6" name="txt_provider_6" placeholder="Provider" value="<?php if($tipoServicio[6]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_6" name="txt_product_6" placeholder="Product"  value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_6" name="txt_code_6" placeholder="Code product"  value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_6" name="txt_price_6" placeholder="Price"  value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->precio_costo;?>">
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
                @endforeach
            @endforeach

            @foreach($productos_others as $proveedor)
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
                                    <?php
                                    $act_menu0='hide';
                                    $act_menu1='hide';
                                    $act_menu2='hide';
                                    $act_menu3='hide';
                                    $act_menu4='hide';
                                    $act_menu5='hide';
                                    $act_menu6='hide';

                                    $act_tabmenu0='';
                                    $act_tabmenu1='';
                                    $act_tabmenu2='';
                                    $act_tabmenu3='';
                                    $act_tabmenu4='';
                                    $act_tabmenu5='';
                                    $act_tabmenu6='';

                                    if($tipoServicio[0]==$producto->grupo){
                                        $act_menu0='active';
                                        $act_tabmenu0='in active';
                                    }
                                    if($tipoServicio[1]==$producto->grupo){
                                        $act_menu1='active';
                                        $act_tabmenu1='in active';
                                    }
                                    if($tipoServicio[2]==$producto->grupo){
                                        $act_menu2='active';
                                        $act_tabmenu2='in active';
                                    }
                                    if($tipoServicio[3]==$producto->grupo){
                                        $act_menu3='active';
                                        $act_tabmenu3='in active';
                                    }
                                    if($tipoServicio[4]==$producto->grupo){
                                        $act_menu4='active';
                                        $act_tabmenu4='in active';
                                    }
                                    if($tipoServicio[5]==$producto->grupo){
                                        $act_menu5='active';
                                        $act_tabmenu5='in active';
                                    }
                                    if($tipoServicio[6]==$producto->grupo){
                                        $act_menu6='active';
                                        $act_tabmenu6='in active';
                                    }
                                    ?>
                                    <div class="modal-body">
                                        <ul class="nav nav-tabs">
                                            <li class="<?php echo $act_menu0;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[0]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','0')">{{$tipoServicio[0]}}</a></li>
                                            <li class="<?php echo $act_menu1;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[1]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','1')">{{$tipoServicio[1]}}</a></li>
                                            <li class="<?php echo $act_menu2;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[2]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','2')">{{$tipoServicio[2]}}</a></li>
                                            <li class="<?php echo $act_menu3;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[3]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','3')">{{$tipoServicio[3]}}</a></li>
                                            <li class="<?php echo $act_menu4;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[4]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','4')">{{$tipoServicio[4]}}</a></li>
                                            <li class="<?php echo $act_menu5;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[5]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','5')">{{$tipoServicio[5]}}</a></li>
                                            <li class="<?php echo $act_menu6;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[6]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','6')">{{$tipoServicio[6]}}</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="e_{{$tipoServicio[0]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu0;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_0" name="txt_localizacion_0" placeholder="Location" value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_0" id="tipoServicio_0" value="{{$tipoServicio[0]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                <option value="2 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_0" name="txt_provider_0" placeholder="Provider" value="<?php if($tipoServicio[0]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_0" name="txt_product_0" placeholder="Product"  value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_0" name="txt_code_0" placeholder="Code product"  value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_0" name="txt_price_0" placeholder="Price"  value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[1]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu1;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_1" name="txt_localizacion_1" placeholder="Location" value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_1" id="tipoServicio_1" value="{{$tipoServicio[1]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_1" name="txt_type_1">
                                                                <option value="2 STARS" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[1]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_1" name="txt_provider_1" placeholder="Provider" value="<?php if($tipoServicio[1]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_1" name="txt_product_1" placeholder="Product"  value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_1" name="txt_code_1" placeholder="Code product"  value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_1" name="txt_price_1" placeholder="Price"  value="<?php if($tipoServicio[1]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[2]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu2;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_2" name="txt_localizacion_2" placeholder="Location" value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_2" id="tipoServicio_2" value="{{$tipoServicio[2]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_2" name="txt_type_2">
                                                                <option value="2 STARS" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_2" name="txt_provider_2" placeholder="Provider" value="<?php if($tipoServicio[2]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_2" name="txt_product_2" placeholder="Product"  value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_2" name="txt_code_2" placeholder="Code product"  value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_2" name="txt_price_2" placeholder="Price"  value="<?php if($tipoServicio[2]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[3]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu3;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_3" name="txt_localizacion_3" placeholder="Location" value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_3" id="tipoServicio_3" value="{{$tipoServicio[3]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_3" name="txt_type_3">
                                                                <option value="2 STARS" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_3" name="txt_provider_3" placeholder="Provider" value="<?php if($tipoServicio[3]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_3" name="txt_product_3" placeholder="Product"  value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_3" name="txt_code_3" placeholder="Code product"  value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_3" name="txt_price_3" placeholder="Price"  value="<?php if($tipoServicio[3]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[4]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu4;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_4" name="txt_localizacion_4" placeholder="Location" value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_4" id="tipoServicio_4" value="{{$tipoServicio[4]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_4" name="txt_type_4">
                                                                <option value="2 STARS" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[4]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_4" name="txt_provider_4" placeholder="Provider" value="<?php if($tipoServicio[4]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_4" name="txt_product_4" placeholder="Product"  value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_4" name="txt_code_4" placeholder="Code product"  value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_4" name="txt_price_4" placeholder="Price"  value="<?php if($tipoServicio[4]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[5]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu5;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_5" name="txt_localizacion_5" placeholder="Location" value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_5" id="tipoServicio_5" value="{{$tipoServicio[5]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                            <select class="form-control" id="txt_type_5" name="txt_type_5">
                                                                <option value="2 STARS" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='2 STARS') echo 'selected';}?>>2 STARS</option>
                                                                <option value="3 STARS" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='3 STARS') echo 'selected';}?>>3 STARS</option>
                                                                <option value="4 STARS" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='4 STARS') echo 'selected';}?>>4 STARS</option>
                                                                <option value="5 STARS" <?php if($tipoServicio[5]==$producto->grupo){if($producto->tipo_producto=='5 STARS') echo 'selected';}?>>5 STARS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_5" name="txt_provider_5" placeholder="Provider" value="<?php if($tipoServicio[5]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_5" name="txt_product_5" placeholder="Product"  value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_5" name="txt_code_5" placeholder="Code product"  value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_5" name="txt_price_5" placeholder="Price"  value="<?php if($tipoServicio[5]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[6]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu6;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_6" name="txt_localizacion_6" placeholder="Location" value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_6" id="tipoServicio_6" value="{{$tipoServicio[6]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            <input type="text" class="form-control" id="txt_type_6" name="txt_type_6" placeholder="Type"  value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->tipo_producto;?>">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_6" name="txt_provider_6" placeholder="Provider" value="<?php if($tipoServicio[6]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_6" name="txt_product_6" placeholder="Product"  value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_6" name="txt_code_6" placeholder="Code product"  value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_6" name="txt_price_6" placeholder="Price"  value="<?php if($tipoServicio[6]==$producto->grupo) echo $producto->precio_costo;?>">
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
                @endforeach
            @endforeach
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#tb_HOTELS').DataTable();
            $('#tb_TOURS').DataTable();
            $('#tb_TRANSPORTATION').DataTable();
            $('#tb_GUIDES_ASSIST').DataTable();
            $('#tb_ENTRANCES').DataTable();
            $('#tb_FOOD').DataTable();
            $('#tb_OTHERS').DataTable();
        } );
        $(function () {
            $('#txt_provider_0').autocomplete({
                source: '{{route('buscar_proveedor_path')}}',
                minLength: 1,
                select:function(event,ui){
                    $('#txt_provider_0').val(ui.item.value);
                }
            });
            $('#txt_provider_1').autocomplete({
                source: '{{route('buscar_proveedor_path')}}',
                minLength: 1,
                select:function(event,ui){
                    $('#txt_provider_1').val(ui.item.value);
                }
            });
            $('#txt_provider_2').autocomplete({
                source: '{{route('buscar_proveedor_path')}}',
                minLength: 1,
                select:function(event,ui){
                    $('#txt_provider_2').val(ui.item.value);
                }
            });
            $('#txt_provider_3').autocomplete({
                source: '{{route('buscar_proveedor_path')}}',
                minLength: 1,
                select:function(event,ui){
                    $('#txt_provider_3').val(ui.item.value);
                }
            });
            $('#txt_provider_4').autocomplete({
                source: '{{route('buscar_proveedor_path')}}',
                minLength: 1,
                select:function(event,ui){
                    $('#txt_provider_4').val(ui.item.value);
                }
            });
            $('#txt_provider_5').autocomplete({
                source: '{{route('buscar_proveedor_path')}}',
                minLength: 1,
                select:function(event,ui){
                    $('#txt_provider_5').val(ui.item.value);
                }
            });
            $('#txt_provider_6').autocomplete({
                source: '{{route('buscar_proveedor_path')}}',
                minLength: 1,
                select:function(event,ui){
                    $('#txt_provider_6').val(ui.item.value);
                }
            });
        });
    </script>
@stop