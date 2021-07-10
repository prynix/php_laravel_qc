@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Edit zone<span class="target">: {{$zone->zonename}}</span>
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="zone"> Zones</a></li>
                        <li class="active">Edit zone</li>
                    </ol>
                    <br/>
                    @foreach($websites as $website)
                                                @if($zone->website_id==$website->id)
                                                    <a href="{{URL::to('admin/website-edit-'.$website->id)}}" title="">Website: {{ $website->name }}</a>
                                                @else
                                                @endif
                                            @endforeach
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        {{Form::open()}}
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Zone Properties</h3>
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
                                <!-- form start
                                {{HTML::ul($errors->all())}} -->
                                    <div class="box-body">
                                    	<input type="hidden" name="website_id" value="{{ $zone->website_id }}"/>
                                        <div class="form-group">
                                            {{Form::label('zonename','Name')}}&nbsp;<font color="#FF0000">*</font></label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-anchor"></i></span>
                                            	{{Form::text('zonename',Input::old('zonename',$zone->zonename),array('class'=>'form-control'))}}
                                        	</div>
                                            @if($errors->first('zonename'))
                                            <div class="alert alert-danger alert-dismissable">
                                                <i class="fa fa-ban"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                {{$errors->first('zonename')}}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('description','Description')}}
                                            {{Form::textarea('description',Input::old('description',$zone->description),array('class'=>'form-control','rows'=>3))}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('category','Category')}}
                                            <select data-placeholder="-- Select --" class="chosen-select" tabindex="1" name="category">
                                                <option value="0">-- Select --</option>
                                                @foreach($categories as $cat)
                                                    @if($zone->category==$cat->id)
                                                        <option value="{{$cat->id}}" selected>{{ $cat->category_name }}</option>
                                                    @else
                                                        <option value="{{$cat->id}}">{{ $cat->category_name }}</option>
                                                    @endif
                                                            @foreach($cat['children'] as $cat)
                                                                @if($zone->category==$cat->id)
                                                                    <option value="{{$cat->id}}" selected>--|&nbsp;{{ $cat->category_name }}</option>
                                                                @else
                                                                    <option value="{{$cat->id}}">--|&nbsp;{{ $cat->category_name }}</option>
                                                                @endif
                                                            
                                                            @endforeach
                                                    
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('zonetype','Zone type')}}<br/>
                                            @foreach($zonetypes as $zonetype)
                                                @if($zone->zonetype==$zonetype->id) 
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="zonetype" id="optionsRadios1" value="{{$zonetype->id}}" checked class="flat-red">
                                                            {{$zonetype->title}}
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="zonetype" id="optionsRadios1" value="{{$zonetype->id}}" class="flat-red">
                                                            {{$zonetype->title}}
                                                        </label>
                                                    </div>
                                                @endif()
                                            @endforeach
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('ad_selection','Ad type')}}
                                            <select data-placeholder="-- Select --" class="chosen-select" tabindex="1" name="ad_selection">
                                                <option value="0">-- Select --</option>
                                                @foreach($adtypes as $adtype)
                                                    @if($zone->ad_selection==$adtype->id)
                                                        <option value="{{$adtype->id}}" selected>{{ $adtype->title }}</option>
                                                    @else
                                                        <option value="{{$adtype->id}}">{{ $adtype->title }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('width','Width')}}&nbsp;<font color="#FF0000">*</font>
                                            {{Form::input('number','width',Input::old('width',$zone->width),array('class'=>'form-control','style'=>'width:100px'))}}&nbsp;<strong>px</strong>
                                            &nbsp;<label>{{Form::input('checkbox','width_by_percent','',array('class'=>'flat-red width_by_percent'))}}&nbsp;Fix width 100%</label>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('height','Height')}}&nbsp;<font color="#FF0000">*</font>
                                            {{Form::input('number','height',Input::old('height',$zone->height),array('class'=>'form-control','style'=>'width:100px'))}}&nbsp;<strong>px</strong>
                                            &nbsp;<label>{{Form::input('checkbox','height_by_percent','',array('class'=>'flat-red height_by_percent'))}}&nbsp;Fix height 100%</label>
                                        </div>
                                        <div class="form-group">
                                        	{{Form::label('pricing','Price')}}&nbsp;
                                            {{Form::input('number','pricing',Input::old('pricing',$zone->pricing),array('class'=>'form-control','style'=>'width:100px'))}}
                                        </div>
                                        <div class="form-group">
                                        {{Form::label('comments','Comments')}}
                                            {{Form::textarea('comments',Input::old('comments',$zone->comments),array('class'=>'form-control','rows'=>6))}}
                                        </div>
                                        <button type="submit" class="btn-sm btn-success"><i class="fa fa-check-circle-o"></i>&nbsp;Save</button>
                                    </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                        <!--<div class="col-md-6">
                            <div class="box box-success">
                                <div class="box-body">
                                    <div class="form-group">
                                        {{Form::label('website_id','Website')}}<br/>
                                        <select data-placeholder="Choose a Website..." class="chosen-select" tabindex="1" name="website_id">
                                            @foreach($websites as $website)
                                                @if($zone->website_id==$website->id)
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
                    {{Form::close()}}
                    </div>   <!-- /.row -->
                </section><!-- /.content -->

@stop
    
