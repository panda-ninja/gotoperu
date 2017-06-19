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
            <li>Database</li>
            <li class="active">Categories</li>
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
                    <form action="{{route('category_save_path')}}" method="post" id="destination_save_id" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txt_nombre">Nombre</label>
                                        <input type="text" class="form-control" id="txt_nombre" name="txt_nombre" placeholder="Nombre de la categoria">
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
        <table id="example" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Operaciones</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Operaciones</th>
            </tr>
            </tfoot>
            <tbody>
            <?php $i=1;?>
            @foreach($categorias as $categoria)
                <tr id="lista_categoria_{{$categoria->id}}">
                    <td>{{$i++}}</td>
                    <td>{{$categoria->nombre}}</td>
                    <td>
                        <button type="button" class="btn btn-warning"  data-toggle="modal" data-target="#modal_edit_categoria_{{$categoria->id}}">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-danger" onclick="eliminar_categoria1({{$categoria->id}},'{{$categoria->nombre}}')">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @foreach($categorias as $categoria)
        <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="modal_edit_categoria_{{$categoria->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form action="{{route('category_edit_path')}}" method="post" id="destination_edit_id" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit categoria</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="txt_nombre">Nombre</label>
                                            <input type="text" class="form-control" id="txt_nombre" name="txt_nombre" placeholder="Codigo" value="{{$categoria->nombre}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {{csrf_field()}}
                                <input type="hidden" id="id" name="id"   value="{{$categoria->id}}">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
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