@extends('layouts.admin.admin')
@section('content')
    <h1 class="page-header">Dashboard</h1>
    <i class="fa fa-camera-retro fa-5x"></i>
    <div class="row">
        @php
            $fecha_pqt=date("Y");
        @endphp
        <div class="col-lg-12">
            <div class="input-group">
                <span class="input-group-addon"><a href="{{route('contabilidad_path',[$fecha_pqt-1])}}"><i class="fa fa-step-backward fa-2x" aria-hidden="true"></i></a></span>
                <span id="anio_s" class="input-group-addon">{{$fecha_pqt}}</span>
                <span class="input-group-addon"><a href="{{route('contabilidad_path',[$fecha_pqt+1])}}"><i class="fa fa-step-forward fa-2x" aria-hidden="true"></i></a></span>
            </div>
        </div>
    </div>



@stop