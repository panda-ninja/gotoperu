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

</head>
<body>
<nav class="navbar navbar-fixed-top bg-grey-goto">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="nav-brand-goto margin-top-10" href="/">
                <img alt="Brand" src="{{asset("img/logos/logo-gotoperu.png")}}" width="200">
            </a>
        </div>
        <div class="collapse navbar-collapse">

            <!-- Split button -->
            <div class="btn-group margin-top-7 navbar-right margin-right-0">
                <button type="button" class="btn btn-default"><img src="https://scontent.flim5-1.fna.fbcdn.net/v/t1.0-9/11219300_539606706191493_953162067565331778_n.jpg?oh=1e9c73929e406bf2b93275b010f287a0&oe=59957E5D" alt="" class="img-circle" width="20">
                    Hidalgo Ch Ponce
                </button>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<nav class="navbar navbar-inverse navbar-fixed-top hide">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"> <img src="https://gotoperu.com/img/logos/logo-gotoperu.png" width="100" alt=""></a>
            <!-- Split button -->
            <div class="btn-group margin-top-7">
                <button type="button" class="btn btn-default"><img src="https://scontent.flim5-1.fna.fbcdn.net/v/t1.0-9/11219300_539606706191493_953162067565331778_n.jpg?oh=1e9c73929e406bf2b93275b010f287a0&oe=59957E5D" alt="" class="img-circle" width="20">
                    Hidalgo Ch Ponce
                </button>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Logout</a></li>
                </ul>
            </div>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"></a></li>
            </ul>
            {{--<form class="navbar-form navbar-right">--}}
            {{--<input type="text" class="form-control" placeholder="Search...">--}}
            {{--</form>--}}
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar margin-bottom-0">
                <li class="padding-side-20 bg-green-goto text-white text-20">Sales</li>
                <li class="divider"></li>
                <li class="padding-side-20 bg-sub-title-aside"><b class="text-green-goto text-16">Itinerary</b></li>
                <li class="divider"></li>
                <li class="active"><a href="{{route("package_create_path")}}"><i class="fa fa-angle-right" aria-hidden="true"></i> New</a></li>
                <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Catalog</a></li>
                <li class="divider"></li>
                <li class="padding-side-20 bg-sub-title-aside"><b class="text-green-goto text-16">Client</b></li>
                <li class="divider"></li>
                <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> New</a></li>
                <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Current</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li class="padding-side-20 bg-green-goto text-white text-20">Operations</li>
                <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Reservas</a></li>
                <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Trafico</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            @yield('content')
        </div>
    </div>
</div>

{{--scripts--}}
<script src="{{asset("js/app.js")}}"></script>
</body>
</html>