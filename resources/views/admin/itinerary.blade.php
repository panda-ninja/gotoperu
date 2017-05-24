@extends('.layouts.admin')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Sales</li>
            <li class="active">Itinerary</li>
        </ol>
    </div>
    <form action="{{route('package_save_path')}}" method="post" id="package_new_path_id">
        <div class="row">
            <div class="col-md-12">
                <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">1</span> Itinerary</h4>
                <div class="divider margin-bottom-20"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="txt_titulo">Titulo</label>
                    <input type="text" class="form-control" id="txt_titulo" name="txt_titulo" placeholder="Days" min="0" value="0" onchange="cambiar_profit_total()">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="txt_code">Code</label>
                    <input type="text" class="form-control" id="txt_code" name="txt_code" placeholder="Code">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="txt_title">Title</label>
                    <input type="text" class="form-control" id="txt_title" name="txt_title" placeholder="Title">
                </div>
            </div>
            <div class="col-md-12">
                <label for="txta_description">Description</label>
                <textarea class="form-control" id="txta_description" name="txta_description" rows="3"></textarea>
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
            @foreach($destinos as $destino)
                <div class="col-md-3">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="destinos" value="{{$destino->destino}}" onclick="mostrarItinerarios()">
                            {{$destino->destino}}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row margin-top-20">
            <div class="col-md-12">
                <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">3</span> Itinerary</h4>
                <div class="divider margin-bottom-20"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="grid" id="Lista_itinerario_g">
                    {{--<div class="box-sortable margin-bottom-10">--}}
                    {{--<a class="btn btn-link" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">--}}
                    {{--<b>Dia 1:</b> Peru full day--}}
                    {{--</a>--}}
                    {{--<span class="pull-right">($1299.00)</span>--}}
                    {{--<span class="label label-success pull-right">($1299.00)</span>--}}
                    {{--<div class="collapse clearfix" id="collapseExample">--}}
                    {{--<div class="col-md-12">--}}
                    {{--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad adipisci fugit, ipsam numquam odit qui ratione rerum suscipit ullam voluptatibus? Beatae, eius error expedita qui quo suscipit tempore voluptatibus! Deserunt!--}}
                    {{--<h5><b>Services</b></h5>--}}
                    {{--<table class="table table-condensed table-striped">--}}
                    {{--<thead>--}}
                    {{--<tr class="bg-grey-goto text-white">--}}
                    {{--<th colspan="2">Concepts</th>--}}
                    {{--<th>Prices</th>--}}
                    {{--<th></th>--}}
                    {{--</tr>--}}
                    {{--</thead>--}}
                    {{--<tbody>--}}
                    {{--<tr>--}}
                    {{--<td>Transfer</td>--}}
                    {{--<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>--}}
                    {{--<td>1299.00</td>--}}
                    {{--<td>--}}
                    {{--<a href="" class="text-16 text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i></a>--}}
                    {{--</td>--}}
                    {{--</tr>--}}

                    {{--<tr>--}}
                    {{--<td class="" colspan="4">--}}
                    {{--<a href="#add-services1" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">Add new services <i class="fa fa-plus-circle" aria-hidden="true"></i></a>--}}

                    {{--<div class="collapse" id="add-services1">--}}
                    {{--<div class="row margin-top-10">--}}
                    {{--<div class="col-md-6">--}}
                    {{--<div class="form-group">--}}
                    {{--<input type="text" class="form-control input-sm" id="txt_code" name="txt_code" placeholder="Services">--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-4 row">--}}
                    {{--<div class="form-group">--}}
                    {{--<input type="text" class="form-control input-sm" id="txt_code" name="txt_code" placeholder="Price">--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-2">--}}
                    {{--<div class="form-group">--}}
                    {{--<a href="" class="btn btn-success btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    {{--</td>--}}
                    {{--</tr>--}}

                    {{--</tbody>--}}
                    {{--</table>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="box-sortable margin-bottom-10">--}}
                    {{--<a class="btn btn-link" role="button" data-toggle="collapse" href="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">--}}
                    {{--<b>Dia 2:</b> Peru full day--}}
                    {{--</a>--}}
                    {{--<span class="label label-success pull-right">($1899.00)</span>--}}
                    {{--<div class="collapse clearfix" id="collapseExample2">--}}
                    {{--<div class="col-md-12">--}}
                    {{--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias animi aperiam, consectetur cum dicta distinctio eligendi libero, magnam minus nemo nisi nulla pariatur quod? At aut distinctio maxime optio suscipit?--}}
                    {{--<h5><b>Services</b></h5>--}}
                    {{--<table class="table table-condensed table-striped">--}}
                    {{--<thead>--}}
                    {{--<tr class="bg-grey-goto text-white">--}}
                    {{--<th colspan="2">Concepts</th>--}}
                    {{--<th>Prices</th>--}}
                    {{--<th></th>--}}
                    {{--</tr>--}}
                    {{--</thead>--}}
                    {{--<tbody>--}}
                    {{--<tr>--}}
                    {{--<td>Transfer</td>--}}
                    {{--<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>--}}
                    {{--<td>1299.00</td>--}}
                    {{--<td>--}}
                    {{--<a href="" class="text-16 text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i></a>--}}
                    {{--</td>--}}
                    {{--</tr>--}}

                    {{--<tr>--}}
                    {{--<td class="" colspan="3">--}}
                    {{--<a href="#add-services2" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">Add new services <i class="fa fa-plus-circle" aria-hidden="true"></i></a>--}}

                    {{--<div class="collapse" id="add-services2">--}}
                    {{--<div class="row margin-top-10">--}}
                    {{--<div class="col-md-6">--}}
                    {{--<div class="form-group">--}}
                    {{--<input type="text" class="form-control input-sm" id="txt_code" name="txt_code" placeholder="Services">--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-4 row">--}}
                    {{--<div class="form-group">--}}
                    {{--<input type="text" class="form-control input-sm" id="txt_code" name="txt_code" placeholder="Price">--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-2">--}}
                    {{--<div class="form-group">--}}
                    {{--<a href="" class="btn btn-success btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    {{--</td>--}}
                    {{--</tr>--}}

                    {{--</tbody>--}}
                    {{--</table>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <b class="font-montserrat">COST WITHOUT HOTELS $987 P.P</b>
                    </div>
                </div>
            </div>
            <div class="col-md-1 ">
                <a href="#!" class="btn btn-primary" onclick="Pasar_datos()"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
            </div>
            <div class="col-md-5">
                <div id="lista_itinerarios">
                    <div class="row hide">
                        <b class="font-montserrat text-orange-goto">LIMA</b>
                    </div>
                    <div class="hide row margin-bottom-5">
                        <div class="input-group">
                      <span class="input-group-addon">
                          <input type="checkbox" aria-label="...">
                      </span>

                            <input type="text" class="form-control" aria-label="..." value="Lima City Tours" readonly>

                            <span class="input-group-btn">
                            <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapseExample3"><b>$1299.00</b> <i class="fa fa-arrows-v" aria-hidden="true"></i></button>
                        </span>
                        </div><!-- /input-group -->
                        <div class="collapse clearfix" id="collapseExample3">
                            <div class="col-md-12 well margin-top-5">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad adipisci fugit, ipsam numquam odit qui ratione rerum suscipit ullam voluptatibus? Beatae, eius error expedita qui quo suscipit tempore voluptatibus! Deserunt!
                                <h5><b>Services</b></h5>
                                <table class="table table-condensed table-striped">
                                    <thead>
                                    <tr class="bg-grey-goto text-white">
                                        <th colspan="2">Concepts</th>
                                        <th>Prices</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Transfer</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                                        <td>1299.00</td>

                                    </tr>
                                    <tr>
                                        <td>Transfer</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                                        <td>1299.00</td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row margin-top-20">
            <div class="col-md-12">
                <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">4</span> Include & Not include</h4>
                <div class="divider margin-bottom-20"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="text-center">
                    <label class="radio-inline">
                        <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked> Default
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Personalize
                    </label>
                </div>


                <div class="form-group">
                    <label for="txta_include">Include</label>
                    <textarea class="form-control animated" id="txta_include" name="txta_include" rows="5">5 nights in Peru high quality Hotels
    All tours stated in the itinerary with English-speaking guides
    All transfers and entrance fees
    All breakfasts
    Private Airport Shuttle in & out
    24/7 Assistance
    Trains and buses
    A prepaid cellphone for extended Programs</textarea>
                </div>
            </div>
            <div class="col-md-6">

                <div class="text-center">
                    <label class="radio-inline">
                        <input type="radio" name="inlineRadioOptions2" id="inlineRadio1" value="option1"> Default
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="inlineRadioOptions2" id="inlineRadio2" value="option2" checked> Personalize
                    </label>
                </div>

                <div class="form-group">
                    <label for="txta_notinclude">Not Include</label>
                    <textarea class="form-control" id="txta_notinclude" name="txta_notinclude" rows="5"></textarea>
                </div>
            </div>
        </div>

        <div class="row margin-top-20">
            <div class="col-md-12">
                <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">5</span> Hotels</h4>
                <div class="divider margin-bottom-20"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-condensed table-bordered font-montserrat">
                    <caption class="text-right"><b>Price per night</b></caption>
                    <thead>
                    <tr class="bg-grey-goto-light text-white">
                        <th class="text-center">Hotels</th>
                        <th class="text-center">2 Stars</th>
                        <th class="text-center">3 Stars</th>
                        <th class="text-center">4 Stars</th>
                        <th class="text-center">5 Stars</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="col-md-2">
                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_t2" name="amount_t2" placeholder="Amount" onchange="cambiar_profit(2)" min="0" value="0">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_t3" name="amount_t3" placeholder="Amount" onchange="cambiar_profit(3)" min="0" value="0">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_t4" name="amount_t4" placeholder="Amount" onchange="cambiar_profit(4)" min="0" value="0">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_t5" name="amount_t5" placeholder="Amount" onchange="cambiar_profit(5)" min="0" value="0">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td class="col-md-2">
                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_d2" name="amount_d2" placeholder="Amount" onchange="cambiar_profit(2)" min="0" value="0">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_d3" name="amount_d3" placeholder="Amount" onchange="cambiar_profit(3)" min="0" value="0">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_d4" name="amount_d4" placeholder="Amount" onchange="cambiar_profit(4)" min="0" value="0">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_d5" name="amount_d5" placeholder="Amount" onchange="cambiar_profit(5)" min="0" value="0">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td class="col-md-2">
                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_s2" name="amount_s2" placeholder="Amount" onchange="cambiar_profit(2)" min="0" value="0">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_s3" name="amount_s3" placeholder="Amount" onchange="cambiar_profit(3)" min="0" value="0">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_s4" name="amount_s4" placeholder="Amount" onchange="cambiar_profit(4)" min="0" value="0">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_s5" name="amount_s5" placeholder="Amount" onchange="cambiar_profit(5)" min="0" value="0">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row margin-top-20">
            <div class="col-md-12">
                <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">6</span> Package Price</h4>
                <div class="divider margin-bottom-20"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 hide">
                <div class="form-group margin-bottom-0">
                    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                    <div class="input-group">
                        <div class="input-group-addon">Profit</div>
                        <input type="number" class="form-control text-right" id="profit_0" placeholder="Percent" onchange="cambiar_profit(0)" value="40" min="0">
                        <div class="input-group-addon">%</div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table table-condensed table-bordered font-montserrat">
                    <caption class="text-right"><b>Categories for stars</b></caption>
                    <thead>
                    <tr class="bg-grey-goto text-white">
                        <th class="text-center"></th>
                        <th class="text-center">2 Stars</th>
                        <th class="text-center">3 Stars</th>
                        <th class="text-center">4 Stars</th>
                        <th class="text-center">5 Stars</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="col-md-2">

                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">Profit</div>
                                    <input type="number" class="form-control text-right" id="profit_2" name="profit_2" placeholder="Percent" onchange="cambiar_profit(2)" value="40" min="0">
                                    <div class="input-group-addon">%</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">Profit</div>
                                    <input type="number" class="form-control text-right" id="profit_3" name="profit_3" placeholder="Percent" onchange="cambiar_profit(3)" value="40" min="0">
                                    <div class="input-group-addon">%</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">Profit</div>
                                    <input type="number" class="form-control text-right" id="profit_4" name="profit_4" placeholder="Percent" onchange="cambiar_profit(4)" value="40" min="0">
                                    <div class="input-group-addon">%</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">Profit</div>
                                    <input type="number" class="form-control text-right" id="profit_5" name="profit_5" placeholder="Percent" onchange="cambiar_profit(5)" value="40" min="0">
                                    <div class="input-group-addon">%</div>
                                </div>
                            </div>
                        </td>

                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <table class="table table-condensed table-bordered font-montserrat">
                    <caption class="text-right"><b>Total price for Packages</b></caption>
                    <thead>
                    <tr class="bg-grey-goto text-white">
                        <th class="text-center">Price Cost</th>
                        <th class="text-center">2 Stars</th>
                        <th class="text-center">3 Stars</th>
                        <th class="text-center">4 Stars</th>
                        <th class="text-center">5 Stars</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="col-md-2">
                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_t2_c" name="amount_t2_c" placeholder="Amount" min="0" value="0">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_t3_c" name="amount_t3_c" placeholder="Amount" min="0" value="0">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_t4_c" name="amount_t4_c" placeholder="Amount" min="0" value="0">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_t5_c" name="amount_t5_c" placeholder="Amount" min="0" value="0">
                                </div>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td class="col-md-2">
                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_d2_c" name="amount_d2_c" placeholder="Amount" min="0" value="0">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_d3_c" name="amount_d3_c" placeholder="Amount" min="0" value="0">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_d4_c" name="amount_d4_c" placeholder="Amount" min="0" value="0">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_d5_c" name="amount_d5_c" placeholder="Amount" min="0" value="0">
                                </div>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td class="col-md-2">
                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_s2_c" name="amount_s2_c" placeholder="Amount" min="0" value="0">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_s3_c" name="amount_s3_c" placeholder="Amount" min="0" value="0">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_s4_c" name="amount_s4_c" placeholder="Amount" min="0" value="0">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_s5_c" name="amount_s5_c" placeholder="Amount" min="0" value="0">
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table class="table table-condensed table-bordered font-montserrat">
                    <caption class="text-right"><b>Total price for Packages</b></caption>
                    <thead>
                    <tr class="bg-grey-goto text-white">
                        <th class="text-center">Price Venta</th>
                        <th class="text-center">2 Stars</th>
                        <th class="text-center">3 Stars</th>
                        <th class="text-center">4 Stars</th>
                        <th class="text-center">5 Stars</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="col-md-2">
                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_t2_v" name="amount_t2_v" placeholder="Amount" min="0" value="0">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_t3_v" name="amount_t3_v" placeholder="Amount" min="0" value="0">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_t4_v" name="amount_t4_v" placeholder="Amount" min="0" value="0">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_t5_v" name="amount_t5_v" placeholder="Amount" min="0" value="0">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td class="col-md-2">
                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_d2_v" name="amount_d2_v" placeholder="Amount" min="0" value="0">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_d3_v" name="amount_d3_v" placeholder="Amount" min="0" value="0">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_d4_v" name="amount_d4_v" placeholder="Amount" min="0" value="0">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_d5_v" name="amount_d5_v" placeholder="Amount" min="0" value="0">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td class="col-md-2">
                            <i class="fa fa-bed fa-2x text-green-goto" aria-hidden="true"></i>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_s2_v" name="amount_s2_v" placeholder="Amount" min="0" value="0">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_s3_v" name="amount_s3_v" placeholder="Amount" min="0" value="0">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_s4_v" name="amount_s4_v" placeholder="Amount" min="0" value="0">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-bottom-0">
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control text-right" id="amount_s5_v" name="amount_s5_v" placeholder="Amount" min="0" value="0">
                                    {{--<div class="input-group-addon">.00</div>--}}
                                </div>
                            </div>
                        </td>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row margin-top-20">
            <div class="col-md-12 text-center">
                <input type="text" name="totalItinerario" id="totalItinerario" value="0">
                <button type="submit" class="btn btn-lg btn-primary">Submit <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
            </div>
        </div>
    </form>
@stop