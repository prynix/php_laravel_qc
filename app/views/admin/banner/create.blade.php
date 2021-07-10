@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 style="">
                        Add new banner
                        @if($zone)
                        	@foreach($zone as $zone)
                            <span class="target">to zone {{$zone->zonename}}</span>
                            @endforeach()
                        @else
                        @endif
                        <!-- <small>Preview</small> -->
                    </h1>

                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="banner"> Banners</a></li>
                        <li class="active">Add new banner</li>
                    </ol>

                    <br/>
                    @if($website)
                        @foreach($website as $website)
                        <a href="{{URL::to('admin/website-edit-'.$website->id)}}" title="">Website: {{$website->name}}</a>
                        @endforeach()
                    @else
                    @endif
                    @if($zone)
                        >&nbsp;<a href="{{URL::to('admin/zone-edit-'.$zone->id)}}" title="">Zone: {{$zone->zonename}}</a>
                    @else
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
                                    <h3 class="box-title">Add new banner</h3>
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
                                
                        {{Form::open(array('files'=>true))}}
                                    <div class="box-body">
                                        <div class="form-group">
                                            {{Form::label('storagetype','Please choose the type of the banner')}}
                                            <select name="storagetype" data-placeholder="Choose a Campaign..." class="chosen-select" tabindex="1" id="storagetype">
                                                <option value="web">Upload a local banner to the webserver</option>
                                                <option value="sql">Upload a local banner to the database</option>
                                                <option value="url">Link an external banner</option>
                                                <option value="html">Generic HTML Banner</option>
                                                <option value="text">Generic Text Banner</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('description','Name')}}&nbsp;<font color="#FF0000">*</font>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-picture-o"></i></span>
                                                {{Form::text('description',Input::old('description'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
                                            </div>
                                            @if($errors->first('description'))
                                            <div class="alert alert-danger alert-dismissable">
                                                <i class="fa fa-ban"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                {{$errors->first('description')}}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group" id="filename">
                                            {{Form::label('filename','Upload a local banner to the webserver - banner creative')}}<br/>
                                            {{Form::file('filename',array('id'=>'file-1a','multiple'=>true,'class'=>'file','data-show-upload'=>false,'data-preview-file-type'=>'any','data-initial-caption'=>'','data-overwrite-initial'=>'false'))}}
                                            <p class="help-block">Select the image / video / text link ... you want to use for this banner. Accepted files are: jpg, jpeg, gif, png, swf and flv.</p>
                                        </div>
                                        <div class="form-group" id="imageurl" style="display:none;">
                                            {{Form::label('imageurl','Image / Video / Text link ... URL (incl. http://)')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-picture-o"></i></span>
                                                {{Form::text('imageurl',Input::old('imageurl'),array('class'=>'form-control','placeholder'=>'http://'))}}                                
                                            </div>
                                        </div>
                                        <div class="form-group" id="htmltemplate" style="display:none;">
                                            {{Form::label('url','Create an HTML banner - banner code')}}
                                            {{Form::textarea('htmltemplate',Input::old('htmltemplate'),array('class'=>'form-control','placeholder'=>'Alter HTML to enable click tracking for Google AdSense ...','rows'=>5))}}
                                        </div>
                                        <div class="form-group" id="bannertext_2" style="display:none;">
                                            {{Form::label('url','Create a Text banner - banner text')}}
                                            {{Form::textarea('bannertext_2',Input::old('bannertext_2'),array('class'=>'form-control','placeholder'=>'Enter ...','rows'=>5))}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('url','Destination URL (incl. http://)')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-link"></i></span>
                                                {{Form::text('url',Input::old('url'),array('class'=>'form-control','placeholder'=>'http://'))}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('target','Target')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
                                                {{Form::text('target',Input::old('target'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
                                            </div>
                                        </div>
                                        <div class="form-group" id="alt">
                                            {{Form::label('alt','Alt text')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                                                {{Form::text('alt',Input::old('alt'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
                                            </div>
                                        </div>
                                        <div class="form-group" id="statustext">
                                            {{Form::label('statustext','Status text')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                                                {{Form::text('statustext',Input::old('statustext'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
                                            </div>
                                        </div>
                                        <div class="form-group" id="bannertext">
                                            {{Form::label('bannertext','Text below image')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                                                {{Form::text('bannertext',Input::old('bannertext'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
                                            </div>
                                        </div>
                                        <div class="form-group" id="width">
                                            {{Form::label('width','Width')}}&nbsp;<font color="#FF0000">*</font>
                                            {{Form::input('number','width',Input::old('width'),array('class'=>'form-control','min'=>0,'style'=>'width:100px;'))}}&nbsp;<strong>px</strong>
                                            &nbsp;<label>{{Form::input('checkbox','width_by_percent','',array('class'=>'flat-red width_by_percent','checked'=>'checked'))}}&nbsp;Fix width 100%</label>
                                            @if($errors->first('width'))
                                            <div class="alert alert-danger alert-dismissable">
                                                <i class="fa fa-ban"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                {{$errors->first('width')}}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group" id="height">
                                            {{Form::label('height','Height')}}&nbsp;<font color="#FF0000">*</font>
                                            {{Form::input('number','height',Input::old('height'),array('class'=>'form-control','min'=>0,'style'=>'width:100px;'))}}&nbsp;<strong>px</strong>
                                            &nbsp;<label>{{Form::input('checkbox','height_by_percent','',array('class'=>'flat-red height_by_percent','checked'=>'checked'))}}&nbsp;Fix height 100%</label>
                                            @if($errors->first('height'))
                                            <div class="alert alert-danger alert-dismissable">
                                                <i class="fa fa-ban"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                {{$errors->first('height')}}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('keyword','Keywords')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                {{Form::text('keyword',Input::old('keyword'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
                                            </div>                                                
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('weight','Weight')}}
                                            {{Form::input('number','weight',Input::old('weight',0),array('class'=>'form-control','min'=>'0','style'=>'width:100px;'))}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('comments','Comments')}}
                                            {{Form::textarea('comments',Input::old('comments'),array('class'=>'form-control','placeholder'=>'Enter ...','rows'=>3))}}
                                        </div>
                                        <button type="submit" class="btn-sm btn-success"><i class="fa fa-check-circle-o"></i>&nbsp;Save & New</button>
                                    </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        {{Form::close()}}
						</div><!--/.col (right) -->
                        <div class="col-md-6">
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Ad Forms</h3>
                                </div>
                                <div class="box-body table-responsive"> 
                                    <div class="form-group">
                                        <h4>Choose to add ads into ad forms</h4>
                                        @foreach($adforms as $adform)
                                            <label><input type="checkbox" value="{{$adform['id']}}" name="form_id" />&nbsp;{{$adform['form_name']}}</label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   <!-- /.row -->
                </section><!-- /.content -->

@stop