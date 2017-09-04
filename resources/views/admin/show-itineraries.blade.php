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
            <li>Itineraries</li>
            <li class="active">List</li>
        </ol>
    </div>
    <div class="row margin-top-20">
        </div>
    <div class="row margin-top-20">

        <table id="example" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Codigo</th>
                <th>Titulo</th>
                <th>Destinos</th>
                <th>Operaciones</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Codigo</th>
                <th>Titulo</th>
                <th>Destinos</th>
                <th>Operaciones</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($itineraries->sortByDesc('fecha') as $itinerary)
                <tr id="lista_destinos_{{$itinerary->id}}">
                    <td>{{$itinerary->codigo}}</td>
                    <td><a href="{{route('show_itinerary_path',$itinerary->id)}}">{{$itinerary->titulo}} x {{$itinerary->duracion}} DAYS</a></td>
                    <td>
                        @php
                        $arra_destinos=array();
                        @endphp
                        @foreach($itinerary->itinerarios as $itinerario)
                            @foreach($itinerario->destinos as $destino)
                                @php
                                    $arra_destinos[$destino->destino]=$destino->destino;
                                @endphp
                            @endforeach
                        @endforeach
                        @foreach($arra_destinos as $destino)
                                <p class="text-12 text-unset"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$destino}}</p>
                        @endforeach
                    </td>
                    <td>
                        <button type="button" class="btn btn-warning"  data-toggle="modal" data-target="#modal_edit_destination_{{$itinerary->id}}">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </button>
                        <a href="{{route('package_pdf_path',$itinerary->id)}}" type="button" class="btn btn-success">
                            <i class="fa fa-download" aria-hidden="true"></i>
                        </a>
                        <a href="{{route('duplicate_package_path',$itinerary->id)}}" type="button" class="btn btn-primary">
                            <i class="fa fa-files-o" aria-hidden="true"></i>
                        </a>
                        {{csrf_field()}}
                        <button type="button" class="btn btn-danger" onclick="eliminar_paquete('{{$itinerary->id}}','{{$itinerary->titulo}} x {{$itinerary->duracion}} DAYS')">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @foreach($itineraries->sortByDesc('fecha') as $itinerary)
        <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="modal_edit_destination_{{$itinerary->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-m" role="document">
                    <div class="modal-content">
                        <form action="{{route('destination_edit_path')}}" method="post" id="destination_edit_id" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Outline</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h2 class="text-center text-primary">{{$itinerary->titulo}} x {{$itinerary->duracion}} DAYS</h2>
                                <ul class="list-group">
                                @foreach($itinerary->itinerarios as $itinerario)
                                    <li class="list-group-item"><b class="col-sm-2 text-primary">Dia :{{$itinerario->dias}}</b>{{$itinerario->titulo}}</li>
                                @endforeach
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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