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
                                                        <select class="form-control" id="txt_localizacion_0" name="txt_localizacion_0">
                                                            @foreach($destinations as $destination)
                                                                <option value="{{$destination->destino}}">{{$destination->destino}}</option>
                                                            @endforeach
                                                        </select>

                                                        <input type="hidden" name="tipoServicio_0" id="tipoServicio_0" value="{{$categoria->nombre}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="txt_type">Type</label>
                                                        {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}

                                                        @if($categoria->nombre=='HOTELS')
                                                            <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                <option value="2 STARS">2 STARS</option>
                                                                <option value="3 STARS">3 STARS</option>
                                                                <option value="4 STARS">4 STARS</option>
                                                                <option value="5 STARS">5 STARS</option>
                                                            </select>
                                                        @endif
                                                        @if($categoria->nombre=='TOURS')
                                                            <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                <option value="GROUP">GROUP</option>
                                                                <option value="PRIVATE">PRIVATE</option>
                                                            </select>
                                                        @endif
                                                        @if($categoria->nombre=='MOVILID')
                                                            <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                <option value="AUTO">AUTO</option>
                                                                <option value="SUBARU">SUBARU</option>
                                                                <option value="VAN">VAN</option>
                                                                <option value="H1">H1</option>
                                                                <option value="SPRINTER">SPRINTER</option>
                                                            </select>
                                                        @endif
                                                        @if($categoria->nombre=='REPRESENT')
                                                            <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                <option value="GUIDE">GUIDE</option>
                                                                <option value="TRANSFER">TRANSFER</option>
                                                                <option value="ASSISTANCE">ASSISTANCE</option>
                                                            </select>
                                                        @endif
                                                        @if($categoria->nombre=='ENTRANCES')
                                                            <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                <option value="EXTRANJERO">EXTRANJERO</option>
                                                                <option value="NATIONAL">NATIONAL</option>
                                                            </select>
                                                        @endif
                                                        @if($categoria->nombre=='FOOD')
                                                            <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                <option value="LUNCH">LUNCH</option>
                                                                <option value="DINNER">DINNER</option>
                                                                <option value="BOX LUNCH">BOX LUNCH</option>
                                                            </select>
                                                        @endif
                                                        @if($categoria->nombre=='TRAINS')
                                                            <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                <option value="EXPEDITION">EXPEDITION</option>
                                                                <option value="VISITADOME">VISITADOME</option>
                                                                <option value="HIRAN BINGHAN">BOX LUNCH</option>
                                                                <option value="EJECUTIVO">EJECUTIVO</option>
                                                                <option value="PRIMERA CLASE">PRIMERA CLASE</option>
                                                            </select>
                                                        @endif
                                                        @if($categoria->nombre=='FLIGHTS')
                                                            <select class="form-control" id="txt_type_0" name="txt_type_0">
                                                                <option value="NATIONAL">NATIONAL</option>
                                                                <option value="INTERNATIONAL">INTERNATIONAL</option>
                                                            </select>
                                                        @endif
                                                        @if($categoria->nombre=='OTHERS')
                                                            <input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">
                                                        @endif

                                                    </div>
                                                </div>
                                                @if($categoria->nombre=='HOTELS')
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="txt_type">Accommodation</label>
                                                        {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                        <select class="form-control" id="txt_acomodacion_0" name="txt_acomodacion_0">
                                                            <option value="S">SIMPLE</option>
                                                            <option value="D">DOBLE</option>
                                                            <option value="M">MATRIMONIAL</option>
                                                            <option value="T">TRIPLE</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                @endif
                                                <div class="col-md-4">
                                                    <div class="form-group col-md-9">
                                                        <label for="txt_precio">Provider</label>
                                                        <input type="text" class="form-control" id="txt_provider_{{$pos0}}" name="txt_provider_0" placeholder="Provider">
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
                                                        <input type="text" class="form-control" id="txt_product_{{$pos0}}" name="txt_product_0" placeholder="Product">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 hide">
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
                                <?php
                                $pos0++;
                                ?>
                                @endforeach

                            </div>
                            {{csrf_field()}}
                            <input type="hidden" name="posTipo" id="posTipo" value="0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
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
                <li><a data-toggle="tab" href="#t_{{$tipoServicio[7]}}" onclick="escojerPos(7)">{{$tipoServicio[7]}}</a></li>
                <li><a data-toggle="tab" href="#t_{{$tipoServicio[8]}}" onclick="escojerPos(8)">{{$tipoServicio[8]}}</a></li>
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
                            @foreach($productos_trains as $proveedor)
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
                <div id="t_{{$tipoServicio[7]}}" class="tab-pane fade">
                    <div class="margin-top-20">
                        <table id="tb_{{$tipoServicio[7]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
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
                            @foreach($productos_travels as $proveedor)
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
                <div id="t_{{$tipoServicio[8]}}" class="tab-pane fade">
                    <div class="margin-top-20">
                        <table id="tb_{{$tipoServicio[8]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
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
                                        $act_menu7='hide';
                                        $act_menu8='hide';

                                        $act_tabmenu0='';
                                        $act_tabmenu1='';
                                        $act_tabmenu2='';
                                        $act_tabmenu3='';
                                        $act_tabmenu4='';
                                        $act_tabmenu5='';
                                        $act_tabmenu6='';
                                        $act_tabmenu7='';
                                        $act_tabmenu8='';
                                        $pos=0;
                                        if($tipoServicio[0]==$producto->grupo){
                                            $act_menu0='active';
                                            $act_tabmenu0='in active';
                                            $pos=0;
                                            }
                                        if($tipoServicio[1]==$producto->grupo){
                                            $act_menu1='active';
                                            $act_tabmenu1='in active';
                                            $pos=1;
                                        }
                                        if($tipoServicio[2]==$producto->grupo){
                                            $act_menu2='active';
                                            $act_tabmenu2='in active';
                                            $pos=2;
                                        }
                                        if($tipoServicio[3]==$producto->grupo){
                                            $act_menu3='active';
                                            $act_tabmenu3='in active';
                                            $pos=3;
                                        }
                                        if($tipoServicio[4]==$producto->grupo){
                                            $act_menu4='active';
                                            $act_tabmenu4='in active';
                                            $pos=4;
                                        }
                                        if($tipoServicio[5]==$producto->grupo){
                                            $act_menu5='active';
                                            $act_tabmenu5='in active';
                                            $pos=5;
                                        }
                                        if($tipoServicio[6]==$producto->grupo){
                                            $act_menu6='active';
                                            $act_tabmenu6='in active';
                                            $pos=6;
                                        }
                                        if($tipoServicio[7]==$producto->grupo){
                                            $act_menu7='active';
                                            $act_tabmenu7='in active';
                                            $pos=7;
                                        }
                                        if($tipoServicio[8]==$producto->grupo){
                                            $act_menu8='active';
                                            $act_tabmenu8='in active';
                                            $pos=8;
                                        }
                                        ?>
                                        <div class="modal-body">
                                            <ul class="nav nav-tabs">
                                                <li class="<?php echo $act_menu0;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[0]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','0')">{{$tipoServicio[0]}}</a></li>
                                              </ul>
                                            <div class="tab-content">
                                                <div id="e_{{$tipoServicio[0]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu0;?>">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_codigo">Location</label>
                                                                <select class="form-control" id="txt_localizacion_0" name="txt_localizacion_0">
                                                                    @foreach($destinations as $destination)
                                                                        <option value="{{$destination->destino}}" <?php if($tipoServicio[0]==$producto->grupo){if($producto->localizacion==$destination->destino) echo 'selected';}?>>{{$destination->destino}}</option>
                                                                    @endforeach
                                                                </select>
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
                                                                <label for="txt_type">Accommodation</label>
                                                                {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                                <select class="form-control" id="txt_acomodacion_0" name="txt_acomodacion_0">
                                                                    <option value="S" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='S') echo 'selected';}?>>SIMPLE</option>
                                                                    <option value="D" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='D') echo 'selected';}?>>DOUBLE</option>
                                                                    <option value="M" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='M') echo 'selected';}?>>MATRIMONIAL</option>
                                                                    <option value="T" <?php if($tipoServicio[0]==$producto->grupo){if($producto->tipo_producto=='T') echo 'selected';}?>>TRIPLE</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_precio">Provider</label>
                                                                <input type="text" class="form-control" id="txt_provider_0_" name="txt_provider_0_" placeholder="Provider" value="<?php if($tipoServicio[0]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_product">Product</label>
                                                                <input type="text" class="form-control" id="txt_product_0_" name="txt_product_0_" placeholder="Product"  value="<?php if($tipoServicio[0]==$producto->grupo) echo $producto->nombre;?>">
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
                                              </div>
                                        </div>
                                        <div class="modal-footer">
                                            {{csrf_field()}}
                                            <input type="hidden" name="posTipoEditcost_{{$producto->id}}" id="posTipoEditcost_{{$producto->id}}" value="{{$pos}}">
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
                                    $act_menu7='hide';
                                    $act_menu8='hide';

                                    $act_tabmenu0='';
                                    $act_tabmenu1='';
                                    $act_tabmenu2='';
                                    $act_tabmenu3='';
                                    $act_tabmenu4='';
                                    $act_tabmenu5='';
                                    $act_tabmenu6='';
                                    $act_tabmenu7='';
                                    $act_tabmenu8='';

                                    $pos=0;
                                    if($tipoServicio[0]==$producto->grupo){
                                        $act_menu0='active';
                                        $act_tabmenu0='in active';
                                        $pos=0;
                                    }
                                    if($tipoServicio[1]==$producto->grupo){
                                        $act_menu1='active';
                                        $act_tabmenu1='in active';
                                        $pos=1;
                                    }
                                    if($tipoServicio[2]==$producto->grupo){
                                        $act_menu2='active';
                                        $act_tabmenu2='in active';
                                        $pos=2;
                                    }
                                    if($tipoServicio[3]==$producto->grupo){
                                        $act_menu3='active';
                                        $act_tabmenu3='in active';
                                        $pos=3;
                                    }
                                    if($tipoServicio[4]==$producto->grupo){
                                        $act_menu4='active';
                                        $act_tabmenu4='in active';
                                        $pos=4;
                                    }
                                    if($tipoServicio[5]==$producto->grupo){
                                        $act_menu5='active';
                                        $act_tabmenu5='in active';
                                        $pos=5;
                                    }
                                    if($tipoServicio[6]==$producto->grupo){
                                        $act_menu6='active';
                                        $act_tabmenu6='in active';
                                        $pos=6;
                                    }
                                    if($tipoServicio[7]==$producto->grupo){
                                        $act_menu7='active';
                                        $act_tabmenu7='in active';
                                        $pos=7;
                                    }
                                    if($tipoServicio[8]==$producto->grupo){
                                        $act_menu8='active';
                                        $act_tabmenu8='in active';
                                        $pos=8;
                                    }
                                    ?>
                                    <div class="modal-body">
                                        <ul class="nav nav-tabs">
                                            <li class="<?php echo $act_menu1;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[1]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','1')">{{$tipoServicio[1]}}</a></li>
                                             </ul>
                                        <div class="tab-content">
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
                                                            <input type="text" class="form-control" id="txt_provider_1_" name="txt_provider_1" placeholder="Provider" value="<?php if($tipoServicio[1]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
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
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        {{csrf_field()}}
                                        <input type="hidden" name="posTipoEditcost_{{$producto->id}}" id="posTipoEditcost_{{$producto->id}}" value="{{$pos}}">
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
                                    $act_menu7='hide';
                                    $act_menu8='hide';

                                    $act_tabmenu0='';
                                    $act_tabmenu1='';
                                    $act_tabmenu2='';
                                    $act_tabmenu3='';
                                    $act_tabmenu4='';
                                    $act_tabmenu5='';
                                    $act_tabmenu6='';
                                    $act_tabmenu7='';
                                    $act_tabmenu8='';

                                    $pos=0;
                                    if($tipoServicio[0]==$producto->grupo){
                                        $act_menu0='active';
                                        $act_tabmenu0='in active';
                                        $pos=0;
                                    }
                                    if($tipoServicio[1]==$producto->grupo){
                                        $act_menu1='active';
                                        $act_tabmenu1='in active';
                                        $pos=1;
                                    }
                                    if($tipoServicio[2]==$producto->grupo){
                                        $act_menu2='active';
                                        $act_tabmenu2='in active';
                                        $pos=2;
                                    }
                                    if($tipoServicio[3]==$producto->grupo){
                                        $act_menu3='active';
                                        $act_tabmenu3='in active';
                                        $pos=3;
                                    }
                                    if($tipoServicio[4]==$producto->grupo){
                                        $act_menu4='active';
                                        $act_tabmenu4='in active';
                                        $pos=4;
                                    }
                                    if($tipoServicio[5]==$producto->grupo){
                                        $act_menu5='active';
                                        $act_tabmenu5='in active';
                                        $pos=5;
                                    }
                                    if($tipoServicio[6]==$producto->grupo){
                                        $act_menu6='active';
                                        $act_tabmenu6='in active';
                                        $pos=6;
                                    }
                                    if($tipoServicio[7]==$producto->grupo){
                                        $act_menu7='active';
                                        $act_tabmenu7='in active';
                                        $pos=7;
                                    }
                                    if($tipoServicio[8]==$producto->grupo){
                                        $act_menu8='active';
                                        $act_tabmenu8='in active';
                                        $pos=8;
                                    }
                                    ?>
                                    <div class="modal-body">
                                        <ul class="nav nav-tabs">
                                            <li class="<?php echo $act_menu2;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[2]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','2')">{{$tipoServicio[2]}}</a></li>
                                        </ul>
                                        <div class="tab-content">
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
                                                                <option value="SUBARU" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='SUBARU') echo 'selected';}?>>SUBARU</option>
                                                                <option value="VAN" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='VAN') echo 'selected';}?>>VAN</option>
                                                                <option value="H1" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='H1') echo 'selected';}?>>H1</option>
                                                                <option value="SPRINTER" <?php if($tipoServicio[2]==$producto->grupo){if($producto->tipo_producto=='SPRINTER') echo 'selected';}?>>SPRINTER</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_2_" name="txt_provider_2" placeholder="Provider" value="<?php if($tipoServicio[2]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
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
                                                    <div class="col-md-4">
                                                        <div class="checkbox11">
                                                            <label class="text-green-goto">
                                                                <input  type="checkbox" name="txt_price_chb_2" id="txt_price_chb_2" value="<?php if($tipoServicio[2]==$producto->grupo)  if($producto->precio_grupo==1) echo 'checked';?>">
                                                                El precio es por grupo
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        {{csrf_field()}}
                                        <input type="hidden" name="posTipoEditcost_{{$producto->id}}" id="posTipoEditcost_{{$producto->id}}" value="{{$pos}}">
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
                                    $act_menu7='hide';
                                    $act_menu8='hide';

                                    $act_tabmenu0='';
                                    $act_tabmenu1='';
                                    $act_tabmenu2='';
                                    $act_tabmenu3='';
                                    $act_tabmenu4='';
                                    $act_tabmenu5='';
                                    $act_tabmenu6='';
                                    $act_tabmenu7='';
                                    $act_tabmenu8='';

                                    $pos=0;
                                    if($tipoServicio[0]==$producto->grupo){
                                        $act_menu0='active';
                                        $act_tabmenu0='in active';
                                        $pos=0;
                                    }
                                    if($tipoServicio[1]==$producto->grupo){
                                        $act_menu1='active';
                                        $act_tabmenu1='in active';
                                        $pos=1;
                                    }
                                    if($tipoServicio[2]==$producto->grupo){
                                        $act_menu2='active';
                                        $act_tabmenu2='in active';
                                        $pos=2;
                                    }
                                    if($tipoServicio[3]==$producto->grupo){
                                        $act_menu3='active';
                                        $act_tabmenu3='in active';
                                        $pos=3;
                                    }
                                    if($tipoServicio[4]==$producto->grupo){
                                        $act_menu4='active';
                                        $act_tabmenu4='in active';
                                        $pos=4;
                                    }
                                    if($tipoServicio[5]==$producto->grupo){
                                        $act_menu5='active';
                                        $act_tabmenu5='in active';
                                        $pos=5;
                                    }
                                    if($tipoServicio[6]==$producto->grupo){
                                        $act_menu6='active';
                                        $act_tabmenu6='in active';
                                        $pos=6;
                                    }
                                    if($tipoServicio[7]==$producto->grupo){
                                        $act_menu7='active';
                                        $act_tabmenu7='in active';
                                        $pos=7;
                                    }
                                    if($tipoServicio[8]==$producto->grupo){
                                        $act_menu8='active';
                                        $act_tabmenu8='in active';
                                        $pos=8;
                                    }
                                    ?>
                                    <div class="modal-body">
                                        <ul class="nav nav-tabs">
                                            <li class="<?php echo $act_menu3;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[3]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','3')">{{$tipoServicio[3]}}</a></li>
                                        </ul>
                                        <div class="tab-content">
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
                                                                <option value="TRANSFER" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='TRANSFER') echo 'selected';}?>>TRANSFER</option>
                                                                <option value="ASSISTANCE" <?php if($tipoServicio[3]==$producto->grupo){if($producto->tipo_producto=='ASSISTANCE') echo 'selected';}?>>ASSISTANCE</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_3_" name="txt_provider_3" placeholder="Provider" value="<?php if($tipoServicio[3]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
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
                                                    <div class="col-md-4">
                                                        <div class="checkbox11">
                                                            <label class="text-green-goto">
                                                                <input  type="checkbox" name="txt_price_chb_3" id="txt_price_chb_3" value="<?php if($tipoServicio[2]==$producto->grupo)  if($producto->precio_grupo==1) echo 'checked';?>">
                                                                El precio es por grupo
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        {{csrf_field()}}
                                        <input type="hidden" name="posTipoEditcost_{{$producto->id}}" id="posTipoEditcost_{{$producto->id}}" value="{{$pos}}">
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
                                    $act_menu7='hide';
                                    $act_menu8='hide';

                                    $act_tabmenu0='';
                                    $act_tabmenu1='';
                                    $act_tabmenu2='';
                                    $act_tabmenu3='';
                                    $act_tabmenu4='';
                                    $act_tabmenu5='';
                                    $act_tabmenu6='';
                                    $act_tabmenu7='';
                                    $act_tabmenu8='';

                                    $pos=0;
                                    if($tipoServicio[0]==$producto->grupo){
                                        $act_menu0='active';
                                        $act_tabmenu0='in active';
                                        $pos=0;
                                    }
                                    if($tipoServicio[1]==$producto->grupo){
                                        $act_menu1='active';
                                        $act_tabmenu1='in active';
                                        $pos=1;
                                    }
                                    if($tipoServicio[2]==$producto->grupo){
                                        $act_menu2='active';
                                        $act_tabmenu2='in active';
                                        $pos=2;
                                    }
                                    if($tipoServicio[3]==$producto->grupo){
                                        $act_menu3='active';
                                        $act_tabmenu3='in active';
                                        $pos=3;
                                    }
                                    if($tipoServicio[4]==$producto->grupo){
                                        $act_menu4='active';
                                        $act_tabmenu4='in active';
                                        $pos=4;
                                    }
                                    if($tipoServicio[5]==$producto->grupo){
                                        $act_menu5='active';
                                        $act_tabmenu5='in active';
                                        $pos=5;
                                    }
                                    if($tipoServicio[6]==$producto->grupo){
                                        $act_menu6='active';
                                        $act_tabmenu6='in active';
                                        $pos=6;
                                    }
                                    if($tipoServicio[7]==$producto->grupo){
                                        $act_menu7='active';
                                        $act_tabmenu7='in active';
                                        $pos=7;
                                    }
                                    if($tipoServicio[8]==$producto->grupo){
                                        $act_menu8='active';
                                        $act_tabmenu8='in active';
                                        $pos=8;
                                    }
                                    ?>
                                    <div class="modal-body">
                                        <ul class="nav nav-tabs">
                                            <li class="<?php echo $act_menu4;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[4]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','4')">{{$tipoServicio[4]}}</a></li>
                                        </ul>
                                        <div class="tab-content">
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
                                                            <input type="text" class="form-control" id="txt_provider_4_" name="txt_provider_4" placeholder="Provider" value="<?php if($tipoServicio[4]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
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
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        {{csrf_field()}}
                                        <input type="hidden" name="posTipoEditcost_{{$producto->id}}" id="posTipoEditcost_{{$producto->id}}" value="{{$pos}}">
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
                                    $act_menu7='hide';
                                    $act_menu8='hide';

                                    $act_tabmenu0='';
                                    $act_tabmenu1='';
                                    $act_tabmenu2='';
                                    $act_tabmenu3='';
                                    $act_tabmenu4='';
                                    $act_tabmenu5='';
                                    $act_tabmenu6='';
                                    $act_tabmenu7='';
                                    $act_tabmenu8='';

                                    $pos=0;
                                    if($tipoServicio[0]==$producto->grupo){
                                        $act_menu0='active';
                                        $act_tabmenu0='in active';
                                        $pos=0;
                                    }
                                    if($tipoServicio[1]==$producto->grupo){
                                        $act_menu1='active';
                                        $act_tabmenu1='in active';
                                        $pos=1;
                                    }
                                    if($tipoServicio[2]==$producto->grupo){
                                        $act_menu2='active';
                                        $act_tabmenu2='in active';
                                        $pos=2;
                                    }
                                    if($tipoServicio[3]==$producto->grupo){
                                        $act_menu3='active';
                                        $act_tabmenu3='in active';
                                        $pos=3;
                                    }
                                    if($tipoServicio[4]==$producto->grupo){
                                        $act_menu4='active';
                                        $act_tabmenu4='in active';
                                        $pos=4;
                                    }
                                    if($tipoServicio[5]==$producto->grupo){
                                        $act_menu5='active';
                                        $act_tabmenu5='in active';
                                        $pos=5;
                                    }
                                    if($tipoServicio[6]==$producto->grupo){
                                        $act_menu6='active';
                                        $act_tabmenu6='in active';
                                        $pos=6;
                                    }
                                    if($tipoServicio[7]==$producto->grupo){
                                        $act_menu7='active';
                                        $act_tabmenu7='in active';
                                        $pos=7;
                                    }
                                    if($tipoServicio[8]==$producto->grupo){
                                        $act_menu8='active';
                                        $act_tabmenu8='in active';
                                        $pos=8;
                                    }
                                    ?>
                                    <div class="modal-body">
                                        <ul class="nav nav-tabs">
                                            <li class="<?php echo $act_menu5;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[5]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','5')">{{$tipoServicio[5]}}</a></li>
                                        </ul>
                                        <div class="tab-content">
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
                                                            <input type="text" class="form-control" id="txt_provider_5_" name="txt_provider_5" placeholder="Provider" value="<?php if($tipoServicio[5]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
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
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        {{csrf_field()}}
                                        <input type="hidden" name="posTipoEditcost_{{$producto->id}}" id="posTipoEditcost_{{$producto->id}}" value="{{$pos}}">
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

            @foreach($productos_trains as $proveedor)
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
                                        $act_menu7='hide';
                                        $act_menu8='hide';

                                        $act_tabmenu0='';
                                        $act_tabmenu1='';
                                        $act_tabmenu2='';
                                        $act_tabmenu3='';
                                        $act_tabmenu4='';
                                        $act_tabmenu5='';
                                        $act_tabmenu6='';
                                        $act_tabmenu7='';
                                        $act_tabmenu8='';

                                        $pos=0;
                                        if($tipoServicio[0]==$producto->grupo){
                                            $act_menu0='active';
                                            $act_tabmenu0='in active';
                                            $pos=0;
                                        }
                                        if($tipoServicio[1]==$producto->grupo){
                                            $act_menu1='active';
                                            $act_tabmenu1='in active';
                                            $pos=1;
                                        }
                                        if($tipoServicio[2]==$producto->grupo){
                                            $act_menu2='active';
                                            $act_tabmenu2='in active';
                                            $pos=2;
                                        }
                                        if($tipoServicio[3]==$producto->grupo){
                                            $act_menu3='active';
                                            $act_tabmenu3='in active';
                                            $pos=3;
                                        }
                                        if($tipoServicio[4]==$producto->grupo){
                                            $act_menu4='active';
                                            $act_tabmenu4='in active';
                                            $pos=4;
                                        }
                                        if($tipoServicio[5]==$producto->grupo){
                                            $act_menu5='active';
                                            $act_tabmenu5='in active';
                                            $pos=5;
                                        }
                                        if($tipoServicio[6]==$producto->grupo){
                                            $act_menu6='active';
                                            $act_tabmenu6='in active';
                                            $pos=6;
                                        }
                                        if($tipoServicio[7]==$producto->grupo){
                                            $act_menu7='active';
                                            $act_tabmenu7='in active';
                                            $pos=7;
                                        }
                                        if($tipoServicio[8]==$producto->grupo){
                                            $act_menu8='active';
                                            $act_tabmenu8='in active';
                                            $pos=8;
                                        }
                                        ?>
                                        <div class="modal-body">
                                            <ul class="nav nav-tabs">
                                                <li class="<?php echo $act_menu6;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[6]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','6')">{{$tipoServicio[6]}}</a></li>
                                            </ul>
                                            <div class="tab-content">
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
                                                                    <option value="EXPEDITION" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='EXPEDITION') echo 'selected';}?>>EXPEDITION</option>
                                                                    <option value="VISITADOME" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='VISITADOME') echo 'selected';}?>>VISITADOME</option>
                                                                    <option value="HIRAN BINGHAN" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='HIRAN BINGHAN') echo 'selected';}?>>HIRAN BINGHAN</option>
                                                                    <option value="EJECUTIVO" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='EJECUTIVO') echo 'selected';}?>>EJECUTIVO</option>
                                                                    <option value="PRIMERA CLASE" <?php if($tipoServicio[6]==$producto->grupo){if($producto->tipo_producto=='PRIMERA CLASE') echo 'selected';}?>>PRIMERA CLASE</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_precio">Provider</label>
                                                                <input type="text" class="form-control" id="txt_provider_6_" name="txt_provider_6" placeholder="Provider" value="<?php if($tipoServicio[6]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
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
                                            <input type="hidden" name="posTipoEditcost_{{$producto->id}}" id="posTipoEditcost_{{$producto->id}}" value="{{$pos}}">
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

            @foreach($productos_travels as $proveedor)
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
                                        $act_menu7='hide';
                                        $act_menu8='hide';

                                        $act_tabmenu0='';
                                        $act_tabmenu1='';
                                        $act_tabmenu2='';
                                        $act_tabmenu3='';
                                        $act_tabmenu4='';
                                        $act_tabmenu5='';
                                        $act_tabmenu6='';
                                        $act_tabmenu7='';
                                        $act_tabmenu8='';

                                        $pos=0;
                                        if($tipoServicio[0]==$producto->grupo){
                                            $act_menu0='active';
                                            $act_tabmenu0='in active';
                                            $pos=0;
                                        }
                                        if($tipoServicio[1]==$producto->grupo){
                                            $act_menu1='active';
                                            $act_tabmenu1='in active';
                                            $pos=1;
                                        }
                                        if($tipoServicio[2]==$producto->grupo){
                                            $act_menu2='active';
                                            $act_tabmenu2='in active';
                                            $pos=2;
                                        }
                                        if($tipoServicio[3]==$producto->grupo){
                                            $act_menu3='active';
                                            $act_tabmenu3='in active';
                                            $pos=3;
                                        }
                                        if($tipoServicio[4]==$producto->grupo){
                                            $act_menu4='active';
                                            $act_tabmenu4='in active';
                                            $pos=4;
                                        }
                                        if($tipoServicio[5]==$producto->grupo){
                                            $act_menu5='active';
                                            $act_tabmenu5='in active';
                                            $pos=5;
                                        }
                                        if($tipoServicio[6]==$producto->grupo){
                                            $act_menu6='active';
                                            $act_tabmenu6='in active';
                                            $pos=6;
                                        }
                                        if($tipoServicio[7]==$producto->grupo){
                                            $act_menu7='active';
                                            $act_tabmenu7='in active';
                                            $pos=7;
                                        }
                                        if($tipoServicio[8]==$producto->grupo){
                                            $act_menu8='active';
                                            $act_tabmenu8='in active';
                                            $pos=8;
                                        }
                                        ?>
                                        <div class="modal-body">
                                            <ul class="nav nav-tabs">
                                                <li class="<?php echo $act_menu7;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[7]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','7')">{{$tipoServicio[7]}}</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div id="e_{{$tipoServicio[7]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu7;?>">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_codigo">Location</label>
                                                                <input type="text" class="form-control" id="txt_localizacion_7" name="txt_localizacion_7" placeholder="Location" value="<?php if($tipoServicio[7]==$producto->grupo) echo $producto->localizacion;?>">
                                                                <input type="hidden" name="tipoServicio_7" id="tipoServicio_7" value="{{$tipoServicio[7]}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_type">Type</label>
                                                                {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                                <select class="form-control" id="txt_type_7" name="txt_type_7">
                                                                    <option value="NATIONAL" <?php if($tipoServicio[7]==$producto->grupo){if($producto->tipo_producto=='NATIONAL') echo 'selected';}?>>NATIONAL</option>
                                                                    <option value="INTERNATIONAL" <?php if($tipoServicio[7]==$producto->grupo){if($producto->tipo_producto=='INTERNATIONAL') echo 'selected';}?>>INTERNATIONAL</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_precio">Provider</label>
                                                                <input type="text" class="form-control" id="txt_provider_7_" name="txt_provider_7" placeholder="Provider" value="<?php if($tipoServicio[7]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_product">Product</label>
                                                                <input type="text" class="form-control" id="txt_product_7" name="txt_product_7" placeholder="Product"  value="<?php if($tipoServicio[7]==$producto->grupo) echo $producto->nombre;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_code">Code product</label>
                                                                <input type="text" class="form-control" id="txt_code_7" name="txt_code_7" placeholder="Code product"  value="<?php if($tipoServicio[7]==$producto->grupo) echo $producto->codigo;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="txt_price">Price</label>
                                                                <input type="text" class="form-control" id="txt_price_7" name="txt_price_7" placeholder="Price"  value="<?php if($tipoServicio[7]==$producto->grupo) echo $producto->precio_costo;?>">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            {{csrf_field()}}
                                            <input type="hidden" name="posTipoEditcost_{{$producto->id}}" id="posTipoEditcost_{{$producto->id}}" value="{{$pos}}">
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
                                    $act_menu7='hide';
                                    $act_menu8='hide';

                                    $act_tabmenu0='';
                                    $act_tabmenu1='';
                                    $act_tabmenu2='';
                                    $act_tabmenu3='';
                                    $act_tabmenu4='';
                                    $act_tabmenu5='';
                                    $act_tabmenu6='';
                                    $act_tabmenu7='';
                                    $act_tabmenu8='';

                                    $pos=0;
                                    if($tipoServicio[0]==$producto->grupo){
                                        $act_menu0='active';
                                        $act_tabmenu0='in active';
                                        $pos=0;
                                    }
                                    if($tipoServicio[1]==$producto->grupo){
                                        $act_menu1='active';
                                        $act_tabmenu1='in active';
                                        $pos=1;
                                    }
                                    if($tipoServicio[2]==$producto->grupo){
                                        $act_menu2='active';
                                        $act_tabmenu2='in active';
                                        $pos=2;
                                    }
                                    if($tipoServicio[3]==$producto->grupo){
                                        $act_menu3='active';
                                        $act_tabmenu3='in active';
                                        $pos=3;
                                    }
                                    if($tipoServicio[4]==$producto->grupo){
                                        $act_menu4='active';
                                        $act_tabmenu4='in active';
                                        $pos=4;
                                    }
                                    if($tipoServicio[5]==$producto->grupo){
                                        $act_menu5='active';
                                        $act_tabmenu5='in active';
                                        $pos=5;
                                    }
                                    if($tipoServicio[6]==$producto->grupo){
                                        $act_menu6='active';
                                        $act_tabmenu6='in active';
                                        $pos=6;
                                    }
                                    if($tipoServicio[7]==$producto->grupo){
                                        $act_menu7='active';
                                        $act_tabmenu7='in active';
                                        $pos=7;
                                    }
                                    if($tipoServicio[8]==$producto->grupo){
                                        $act_menu8='active';
                                        $act_tabmenu8='in active';
                                        $pos=8;
                                    }
                                    ?>
                                    <div class="modal-body">
                                        <ul class="nav nav-tabs">
                                             <li class="<?php echo $act_menu8;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[8]}}_{{$producto->id}}" onclick="escojerPosEdit_cost('{{$producto->id}}','8')">{{$tipoServicio[8]}}</a></li>
                                        </ul>
                                        <div class="tab-content">
                                              <div id="e_{{$tipoServicio[8]}}_{{$producto->id}}" class="tab-pane fade <?php echo $act_tabmenu8;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <input type="text" class="form-control" id="txt_localizacion_8" name="txt_localizacion_8" placeholder="Location" value="<?php if($tipoServicio[8]==$producto->grupo) echo $producto->localizacion;?>">
                                                            <input type="hidden" name="tipoServicio_8" id="tipoServicio_8" value="{{$tipoServicio[8]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Type</label>
                                                            <input type="text" class="form-control" id="txt_type_8" name="txt_type_8" placeholder="Type"  value="<?php if($tipoServicio[8]==$producto->grupo) echo $producto->tipo_producto;?>">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Provider</label>
                                                            <input type="text" class="form-control" id="txt_provider_8_" name="txt_provider_8" placeholder="Provider" value="<?php if($tipoServicio[8]==$producto->grupo) echo $proveedor->codigo.' '.$proveedor->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Product</label>
                                                            <input type="text" class="form-control" id="txt_product_8" name="txt_product_8" placeholder="Product"  value="<?php if($tipoServicio[8]==$producto->grupo) echo $producto->nombre;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Code product</label>
                                                            <input type="text" class="form-control" id="txt_code_8" name="txt_code_8" placeholder="Code product"  value="<?php if($tipoServicio[8]==$producto->grupo) echo $producto->codigo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Price</label>
                                                            <input type="text" class="form-control" id="txt_price_8" name="txt_price_8" placeholder="Price"  value="<?php if($tipoServicio[8]==$producto->grupo) echo $producto->precio_costo;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="checkbox11">
                                                            <label class="text-green-goto">
                                                                <input  type="checkbox" name="txt_price_chb_8" id="txt_price_chb_8" value="<?php if($tipoServicio[2]==$producto->grupo) if($producto->precio_grupo==1) echo 'checked';?>">
                                                                El precio es por grupo
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        {{csrf_field()}}
                                        <input type="hidden" name="posTipoEditcost_{{$producto->id}}" id="posTipoEditcost_{{$producto->id}}" value="{{$pos}}">
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
        var loca='';
        $(document).ready(function() {
            var loca='';
            $("select[name=txt_localizacion_0]").change(function(){
                alert($('select[name=txt_localizacion_0]').val());
                loca=$('select[name=txt_localizacion_0]').val();
                //$('input[name=valor1]').val($(this).val());
            });
            $('#tb_HOTELS').DataTable();
            $('#tb_TOURS').DataTable();
            $('#tb_MOVILID').DataTable();
            $('#tb_REPRESENT').DataTable();
            $('#tb_ENTRANCES').DataTable();
            $('#tb_FOOD').DataTable();
            $('#tb_TRAINS').DataTable();
            $('#tb_FLIGHTS').DataTable();
            $('#tb_OTHERS').DataTable();
        } );
        $(function () {

            $('#txt_provider_0').autocomplete({

                source: '{{route('buscar_proveedor_path','HOTELS',loca)}}',
                minLength: 1,
                select:function(event,ui){
                    $('#txt_provider_0').val(ui.item.value);
                }
            });
            $('#txt_provider_1').autocomplete({
                source: '{{route('buscar_proveedor_path','TOURS',loca)}}',
                minLength: 1,
                select:function(event,ui){
                    $('#txt_provider_1').val(ui.item.value);
                }
            });
            $('#txt_provider_2').autocomplete({
                source: '{{route('buscar_proveedor_path','MOVILID',loca)}}',
                minLength: 1,
                select:function(event,ui){
                    $('#txt_provider_2').val(ui.item.value);
                }
            });
            $('#txt_provider_3').autocomplete({
                source: '{{route('buscar_proveedor_path','REPRESENT',loca)}}',
                minLength: 1,
                select:function(event,ui){
                    $('#txt_provider_3').val(ui.item.value);
                }
            });
            $('#txt_provider_4').autocomplete({
                source: '{{route('buscar_proveedor_path','ENTRANCES',loca)}}',
                minLength: 1,
                select:function(event,ui){
                    $('#txt_provider_4').val(ui.item.value);
                }
            });
            $('#txt_provider_5').autocomplete({
                source: '{{route('buscar_proveedor_path','FOOD',loca)}}',
                minLength: 1,
                select:function(event,ui){
                    $('#txt_provider_5').val(ui.item.value);
                }
            });
            $('#txt_provider_6').autocomplete({
                source: '{{route('buscar_proveedor_path','TRAINS',loca)}}',
                minLength: 1,
                select:function(event,ui){
                    $('#txt_provider_6').val(ui.item.value);
                }
            });
            $('#txt_provider_7').autocomplete({
                source: '{{route('buscar_proveedor_path','FLIGHTS',loca)}}',
                minLength: 1,
                select:function(event,ui){
                    $('#txt_provider_7').val(ui.item.value);
                }
            });
            $('#txt_provider_8').autocomplete({
                source: '{{route('buscar_proveedor_path','OTHERS',loca)}}',
                minLength: 1,
                select:function(event,ui){
                    $('#txt_provider_8').val(ui.item.value);
                }
            });
            $('#txt_product_0').autocomplete({
                source: '{{route('buscar_service_path','HOTELS')}}',
                minLength: 1,
                select:function(event,ui){
                    $('#txt_product_0').val(ui.item.value);
                }
            });
            $('#txt_product_1').autocomplete({
                source: '{{route('buscar_service_path','TOURS')}}',
                minLength: 1,
                select:function(event,ui){
                    $('#txt_product_1').val(ui.item.value);
                }
            });
            $('#txt_product_2').autocomplete({
                source: '{{route('buscar_service_path','MOVILID')}}',
                minLength: 1,
                select:function(event,ui){
                    $('#txt_product_2').val(ui.item.value);
                }
            });
            $('#txt_product_3').autocomplete({
                source: '{{route('buscar_service_path','REPRESENT')}}',
                minLength: 1,
                select:function(event,ui){
                    $('#txt_product_3').val(ui.item.value);
                }
            });
            $('#txt_product_4').autocomplete({
                source: '{{route('buscar_service_path','ENTRANCES')}}',
                minLength: 1,
                select:function(event,ui){
                    $('#txt_product_4').val(ui.item.value);
                }
            });
            $('#txt_product_5').autocomplete({
                source: '{{route('buscar_service_path','FOOD')}}',
                minLength: 1,
                select:function(event,ui){
                    $('#txt_product_5').val(ui.item.value);
                }
            });
            $('#txt_product_6').autocomplete({
                source: '{{route('buscar_service_path','TRAINS')}}',
                minLength: 1,
                select:function(event,ui){
                    $('#txt_product_6').val(ui.item.value);
                }
            });
            $('#txt_product_7').autocomplete({
                source: '{{route('buscar_service_path','FLIGHTS')}}',
                minLength: 1,
                select:function(event,ui){
                    $('#txt_product_7').val(ui.item.value);
                }
            });
            $('#txt_product_8').autocomplete({
                source: '{{route('buscar_service_path','OTHERS')}}',
                minLength: 1,
                select:function(event,ui){
                    $('#txt_product_8').val(ui.item.value);
                }
            });
        });
    </script>
@stop