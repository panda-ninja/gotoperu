@php
function fecha_peru($fecha){
$fecha=explode('-',$fecha);
return $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
}
@endphp
@extends('layouts.admin.book')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Reservas</li>
            <li>Liquidacion</li>
            <li class="active">Liquidaciones</li>
        </ol>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <table  class="table table-bordered table-striped table-responsive table-hover">
                <thead>
                <tr>
                    <th>DESDE</th>
                    <th>HASTA</th>
                    <th>POR</th>
                    <th>Estado</th>
                    <th>OPERACIONES</th>
                </tr>
                </thead>
                <tbody>
                @foreach($liquidaciones->where('estado',1)->sortby('desde') as $liquidacion)
                    <tr>
                        <td>{{fecha_peru($liquidacion->ini)}}</td>
                        <td>{{fecha_peru($liquidacion->fin)}}</td>
                        <td>
                            @foreach($users->where('id',$liquidacion->user_id) as $user)
                                {{$user->name}} {{$liquidacion->tipo_user}}
                            @endforeach
                        </td>
                        <td>x%</td>
                        <td><a href="{{route('ver_liquidacion_path',[$liquidacion->ini,$liquidacion->fin])}}" class="btn btn-primary"><i class="fa fa-eye-slash"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop