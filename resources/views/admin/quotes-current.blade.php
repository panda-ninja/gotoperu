@extends('.layouts.admin')
@section('archivos-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .ui-autocomplete {
            z-index: 5000 !important;
        }
    </style>
@stop
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Quotes</li>
            <li class="active">New</li>
        </ol>
    </div>
    <form action="{{route('cotizacion_show_path')}}" method="post" id="package_new_path_id">
        <div class="row">
            <div class="col-md-12">
                <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">1</span> Search client</h4>
                <div class="divider margin-bottom-20"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="txt_name">Name</label>
                    <input type="text" class="form-control" id="txt_name" name="txt_name" placeholder="Name" required>
                </div>
            </div>
            <div class="col-md-3 text-center margin-top-20">
                {{csrf_field()}}
                <button type="submit" class="btn btn-lg btn-primary">Search <i class="fa fa-search-plus" aria-hidden="true"></i></button>
            </div>
        </div>

    </form>
    <div id="lista_cotizacione" class="margin-top-10">
        <?php
        $planes[]='A';
        $planes[]='B';
        $planes[]='C';
        $planes[]='D';
        $planes[]='E';
        $planes[]='F';
        $pos_plan=0;
        $cotizacion_=null;
        ?>
        @if($cotizacion!=null)
            @foreach($cotizacion as $cotizacion1)
                <?php
                    $cotizacion_=$cotizacion1;
                ?>
            @endforeach
            @foreach($cotizacion_->paquete_cotizaciones as $paquete)
                @if($cotizacion_->estado==2)
                        @if($paquete->estado==2)
                            <div class="col-md-3 margin-top-10">
                                <div class="portada-pdf">
                                    <img src="{{asset('img/portada/proposal-martin-pdf.jpg')}}" alt="" class="img-responsive">
                                    <div class="box-dowload1">
                                        <b class="margin-top-5"><i class="fa fa-file-pdf-o text-danger" aria-hidden="true"></i> proposal</b>
                                        <a href="{{route('quotes_pdf_path',$paquete->id)}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a>
                                        <a href="#" class="pull-right btn btn-success btn-sm">
                                            <i class="fa fa-toggle-on" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <div class="box-letter-proposal text-center">
                                        <span class="text-orange-goto">{{$planes[$pos_plan]}}</span>
                                    </div>
                                </div>
                            </div>
                        @elseif($paquete->estado==1)
                            <div class="col-md-3 margin-top-10">
                                <div class="portada-pdf">
                                    <img src="{{asset('img/portada/proposal-martin-pdf.jpg')}}" alt="" class="img-responsive">
                                    <div class="box-dowload">
                                        <b class="margin-top-5"><i class="fa fa-file-pdf-o text-danger" aria-hidden="true"></i> proposal</b>
                                        <a href="{{route('quotes_pdf_path',$paquete->id)}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a>
                                        <button type="submit"  class="pull-right btn btn-danger btn-sm">
                                                <i class="fa fa-toggle-off" aria-hidden="true"></i>
                                            </button>
                                    </div>
                                    <div class="box-letter-proposal text-center">
                                        <span class="text-orange-goto">{{$planes[$pos_plan]}}</span>
                                    </div>
                                </div>
                            </div>

                        @endif
                @else
                    @if($paquete->estado==2)
                        <div class="col-md-3 margin-top-10">
                            <div class="portada-pdf">
                                <img src="{{asset('img/portada/proposal-martin-pdf.jpg')}}" alt="" class="img-responsive">
                                <div class="box-dowload1">
                                    <b class="margin-top-5"><i class="fa fa-file-pdf-o text-danger" aria-hidden="true"></i> proposal</b>
                                    <a href="{{route('quotes_pdf_path',$paquete->id)}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a>
                                    <a href="#" class="pull-right btn btn-success btn-sm">
                                        <i class="fa fa-toggle-on" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="box-letter-proposal text-center">
                                    <span class="text-orange-goto">{{$planes[$pos_plan]}}</span>
                                </div>
                            </div>
                        </div>
                    @elseif($paquete->estado==1)
                        <div class="col-md-3 margin-top-10">
                            <div class="portada-pdf">
                                <img src="{{asset('img/portada/proposal-martin-pdf.jpg')}}" alt="" class="img-responsive">
                                <div class="box-dowload">
                                    <b class="margin-top-5"><i class="fa fa-file-pdf-o text-danger" aria-hidden="true"></i> proposal</b>
                                    {{csrf_field()}}
                                    <a href="{{route('quotes_pdf_path',$paquete->id)}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a>
                                    <button type="button" id="plan_{{$pos_plan}}"  class="planes pull-right btn btn-danger btn-sm" onclick="activarPlan('{{$paquete->id}}','{{$cotizacion_->nombre}}','{{$cotizacion_->id}}','{{$pos_plan}}')">
                                        <i class="fa fa-toggle-off" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div class="box-letter-proposal text-center">
                                    <span class="text-orange-goto">{{$planes[$pos_plan]}}</span>
                                </div>
                            </div>
                        </div>

                    @endif
                @endif
                <?php
                $pos_plan++;
                ?>
            @endforeach
                <input type="hidden" name="nro_planes" id="nro_planes" value="{{$pos_plan}}">
        @endif
</div>

<script>
$(function () {
$('#txt_name').autocomplete({
    source: function(request, response) {
        $.ajax({
            url: "buscar-cotizacion",
            dataType: "json",
            data: {
                term : request.term
                {{--localizacion : $("#localizacion1_{{$i}}").val(),--}}
                {{--grupo : '{{$tipoServicio_}}'--}}
            },
            success: function(data) {
                response(data);
            }
        });
    },
    minLength: 1
});
});
</script>
@stop
