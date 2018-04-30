@extends('layouts.admin.contabilidad')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Contabilidad</li>
            <li class="active">Pagos pendientes</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">HOTELS</a></li>
                        <li><a data-toggle="tab" href="#menu1">MOVILID</a></li>
                        <li><a data-toggle="tab" href="#menu2">REPRESENT</a></li>
                        <li><a data-toggle="tab" href="#menu3">ENTRANCES</a></li>
                        <li><a data-toggle="tab" href="#menu4">FOOD</a></li>
                        <li><a data-toggle="tab" href="#menu5">TRAINS</a></li>
                        <li><a data-toggle="tab" href="#menu6">FLIGHTS</a></li>
                        <li><a data-toggle="tab" href="#menu7">OTHERS</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-12 form-inline">

                                                    {{--<form action="{{route('list_fechas_rango_hotel_path')}}" method="post" class="form-inline">--}}
                                                        {{csrf_field()}}
                                                        <div class="form-group">
                                                            <label for="f_ini">From</label>
                                                            <input type="date" class="form-control" placeholder="from" name="txt_ini" id="f_ini" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="f_fin">To</label>
                                                            <input type="date" class="form-control" placeholder="to" name="txt_fin" id="f_fin" required>
                                                        </div>
                                                        <button type="button" class="btn btn-default" onclick="buscar_hoteles_pagos_pendientes($('#f_ini').val(),$('#f_fin').val())">Filtrar</button>
                                                    {{--</form>--}}
                                                </div>
                                            </div><!-- /.row -->
                                            {{--<hr>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="rpt_hotel">
                                </div>
                            </div>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <h3>Menu 1</h3>
                            <p>Some content in menu 1.</p>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <h3>Menu 2</h3>
                            <p>Some content in menu 1.</p>
                        </div>
                        <div id="menu3" class="tab-pane fade">
                            <h3>Menu 3</h3>
                            <p>Some content in menu 2.</p>
                        </div>
                        <div id="menu4" class="tab-pane fade">
                            <h3>Menu 4</h3>
                            <p>Some content in menu 1.</p>
                        </div>
                        <div id="menu5" class="tab-pane fade">
                            <h3>Menu 5</h3>
                            <p>Some content in menu 1.</p>
                        </div>
                        <div id="menu6" class="tab-pane fade">
                            <h3>Menu 6</h3>
                            <p>Some content in menu 2.</p>
                        </div>
                        <div id="menu7" class="tab-pane fade">
                            <h3>Menu 7</h3>
                            <p>Some content in menu 2.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var total=0;
        function sumar(valor) {
            total += valor;
            document.getElementById('s_total').innerHTML   = total;
        }
        function restar(valor) {
            total-=valor;
            document.getElementById('s_total').innerHTML   = total;
        }

    </script>
@stop