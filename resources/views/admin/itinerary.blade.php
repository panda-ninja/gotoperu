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
            <li>Sales</li>
            <li class="active">Itinerary</li>
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
                            <h5 class="modal-title" id="exampleModalLabel">New itinerary</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txt_titulo">Titulo</label>
                                        <input type="text" class="form-control" id="txt_titulo" name="txt_titulo" placeholder="Titulo">
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
                                        <label>
                                            <input type="checkbox" name="destinos[]" value="{{$destino->id}}">
                                            {{$destino->destino}}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="row margin-top-20">
                                <?php
                                $tipoServicio[0]='HOTELS';
                                $tipoServicio[1]='TOURS';
                                $tipoServicio[2]='TRANSPORTATION';
                                $tipoServicio[3]='GUIDES_ASSIST';
                                $tipoServicio[4]='ENTRANCES';
                                $tipoServicio[5]='FOOD';
                                $tipoServicio[6]='OTHERS';
                                ?>
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#t_{{$tipoServicio[0]}}" onclick="escojerPos(0)">{{$tipoServicio[0]}}</a></li>
                                    <li><a data-toggle="tab" href="#t_{{$tipoServicio[1]}}" onclick="escojerPos(1)">{{$tipoServicio[1]}}</a></li>
                                    <li><a data-toggle="tab" href="#t_{{$tipoServicio[2]}}" onclick="escojerPos(2)">{{$tipoServicio[2]}}</a></li>
                                    <li><a data-toggle="tab" href="#t_{{$tipoServicio[3]}}" onclick="escojerPos(3)">{{$tipoServicio[3]}}</a></li>
                                    <li><a data-toggle="tab" href="#t_{{$tipoServicio[4]}}" onclick="escojerPos(4)">{{$tipoServicio[4]}}</a></li>
                                    <li><a data-toggle="tab" href="#t_{{$tipoServicio[5]}}" onclick="escojerPos(5)">{{$tipoServicio[5]}}</a></li>
                                    <li><a data-toggle="tab" href="#t_{{$tipoServicio[6]}}" onclick="escojerPos(6)">{{$tipoServicio[6]}}</a></li>
                                </ul>

                                <div class="tab-content margin-top-20">
                                    <div id="t_{{$tipoServicio[0]}}" class="tab-pane fade in active">
                                        @foreach($services as $service)
                                            @if($service->grupo==$tipoServicio[0])
                                            <div class="col-md-4">
                                                <div class="checkbox11">
                                                    <label>
                                                        <input type="checkbox" name="servicios[]" value="{{$service->id}}">
                                                        {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service->precio_venta}} p.p</span>
                                                    </label>
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div id="t_{{$tipoServicio[1]}}" class="tab-pane fade">
                                        @foreach($services as $service)
                                            @if($service->grupo==$tipoServicio[1])
                                                <div class="col-md-4">
                                                    <div class="checkbox11">
                                                        <label>
                                                            <input type="checkbox" name="servicios[]" value="{{$service->id}}">
                                                            {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service->precio_venta}} p.p</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div id="t_{{$tipoServicio[2]}}" class="tab-pane fade">
                                        @foreach($services as $service)
                                            @if($service->grupo==$tipoServicio[2])
                                                <div class="col-md-4">
                                                    <div class="checkbox11">
                                                        <label>
                                                            <input type="checkbox" name="servicios[]" value="{{$service->id}}">
                                                            {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service->precio_venta}} p.p</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach

                                    </div>
                                    <div id="t_{{$tipoServicio[3]}}" class="tab-pane fade">
                                        @foreach($services as $service)
                                            @if($service->grupo==$tipoServicio[3])
                                                <div class="col-md-4">
                                                    <div class="checkbox11">
                                                        <label>
                                                            <input type="checkbox" name="servicios[]" value="{{$service->id}}">
                                                            {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service->precio_venta}} p.p</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach

                                    </div>
                                    <div id="t_{{$tipoServicio[4]}}" class="tab-pane fade">
                                        @foreach($services as $service)
                                            @if($service->grupo==$tipoServicio[4])
                                                <div class="col-md-4">
                                                    <div class="checkbox11">
                                                        <label>
                                                            <input type="checkbox" name="servicios[]" value="{{$service->id}}">
                                                            {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service->precio_venta}} p.p</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach

                                    </div>
                                    <div id="t_{{$tipoServicio[5]}}" class="tab-pane fade">
                                        @foreach($services as $service)
                                            @if($service->grupo==$tipoServicio[5])
                                                <div class="col-md-4">
                                                    <div class="checkbox11">
                                                        <label>
                                                            <input type="checkbox" name="servicios[]" value="{{$service->id}}">
                                                            {{$service->nombre}} <span class="text-10 text-green-goto">{{$service->localizacion}}</span> <span class="text-12 text-orange-goto">$ {{$service->precio_venta}} p.p</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach

                                    </div>
                                    <div id="t_{{$tipoServicio[6]}}" class="tab-pane fade">
                                        @foreach($services as $service)
                                            @if($service->grupo==$tipoServicio[6])
                                                <div class="col-md-4">
                                                    <div class="checkbox11">
                                                        <label>
                                                            <input type="checkbox" name="servicios[]" value="{{$service->id}}">
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
                            {{csrf_field()}}
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row margin-top-20">

    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@stop