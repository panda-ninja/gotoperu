<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{--estilos--}}
    <link rel="stylesheet" href="{{mix("css/admin/admin.css")}}">
    {{--fonts--}}
    <link rel="stylesheet" href="{{mix("css/font-awesome.css")}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.6.2/sweetalert2.css">

    <script src="{{asset("js/app.js")}}"></script>
    @yield('archivos-css')
    {{--scripts--}}
    <script src="{{asset("https://cdn.jsdelivr.net/sweetalert2/6.6.2/sweetalert2.js")}}"></script>
    @yield('archivos-js')
    <script src="{{asset("js/admin/plugins.js")}}"></script>

</head>
<body>

@include('layouts.admin.nav')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar margin-bottom-0">
                <li class="padding-side-20 bg-green-goto text-white text-20">Sales</li>
                <li class="divider"></li>
                <li class="padding-side-20 bg-sub-title-aside"><b class="text-green-goto text-16">Inventory</b></li>
                <li class="divider"></li>
                <li ><a href="{{route("itinerari_index_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Day by Day</a></li>
                <li class="bg-sub-title-aside"><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Itineraries</a>
                    <ul class="padding-side-20 nav nav-sidebar margin-bottom-0">
                        <li class="padding-left-30 text-unset"><a href="{{route("package_create_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> New</a></li>
                        <li class="padding-left-30 text-unset"><a href="{{route("show_itineraries_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> List</a></li>
                    </ul>
                </li>
                <li ><a href="{{route("package_create_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Expedia</a></li>
                <li class="hide"><a href="{{route("catalog_show_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Catalog</a></li>
                <li class="divider"></li>
                <li class="padding-side-20 bg-sub-title-aside"><b class="text-green-goto text-16">Quotes</b></li>
                <li class="divider"></li>
                <li><a href="{{route("quotes_new_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> New</a></li>
                <li><a href="{{route("current-quote_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Current</a></li>
                <li class="divider"></li>
                <li class="padding-side-20 bg-sub-title-aside"><b class="text-green-goto text-16">Sales</b></li>
                <li class="divider"></li>

                <li><a href="{{route("pax_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Paxs</a></li>
                <li><a href="{{route("catalog_show_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Agences</a></li>

                <li><a href="{{route("sales_paxs_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Paxs</a></li>
                {{--<li><a href="{{route("catalog_show_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Agences</a></li>--}}

                <li><a href="{{route("catalog_show_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Expedia</a></li>
                {{--<li class="divider"></li>--}}
                {{--<li class="padding-side-20 bg-sub-title-aside"><b class="text-green-goto text-16">Packages</b></li>--}}
                {{--<li class="divider"></li>--}}
                {{--<li class="active"><a href="{{route("package_create_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Itineraries</a></li>--}}
                {{--<li><a href="{{route("catalog_show_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Catalog</a></li>--}}
                {{--<li class="padding-side-20 bg-sub-title-aside"><b class="text-green-goto text-16">Client</b></li>--}}
                {{--<li class="divider"></li>--}}
                {{--<li><a href="{{route("qoute_show_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> New</a></li>--}}
                {{--<li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Current</a></li>--}}
            </ul>
            <ul class="nav nav-sidebar hide">
                <li class="padding-side-20 bg-green-goto text-white text-20">Operations</li>
                <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Reservas</a></li>
                <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Trafico</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li class="padding-side-20 bg-green-goto text-white text-20">Database</li>
                <li><a href="{{route('destination_index_path')}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Destinations</a></li>
                <li><a href="{{route('category_index_path')}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Categories</a></li>
                <li><a href="{{route('service_index_path')}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Products</a></li>
                <li><a href="{{route('provider_index_path')}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Providers</a></li>
                <li><a href="{{route('costs_index_path')}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Costs</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            @yield('content')
        </div>
    </div>
</div>
{{--scripts--}}

<script>
    var jumboHeight = $('.jumbotron').outerHeight();
    function parallax(){
        var scrolled = $(window).scrollTop();
        $('.bg').css('height', (jumboHeight-scrolled) + 'px');
    }

    $(window).scroll(function(e){
        parallax();
    });
</script>

<script>

    function pagar(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });

        $("#p_send_"+id).attr("disabled", true);

        var s_fecha = $('#fecha_'+id).val();
        var s_vencimiento = $('#vencimiento_'+id).val();
        var s_medio = $('#medio_'+id).val();
        var s_transaccion = $('#transaccion_'+id).val();
        var s_monto = $('#monto_'+id).val();
        var s_estado = $('#estado_'+id).val();
        var s_cotizaciones = "{{$id_cot}}";


        if (s_fecha.length == 0 ){
            $('#fecha_'+id).css("border-bottom", "2px solid #FF0000");
            var send = "false";
        }else{
            var send = "true";
        }

        if(send == "true"){
            var datos = {

                "txt_fecha" : s_fecha,
                "txt_vencimiento" : s_vencimiento,
                "txt_medio" : s_medio,
                "txt_transaccion" : s_transaccion,
                "txt_monto" : s_monto,
                "txt_estado" : s_estado,
                "txt_cotizaciones" : s_cotizaciones,

            };

            $.ajax({
                data:  datos,
                url:   "payment/update/"+id,
                type:  'post',

                beforeSend: function () {
                    $('#p_send_'+id).removeClass('show');
                    $("#p_send_"+id).addClass('hide');
                    $("#loader2_"+id).removeClass('hide');
                    $("#loader2_"+id).addClass('show');
                },
                success:  function (response) {
//                    $('#p_form')[0].reset();
                    $('#p_send_'+id).removeClass('show');
                    $('#p_send_'+id).addClass('hide');
                    $("#loader2_"+id).removeClass('show');
                    $("#loader2_"+id).addClass('hide');

                    $("#check-payment_"+id).removeClass('hide');
                    $("#check-payment_"+id).addClass('show');

                    $("#p_send_"+id).removeAttr("disabled");

                    {{--var page = 'detail';--}}

                    {{--var route = '{{route('pax_show_path', $pago->cotizaciones_id)}}';--}}
                    {{--$.ajax({--}}
                    {{--data: {page: page},--}}
                    {{--url: route,--}}
                    {{--type: 'GET',--}}
                    {{--dataType: 'json',--}}
                    {{--success: function(data){--}}
                    {{--$(".content-pax").html(data);--}}

                    {{--}--}}
                    {{--});--}}

                    {{--window.location = "{{route('pax_show_path', '6?page=detail')}}";--}}
                }
            });
        } else{
            $("#p_send_"+id).removeAttr("disabled");
        }
    }

</script>

</body>
</html>