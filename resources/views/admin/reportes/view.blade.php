@php
    function fecha_peru($fecha){
        $fecha_temp='';
        $fecha_temp=explode('-',$fecha);
        return $fecha_temp[2].'/'.$fecha_temp[1].'/'.$fecha_temp[0];
    }
@endphp

@extends('layouts.admin.reportes')
@section('content')
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-1 cabecera-res bg-sombra">%</div>
                <div class="col-lg-2 cabecera-res bg-sombra">SERVICIO</div>
                <div class="col-lg-2 cabecera-res bg-sombra">COTIZACION</div>
                <div class="col-lg-3 cabecera-res bg-sombra">RESERVAS</div>
                <div class="col-lg-3 cabecera-res bg-sombra">CONTABILIDAD</div>
            </div>
            <div class="row">
                <div class="col-lg-1 cabecera-res-lat"><b>35%</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>HOTELS</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>$</b><b>1260</b></div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="text-success">-$</b><b class="text-success">17</b></div>
                        <div class="col-lg-8"><b>$</b><b>1243</b></div>
                    </div>
                </div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="text-danger">-$</b><b class="text-danger">10</b></div>
                        <div class="col-lg-8"><b>$</b><b>1243</b></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 cabecera-res-lat"><b>17%</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>TOURS</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>$</b><b>1260</b></div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="text-success">-$</b><b class="text-success">17</b></div>
                        <div class="col-lg-8"><b>$</b><b>1243</b></div>
                    </div>
                </div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="text-danger">-$</b><b class="text-danger">10</b></div>
                        <div class="col-lg-8"><b>$</b><b>1243</b></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 cabecera-res-lat"><b>35%</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>MOVILID</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>$</b><b>1260</b></div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="text-success">-$</b><b class="text-success">17</b></div>
                        <div class="col-lg-8"><b>$</b><b>1243</b></div>
                    </div>
                </div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="text-danger">-$</b><b class="text-danger">10</b></div>
                        <div class="col-lg-8"><b>$</b><b>1243</b></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 cabecera-res-lat"><b>17%</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>REPRESENT</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>$</b><b>1260</b></div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="text-success">-$</b><b class="text-success">17</b></div>
                        <div class="col-lg-8"><b>$</b><b>1243</b></div>
                    </div>
                </div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="text-danger">-$</b><b class="text-danger">10</b></div>
                        <div class="col-lg-8"><b>$</b><b>1243</b></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 cabecera-res-lat"><b>35%</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>ENTRANCES</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>$</b><b>1260</b></div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="text-success">-$</b><b class="text-success">17</b></div>
                        <div class="col-lg-8"><b>$</b><b>1243</b></div>
                    </div>
                </div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="text-danger">-$</b><b class="text-danger">10</b></div>
                        <div class="col-lg-8"><b>$</b><b>1243</b></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 cabecera-res-lat"><b>17%</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>FOOD</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>$</b><b>1260</b></div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="text-success">-$</b><b class="text-success">17</b></div>
                        <div class="col-lg-8"><b>$</b><b>1243</b></div>
                    </div>
                </div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="text-danger">-$</b><b class="text-danger">10</b></div>
                        <div class="col-lg-8"><b>$</b><b>1243</b></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 cabecera-res-lat"><b>35%</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>TRAINS</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>$</b><b>1260</b></div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="text-success">-$</b><b class="text-success">17</b></div>
                        <div class="col-lg-8"><b>$</b><b>1243</b></div>
                    </div>
                </div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="text-danger">-$</b><b class="text-danger">10</b></div>
                        <div class="col-lg-8"><b>$</b><b>1243</b></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 cabecera-res-lat"><b>17%</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>FLIGHTS</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>$</b><b>1260</b></div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="text-success">-$</b><b class="text-success">17</b></div>
                        <div class="col-lg-8"><b>$</b><b>1243</b></div>
                    </div>
                </div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="text-danger">-$</b><b class="text-danger">10</b></div>
                        <div class="col-lg-8"><b>$</b><b>1243</b></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 cabecera-res-lat"><b>17%</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>OTHERS</b></div>
                <div class="col-lg-2 cabecera-res-lat"><b>$</b><b>1260</b></div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="text-success">-$</b><b class="text-success">17</b></div>
                        <div class="col-lg-8"><b>$</b><b>1243</b></div>
                    </div>
                </div>
                <div class="col-lg-3 cabecera-res-lat">
                    <div class="row">
                        <div class="col-lg-4"><b class="text-danger">-$</b><b class="text-danger">10</b></div>
                        <div class="col-lg-8"><b>$</b><b>1243</b></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 cabecera-res-lat-invi"></div>
                <div class="col-lg-2 cabecera-res-lat-invi"></div>
                <div class="col-lg-2 cabecera-res-total"><b>$</b><b>3740</b></div>
                <div class="col-lg-3 cabecera-res-total">
                    <div class="row">
                        <div class="col-lg-4"><b class="text-success">-$</b><b class="text-success">17</b></div>
                        <div class="col-lg-8"><b>$</b><b>1243</b></div>
                    </div>
                </div>
                <div class="col-lg-3 cabecera-res-total">
                    <div class="row">
                        <div class="col-lg-4"><b class="text-danger">-$</b><b class="text-danger">10</b></div>
                        <div class="col-lg-8"><b>$</b><b>1243</b></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 cabecera-res-lat-invi"><b></b></div>
                <div class="col-lg-2 cabecera-res-lat-invi"><b></b></div>
                <div class="col-lg-2 cabecera-res-lat-invi"><b></b><b></b></div>
                <div class="col-lg-3 cabecera-res-total-por bg-verde">
                    <b>100</b><b>%</b>
                </div>
                <div class="col-lg-3 cabecera-res-total-por bg-naranja">
                    <b>94</b><b>%</b>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <h2>SUN PAIK X 6</h2>
            <p class="text-center">7 days feb 2018 </p>
            <div class="divider"></div>
            <div class="row">
                <div class="col-lg-6">VENTAS</div>
                <div class="col-lg-4"><b>$</b><b>4580</b></div>
                <div class="col-lg-4"></div>
            </div>
            <div class="row">
                <div class="col-lg-6">CONTABILIDAD</div>
                <div class="col-lg-4"><b>$</b><b>4580</b></div>
                <div class="col-lg-2 bg-naranja"><b>94</b><b>%</b></div>
            </div>
            <div class="row borde-verde">
                <div class="col-lg-6">PROFIT</div>
                <div class="col-lg-4"><b>$</b><b>4580</b></div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>


