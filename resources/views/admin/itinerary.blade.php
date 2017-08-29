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
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="txt_titulo">Titulo</label>
                                                <input type="text" class="form-control" id="txt_titulo" name="txt_titulo" placeholder="Titulo">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="txt_imagen">Imagen</label>
                                                <input type="file" class="form-control" id="txt_imagen" name="txt_imagen" placeholder="Imagen">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txt_descripcion">Descripcion</label>
                                        <textarea class="form-control" name="txt_descripcion" id="txt_descripcion" cols="30" rows="5"></textarea>
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
                                    {{--<div class="col-lg-3">--}}
                                        {{--<button id="filtro_1" class="btn btn-unset margin-top-10 margin-" type="button" onclick="escojerPos(1)"><i class="fa fa-map-o fa-3x" aria-hidden="true"></i> {{$tipoServicio[1]}}</button>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-lg-3">--}}
                                        {{--<button id="filtro_2" class="btn btn-unset margin-top-10 margin-" type="button" onclick="escojerPos(2)"><i class="fa fa-bus fa-3x" aria-hidden="true"></i> {{$tipoServicio[2]}}</button>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-lg-3">--}}
                                        {{--<button id="filtro_3" class="btn btn-unset margin-top-10 margin-" type="button" onclick="escojerPos(3)"><i class="fa fa-exchange fa-3x" aria-hidden="true"></i> {{$tipoServicio[3]}}</button>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-lg-3">--}}
                                        {{--<button id="filtro_4" class="btn btn-unset margin-top-10 margin-" type="button" onclick="escojerPos(4)"><i class="fa fa-ticket fa-3x" aria-hidden="true"></i> {{$tipoServicio[4]}}</button>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-lg-3">--}}
                                        {{--<button id="filtro_5" class="btn btn-unset margin-top-10 margin-" type="button" onclick="escojerPos(5)"><i class="fa fa-cutlery fa-3x" aria-hidden="true"></i> {{$tipoServicio[5]}}</button>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-lg-3">--}}
                                        {{--<button id="filtro_6" class="btn btn-unset margin-top-10 margin-" type="button" onclick="escojerPos(6)"><i class="fa fa-train fa-3x" aria-hidden="true"></i> {{$tipoServicio[6]}}</button>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-lg-3">--}}
                                        {{--<button id="filtro_7" class="btn btn-unset margin-top-10 margin-" type="button" onclick="escojerPos(7)"><i class="fa fa-plane fa-3x" aria-hidden="true"></i> {{$tipoServicio[7]}}</button>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-lg-3">--}}
                                        {{--<button id="filtro_8" class="btn btn-unset margin-top-10 margin-" type="button" onclick="escojerPos(8)"><i class="fa fa-question fa-3x" aria-hidden="true"></i> {{$tipoServicio[8]}}</button>--}}
                                    {{--</div>--}}




                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#t_{{$tipoServicio[1]}}" onclick="escojerPos(1)">{{$tipoServicio[1]}}</a></li>
                                    <li><a data-toggle="tab" href="#t_{{$tipoServicio[2]}}" onclick="escojerPos(2)">{{$tipoServicio[2]}}</a></li>
                                    <li><a data-toggle="tab" href="#t_{{$tipoServicio[3]}}" onclick="escojerPos(3)">{{$tipoServicio[3]}}</a></li>
                                    <li><a data-toggle="tab" href="#t_{{$tipoServicio[4]}}" onclick="escojerPos(4)">{{$tipoServicio[4]}}</a></li>
                                    <li><a data-toggle="tab" href="#t_{{$tipoServicio[5]}}" onclick="escojerPos(5)">{{$tipoServicio[5]}}</a></li>
                                    <li><a data-toggle="tab" href="#t_{{$tipoServicio[6]}}" onclick="escojerPos(6)">{{$tipoServicio[6]}}</a></li>
                                    <li><a data-toggle="tab" href="#t_{{$tipoServicio[7]}}" onclick="escojerPos(7)">{{$tipoServicio[7]}}</a></li>
                                    <li><a data-toggle="tab" href="#t_{{$tipoServicio[8]}}" onclick="escojerPos(8)">{{$tipoServicio[8]}}</a></li>
                                </ul>
                                <div class="tab-content margin-top-20">
                                    <div id="t_{{$tipoServicio[1]}}" class="tab-pane fade in active">
                                        @foreach($services as $service)
                                            @if($service->grupo==$tipoServicio[1])
                                                <?php
                                                    $precio=$service->precio_venta;
                                                ?>
                                                @if($service->precio_grupo==1)
                                                    <?php
                                                    $precio=ceil(ceil($service->precio_venta)/2);
                                                    ?>
                                                @endif
                                                <div  id="service_{{$service->id}}" class="col-md-4 hide">
                                                    <div class="checkbox11">
                                                        <label>
                                                            <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                            {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div id="t_{{$tipoServicio[2]}}" class="tab-pane fade">
                                        @foreach($services as $service)
                                            @if($service->grupo==$tipoServicio[2])
                                                <?php
                                                $precio=$service->precio_venta;
                                                ?>
                                                @if($service->precio_grupo==1)
                                                    <?php
                                                    $precio=round((round($service->precio_venta)/2),2);
                                                    ?>
                                                @endif
                                                <div id="service_{{$service->id}}"  class="col-md-4 hide">
                                                    <div class="checkbox11">
                                                        <label>
                                                            <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                            {{$service->nombre}} <span class="text-12 bg-primary">{{$service->min_personas}}-{{$service->max_personas}} p </span> <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach

                                    </div>
                                    <div id="t_{{$tipoServicio[3]}}" class="tab-pane fade">
                                        @foreach($services as $service)
                                            @if($service->grupo==$tipoServicio[3])
                                                <?php
                                                $precio=$service->precio_venta;
                                                ?>
                                                @if($service->precio_grupo==1)
                                                    <?php
                                                    $precio=ceil(ceil($service->precio_venta)/2);
                                                    ?>
                                                @endif
                                                <div id="service_{{$service->id}}"  class="col-md-4 hide">
                                                    <div class="checkbox11">
                                                        <label>
                                                            <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                            {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach

                                    </div>
                                    <div id="t_{{$tipoServicio[4]}}" class="tab-pane fade">
                                        @foreach($services as $service)
                                            @if($service->grupo==$tipoServicio[4])
                                                <?php
                                                $precio=$service->precio_venta;
                                                ?>
                                                @if($service->precio_grupo==1)
                                                    <?php
                                                    $precio=ceil(ceil($service->precio_venta)/2);
                                                    ?>
                                                @endif
                                                <div id="service_{{$service->id}}"  class="col-md-4 hide">
                                                    <div class="checkbox11">
                                                        <label>
                                                            <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                            {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach

                                    </div>
                                    <div id="t_{{$tipoServicio[5]}}" class="tab-pane fade">
                                        @foreach($services as $service)
                                            @if($service->grupo==$tipoServicio[5])
                                                <?php
                                                $precio=$service->precio_venta;
                                                ?>
                                                @if($service->precio_grupo==1)
                                                    <?php
                                                    $precio=ceil(ceil($service->precio_venta)/2);
                                                    ?>
                                                @endif
                                                <div id="service_{{$service->id}}"  class="col-md-4 hide">
                                                    <div class="checkbox11">
                                                        <label>
                                                            <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                            {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach

                                    </div>
                                    <div id="t_{{$tipoServicio[6]}}" class="tab-pane fade">
                                        @foreach($services as $service)
                                            @if($service->grupo==$tipoServicio[6])
                                                <?php
                                                $precio=$service->precio_venta;
                                                ?>
                                                @if($service->precio_grupo==1)
                                                    <?php
                                                    $precio=ceil(ceil($service->precio_venta)/2);
                                                    ?>
                                                @endif
                                                <div id="service_{{$service->id}}"  class="col-md-4 hide">
                                                    <div class="checkbox11">
                                                        <label>
                                                            <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                            {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div id="t_{{$tipoServicio[7]}}" class="tab-pane fade">
                                        @foreach($services as $service)
                                            @if($service->grupo==$tipoServicio[7])
                                                <?php
                                                $precio=$service->precio_venta;
                                                ?>
                                                @if($service->precio_grupo==1)
                                                    <?php
                                                    $precio=ceil(ceil($service->precio_venta)/2);
                                                    ?>
                                                @endif
                                                <div id="service_{{$service->id}}"  class="col-md-4 hide">
                                                    <div class="checkbox11">
                                                        <label>
                                                            <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                            {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div id="t_{{$tipoServicio[8]}}" class="tab-pane fade">
                                        @foreach($services as $service)
                                            @if($service->grupo==$tipoServicio[8])
                                                <?php
                                                $precio=$service->precio_venta;
                                                ?>
                                                @if($service->precio_grupo==1)
                                                    <?php
                                                    $precio=ceil(ceil($service->precio_venta)/2);
                                                    ?>
                                                @endif
                                                <div id="service_{{$service->id}}"  class="col-md-4 hide">
                                                    <div class="checkbox11">
                                                        <label>
                                                            <input type="checkbox" class="servicios" name="servicios[]" value="0_{{$precio}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios(0)">
                                                            {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$precio}} p.p</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
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
    <div class="row margin-top-20">
        <table id="example" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
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
                <tr id="lista_itinerary_{{$itinerario->id}}">
                    <td>{{$itinerario->titulo}}</td>
                    <td>{{$itinerario->descripcion}}</td>
                    <td>
                        @foreach($itinerario->destinos as $destinos)
                            <label for="" class="text-10 text-orange-goto">{{$destinos->destino}},</label>
                        @endforeach
                    </td>
                    <td>
                        @foreach($itinerario->itinerario_itinerario_servicios as $it_iti_servicio)
                            <p class="text-11">{{$it_iti_servicio->itinerario_servicios_servicio->nombre}}</p>
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
                                            $p_venta=ceil(ceil($it_iti_servicio->itinerario_servicios_servicio->precio_venta)/2);
                                        $total_recio_venta+=$p_venta;
                                    }
                                ?>
                        @endforeach
                            <label for="" class="text-16 text-green-goto">${{$total_recio_venta}}</label>
                    </td>
                    <td>
                        <button type="button" class="btn btn-warning"  data-toggle="modal" data-target="#e_modal_itinerario_{{$itinerario->id}}">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-danger" onclick="eliminar_itinerario('{{$itinerario->id}}','{{$itinerario->titulo}}')">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @foreach($itinerarios as $itinerario)
            <!-- Modal -->
                <div class="modal fade bd-example-modal-lg" id="e_modal_itinerario_{{$itinerario->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form action="{{route('itinerary_edit_path')}}" method="post" id="destination_save_id" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Day by Day</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="txt_titulo">Titulo</label>
                                                        <input type="text" class="form-control" id="txt_titulo" name="txt_titulo" placeholder="Titulo" value="{{$itinerario->titulo}}">

                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="txt_imagen">Imagen</label>
                                                        @if (Storage::disk('itinerary')->has($itinerario->imagen))
                                                            <picture>
                                                                <img
                                                                        src="{{route('itinerary_image_path', ['filename' => $itinerario->imagen])}}"  width="100" height="100">
                                                            </picture>
                                                            {{--<img src="{{ route('destination_image_path', ['filename' => $destino->imagen])}}" alt="" width="100px" height="100px">--}}
                                                            {{--                                                    <input type="file" id="file" name="file" class="dropify" data-default-file="{{ route('admin_itinerary_image_path', ['filename' => $destino->imagen])}}"/>--}}
                                                            <input type="file" class="form-control" id="txt_imagen" name="txt_imagen" placeholder="Imagen">
                                                        @else
                                                            <input type="file" class="form-control" id="txt_imagen" name="txt_imagen" placeholder="Imagen">
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="txt_descripcion">Descripcion</label>
                                                <textarea class="form-control" name="txt_descripcion" id="txt_descripcion" cols="30" rows="5">{{$itinerario->descripcion}}</textarea>
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
                                            <?php $estado=''?>
                                            @foreach($itinerario->destinos as $destino_id)
                                                @if($destino_id->destino==$destino->destino)
                                                        <?php $estado='checked'?>
                                                @endif
                                            @endforeach
                                                <div class="col-md-3">
                                                    <div class="checkbox11">
                                                        <label>
                                                            <input class="grupo_edit" type="checkbox" name="destinos[]" value="{{$destino->id}}_{{$destino->destino}}_{{$itinerario->id}}" onchange="filtrar_grupos_edit({{$itinerario->id}})" <?php echo $estado;  ?>>
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
                                        <?php
                                        $total_pre_ven_edit=0;
                                        ?>
                                        <ul class="nav nav-tabs">
                                            <li class="hide"><a data-toggle="tab" href="#et_{{$tipoServicio[0]}}_{{$itinerario->id}}" onclick="escojerPos(0)">{{$tipoServicio[0]}}</a></li>
                                            <li class="active"><a data-toggle="tab" href="#et_{{$tipoServicio[1]}}_{{$itinerario->id}}" onclick="escojerPos(1)">{{$tipoServicio[1]}}</a></li>
                                            <li><a data-toggle="tab" href="#et_{{$tipoServicio[2]}}_{{$itinerario->id}}" onclick="escojerPos(2)">{{$tipoServicio[2]}}</a></li>
                                            <li><a data-toggle="tab" href="#et_{{$tipoServicio[3]}}_{{$itinerario->id}}" onclick="escojerPos(3)">{{$tipoServicio[3]}}</a></li>
                                            <li><a data-toggle="tab" href="#et_{{$tipoServicio[4]}}_{{$itinerario->id}}" onclick="escojerPos(4)">{{$tipoServicio[4]}}</a></li>
                                            <li><a data-toggle="tab" href="#et_{{$tipoServicio[5]}}_{{$itinerario->id}}" onclick="escojerPos(5)">{{$tipoServicio[5]}}</a></li>
                                            <li><a data-toggle="tab" href="#et_{{$tipoServicio[6]}}_{{$itinerario->id}}" onclick="escojerPos(6)">{{$tipoServicio[6]}}</a></li>
                                            <li><a data-toggle="tab" href="#et_{{$tipoServicio[7]}}_{{$itinerario->id}}" onclick="escojerPos(7)">{{$tipoServicio[7]}}</a></li>
                                            <li><a data-toggle="tab" href="#et_{{$tipoServicio[8]}}_{{$itinerario->id}}" onclick="escojerPos(8)">{{$tipoServicio[8]}}</a></li>
                                        </ul>

                                        <div class="tab-content margin-top-20">
                                            <div id="et_{{$tipoServicio[0]}}_{{$itinerario->id}}" class="tab-pane fade in active">
                                                @foreach($services as $service)
                                                    <?php $estado=''?>
                                                    @if($service->grupo==$tipoServicio[0])
                                                        @foreach($itinerario->itinerario_itinerario_servicios as $service_id)
                                                            @if($service_id->m_servicios_id==$service->id)
                                                                <?php $estado='checked'?>
                                                                <?php $total_pre_ven_edit+=$service->precio_venta;?>
                                                            @endif
                                                        @endforeach
                                                            <div id="service_edit_{{$itinerario->id}}_{{$service->id}}" class="col-md-4">
                                                                <div class="checkbox11">
                                                                    <label>
                                                                        <input type="checkbox" class="servicios_edit" name="servicios{{$itinerario->id}}[]" value="{{$itinerario->id}}_{{0}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerario->id}})" {{$estado}}>
                                                                        {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{0.00}} p.p</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div id="et_{{$tipoServicio[1]}}_{{$itinerario->id}}" class="tab-pane fade">
                                                @foreach($services as $service)
                                                    <?php $estado=''?>
                                                    @if($service->grupo==$tipoServicio[1])
                                                        @foreach($itinerario->itinerario_itinerario_servicios as $service_id)

                                                            @if($service_id->m_servicios_id==$service->id)
                                                                <?php $estado='checked'?>
                                                                <?php $total_pre_ven_edit+=$service->precio_venta;?>
                                                            @endif

                                                        @endforeach
                                                            <div id="service_edit_{{$itinerario->id}}_{{$service->id}}" class="col-md-4">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerario->id}}[]" value="{{$itinerario->id}}_{{$service->precio_venta}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerario->id}})" {{$estado}}>
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service->precio_venta}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div id="et_{{$tipoServicio[2]}}_{{$itinerario->id}}" class="tab-pane fade">
                                                @foreach($services as $service)
                                                    <?php $estado=''?>
                                                    @if($service->grupo==$tipoServicio[2])
                                                        @foreach($itinerario->itinerario_itinerario_servicios as $service_id)

                                                            @if($service_id->m_servicios_id==$service->id)
                                                                <?php $estado='checked'?>
                                                                <?php $total_pre_ven_edit+=$service->precio_venta;?>
                                                            @endif

                                                        @endforeach
                                                            <div id="service_edit_{{$itinerario->id}}_{{$service->id}}" class="col-md-4">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerario->id}}[]" value="{{$itinerario->id}}_{{$service->precio_venta}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerario->id}})" {{$estado}}>
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service->precio_venta}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach

                                            </div>
                                            <div id="et_{{$tipoServicio[3]}}_{{$itinerario->id}}" class="tab-pane fade">
                                                @foreach($services as $service)
                                                    <?php $estado=''?>
                                                    @if($service->grupo==$tipoServicio[3])
                                                        @foreach($itinerario->itinerario_itinerario_servicios as $service_id)

                                                            @if($service_id->m_servicios_id==$service->id)
                                                                <?php $estado='checked'?>
                                                                <?php $total_pre_ven_edit+=$service->precio_venta;?>
                                                            @endif

                                                        @endforeach
                                                            <div id="service_edit_{{$itinerario->id}}_{{$service->id}}" class="col-md-4">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerario->id}}[]" value="{{$itinerario->id}}_{{$service->precio_venta}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerario->id}})" {{$estado}}>
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service->precio_venta}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach

                                            </div>
                                            <div id="et_{{$tipoServicio[4]}}_{{$itinerario->id}}" class="tab-pane fade">
                                                @foreach($services as $service)
                                                    <?php $estado=''?>
                                                    @if($service->grupo==$tipoServicio[4])
                                                        @foreach($itinerario->itinerario_itinerario_servicios as $service_id)

                                                            @if($service_id->m_servicios_id==$service->id)
                                                                <?php $estado='checked'?>
                                                                <?php $total_pre_ven_edit+=$service->precio_venta;?>
                                                            @endif

                                                        @endforeach
                                                            <div id="service_edit_{{$itinerario->id}}_{{$service->id}}" class="col-md-4">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerario->id}}[]" value="{{$itinerario->id}}_{{$service->precio_venta}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerario->id}})" {{$estado}}>
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service->precio_venta}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach

                                            </div>
                                            <div id="et_{{$tipoServicio[5]}}_{{$itinerario->id}}" class="tab-pane fade">
                                                @foreach($services as $service)
                                                    <?php $estado=''?>
                                                    @if($service->grupo==$tipoServicio[5])
                                                        @foreach($itinerario->itinerario_itinerario_servicios as $service_id)

                                                            @if($service_id->m_servicios_id==$service->id)
                                                                <?php $estado='checked'?>
                                                                <?php $total_pre_ven_edit+=$service->precio_venta;?>
                                                            @endif

                                                        @endforeach
                                                            <div id="service_edit_{{$itinerario->id}}_{{$service->id}}" class="col-md-4">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerario->id}}[]" value="{{$itinerario->id}}_{{$service->precio_venta}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerario->id}})" {{$estado}}>
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service->precio_venta}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach

                                            </div>
                                            <div id="et_{{$tipoServicio[6]}}_{{$itinerario->id}}" class="tab-pane fade">
                                                @foreach($services as $service)
                                                    <?php $estado=''?>
                                                    @if($service->grupo==$tipoServicio[6])
                                                        @foreach($itinerario->itinerario_itinerario_servicios as $service_id)

                                                            @if($service_id->m_servicios_id==$service->id)
                                                                <?php $estado='checked'?>
                                                                <?php $total_pre_ven_edit+=$service->precio_venta;?>
                                                            @endif

                                                        @endforeach
                                                            <div id="service_edit_{{$itinerario->id}}_{{$service->id}}" class="col-md-4">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerario->id}}[]" value="{{$itinerario->id}}_{{$service->precio_venta}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerario->id}})" {{$estado}}>
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service->precio_venta}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                    @endif
                                                @endforeach
                                            </div>
                                            <div id="et_{{$tipoServicio[7]}}_{{$itinerario->id}}" class="tab-pane fade">
                                                @foreach($services as $service)
                                                    <?php $estado=''?>
                                                    @if($service->grupo==$tipoServicio[7])
                                                        @foreach($itinerario->itinerario_itinerario_servicios as $service_id)

                                                            @if($service_id->m_servicios_id==$service->id)
                                                                <?php $estado='checked'?>
                                                                <?php $total_pre_ven_edit+=$service->precio_venta;?>
                                                            @endif

                                                        @endforeach
                                                            <div id="service_edit_{{$itinerario->id}}_{{$service->id}}" class="col-md-4">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerario->id}}[]" value="{{$itinerario->id}}_{{$service->precio_venta}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerario->id}})" {{$estado}}>
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service->precio_venta}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                    @endif
                                                @endforeach
                                            </div>
                                            <div id="et_{{$tipoServicio[8]}}_{{$itinerario->id}}" class="tab-pane fade">
                                                @foreach($services as $service)
                                                    <?php $estado=''?>
                                                    @if($service->grupo==$tipoServicio[8])
                                                        @foreach($itinerario->itinerario_itinerario_servicios as $service_id)

                                                            @if($service_id->m_servicios_id==$service->id)
                                                                <?php $estado='checked'?>
                                                                <?php $total_pre_ven_edit+=$service->precio_venta;?>
                                                            @endif

                                                        @endforeach
                                                            <div id="service_edit_{{$itinerario->id}}_{{$service->id}}" class="col-md-4">
                                                            <div class="checkbox11">
                                                                <label>
                                                                    <input type="checkbox" class="servicios_edit" name="servicios{{$itinerario->id}}[]" value="{{$itinerario->id}}_{{$service->precio_venta}}_{{$service->id}}_{{$service->localizacion}}" onchange="sumar_servicios_edit({{$itinerario->id}})" {{$estado}}>
                                                                    {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service->precio_venta}} p.p</span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="row">
                                        <div class="col-lg-6 text-left text-16">
                                            <label class="text-green-goto">Total $<span id="total_ci_{{$itinerario->id}}">{{$total_pre_ven_edit}}</span></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                    {{csrf_field()}}
                                    <input type="hidden" name="precio_itinerario" id="precio_itinerario" value="{{$total_pre_ven_edit}}">
                                    <input type="hidden" name="itinerario_id" id="itinerario_id" value="{{$itinerario->id}}">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            @endforeach
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@stop