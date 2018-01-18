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

@include('layouts.admin.nav-operaciones')
@php
    function activar_link2($link){
        $activo='';
        if(request()->is($link))
        $activo=' menu-lista-activo';


        return $activo;
    }
@endphp
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <div class="menu-titulo text-center"><a href="!#"  class="link text-grey-goto">QUOTES</a></div>
            <div class="menu-lista text-center {{activar_link2('admin/quotes/new/profile')}}"><a href="{{route("quotes_new1_path")}}" class="link text-grey-goto">New</a></div>
            <div class="menu-lista text-center {{activar_link2('admin/current-quote')}}"><a href="{{route('current_quote_page_path', 'gotoperu.com')}}" class="link text-grey-goto">Current</a></div>
            <div class="menu-titulo text-center"><a href="!#" class="link text-grey-goto">SALES</a></div>
            <div class="menu-lista text-center"><a class="link text-grey-goto"><b>ITIN</b></a></div>
            <div class="menu-lista text-center{{activar_link2('admin/destination')}}"><a href="{{route('destination_index_path')}}" class="link text-grey-goto">Destination</a></div>
            <div class="menu-lista text-center{{activar_link2('admin/itinerary')}}"><a href="{{route("itinerari_index_path")}}" class="link text-grey-goto">Day by day</a></div>
            <div class="menu-lista text-center{{activar_link2('admin/package')}}"><a href="{{route("package_create_path")}}" class="link text-grey-goto">Itineraries->New</a></div>
            <div class="menu-lista text-center{{activar_link2('admin/itineraries')}}"><a href="{{route("show_itineraries_path")}}" class="link text-grey-goto">Itineraries->List</a></div>
            <div class="menu-lista text-center"><a class="link text-grey-goto"><b>$</b></a></div>
            <div class="menu-lista text-center{{activar_link2('admin/categories')}}"><a href="{{route('category_index_path')}}" class="link text-grey-goto">Categories</a></div>
            <div class="menu-lista text-center{{activar_link2('admin/products')}}"><a href="{{route('service_index_path')}}" class="link text-grey-goto">Products</a></div>
            <div class="menu-lista text-center{{activar_link2('admin/providers')}}"><a href="{{route('provider_index_path')}}" class="link text-grey-goto">Providers</a></div>
            <div class="menu-lista text-center{{activar_link2('admin/costs')}}"><a href="{{route('costs_index_path')}}" class="link text-grey-goto">Costs</a></div>


            <ul class="nav nav-sidebar margin-bottom-0 hide">
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
                {{--<li ><a href="{{route("package_create_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Expedia</a></li>--}}
                <li class="hide"><a href="{{route("catalog_show_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Catalog</a></li>
                <li class="divider"></li>
                <li class="padding-side-20 bg-sub-title-aside"><b class="text-green-goto text-16">Quotes</b></li>
                <li class="divider"></li>
                <li><a href="{{route("quotes_new1_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> New</a></li>
                <li><a href="{{route("current-quote_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Current</a></li>
                <li class="divider"></li>
                <li class="padding-side-20 bg-sub-title-aside"><b class="text-green-goto text-16">Sales</b></li>
                <li class="divider"></li>

                <li><a href="{{route("pax_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Paxs</a></li>
                {{--<li><a href="{{route("catalog_show_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Agences</a></li>--}}

                {{--<li><a href="{{route("sales_paxs_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Paxs</a></li>--}}
                {{--<li><a href="{{route("catalog_show_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Agences</a></li>--}}

                {{--<li><a href="{{route("catalog_show_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> Expedia</a></li>--}}
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
            <ul class="nav nav-sidebar hide">
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



</body>
</html>