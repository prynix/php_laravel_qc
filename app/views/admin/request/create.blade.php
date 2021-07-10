@extends('layout.main')
@section('content')
<section class="content-header">
                    <h1>
                        
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="advertiser"> </a></li>
                        <li class="active"></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-success">
                                <div class="box-header">
                                        <h3 class="box-title">Advertiser Properties</h3>
                                        <button class="slide_open btn-sm btn-default btn-help"><i class="fa fa-anchor"></i>&nbsp;Help</button>
                                </div><!-- /.box-header -->
								<div id="slide" class="well" style="display:none;top:15%;width:30%;height:80%;bottom:5%;right:45%;left:25%;">
                                    <div id="widget">
                                        <div id="header">
                                            <input type="text" id="search" placeholder="Search in the text" />
                                        </div>
                                        <div id="content">
                                            @if(isset($help))
                                            	@foreach($help as $help)
                                                	@if(Session::get('language',Config::get('app.locale'))=='en')
	                                            		{{$help->content_helper_en}}
                                                    @elseif(Session::get('language',Config::get('app.locale'))=='vi')
                                                    	{{$help->content_helper_vi}}
                                                    @endif
                                            	@endforeach()
                                            @else
                                            @endif
                                        </div>
                                    </div>​​
                                </div>

                                <!-- form start
                                {{HTML::ul($errors->all())}} -->
                                {{Form::open()}}
                                    <div class="box-body">
                                    </div><!-- /.box-body -->
                            </div><!-- /.box -->
						</div><!--/.col (left) -->
						{{Form::close()}}
                        <!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
@stop