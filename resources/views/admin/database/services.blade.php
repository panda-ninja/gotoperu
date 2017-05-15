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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_new_destination">
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
                        $tipoServicio[0]='TRANSPORT1';
                        $tipoServicio[1]='TRANSPORT2';
                        $tipoServicio[2]='TRANSPORT3';
                        $tipoServicio[3]='TRANSPORT4';
                        $tipoServicio[4]='TRANSPORT5';
                        $tipoServicio[5]='TRANSPORT6';

                        ?>
                        <div class="modal-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#{{$tipoServicio[0]}}" onclick="escojerPos(0)">{{$tipoServicio[0]}}</a></li>
                                <li><a data-toggle="tab" href="#{{$tipoServicio[1]}}" onclick="escojerPos(1)">{{$tipoServicio[1]}}</a></li>
                                <li><a data-toggle="tab" href="#{{$tipoServicio[2]}}" onclick="escojerPos(2)">{{$tipoServicio[2]}}</a></li>
                                <li><a data-toggle="tab" href="#{{$tipoServicio[3]}}" onclick="escojerPos(3)">{{$tipoServicio[3]}}</a></li>
                                <li><a data-toggle="tab" href="#{{$tipoServicio[4]}}" onclick="escojerPos(4)">{{$tipoServicio[4]}}</a></li>
                                <li><a data-toggle="tab" href="#{{$tipoServicio[5]}}" onclick="escojerPos(5)">{{$tipoServicio[5]}}</a></li>
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
        <table id="example" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Tipo servicio</th>
                <th>Code</th>
                <th>Name</th>
                <th>Price</th>
                <th>Operations</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Tipo servicio</th>
                <th>Code</th>
                <th>Name</th>
                <th>Price</th>
                <th>Operations</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($servicios as $servicio)
                <tr id="lista_services_{{$servicio->id}}">
                    <td>{{$servicio->tipoServicio}}</td>
                    <td>{{$servicio->codigo}}</td>
                    <td>{{$servicio->nombre}}</td>
                    <td>{{$servicio->precio}}</td>
                    <td>
                        <button type="button" class="btn btn-warning"  data-toggle="modal" data-target="#modal_edit_service_{{$servicio->id}}">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-danger" onclick="eliminar_servicio('{{$servicio->id}}','{{$servicio->nombre}}')">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @foreach($servicios as $servicio)
        <?php

        ?>
        <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="modal_edit_service_{{$servicio->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form action="{{route('service_edit_path')}}" method="post" id="service_edit_id" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit service</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php
                                $clase0_='';
                                $clase1_='';
                                $clase2_='';
                                $clase3_='';
                                $clase4_='';
                                $clase5_='';
                                $clase0='';
                                $clase1='';
                                $clase2='';
                                $clase3='';
                                $clase4='';
                                $clase5='';

                                if($tipoServicio[0]==$servicio->tipoServicio){
                                    $clase0=' in active';
                                    $clase0_='active';
                                }
                                if($tipoServicio[1]==$servicio->tipoServicio){
                                    $clase1=' in active';
                                    $clase1_='active';
                                }
                                if($tipoServicio[2]==$servicio->tipoServicio){
                                    $clase2=' in active';
                                    $clase2_='active';
                                }
                                if($tipoServicio[3]==$servicio->tipoServicio){
                                    $clase3=' in active';
                                    $clase3_='active';
                                }
                                if($tipoServicio[4]==$servicio->tipoServicio){
                                    $clase4=' in active';
                                    $clase4_='active';
                                }
                                if($tipoServicio[5]==$servicio->tipoServicio){
                                    $clase5=' in active';
                                    $clase5_='active';
                                }
                                ?>
                                <ul class="nav nav-tabs">
                                    <li class="<?php echo $clase0_;?>"><a data-toggle="tab" href="#{{$servicio->id}}_e_{{$tipoServicio[0]}}" onclick="escojerPosEdit('0','{{$servicio->id}}')">{{$tipoServicio[0]}}</a></li>
                                    <li class="<?php echo $clase1_;?>"><a data-toggle="tab" href="#{{$servicio->id}}_e_{{$tipoServicio[1]}}" onclick="escojerPosEdit('1','{{$servicio->id}}')">{{$tipoServicio[1]}}</a></li>
                                    <li class="<?php echo $clase2_;?>"><a data-toggle="tab" href="#{{$servicio->id}}_e_{{$tipoServicio[2]}}" onclick="escojerPosEdit('2','{{$servicio->id}}')">{{$tipoServicio[2]}}</a></li>
                                    <li class="<?php echo $clase3_;?>"><a data-toggle="tab" href="#{{$servicio->id}}_e_{{$tipoServicio[3]}}" onclick="escojerPosEdit('3','{{$servicio->id}}')">{{$tipoServicio[3]}}</a></li>
                                    <li class="<?php echo $clase4_;?>"><a data-toggle="tab" href="#{{$servicio->id}}_e_{{$tipoServicio[4]}}" onclick="escojerPosEdit('4','{{$servicio->id}}')">{{$tipoServicio[4]}}</a></li>
                                    <li class="<?php echo $clase5_;?>"><a data-toggle="tab" href="#{{$servicio->id}}_e_{{$tipoServicio[5]}}" onclick="escojerPosEdit('5','{{$servicio->id}}')">{{$tipoServicio[5]}}</a></li>

                                </ul>

                                <div class="tab-content">
                                    <div id="{{$servicio->id}}_e_{{$tipoServicio[0]}}" class="tab-pane fade <?php echo $clase0;?>">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txt_codigo">Codigo</label>
                                                    <input type="text" class="form-control" id="{{$servicio->id}}_txt_codigo_0" name="{{$servicio->id}}_txt_codigo_0" placeholder="Codigo" value="<?php  echo $servicio->codigo;?>">
                                                    <input type="hidden" name="{{$servicio->id}}_tipoServicio_0" id="{{$servicio->id}}_tipoServicio_0" value="{{$tipoServicio[0]}}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txt_nombre">Nombre</label>
                                                    <input type="text" class="form-control" id="{{$servicio->id}}_txt_nombre_0" name="{{$servicio->id}}_txt_nombre_0" placeholder="Nombre" value="<?php  echo $servicio->nombre;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txt_precio">Precio</label>
                                                    <input type="number" class="form-control" id="{{$servicio->id}}_txt_precio_0" name="{{$servicio->id}}_txt_precio_0" placeholder="Precio" value="<?php  echo $servicio->precio;?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="{{$servicio->id}}_e_{{$tipoServicio[1]}}" class="tab-pane fade <?php echo $clase1;?>">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txt_codigo">Codigo</label>
                                                    <input type="text" class="form-control" id="{{$servicio->id}}_txt_codigo_1" name="{{$servicio->id}}_txt_codigo_1" placeholder="Codigo" value="<?php  echo $servicio->codigo;?>">
                                                    <input type="hidden" name="{{$servicio->id}}_tipoServicio_1" id="{{$servicio->id}}_tipoServicio_1" value="{{$tipoServicio[1]}}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txt_nombre">Nombre</label>
                                                    <input type="text" class="form-control" id="{{$servicio->id}}_txt_nombre_1" name="{{$servicio->id}}_txt_nombre_1" placeholder="Nombre" value="<?php  echo $servicio->nombre;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txt_precio">Precio</label>
                                                    <input type="number" class="form-control" id="{{$servicio->id}}_txt_precio_1" name="{{$servicio->id}}_txt_precio_1" placeholder="Precio" value="<?php echo $servicio->precio;?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="{{$servicio->id}}_e_{{$tipoServicio[2]}}" class="tab-pane fade <?php echo $clase2;?>">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txt_codigo">Codigo</label>
                                                    <input type="text" class="form-control" id="{{$servicio->id}}_txt_codigo_2" name="{{$servicio->id}}_txt_codigo_2" placeholder="Codigo" value="<?php  echo $servicio->codigo;?>">
                                                    <input type="hidden" name="{{$servicio->id}}_tipoServicio_2" id="{{$servicio->id}}_tipoServicio_2" value="{{$tipoServicio[2]}}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txt_nombre">Nombre</label>
                                                    <input type="text" class="form-control" id="{{$servicio->id}}_txt_nombre_2" name="{{$servicio->id}}_txt_nombre_2" placeholder="Nombre" value="<?php  echo $servicio->nombre;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txt_precio">Precio</label>
                                                    <input type="number" class="form-control" id="{{$servicio->id}}_txt_precio_2" name="{{$servicio->id}}_txt_precio_2" placeholder="Precio" value="<?php  echo $servicio->precio;?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="{{$servicio->id}}_e_{{$tipoServicio[3]}}" class="tab-pane fade <?php echo $clase3;?>">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txt_codigo">Codigo</label>
                                                    <input type="text" class="form-control" id="{{$servicio->id}}_txt_codigo_3" name="{{$servicio->id}}_txt_codigo_3" placeholder="Codigo" value="<?php echo $servicio->codigo;?>">
                                                    <input type="hidden" name="{{$servicio->id}}_tipoServicio_3" id="{{$servicio->id}}_tipoServicio_3" value="{{$tipoServicio[3]}}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txt_nombre">Nombre</label>
                                                    <input type="text" class="form-control" id="{{$servicio->id}}_txt_nombre_3" name="{{$servicio->id}}_txt_nombre_3" placeholder="Nombre" value="<?php  echo $servicio->nombre;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txt_precio">Precio</label>
                                                    <input type="number" class="form-control" id="{{$servicio->id}}_txt_precio_3" name="{{$servicio->id}}_txt_precio_3" placeholder="Precio" value="<?php echo $servicio->precio;?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="{{$servicio->id}}_e_{{$tipoServicio[4]}}" class="tab-pane fade <?php echo $clase4;?>">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txt_codigo">Codigo</label>
                                                    <input type="text" class="form-control" id="{{$servicio->id}}_txt_codigo_4" name="{{$servicio->id}}_txt_codigo_4" placeholder="Codigo" value="<?php echo $servicio->codigo;?>">
                                                    <input type="hidden" name="{{$servicio->id}}_tipoServicio_4" id="{{$servicio->id}}_tipoServicio_4" value="{{$tipoServicio[4]}}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txt_nombre">Nombre</label>
                                                    <input type="text" class="form-control" id="{{$servicio->id}}_txt_nombre_4" name="{{$servicio->id}}_txt_nombre_4" placeholder="Nombre" value="<?php  echo $servicio->nombre;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txt_precio">Precio</label>
                                                    <input type="number" class="form-control" id="{{$servicio->id}}_txt_precio_4" name="{{$servicio->id}}_txt_precio_4" placeholder="Precio" value="<?php  echo $servicio->precio;?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="{{$servicio->id}}_e_{{$tipoServicio[5]}}" class="tab-pane fade <?php echo $clase5;?>">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txt_codigo">Codigo</label>
                                                    <input type="text" class="form-control" id="{{$servicio->id}}_txt_codigo_5" name="{{$servicio->id}}_txt_codigo_5" placeholder="Codigo" value="<?php echo $servicio->codigo;?>">
                                                    <input type="hidden" name="{{$servicio->id}}_tipoServicio_5" id="{{$servicio->id}}_tipoServicio_5" value="{{$tipoServicio[5]}}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txt_nombre">Nombre</label>
                                                    <input type="text" class="form-control" id="{{$servicio->id}}_txt_nombre_5" name="{{$servicio->id}}_txt_nombre_5" placeholder="Nombre" value="<?php  echo $servicio->nombre;?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txt_precio">Precio</label>
                                                    <input type="number" class="form-control" id="{{$servicio->id}}_txt_precio_5" name="{{$servicio->id}}_txt_precio_5" placeholder="Precio" value="<?php echo $servicio->precio;?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="modal-footer">
                                {{csrf_field()}}
                                <?php
                                    $valor=0;
                                    if($servicio->tipoServicio==$tipoServicio[0])
                                        $valor=0;
                                    if($servicio->tipoServicio==$tipoServicio[1])
                                        $valor=1;
                                    if($servicio->tipoServicio==$tipoServicio[2])
                                        $valor=2;
                                    if($servicio->tipoServicio==$tipoServicio[3])
                                        $valor=3;
                                    if($servicio->tipoServicio==$tipoServicio[4])
                                        $valor=4;
                                    if($servicio->tipoServicio==$tipoServicio[5])
                                        $valor=5;
                                ?>
                                <input type="hidden" name="posTipoEdit_{{$servicio->id}}" id="posTipoEdit_{{$servicio->id}}" value="{{$valor}}">
                                {{--<input type="hidden" name="posTipoEdit_id_{{$servicio->id}}" id="posTipoEdit_id_{{$servicio->id}}" value="{{$servicio->id}}">--}}
                                <input type="hidden" id="id" name="id"   value="{{$servicio->id}}">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@stop