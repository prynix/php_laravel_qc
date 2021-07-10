@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Add new zone: to website <a href="{{URL::to('admin/website-edit-'.$website->id)}}" title="">{{$website->name}}</a>
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="zone"> Zones</a></li>
                        <li class="active">Add new zone</li>
                    </ol>
                    <br/>
                    <a href="{{URL::to('admin/website-edit-'.$website->id)}}" title="">Website: {{$website->name}}</a>
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
                                    <h3 class="box-title">Basic information</h3>
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
                                        <div class="form-group">
                                            {{Form::label('zonename','Name')}}&nbsp;<font color="#FF0000">*</font></label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-anchor"></i></span>
                                                {{Form::text('zonename',Input::old('zonename'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
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
                                            {{Form::textarea('description',Input::old('description'),array('class'=>'form-control','placeholder'=>'Enter ...','rows'=>3))}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('category','Category')}}
                                            <select data-placeholder="-- Select --" class="chosen-select" style="width:100%;" tabindex="1" name="category">
                                                <option value="0">-- Main --</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{ $category->category_name }}</option>
                                                            @foreach($category['children'] as $category)
                                                            
                                                            <option value="{{$category->id}}">--|&nbsp;{{ $category->category_name }}</option>
                                                            
                                                            @endforeach
                                                    
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('zonetype','Zone type')}}<br/>
                                            @foreach($zonetypes as $zonetype)
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="zonetype" id="optionsRadios1" value="{{$zonetype->id}}" class="flat-red">
                                                        &nbsp;{{$zonetype->title}}
                                                    </label>
                                                </div>
                                            @endforeach
                                            @if($errors->first('zonetype'))
                                            <div class="alert alert-danger alert-dismissable">
                                                <i class="fa fa-ban"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                {{$errors->first('zonetype')}}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('ad_selection','Ad type')}}
                                            <select data-placeholder="-- Select --" class="chosen-select" tabindex="1" name="ad_selection">
                                                <option value="0">-- Customize --</option>
                                                @foreach($adtypes as $adtype)
                                                    <option value="{{$adtype->id}}">{{ $adtype->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('width','Width')}}&nbsp;<font color="#FF0000">*</font>
                                            {{Form::input('number','width',Input::old('width'),array('class'=>'form-control','style'=>'width:100px'))}}&nbsp;<strong>px</strong>
                                            &nbsp;<label>{{Form::input('checkbox','width_by_percent','',array('class'=>'flat-red width_by_percent','checked'=>'checked'))}}&nbsp;Fix width 100%</label>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('height','Height')}}&nbsp;<font color="#FF0000">*</font>
                                            {{Form::input('number','height',Input::old('height'),array('class'=>'form-control','style'=>'width:100px'))}}&nbsp;<strong>px</strong>
                                            &nbsp;<label>{{Form::input('checkbox','height_by_percent','',array('class'=>'flat-red height_by_percent','checked'=>'checked'))}}&nbsp;Fix height 100%</label>
                                        </div>
                                        <div class="form-group">
                                        	{{Form::label('pricing','Pricing')}}&nbsp;
                                            {{Form::input('number','pricing',Input::old('pricing',0),array('class'=>'form-control','style'=>'width:100px'))}}
                                        </div>
                                        <div class="form-group">
                                        {{Form::label('comments','Comments')}}
                                            {{Form::textarea('comments',Input::old('comments'),array('class'=>'form-control','placeholder'=>'Enter ...','rows'=>6))}}
                                        </div>
                                        <button type="submit" class="btn-sm btn-success"><i class="fa fa-check-circle-o"></i>&nbsp;Save & New</button>
                                    </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                        <!-- <div class="col-md-6">
                            <div class="box box-success">
                                <div class="box-body">
                                    <div class="form-group">
                                        {{Form::label('website_id','Website')}}<br/>
                                        <select data-placeholder="Choose a Website..." class="chosen-select" style="width:100%;" tabindex="1" name="website_id">
                                            @foreach($websites as $website)
                                                <option value="{{$website->id}}">{{ $website->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    {{Form::close()}}
                    </div>   <!-- /.row -->
                </section><!-- /.content -->

@stop
    