<table class="hide table table-responsive table-bordered table-striped">
    <thead>
    <tr>
        <th></th>
        <th>Tipo</th>
        <th>Cotizacion</th>
        <th>Reservas</th>
        <th>Contabilidad</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><b>35%</b></td>
        <td><b>HOTEL</b></td>
        <td><b>$1260</b></td>
        <td><b class="text-success">$17</b><b>$1243</b></td>
        <td><b class="text-unset">$0</b><b>$1243</b></td>
    </tr>
    <tr>
        <td><b>17%</b></td>
        <td><b>TOURS</b></td>
        <td><b>$1260</b></td>
        <td><b class="text-danger">$17</b><b>$1243</b></td>
        <td><b class="text-unset">$0</b><b>$1243</b></td>
    </tr>
    <tr>
        <td><b>125%</b></td>
        <td><b>MOVILID</b></td>
        <td><b>$260</b></td>
        <td><b class="text-success">$17</b><b>$1243</b></td>
        <td><b class="text-unset">$0</b><b>$1243</b></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td><b>$3740</b></td>
        <td><b class="text-success">$17</b><b>$3725</b></td>
        <td><b class="text-danger">$10</b><b>$3748</b></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><b class="bg-success">100 %</b></td>
        <td><b class="bg-warning">94 %</b></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><b>reservado</b></td>
        <td><b>pagado</b></td>
    </tr>
    </tbody>
</table>
@stop