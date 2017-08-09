@extends('.layouts.admin')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Quotes</li>
            <li class="active">New</li>
        </ol>
    </div>
    <form action="{{route('package_cotizacion_save_path')}}" method="post" id="package_new_path_id">
        <div class="row">
            <div class="col-md-12">
                <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">1</span> Client</h4>
                <div class="divider margin-bottom-20"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <b>
                    <span class="text-20 text-green-goto">Name : </span>
                    <span class="text-15">{{$cliente->nombres}}</span>
                </b>
            </div>
            <div class="col-md-3">
                <b>
                    <span class="text-20 text-green-goto">Email : </span>
                    <span class="text-15">{{$cliente->email}}</span>
                </b>
            </div>
            <div class="col-md-3">
                <b>
                    <span class="text-20 text-green-goto">Country : </span>
                    <span class="text-15">{{$cliente->nacionalidad}}</span>
                </b>
            </div>

            <div class="col-md-2">
                    <b>
                        <span class="text-20 text-green-goto">Phone : </span>
                        <span class="text-15">{{$cliente->telefono}}</span>
                    </b>
            </div>
        </div>
        <div class="row margin-top-20">
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="text-20">
                    <b>
                        <?php
                        $cotizacion_;
                        ?>
                        @foreach($cotizacion as $cotizacion1)
                            <?php
                                $cotizacion_=$cotizacion1;
                            ?>
                        @endforeach
                        <span class="text-green-goto">Travellers:</span>
                    @for($i=0;$i<$cotizacion_->nropersonas;$i++)
                        <i class="fa fa-male" aria-hidden="true"></i>
                    @endfor

                    </b>
                </div>
            </div>
            <div class="col-md-2">
                <b>
                    <span class="text-20 text-green-goto">Days : </span>
                    <span class="text-20">{{$cotizacion_->duracion}}</span>
                </b>
            </div>
            <div class="col-md-3">
                <b>
                    <span class="text-20 text-green-goto">Travel date : </span>
                    <span class="text-20">{{$cotizacion_->fecha}}</span>
                </b>
            </div>
            <div class="col-md-3">
                <b>
                    <span class="text-20 text-green-goto">for : </span>
                    @if($cotizacion_->star_2=='2')
                        2 <span class="text-orange-goto text-20"><i class="fa fa-star" aria-hidden="true"></i></span> /
                    @endif
                    @if($cotizacion_->star_3=='3')
                        3 <span class="text-orange-goto text-20"><i class="fa fa-star" aria-hidden="true"></i></span></i>/
                    @endif
                    @if($cotizacion_->star_4=='4')
                        4 <span class="text-orange-goto text-20"><i class="fa fa-star" aria-hidden="true"></i></span></i>/
                    @endif
                    @if($cotizacion_->star_5=='5')
                        5 <span class="text-orange-goto text-20"><i class="fa fa-star" aria-hidden="true"></i></span></i>
                    @endif
                </b>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <b>
                    <?php
                        $array_destinos='';
                    ?>
                    <span class="text-20 text-green-goto">on Detination : </span>
                    @foreach($destinos as $destino)
                        <?php
                            $array_destinos.=$destino.'$';
                        ?>
                        <span class="text-orange-goto text-15">{{$destino}}</span> -
                    @endforeach
                    <?php
                        $array_destinos= substr($array_destinos,0,strlen($array_destinos)-1) ;
                    ?>
                </b>
            </div>
        </div>
        <div class="row margin-top-20">
        </div>
        <div id="list-package"  class="row">
            <div class="col-md-3 margin-top-10">
                <div class="portada-pdf">
                    <img src="{{asset('img/portada/new-proposal.jpg')}}" alt="" class="img-responsive">
                    <div class="box-dowload1 text-green-goto">
                        <b class="margin-top-5 text-green-goto"><i class="fa fa-newspaper-o text-green-goto" aria-hidden="true"></i> New Package</b>
                        <a href="{{route('new_plan_path',[$cotizacion_->id,$array_destinos])}}" class="pull-right btn btn-success btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                    </div>
                    <div class="box-letter-proposal text-center">
                        <span class="text-orange-goto">NEW</span>
                    </div>
                </div>
            </div>
            <?php
            $planes[]='A';
            $planes[]='B';
            $planes[]='C';
            $planes[]='D';
            $planes[]='E';
            $planes[]='F';
            $pos_plan=0;
            ?>
            @foreach($cotizacion_ as $coti)
                <div class="col-md-3 margin-top-10">
                    <div class="portada-pdf">
                        <img src="{{asset('img/portada/proposal-martin-pdf.jpg')}}" alt="" class="img-responsive">
                        <div class="box-dowload">
                            <b class="margin-top-5"><i class="fa fa-file-pdf-o text-danger" aria-hidden="true"></i> Proposal</b>
                            <a href="#" class="pull-right btn btn-warning btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>
                        </div>
                        <div class="box-letter-proposal text-center">
                            <span class="text-orange-goto">{{$planes[$pos_plan]}}</span>
                        </div>
                    </div>
                </div>
                <?php
                $pos_plan++;
                ?>
            @endforeach
            <div class="col-md-3 hide">
                <div class="portada-pdf">
                    <img src="{{asset('img/portada/proposal-martin-pdf.jpg')}}" alt="" class="img-responsive">
                    <div class="box-dowload">
                        <b class="margin-top-5"><i class="fa fa-file-pdf-o text-danger" aria-hidden="true"></i> GTP900-B.jpg</b>
                        <a href="{{asset('pdf/proposals_1.pdf')}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a>
                    </div>
                    <div class="box-letter-proposal text-center">
                        B
                    </div>
                </div>
            </div>
            <div class="col-md-3 hide">
                <div class="portada-pdf">
                    <img src="{{asset('img/portada/proposal-martin-pdf.jpg')}}" alt="" class="img-responsive">
                    <div class="box-dowload">
                        <b class="margin-top-5"><i class="fa fa-file-pdf-o text-danger" aria-hidden="true"></i> GTP900-C.jpg</b>
                        <a href="{{asset('pdf/proposals_1.pdf')}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a>
                    </div>
                    <div class="box-letter-proposal text-center">
                        C
                    </div>
                </div>
            </div>

        </div>
        <div class="row margin-top-20">
            <div class="col-md-12 text-center">
                {{csrf_field()}}
                <input type="hidden" name="cliente_id" id="cliente_id" value="{{$cliente}}">
                <button type="submit" class="btn btn-lg btn-primary">Send Quote <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            calcular_resumen();
        } );
    </script>
@stop