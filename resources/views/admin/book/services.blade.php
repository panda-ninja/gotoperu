@extends('layouts.admin.book')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Database</li>
            <li class="active">Destination</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="panel-title pull-left" style="font-size:30px;">Hidalgo <small>hidlgo@gmail.com</small></h1>
                            <b class="text-warning padding-left-10"> (X2)</b>
                            <i class="fa fa-male fa-2x"></i>
                            <i class="fa fa-male fa-2x"></i>

                            <i class="fa fa-check text-success" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Hidalgo esta activo"></i>
                            <div class="dropdown pull-right">
                                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Opciones
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="?page=update"><i class="fa fa-fw fa-database" aria-hidden="true"></i> Actualizar Datos</a></li>
                                    <li><a href="#"><i class="fa fa-fw fa-check" aria-hidden="true"></i> Friends</a></li>
                                    <li><a href="#">Work</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> Add a new aspect</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-12 margin-top-20">
                            <div class="progress">

                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                    Datos del pasajero 60%
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <span class="pull-left pax-nav">
                                <b>Travel date: 23 Jan</b>
                            </span>
                            <span class="pull-right">
                                {{--<a href="#" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-lg fa-at" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Mention"></i></a>--}}
                                {{--<a href="#" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-lg fa-envelope-o" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Message"></i></a>--}}
                                <a href="#" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-lg fa-ban" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Ignore"></i></a>
                            </span>
                        </div>


                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4 class="text-right">
                        <a href="#" style="text-decoration:none;">
                            {{--<strong>Price x peson: 123.00$</strong>--}}
                            <strong class="text-warning text-25">Pending: 23.00$</strong>
                        </a>
                    </h4>
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Services</th>
                                <th>Quote</th>
                                <th>Real Price</th>
                                <th>Verification Code</th>
                                <th>Provider</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="4"><b>Day 1</b></td>
                            </tr>
                            <tr>
                                <td>Transfers</td>
                                <td class="text-right">1322.00 $</td>
                                <td class="text-right">1234.00 $</td>
                                <td>dfhdklhj</td>
                                <td>Romario</td>
                                <td><i class="fa fa-check fa-2x text-success"></i></td>
                            </tr>
                            <tr>
                                <td>Transfers</td>
                                <td class="text-right">1322.00 $</td>
                                <td class="text-right">343.00 $</td>
                                <td>dfhdklhj</td>
                                <td>
                                    {{--<a href="" class="btn btn-sm btn-warning">Proveedor</a>--}}
                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal">
                                        Proveedor
                                    </button>
                                </td>
                                <td><i class="fa fa-warning fa-2x text-warning"></i></td>
                                <!-- Modal -->
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                            </div>
                                            <div class="modal-body clearfix">
                                                <div class="col-md-4">
                                                    <h4>Transder</h4>
                                                </div>
                                                <div class="col-md-4">
                                                    <h4>Hotels</h4>
                                                </div>
                                                <div class="col-md-4">
                                                    <h4>Tours</h4>
                                                </div>
                                                <div class="col-md-4">
                                                    <h4>Transder</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </tr>

                        </tbody>
                        <tbody>

                            <tr>
                                <td colspan="2"><b>Total</b></td>
                                <td class="text-right text-18 text-warning"><b>1322.00 $</b></td>
                                <td class="text-right text-18 text-info"><b>343.00 $</b></td>
                                
                            </tr>

                        </tbody>
                    </table>
                </div>
        </div>

    </div>

@stop