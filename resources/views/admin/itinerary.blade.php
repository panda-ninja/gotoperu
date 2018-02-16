@extends('layouts.admin.admin')
@section('archivos-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
@stop
@section('archivos-js')
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js")}}"></script>
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
@stop
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Inventory</li>
            <li class="active">Day by Day</li>
        </ol>
    </div>
    <div class="row margin-top-20">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_new_destination">
            New <i class="fa fa-plus-circle" aria-hidden="true"></i>
        </button>

        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="modal_new_destination" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="{{route('itinerary_save_path')}}" method="post" id="destination_save_id" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Day by Day</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="txt_titulo">Titulo</label>
                                                <input type="text" class="form-control" id="txt_titulo" name="txt_titulo" placeholder="Titulo">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="txt_descripcion">Descripcion</label>
                                        <textarea class="form-control textarea" name="txt_descripcion" id="txt_descripcion" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-lg-4">
                                            <label for="txt_imagen">Primera imagen</label>
                                            <input type="file" class="form-control" id="txt_imagen" name="txt_imagen" placeholder="Imagen" size="2048" onchange="ValidarImagen(this,1);">
                                            <span id="mensaje_file1" class="text-danger text-15"></span>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-4">
                                                <label for="txt_imagen">Segunda imagen</label>
                                                <input type="file" class="form-control" id="txt_imagenB" name="txt_imagenB" placeholder="Imagen" size="2048" onchange="ValidarImagen(this,2);">
                                                <span id="mensaje_file2" class="text-danger text-15"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-4">
                                                <label for="txt_imagen">Tercera imagen</label>
                                                <input type="file" class="form-control" id="txt_imagenC" name="txt_imagenC" placeholder="Imagen" size="2048" onchange="ValidarImagen(this,3);">
                                                <span id="mensaje_file3" class="text-danger text-15"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row margin-top-20">
                                <div class="col-md-12">
                                    <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">2</span> Destinations</h4>
                                    <div class="divider margin-bottom-20"></div>
                                </div>
                            </div>
                            <div class="row">
                                {{csrf_field()}}
                                @foreach($destinations as $destino)
                                <div class="col-md-3">
                                    <div class="checkbox11">
                                        <label class="text-green-goto">
                                            <input class="grupo" type="checkbox" name="destinos[]" value="{{$destino->id}}_{{$destino->destino}}" onchange="filtrar_grupos()">
                                            {{$destino->destino}}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="row margin-top-20">
                                @foreach($categorias as $categoria)
                                    <?php
                                    $tipoServicio[]=$categoria->nombre;
                                    ?>
                                @endforeach
                                <div class="btn-group col-lg-12" role="group" aria-label="...">
                                    <button id="filtro_1" class="btn btn-info" type="button" onclick="escojerPos(1,'{{$tipoServicio[1]}}')"><i class="fa fa-map-o fa-3x" aria-hidden="true"></i><p class="text-10">{{$tipoServicio[1]}}</p></button>
                                    <button id="filtro_2" class="btn btn-warning" type="button" onclick="escojerPos(2,'{{$tipoServicio[2]}}')"><i class="fa fa-bus fa-3x" aria-hidden="true"></i><p class="text-10">{{$tipoServicio[2]}}</p></button>
                                    <button id="filtro_3" class="btn btn-success" type="button" onclick="escojerPos(3,'{{$tipoServicio[3]}}')"><i class="fa fa-users fa-3x" aria-hidden="true"></i><p class="text-10">{{$tipoServicio[3]}}</p></button>
                                    <button id="filtro_4" class="btn btn-warning" type="button" onclick="escojerPos(4,'{{$tipoServicio[4]}}')"><i class="fa fa-ticket fa-3x" aria-hidden="true"></i><p class="text-10">{{$tipoServicio[4]}}</p></button>
                                    <button id="filtro_5" class="btn btn-danger" type="button" onclick="escojerPos(5,'{{$tipoServicio[5]}}')"><i class="fa fa-cutlery fa-3x" aria-hidden="true"></i><p class="text-10">{{$tipoServicio[5]}}</p></button>
                                    <button id="filtro_6" class="btn btn-info" type="button" onclick="escojerPos(6,'{{$tipoServicio[6]}}')"><i class="fa fa-train fa-3x" aria-hidden="true"></i><p class="text-10">{{$tipoServicio[6]}}</p></button>
                                    <button id="filtro_7" class="btn btn-primary" type="button" onclick="escojerPos(7,'{{$tipoServicio[7]}}')"><i class="fa fa-plane fa-3x" aria-hidden="true"></i><p class="text-10">{{$tipoServicio[7]}}</p></button>
                                    <button id="filtro_8" class="btn btn-success" type="button" onclick="escojerPos(8,'{{$tipoServicio[8]}}')"><i class="fa fa-question fa-3x" aria-hidden="true"></i><p class="text-10">{{$tipoServicio[8]}}</p></button>
                                </div>
                            </div>
                            <div class="row margin-top-10">
                                <div id="t_{{$tipoServicio[1]}}" class="hide col-lg-12">
                                    <ul class="nav nav-tabs">
                                        <li class="active bg-info"><a data-toggle="tab" href="#t_{{$tipoServicio[1]}}_PRIVATE">PRIVATE</a></li>
                                        <li class="bg-info"><a data-toggle="tab" href="#t_{{$tipoServicio[1]}}_GROUP">GROUP</a></li>
                                    </ul>
                                    {{--{{dd($tipos)}}--}}
                                    <div class="tab-content margin-top-20">
                                        <div id="t_{{$tipoServicio[1]}}_PRIVATE" class="tab-pane fade in active">
                                            @foreach($services as $service)
                                                @if($service->grupo==$tipoServicio[1])
                                                    <?php
                                                    $precio=$service->precio_venta;
                                                    ?>
                                                    @if($service->precio_grupo==1)
                                                        <?php
                                                        $precio=round($service->precio_venta/2,2);
                                                        ?>
                                                    @endif
                                                    @if($service->tipoServicio=='PRIVATE')
                                                        <div id="service_{{$service->id}}" class="col-md-4 hide">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                        <div id="t_{{$tipoServicio[1]}}_GROUP" class="tab-pane fade">
                                            @foreach($services as $service)
                                                @if($service->grupo==$tipoServicio[1])
                                                    <?php
                                                    $precio=$service->precio_venta;
                                                    ?>
                                                    @if($service->precio_grupo==1)
                                                        <?php
                                                        $precio=round($service->precio_venta/2,2);
                                                        ?>
                                                    @endif
                                                    @if($service->tipoServicio=='GROUP')
                                                        <div id="service_{{$service->id}}" class="col-md-4 hide">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div id="t_{{$tipoServicio[2]}}" class="hide col-lg-12">
                                        <ul class="nav nav-tabs">
                                            <li class="active bg-warning"><a data-toggle="tab" href="#t_{{$tipoServicio[2]}}_AUTO">AUTO</a></li>
                                            <li class="bg-warning"><a data-toggle="tab" href="#t_{{$tipoServicio[2]}}_SUV">SUV</a></li>
                                            <li class="bg-warning"><a data-toggle="tab" href="#t_{{$tipoServicio[2]}}_VAN">VAN</a></li>
                                            <li class="bg-warning"><a data-toggle="tab" href="#t_{{$tipoServicio[2]}}_H1">H1</a></li>
                                            <li class="bg-warning"><a data-toggle="tab" href="#t_{{$tipoServicio[2]}}_SPRINTER">SPRINTER</a></li>
                                            <li class="bg-warning"><a data-toggle="tab" href="#t_{{$tipoServicio[2]}}_BUS">BUS</a></li>
                                        </ul>
                                        {{--{{dd($tipos)}}--}}
                                        <div class="tab-content margin-top-20">
                                            <div id="t_{{$tipoServicio[2]}}_AUTO" class="tab-pane fade in active">
                                                @foreach($services as $service)
                                                    @if($service->grupo==$tipoServicio[2])
                                                        <?php
                                                        $precio=$service->precio_venta;
                                                        ?>
                                                        @if($service->precio_grupo==1)
                                                            <?php
                                                            $precio=round($service->precio_venta/2,2);
                                                            ?>
                                                        @endif
                                                        @if($service->tipoServicio=='AUTO')
                                                            <div id="service_{{$service->id}}" class="col-md-4 hide">
                                                                <div class="checkbox11">
                                                                    <label>
                                                                        <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                                        {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-10 bg-primary">{{$service->min_personas}}-{{$service->max_personas}} p</span>  <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div id="t_{{$tipoServicio[2]}}_SUV" class="tab-pane fade">
                                                @foreach($services as $service)
                                                    @if($service->grupo==$tipoServicio[2])
                                                        <?php
                                                        $precio=$service->precio_venta;
                                                        ?>
                                                        @if($service->precio_grupo==1)
                                                            <?php
                                                            $precio=round($service->precio_venta/2,2);
                                                            ?>
                                                        @endif
                                                        @if($service->tipoServicio=='SUV')
                                                            <div id="service_{{$service->id}}" class="col-md-4 hide">
                                                                <div class="checkbox11">
                                                                    <label>
                                                                        <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                                        {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-10 bg-primary">{{$service->min_personas}}-{{$service->max_personas}} p</span>  <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div id="t_{{$tipoServicio[2]}}_VAN" class="tab-pane fade">
                                                @foreach($services as $service)
                                                    @if($service->grupo==$tipoServicio[2])
                                                        <?php
                                                        $precio=$service->precio_venta;
                                                        ?>
                                                        @if($service->precio_grupo==1)
                                                            <?php
                                                            $precio=round($service->precio_venta/2,2);
                                                            ?>
                                                        @endif
                                                        @if($service->tipoServicio=='VAN')
                                                            <div id="service_{{$service->id}}" class="col-md-4 hide">
                                                                <div class="checkbox11">
                                                                    <label>
                                                                        <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                                        {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-10 bg-primary">{{$service->min_personas}}-{{$service->max_personas}} p</span>  <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div id="t_{{$tipoServicio[2]}}_H1" class="tab-pane fade">
                                                @foreach($services as $service)
                                                    @if($service->grupo==$tipoServicio[2])
                                                        <?php
                                                        $precio=$service->precio_venta;
                                                        ?>
                                                        @if($service->precio_grupo==1)
                                                            <?php
                                                            $precio=round($service->precio_venta/2,2);
                                                            ?>
                                                        @endif
                                                        @if($service->tipoServicio=='H1')
                                                            <div id="service_{{$service->id}}" class="col-md-4 hide">
                                                                <div class="checkbox11">
                                                                    <label>
                                                                        <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                                        {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-10 bg-primary">{{$service->min_personas}}-{{$service->max_personas}} p</span>  <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div id="t_{{$tipoServicio[2]}}_SPRINTER" class="tab-pane fade">
                                                @foreach($services as $service)
                                                    @if($service->grupo==$tipoServicio[2])
                                                        <?php
                                                        $precio=$service->precio_venta;
                                                        ?>
                                                        @if($service->precio_grupo==1)
                                                            <?php
                                                            $precio=round($service->precio_venta/2,2);
                                                            ?>
                                                        @endif
                                                        @if($service->tipoServicio=='SPRINTER')
                                                            <div id="service_{{$service->id}}" class="col-md-4 hide">
                                                                <div class="checkbox11">
                                                                    <label>
                                                                        <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                                        {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-10 bg-primary">{{$service->min_personas}}-{{$service->max_personas}} p</span>  <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div id="t_{{$tipoServicio[2]}}_BUS" class="tab-pane fade">
                                                @foreach($services as $service)
                                                    @if($service->grupo==$tipoServicio[2])
                                                        <?php
                                                        $precio=$service->precio_venta;
                                                        ?>
                                                        @if($service->precio_grupo==1)
                                                            <?php
                                                            $precio=round($service->precio_venta/2,2);
                                                            ?>
                                                        @endif
                                                        @if($service->tipoServicio=='BUS')
                                                            <div id="service_{{$service->id}}" class="col-md-4 hide">
                                                                <div class="checkbox11">
                                                                    <label>
                                                                        <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                                        {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-10 bg-primary">{{$service->min_personas}}-{{$service->max_personas}} p</span>  <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                </div>
                                <div id="t_{{$tipoServicio[3]}}" class="hide col-lg-12">
                                    <ul class="nav nav-tabs">
                                        <li class="active bg-success"><a data-toggle="tab" href="#t_{{$tipoServicio[3]}}_GUIDE">GUIDE</a></li>
                                        <li class="bg-success"><a data-toggle="tab" href="#t_{{$tipoServicio[3]}}_TRANSFER">TRANSFER</a></li>
                                        <li class="bg-success"><a data-toggle="tab" href="#t_{{$tipoServicio[3]}}_ASSISTANCE">ASSISTANCE</a></li>
                                    </ul>
                                    {{--{{dd($tipos)}}--}}
                                    <div class="tab-content margin-top-20">
                                        <div id="t_{{$tipoServicio[3]}}_GUIDE" class="tab-pane fade in active">
                                            @foreach($services as $service)
                                                @if($service->grupo==$tipoServicio[3])
                                                    <?php
                                                    $precio=$service->precio_venta;
                                                    ?>
                                                    @if($service->precio_grupo==1)
                                                        <?php
                                                        $precio=round($service->precio_venta/2,2);
                                                        ?>
                                                    @endif
                                                    @if($service->tipoServicio=='GUIDE')
                                                        <div id="service_{{$service->id}}" class="col-md-4 hide">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                        <div id="t_{{$tipoServicio[3]}}_TRANSFER" class="tab-pane fade">
                                            @foreach($services as $service)
                                                @if($service->grupo==$tipoServicio[3])
                                                    <?php
                                                    $precio=$service->precio_venta;
                                                    ?>
                                                    @if($service->precio_grupo==1)
                                                        <?php
                                                        $precio=round($service->precio_venta/2,2);
                                                        ?>
                                                    @endif
                                                    @if($service->tipoServicio=='TRANSFER')
                                                        <div id="service_{{$service->id}}" class="col-md-4 hide">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                        <div id="t_{{$tipoServicio[3]}}_ASSISTANCE" class="tab-pane fade">
                                            @foreach($services as $service)
                                                @if($service->grupo==$tipoServicio[3])
                                                    <?php
                                                    $precio=$service->precio_venta;
                                                    ?>
                                                    @if($service->precio_grupo==1)
                                                        <?php
                                                        $precio=round($service->precio_venta/2,2);
                                                        ?>
                                                    @endif
                                                    @if($service->tipoServicio=='TRANSFER')
                                                        <div id="service_{{$service->id}}" class="col-md-4 hide">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div id="t_{{$tipoServicio[4]}}" class="hide col-lg-12">
                                    <ul class="nav nav-tabs">
                                        <li class="active bg-warning"><a data-toggle="tab" href="#t_{{$tipoServicio[4]}}_EXTRANJERO">EXTRANJERO</a></li>
                                        <li class="bg-warning"><a data-toggle="tab" href="#t_{{$tipoServicio[4]}}_NATIONAL">NATIONAL</a></li>
                                    </ul>
                                    {{--{{dd($tipos)}}--}}
                                    <div class="tab-content margin-top-20">
                                        <div id="t_{{$tipoServicio[4]}}_EXTRANJERO" class="tab-pane fade in active">
                                            @foreach($services as $service)
                                                @if($service->grupo==$tipoServicio[4])
                                                    <?php
                                                    $precio=$service->precio_venta;
                                                    ?>
                                                    @if($service->precio_grupo==1)
                                                        <?php
                                                        $precio=round($service->precio_venta/2,2);
                                                        ?>
                                                    @endif
                                                    @if($service->tipoServicio=='EXTRANJERO')
                                                        <div id="service_{{$service->id}}" class="col-md-4 hide">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                        <div id="t_{{$tipoServicio[4]}}_NATIONAL" class="tab-pane fade">
                                            @foreach($services as $service)
                                                @if($service->grupo==$tipoServicio[4])
                                                    <?php
                                                    $precio=$service->precio_venta;
                                                    ?>
                                                    @if($service->precio_grupo==1)
                                                        <?php
                                                        $precio=round($service->precio_venta/2,2);
                                                        ?>
                                                    @endif
                                                    @if($service->tipoServicio=='NATIONAL')
                                                        <div id="service_{{$service->id}}" class="col-md-4 hide">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                                <div id="t_{{$tipoServicio[5]}}" class="hide col-lg-12">
                                    <ul class="nav nav-tabs">
                                        <li class="active bg-danger"><a data-toggle="tab" href="#t_{{$tipoServicio[5]}}_LUNCH">LUNCH</a></li>
                                        <li class="bg-danger"><a data-toggle="tab" href="#t_{{$tipoServicio[5]}}_DINNER">DINNER</a></li>
                                        <li class="bg-danger"><a data-toggle="tab" href="#t_{{$tipoServicio[5]}}_BOX_LUNCH">BOX LUNCH</a></li>
                                    </ul>
                                    {{--{{dd($tipos)}}--}}
                                    <div class="tab-content margin-top-20">
                                        <div id="t_{{$tipoServicio[5]}}_LUNCH" class="tab-pane fade in active">
                                            @foreach($services as $service)
                                                @if($service->grupo==$tipoServicio[5])
                                                    <?php
                                                    $precio=$service->precio_venta;
                                                    ?>
                                                    @if($service->precio_grupo==1)
                                                        <?php
                                                        $precio=round($service->precio_venta/2,2);
                                                        ?>
                                                    @endif
                                                    @if($service->tipoServicio=='LUNCH')
                                                        <div id="service_{{$service->id}}" class="col-md-4 hide">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                        <div id="t_{{$tipoServicio[5]}}_DINNER" class="tab-pane fade">
                                            @foreach($services as $service)
                                                @if($service->grupo==$tipoServicio[5])
                                                    <?php
                                                    $precio=$service->precio_venta;
                                                    ?>
                                                    @if($service->precio_grupo==1)
                                                        <?php
                                                        $precio=round($service->precio_venta/2,2);
                                                        ?>
                                                    @endif
                                                    @if($service->tipoServicio=='DINNER')
                                                        <div id="service_{{$service->id}}" class="col-md-4 hide">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                        <div id="t_{{$tipoServicio[5]}}_BOX_LUNCH" class="tab-pane fade">
                                            @foreach($services as $service)
                                                @if($service->grupo==$tipoServicio[5])
                                                    <?php
                                                    $precio=$service->precio_venta;
                                                    ?>
                                                    @if($service->precio_grupo==1)
                                                        <?php
                                                        $precio=round($service->precio_venta/2,2);
                                                        ?>
                                                    @endif
                                                    @if($service->tipoServicio=='BOX LUNCH')
                                                        <div id="service_{{$service->id}}" class="col-md-4 hide">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div id="t_{{$tipoServicio[6]}}" class="hide col-lg-12">
                                    <ul class="nav nav-tabs">
                                        <li class="active bg-info"><a data-toggle="tab" href="#t_{{$tipoServicio[6]}}_EXPEDITION">EXPEDITION</a></li>
                                        <li class="bg-info"><a data-toggle="tab" href="#t_{{$tipoServicio[6]}}_VISITADOME">VISITADOME</a></li>
                                        <li class="bg-info"><a data-toggle="tab" href="#t_{{$tipoServicio[6]}}_EJECUTIVO">EJECUTIVO</a></li>
                                        <li class="bg-info"><a data-toggle="tab" href="#t_{{$tipoServicio[6]}}_FIRST_CLASS">FIRST CLASS</a></li>
                                        <li class="bg-info"><a data-toggle="tab" href="#t_{{$tipoServicio[6]}}_HIRAN_BINGHAN">HIRAN BINGHAN</a></li>
                                        <li class="bg-info"><a data-toggle="tab" href="#t_{{$tipoServicio[6]}}_PRESIDENTIAL">PRESIDENTIAL</a></li>
                                    </ul>
                                    {{--{{dd($tipos)}}--}}
                                    <div class="tab-content margin-top-20">
                                        <div id="t_{{$tipoServicio[6]}}_EXPEDITION" class="tab-pane fade in active">
                                            @foreach($services as $service)
                                                @if($service->grupo==$tipoServicio[6])
                                                    <?php
                                                    $precio=$service->precio_venta;
                                                    ?>
                                                    @if($service->precio_grupo==1)
                                                        <?php
                                                        $precio=round($service->precio_venta/2,2);
                                                        ?>
                                                    @endif
                                                    @if($service->tipoServicio=='EXPEDITION')
                                                        <div id="service_{{$service->id}}" class="col-md-4 hide">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-10 bg-primary">{{$service->salida}}-{{$service->llegada}}</span>  <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                        <div id="t_{{$tipoServicio[6]}}_VISITADOME" class="tab-pane fade">
                                            @foreach($services as $service)
                                                @if($service->grupo==$tipoServicio[6])
                                                    <?php
                                                    $precio=$service->precio_venta;
                                                    ?>
                                                    @if($service->precio_grupo==1)
                                                        <?php
                                                        $precio=round($service->precio_venta/2,2);
                                                        ?>
                                                    @endif
                                                    @if($service->tipoServicio=='VISITADOME')
                                                        <div id="service_{{$service->id}}" class="col-md-4 hide">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-10 bg-primary">{{$service->salida}}-{{$service->llegada}}</span>  <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                        <div id="t_{{$tipoServicio[6]}}_EJECUTIVO" class="tab-pane fade">
                                            @foreach($services as $service)
                                                @if($service->grupo==$tipoServicio[6])
                                                    <?php
                                                    $precio=$service->precio_venta;
                                                    ?>
                                                    @if($service->precio_grupo==1)
                                                        <?php
                                                        $precio=round($service->precio_venta/2,2);
                                                        ?>
                                                    @endif
                                                    @if($service->tipoServicio=='EJECUTIVO')
                                                        <div id="service_{{$service->id}}" class="col-md-4 hide">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-10 bg-primary">{{$service->salida}}-{{$service->llegada}}</span>  <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                        <div id="t_{{$tipoServicio[6]}}_FIRST_CLASS" class="tab-pane fade">
                                            @foreach($services as $service)
                                                @if($service->grupo==$tipoServicio[6])
                                                    <?php
                                                    $precio=$service->precio_venta;
                                                    ?>
                                                    @if($service->precio_grupo==1)
                                                        <?php
                                                        $precio=round($service->precio_venta/2,2);
                                                        ?>
                                                    @endif
                                                    @if($service->tipoServicio=='FIRST CLASS')
                                                        <div id="service_{{$service->id}}" class="col-md-4 hide">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-10 bg-primary">{{$service->salida}}-{{$service->llegada}}</span>  <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                        <div id="t_{{$tipoServicio[6]}}_HIRAN_BINGHAN" class="tab-pane fade">
                                            @foreach($services as $service)
                                                @if($service->grupo==$tipoServicio[6])
                                                    <?php
                                                    $precio=$service->precio_venta;
                                                    ?>
                                                    @if($service->precio_grupo==1)
                                                        <?php
                                                        $precio=round($service->precio_venta/2,2);
                                                        ?>
                                                    @endif
                                                    @if($service->tipoServicio=='HIRAN BINGHAN')
                                                        <div id="service_{{$service->id}}" class="col-md-4 hide">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-10 bg-primary">{{$service->salida}}-{{$service->llegada}}</span>  <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                        <div id="t_{{$tipoServicio[6]}}_PRESIDENTIAL" class="tab-pane fade">
                                            @foreach($services as $service)
                                                @if($service->grupo==$tipoServicio[6])
                                                    <?php
                                                    $precio=$service->precio_venta;
                                                    ?>
                                                    @if($service->precio_grupo==1)
                                                        <?php
                                                        $precio=round($service->precio_venta/2,2);
                                                        ?>
                                                    @endif
                                                    @if($service->tipoServicio=='PRESIDENTIAL')
                                                        <div id="service_{{$service->id}}" class="col-md-4 hide">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-10 bg-primary">{{$service->salida}}-{{$service->llegada}}</span>  <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div id="t_{{$tipoServicio[7]}}" class="hide col-lg-12">
                                    <ul class="nav nav-tabs">
                                        <li class="active bg-info"><a data-toggle="tab" href="#t_{{$tipoServicio[7]}}_NATIONAL">NATIONAL</a></li>
                                        <li class="bg-info"><a data-toggle="tab" href="#t_{{$tipoServicio[7]}}_INTERNATIONAL">INTERNATIONAL</a></li>
                                    </ul>
                                    {{--{{dd($tipos)}}--}}
                                    <div class="tab-content margin-top-20">
                                        <div id="t_{{$tipoServicio[7]}}_NATIONAL" class="tab-pane fade in active">
                                            @foreach($services as $service)
                                                @if($service->grupo==$tipoServicio[7])
                                                    <?php
                                                    $precio=$service->precio_venta;
                                                    ?>
                                                    @if($service->precio_grupo==1)
                                                        <?php
                                                        $precio=round($service->precio_venta/2,2);
                                                        ?>
                                                    @endif
                                                    @if($service->tipoServicio=='NATIONAL')
                                                        <div id="service_{{$service->id}}" class="col-md-4 hide">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                        <div id="t_{{$tipoServicio[7]}}_INTERNATIONAL" class="tab-pane fade">
                                            @foreach($services as $service)
                                                @if($service->grupo==$tipoServicio[7])
                                                    <?php
                                                    $precio=$service->precio_venta;
                                                    ?>
                                                    @if($service->precio_grupo==1)
                                                        <?php
                                                        $precio=round($service->precio_venta/2,2);
                                                        ?>
                                                    @endif
                                                    @if($service->tipoServicio=='INTERNATIONAL')
                                                        <div id="service_{{$service->id}}" class="col-md-4 hide">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div id="t_{{$tipoServicio[8]}}" class="hide col-lg-12">
                                    @php
                                    $array_tipos=array();
                                    @endphp
                                    @foreach($services as $service)
                                        @if($service->grupo==$tipoServicio[8])
                                            <?php
                                                $array_tipos[$service->tipoServicio]=$service->tipoServicio;
                                            ?>
                                        @endif
                                    @endforeach

                                    <ul class="nav nav-tabs">
                                        @foreach($array_tipos as $array_tipo)
                                            <li class="active bg-info"><a data-toggle="tab" href="#t_{{$tipoServicio[8]}}_{{$array_tipo}}">$array_tipo</a></li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content margin-top-20">
                                        @php
                                            $veces=' in active';
                                        @endphp
                                        @foreach($array_tipos as $array_tipo)

                                            <div id="t_{{$tipoServicio[8]}}_{{$array_tipo}}" class="tab-pane fade {{$veces}}">
                                                @foreach($services as $service)
                                                    @if($service->grupo==$tipoServicio[8])
                                                        <?php
                                                        $precio=$service->precio_venta;
                                                        ?>
                                                        @if($service->precio_grupo==1)
                                                            <?php
                                                            $precio=round($service->precio_venta/2,2);
                                                            ?>
                                                        @endif
                                                        @if($service->tipoServicio==$array_tipo)
                                                            <div id="service_{{$service->id}}" class="col-md-4 hide">
                                                                <div class="checkbox11">
                                                                    <label>
                                                                        <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                                        {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </div>
                                            @php
                                                $veces='';
                                            @endphp
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-lg-6 text-left text-16">
                                    <label class="text-green-goto">Total(cost without hotel) $<span id="total_ci_0"></span></label>
                                </div>
                                <div class="col-lg-6">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                            {{csrf_field()}}
                            <input type="hidden" name="precio_itinerario" id="precio_itinerario_0" value="0">
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="divider margin-top-20"></div>
            <div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    @php
                        $activo='active';
                    @endphp
                    @foreach($destinations as $destino)
                        <li role="presentation" class="{{$activo}}" data-toggle="tooltip" data-placement="top" title="{{$destino->destino}}"><a href="#{{$destino->id}}" aria-controls="home" role="tab" data-toggle="tab">{{$destino->codigo}}</a></li>
                        @if($activo=='active')
                            @php
                                $activo='';
                            @endphp
                        @endif
                    @endforeach
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    @php
                        $activo='active';
                    @endphp
                    @foreach($destinations as $destino)
                        <div role="tabpanel" class="tab-pane {{$activo}}" id="{{$destino->id}}">
                            <div class="margin-top-10"></div>
                            <table id="example{{$destino->id}}" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Titulo</th>
                                    <th>Descripcion</th>
                                    <th>Destinos</th>
                                    <th>Servicios</th>
                                    <th>Costo</th>
                                    <th>Operaciones</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Titulo</th>
                                    <th>Descripcion</th>
                                    <th>Destinos</th>
                                    <th>Servicios</th>
                                    <th>Costo</th>
                                    <th>Operaciones</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($itinerarios as $itinerario)
                                    @php
                                        $arreglo_dest=array();
                                    @endphp
                                    @foreach($itinerario->destinos as $destinos3)
                                        @php
                                            $arreglo_dest[]=$destinos3->destino;
                                        @endphp
                                    @endforeach
                                    @if(in_array($destino->destino,$arreglo_dest))
                                        <tr id="lista_itinerary_{{$itinerario->id}}">
                                        <td>{{$itinerario->titulo}}</td>
                                        <td>{!! substr($itinerario->descripcion,0,50) !!}...</td>
                                        <td>
                                            @foreach($itinerario->destinos as $destinos)
                                                <label for="" class="text-10 text-orange-goto">{{$destinos->destino}},</label>
                                            @endforeach
                                        </td>
                                        <td class="col-lg-3">
                                            @foreach($itinerario->itinerario_itinerario_servicios as $it_iti_servicio)
                                                <?php
                                                if($it_iti_servicio->itinerario_servicios_servicio->grupo!='HOTELS'){
                                                    $p_venta=$it_iti_servicio->itinerario_servicios_servicio->precio_venta;
                                                    if($it_iti_servicio->itinerario_servicios_servicio->precio_grupo==1)
                                                        $p_venta=round($it_iti_servicio->itinerario_servicios_servicio->precio_venta/2,2);
                                                }
                                                ?>
                                                @if($it_iti_servicio->itinerario_servicios_servicio->grupo=='TOURS')
                                                    <p class="text-unset text-11"><b class="text-primary text-13"><i class="fa fa-map-o" aria-hidden="true"></i></b> {{$it_iti_servicio->itinerario_servicios_servicio->nombre}} $ {{$p_venta}}</p>
                                                @endif
                                                @if($it_iti_servicio->itinerario_servicios_servicio->grupo=='MOVILID')
                                                    <p class="text-unset text-11"><b class="text-primary text-13"><i class="fa fa-bus" aria-hidden="true"></i></b> {{$it_iti_servicio->itinerario_servicios_servicio->nombre}} $ {{$p_venta}}</p>
                                                @endif
                                                @if($it_iti_servicio->itinerario_servicios_servicio->grupo=='REPRESENT')
                                                    <p class="text-unset text-11"><b class="text-primary text-13"><i class="fa fa-users" aria-hidden="true"></i></b> {{$it_iti_servicio->itinerario_servicios_servicio->nombre}} $ {{$p_venta}}</p>
                                                @endif
                                                @if($it_iti_servicio->itinerario_servicios_servicio->grupo=='ENTRANCES')
                                                    <p class="text-unset text-11"><b class="text-primary text-13"><i class="fa fa-ticket" aria-hidden="true"></i></b> {{$it_iti_servicio->itinerario_servicios_servicio->nombre}} $ {{$p_venta}}</p>
                                                @endif
                                                @if($it_iti_servicio->itinerario_servicios_servicio->grupo=='FOOD')
                                                    <p class="text-unset text-11"><b class="text-primary text-13"><i class="fa fa-cutlery" aria-hidden="true"></i></b> {{$it_iti_servicio->itinerario_servicios_servicio->nombre}} $ {{$p_venta}}</p>
                                                @endif
                                                @if($it_iti_servicio->itinerario_servicios_servicio->grupo=='TRAINS')
                                                    <p class="text-unset text-11"><b class="text-primary text-13"><i class="fa fa-train" aria-hidden="true"></i></b> {{$it_iti_servicio->itinerario_servicios_servicio->nombre}} $ {{$p_venta}}</p>
                                                @endif
                                                @if($it_iti_servicio->itinerario_servicios_servicio->grupo=='FLIGHTS')
                                                    <p class="text-unset text-11"><b class="text-primary text-13"><i class="fa fa-plane" aria-hidden="true"></i></b> {{$it_iti_servicio->itinerario_servicios_servicio->nombre}} $ {{$p_venta}}</p>
                                                @endif
                                                @if($it_iti_servicio->itinerario_servicios_servicio->grupo=='OTHERS')
                                                    <p class="text-unset text-11"><b class="text-primary text-13"><i class="fa fa-question" aria-hidden="true"></i></b> {{$it_iti_servicio->itinerario_servicios_servicio->nombre}} $ {{$p_venta}}</p>
                                                @endif

                                            @endforeach
                                        </td>
                                        <td>
                                            <?php
                                            $total_recio_venta=0;
                                            ?>
                                            @foreach($itinerario->itinerario_itinerario_servicios as $it_iti_servicio)
                                                <?php
                                                if($it_iti_servicio->itinerario_servicios_servicio->grupo!='HOTELS'){
                                                    $p_venta=$it_iti_servicio->itinerario_servicios_servicio->precio_venta;
                                                    if($it_iti_servicio->itinerario_servicios_servicio->precio_grupo==1)
                                                        $p_venta=round($it_iti_servicio->itinerario_servicios_servicio->precio_venta/2,2);
                                                    $total_recio_venta+=$p_venta;
                                                }
                                                ?>
                                            @endforeach
                                            <label for="" class="text-16 text-green-goto">${{$total_recio_venta}}</label>
                                        </td>
                                        <td>
                                            <a href="{{route('editar_dadybyday_parh',$itinerario->id)}}" class="btn btn-warning">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger" onclick="eliminar_itinerario('{{$itinerario->id}}','{{$itinerario->titulo}}')">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($activo=='active')
                            @php
                                $activo='';
                            @endphp
                        @endif
                    @endforeach
                </div>
            </div>

    <script>
        $(document).ready(function() {
            @foreach($destinations as $destino)
                $('#example{{$destino->id}}').DataTable();
            @endforeach
        } );

        function ValidarImagen(obj,nro){
            var uploadFile = obj.files[0];

            if (!window.FileReader) {
//                alert('El navegador no soporta la lectura de archivos');
                $('#mensaje_file'+nro).html('El navegador no soporta la lectura de archivos');
                $('#mensaje_file'+nro).removeClass('text-success');
                $('#mensaje_file'+nro).addClass('text-danger');
                return;
            }

            if (!(/\.(jpg|png|gif)$/i).test(uploadFile.name)) {
                $('#mensaje_file'+nro).html('El archivo a adjuntar no es una imagen');
                $('#mensaje_file'+nro).removeClass('text-success');
                $('#mensaje_file'+nro).addClass('text-danger');
//                alert('El archivo a adjuntar no es una imagen');
            }
            else {
                var img = new Image();
                img.onload = function () {
                    if (this.width.toFixed(0) != 360 && this.height.toFixed(0) != 360) {
                        $('#mensaje_file'+nro).html('Las medidas deben ser: 360 x 360, no '+this.width.toFixed(0)+'x'+this.height.toFixed(0));
                        $('#mensaje_file'+nro).removeClass('text-success');
                        $('#mensaje_file'+nro).addClass('text-danger');
//                        alert('Las medidas deben ser: 360 * 360');
                    }
                    else if (uploadFile.size > 20000000)
                    {
                        $('#mensaje_file'+nro).html('El peso de la imagen no puede exceder los 2Mb, no '+uploadFile.size);
                        $('#mensaje_file'+nro).removeClass('text-success');
                        $('#mensaje_file'+nro).addClass('text-danger');
//                         alert('El peso de la imagen no puede exceder los 200kb')
                    }
                    else {
                        $('#mensaje_file'+nro).html('Imagen correcta :)');
                        $('#mensaje_file'+nro).removeClass('text-danger');
                        $('#mensaje_file'+nro).addClass('text-success');

//                      alert('Imagen correcta :)')
                    }
                };
                img.src = URL.createObjectURL(uploadFile);
            }
        }
    </script>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'txt_descripcion' );
    </script>
@stop