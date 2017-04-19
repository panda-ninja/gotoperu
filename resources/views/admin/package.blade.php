@extends('.layouts.admin')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active">Package</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">1</span> Package</h4>
            <div class="divider margin-bottom-20"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="txt_day">Email address</label>
                <input type="number" class="form-control" id="txt_day" name="txt_day" placeholder="Days">
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
        <div class="col-md-3">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="">
                    Machu Picchu Ballestas Island an paracas
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="" checked>
                    Lima
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="">
                    Machu Picchu
                </label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="">
                    Machu Picchu
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="">
                    Machu Picchu
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="">
                    Machu Picchu
                </label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="">
                    Machu Picchu
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="">
                    Machu Picchu
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="">
                    Machu Picchu
                </label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="">
                    Machu Picchu
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="">
                    Machu Picchu
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="">
                    Machu Picchu
                </label>
            </div>
        </div>
    </div>

    <div class="row margin-top-20">
        <div class="col-md-12">
            <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">3</span> Itinerary</h4>
            <div class="divider margin-bottom-20"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="grid">
                <div class="box-sortable margin-bottom-10">
                    <a class="btn btn-link" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <b>Dia 1:</b> Peru full day
                    </a>
                    {{--<span class="pull-right">($1299.00)</span>--}}
                    <span class="label label-success pull-right">($1299.00)</span>
                    <div class="collapse clearfix" id="collapseExample">
                        <div class="col-md-12">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad adipisci fugit, ipsam numquam odit qui ratione rerum suscipit ullam voluptatibus? Beatae, eius error expedita qui quo suscipit tempore voluptatibus! Deserunt!
                            <h5><b>Services</b></h5>
                            <table class="table table-condensed table-striped">
                                <thead>
                                <tr class="bg-grey-goto text-white">
                                    <th colspan="2">Concepts</th>
                                    <th>Prices</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Transfer</td>
                                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                                    <td>1299.00</td>
                                    <td>
                                        <a href="" class="text-16 text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="" colspan="4">
                                        <a href="#add-services1" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">Add new services <i class="fa fa-plus-circle" aria-hidden="true"></i></a>

                                        <div class="collapse" id="add-services1">
                                            <div class="row margin-top-10">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" id="txt_code" name="txt_code" placeholder="Services">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 row">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" id="txt_code" name="txt_code" placeholder="Price">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <a href="" class="btn btn-success btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="box-sortable margin-bottom-10">
                    <a class="btn btn-link" role="button" data-toggle="collapse" href="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                        <b>Dia 2:</b> Peru full day
                    </a>
                    <span class="label label-success pull-right">($1899.00)</span>
                    <div class="collapse clearfix" id="collapseExample2">
                        <div class="col-md-12">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias animi aperiam, consectetur cum dicta distinctio eligendi libero, magnam minus nemo nisi nulla pariatur quod? At aut distinctio maxime optio suscipit?
                            <h5><b>Services</b></h5>
                            <table class="table table-condensed table-striped">
                                <thead>
                                <tr class="bg-grey-goto text-white">
                                    <th colspan="2">Concepts</th>
                                    <th>Prices</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Transfer</td>
                                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                                    <td>1299.00</td>
                                    <td>
                                        <a href="" class="text-16 text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="" colspan="3">
                                        <a href="#add-services2" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">Add new services <i class="fa fa-plus-circle" aria-hidden="true"></i></a>

                                        <div class="collapse" id="add-services2">
                                            <div class="row margin-top-10">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" id="txt_code" name="txt_code" placeholder="Services">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 row">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" id="txt_code" name="txt_code" placeholder="Price">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <a href="" class="btn btn-success btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <b class="font-montserrat">COST WITHOUT HOTELS $987 P.P</b>
                </div>
            </div>
        </div>
        <div class="col-md-1 ">
            <a href="" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
        </div>
        <div class="col-md-5">
            <div class="row">
                <b class="font-montserrat text-orange-goto">LIMA</b>
            </div>
            <div class="row margin-bottom-5">
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
            <div class="row margin-bottom-5">
                <div class="input-group">
                  <span class="input-group-addon">
                      <input type="checkbox" aria-label="...">
                  </span>

                    <input type="text" class="form-control" aria-label="..." value="Lima City Tours" readonly>

                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapseExample4"><b>$399.00</b> <i class="fa fa-arrows-v" aria-hidden="true"></i></button>
                    </span>
                </div><!-- /input-group -->
                <div class="collapse clearfix" id="collapseExample4">
                    <div class="col-md-12 well">
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
                                <input type="number" class="form-control text-right" id="exampleInputAmount" placeholder="Amount">
                                {{--<div class="input-group-addon">.00</div>--}}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group margin-bottom-0">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="number" class="form-control text-right" id="exampleInputAmount" placeholder="Amount">
                                {{--<div class="input-group-addon">.00</div>--}}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group margin-bottom-0">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="number" class="form-control text-right" id="exampleInputAmount" placeholder="Amount">
                                {{--<div class="input-group-addon">.00</div>--}}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group margin-bottom-0">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="number" class="form-control text-right" id="exampleInputAmount" placeholder="Amount">
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
                                <input type="number" class="form-control text-right" id="exampleInputAmount" placeholder="Amount">
                                {{--<div class="input-group-addon">.00</div>--}}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group margin-bottom-0">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="number" class="form-control text-right" id="exampleInputAmount" placeholder="Amount">
                                {{--<div class="input-group-addon">.00</div>--}}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group margin-bottom-0">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="number" class="form-control text-right" id="exampleInputAmount" placeholder="Amount">
                                {{--<div class="input-group-addon">.00</div>--}}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group margin-bottom-0">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="number" class="form-control text-right" id="exampleInputAmount" placeholder="Amount">
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
                                <input type="number" class="form-control text-right" id="exampleInputAmount" placeholder="Amount">
                                {{--<div class="input-group-addon">.00</div>--}}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group margin-bottom-0">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="number" class="form-control text-right" id="exampleInputAmount" placeholder="Amount">
                                {{--<div class="input-group-addon">.00</div>--}}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group margin-bottom-0">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="number" class="form-control text-right" id="exampleInputAmount" placeholder="Amount">
                                {{--<div class="input-group-addon">.00</div>--}}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group margin-bottom-0">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="number" class="form-control text-right" id="exampleInputAmount" placeholder="Amount">
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
        <div class="col-md-3">
            <div class="form-group margin-bottom-0">
                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                <div class="input-group">
                    <div class="input-group-addon">Profit</div>
                    <input type="text" class="form-control text-right" id="exampleInputAmount" placeholder="Percent">
                    <div class="input-group-addon">%</div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <table class="table table-condensed table-bordered font-montserrat">
                <caption class="text-right"><b>Total price for Packages</b></caption>
                <thead>
                <tr class="bg-grey-goto text-white">
                    <th class="text-center">GTP500</th>
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
                                <input type="number" class="form-control text-right" id="exampleInputAmount" placeholder="Amount">
                                {{--<div class="input-group-addon">.00</div>--}}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group margin-bottom-0">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="number" class="form-control text-right" id="exampleInputAmount" placeholder="Amount">
                                {{--<div class="input-group-addon">.00</div>--}}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group margin-bottom-0">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="number" class="form-control text-right" id="exampleInputAmount" placeholder="Amount">
                                {{--<div class="input-group-addon">.00</div>--}}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group margin-bottom-0">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="number" class="form-control text-right" id="exampleInputAmount" placeholder="Amount">
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
                                <input type="number" class="form-control text-right" id="exampleInputAmount" placeholder="Amount">
                                {{--<div class="input-group-addon">.00</div>--}}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group margin-bottom-0">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="number" class="form-control text-right" id="exampleInputAmount" placeholder="Amount">
                                {{--<div class="input-group-addon">.00</div>--}}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group margin-bottom-0">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="number" class="form-control text-right" id="exampleInputAmount" placeholder="Amount">
                                {{--<div class="input-group-addon">.00</div>--}}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group margin-bottom-0">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="number" class="form-control text-right" id="exampleInputAmount" placeholder="Amount">
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
                                <input type="number" class="form-control text-right" id="exampleInputAmount" placeholder="Amount">
                                {{--<div class="input-group-addon">.00</div>--}}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group margin-bottom-0">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="number" class="form-control text-right" id="exampleInputAmount" placeholder="Amount">
                                {{--<div class="input-group-addon">.00</div>--}}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group margin-bottom-0">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="number" class="form-control text-right" id="exampleInputAmount" placeholder="Amount">
                                {{--<div class="input-group-addon">.00</div>--}}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group margin-bottom-0">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="number" class="form-control text-right" id="exampleInputAmount" placeholder="Amount">
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
            <button type="submit" class="btn btn-lg btn-primary">Submit <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
        </div>
    </div>

@stop