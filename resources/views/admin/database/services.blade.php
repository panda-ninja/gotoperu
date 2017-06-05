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
        <button type="button" class="btn btn-primary hide" data-toggle="modal" data-target="#modal_new_destination">
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
                        <?php
                        $tipoServicio[0]='HOTELS';
                        $tipoServicio[1]='TOURS';
                        $tipoServicio[2]='TRANSPORTATION';
                        $tipoServicio[3]='GUIDES_ASSIST';
                        $tipoServicio[4]='ENTRANCES';
                        $tipoServicio[5]='FOOD';
                        $tipoServicio[6]='TRAINS';
                        $tipoServicio[7]='TRAVELS';
                        $tipoServicio[8]='OTHERS';
                        ?>
                        <div class="modal-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#{{$tipoServicio[0]}}" onclick="escojerPos(0)">{{$tipoServicio[0]}}</a></li>
                                <li><a data-toggle="tab" href="#{{$tipoServicio[1]}}" onclick="escojerPos(1)">{{$tipoServicio[1]}}</a></li>
                                <li><a data-toggle="tab" href="#{{$tipoServicio[2]}}" onclick="escojerPos(2)">{{$tipoServicio[2]}}</a></li>
                                <li><a data-toggle="tab" href="#{{$tipoServicio[3]}}" onclick="escojerPos(3)">{{$tipoServicio[3]}}</a></li>
                                <li><a data-toggle="tab" href="#{{$tipoServicio[4]}}" onclick="escojerPos(4)">{{$tipoServicio[4]}}</a></li>
                                <li><a data-toggle="tab" href="#{{$tipoServicio[5]}}" onclick="escojerPos(5)">{{$tipoServicio[5]}}</a></li>
                                <li><a data-toggle="tab" href="#{{$tipoServicio[6]}}" onclick="escojerPos(6)">{{$tipoServicio[6]}}</a></li>
                                <li><a data-toggle="tab" href="#{{$tipoServicio[7]}}" onclick="escojerPos(7)">{{$tipoServicio[7]}}</a></li>
                                <li><a data-toggle="tab" href="#{{$tipoServicio[8]}}" onclick="escojerPos(8)">{{$tipoServicio[8]}}</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="{{$tipoServicio[0]}}" class="tab-pane fade in active">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txt_codigo">Codigo</label>
                                                <input type="text" class="form-control" id="txt_codigo_0" name="txt_codigo_0" placeholder="Codigo">
                                                <input type="hidden" name="tipoServicio_0" id="tipoServicio_0" value="{{$tipoServicio[0]}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txt_nombre">Nombre</label>
                                                <input type="text" class="form-control" id="txt_nombre_0" name="txt_nombre_0" placeholder="Nombre">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txt_precio">Precio</label>
                                                <input type="number" class="form-control" id="txt_precio_0" name="txt_precio_0" placeholder="Precio">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="{{$tipoServicio[1]}}" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txt_codigo">Codigo</label>
                                                <input type="text" class="form-control" id="txt_codigo_1" name="txt_codigo_1" placeholder="Codigo">
                                                <input type="hidden" name="tipoServicio_1" id="tipoServicio_1" value="{{$tipoServicio[1]}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txt_nombre">Nombre</label>
                                                <input type="text" class="form-control" id="txt_nombre_1" name="txt_nombre_1" placeholder="Nombre">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txt_precio">Precio</label>
                                                <input type="number" class="form-control" id="txt_precio_1" name="txt_precio_1" placeholder="Precio">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="{{$tipoServicio[2]}}" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txt_codigo">Codigo</label>
                                                <input type="text" class="form-control" id="txt_codigo_2" name="txt_codigo_2" placeholder="Codigo">
                                                <input type="hidden" name="tipoServicio_2" id="tipoServicio_2" value="{{$tipoServicio[2]}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txt_nombre">Nombre</label>
                                                <input type="text" class="form-control" id="txt_nombre_2" name="txt_nombre_2" placeholder="Nombre">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txt_precio">Precio</label>
                                                <input type="number" class="form-control" id="txt_precio_2" name="txt_precio_2" placeholder="Precio">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="{{$tipoServicio[3]}}" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txt_codigo">Codigo</label>
                                                <input type="text" class="form-control" id="txt_codigo_3" name="txt_codigo_3" placeholder="Codigo">
                                                <input type="hidden" name="tipoServicio_3" id="tipoServicio_3" value="{{$tipoServicio[3]}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txt_nombre">Nombre</label>
                                                <input type="text" class="form-control" id="txt_nombre_3" name="txt_nombre_3" placeholder="Nombre">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txt_precio">Precio</label>
                                                <input type="number" class="form-control" id="txt_precio_3" name="txt_precio_3" placeholder="Precio">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="{{$tipoServicio[4]}}" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txt_codigo">Codigo</label>
                                                <input type="text" class="form-control" id="txt_codigo_4" name="txt_codigo_4" placeholder="Codigo">
                                                <input type="hidden" name="tipoServicio_4" id="tipoServicio_4" value="{{$tipoServicio[4]}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txt_nombre">Nombre</label>
                                                <input type="text" class="form-control" id="txt_nombre_4" name="txt_nombre_4" placeholder="Nombre">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txt_precio">Precio</label>
                                                <input type="number" class="form-control" id="txt_precio_4" name="txt_precio_4" placeholder="Precio">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="{{$tipoServicio[5]}}" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txt_codigo">Codigo</label>
                                                <input type="text" class="form-control" id="txt_codigo_5" name="txt_codigo_5" placeholder="Codigo">
                                                <input type="hidden" name="tipoServicio_5" id="tipoServicio_5" value="{{$tipoServicio[5]}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txt_nombre">Nombre</label>
                                                <input type="text" class="form-control" id="txt_nombre_5" name="txt_nombre_5" placeholder="Nombre">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txt_precio">Precio</label>
                                                <input type="number" class="form-control" id="txt_precio_5" name="txt_precio_5" placeholder="Precio">
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
            <li class="active"><a data-toggle="tab" href="#t_{{$tipoServicio[0]}}" onclick="escojerPos(0)">{{$tipoServicio[0]}}</a></li>
            <li><a data-toggle="tab" href="#t_{{$tipoServicio[1]}}" onclick="escojerPos(1)">{{$tipoServicio[1]}}</a></li>
            <li><a data-toggle="tab" href="#t_{{$tipoServicio[2]}}" onclick="escojerPos(2)">{{$tipoServicio[2]}}</a></li>
            <li><a data-toggle="tab" href="#t_{{$tipoServicio[3]}}" onclick="escojerPos(3)">{{$tipoServicio[3]}}</a></li>
            <li><a data-toggle="tab" href="#t_{{$tipoServicio[4]}}" onclick="escojerPos(4)">{{$tipoServicio[4]}}</a></li>
            <li><a data-toggle="tab" href="#t_{{$tipoServicio[5]}}" onclick="escojerPos(5)">{{$tipoServicio[5]}}</a></li>
            <li><a data-toggle="tab" href="#t_{{$tipoServicio[6]}}" onclick="escojerPos(6)">{{$tipoServicio[6]}}</a></li>
            <li><a data-toggle="tab" href="#t_{{$tipoServicio[7]}}" onclick="escojerPos(7)">{{$tipoServicio[7]}}</a></li>
            <li><a data-toggle="tab" href="#t_{{$tipoServicio[8]}}" onclick="escojerPos(8)">{{$tipoServicio[8]}}</a></li>

        </ul>

        <div class="tab-content margin-top-20">
            <div id="t_{{$tipoServicio[0]}}" class="tab-pane fade in active">
                <table id="tb_{{$tipoServicio[0]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Localizacion</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Localizacion</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($servicios as $servicio)
                        @if($servicio->grupo==$tipoServicio[0])
                        <tr id="lista_services_{{$servicio->id}}">
                            <td>{{$servicio->localizacion}}</td>
                            <td>{{$servicio->codigo}}</td>
                            <td>{{$servicio->nombre}}</td>
                            <td>${{$servicio->precio_venta}}</td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div id="t_{{$tipoServicio[1]}}" class="tab-pane fade">
                <table id="tb_{{$tipoServicio[1]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Localizacion</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Localizacion</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($servicios as $servicio)
                        @if($servicio->grupo==$tipoServicio[1])
                            <tr id="lista_services_{{$servicio->id}}">
                                <td>{{$servicio->localizacion}}</td>
                                <td>{{$servicio->codigo}}</td>
                                <td>{{$servicio->nombre}}</td>
                                <td>${{$servicio->precio_venta}}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div id="t_{{$tipoServicio[2]}}" class="tab-pane fade">
                <table id="tb_{{$tipoServicio[2]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Localizacion</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Localizacion</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($servicios as $servicio)
                        @if($servicio->grupo==$tipoServicio[2])
                            <tr id="lista_services_{{$servicio->id}}">
                                <td>{{$servicio->localizacion}}</td>
                                <td>{{$servicio->codigo}}</td>
                                <td>{{$servicio->nombre}}</td>
                                <td>${{$servicio->precio_venta}}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>

            </div>
            <div id="t_{{$tipoServicio[3]}}" class="tab-pane fade">
                <table id="tb_{{$tipoServicio[3]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Localizacion</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Localizacion</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($servicios as $servicio)
                        @if($servicio->grupo==$tipoServicio[3])
                            <tr id="lista_services_{{$servicio->id}}">
                                <td>{{$servicio->localizacion}}</td>
                                <td>{{$servicio->codigo}}</td>
                                <td>{{$servicio->nombre}}</td>
                                <td>${{$servicio->precio_venta}}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>

            </div>
            <div id="t_{{$tipoServicio[4]}}" class="tab-pane fade">
                <table id="tb_{{$tipoServicio[4]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Localizacion</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Localizacion</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($servicios as $servicio)
                        @if($servicio->grupo==$tipoServicio[4])
                            <tr id="lista_services_{{$servicio->id}}">
                                <td>{{$servicio->localizacion}}</td>
                                <td>{{$servicio->codigo}}</td>
                                <td>{{$servicio->nombre}}</td>
                                <td>${{$servicio->precio_venta}}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>

            </div>
            <div id="t_{{$tipoServicio[5]}}" class="tab-pane fade">
                <table id="tb_{{$tipoServicio[5]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Localizacion</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Localizacion</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($servicios as $servicio)
                        @if($servicio->grupo==$tipoServicio[5])
                            <tr id="lista_services_{{$servicio->id}}">
                                <td>{{$servicio->localizacion}}</td>
                                <td>{{$servicio->codigo}}</td>
                                <td>{{$servicio->nombre}}</td>
                                <td>${{$servicio->precio_venta}}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>

            </div>
            <div id="t_{{$tipoServicio[6]}}" class="tab-pane fade">
                <table id="tb_{{$tipoServicio[6]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Localizacion</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Localizacion</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($servicios as $servicio)
                        @if($servicio->grupo==$tipoServicio[6])
                            <tr id="lista_services_{{$servicio->id}}">
                                <td>{{$servicio->localizacion}}</td>
                                <td>{{$servicio->codigo}}</td>
                                <td>{{$servicio->nombre}}</td>
                                <td>${{$servicio->precio_venta}}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>

            </div>
            <div id="t_{{$tipoServicio[7]}}" class="tab-pane fade">
                <table id="tb_{{$tipoServicio[7]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Localizacion</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Localizacion</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($servicios as $servicio)
                        @if($servicio->grupo==$tipoServicio[7])
                            <tr id="lista_services_{{$servicio->id}}">
                                <td>{{$servicio->localizacion}}</td>
                                <td>{{$servicio->codigo}}</td>
                                <td>{{$servicio->nombre}}</td>
                                <td>${{$servicio->precio_venta}}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>

            </div>
            <div id="t_{{$tipoServicio[8]}}" class="tab-pane fade">
                <table id="tb_{{$tipoServicio[8]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Localizacion</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Localizacion</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($servicios as $servicio)
                        @if($servicio->grupo==$tipoServicio[8])
                            <tr id="lista_services_{{$servicio->id}}">
                                <td>{{$servicio->localizacion}}</td>
                                <td>{{$servicio->codigo}}</td>
                                <td>{{$servicio->nombre}}</td>
                                <td>${{$servicio->precio_venta}}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#tb_{{$tipoServicio[0]}}').DataTable();
            $('#tb_{{$tipoServicio[1]}}').DataTable();
            $('#tb_{{$tipoServicio[2]}}').DataTable();
            $('#tb_{{$tipoServicio[3]}}').DataTable();
            $('#tb_{{$tipoServicio[4]}}').DataTable();
            $('#tb_{{$tipoServicio[5]}}').DataTable();
            $('#tb_{{$tipoServicio[6]}}').DataTable();
            $('#tb_{{$tipoServicio[7]}}').DataTable();
            $('#tb_{{$tipoServicio[8]}}').DataTable();

        } );
    </script>
@stop