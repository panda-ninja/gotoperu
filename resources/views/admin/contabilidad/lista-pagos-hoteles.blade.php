@extends('layouts.admin.contabilidad')
@section('content')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <div class="row margin-top-40">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Contabilidad</li>
            <li>Hoteles</li>
            <li class="active">Listar por fechas</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 table-responsive">
                            <table class="table table-condensed table-bordered margin-top-20 table-hover">
                                <thead>
                                <tr>
                                    <th class="text-18 text-grey-goto ">Cotización</th>
                                    <th class="text-18 text-grey-goto text-center">Proveedor</th>
                                    <th class="text-18 text-grey-goto text-center">Precio Cont.</th>
                                    <th class="text-18 text-grey-goto text-center">Saldo</th>
                                    <th class="text-18 text-grey-goto text-center">Medio Pago</th>
                                    <th class="text-18 text-grey-goto text-center">#CB/CCI</th>
                                    <th class="text-18 text-grey-goto text-center">Transacción</th>
                                    <th class="text-18 text-grey-goto text-center hide" id="p_tfecha">Nueva fecha</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cotizaciones->where('estado','2') as $cotizacion)
                                    @foreach($cotizacion->paquete_cotizaciones->where('estado','2') as $paquete)
                                        <tr>
                                            <td class="text-18 text-grey-goto">
                                                @foreach($cotizacion->cotizaciones_cliente as $cli)
                                                    {{$cli->cliente->nombres}} {{$cli->cliente->apellidos}} x {{$cotizacion->nropersonas}} ({{$cotizacion->duracion}} dias)
                                                @endforeach
                                            </td>
                                            <td class="text-18 text-grey-goto text-left">
                                                Proveedor
                                            </td>
                                            <td class="text-18 text-grey-goto text-center">Precio Cont.</td>
                                            <td class="text-18 text-grey-goto text-center">Saldo</td>
                                            <td class="text-18 text-grey-goto text-center">Medio Pago</td>
                                            <td class="text-18 text-grey-goto text-center">#CB/CCI</td>
                                            <td class="text-18 text-grey-goto text-center">Transacción</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop