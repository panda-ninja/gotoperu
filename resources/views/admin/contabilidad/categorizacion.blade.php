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
            <li>Contabilidad</li>
            <li class="active "><i class="fa fa-filter text-warning" aria-hidden="true"></i> Clasificacion</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12 ">
            <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                @php
                    $dato_cliente='';
                @endphp
                @foreach($cotizacion as $cotizacion_)
                    @foreach($cotizacion_->cotizaciones_cliente as $clientes)
                        @if($clientes->estado==1)
                            @php
                                $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                            @endphp
                        @endif
                    @endforeach
                        <tr>
                            <td class="col-lg-10">
                                <span class="badge">New: {{date_format(date_create($cotizacion_->updated_at), 'Y-m-d H:i:s')}} </span> {{$dato_cliente}} x {{$cotizacion_->nropersonas}} {{date_format(date_create($cotizacion_->fecha), 'l jS F Y')}}
                            </td>
                            <td class="col-lg-2 text-right">
                                <button type="button" class="btn btn-primary" onclick="categorizar('C')">C</button>
                                <button type="button" class="btn btn-success" onclick="categorizar('S')">S</button>
                            </td>
                        </tr>
                @endforeach
            </table>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12 text-center">
                    @php
                        $arra_count_mes_c=array();
                        $arra_count_mes_s=array();
                        for ($i=1;$i<=12;$i++){
                            $arra_count_mes_c[$i]=0;
                            $arra_count_mes_s[$i]=0;
                        }
                    @endphp
                    @foreach($cotizacion_cat as $cotizacion_cat_)
                        @if($cotizacion_cat_->categorizado=='C')
                            @php
                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                $arra_count_mes_c[intval($fecha[1])]+=1;
                            @endphp
                        @else
                            @php
                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                $arra_count_mes_s[intval($fecha[1])]+=1;
                            @endphp
                        @endif
                    @endforeach
                    @php
                        $d_ene=$arra_count_mes_c[1]+$arra_count_mes_s[1];
                        $ene_c=0;
                        $ene_s=0;
                        $ene_c_p=3;
                        $ene_s_p=3;
                        if($d_ene>0){
                            $ene_c=100*round($arra_count_mes_c[1]/$d_ene,2);
                            $ene_s=100-$ene_c;
                            if($ene_c>0)
                                $ene_c_p=$ene_c;
                            if($ene_s>0)
                                $ene_s_p=$ene_s;
                        }
                        $d_feb=($arra_count_mes_c['2']+$arra_count_mes_s['2']);
                        $feb_c=0;
                        $feb_s=0;
                        $feb_c_p=3;
                        $feb_s_p=3;
                        if($d_feb>0){
                            $feb_c=100*round($arra_count_mes_c['2']/$d_feb,2);
                            $feb_s=100-$feb_c;
                            if($feb_c>0)
                                $feb_c_p=$feb_c;
                            if($feb_s>0)
                                $feb_s_p=$feb_s;
                        }
                        $d_may=($arra_count_mes_c['3']+$arra_count_mes_s['3']);
                        $mar_c=0;
                        $mar_s=0;
                        $mar_c_p=3;
                        $mar_s_p=3;
                        if($d_may>0){
                            $mar_c=100*round($arra_count_mes_c['3']/$d_may,2);
                            $mar_s=100-$mar_c;
                            if($mar_c>0)
                                $mar_c_p=$mar_c;
                            if($mar_s>0)
                                $mar_s_p=$mar_s;
                        }
                        $d_abr=$arra_count_mes_c['4']+$arra_count_mes_s['4'];
                        $abr_c=0;
                        $abr_s=0;
                        $abr_c_p=3;
                        $abr_s_p=3;
                        if($d_abr>0){
                            $abr_c=100*round($arra_count_mes_c['4']/$d_abr,2);
                            $abr_s=100-$abr_c;
                            if($abr_c>0)
                                $abr_c_p=$abr_c;
                            if($abr_s>0)
                                $abr_s_p=$abr_s;
                        }
                        $d_may=($arra_count_mes_c['5']+$arra_count_mes_s['5']);
                        $may_c=0;
                        $may_s=0;
                        $may_c_p=3;
                        $may_s_p=3;
                        if($d_may>0){
                            $may_c=100*round($arra_count_mes_c['5']/$d_may,2);
                            $may_s=100-$may_c;
                            if($may_c>0)
                                $may_c_p=$may_c;
                            if($may_s>0)
                                $may_s_p=$may_s;
                        }
                        $d_jun=($arra_count_mes_c['6']+$arra_count_mes_s['6']);
                        $jun_c=0;
                        $jun_s=0;
                        $jun_c_p=3;
                        $jun_s_p=3;
                        if($d_jun>0){
                            $jun_c=100*round($arra_count_mes_c['6']/$d_jun,2);
                            $jun_s=100-$jun_c;
                            if($jun_c>0)
                                $jun_c_p=$jun_c;
                            if($jun_s>0)
                                $jun_s_p=$jun_s;
                        }
                        $d_jul=($arra_count_mes_c['7']+$arra_count_mes_s['7']);
                        $jul_c=0;
                        $jul_s=0;
                        $jul_c_p=3;
                        $jul_s_p=3;
                        if($d_jul>0){
                            $jul_c=100*round($arra_count_mes_c['7']/$d_jul,2);
                            $jul_s=100-$jul_c;
                            if($jul_c>0)
                                $jul_c_p=$jul_c;
                            if($jul_s>0)
                                $jul_s_p=$jul_s;
                        }
                        $d_ago=($arra_count_mes_c['8']+$arra_count_mes_s['8']);
                        $ago_c=0;
                        $ago_s=0;
                        $ago_c_p=3;
                        $ago_s_p=3;
                        if($d_ago>0){
                            $ago_c=100*round($arra_count_mes_c['8']/$d_ago,2);
                            $ago_s=100-$ago_c;
                            if($ago_c>0)
                                $ago_c_p=$ago_c;
                            if($ago_s>0)
                                $ago_s_p=$ago_s;
                        }
                        $d_set=($arra_count_mes_c['9']+$arra_count_mes_s['9']);
                        $set_c=0;
                        $set_s=0;
                        $set_c_p=3;
                        $set_s_p=3;
                        if($d_set>0){
                            $set_c=100*round($arra_count_mes_c['9']/$d_set,2);
                            $set_s=100-$set_c;
                            if($set_c>0)
                                $set_c_p=$set_c;
                            if($set_s>0)
                                $set_s_p=$set_s;

                        }
                        $d_oct=($arra_count_mes_c['10']+$arra_count_mes_s['10']);
                        $oct_c=0;
                        $oct_s=0;
                        $oct_c_p=3;
                        $oct_s_p=3;
                        if($d_oct>0){
                            $oct_c=100*round($arra_count_mes_c['10']/$d_oct,2);
                            $oct_s=100-$oct_c;
                            if($oct_c>0)
                                $oct_c_p=$oct_c;
                            if($oct_s>0)
                                $oct_s_p=$oct_s;
                        }
                        $d_nov=($arra_count_mes_c['11']+$arra_count_mes_s['11']);
                        $nov_c=0;
                        $nov_s=0;
                        $nov_c_p=3;
                        $nov_s_p=3;
                        if($d_nov>0){
                            $nov_c=100*round($arra_count_mes_c['11']/$d_nov,2);
                            $nov_s=100-$nov_c;
                            if($nov_c>0)
                                $nov_c_p=$nov_c;
                            if($nov_s>0)
                                $nov_s_p=$nov_s;
                        }
                        $d_dic=($arra_count_mes_c['12']+$arra_count_mes_s['12']);
                        $dic_c=0;
                        $dic_s=0;
                        $dic_c_p=3;
                        $dic_s_p=3;
                        if($d_dic>0){
                            $dic_c=100*round($arra_count_mes_c['12']/$d_dic,2);
                            $dic_s=100-$dic_c;
                            if($dic_c>0)
                                $dic_c_p=$dic_c;
                            if($dic_s>0)
                                $dic_s_p=$dic_s;

                        }
                    @endphp
                    <div class="panel panel-primary no-margin no-padding">
                        <div class="panel-heading">
                            <h3 class="panel-title">Paquetes con factura</h3>
                        </div>
                        <div class="panel-body">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-step-backward fa-2x" aria-hidden="true"></i></span>
                                <span class="input-group-addon">{{Date("Y")}}</span>
                                <span class="input-group-addon"><i class="fa fa-step-forward fa-2x" aria-hidden="true"></i></span>
                            </div>
                            <table align="center" cellpadding="0" cellspacing="0" border="0">
                                <tbody align="center">
                                <tr>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$ene_c}}%</b></div><div class="barrasv btn-primary text-10" style="height:{{$ene_c_p}}px;" onclick="mostra_ventas('ene','c')">$12145</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$feb_c}}%</b></div><div class="barrasv btn-warning text-10" style="height:{{$feb_c_p}}px;" onclick="mostra_ventas('feb','c')">$12145</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$mar_c}}%</b></div><div class="barrasv btn-info text-10" style="height:{{$mar_c_p}}px;" onclick="mostra_ventas('mar','c')">$12145</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$abr_c}}%</b></div><div class="barrasv btn-success text-10" style="height:{{$abr_c_p}}px;" onclick="mostra_ventas('abr','c')">$12145</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$may_c}}%</b></div><div class="barrasv btn-warning text-10" style="height:{{$may_c_p}}px;" onclick="mostra_ventas('may','c')">$12145</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$jun_c}}%</b></div><div class="barrasv btn-info text-10" style="height:{{$jun_c_p}}px;" onclick="mostra_ventas('jun','c')">$12145</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$jul_c}}%</b></div><div class="barrasv btn-warning text-10" style="height:{{$jul_c_p}}px;" onclick="mostra_ventas('jul','c')">$12145</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$ago_c}}%</b></div><div class="barrasv btn-success text-10" style="height:{{$ago_c_p}}px;" onclick="mostra_ventas('ago','c')">$12145</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$set_c}}%</b></div><div class="barrasv btn-primary text-10" style="height:{{$set_c_p}}px;" onclick="mostra_ventas('set','c')">$12145</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$oct_c}}%</b></div><div class="barrasv btn-danger text-10" style="height:{{$oct_c_p}}px;" onclick="mostra_ventas('oct','c')">$12145</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$nov_c}}%</b></div><div class="barrasv btn-success text-10" style="height:{{$nov_c_p}}px;" onclick="mostra_ventas('nov','c')">$12145</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$dic_c}}%</b></div><div class="barrasv btn-warning text-10" style="height:{{$dic_c_p}}px;" onclick="mostra_ventas('dic','c')">$12145</div></td>
                                </tr>
                                <tr>
                                    <td><b class="mes" onclick="mostra_ventas('ene','c')">Ene</b></td>
                                    <td><b class="mes" onclick="mostra_ventas('feb','c')">Feb</b></td>
                                    <td><b class="mes" onclick="mostra_ventas('mar','c')">Mar</b></td>
                                    <td><b class="mes" onclick="mostra_ventas('abr','c')">Abr</b></td>
                                    <td><b class="mes" onclick="mostra_ventas('may','c')">May</b></td>
                                    <td><b class="mes" onclick="mostra_ventas('jun','c')">Jun</b></td>
                                    <td><b class="mes" onclick="mostra_ventas('jul','c')">Jul</b></td>
                                    <td><b class="mes" onclick="mostra_ventas('ago','c')">Ago</b></td>
                                    <td><b class="mes" onclick="mostra_ventas('set','c')">Set</b></td>
                                    <td><b class="mes" onclick="mostra_ventas('oct','c')">Oct</b></td>
                                    <td><b class="mes" onclick="mostra_ventas('nov','c')">Nov</b></td>
                                    <td><b class="mes" onclick="mostra_ventas('dic','c')">Dic</b></td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="col-lg-12">
                                <h3>Lista de paquetes <span class="text-primary">Enero {{Date("Y")}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">12145</b></h3>
                                <div id="t_ene_c" class="row hide">
                                    <table id="ene_c" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cotizacion_cat as $cotizacion_cat_)
                                        @if($cotizacion_cat_->categorizado=='C')
                                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                @if($clientes->estado==1)
                                                    @php
                                                        $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                            @endphp
                                            @if(intval($fecha[1])==1)
                                                <tr>
                                                    <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                    <td><span class="badge text-right">$ 12345</span></td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                                <div id="t_feb_c" class="row hide">
                                    <table id="feb_c" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cotizacion_cat as $cotizacion_cat_)
                                        @if($cotizacion_cat_->categorizado=='C')
                                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                @if($clientes->estado==1)
                                                    @php
                                                        $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                            @endphp
                                            @if(intval($fecha[1])==2)
                                                <tr>
                                                    <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                    <td><span class="badge text-right">$ 12345</span></td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                                <div id="t_mar_c" class="row hide">
                                    <table id="mar_c" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cotizacion_cat as $cotizacion_cat_)
                                        @if($cotizacion_cat_->categorizado=='C')
                                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                @if($clientes->estado==1)
                                                    @php
                                                        $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                            @endphp
                                            @if(intval($fecha[1])==3)
                                                <tr>
                                                    <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                    <td><span class="badge text-right">$ 12345</span></td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                                <div id="t_abr_c" class="row hide">
                                    <table id="abr_c" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cotizacion_cat as $cotizacion_cat_)
                                        @if($cotizacion_cat_->categorizado=='C')
                                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                @if($clientes->estado==1)
                                                    @php
                                                        $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                            @endphp
                                            @if(intval($fecha[1])==4)
                                                <tr>
                                                    <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                    <td><span class="badge text-right">$ 12345</span></td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                                <div id="t_mar_c" class="row hide">
                                    <table id="may_c" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cotizacion_cat as $cotizacion_cat_)
                                        @if($cotizacion_cat_->categorizado=='C')
                                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                @if($clientes->estado==1)
                                                    @php
                                                        $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                            @endphp
                                            @if(intval($fecha[1])==5)
                                                <tr>
                                                    <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                    <td><span class="badge text-right">$ 12345</span></td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                                <div id="t_jun_c" class="row hide">
                                    <table id="jun_c" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cotizacion_cat as $cotizacion_cat_)
                                        @if($cotizacion_cat_->categorizado=='C')
                                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                @if($clientes->estado==1)
                                                    @php
                                                        $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                            @endphp
                                            @if(intval($fecha[1])==6)
                                                <tr>
                                                    <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                    <td><span class="badge text-right">$ 12345</span></td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                                <div id="t_jul_c" class="row hide">
                                    <table id="jul_c" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cotizacion_cat as $cotizacion_cat_)
                                        @if($cotizacion_cat_->categorizado=='C')
                                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                @if($clientes->estado==1)
                                                    @php
                                                        $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                            @endphp
                                            @if(intval($fecha[1])==7)
                                                <tr>
                                                    <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                    <td><span class="badge text-right">$ 12345</span></td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                                <div id="t_ago_c" class="row hide">
                                    <table id="ago_c" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cotizacion_cat as $cotizacion_cat_)
                                        @if($cotizacion_cat_->categorizado=='C')
                                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                @if($clientes->estado==1)
                                                    @php
                                                        $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                            @endphp
                                            @if(intval($fecha[1])==8)
                                                <tr>
                                                    <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                    <td><span class="badge text-right">$ 12345</span></td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                                <div id="t_set_c" class="row hide">
                                    <table id="set_c" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cotizacion_cat as $cotizacion_cat_)
                                        @if($cotizacion_cat_->categorizado=='C')
                                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                @if($clientes->estado==1)
                                                    @php
                                                        $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                            @endphp
                                            @if(intval($fecha[1])==9)
                                                <tr>
                                                    <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                    <td><span class="badge text-right">$ 12345</span></td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                                <div id="t_oct_c" class="row hide">
                                    <table id="oct_c" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cotizacion_cat as $cotizacion_cat_)
                                        @if($cotizacion_cat_->categorizado=='C')
                                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                @if($clientes->estado==1)
                                                    @php
                                                        $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                            @endphp
                                            @if(intval($fecha[1])==10)
                                                <tr>
                                                    <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                    <td><span class="badge text-right">$ 12345</span></td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                                <div id="t_nov_c" class="row hide">
                                    <table id="nov_c" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cotizacion_cat as $cotizacion_cat_)
                                        @if($cotizacion_cat_->categorizado=='C')
                                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                @if($clientes->estado==1)
                                                    @php
                                                        $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                            @endphp
                                            @if(intval($fecha[1])==11)
                                                <tr>
                                                    <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                    <td><span class="badge text-right">$ 12345</span></td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                                <div id="t_dic_c" class="row hide">
                                    <table id="dic_c" class="table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cotizacion_cat as $cotizacion_cat_)
                                        @if($cotizacion_cat_->categorizado=='C')
                                            @foreach($cotizacion_cat_->cotizaciones_cliente as $clientes)
                                                @if($clientes->estado==1)
                                                    @php
                                                        $dato_cliente=$clientes->cliente->nombres.' '.$clientes->cliente->nombres;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $fecha=explode('-',$cotizacion_cat_->fecha);
                                            @endphp
                                            @if(intval($fecha[1])==12)
                                                <tr>
                                                    <td>{{$dato_cliente}} x {{$cotizacion_cat_->nropersonas}} {{date_format(date_create($cotizacion_cat_->fecha), 'l jS F Y')}}</td>
                                                    <td><span class="badge text-right">$ 12345</span></td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Paquetes sin factura</h3>
                        </div>
                        <div class="panel-body">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-step-backward fa-2x" aria-hidden="true"></i></span>
                                <span class="input-group-addon">{{Date("Y")}}</span>
                                <span class="input-group-addon"><i class="fa fa-step-forward fa-2x" aria-hidden="true"></i></span>
                            </div>
                            <table align="center" cellpadding="0" cellspacing="0" border="0">
                                <tbody align="center">
                                <tr>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$ene_s}}%</b></div><div class="barrasv btn-primary text-10" style="height:{{$ene_s_p}}px;" onclick="mostra_ventas('1','S')">$12145</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$feb_s}}%</b></div><div class="barrasv btn-warning text-10" style="height:{{$feb_s_p}}px;" onclick="mostra_ventas('2','S')">$12145</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$mar_s}}%</b></div><div class="barrasv btn-info text-10" style="height:{{$mar_s_p}}px;" onclick="mostra_ventas('3','S')">$12145</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$abr_s}}%</b></div><div class="barrasv btn-success text-10" style="height:{{$abr_s_p}}px;" onclick="mostra_ventas('4','S')">$12145</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$may_s}}%</b></div><div class="barrasv btn-warning text-10" style="height:{{$may_s_p}}px;" onclick="mostra_ventas('5','S')">$12145</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$jun_s}}%</b></div><div class="barrasv btn-info text-10" style="height:{{$jun_s_p}}px;" onclick="mostra_ventas('6','S')">$12145</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$jul_s}}%</b></div><div class="barrasv btn-warning text-10" style="height:{{$jul_s_p}}px;" onclick="mostra_ventas('7','S')">$12145</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$ago_s}}%</b></div><div class="barrasv btn-success text-10" style="height:{{$ago_s_p}}px;" onclick="mostra_ventas('8','S')">$12145</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$set_s}}%</b></div><div class="barrasv btn-primary text-10" style="height:{{$set_s_p}}px;" onclick="mostra_ventas('9','S')">$12145</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$oct_s}}%</b></div><div class="barrasv btn-danger text-10" style="height:{{$oct_s_p}}px;" onclick="mostra_ventas('10','S')">$12145</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$nov_s}}%</b></div><div class="barrasv btn-success text-10" style="height:{{$nov_s_p}}px;" onclick="mostra_ventas('11','S')">$12145</div></td>
                                    <td valign="bottom"><div style="vertical-align:text-top"><b>{{$dic_s}}%</b></div><div class="barrasv btn-warning text-10" style="height:{{$dic_s_p}}px;" onclick="mostra_ventas('12','S')">$12145</div></td>
                                </tr>
                                <tr>
                                    <td><b class="mes" onclick="mostra_ventas('1','S')">Ene</b></td>
                                    <td><b class="mes" onclick="mostra_ventas('2','S')">Feb</b></td>
                                    <td><b class="mes" onclick="mostra_ventas('3','S')">Mar</b></td>
                                    <td><b class="mes" onclick="mostra_ventas('4','S')">Abr</b></td>
                                    <td><b class="mes" onclick="mostra_ventas('5','S')">May</b></td>
                                    <td><b class="mes" onclick="mostra_ventas('6','S')">Jun</b></td>
                                    <td><b class="mes" onclick="mostra_ventas('7','S')">Jul</b></td>
                                    <td><b class="mes" onclick="mostra_ventas('8','S')">Ago</b></td>
                                    <td><b class="mes" onclick="mostra_ventas('9','S')">Set</b></td>
                                    <td><b class="mes" onclick="mostra_ventas('10','S')">Oct</b></td>
                                    <td><b class="mes" onclick="mostra_ventas('11','S')">Nov</b></td>
                                    <td><b class="mes" onclick="mostra_ventas('12','S')">Dic</b></td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="col-lg-12">
                                <h3>Lista de paquetes <span class="text-primary">Enero {{Date("Y")}}</span> <b class="text-success text-25">$</b><b class="text-success text-25">12145</b></h3>
                                <table id="enero1" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Juan peres x 4 Enero 2017</td>
                                        <td><span class="badge">5</span><span class="badge text-right">$ 12345</span></td>
                                    </tr>
                                    <tr>
                                        <td>Juan peres x 4 Enero 2017</td>
                                        <td><span class="badge">5</span><span class="badge text-right">$ 12345</span></td>
                                    </tr>
                                    <tr>
                                        <td>Juan peres x 4 Enero 2017</td>
                                        <td><span class="badge">5</span><span class="badge text-right">$ 12345</span></td>
                                    </tr>
                                    <tr>
                                        <td>Juan peres x 4 Enero 2017</td>
                                        <td><span class="badge">5</span><span class="badge text-right">$ 12345</span></td>
                                    </tr>
                                    <tr>
                                        <td>Juan peres x 4 Enero 2017</td>
                                        <td><span class="badge">5</span><span class="badge text-right">$ 12345</span></td>
                                    </tr>
                                    <tr>
                                        <td>Juan peres x 4 Enero 2017</td>
                                        <td><span class="badge">5</span><span class="badge text-right">$ 12345</span></td>
                                    </tr>
                                    <tr>
                                        <td>Juan peres x 4 Enero 2017</td>
                                        <td><span class="badge">5</span><span class="badge text-right">$ 12345</span></td>
                                    </tr>
                                    <tr>
                                        <td>Juan peres x 4 Enero 2017</td>
                                        <td><span class="badge">5</span><span class="badge text-right">$ 12345</span></td>
                                    </tr>
                                    <tr>
                                        <td>Juan peres x 4 Enero 2017</td>
                                        <td><span class="badge">5</span><span class="badge text-right">$ 12345</span></td>
                                    </tr>
                                    <tr>
                                        <td>Juan peres x 4 Enero 2017</td>
                                        <td><span class="badge">5</span><span class="badge text-right">$ 12345</span></td>
                                    </tr>
                                    <tr>
                                        <td>Juan peres x 4 Enero 2017</td>
                                        <td><span class="badge">5</span><span class="badge text-right">$ 12345</span></td>
                                    </tr>
                                    <tr>
                                        <td>Juan peres x 4 Enero 2017</td>
                                        <td><span class="badge">5</span><span class="badge text-right">$ 12345</span></td>
                                    </tr>
                                    <tr>
                                        <td>Juan peres x 4 Enero 2017</td>
                                        <td><span class="badge">5</span><span class="badge text-right">$ 12345</span></td>
                                    </tr>
                                    <tr>
                                        <td>Juan peres x 4 Enero 2017</td>
                                        <td><span class="badge">5</span><span class="badge text-right">$ 12345</span></td>
                                    </tr>
                                    <tr>
                                        <td>Juan peres x 4 Enero 2017</td>
                                        <td><span class="badge">5</span><span class="badge text-right">$ 12345</span></td>
                                    </tr>
                                    <tr>
                                        <td>Juan peres x 4 Enero 2017</td>
                                        <td><span class="badge">5</span><span class="badge text-right">$ 12345</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('#ene_c').DataTable();
            $('#ene_s').DataTable();
            $('#feb_c').DataTable();
            $('#feb_s').DataTable();
            $('#mar_c').DataTable();
            $('#mar_s').DataTable();
            $('#abr_c').DataTable();
            $('#abr_s').DataTable();
            $('#may_c').DataTable();
            $('#may_s').DataTable();
            $('#jun_c').DataTable();
            $('#jun_s').DataTable();
            $('#jul_c').DataTable();
            $('#jul_s').DataTable();
            $('#ago_c').DataTable();
            $('#ago_s').DataTable();
            $('#set_c').DataTable();
            $('#set_s').DataTable();
            $('#oct_c').DataTable();
            $('#oct_s').DataTable();
            $('#nov_c').DataTable();
            $('#nov_s').DataTable();
            $('#dic_c').DataTable();
            $('#dic_s').DataTable();
            $('#new_ven').DataTable();
        } );
    </script>
@stop