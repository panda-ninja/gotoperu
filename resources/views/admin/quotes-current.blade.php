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
            <li>Quotes</li>
            <li class="active">Current</li>
        </ol>
    </div>
    <nav class="navbar navbar-light bg-primary">
        <span class="h1" class="navbar-brand"><b class="text-20 padding-15">75 %</b></span>
    </nav>
    <div class="row margin-top-20">
        <table id="example75" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Cliente</th>
                <th>Operaciones</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Cliente</th>
                <th>Operaciones</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($cotizacion->sortByDesc('created_at') as $cotizacion_)
            @if($cotizacion_->posibilidad==75)
                <?php
                $date = date_create($cotizacion_->fecha);
                $fecha=date_format($date, 'jS F Y');
                ?>
                <tr>
                    <td>
                        @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                            @if($cliente_coti->estado=='1')
                                <a href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}">{{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizacion_->nropersonas}} {{$fecha}}</a>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <a href="" class="text-22 text-orange-goto"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        <a href="" class="text-22 text-orange-goto"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
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
                <th>Operaciones</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Cliente</th>
                <th>Operaciones</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($cotizacion->sortByDesc('created_at') as $cotizacion_)
                @if($cotizacion_->posibilidad==50)
                    <?php
                    $date = date_create($cotizacion_->fecha);
                    $fecha=date_format($date, 'jS F Y');
                    ?>
                    <tr>
                        <td>
                            @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                                @if($cliente_coti->estado=='1')
                                    <a href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}">{{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizacion_->nropersonas}} {{$fecha}}</a>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="" class="text-22 text-orange-goto"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            <a href="" class="text-22 text-orange-goto"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
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
                <th>Operaciones</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Cliente</th>
                <th>Operaciones</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($cotizacion->sortByDesc('created_at') as $cotizacion_)
                @if($cotizacion_->posibilidad==25)
                    <?php
                    $date = date_create($cotizacion_->fecha);
                    $fecha=date_format($date, 'jS F Y');
                    ?>
                    <tr>
                        <td>
                            @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                                @if($cliente_coti->estado=='1')
                                    <a href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}">{{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizacion_->nropersonas}} {{$fecha}}</a>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="" class="text-22 text-orange-goto"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            <a href="" class="text-22 text-orange-goto"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
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
                <th>Operaciones</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Cliente</th>
                <th>Operaciones</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($cotizacion->sortByDesc('created_at') as $cotizacion_)
                @if($cotizacion_->posibilidad==0)
                    <?php
                    $date = date_create($cotizacion_->fecha);
                    $fecha=date_format($date, 'jS F Y');
                    ?>
                    <tr>
                        <td>
                            @foreach($cotizacion_->cotizaciones_cliente as $cliente_coti)
                                @if($cliente_coti->estado=='1')
                                    <a href="{{route('cotizacion_id_show_path',$cotizacion_->id)}}">{{$cliente_coti->cliente->nombres}} {{$cliente_coti->cliente->apellidos}} x {{$cotizacion_->nropersonas}} {{$fecha}}</a>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="" class="text-22 text-orange-goto"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            <a href="" class="text-22 text-orange-goto"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endif
            @endforeach

            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $('#example75').DataTable();
            $('#example50').DataTable();
            $('#example25').DataTable();
            $('#example0').DataTable();
        } );
    </script>
@stop