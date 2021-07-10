@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Edit link ID {{$banner->id}}
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="ccount"> Click Counter</a></li>
                        <li class="active">Edit link</li>
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
                                <!-- form start 
                                {{HTML::ul($errors->all())}} -->
                                {{Form::open()}}
                                    <div class="box-body">
                                        <div class="form-group">
                                            {{Form::label('url','Link URL')}}
                                            <div class="input-group">
                                            	<span class="input-group-addon"><i class="fa fa-link"></i></span>
                                            	{{Form::text('url',Input::old('url',$banner->url),array('class'=>'form-control'))}}
                                            </div>
                                            <p class="help-block">URL of the link you wish to count clicks on.</p>
                                            @if($errors->first('url'))
                                            <div class="alert alert-danger alert-dismissable">
                                                <i class="fa fa-ban"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                {{$errors->first('url')}}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('title','Link title')}}
                                            <div class="input-group">
                                            	<span class="input-group-addon"><i class="fa fa-flag-checkered"></i></span>
	                                            {{Form::text('title',Input::old('title',$banner->title),array('class'=>'form-control'))}}
                                            </div>
                                            <p class="help-block">Title of the page for the link list.</p>
                                            @if($errors->first('title'))
                                            <div class="alert alert-danger alert-dismissable">
                                                <i class="fa fa-ban"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                {{$errors->first('title')}}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('id','Link ID')}}
                                            <div class="input-group">
	                                        	<span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                            	{{Form::text('id',Input::old('id',$banner->id),array('class'=>'form-control','disabled'=>'disabled'))}}
                                            </div>
                                            <p class="help-block">Page ID for the tracking URL (click.php?id=<strong>page_id</strong>). Allowed chars: a-z A-Z 0-9 - _ .</p>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('total_clicks','Clicks (total)')}}
                                            {{Form::input('number','total_clicks',Input::old('total_clicks',$banner->total_clicks),array('class'=>'form-control','min'=>0,'placeholder'=>0,'maxlength'=>10,'size'=>5,'style'=>'width:100px;','disabled'=>'disabled'))}}
                                            <p class="help-block">Total number of clicks.</p>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('unique_click','Clicks (unique)')}}
                                            {{Form::input('number','unique_click',Input::old('unique_click',$banner->unique_click),array('class'=>'form-control','min'=>0,'placeholder'=>0,'maxlength'=>10,'size'=>5,'style'=>'width:100px;','disabled'=>'disabled'))}}
                                            <p class="help-block">Number of unique clicks.</p>
                                        </div>
                                        <button type="submit" class="btn-sm btn-success"><i class="fa fa-check-circle-o"></i>&nbsp;Save</button>
                                    </div>
                                {{Form::close()}}
                            </div><!-- /.box -->
						</div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->

@stop