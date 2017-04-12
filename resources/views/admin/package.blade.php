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
            <h4 class="font-montserrat"><span class="label bg-grey-goto">1</span> Package</h4>
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

    <div class="row">
        <div class="col-md-12">
            <h4 class="font-montserrat"><span class="label bg-grey-goto">1</span> Itinerary</h4>
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

    <div class="row">
        <div class="col-md-12">
            <h4 class="font-montserrat"><span class="label bg-grey-goto">1</span> Include & Not include</h4>
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
@stop