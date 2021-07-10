@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Add new Targeting Channel: to website 
                        @if($website)
                        	<a href="{{URL::to('admin/website-edit-'.$website->id)}}" title="">{{$website->name}}</a>
                        @else
                        @endif
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="channel"> Targeting Channels</a></li>
                        <li class="active">Add new Targeting Channel</li>
                    </ol>
                    <br/>
                    @if($website)
                    	<a href="{{URL::to('admin/website-edit-'.$website->id)}}" title="">Website: {{$website->name}}</a>	
                    @endif
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Add new Targeting Channel</h3>
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
                                        </div>
                                    </div>
                                {{Form::open()}}
                                    <div class="box-body">
                                        <div class="form-group">
                                            {{Form::label('name','Name')}}&nbsp;<font color="#FF0000">*</font>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-laptop"></i></span>
                                                {{Form::text('name',Input::old('name'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
                                            </div>
                                            @if($errors->first('name'))
                                            <div class="alert alert-danger alert-dismissable">
                                                <i class="fa fa-ban"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                {{$errors->first('name')}}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('description','Description')}}
                                            {{Form::textarea('description',Input::old('description'),array('class'=>'form-control','placeholder'=>'Enter ...','rows'=>3))}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('comments','Comments')}}
                                            {{Form::textarea('comments',Input::old('comments'),array('class'=>'form-control','placeholder'=>'Enter ...','rows'=>3))}}
                                        </div>
                                        <button type="submit" class="btn-sm btn-success"><i class="fa fa-check-circle-o"></i>&nbsp;Save & New</button>
                                    </div>
                                {{Form::close()}}
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                        <!-- <div class="col-md-6">
                            <!-- general form elements -->
                            <!-- <div class="box box-success">
                                <div class="box-body">
                                    <div class="form-group">
                                        {{Form::label('website_id','Website')}}<br/>
                                        <select data-placeholder="Choose a Website..." class="chosen-select" tabindex="1" name="website_id">
                                            <!-- -->
                                            @foreach($websites as $website)
                                                <!-- <option value="{{$website->id}}">{{ $website->name }}</option> -->
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- /.box-body -->
                            </div> -->
                        </div> -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->

@stop