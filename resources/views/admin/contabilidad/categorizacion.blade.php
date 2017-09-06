@extends('layouts.admin.admin')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Contabilidad</li>
            <li class="active "><i class="fa fa-filter text-warning" aria-hidden="true"></i> Clasificacion</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div id="chartContainer" style="height: 300px; width: 100%;"></div>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-4">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-step-backward fa-2x" aria-hidden="true"></i></span>
                        <span class="input-group-addon">{{Date("Y")}}</span>
                        <span class="input-group-addon"><i class="fa fa-step-forward fa-2x" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Paquetes con factura</h3>
                </div>
                <div class="panel-body grid">

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Paquetes sin factura</h3>
                </div>
                <div class="panel-body grid">

                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Nuevas ventas</h3>
                </div>
                <div class="panel-body grid">

                </div>
            </div>
        </div>
    </div>
    <form action="{{route('package_edit_path')}}" method="post" id="package_new_path_id">
       <div class="row margin-top-20">
           <div class="col-md-6">
               <div class="grid" id="Lista_itinerario_g" >


               </div>
               <div class="row">
                   <div class="col-md-12 text-right">
                       <b class="font-montserrat">COST WITHOUT HOTELS $ <label  id="totalItinerario_front">147</label> P.P</b>
                   </div>
               </div>
           </div>
       </div>
    </form>

@stop