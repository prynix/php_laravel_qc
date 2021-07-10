@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Generate URL
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="ccount"> Click Counter</a></li>
                        <li class="active">Generate URL</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <button class="slide_open btn-sm btn-default btn-help float-left"><i class="fa fa-anchor"></i>&nbsp;Help</button>
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
                                        </div>
                                    </div>
                                <!-- form start -->
                                    <div class="box-body">
                                		{{Form::open()}}
                                        <div class="form-group">
                                            {{Form::label('modaltxt','Use this URL to count clicks on the link:')}}
                                            {{Form::textarea('modaltxt',Input::old('modaltxt',$click_url.'?id='.$banner->id),array('class'=>'form-control','rows'=>2))}}
                                        </div>
                                		{{Form::close()}}
                                        <a href="{{URL::to('admin/ccount')}}"><button class="btn-sm btn-default"><i class="fa fa-arrow-circle-o-left">&nbsp;Back</i></button></a>
                                    </div>
                            </div><!-- /.box -->
						</div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->

@stop