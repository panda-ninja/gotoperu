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
            <li class="active">Provider</li>
        </ol>
    </div>
    <div class="row margin-top-20">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_new_provider">
            New <i class="fa fa-plus-circle" aria-hidden="true"></i>
        </button>
        @foreach($categorias as $categoria)
            <?php
                $tipoServicio[]=$categoria->nombre;
            ?>
        @endforeach

        {{-- primer popup --}}
        <div class="modal fade bd-example-modal-lg" id="modal_new_provider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form  id="service_save_id" method="post" enctype="multipart/form-data" action="{{route('provider_new_path')}}">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New provider</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <ul class="nav nav-tabs">
                                <?php
                                $pos=0;
                                ?>
                                @foreach($tipoServicio as $tipoServicio_)
                                        <?php
                                        $activo='';
                                        if($pos==0)
                                            $activo='active';
                                        ?>
                                        <li class="{{$activo}}"><a data-toggle="tab" href="#t_{{$tipoServicio_}}" onclick="escojerPos({{$pos++}})">{{$tipoServicio_}}</a></li>
                                @endforeach

                            </ul>
                            <div class="tab-content">
                                <?php
                                $in_pos=0;
                                ?>
                                @foreach($tipoServicio as $tipoServicio_)
                                    <?php
                                    $in_activo='';
                                    if($in_pos==0)
                                        $in_activo='in active';
                                    ?>
                                    <div id="t_{{$tipoServicio_}}" class="tab-pane fade {{$in_activo}}">
                                        <div class="row margin-top-20">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_codigo">Location</label>
                                                    <select class="form-control" id="txt_localizacion_{{$in_pos}}" name="txt_localizacion_{{$in_pos}}">
                                                        @foreach($destinations as $destination)
                                                            <option value="{{$destination->destino}}">{{$destination->destino}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_codigo">Ruc</label>
                                                    <input type="text" class="form-control" id="txt_ruc_{{$in_pos}}" name="txt_ruc_{{$in_pos}}" placeholder="Ruc">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_type">Razon social</label>
                                                    <input type="text" class="form-control" id="txt_razon_social_{{$in_pos}}" name="txt_razon_social_{{$in_pos}}" placeholder="Razon social">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_precio">Direccion</label>
                                                    <input type="text" class="form-control" id="txt_direccion_{{$in_pos}}" name="txt_direccion_{{$in_pos}}" placeholder="Direccion">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_product">Telefono</label>
                                                    <input type="text" class="form-control" id="txt_telefono_{{$in_pos}}" name="txt_telefono_{{$in_pos}}" placeholder="Telefono">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_code">Celular</label>
                                                    <input type="text" class="form-control" id="txt_celular_{{$in_pos}}" name="txt_celular_{{$in_pos}}" placeholder="Celular">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_price">Email</label>
                                                    <input type="email" class="form-control" id="txt_email_{{$in_pos}}" name="txt_email_{{$in_pos}}" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_price">Reservas Contacto</label>
                                                    <input type="text" class="form-control" id="txt_r_nombres_{{$in_pos}}" name="txt_r_nombres_{{$in_pos}}" placeholder="Nombres, apellidos">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_price">Reservas Tel/Cel</label>
                                                    <input type="text" class="form-control" id="txt_r_telefono_{{$in_pos}}" name="txt_r_telefono_{{$in_pos}}" placeholder="Tel. o Cel.">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txt_price">Contabilidad Contacto</label>
                                                    <input type="text" class="form-control" id="txt_c_nombres_{{$in_pos}}" name="txt_c_nombres_{{$in_pos}}" placeholder="Nombres, apellidos">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Contabilidad Tel/Cel</label>
                                                <input type="text" class="form-control" id="txt_c_telefono_{{$in_pos}}" name="txt_c_telefono_{{$in_pos}}" placeholder="Tel. o Cel.">
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <?php
                                        $in_pos++;
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
        <div class="col-lg-12">
            <ul class="nav nav-tabs">
                <?php
                $pos=0;
                ?>
                @foreach($tipoServicio as $tipoServicio_)
                    <?php
                    $activo='';
//                    if($pos==0)
//                        $activo='active';
//                    ?>
                    <li class="{{$activo}}"><a data-toggle="tab" href="#tl_{{$tipoServicio_}}">{{$tipoServicio_}}</a></li>
                <?php
                    $pos++;
                ?>
                @endforeach
                {{--<li class="active"><a data-toggle="tab" href="#tl_{{$tipoServicio[0]}}">{{$tipoServicio[0]}}</a></li>--}}
                {{--<li><a data-toggle="tab" href="#tl_{{$tipoServicio[1]}}" >{{$tipoServicio[1]}}</a></li>--}}
                {{--<li><a data-toggle="tab" href="#tl_{{$tipoServicio[2]}}" >{{$tipoServicio[2]}}</a></li>--}}
                {{--<li><a data-toggle="tab" href="#tl_{{$tipoServicio[3]}}" >{{$tipoServicio[3]}}</a></li>--}}
                {{--<li><a data-toggle="tab" href="#tl_{{$tipoServicio[4]}}" >{{$tipoServicio[4]}}</a></li>--}}
                {{--<li><a data-toggle="tab" href="#tl_{{$tipoServicio[5]}}" >{{$tipoServicio[5]}}</a></li>--}}
                {{--<li><a data-toggle="tab" href="#tl_{{$tipoServicio[6]}}" >{{$tipoServicio[6]}}</a></li>--}}
                {{--<li><a data-toggle="tab" href="#tl_{{$tipoServicio[7]}}" >{{$tipoServicio[7]}}</a></li>--}}
                {{--<li><a data-toggle="tab" href="#tl_{{$tipoServicio[8]}}" >{{$tipoServicio[8]}}</a></li>--}}
            </ul>
            <div class="tab-content">
                <?php
                $in_pos=0;
                ?>
                @foreach($tipoServicio as $tipoServicio_)
                    <?php
                    $in_activo='';
//                    if($in_pos==0)
//                        $in_activo='in active';
//                    ?>
                    <div id="tl_{{$tipoServicio_}}" class="tab-pane fade {{$in_activo}}">
                            <div class="margin-top-20">
                                <table id="tb_{{$tipoServicio_}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        {{--<th>Location</th>--}}
                                        {{--<th>Codigo</th>--}}
                                        <th>Ruc</th>
                                        <th>Razon social</th>
                                        {{--<th>Direccion</th>--}}
                                        <th>Tel./Cel.</th>
                                        <th>Email</th>
                                        <th>Reservas</th>
                                        <th>Contabilidad</th>
                                        <th>Operations</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        {{--<th>Location</th>--}}
                                        {{--<th>Codigo</th>--}}
                                        <th>Ruc</th>
                                        <th>Razon social</th>
                                        {{--<th>Direccion</th>--}}
                                        <th>Tel./Cel.</th>
                                        <th>Email</th>
                                        <th>Reservas</th>
                                        <th>Contabilidad</th>
                                        <th>Operations</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($providers as $provider)
                                        @if($tipoServicio_==$provider->grupo)
                                            <tr id="lista_provider_{{$provider->id}}">
                                                {{--<td>{{$provider->localizacion}}</td>--}}
                                                {{--<td>{{$provider->codigo}}</td>--}}
                                                <td>{{$provider->ruc}}</td>
                                                <td>{{$provider->razon_social}}</td>
                                                {{--<td>{{$provider->direccion}}</td>--}}
                                                <td>{{$provider->telefono}}<br>{{$provider->celular}}</td>
                                                <td>{{$provider->email}}</td>
                                                <td>{{$provider->r_nombres}}<br>{{$provider->r_telefono}}</td>
                                                <td>{{$provider->c_nombres}}<br>{{$provider->c_telefono}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-warning"  data-toggle="modal" data-target="#modal_edit_cost_{{$provider->id}}">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger" onclick="eliminar_provider('{{$provider->id}}','{{$provider->razon_social}}')">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php
                    $in_pos++;
                    ?>
                @endforeach

            </div>
        @foreach($providers as $provider)
            {{--@if($provider->grupo==$tipoServicio[0])--}}
                <!-- Modal -->
                    <div class="modal fade bd-example-modal-lg" id="modal_edit_cost_{{$provider->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <form action="{{route('provider_edit_path')}}" method="post" id="service_save_id" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Provider</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <ul class="nav nav-tabs">
                                            <?php
                                            $pos=0;
                                            ?>
                                            @foreach($tipoServicio as $tipoServicio_)
                                                <?php
                                                    $act_activo='hide';
                                                    if($tipoServicio_==$provider->grupo){
                                                        $act_activo='active';}
                                                ?>
                                                <li class="<?php echo $act_activo;?>"><a data-toggle="tab" href="#e_{{$tipoServicio_}}_{{$provider->id}}" onclick="escojerPosEdit_cost('{{$provider->id}}','{{$pos++}}')">{{$tipoServicio_}}</a></li>
                                                <?php
                                                    $pos++;
                                                ?>
                                            @endforeach
                                       </ul>
                                        <div class="tab-content">
                                            <?php
                                            $pos=0;
                                            ?>
                                            @foreach($tipoServicio as $tipoServicio_)
                                            <?php
                                                $in_act_activo='hide';
                                            ?>
                                            @if($tipoServicio_==$provider->grupo)
                                                <?php
                                                    $in_act_activo='in active';
                                                ?>
                                                <div id="e_{{$tipoServicio_}}_{{$provider->id}}" class="tab-pane fade <?php echo $in_act_activo;?>">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_codigo">Location</label>
                                                                    <select class="form-control" id="txt_localizacion_" name="txt_localizacion_">
                                                                        @foreach($destinations as $destination)
                                                                            <option value="{{$destination->destino}}" <?php if($tipoServicio_==$provider->grupo){if($provider->localizacion==$destination->destino) echo 'selected';}?>>{{$destination->destino}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <input type="hidden" name="tipoServicio_" id="tipoServicio_" value="{{$tipoServicio_}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_codigo">Ruc</label>
                                                                    <input type="text" class="form-control" id="txt_ruc_" name="txt_ruc_" placeholder="Ruc"  value="<?php if($tipoServicio_==$provider->grupo) echo $provider->ruc;?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_type">Razon social</label>
                                                                    <input type="text" class="form-control" id="txt_razon_social_" name="txt_razon_social_" placeholder="Razon social" value="<?php if($tipoServicio_==$provider->grupo) echo $provider->razon_social;?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_precio">Direccion</label>
                                                                    <input type="text" class="form-control" id="txt_direccion_" name="txt_direccion_" placeholder="Direccion" value="<?php if($tipoServicio_==$provider->grupo) echo $provider->direccion;?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_product">Telefono</label>
                                                                    <input type="text" class="form-control" id="txt_telefono_" name="txt_telefono_" placeholder="Telefono" value="<?php if($tipoServicio_==$provider->grupo) echo $provider->telefono;?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_code">Celular</label>
                                                                    <input type="text" class="form-control" id="txt_celular_" name="txt_celular_" placeholder="Celular" value="<?php if($tipoServicio_==$provider->grupo) echo $provider->celular;?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_price">Email</label>
                                                                    <input type="email" class="form-control" id="txt_email_" name="txt_email_" placeholder="Email" value="<?php if($tipoServicio_==$provider->grupo) echo $provider->email;?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_price">Reservas Contacto</label>
                                                                    <input type="text" class="form-control" id="txt_r_nombres_" name="txt_r_nombres_" placeholder="Nombres, apellidos" value="<?php if($tipoServicio_==$provider->grupo) echo $provider->r_nombres;?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_price">Reservas Tel/Cel</label>
                                                                    <input type="text" class="form-control" id="txt_r_telefono_" name="txt_r_telefono_" placeholder="Tel. o Cel." value="<?php if($tipoServicio_==$provider->grupo) echo $provider->r_telefono;?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_price">Contabilidad Contacto</label>
                                                                    <input type="text" class="form-control" id="txt_c_nombres_" name="txt_c_nombres_" placeholder="Nombres, apellidos" value="<?php if($tipoServicio_==$provider->grupo) echo $provider->c_nombres;?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_price">Contabilidad Tel/Cel</label>
                                                                    <input type="text" class="form-control" id="txt_c_telefono_" name="txt_c_telefono_" placeholder="Tel. o Cel." value="<?php if($tipoServicio_==$provider->grupo) echo $provider->c_telefono;?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                $pos++;
                                                ?>
                                            @endif
                                            @endforeach


                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        {{csrf_field()}}
                                        <input type="hidden" name="posTipoEditcost_{{$provider->id}}" id="posTipoEditcost_{{$provider->id}}" value="{{$provider->grupo}}">
                                        <input type="hidden" name="id" id="id" value="{{$provider->id}}">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            {{--@endif--}}
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
            $('#tb_TRAINS').DataTable();
            $('#tb_TRAVELS').DataTable();
            $('#tb_OTHERS').DataTable();
        } );

    </script>
@stop