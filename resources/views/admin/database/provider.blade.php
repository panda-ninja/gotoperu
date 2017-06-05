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

        {{-- primer popup --}}
        <div class="modal fade bd-example-modal-lg" id="modal_new_provider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form  id="service_save_id"  method="post" enctype="multipart/form-data" action="{{route('provider_new_path')}}">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New provider</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
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
                            <div class="tab-content">
                                <div id="t_{{$tipoServicio[0]}}" class="tab-pane fade in active">
                                    <div class="row margin-top-20">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Location</label>
                                                <select class="form-control" id="txt_localizacion_0" name="txt_localizacion_0">
                                                    @foreach($destinations as $destination)
                                                        <option value="{{$destination->destino}}">{{$destination->destino}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Ruc</label>
                                                <input type="text" class="form-control" id="txt_ruc_0" name="txt_ruc_0" placeholder="Ruc">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_type">Razon social</label>
                                                <input type="text" class="form-control" id="txt_razon_social_0" name="txt_razon_social_0" placeholder="Razon social">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_precio">Direccion</label>
                                                <input type="text" class="form-control" id="txt_direccion_0" name="txt_direccion_0" placeholder="Direccion">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_product">Telefono</label>
                                                <input type="text" class="form-control" id="txt_telefono_0" name="txt_telefono_0" placeholder="Telefono">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_code">Celular</label>
                                                <input type="text" class="form-control" id="txt_celular_0" name="txt_celular_0" placeholder="Celular">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Email</label>
                                                <input type="email" class="form-control" id="txt_email_0" name="txt_email_0" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Reservas Contacto</label>
                                                <input type="text" class="form-control" id="txt_r_nombres_0" name="txt_r_nombres_0" placeholder="Nombres, apellidos">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Reservas Tel/Cel</label>
                                                <input type="text" class="form-control" id="txt_r_telefono_0" name="txt_r_telefono_0" placeholder="Tel. o Cel.">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Contabilidad Contacto</label>
                                                <input type="text" class="form-control" id="txt_c_nombres_0" name="txt_c_nombres_0" placeholder="Nombres, apellidos">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Contabilidad Tel/Cel</label>
                                                <input type="text" class="form-control" id="txt_c_telefono_0" name="txt_c_telefono_0" placeholder="Tel. o Cel.">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="t_{{$tipoServicio[1]}}" class="tab-pane fade">
                                    <div class="row margin-top-20">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Location</label>
                                                <select class="form-control" id="txt_localizacion_1" name="txt_localizacion_1">
                                                    @foreach($destinations as $destination)
                                                        <option value="{{$destination->destino}}">{{$destination->destino}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Ruc</label>
                                                <input type="text" class="form-control" id="txt_ruc_1" name="txt_ruc_1" placeholder="Ruc">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_type">Razon social</label>
                                                <input type="text" class="form-control" id="txt_razon_social_1" name="txt_razon_social_1" placeholder="Razon social">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_precio">Direccion</label>
                                                <input type="text" class="form-control" id="txt_direccion_1" name="txt_direccion_1" placeholder="Direccion">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_product">Telefono</label>
                                                <input type="text" class="form-control" id="txt_telefono_1" name="txt_telefono_1" placeholder="Telefono">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_code">Celular</label>
                                                <input type="text" class="form-control" id="txt_celular_1" name="txt_celular_1" placeholder="Celular">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Email</label>
                                                <input type="email" class="form-control" id="txt_email_1" name="txt_email_1" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Reservas Contacto</label>
                                                <input type="text" class="form-control" id="txt_r_nombres_1" name="txt_r_nombres_1" placeholder="Nombres, apellidos">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Reservas Tel/Cel</label>
                                                <input type="text" class="form-control" id="txt_r_telefono_1" name="txt_r_telefono_1" placeholder="Tel. o Cel.">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Contabilidad Contacto</label>
                                                <input type="text" class="form-control" id="txt_c_nombres_1" name="txt_c_nombres_1" placeholder="Nombres, apellidos">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Contabilidad Tel/Cel</label>
                                                <input type="text" class="form-control" id="txt_c_telefono_1" name="txt_c_telefono_1" placeholder="Tel. o Cel.">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="t_{{$tipoServicio[2]}}" class="tab-pane fade">
                                    <div class="row margin-top-20">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Location</label>
                                                <select class="form-control" id="txt_localizacion_2" name="txt_localizacion_2">
                                                    @foreach($destinations as $destination)
                                                        <option value="{{$destination->destino}}">{{$destination->destino}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Ruc</label>
                                                <input type="text" class="form-control" id="txt_ruc_2" name="txt_ruc_2" placeholder="Ruc">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_type">Razon social</label>
                                                <input type="text" class="form-control" id="txt_razon_social_2" name="txt_razon_social_2" placeholder="Razon social">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_precio">Direccion</label>
                                                <input type="text" class="form-control" id="txt_direccion_2" name="txt_direccion_2" placeholder="Direccion">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_product">Telefono</label>
                                                <input type="text" class="form-control" id="txt_telefono_2" name="txt_telefono_2" placeholder="Telefono">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_code">Celular</label>
                                                <input type="text" class="form-control" id="txt_celular_2" name="txt_celular_2" placeholder="Celular">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Email</label>
                                                <input type="email" class="form-control" id="txt_email_2" name="txt_email_2" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Reservas Contacto</label>
                                                <input type="text" class="form-control" id="txt_r_nombres_2" name="txt_r_nombres_2" placeholder="Nombres, apellidos">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Reservas Tel/Cel</label>
                                                <input type="text" class="form-control" id="txt_r_telefono_2" name="txt_r_telefono_2" placeholder="Tel. o Cel.">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Contabilidad Contacto</label>
                                                <input type="text" class="form-control" id="txt_c_nombres_2" name="txt_c_nombres_2" placeholder="Nombres, apellidos">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Contabilidad Tel/Cel</label>
                                                <input type="text" class="form-control" id="txt_c_telefono_2" name="txt_c_telefono_2" placeholder="Tel. o Cel.">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="t_{{$tipoServicio[3]}}" class="tab-pane fade">
                                    <div class="row margin-top-20">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Location</label>
                                                <select class="form-control" id="txt_localizacion_3" name="txt_localizacion_3">
                                                    @foreach($destinations as $destination)
                                                        <option value="{{$destination->destino}}">{{$destination->destino}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Ruc</label>
                                                <input type="text" class="form-control" id="txt_ruc_3" name="txt_ruc_3" placeholder="Ruc">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_type">Razon social</label>
                                                <input type="text" class="form-control" id="txt_razon_social_3" name="txt_razon_social_3" placeholder="Razon social">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_precio">Direccion</label>
                                                <input type="text" class="form-control" id="txt_direccion_3" name="txt_direccion_3" placeholder="Direccion">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_product">Telefono</label>
                                                <input type="text" class="form-control" id="txt_telefono_3" name="txt_telefono_3" placeholder="Telefono">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_code">Celular</label>
                                                <input type="text" class="form-control" id="txt_celular_3" name="txt_celular_3" placeholder="Celular">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Email</label>
                                                <input type="email" class="form-control" id="txt_email_3" name="txt_email_3" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Reservas Contacto</label>
                                                <input type="text" class="form-control" id="txt_r_nombres_3" name="txt_r_nombres_3" placeholder="Nombres, apellidos">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Reservas Tel/Cel</label>
                                                <input type="text" class="form-control" id="txt_r_telefono_3" name="txt_r_telefono_3" placeholder="Tel. o Cel.">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Contabilidad Contacto</label>
                                                <input type="text" class="form-control" id="txt_c_nombres_3" name="txt_c_nombres_3" placeholder="Nombres, apellidos">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Contabilidad Tel/Cel</label>
                                                <input type="text" class="form-control" id="txt_c_telefono_3" name="txt_c_telefono_3" placeholder="Tel. o Cel.">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="t_{{$tipoServicio[4]}}" class="tab-pane fade">
                                    <div class="row margin-top-20">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Location</label>
                                                <select class="form-control" id="txt_localizacion_4" name="txt_localizacion_4">
                                                    @foreach($destinations as $destination)
                                                        <option value="{{$destination->destino}}">{{$destination->destino}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Ruc</label>
                                                <input type="text" class="form-control" id="txt_ruc_4" name="txt_ruc_4" placeholder="Ruc">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_type">Razon social</label>
                                                <input type="text" class="form-control" id="txt_razon_social_4" name="txt_razon_social_4" placeholder="Razon social">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_precio">Direccion</label>
                                                <input type="text" class="form-control" id="txt_direccion_4" name="txt_direccion_4" placeholder="Direccion">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_product">Telefono</label>
                                                <input type="text" class="form-control" id="txt_telefono_4" name="txt_telefono_4" placeholder="Telefono">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_code">Celular</label>
                                                <input type="text" class="form-control" id="txt_celular_4" name="txt_celular_4" placeholder="Celular">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Email</label>
                                                <input type="email" class="form-control" id="txt_email_4" name="txt_email_4" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Reservas Contacto</label>
                                                <input type="text" class="form-control" id="txt_r_nombres_4" name="txt_r_nombres_4" placeholder="Nombres, apellidos">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Reservas Tel/Cel</label>
                                                <input type="text" class="form-control" id="txt_r_telefono_4" name="txt_r_telefono_4" placeholder="Tel. o Cel.">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Contabilidad Contacto</label>
                                                <input type="text" class="form-control" id="txt_c_nombres_4" name="txt_c_nombres_4" placeholder="Nombres, apellidos">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Contabilidad Tel/Cel</label>
                                                <input type="text" class="form-control" id="txt_c_telefono_4" name="txt_c_telefono_4" placeholder="Tel. o Cel.">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="t_{{$tipoServicio[5]}}" class="tab-pane fade">
                                    <div class="row margin-top-20">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Location</label>
                                                <select class="form-control" id="txt_localizacion_5" name="txt_localizacion_5">
                                                    @foreach($destinations as $destination)
                                                        <option value="{{$destination->destino}}">{{$destination->destino}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Ruc</label>
                                                <input type="text" class="form-control" id="txt_ruc_5" name="txt_ruc_5" placeholder="Ruc">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_type">Razon social</label>
                                                <input type="text" class="form-control" id="txt_razon_social_5" name="txt_razon_social_5" placeholder="Razon social">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_precio">Direccion</label>
                                                <input type="text" class="form-control" id="txt_direccion_5" name="txt_direccion_5" placeholder="Direccion">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_product">Telefono</label>
                                                <input type="text" class="form-control" id="txt_telefono_5" name="txt_telefono_5" placeholder="Telefono">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_code">Celular</label>
                                                <input type="text" class="form-control" id="txt_celular_5" name="txt_celular_5" placeholder="Celular">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Email</label>
                                                <input type="email" class="form-control" id="txt_email_5" name="txt_email_5" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Reservas Contacto</label>
                                                <input type="text" class="form-control" id="txt_r_nombres_5" name="txt_r_nombres_5" placeholder="Nombres, apellidos">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Reservas Tel/Cel</label>
                                                <input type="text" class="form-control" id="txt_r_telefono_5" name="txt_r_telefono_5" placeholder="Tel. o Cel.">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Contabilidad Contacto</label>
                                                <input type="text" class="form-control" id="txt_c_nombres_5" name="txt_c_nombres_5" placeholder="Nombres, apellidos">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Contabilidad Tel/Cel</label>
                                                <input type="text" class="form-control" id="txt_c_telefono_5" name="txt_c_telefono_5" placeholder="Tel. o Cel.">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="t_{{$tipoServicio[6]}}" class="tab-pane fade">
                                    <div class="row margin-top-20">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Location</label>
                                                <select class="form-control" id="txt_localizacion_6" name="txt_localizacion_6">
                                                    @foreach($destinations as $destination)
                                                        <option value="{{$destination->destino}}">{{$destination->destino}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Ruc</label>
                                                <input type="text" class="form-control" id="txt_ruc_6" name="txt_ruc_6" placeholder="Ruc">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_type">Razon social</label>
                                                <input type="text" class="form-control" id="txt_razon_social_6" name="txt_razon_social_6" placeholder="Razon social">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_precio">Direccion</label>
                                                <input type="text" class="form-control" id="txt_direccion_6" name="txt_direccion_6" placeholder="Direccion">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_product">Telefono</label>
                                                <input type="text" class="form-control" id="txt_telefono_6" name="txt_telefono_6" placeholder="Telefono">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_code">Celular</label>
                                                <input type="text" class="form-control" id="txt_celular_6" name="txt_celular_6" placeholder="Celular">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Email</label>
                                                <input type="email" class="form-control" id="txt_email_6" name="txt_email_6" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Reservas Contacto</label>
                                                <input type="text" class="form-control" id="txt_r_nombres_6" name="txt_r_nombres_6" placeholder="Nombres, apellidos">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Reservas Tel/Cel</label>
                                                <input type="text" class="form-control" id="txt_r_telefono_6" name="txt_r_telefono_6" placeholder="Tel. o Cel.">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Contabilidad Contacto</label>
                                                <input type="text" class="form-control" id="txt_c_nombres_6" name="txt_c_nombres_6" placeholder="Nombres, apellidos">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Contabilidad Tel/Cel</label>
                                                <input type="text" class="form-control" id="txt_c_telefono_6" name="txt_c_telefono_6" placeholder="Tel. o Cel.">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="t_{{$tipoServicio[7]}}" class="tab-pane fade">
                                    <div class="row margin-top-20">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Location</label>
                                                <select class="form-control" id="txt_localizacion_7" name="txt_localizacion_7">
                                                    @foreach($destinations as $destination)
                                                        <option value="{{$destination->destino}}">{{$destination->destino}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Ruc</label>
                                                <input type="text" class="form-control" id="txt_ruc_7" name="txt_ruc_7" placeholder="Ruc">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_type">Razon social</label>
                                                <input type="text" class="form-control" id="txt_razon_social_7" name="txt_razon_social_7" placeholder="Razon social">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_precio">Direccion</label>
                                                <input type="text" class="form-control" id="txt_direccion_7" name="txt_direccion_7" placeholder="Direccion">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_product">Telefono</label>
                                                <input type="text" class="form-control" id="txt_telefono_7" name="txt_telefono_7" placeholder="Telefono">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_code">Celular</label>
                                                <input type="text" class="form-control" id="txt_celular_7" name="txt_celular_7" placeholder="Celular">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Email</label>
                                                <input type="email" class="form-control" id="txt_email_7" name="txt_email_7" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Reservas Contacto</label>
                                                <input type="text" class="form-control" id="txt_r_nombres_7" name="txt_r_nombres_7" placeholder="Nombres, apellidos">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Reservas Tel/Cel</label>
                                                <input type="text" class="form-control" id="txt_r_telefono_7" name="txt_r_telefono_7" placeholder="Tel. o Cel.">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Contabilidad Contacto</label>
                                                <input type="text" class="form-control" id="txt_c_nombres_7" name="txt_c_nombres_7" placeholder="Nombres, apellidos">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Contabilidad Tel/Cel</label>
                                                <input type="text" class="form-control" id="txt_c_telefono_7" name="txt_c_telefono_7" placeholder="Tel. o Cel.">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="t_{{$tipoServicio[8]}}" class="tab-pane fade">
                                    <div class="row margin-top-20">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Location</label>
                                                <select class="form-control" id="txt_localizacion_8" name="txt_localizacion_8">
                                                    @foreach($destinations as $destination)
                                                        <option value="{{$destination->destino}}">{{$destination->destino}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Ruc</label>
                                                <input type="text" class="form-control" id="txt_ruc_8" name="txt_ruc_8" placeholder="Ruc">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_type">Razon social</label>
                                                <input type="text" class="form-control" id="txt_razon_social_8" name="txt_razon_social_8" placeholder="Razon social">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_precio">Direccion</label>
                                                <input type="text" class="form-control" id="txt_direccion_8" name="txt_direccion_8" placeholder="Direccion">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_product">Telefono</label>
                                                <input type="text" class="form-control" id="txt_telefono_8" name="txt_telefono_8" placeholder="Telefono">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_code">Celular</label>
                                                <input type="text" class="form-control" id="txt_celular_8" name="txt_celular_8" placeholder="Celular">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Email</label>
                                                <input type="email" class="form-control" id="txt_email_6" name="txt_email_6" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Reservas Contacto</label>
                                                <input type="text" class="form-control" id="txt_r_nombres_8" name="txt_r_nombres_8" placeholder="Nombres, apellidos">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Reservas Tel/Cel</label>
                                                <input type="text" class="form-control" id="txt_r_telefono_8" name="txt_r_telefono_8" placeholder="Tel. o Cel.">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Contabilidad Contacto</label>
                                                <input type="text" class="form-control" id="txt_c_nombres_8" name="txt_c_nombres_8" placeholder="Nombres, apellidos">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_price">Contabilidad Tel/Cel</label>
                                                <input type="text" class="form-control" id="txt_c_telefono_8" name="txt_c_telefono_8" placeholder="Tel. o Cel.">
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
        <div class="col-lg-12">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tl_{{$tipoServicio[0]}}">{{$tipoServicio[0]}}</a></li>
                <li><a data-toggle="tab" href="#tl_{{$tipoServicio[1]}}" >{{$tipoServicio[1]}}</a></li>
                <li><a data-toggle="tab" href="#tl_{{$tipoServicio[2]}}" >{{$tipoServicio[2]}}</a></li>
                <li><a data-toggle="tab" href="#tl_{{$tipoServicio[3]}}" >{{$tipoServicio[3]}}</a></li>
                <li><a data-toggle="tab" href="#tl_{{$tipoServicio[4]}}" >{{$tipoServicio[4]}}</a></li>
                <li><a data-toggle="tab" href="#tl_{{$tipoServicio[5]}}" >{{$tipoServicio[5]}}</a></li>
                <li><a data-toggle="tab" href="#tl_{{$tipoServicio[6]}}" >{{$tipoServicio[6]}}</a></li>
                <li><a data-toggle="tab" href="#tl_{{$tipoServicio[7]}}" >{{$tipoServicio[7]}}</a></li>
                <li><a data-toggle="tab" href="#tl_{{$tipoServicio[8]}}" >{{$tipoServicio[8]}}</a></li>
            </ul>
            <div class="tab-content">
                <div id="tl_{{$tipoServicio[0]}}" class="tab-pane fade in active">
                    <div class="margin-top-20">
                        <table id="tb_{{$tipoServicio[0]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Location</th>
                                <th>Codigo</th>
                                <th>Ruc</th>
                                <th>Razon social</th>
                                <th>Direccion</th>
                                <th>Tel./Cel.</th>
                                <th>Email</th>
                                <th>Reservas</th>
                                <th>Contabilidad</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Location</th>
                                <th>Codigo</th>
                                <th>Ruc</th>
                                <th>Razon social</th>
                                <th>Direccion</th>
                                <th>Tel./Cel.</th>
                                <th>Email</th>
                                <th>Reservas</th>
                                <th>Contabilidad</th>
                                <th>Operations</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($providers as $provider)
                                @if($tipoServicio[0]==$provider->grupo)
                                    <tr id="lista_provider_{{$provider->id}}">
                                        <td>{{$provider->localizacion}}</td>
                                        <td>{{$provider->codigo}}</td>
                                        <td>{{$provider->ruc}}</td>
                                        <td>{{$provider->razon_social}}</td>
                                        <td>{{$provider->direccion}}</td>
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
                <div id="tl_{{$tipoServicio[1]}}" class="tab-pane fade">
                    <div class="margin-top-20">
                        <table id="tb_{{$tipoServicio[1]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Location</th>
                                <th>Codigo</th>
                                <th>Ruc</th>
                                <th>Razon social</th>
                                <th>Direccion</th>
                                <th>Tel./Cel.</th>
                                <th>Email</th>
                                <th>Reservas</th>
                                <th>Contabilidad</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Location</th>
                                <th>Codigo</th>
                                <th>Ruc</th>
                                <th>Razon social</th>
                                <th>Direccion</th>
                                <th>Tel./Cel.</th>
                                <th>Email</th>
                                <th>Reservas</th>
                                <th>Contabilidad</th>
                                <th>Operations</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($providers as $provider)
                                @if($tipoServicio[1]==$provider->grupo)
                                    <tr id="lista_provider_{{$provider->id}}">
                                        <td>{{$provider->localizacion}}</td>
                                        <td>{{$provider->codigo}}</td>
                                        <td>{{$provider->ruc}}</td>
                                        <td>{{$provider->razon_social}}</td>
                                        <td>{{$provider->direccion}}</td>
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
                <div id="tl_{{$tipoServicio[2]}}" class="tab-pane fade">
                    <div class="margin-top-20">
                        <table id="tb_{{$tipoServicio[2]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Location</th>
                                <th>Codigo</th>
                                <th>Ruc</th>
                                <th>Razon social</th>
                                <th>Direccion</th>
                                <th>Tel./Cel.</th>
                                <th>Email</th>
                                <th>Reservas</th>
                                <th>Contabilidad</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Location</th>
                                <th>Codigo</th>
                                <th>Ruc</th>
                                <th>Razon social</th>
                                <th>Direccion</th>
                                <th>Tel./Cel.</th>
                                <th>Email</th>
                                <th>Reservas</th>
                                <th>Contabilidad</th>
                                <th>Operations</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($providers as $provider)
                                @if($tipoServicio[2]==$provider->grupo)
                                    <tr id="lista_provider_{{$provider->id}}">
                                        <td>{{$provider->localizacion}}</td>
                                        <td>{{$provider->codigo}}</td>
                                        <td>{{$provider->ruc}}</td>
                                        <td>{{$provider->razon_social}}</td>
                                        <td>{{$provider->direccion}}</td>
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
                <div id="tl_{{$tipoServicio[3]}}" class="tab-pane fade">
                    <div class="margin-top-20">
                        <table id="tb_{{$tipoServicio[3]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Location</th>
                                <th>Codigo</th>
                                <th>Ruc</th>
                                <th>Razon social</th>
                                <th>Direccion</th>
                                <th>Tel./Cel.</th>
                                <th>Email</th>
                                <th>Reservas</th>
                                <th>Contabilidad</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Location</th>
                                <th>Codigo</th>
                                <th>Ruc</th>
                                <th>Razon social</th>
                                <th>Direccion</th>
                                <th>Tel./Cel.</th>
                                <th>Email</th>
                                <th>Reservas</th>
                                <th>Contabilidad</th>
                                <th>Operations</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($providers as $provider)
                                @if($tipoServicio[3]==$provider->grupo)
                                    <tr id="lista_provider_{{$provider->id}}">
                                        <td>{{$provider->localizacion}}</td>
                                        <td>{{$provider->codigo}}</td>
                                        <td>{{$provider->ruc}}</td>
                                        <td>{{$provider->razon_social}}</td>
                                        <td>{{$provider->direccion}}</td>
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
                <div id="tl_{{$tipoServicio[4]}}" class="tab-pane fade">
                    <div class="margin-top-20">
                        <table id="tb_{{$tipoServicio[4]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Location</th>
                                <th>Codigo</th>
                                <th>Ruc</th>
                                <th>Razon social</th>
                                <th>Direccion</th>
                                <th>Tel./Cel.</th>
                                <th>Email</th>
                                <th>Reservas</th>
                                <th>Contabilidad</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Location</th>
                                <th>Codigo</th>
                                <th>Ruc</th>
                                <th>Razon social</th>
                                <th>Direccion</th>
                                <th>Tel./Cel.</th>
                                <th>Email</th>
                                <th>Reservas</th>
                                <th>Contabilidad</th>
                                <th>Operations</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($providers as $provider)
                                @if($tipoServicio[4]==$provider->grupo)
                                    <tr id="lista_provider_{{$provider->id}}">
                                        <td>{{$provider->localizacion}}</td>
                                        <td>{{$provider->codigo}}</td>
                                        <td>{{$provider->ruc}}</td>
                                        <td>{{$provider->razon_social}}</td>
                                        <td>{{$provider->direccion}}</td>
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
                <div id="tl_{{$tipoServicio[5]}}" class="tab-pane fade">
                    <div class="margin-top-20">
                        <table id="tb_{{$tipoServicio[5]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Location</th>
                                <th>Codigo</th>
                                <th>Ruc</th>
                                <th>Razon social</th>
                                <th>Direccion</th>
                                <th>Tel./Cel.</th>
                                <th>Email</th>
                                <th>Reservas</th>
                                <th>Contabilidad</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Location</th>
                                <th>Codigo</th>
                                <th>Ruc</th>
                                <th>Razon social</th>
                                <th>Direccion</th>
                                <th>Tel./Cel.</th>
                                <th>Email</th>
                                <th>Reservas</th>
                                <th>Contabilidad</th>
                                <th>Operations</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($providers as $provider)
                                @if($tipoServicio[5]==$provider->grupo)
                                    <tr id="lista_provider_{{$provider->id}}">
                                        <td>{{$provider->localizacion}}</td>
                                        <td>{{$provider->codigo}}</td>
                                        <td>{{$provider->ruc}}</td>
                                        <td>{{$provider->razon_social}}</td>
                                        <td>{{$provider->direccion}}</td>
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
                <div id="tl_{{$tipoServicio[6]}}" class="tab-pane fade">
                    <div class="margin-top-20">
                        <table id="tb_{{$tipoServicio[6]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Location</th>
                                <th>Codigo</th>
                                <th>Ruc</th>
                                <th>Razon social</th>
                                <th>Direccion</th>
                                <th>Tel./Cel.</th>
                                <th>Email</th>
                                <th>Reservas</th>
                                <th>Contabilidad</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Location</th>
                                <th>Codigo</th>
                                <th>Ruc</th>
                                <th>Razon social</th>
                                <th>Direccion</th>
                                <th>Tel./Cel.</th>
                                <th>Email</th>
                                <th>Reservas</th>
                                <th>Contabilidad</th>
                                <th>Operations</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($providers as $provider)
                                @if($tipoServicio[6]==$provider->grupo)
                                    <tr id="lista_provider_{{$provider->id}}">
                                        <td>{{$provider->localizacion}}</td>
                                        <td>{{$provider->codigo}}</td>
                                        <td>{{$provider->ruc}}</td>
                                        <td>{{$provider->razon_social}}</td>
                                        <td>{{$provider->direccion}}</td>
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
                <div id="tl_{{$tipoServicio[7]}}" class="tab-pane fade">
                    <div class="margin-top-20">
                        <table id="tb_{{$tipoServicio[7]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Location</th>
                                <th>Codigo</th>
                                <th>Ruc</th>
                                <th>Razon social</th>
                                <th>Direccion</th>
                                <th>Tel./Cel.</th>
                                <th>Email</th>
                                <th>Reservas</th>
                                <th>Contabilidad</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Location</th>
                                <th>Codigo</th>
                                <th>Ruc</th>
                                <th>Razon social</th>
                                <th>Direccion</th>
                                <th>Tel./Cel.</th>
                                <th>Email</th>
                                <th>Reservas</th>
                                <th>Contabilidad</th>
                                <th>Operations</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($providers as $provider)
                                @if($tipoServicio[7]==$provider->grupo)
                                    <tr id="lista_provider_{{$provider->id}}">
                                        <td>{{$provider->localizacion}}</td>
                                        <td>{{$provider->codigo}}</td>
                                        <td>{{$provider->ruc}}</td>
                                        <td>{{$provider->razon_social}}</td>
                                        <td>{{$provider->direccion}}</td>
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
                <div id="tl_{{$tipoServicio[8]}}" class="tab-pane fade">
                    <div class="margin-top-20">
                        <table id="tb_{{$tipoServicio[8]}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Location</th>
                                <th>Codigo</th>
                                <th>Ruc</th>
                                <th>Razon social</th>
                                <th>Direccion</th>
                                <th>Tel./Cel.</th>
                                <th>Email</th>
                                <th>Reservas</th>
                                <th>Contabilidad</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Location</th>
                                <th>Codigo</th>
                                <th>Ruc</th>
                                <th>Razon social</th>
                                <th>Direccion</th>
                                <th>Tel./Cel.</th>
                                <th>Email</th>
                                <th>Reservas</th>
                                <th>Contabilidad</th>
                                <th>Operations</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($providers as $provider)
                                @if($tipoServicio[8]==$provider->grupo)
                                    <tr id="lista_provider_{{$provider->id}}">
                                        <td>{{$provider->localizacion}}</td>
                                        <td>{{$provider->codigo}}</td>
                                        <td>{{$provider->ruc}}</td>
                                        <td>{{$provider->razon_social}}</td>
                                        <td>{{$provider->direccion}}</td>
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
                                    if($tipoServicio[0]==$provider->grupo){
                                        $pos=0;
                                        $act_menu0='active';
                                        $act_tabmenu0='in active';
                                    }
                                    if($tipoServicio[1]==$provider->grupo){
                                        $pos=1;
                                        $act_menu1='active';
                                        $act_tabmenu1='in active';
                                    }
                                    if($tipoServicio[2]==$provider->grupo){
                                        $pos=2;
                                        $act_menu2='active';
                                        $act_tabmenu2='in active';
                                    }
                                    if($tipoServicio[3]==$provider->grupo){
                                        $pos=3;
                                        $act_menu3='active';
                                        $act_tabmenu3='in active';
                                    }
                                    if($tipoServicio[4]==$provider->grupo){
                                        $pos=4;
                                        $act_menu4='active';
                                        $act_tabmenu4='in active';
                                    }
                                    if($tipoServicio[5]==$provider->grupo){
                                        $pos=5;
                                        $act_menu5='active';
                                        $act_tabmenu5='in active';
                                    }
                                    if($tipoServicio[6]==$provider->grupo){
                                        $pos=6;
                                        $act_menu6='active';
                                        $act_tabmenu6='in active';
                                    }
                                    if($tipoServicio[7]==$provider->grupo){
                                        $pos=7;
                                        $act_menu7='active';
                                        $act_tabmenu7='in active';
                                    }
                                    if($tipoServicio[8]==$provider->grupo){
                                        $pos=8;
                                        $act_menu8='active';
                                        $act_tabmenu8='in active';
                                    }
                                    ?>
                                    <div class="modal-body">
                                        <ul class="nav nav-tabs">
                                            <li class="<?php echo $act_menu0;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[0]}}_{{$provider->id}}" onclick="escojerPosEdit_cost('{{$provider->id}}','0')">{{$tipoServicio[0]}}</a></li>
                                            <li class="<?php echo $act_menu1;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[1]}}_{{$provider->id}}" onclick="escojerPosEdit_cost('{{$provider->id}}','1')">{{$tipoServicio[1]}}</a></li>
                                            <li class="<?php echo $act_menu2;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[2]}}_{{$provider->id}}" onclick="escojerPosEdit_cost('{{$provider->id}}','2')">{{$tipoServicio[2]}}</a></li>
                                            <li class="<?php echo $act_menu3;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[3]}}_{{$provider->id}}" onclick="escojerPosEdit_cost('{{$provider->id}}','3')">{{$tipoServicio[3]}}</a></li>
                                            <li class="<?php echo $act_menu4;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[4]}}_{{$provider->id}}" onclick="escojerPosEdit_cost('{{$provider->id}}','4')">{{$tipoServicio[4]}}</a></li>
                                            <li class="<?php echo $act_menu5;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[5]}}_{{$provider->id}}" onclick="escojerPosEdit_cost('{{$provider->id}}','5')">{{$tipoServicio[5]}}</a></li>
                                            <li class="<?php echo $act_menu6;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[6]}}_{{$provider->id}}" onclick="escojerPosEdit_cost('{{$provider->id}}','6')">{{$tipoServicio[6]}}</a></li>
                                            <li class="<?php echo $act_menu7;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[7]}}_{{$provider->id}}" onclick="escojerPosEdit_cost('{{$provider->id}}','7')">{{$tipoServicio[7]}}</a></li>
                                            <li class="<?php echo $act_menu8;?>"><a data-toggle="tab" href="#e_{{$tipoServicio[8]}}_{{$provider->id}}" onclick="escojerPosEdit_cost('{{$provider->id}}','8')">{{$tipoServicio[8]}}</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="e_{{$tipoServicio[0]}}_{{$provider->id}}" class="tab-pane fade <?php echo $act_tabmenu0;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <select class="form-control" id="txt_localizacion_0" name="txt_localizacion_0">
                                                                @foreach($destinations as $destination)
                                                                    <option value="{{$destination->destino}}" <?php if($tipoServicio[0]==$provider->grupo){if($provider->localizacion==$destination->destino) echo 'selected';}?>>{{$destination->destino}}</option>
                                                                @endforeach
                                                            </select>
                                                            <input type="hidden" name="tipoServicio_0" id="tipoServicio_0" value="{{$tipoServicio[0]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Ruc</label>
                                                            <input type="text" class="form-control" id="txt_ruc_0" name="txt_ruc_0" placeholder="Ruc"  value="<?php if($tipoServicio[0]==$provider->grupo) echo $provider->ruc;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Razon social</label>
                                                            <input type="text" class="form-control" id="txt_razon_social_0" name="txt_razon_social_0" placeholder="Razon social" value="<?php if($tipoServicio[0]==$provider->grupo) echo $provider->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Direccion</label>
                                                            <input type="text" class="form-control" id="txt_direccion_0" name="txt_direccion_0" placeholder="Direccion" value="<?php if($tipoServicio[0]==$provider->grupo) echo $provider->direccion;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Telefono</label>
                                                            <input type="text" class="form-control" id="txt_telefono_0" name="txt_telefono_0" placeholder="Telefono" value="<?php if($tipoServicio[0]==$provider->grupo) echo $provider->telefono;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Celular</label>
                                                            <input type="text" class="form-control" id="txt_celular_0" name="txt_celular_0" placeholder="Celular" value="<?php if($tipoServicio[0]==$provider->grupo) echo $provider->celular;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Email</label>
                                                            <input type="email" class="form-control" id="txt_email_0" name="txt_email_0" placeholder="Email" value="<?php if($tipoServicio[0]==$provider->grupo) echo $provider->email;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Reservas Contacto</label>
                                                            <input type="text" class="form-control" id="txt_r_nombres_0" name="txt_r_nombres_0" placeholder="Nombres, apellidos" value="<?php if($tipoServicio[0]==$provider->grupo) echo $provider->r_nombres;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Reservas Tel/Cel</label>
                                                            <input type="text" class="form-control" id="txt_r_telefono_0" name="txt_r_telefono_0" placeholder="Tel. o Cel." value="<?php if($tipoServicio[0]==$provider->grupo) echo $provider->r_telefono;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Contabilidad Contacto</label>
                                                            <input type="text" class="form-control" id="txt_c_nombres_0" name="txt_c_nombres_0" placeholder="Nombres, apellidos" value="<?php if($tipoServicio[0]==$provider->grupo) echo $provider->c_nombres;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Contabilidad Tel/Cel</label>
                                                            <input type="text" class="form-control" id="txt_c_telefono_0" name="txt_c_telefono_0" placeholder="Tel. o Cel." value="<?php if($tipoServicio[0]==$provider->grupo) echo $provider->c_telefono;?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[1]}}_{{$provider->id}}" class="tab-pane fade <?php echo $act_tabmenu1;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <select class="form-control" id="txt_localizacion_1" name="txt_localizacion_1">
                                                                @foreach($destinations as $destination)
                                                                    <option value="{{$destination->destino}}" <?php if($tipoServicio[1]==$provider->grupo){if($provider->localizacion==$destination->destino) echo 'selected';}?>>{{$destination->destino}}</option>
                                                                @endforeach
                                                            </select>
                                                            <input type="hidden" name="tipoServicio_1" id="tipoServicio_1" value="{{$tipoServicio[1]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Ruc</label>
                                                            <input type="text" class="form-control" id="txt_ruc_1" name="txt_ruc_1" placeholder="Ruc"  value="<?php if($tipoServicio[1]==$provider->grupo) echo $provider->ruc;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Razon social</label>
                                                            <input type="text" class="form-control" id="txt_razon_social_1" name="txt_razon_social_1" placeholder="Razon social" value="<?php if($tipoServicio[1]==$provider->grupo) echo $provider->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Direccion</label>
                                                            <input type="text" class="form-control" id="txt_direccion_1" name="txt_direccion_1" placeholder="Direccion" value="<?php if($tipoServicio[1]==$provider->grupo) echo $provider->direccion;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Telefono</label>
                                                            <input type="text" class="form-control" id="txt_telefono_1" name="txt_telefono_1" placeholder="Telefono" value="<?php if($tipoServicio[1]==$provider->grupo) echo $provider->telefono;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Celular</label>
                                                            <input type="text" class="form-control" id="txt_celular_1" name="txt_celular_1" placeholder="Celular" value="<?php if($tipoServicio[1]==$provider->grupo) echo $provider->celular;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Email</label>
                                                            <input type="email" class="form-control" id="txt_email_1" name="txt_email_1" placeholder="Email" value="<?php if($tipoServicio[1]==$provider->grupo) echo $provider->email;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Reservas Contacto</label>
                                                            <input type="text" class="form-control" id="txt_r_nombres_1" name="txt_r_nombres_1" placeholder="Nombres, apellidos" value="<?php if($tipoServicio[1]==$provider->grupo) echo $provider->r_nombres;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Reservas Tel/Cel</label>
                                                            <input type="text" class="form-control" id="txt_r_telefono_1" name="txt_r_telefono_1" placeholder="Tel. o Cel." value="<?php if($tipoServicio[1]==$provider->grupo) echo $provider->r_telefono;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Contabilidad Contacto</label>
                                                            <input type="text" class="form-control" id="txt_c_nombres_1" name="txt_c_nombres_1" placeholder="Nombres, apellidos" value="<?php if($tipoServicio[1]==$provider->grupo) echo $provider->c_nombres;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Contabilidad Tel/Cel</label>
                                                            <input type="text" class="form-control" id="txt_c_telefono_1" name="txt_c_telefono_1" placeholder="Tel. o Cel." value="<?php if($tipoServicio[1]==$provider->grupo) echo $provider->c_telefono;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[2]}}_{{$provider->id}}" class="tab-pane fade <?php echo $act_tabmenu2;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <select class="form-control" id="txt_localizacion_2" name="txt_localizacion_2">
                                                                @foreach($destinations as $destination)
                                                                    <option value="{{$destination->destino}}" <?php if($tipoServicio[2]==$provider->grupo){if($provider->localizacion==$destination->destino) echo 'selected';}?>>{{$destination->destino}}</option>
                                                                @endforeach
                                                            </select>
                                                            <input type="hidden" name="tipoServicio_0" id="tipoServicio_0" value="{{$tipoServicio[2]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Ruc</label>
                                                            <input type="text" class="form-control" id="txt_ruc_2" name="txt_ruc_2" placeholder="Ruc"  value="<?php if($tipoServicio[2]==$provider->grupo) echo $provider->ruc;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Razon social</label>
                                                            <input type="text" class="form-control" id="txt_razon_social_2" name="txt_razon_social_2" placeholder="Razon social" value="<?php if($tipoServicio[2]==$provider->grupo) echo $provider->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Direccion</label>
                                                            <input type="text" class="form-control" id="txt_direccion_2" name="txt_direccion_2" placeholder="Direccion" value="<?php if($tipoServicio[2]==$provider->grupo) echo $provider->direccion;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Telefono</label>
                                                            <input type="text" class="form-control" id="txt_telefono_2" name="txt_telefono_2" placeholder="Telefono" value="<?php if($tipoServicio[2]==$provider->grupo) echo $provider->telefono;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Celular</label>
                                                            <input type="text" class="form-control" id="txt_celular_2" name="txt_celular_2" placeholder="Celular" value="<?php if($tipoServicio[2]==$provider->grupo) echo $provider->celular;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Email</label>
                                                            <input type="email" class="form-control" id="txt_email_2" name="txt_email_2" placeholder="Email" value="<?php if($tipoServicio[2]==$provider->grupo) echo $provider->email;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Reservas Contacto</label>
                                                            <input type="text" class="form-control" id="txt_r_nombres_2" name="txt_r_nombres_2" placeholder="Nombres, apellidos" value="<?php if($tipoServicio[2]==$provider->grupo) echo $provider->r_nombres;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Reservas Tel/Cel</label>
                                                            <input type="text" class="form-control" id="txt_r_telefono_2" name="txt_r_telefono_2" placeholder="Tel. o Cel." value="<?php if($tipoServicio[2]==$provider->grupo) echo $provider->r_telefono;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Contabilidad Contacto</label>
                                                            <input type="text" class="form-control" id="txt_c_nombres_2" name="txt_c_nombres_2" placeholder="Nombres, apellidos" value="<?php if($tipoServicio[2]==$provider->grupo) echo $provider->c_nombres;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Contabilidad Tel/Cel</label>
                                                            <input type="text" class="form-control" id="txt_c_telefono_2" name="txt_c_telefono_2" placeholder="Tel. o Cel." value="<?php if($tipoServicio[2]==$provider->grupo) echo $provider->c_telefono;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[3]}}_{{$provider->id}}" class="tab-pane fade <?php echo $act_tabmenu3;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <select class="form-control" id="txt_localizacion_3" name="txt_localizacion_3">
                                                                @foreach($destinations as $destination)
                                                                    <option value="{{$destination->destino}}" <?php if($tipoServicio[3]==$provider->grupo){if($provider->localizacion==$destination->destino) echo 'selected';}?>>{{$destination->destino}}</option>
                                                                @endforeach
                                                            </select>
                                                            <input type="hidden" name="tipoServicio_3" id="tipoServicio_3" value="{{$tipoServicio[3]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Ruc</label>
                                                            <input type="text" class="form-control" id="txt_ruc_3" name="txt_ruc_3" placeholder="Ruc"  value="<?php if($tipoServicio[3]==$provider->grupo) echo $provider->ruc;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Razon social</label>
                                                            <input type="text" class="form-control" id="txt_razon_social_3" name="txt_razon_social_3" placeholder="Razon social" value="<?php if($tipoServicio[3]==$provider->grupo) echo $provider->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Direccion</label>
                                                            <input type="text" class="form-control" id="txt_direccion_3" name="txt_direccion_3" placeholder="Direccion" value="<?php if($tipoServicio[3]==$provider->grupo) echo $provider->direccion;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Telefono</label>
                                                            <input type="text" class="form-control" id="txt_telefono_3" name="txt_telefono_3" placeholder="Telefono" value="<?php if($tipoServicio[3]==$provider->grupo) echo $provider->telefono;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Celular</label>
                                                            <input type="text" class="form-control" id="txt_celular_3" name="txt_celular_3" placeholder="Celular" value="<?php if($tipoServicio[3]==$provider->grupo) echo $provider->celular;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Email</label>
                                                            <input type="email" class="form-control" id="txt_email_3" name="txt_email_3" placeholder="Email" value="<?php if($tipoServicio[3]==$provider->grupo) echo $provider->email;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Reservas Contacto</label>
                                                            <input type="text" class="form-control" id="txt_r_nombres_3" name="txt_r_nombres_3" placeholder="Nombres, apellidos" value="<?php if($tipoServicio[3]==$provider->grupo) echo $provider->r_nombres;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Reservas Tel/Cel</label>
                                                            <input type="text" class="form-control" id="txt_r_telefono_3" name="txt_r_telefono_3" placeholder="Tel. o Cel." value="<?php if($tipoServicio[3]==$provider->grupo) echo $provider->r_telefono;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Contabilidad Contacto</label>
                                                            <input type="text" class="form-control" id="txt_c_nombres_3" name="txt_c_nombres_3" placeholder="Nombres, apellidos" value="<?php if($tipoServicio[3]==$provider->grupo) echo $provider->c_nombres;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Contabilidad Tel/Cel</label>
                                                            <input type="text" class="form-control" id="txt_c_telefono_3" name="txt_c_telefono_3" placeholder="Tel. o Cel." value="<?php if($tipoServicio[3]==$provider->grupo) echo $provider->c_telefono;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[4]}}_{{$provider->id}}" class="tab-pane fade <?php echo $act_tabmenu4;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <select class="form-control" id="txt_localizacion_4" name="txt_localizacion_4">
                                                                @foreach($destinations as $destination)
                                                                    <option value="{{$destination->destino}}" <?php if($tipoServicio[4]==$provider->grupo){if($provider->localizacion==$destination->destino) echo 'selected';}?>>{{$destination->destino}}</option>
                                                                @endforeach
                                                            </select>
                                                            <input type="hidden" name="tipoServicio_4" id="tipoServicio_4" value="{{$tipoServicio[4]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Ruc</label>
                                                            <input type="text" class="form-control" id="txt_ruc_4" name="txt_ruc_4" placeholder="Ruc"  value="<?php if($tipoServicio[4]==$provider->grupo) echo $provider->ruc;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Razon social</label>
                                                            <input type="text" class="form-control" id="txt_razon_social_4" name="txt_razon_social_4" placeholder="Razon social" value="<?php if($tipoServicio[4]==$provider->grupo) echo $provider->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Direccion</label>
                                                            <input type="text" class="form-control" id="txt_direccion_4" name="txt_direccion_4" placeholder="Direccion" value="<?php if($tipoServicio[4]==$provider->grupo) echo $provider->direccion;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Telefono</label>
                                                            <input type="text" class="form-control" id="txt_telefono_4" name="txt_telefono_4" placeholder="Telefono" value="<?php if($tipoServicio[4]==$provider->grupo) echo $provider->telefono;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Celular</label>
                                                            <input type="text" class="form-control" id="txt_celular_4" name="txt_celular_4" placeholder="Celular" value="<?php if($tipoServicio[4]==$provider->grupo) echo $provider->celular;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Email</label>
                                                            <input type="email" class="form-control" id="txt_email_4" name="txt_email_4" placeholder="Email" value="<?php if($tipoServicio[4]==$provider->grupo) echo $provider->email;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Reservas Contacto</label>
                                                            <input type="text" class="form-control" id="txt_r_nombres_4" name="txt_r_nombres_4" placeholder="Nombres, apellidos" value="<?php if($tipoServicio[4]==$provider->grupo) echo $provider->r_nombres;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Reservas Tel/Cel</label>
                                                            <input type="text" class="form-control" id="txt_r_telefono_4" name="txt_r_telefono_4" placeholder="Tel. o Cel." value="<?php if($tipoServicio[4]==$provider->grupo) echo $provider->r_telefono;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Contabilidad Contacto</label>
                                                            <input type="text" class="form-control" id="txt_c_nombres_4" name="txt_c_nombres_4" placeholder="Nombres, apellidos" value="<?php if($tipoServicio[4]==$provider->grupo) echo $provider->c_nombres;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Contabilidad Tel/Cel</label>
                                                            <input type="text" class="form-control" id="txt_c_telefono_4" name="txt_c_telefono_4" placeholder="Tel. o Cel." value="<?php if($tipoServicio[4]==$provider->grupo) echo $provider->c_telefono;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[5]}}_{{$provider->id}}" class="tab-pane fade <?php echo $act_tabmenu5;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <select class="form-control" id="txt_localizacion_5" name="txt_localizacion_5">
                                                                @foreach($destinations as $destination)
                                                                    <option value="{{$destination->destino}}" <?php if($tipoServicio[5]==$provider->grupo){if($provider->localizacion==$destination->destino) echo 'selected';}?>>{{$destination->destino}}</option>
                                                                @endforeach
                                                            </select>
                                                            <input type="hidden" name="tipoServicio_5" id="tipoServicio_5" value="{{$tipoServicio[5]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Ruc</label>
                                                            <input type="text" class="form-control" id="txt_ruc_5" name="txt_ruc_5" placeholder="Ruc"  value="<?php if($tipoServicio[5]==$provider->grupo) echo $provider->ruc;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Razon social</label>
                                                            <input type="text" class="form-control" id="txt_razon_social_5" name="txt_razon_social_5" placeholder="Razon social" value="<?php if($tipoServicio[5]==$provider->grupo) echo $provider->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Direccion</label>
                                                            <input type="text" class="form-control" id="txt_direccion_5" name="txt_direccion_5" placeholder="Direccion" value="<?php if($tipoServicio[5]==$provider->grupo) echo $provider->direccion;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Telefono</label>
                                                            <input type="text" class="form-control" id="txt_telefono_5" name="txt_telefono_5" placeholder="Telefono" value="<?php if($tipoServicio[5]==$provider->grupo) echo $provider->telefono;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Celular</label>
                                                            <input type="text" class="form-control" id="txt_celular_5" name="txt_celular_5" placeholder="Celular" value="<?php if($tipoServicio[5]==$provider->grupo) echo $provider->celular;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Email</label>
                                                            <input type="email" class="form-control" id="txt_email_5" name="txt_email_5" placeholder="Email" value="<?php if($tipoServicio[5]==$provider->grupo) echo $provider->email;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Reservas Contacto</label>
                                                            <input type="text" class="form-control" id="txt_r_nombres_5" name="txt_r_nombres_5" placeholder="Nombres, apellidos" value="<?php if($tipoServicio[5]==$provider->grupo) echo $provider->r_nombres;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Reservas Tel/Cel</label>
                                                            <input type="text" class="form-control" id="txt_r_telefono_5" name="txt_r_telefono_5" placeholder="Tel. o Cel." value="<?php if($tipoServicio[5]==$provider->grupo) echo $provider->r_telefono;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Contabilidad Contacto</label>
                                                            <input type="text" class="form-control" id="txt_c_nombres_5" name="txt_c_nombres_5" placeholder="Nombres, apellidos" value="<?php if($tipoServicio[5]==$provider->grupo) echo $provider->c_nombres;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Contabilidad Tel/Cel</label>
                                                            <input type="text" class="form-control" id="txt_c_telefono_5" name="txt_c_telefono_5" placeholder="Tel. o Cel." value="<?php if($tipoServicio[5]==$provider->grupo) echo $provider->c_telefono;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[6]}}_{{$provider->id}}" class="tab-pane fade <?php echo $act_tabmenu6;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <select class="form-control" id="txt_localizacion_6" name="txt_localizacion_6">
                                                                @foreach($destinations as $destination)
                                                                    <option value="{{$destination->destino}}" <?php if($tipoServicio[6]==$provider->grupo){if($provider->localizacion==$destination->destino) echo 'selected';}?>>{{$destination->destino}}</option>
                                                                @endforeach
                                                            </select>
                                                            <input type="hidden" name="tipoServicio_6" id="tipoServicio_6" value="{{$tipoServicio[6]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Ruc</label>
                                                            <input type="text" class="form-control" id="txt_ruc_6" name="txt_ruc_6" placeholder="Ruc"  value="<?php if($tipoServicio[6]==$provider->grupo) echo $provider->ruc;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Razon social</label>
                                                            <input type="text" class="form-control" id="txt_razon_social_6" name="txt_razon_social_6" placeholder="Razon social" value="<?php if($tipoServicio[6]==$provider->grupo) echo $provider->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Direccion</label>
                                                            <input type="text" class="form-control" id="txt_direccion_6" name="txt_direccion_6" placeholder="Direccion" value="<?php if($tipoServicio[6]==$provider->grupo) echo $provider->direccion;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Telefono</label>
                                                            <input type="text" class="form-control" id="txt_telefono_6" name="txt_telefono_6" placeholder="Telefono" value="<?php if($tipoServicio[6]==$provider->grupo) echo $provider->telefono;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Celular</label>
                                                            <input type="text" class="form-control" id="txt_celular_6" name="txt_celular_6" placeholder="Celular" value="<?php if($tipoServicio[6]==$provider->grupo) echo $provider->celular;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Email</label>
                                                            <input type="email" class="form-control" id="txt_email_6" name="txt_email_6" placeholder="Email" value="<?php if($tipoServicio[6]==$provider->grupo) echo $provider->email;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Reservas Contacto</label>
                                                            <input type="text" class="form-control" id="txt_r_nombres_6" name="txt_r_nombres_6" placeholder="Nombres, apellidos" value="<?php if($tipoServicio[6]==$provider->grupo) echo $provider->r_nombres;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Reservas Tel/Cel</label>
                                                            <input type="text" class="form-control" id="txt_r_telefono_6" name="txt_r_telefono_6" placeholder="Tel. o Cel." value="<?php if($tipoServicio[6]==$provider->grupo) echo $provider->r_telefono;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Contabilidad Contacto</label>
                                                            <input type="text" class="form-control" id="txt_c_nombres_6" name="txt_c_nombres_6" placeholder="Nombres, apellidos" value="<?php if($tipoServicio[6]==$provider->grupo) echo $provider->c_nombres;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Contabilidad Tel/Cel</label>
                                                            <input type="text" class="form-control" id="txt_c_telefono_6" name="txt_c_telefono_6" placeholder="Tel. o Cel." value="<?php if($tipoServicio[6]==$provider->grupo) echo $provider->c_telefono;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[7]}}_{{$provider->id}}" class="tab-pane fade <?php echo $act_tabmenu7;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <select class="form-control" id="txt_localizacion_7" name="txt_localizacion_7">
                                                                @foreach($destinations as $destination)
                                                                    <option value="{{$destination->destino}}" <?php if($tipoServicio[7]==$provider->grupo){if($provider->localizacion==$destination->destino) echo 'selected';}?>>{{$destination->destino}}</option>
                                                                @endforeach
                                                            </select>
                                                            <input type="hidden" name="tipoServicio_7" id="tipoServicio_7" value="{{$tipoServicio[7]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Ruc</label>
                                                            <input type="text" class="form-control" id="txt_ruc_7" name="txt_ruc_7" placeholder="Ruc"  value="<?php if($tipoServicio[7]==$provider->grupo) echo $provider->ruc;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Razon social</label>
                                                            <input type="text" class="form-control" id="txt_razon_social_7" name="txt_razon_social_7" placeholder="Razon social" value="<?php if($tipoServicio[7]==$provider->grupo) echo $provider->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Direccion</label>
                                                            <input type="text" class="form-control" id="txt_direccion_7" name="txt_direccion_7" placeholder="Direccion" value="<?php if($tipoServicio[7]==$provider->grupo) echo $provider->direccion;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Telefono</label>
                                                            <input type="text" class="form-control" id="txt_telefono_7" name="txt_telefono_7" placeholder="Telefono" value="<?php if($tipoServicio[7]==$provider->grupo) echo $provider->telefono;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Celular</label>
                                                            <input type="text" class="form-control" id="txt_celular_7" name="txt_celular_7" placeholder="Celular" value="<?php if($tipoServicio[7]==$provider->grupo) echo $provider->celular;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Email</label>
                                                            <input type="email" class="form-control" id="txt_email_7" name="txt_email_7" placeholder="Email" value="<?php if($tipoServicio[7]==$provider->grupo) echo $provider->email;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Reservas Contacto</label>
                                                            <input type="text" class="form-control" id="txt_r_nombres_7" name="txt_r_nombres_7" placeholder="Nombres, apellidos" value="<?php if($tipoServicio[7]==$provider->grupo) echo $provider->r_nombres;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Reservas Tel/Cel</label>
                                                            <input type="text" class="form-control" id="txt_r_telefono_7" name="txt_r_telefono_7" placeholder="Tel. o Cel." value="<?php if($tipoServicio[7]==$provider->grupo) echo $provider->r_telefono;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Contabilidad Contacto</label>
                                                            <input type="text" class="form-control" id="txt_c_nombres_7" name="txt_c_nombres_7" placeholder="Nombres, apellidos" value="<?php if($tipoServicio[7]==$provider->grupo) echo $provider->c_nombres;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Contabilidad Tel/Cel</label>
                                                            <input type="text" class="form-control" id="txt_c_telefono_7" name="txt_c_telefono_7" placeholder="Tel. o Cel." value="<?php if($tipoServicio[7]==$provider->grupo) echo $provider->c_telefono;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="e_{{$tipoServicio[8]}}_{{$provider->id}}" class="tab-pane fade <?php echo $act_tabmenu8;?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Location</label>
                                                            <select class="form-control" id="txt_localizacion_8" name="txt_localizacion_8">
                                                                @foreach($destinations as $destination)
                                                                    <option value="{{$destination->destino}}" <?php if($tipoServicio[8]==$provider->grupo){if($provider->localizacion==$destination->destino) echo 'selected';}?>>{{$destination->destino}}</option>
                                                                @endforeach
                                                            </select>
                                                            <input type="hidden" name="tipoServicio_8" id="tipoServicio_8" value="{{$tipoServicio[8]}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_codigo">Ruc</label>
                                                            <input type="text" class="form-control" id="txt_ruc_8" name="txt_ruc_8" placeholder="Ruc"  value="<?php if($tipoServicio[8]==$provider->grupo) echo $provider->ruc;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_type">Razon social</label>
                                                            <input type="text" class="form-control" id="txt_razon_social_8" name="txt_razon_social_8" placeholder="Razon social" value="<?php if($tipoServicio[8]==$provider->grupo) echo $provider->razon_social;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_precio">Direccion</label>
                                                            <input type="text" class="form-control" id="txt_direccion_8" name="txt_direccion_8" placeholder="Direccion" value="<?php if($tipoServicio[8]==$provider->grupo) echo $provider->direccion;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_product">Telefono</label>
                                                            <input type="text" class="form-control" id="txt_telefono_8" name="txt_telefono_8" placeholder="Telefono" value="<?php if($tipoServicio[8]==$provider->grupo) echo $provider->telefono;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_code">Celular</label>
                                                            <input type="text" class="form-control" id="txt_celular_8" name="txt_celular_8" placeholder="Celular" value="<?php if($tipoServicio[8]==$provider->grupo) echo $provider->celular;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Email</label>
                                                            <input type="email" class="form-control" id="txt_email_8" name="txt_email_8" placeholder="Email" value="<?php if($tipoServicio[8]==$provider->grupo) echo $provider->email;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Reservas Contacto</label>
                                                            <input type="text" class="form-control" id="txt_r_nombres_8" name="txt_r_nombres_8" placeholder="Nombres, apellidos" value="<?php if($tipoServicio[8]==$provider->grupo) echo $provider->r_nombres;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Reservas Tel/Cel</label>
                                                            <input type="text" class="form-control" id="txt_r_telefono_8" name="txt_r_telefono_8" placeholder="Tel. o Cel." value="<?php if($tipoServicio[8]==$provider->grupo) echo $provider->r_telefono;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Contabilidad Contacto</label>
                                                            <input type="text" class="form-control" id="txt_c_nombres_8" name="txt_c_nombres_8" placeholder="Nombres, apellidos" value="<?php if($tipoServicio[8]==$provider->grupo) echo $provider->c_nombres;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="txt_price">Contabilidad Tel/Cel</label>
                                                            <input type="text" class="form-control" id="txt_c_telefono_8" name="txt_c_telefono_8" placeholder="Tel. o Cel." value="<?php if($tipoServicio[8]==$provider->grupo) echo $provider->c_telefono;?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        {{csrf_field()}}
                                        <input type="hidden" name="posTipoEditcost_{{$provider->id}}" id="posTipoEditcost_{{$provider->id}}" value="{{$pos}}">
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