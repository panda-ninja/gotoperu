@php
    $destinos_usados=array();
@endphp
@foreach($hotel_solo as $hotel_)
    @if(!in_array($hotel_->localizacion,$destinos_usados))
        @php
            $destinos_usados[]=$hotel_->localizacion;
        @endphp
    @endif
@endforeach

@extends('layouts.admin.admin')
@section('archivos-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .ui-autocomplete {
            z-index: 5000 !important;
        }
    </style>
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
            <li>Costs</li>
            <li>Hotel</li>
            <li class="active">Edit</li>
        </ol>
    </div>
    <div class="row margin-top-20">
        <div class="margin-top-20 panel panel-default panel-floating panel-floating-inline" id="modal_new_cost">
            <div class="panel-body">
                <form  action="{{route('hotel_proveedor_edit_path')}}" method="post" id="service_save_id" enctype="multipart/form-data">
                    @foreach($categorias as $categoria)
                        <?php
                        $tipoServicio[]=$categoria->nombre;
                        ?>
                    @endforeach
                    @php
                        $pos0=0;
                    @endphp
                    <div class="tab-content">
                            <div id="hotel" class="tab-pane fade in active">
                                <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_codigo">Location</label>
                                                {{--<input type="text" class="form-control" id="txt_localizacion_0" name="txt_localizacion_0" placeholder="Location">--}}
                                                <select class="form-control" id="txt_localizacion_{{$pos0}}" name="txt_localizacion_{{$pos0}}" onchange="mostrar_hoteles('{{$pos0}}')" readonly="readonly">
                                                   @foreach($destinations as $destination)
                                                        @if(in_array($destination->destino,$destinos_usados))
                                                            @php
                                                                $seleccinar='';
                                                            @endphp
                                                            @if($destination->destino==$localizacion)
                                                                @php
                                                                    $seleccinar='selected';
                                                                @endphp
                                                                <option value="{{$destination->destino}}" {{$seleccinar}}>{{$destination->destino}}</option>
                                                            @endif

                                                        {{--@else--}}
                                                            {{--<option value="{{$destination->destino}}" disabled="disabled">{{$destination->destino}} -> agregar los producto</option>--}}
                                                        @endif
                                                    @endforeach
                                                </select>

                                                <input type="hidden" name="tipoServicio_{{$pos0}}" id="tipoServicio_{{$pos0}}" value="{{$categoria->nombre}}">
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group col-md-9">
                                                <label for="txt_precio">Provider</label>
                                                <input type="text" class="form-control" id="txt_provider_0" name="txt_provider_0" placeholder="Provider" value="{{$proveedor_escojido->codigo}} {{$proveedor_escojido->razon_social}}" required>
                                            </div>
                                            <div class="col-md-3 margin-top-25 ">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_new_provider" onclick="pasar_pos_provider('0')">
                                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            @php
                                                $S_2=0.00;
                                                $D_2=0.00;
                                                $M_2=0.00;
                                                $T_2=0.00;

                                                $S_3=0.00;
                                                $D_3=0.00;
                                                $M_3=0.00;
                                                $T_3=0.00;

                                                $S_4=0.00;
                                                $D_4=0.00;
                                                $M_4=0.00;
                                                $T_4=0.00;

                                                $S_5=0.00;
                                                $D_5=0.00;
                                                $M_5=0.00;
                                                $T_5=0.00;

                                                $SS_2=0.00;
                                                $SS_3=0.00;
                                                $SS_4=0.00;
                                                $SS_5=0.00;

                                                $SD_2=0.00;
                                                $SD_3=0.00;
                                                $SD_4=0.00;
                                                $SD_5=0.00;

                                                $SU_2=0.00;
                                                $SU_3=0.00;
                                                $SU_4=0.00;
                                                $SU_5=0.00;

                                                $JS_2=0.00;
                                                $JS_3=0.00;
                                                $JS_4=0.00;
                                                $JS_5=0.00;

                                                $hotel_id_2=0;
                                                $hotel_id_3=0;
                                                $hotel_id_4=0;
                                                $hotel_id_5=0;

                                                $hotel_pro_id_2=0;
                                                $hotel_pro_id_3=0;
                                                $hotel_pro_id_4=0;
                                                $hotel_pro_id_5=0;


                                            @endphp
                                            @foreach($hotel_proveedor_buscado as $hotel_pro)
                                                @if($hotel_pro->estrellas=='2')
                                                    @php
                                                        $hotel_id_2=$hotel_pro->hotel_id;
                                                        $hotel_pro_id_2=$hotel_pro->id;
                                                        $S_2=$hotel_pro->single;
                                                        $D_2=$hotel_pro->doble;
                                                        $M_2=$hotel_pro->matrimonial;
                                                        $T_2=$hotel_pro->triple;
                                                        $SS_2=$hotel_pro->superior_s;
                                                        $SD_2=$hotel_pro->superior_d;
                                                        $SU_2=$hotel_pro->suite;
                                                        $JS_2=$hotel_pro->jr_suite;
                                                    @endphp
                                                @endif
                                                @if($hotel_pro->estrellas=='3')
                                                    @php
                                                        $hotel_id_3=$hotel_pro->hotel_id;
                                                        $hotel_pro_id_3=$hotel_pro->id;
                                                        $S_3=$hotel_pro->single;
                                                        $D_3=$hotel_pro->doble;
                                                        $M_3=$hotel_pro->matrimonial;
                                                        $T_3=$hotel_pro->triple;
                                                        $SS_3=$hotel_pro->superior_s;
                                                        $SD_3=$hotel_pro->superior_d;
                                                        $SU_3=$hotel_pro->suite;
                                                        $JS_3=$hotel_pro->jr_suite;
                                                    @endphp
                                                @endif
                                                @if($hotel_pro->estrellas=='4')
                                                    @php
                                                        $hotel_id_4=$hotel_pro->hotel_id;
                                                        $hotel_pro_id_4=$hotel_pro->id;
                                                        $S_4=$hotel_pro->single;
                                                        $D_4=$hotel_pro->doble;
                                                        $M_4=$hotel_pro->matrimonial;
                                                        $T_4=$hotel_pro->triple;
                                                        $SS_4=$hotel_pro->superior_s;
                                                        $SD_4=$hotel_pro->superior_d;
                                                        $SU_4=$hotel_pro->suite;
                                                        $JS_4=$hotel_pro->jr_suite;
                                                    @endphp
                                                @endif
                                                @if($hotel_pro->estrellas=='5')
                                                    @php
                                                        $hotel_id_5=$hotel_pro->hotel_id;
                                                        $hotel_pro_id_5=$hotel_pro->id;
                                                        $S_5=$hotel_pro->single;
                                                        $D_5=$hotel_pro->doble;
                                                        $M_5=$hotel_pro->matrimonial;
                                                        $T_5=$hotel_pro->triple;
                                                        $SS_5=$hotel_pro->superior_s;
                                                        $SD_5=$hotel_pro->superior_d;
                                                        $SU_5=$hotel_pro->suite;
                                                        $JS_5=$hotel_pro->jr_suite;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <table class="table table-responsive table-striped table-condensed">
                                                <thead>
                                                <tr>
                                                    <th class="col-lg-2 text-primary">ACOMODATION</th>
                                                    <th class="col-lg-2 text-warning text-center text-15">2 <i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i></th>
                                                    <th class="col-lg-2 text-warning text-center text-15">3 <i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i></th>
                                                    <th class="col-lg-2 text-warning text-center text-15">4 <i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i></th>
                                                    <th class="col-lg-2 text-warning text-center text-15">5 <i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>SIMGLE</td>
                                                    <td><input type="number" name="S_2" id="S_2" class="form-control" min="0" step="0.01" value="{{$S_2}}"></td>
                                                    <td><input type="number" name="S_3" id="S_3" class="form-control" min="0" step="0.01" value="{{$S_3}}"></td>
                                                    <td><input type="number" name="S_4" id="S_4" class="form-control" min="0" step="0.01" value="{{$S_4}}"></td>
                                                    <td><input type="number" name="S_5" id="S_5" class="form-control" min="0" step="0.01" value="{{$S_5}}"></td>
                                                </tr>
                                                <tr>
                                                    <td>DOUBLE</td>
                                                    <td><input type="number" name="D_2" id="D_2" class="form-control" min="0" step="0.01" value="{{$D_2}}"></td>
                                                    <td><input type="number" name="D_3" id="D_3" class="form-control" min="0" step="0.01" value="{{$D_3}}"></td>
                                                    <td><input type="number" name="D_4" id="D_4" class="form-control" min="0" step="0.01" value="{{$D_4}}"></td>
                                                    <td><input type="number" name="D_5" id="D_5" class="form-control" min="0" step="0.01" value="{{$D_5}}"></td>
                                                </tr>
                                                <tr>
                                                    <td>MATRIMONIAL</td>
                                                    <td><input type="number" name="M_2" id="M_2" class="form-control" min="0" step="0.01" value="{{$M_2}}"></td>
                                                    <td><input type="number" name="M_3" id="M_3" class="form-control" min="0" step="0.01" value="{{$M_3}}"></td>
                                                    <td><input type="number" name="M_4" id="M_4" class="form-control" min="0" step="0.01" value="{{$M_4}}"></td>
                                                    <td><input type="number" name="M_5" id="M_5" class="form-control" min="0" step="0.01" value="{{$M_5}}"></td>
                                                </tr>
                                                <tr>
                                                    <td>TRIPLE</td>
                                                    <td><input type="number" name="T_2" id="T_2" class="form-control" min="0" step="0.01" value="{{$T_2}}"></td>
                                                    <td><input type="number" name="T_3" id="T_3" class="form-control" min="0" step="0.01" value="{{$T_3}}"></td>
                                                    <td><input type="number" name="T_4" id="T_4" class="form-control" min="0" step="0.01" value="{{$T_4}}"></td>
                                                    <td><input type="number" name="T_5" id="T_5" class="form-control" min="0" step="0.01" value="{{$T_5}}"></td>
                                                </tr>
                                                <tr>
                                                    <td>SUPERIOR SIMPLE</td>
                                                    <td><input type="number" name="SS_2" id="SS_2" class="form-control" min="0" step="0.01" value="{{$SS_2}}"></td>
                                                    <td><input type="number" name="SS_3" id="SS_3" class="form-control" min="0" step="0.01" value="{{$SS_3}}"></td>
                                                    <td><input type="number" name="SS_4" id="SS_4" class="form-control" min="0" step="0.01" value="{{$SS_4}}"></td>
                                                    <td><input type="number" name="SS_5" id="SS_5" class="form-control" min="0" step="0.01" value="{{$SS_5}}"></td>
                                                </tr>
                                                <tr>
                                                    <td>SUPERIOR DOUBLE</td>
                                                    <td><input type="number" name="SD_2" id="SD_2" class="form-control" min="0" step="0.01" value="{{$SD_2}}"></td>
                                                    <td><input type="number" name="SD_3" id="SD_3" class="form-control" min="0" step="0.01" value="{{$SD_3}}"></td>
                                                    <td><input type="number" name="SD_4" id="SD_4" class="form-control" min="0" step="0.01" value="{{$SD_4}}"></td>
                                                    <td><input type="number" name="SD_5" id="SD_5" class="form-control" min="0" step="0.01" value="{{$SD_5}}"></td>
                                                </tr>
                                                <tr>
                                                    <td>SUITE</td>
                                                    <td><input type="number" name="SU_2" id="SU_2" class="form-control" min="0" step="0.01" value="{{$SU_2}}"></td>
                                                    <td><input type="number" name="SU_3" id="SU_3" class="form-control" min="0" step="0.01" value="{{$SU_3}}"></td>
                                                    <td><input type="number" name="SU_4" id="SU_4" class="form-control" min="0" step="0.01" value="{{$SU_4}}"></td>
                                                    <td><input type="number" name="SU_5" id="SU_5" class="form-control" min="0" step="0.01" value="{{$SU_5}}"></td>
                                                </tr>
                                                <tr>
                                                    <td>JR. SUITE</td>
                                                    <td><input type="number" name="JS_2" id="JS_2" class="form-control" min="0" step="0.01" value="{{$JS_2}}"></td>
                                                    <td><input type="number" name="JS_3" id="JS_3" class="form-control" min="0" step="0.01" value="{{$JS_3}}"></td>
                                                    <td><input type="number" name="JS_4" id="JS_4" class="form-control" min="0" step="0.01" value="{{$JS_4}}"></td>
                                                    <td><input type="number" name="JS_5" id="JS_5" class="form-control" min="0" step="0.01" value="{{$JS_5}}"></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                </div>
                            </div>

                    </div>
                    {{csrf_field()}}
                        <input type="hidden" name="posTipo" id="posTipo" value="0">
                    <input type="hidden" name="localizacion1_0" id="localizacion1_0" value="{{$localizacion}}">
                    <input type="hidden" name="hotel_pro_id_2" id="hotel_pro_id_2" value="{{$hotel_pro_id_2}}">
                    <input type="hidden" name="hotel_pro_id_3" id="hotel_pro_id_3" value="{{$hotel_pro_id_3}}">
                    <input type="hidden" name="hotel_pro_id_4" id="hotel_pro_id_4" value="{{$hotel_pro_id_4}}">
                    <input type="hidden" name="hotel_pro_id_5" id="hotel_pro_id_5" value="{{$hotel_pro_id_5}}">
                    <input type="hidden" name="hotel_id_2" id="hotel_id_2" value="{{$hotel_id_2}}">
                    <input type="hidden" name="hotel_id_3" id="hotel_id_3" value="{{$hotel_id_3}}">
                    <input type="hidden" name="hotel_id_4" id="hotel_id_4" value="{{$hotel_id_4}}">
                    <input type="hidden" name="hotel_id_5" id="hotel_id_5" value="{{$hotel_id_5}}">
                    <a href="{{route('costs_index_path')}}" class=" btn btn-warning">Regresar</a>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {

            $("select[id=txt_localizacion_0]").change(function(){
                $('#localizacion1_0').val($('select[id=txt_localizacion_0]').val());
            });

        } );
        $(function () {

            $('#txt_provider_0').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "../../../../buscar-proveedor",
                        dataType: "json",
                        data: {
                            term : request.term,
                            localizacion : $("#localizacion1_0").val(),
                            grupo : 'HOTELS'
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