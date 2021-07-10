@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Show targeting channel<span class="target">: {{$channel->name}}</span>
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="channel"> Targeting Channels</a></li>
                        <li class="active">Show Targeting Channel</li>
                    </ol>
                    <br/>
                    @foreach($websites as $website)
                                                @if($channel->website_id==$website->id)
                                                    Website: {{ $website->name }}
                                                @else
                                                @endif
                                            @endforeach
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Targeting Channel Properties</h3>
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
                                    <div class="box-body">
                        				{{Form::open()}}
                                        <div class="form-group">
                                            {{Form::label('name','Name')}}&nbsp;<font color="#FF0000">*</font>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-laptop"></i></span>
                                            	{{Form::text('name',Input::old('website',$channel->name),array('class'=>'form-control','disabled'=>'disabled'))}}
                                        	</div>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('description','Description')}}
                                            {{Form::textarea('description',Input::old('description',$channel->description),array('class'=>'form-control','disabled'=>'disabled','rows'=>3))}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('comments','Comments')}}
                                            {{Form::textarea('comments',Input::old('comments',$channel->comments),array('class'=>'form-control','disabled'=>'disabled','rows'=>3))}}
                                        </div>
                    					{{Form::close()}}
                                        <a href="{{URL::to('admin/channel')}}"><button class="btn-sm btn-default"><i class="fa fa-arrow-circle-o-left">&nbsp;Back</i></button></a>
                                    </div>
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                        <!--<div class="col-md-6">
                            <div class="box box-success">
                                <div class="box-body">
                                    <div class="form-group">
                                        {{Form::label('website_id','Website')}}<br/>
                                        <select class="form-control" name="website_id" disabled>
                                            @foreach($websites as $website)
                                                @if($channel->website_id==$website->id)
                                                    <option value="{{$website->id}}" selected>{{ $website->name }}</option>
                                                @else
                                                    <option value="{{$website->id}}">{{ $website->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->

@stop