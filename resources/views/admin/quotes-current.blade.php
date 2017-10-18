@extends('layouts.admin.admin')
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
            <li>Quotes</li>
            <li class="active">Current</li>
        </ol>
    </div>
    <nav class="navbar navbar-light bg-primary">
        <span class="h1" class="navbar-brand"><b class="text-20 padding-15">Sale</b></span>
    </nav>
    <div class="row margin-top-20">
        <table id="example100" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Cliente</th>
                <th>Update</th>
                <th>Operaciones</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Cliente</th>
                <th>Update</th>
                <th>Operaciones</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($cotizacion->sortByDesc('created_at') as $cotizacion_)
                @if($cotizacion_->posibilidad==100)
                    <?php
                    $date = date_create($cotizacion_->fecha);
                    $fecha=date_format($date, 'jS F Y');
                    $titulo='';
                    ?>
                    <tr id="coti_new{{$cotizacion_->id}}">
                        <td>
                            @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                                @if($cliente_coti->estado=='1')
                                    <?php
                                    $titulo=$cliente_coti->cliente->nombres.' '.$cliente_coti->cliente->apellidos.' x '.$cotizacion_->nropersonas.' '.$fecha;
                                    ?>
                                    <a href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}">{{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizacion_->nropersonas}} {{$fecha}}</a>
                                @endif
                            @endforeach
                        </td>
                        <td>{{$cotizacion_->updated_at}}</td>
                        <td>
                            {{--<a href="" class="text-22 text-orange-goto"><i class="fa fa-trash" aria-hidden="true"></i></a>--}}
                            {{--<a href="" class="text-22 text-orange-goto"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>--}}
                            <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#modal_probabilidad_{{$cotizacion_->id}}">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button>
                            <button type="button" class="btn btn-danger" onclick="Eliminar_cotizacion('{{$cotizacion_->id}}','{{$titulo}}')" >
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </td>

                    </tr>
                @endif
            @endforeach

            </tbody>
        </table>
    </div>

    <nav class="navbar navbar-light bg-primary">
        <span class="h1" class="navbar-brand"><b class="text-20 padding-15">75 %</b></span>
    </nav>
    <div class="row margin-top-20">
        <table id="example75" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Cliente</th>
                <th>Update</th>
                <th>Operaciones</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Cliente</th>
                <th>Update</th>
                <th>Operaciones</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($cotizacion->sortByDesc('created_at') as $cotizacion_)
            @if($cotizacion_->posibilidad==75)
                <?php
                $date = date_create($cotizacion_->fecha);
                $fecha=date_format($date, 'jS F Y');
                $titulo='';
                ?>
                <tr id="coti_new{{$cotizacion_->id}}">
                    <td>
                        @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                            @if($cliente_coti->estado=='1')
                                <?php
                                $titulo=$cliente_coti->cliente->nombres.' '.$cliente_coti->cliente->apellidos.' x '.$cotizacion_->nropersonas.' '.$fecha;
                                ?>
                                <a href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}">{{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizacion_->nropersonas}} {{$fecha}}</a>
                            @endif
                        @endforeach
                    </td>
                    <td>{{$cotizacion_->updated_at}}</td>
                    <td>
                        {{--<a href="" class="text-22 text-orange-goto"><i class="fa fa-trash" aria-hidden="true"></i></a>--}}
                        {{--<a href="" class="text-22 text-orange-goto"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>--}}
                        <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#modal_probabilidad_{{$cotizacion_->id}}">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-danger" onclick="Eliminar_cotizacion('{{$cotizacion_->id}}','{{$titulo}}')" >
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </td>

                </tr>
            @endif
            @endforeach

            </tbody>
        </table>
    </div>

    <nav class="navbar navbar-light bg-primary">
        <span class="h1" class="navbar-brand"><b class="text-20 padding-15">50 %</b></span>
    </nav>
    <div class="row margin-top-20">
        <table id="example50" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Cliente</th>
                <th>Update</th>
                <th>Operaciones</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Cliente</th>
                <th>Update</th>
                <th>Operaciones</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($cotizacion->sortByDesc('created_at') as $cotizacion_)
                @if($cotizacion_->posibilidad==50)
                    <?php
                    $date = date_create($cotizacion_->fecha);
                    $fecha=date_format($date, 'jS F Y');
                    $titulo='';
                    ?>
                    <tr id="coti_new{{$cotizacion_->id}}">
                        <td>
                            @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                                @if($cliente_coti->estado=='1')
                                    <?php
                                    $titulo=$cliente_coti->cliente->nombres.' '.$cliente_coti->cliente->apellidos.' x '.$cotizacion_->nropersonas.' '.$fecha;
                                    ?>
                                    <a href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}">{{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizacion_->nropersonas}} {{$fecha}}</a>
                                @endif
                            @endforeach
                        </td>
                        <td>{{$cotizacion_->updated_at}}</td>
                        <td>
                            {{--<a href="" class="text-22 text-orange-goto"><i class="fa fa-trash" aria-hidden="true"></i></a>--}}
                            {{--<a href="" class="text-22 text-orange-goto"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>--}}
                            <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#modal_probabilidad_{{$cotizacion_->id}}">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button>
                            <button type="button" class="btn btn-danger" onclick="Eliminar_cotizacion('{{$cotizacion_->id}}','{{$titulo}}')" >
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                @endif
            @endforeach

            </tbody>
        </table>
    </div>

    <nav class="navbar navbar-light bg-primary">
        <span class="h1" class="navbar-brand"><b class="text-20 padding-15">25 %</b></span>
    </nav>
    <div class="row margin-top-20">
        <table id="example25" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Cliente</th>
                <th>Update</th>
                <th>Operaciones</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Cliente</th>
                <th>Update</th>
                <th>Operaciones</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($cotizacion->sortByDesc('created_at') as $cotizacion_)
                @if($cotizacion_->posibilidad==25)
                    <?php
                    $date = date_create($cotizacion_->fecha);
                    $fecha=date_format($date, 'jS F Y');
                    $titulo='';
                    ?>
                    <tr id="coti_new{{$cotizacion_->id}}">
                        <td>
                            @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                                @if($cliente_coti->estado=='1')
                                    <?php
                                    $titulo=$cliente_coti->cliente->nombres.' '.$cliente_coti->cliente->apellidos.' x '.$cotizacion_->nropersonas.' '.$fecha;
                                    ?>
                                    <a href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}">{{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizacion_->nropersonas}} {{$fecha}}</a>
                                @endif
                            @endforeach
                        </td>
                        <td>{{$cotizacion_->updated_at}}</td>
                        <td>
                            {{--<a href="" class="text-22 text-orange-goto"><i class="fa fa-trash" aria-hidden="true"></i></a>--}}
                            {{--<a href="" class="text-22 text-orange-goto"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>--}}
                            <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#modal_probabilidad_{{$cotizacion_->id}}">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button>
                            <button type="button" class="btn btn-danger" onclick="Eliminar_cotizacion('{{$cotizacion_->id}}','{{$titulo}}')" >
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                @endif
            @endforeach

            </tbody>
        </table>
    </div>

    <nav class="navbar navbar-light bg-primary">
        <span class="h1" class="navbar-brand"><b class="text-20 padding-15">NEW</b></span>
    </nav>
    <div class="row margin-top-20">
        <table id="example0" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Cliente</th>
                <th>Update</th>
                <th>Operaciones</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Cliente</th>
                <th>Update</th>
                <th>Operaciones</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($cotizacion->sortByDesc('created_at') as $cotizacion_)
                @if($cotizacion_->posibilidad==0)
                    <?php
                    $date = date_create($cotizacion_->fecha);
                    $fecha=date_format($date, 'jS F Y');
                    $titulo='';
                    ?>
                    <tr id="coti_new{{$cotizacion_->id}}">
                        <td>
                            @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                                @if($cliente_coti->estado=='1')
                                    <?php
                                        $titulo=$cliente_coti->cliente->nombres.' '.$cliente_coti->cliente->apellidos.' x '.$cotizacion_->nropersonas.' '.$fecha;
                                    ?>
                                    <a href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}">{{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizacion_->nropersonas}} {{$fecha}}</a>
                                @endif
                            @endforeach
                        </td>
                        <td>{{$cotizacion_->updated_at}}</td>
                        <td>
                            {{--<a href="" class="text-22 text-orange-goto"><i class="fa fa-trash" aria-hidden="true"></i></a>--}}
                            {{--<a href="" class="text-22 text-orange-goto"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>--}}
                            <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#modal_probabilidad_{{$cotizacion_->id}}">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button>
                            <button type="button" class="btn btn-danger" onclick="Eliminar_cotizacion('{{$cotizacion_->id}}','{{$titulo}}')" >
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
    @foreach($cotizacion->sortByDesc('created_at') as $cotizacion_)
        {{--@if($cotizacion_->posibilidad==75)--}}
            <div class="modal fade bd-example-modal-lg" id="modal_probabilidad_{{$cotizacion_->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <form action="{{route('agregar_probabilidad_path')}}" method="post" id="destination_edit_id" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    <?php
                                    $date = date_create($cotizacion_->fecha);
                                    $fecha=date_format($date, 'jS F Y');
                                    ?>
                                    @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                                        @if($cliente_coti->estado=='1')
                                            {{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizacion_->nropersonas}} {{$fecha}}
                                        @endif
                                    @endforeach

                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txt_codigo">Posibilidad</label>
                                            <select class="form-control" id="proba" name="proba">
                                                <option value="0">0</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="75">75</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="modal-footer">
                                {{csrf_field()}}
                                <input type="hidden" id="cotizacion_id" name="cotizacion_id"   value="{{$cotizacion_->id}}">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        {{--@endif--}}
    @endforeach


    <script>
        $(document).ready(function() {
            $('#example100').DataTable();
            $('#example75').DataTable();
            $('#example50').DataTable();
            $('#example25').DataTable();
            $('#example0').DataTable();
        } );
    </script>
@stop