@extends('.layouts.admin')
@section('archivos-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
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
            <li class="active">Services</li>
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
                                    <li class="{{$active}}"><a data-toggle="tab" href="#{{$categoria->nombre}}" onclick="escojerPos({{$pos}})">{{$categoria->nombre}}</a></li>
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
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_type">Type</label>
                                                    {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}

                                                    @if($categoria->nombre=='HOTELS')
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="2 STARS">2 STARS</option>
                                                            <option value="3 STARS">3 STARS</option>
                                                            <option value="4 STARS">4 STARS</option>
                                                            <option value="5 STARS">5 STARS</option>
                                                        </select>
                                                    @endif
                                                    @if($categoria->nombre=='TOURS')
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="GROUP">GROUP</option>
                                                            <option value="PRIVATE">PRIVATE</option>
                                                        </select>
                                                    @endif
                                                    @if($categoria->nombre=='MOVILID')
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="AUTO">AUTO</option>
                                                            <option value="SUBARU">SUBARU</option>
                                                            <option value="VAN">VAN</option>
                                                            <option value="H1">H1</option>
                                                            <option value="SPRINTER">SPRINTER</option>
                                                        </select>
                                                    @endif
                                                    @if($categoria->nombre=='REPRESENT')
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="GUIDE">GUIDE</option>
                                                            <option value="TRANSFER">TRANSFER</option>
                                                            <option value="ASSISTANCE">ASSISTANCE</option>
                                                        </select>
                                                    @endif
                                                    @if($categoria->nombre=='ENTRANCES')
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="EXTRANJERO">EXTRANJERO</option>
                                                            <option value="NATIONAL">NATIONAL</option>
                                                        </select>
                                                    @endif
                                                    @if($categoria->nombre=='FOOD')
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="LUNCH">LUNCH</option>
                                                            <option value="DINNER">DINNER</option>
                                                            <option value="BOX LUNCH">BOX LUNCH</option>
                                                        </select>
                                                    @endif
                                                    @if($categoria->nombre=='TRAINS')
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="EXPEDITION">EXPEDITION</option>
                                                            <option value="VISITADOME">VISITADOME</option>
                                                            <option value="HIRAN BINGHAN">BOX LUNCH</option>
                                                            <option value="EJECUTIVO">EJECUTIVO</option>
                                                            <option value="PRIMERA CLASE">PRIMERA CLASE</option>
                                                        </select>
                                                    @endif
                                                    @if($categoria->nombre=='FLIGHTS')
                                                        <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                            <option value="NATIONAL">NATIONAL</option>
                                                            <option value="INTERNATIONAL">INTERNATIONAL</option>
                                                        </select>
                                                    @endif
                                                    @if($categoria->nombre=='OTHERS')
                                                        <input type="text" class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}" placeholder="Type">
                                                    @endif

                                                </div>
                                            </div>
                                            @if($categoria->nombre=='HOTELS')
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="txt_type">Accommodation</label>
                                                        {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                        <select class="form-control" id="txt_acomodacion_{{$pos}}" name="txt_acomodacion_{{$pos}}">
                                                            <option value="S">SIMPLE</option>
                                                            <option value="D">DOBLE</option>
                                                            <option value="M">MATRIMONIAL</option>
                                                            <option value="T">TRIPLE</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_product">Product</label>
                                                    <input type="text" class="form-control" id="txt_product_{{$pos}}" name="txt_product_{{$pos}}" placeholder="Product">
                                                </div>
                                            </div>
                                            <div class="col-md-4 hide">
                                                <div class="form-group">
                                                    <label for="txt_code">Code product</label>
                                                    <input type="text" class="form-control" id="txt_code_{{$pos}}" name="txt_code_{{$pos}}" placeholder="Code product">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_price">Price</label>
                                                    <input type="text" class="form-control" id="txt_price_{{$pos}}" name="txt_price_{{$pos}}" placeholder="Price">
                                                </div>
                                            </div>

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
                    <li class="{{$activo}}"><a data-toggle="tab" href="#t_{{$categoria->nombre}}" onclick="escojerPos({{$pos}})">{{$categoria->nombre}}</a></li>
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
                        <table id="tb_{{$categoria->nombre}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Localizacion</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Operaciones</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Localizacion</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Operaciones</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($servicios as $servicio)
                                @if($servicio->grupo==$categoria->nombre)
                                    <tr id="lista_services_{{$servicio->id}}">
                                        <td>{{$servicio->localizacion}}</td>
                                        <td>{{$servicio->codigo}}</td>
                                        <td>{{$servicio->nombre}}</td>
                                        <td>${{$servicio->precio_venta}}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning"  data-toggle="modal" data-target="#modal_edit_destination_{{$servicio->id}}">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" onclick="eliminar_servicio('{{$servicio->id}}','{{$servicio->nombre}}')">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                <?php
                $pos++;
                ?>
            @endforeach

        </div>
    </div>
    @foreach($servicios as $servicio)
        @if($servicio->grupo==$categoria->nombre)
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
                                $active='';
                                $tipoServicio[]=$categoria->nombre;
                                if($pos==0){
                                    $active='active';
                                }
                                ?>
                                <li class="{{$active}}"><a data-toggle="tab" href="#{{$categoria->nombre}}" onclick="escojerPos({{$pos}})">{{$categoria->nombre}}</a></li>
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
                                                <label for="txt_codigo">Location</label>
                                                {{--<input type="text" class="form-control" id="txt_localizacion_0" name="txt_localizacion_0" placeholder="Location">--}}
                                                <select class="form-control" id="txt_localizacion_{{$pos}}" name="txt_localizacion_{{$pos}}">
                                                    @foreach($destinations as $destination)
                                                        <option value="{{$destination->destino}}" @if()@endif>{{$destination->destino}}</option>
                                                    @endforeach
                                                </select>

                                                <input type="hidden" name="tipoServicio_{{$pos}}" id="tipoServicio_{{$pos}}" value="{{$categoria->nombre}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_type">Type</label>
                                                {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}

                                                @if($categoria->nombre=='HOTELS')
                                                    <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                        <option value="2 STARS">2 STARS</option>
                                                        <option value="3 STARS">3 STARS</option>
                                                        <option value="4 STARS">4 STARS</option>
                                                        <option value="5 STARS">5 STARS</option>
                                                    </select>
                                                @endif
                                                @if($categoria->nombre=='TOURS')
                                                    <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                        <option value="GROUP">GROUP</option>
                                                        <option value="PRIVATE">PRIVATE</option>
                                                    </select>
                                                @endif
                                                @if($categoria->nombre=='MOVILID')
                                                    <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                        <option value="AUTO">AUTO</option>
                                                        <option value="SUBARU">SUBARU</option>
                                                        <option value="VAN">VAN</option>
                                                        <option value="H1">H1</option>
                                                        <option value="SPRINTER">SPRINTER</option>
                                                    </select>
                                                @endif
                                                @if($categoria->nombre=='REPRESENT')
                                                    <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                        <option value="GUIDE">GUIDE</option>
                                                        <option value="TRANSFER">TRANSFER</option>
                                                        <option value="ASSISTANCE">ASSISTANCE</option>
                                                    </select>
                                                @endif
                                                @if($categoria->nombre=='ENTRANCES')
                                                    <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                        <option value="EXTRANJERO">EXTRANJERO</option>
                                                        <option value="NATIONAL">NATIONAL</option>
                                                    </select>
                                                @endif
                                                @if($categoria->nombre=='FOOD')
                                                    <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                        <option value="LUNCH">LUNCH</option>
                                                        <option value="DINNER">DINNER</option>
                                                        <option value="BOX LUNCH">BOX LUNCH</option>
                                                    </select>
                                                @endif
                                                @if($categoria->nombre=='TRAINS')
                                                    <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                        <option value="EXPEDITION">EXPEDITION</option>
                                                        <option value="VISITADOME">VISITADOME</option>
                                                        <option value="HIRAN BINGHAN">BOX LUNCH</option>
                                                        <option value="EJECUTIVO">EJECUTIVO</option>
                                                        <option value="PRIMERA CLASE">PRIMERA CLASE</option>
                                                    </select>
                                                @endif
                                                @if($categoria->nombre=='FLIGHTS')
                                                    <select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
                                                        <option value="NATIONAL">NATIONAL</option>
                                                        <option value="INTERNATIONAL">INTERNATIONAL</option>
                                                    </select>
                                                @endif
                                                @if($categoria->nombre=='OTHERS')
                                                    <input type="text" class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}" placeholder="Type">
                                                @endif

                                            </div>
                                        </div>
                                        @if($categoria->nombre=='HOTELS')
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_type">Accommodation</label>
                                                    {{--<input type="text" class="form-control" id="txt_type_0" name="txt_type_0" placeholder="Type">--}}
                                                    <select class="form-control" id="txt_acomodacion_{{$pos}}" name="txt_acomodacion_{{$pos}}">
                                                        <option value="S">SIMPLE</option>
                                                        <option value="D">DOBLE</option>
                                                        <option value="M">MATRIMONIAL</option>
                                                        <option value="T">TRIPLE</option>
                                                    </select>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_product">Product</label>
                                                <input type="text" class="form-control" id="txt_product_{{$pos}}" name="txt_product_{{$pos}}" placeholder="Product">
                                            </div>
                                        </div>
                                        <div class="col-md-4 hide">
                                            <div class="form-group">
                                                <label for="txt_code">Code product</label>
                                                <input type="text" class="form-control" id="txt_code_{{$pos}}" name="txt_code_{{$pos}}" placeholder="Code product">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Price</label>
                                                <input type="text" class="form-control" id="txt_price_{{$pos}}" name="txt_price_{{$pos}}" placeholder="Price">
                                            </div>
                                        </div>

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
        @endif
    @endforeach
    <script>
        $(document).ready(function() {
            @foreach($categorias as $categoria)
            $('#tb_{{$categoria->nombre}}').DataTable();
            @endforeach
        } );
    </script>
@stop