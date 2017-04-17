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
        <div class="col-md-12">
            <div class="form-horizontal">
                <div class="form-group">
                    <label for="txt_day" class="col-sm-2 control-label">Days</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="txt_day" name="txt_day" placeholder="Days">
                    </div>
                </div>
                <div class="form-group">
                    <label for="txt_code" class="col-sm-2 control-label">Code</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txt_code" name="txt_code" placeholder="Code">
                    </div>
                </div>
                <div class="form-group">
                    <label for="txt_title" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txt_title" name="txt_title" placeholder="Title">
                    </div>
                </div>
                <div class="form-group">
                    <label for="txta_description" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="txta_description" name="txta_description" rows="3"></textarea>
                    </div>
                </div>

            </div>
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
        <div class="col-md-6 grid">
            <div class="box-sortable margin-bottom-10">
                <a class="btn btn-link" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <b>Dia 1:</b> Peru full day
                </a>
                <div class="collapse clearfix" id="collapseExample">
                    <div class="col-md-12">

                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad adipisci fugit, ipsam numquam odit qui ratione rerum suscipit ullam voluptatibus? Beatae, eius error expedita qui quo suscipit tempore voluptatibus! Deserunt!

                    </div>
                </div>
            </div>
            <div class="box-sortable margin-bottom-10">
                <a class="btn btn-link" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <b>Dia 2:</b> Peru full day
                </a>
                <div class="collapse clearfix" id="collapseExample">
                    <div class="col-md-12">

                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad adipisci fugit, ipsam numquam odit qui ratione rerum suscipit ullam voluptatibus? Beatae, eius error expedita qui quo suscipit tempore voluptatibus! Deserunt!

                    </div>
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
                        <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapseExample2"><i class="fa fa-angle-double-down" aria-hidden="true"></i></button>
                    </span>
                </div><!-- /input-group -->
                <div class="collapse clearfix" id="collapseExample2">
                    <div class="col-md-12 well margin-top-5">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad adipisci fugit, ipsam numquam odit qui ratione rerum suscipit ullam voluptatibus? Beatae, eius error expedita qui quo suscipit tempore voluptatibus! Deserunt!
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
                        <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapseExample2"><i class="fa fa-angle-double-down" aria-hidden="true"></i></button>
                    </span>
                </div><!-- /input-group -->
                <div class="collapse clearfix" id="collapseExample2">
                    <div class="col-md-12 well">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad adipisci fugit, ipsam numquam odit qui ratione rerum suscipit ullam voluptatibus? Beatae, eius error expedita qui quo suscipit tempore voluptatibus! Deserunt!
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
            <div class="form-group">
                <label for="txta_include">Include</label>
                <textarea class="form-control" id="txta_include" name="txta_include" rows="3"></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="txta_notinclude">Not Include</label>
                <textarea class="form-control" id="txta_notinclude" name="txta_notinclude" rows="3"></textarea>
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
                <tr class="bg-grey-goto text-white">
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
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-lg btn-primary">Submit <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
        </div>
    </div>

@stop