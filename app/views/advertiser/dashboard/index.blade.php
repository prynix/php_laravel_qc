@extends('layout.main')
@section('content')
	<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					@if(Auth::user()->default_account_id==3)
					@else
                    <!-- Small boxes (Stat box) -->
                    <div class="row" id="stats_top">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        {{$advertisers}}
                                    </h3>
                                    <p>
                                        Advertisers
                                    </p>
                                </div>
                                <div class="icon">
                                    <!--<i class="ion ion-bag"></i>-->
                                    {{HTML::image('assets/img/icon/call-us.png','',array('title'=>'Advertisers'))}}
                                </div>
                                <a href="advertiser" class="small-box-footer">
                                    More info <!--<i class="fa fa-arrow-circle-right"></i>-->
                                    {{HTML::image('assets/img/icon/arrow_right.png','arrow right',array('title'=>'More info'))}}
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        {{$banners}}
                                    </h3>
                                    <p>
                                        Banners
                                    </p>
                                </div>
                                <div class="icon">
                                    <!--<i class="ion ion-stats-bars"></i>-->
                                    {{HTML::image('assets/img/icon/green_banner.png','',array('title'=>'Banners'))}}
                                </div>
                                <a href="banner" class="small-box-footer">
                                    More info <!--<i class="fa fa-arrow-circle-right"></i>-->
                                    {{HTML::image('assets/img/icon/arrow_right.png','arrow right',array('title'=>'More info'))}}
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        {{$websites}}
                                    </h3>
                                    <p>
                                        Websites
                                    </p>
                                </div>
                                <div class="icon">
                                    <!--<i class="ion ion-person-add"></i>-->
                                    {{HTML::image('assets/img/icon/website.png','',array('title'=>'Websites'))}}
                                </div>
                                <a href="website" class="small-box-footer">
                                    More info <!--<i class="fa fa-arrow-circle-right"></i>-->
                                    {{HTML::image('assets/img/icon/arrow_right.png','arrow right',array('title'=>'More info'))}}
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        {{$zones}}
                                    </h3>
                                    <p>
                                        Zones
                                    </p>
                                </div>
                                <div class="icon">
                                    <!--<i class="ion ion-pie-graph"></i>-->
                                    {{HTML::image('assets/img/icon/zone.png','',array('title'=>'Zones'))}}
                                </div>
                                <a href="zone" class="small-box-footer">
                                    More info <!--<i class="fa fa-arrow-circle-right"></i>-->
                                    {{HTML::image('assets/img/icon/arrow_right.png','arrow right',array('title'=>'More info'))}}
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->
					@endif
                    <!-- top row -->
                    @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissable">
                            <i class="fa fa-check"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <b>Alert!</b> {{Session::get('success')}}
                        </div>
                    @endif
                                        @if(Session::has('danger'))
                                            <div class="alert alert-danger alert-dismissable">
                                                <i class="fa fa-ban"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                {{Session::get('danger')}}
                                            </div>
                                        @endif
                        

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-6">
                            <!-- calendar -->
                            <div class="box box-success">
                                <div class="box-header" style="cursor: move;">
                                    <i class="fa fa-calendar"></i>
                                    <div class="box-title">Calendar</div>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-success btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->                                   
                                </div>
                                <div class="box-body">
                                    <div class="cal1"></div>
                                </div>
                            </div>
                        </section>
                        <section class="col-lg-6">
                            <!-- quick email widget -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <i class="fa fa-envelope"></i>
                                    <h3 class="box-title">Quick Email</h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-success btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->
                                </div>
                                {{HTML::ul($errors->all())}}
                                {{Form::open(array('url'=>'/admin/dashboard/send-email'))}}
                                <div class="box-body">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" placeholder="Email to:"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="subject" placeholder="Subject:"/>
                                        </div>
                                        <div>
                                            <textarea class="textarea" name="message" placeholder="Message:" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        </div>
                                </div>
                                <div class="box-footer clearfix">
                                    <button class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i></button>
                                </div>
                                {{Form::close()}}
                            </div>

                        </section><!-- /.Left col -->
                        
                    </div><!-- /.row (main row) -->
                </section><!-- /.content -->
@stop