@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Edit banner<span class="target">: {{$banner->description}}</span>
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="banner"> Banners</a></li>
                        <li class="active">Edit banner</li>
                    </ol>
                    <br/>
                    @foreach($websites as $website)
                                                @if($banner->website_id==$website->id)
                                                    <a href="{{URL::to('admin/website-edit-'.$website->id)}}" title="">Website: {{ $website->name }}</a>
                                                @else
                                                @endif
                                            @endforeach
                    @foreach($zones as $zone)
                                                @if($banner->zoneid==$zone->id)
                                                    > <a href="{{URL::to('admin/zone-edit-'.$zone->id)}}" title="">Zone: {{ $zone->zonename }}</a>
                                                @else
                                                @endif
                                            @endforeach   
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                    {{Form::open(array('files'=>true))}}
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Banner Properties</h3>
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
                                    	<input type="hidden" name="website_id" value="{{$banner->website_id}}"/>
                                        <input type="hidden" name="zoneid" value="{{$banner->zoneid}}"/>
                                        <!-- <div class="form-group">
                                            {{Form::label('campaignid','Campaign')}}<br/>
                                            <select data-placeholder="-- Select --" class="chosen-select" tabindex="1" name="campaignid">
                                                @foreach($campaigns as $campaign)
                                                    @if($banner->campaignid==$campaign->id)
                                                        <option value="{{$campaign->id}}" selected="selected">{{ $campaign->campaignname }}</option>
                                                    @else
                                                        <option value="{{$campaign->id}}">{{ $campaign->campaignname }}</option>    
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div> -->
                                        <div class="form-group">
                                            {{Form::label('storagetype','Please a local banner to the webserver')}}
                                            <select name="storagetype" data-placeholder="-- Select --" class="chosen-select" tabindex="1" id="storagetype">
                                                @if($banner->storagetype=='web')
                                                    <option value="web" selected>Upload a local banner to the webserver</option>
                                                @else
                                                    <option value="web">Upload a local banner to the webserver</option>
                                                @endif
                                                @if($banner->storagetype=='sql')
                                                    <option value="sql" selected>Upload a local banner to the database</option>
                                                @else
                                                    <option value="sql">Upload a local banner to the database</option>
                                                @endif
                                                @if($banner->storagetype=='url')
                                                    <option value="url" selected>Link an external banner</option>
                                                @else
                                                    <option value="url">Link an external banner</option>
                                                @endif
                                                @if($banner->storagetype=='html')
                                                    <option value="html" selected>Generic HTML Banner</option>
                                                @else
                                                    <option value="html">Generic HTML Banner</option>
                                                @endif
                                                @if($banner->storagetype=='text')
                                                    <option value="text" selected>Generic Text Banner</option>
                                                @else
                                                    <option value="text">Generic Text Banner</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('description','Name')}}&nbsp;<font color="#FF0000">*</font>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-picture-o"></i></span>
	                                            {{Form::text('description',Input::old('description',$banner->description),array('class'=>'form-control'))}}
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
                                            {{Form::label('filename','Upload a local banner to the webserver - banner creative')}}
                                            {{Form::file('filename',array('id'=>'file-1a','multiple'=>true,'class'=>'file','data-show-upload'=>false,'data-preview-file-type'=>'any','data-initial-caption'=>'','data-overwrite-initial'=>'false'))}}
                                            <p class="help-block">Select the image / video / text link ... you want to use for this banner. Accepted files are: jpg, jpeg, gif, png, swf and flv.</p>
                                            <div id="myad">
                                                @if($banner->filename!=='')
                                                    <object data="{{URL::to('/').'/'.$banner->filename}}" width="100%" height="auto">
                                                        {{HTML::image($banner->filename,$banner->filename,array('onerror'=>"this.onerror=null;this.src='assets/img/icon/filenotfound.png'",'width'=>'100%'))}}
                                                    </object>
                                                @else
                                                    {{HTML::image('assets/img/icon/filenotfound.png','File Not Found')}};
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group" id="imageurl" style="display:none;">
                                            {{Form::label('imageurl','Image / Video / Text link ... URL (incl. http://)')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-picture-o"></i></span>
	                                            {{Form::text('imageurl',Input::old('imageurl',$banner->imageurl),array('class'=>'form-control','placeholder'=>'http://'))}}
                                            </div>
                                        </div>
                                        <div class="form-group" id="htmltemplate" style="display:none;">
                                            {{Form::label('url','Create an HTML banner - banner code')}}
                                            {{Form::textarea('htmltemplate',Input::old('htmltemplate',$banner->htmltemplate),array('class'=>'form-control','placeholder'=>'Alter HTML to enable click tracking for Google AdSense ...','rows'=>5))}}
                                        </div>
                                        @if($banner->htmltemplate&&$banner->filename=='')
                                        <div class="form-group">
                                            {{Form::label('','Show Image Banner')}}<br/>
                                            {{$banner->htmltemplate}}
                                        </div>
                                        @else
                                        @endif
                                        <div class="form-group" id="bannertext_2" style="display:none;">
                                            {{Form::label('url','Create a Text banner - banner text')}}
                                            {{Form::textarea('bannertext_2',Input::old('bannertext_2',$banner->bannertext),array('class'=>'form-control','placeholder'=>'Enter ...','rows'=>5))}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('url','Destination URL (incl. http://)')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-link"></i></span>
	                                            {{Form::text('url',Input::old('url',$banner->url),array('class'=>'form-control','placeholder'=>'http://'))}}
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
                                            	{{Form::text('alt',Input::old('alt',$banner->alt),array('class'=>'form-control'))}}
                                            </div>
                                        </div>
                                        <div class="form-group" id="statustext">
                                            {{Form::label('statustext','Status text')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                                            	{{Form::text('statustext',Input::old('statustext',$banner->statustext),array('class'=>'form-control'))}}
                                           	</div>
                                        </div>
                                        <div class="form-group" id="bannertext">
                                            {{Form::label('bannertext','Text below image')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
	                                            {{Form::text('bannertext',Input::old('bannertext',$banner->imagetext),array('class'=>'form-control'))}}
                                            </div>
                                        </div>
                                        <div class="form-group" id="width" style="">
                                            {{Form::label('width','Width')}}&nbsp;<font color="#FF0000">*</font>
                                            {{Form::input('number','width',Input::old('width',$banner->width),array('class'=>'form-control','style'=>'width:100px;'))}}&nbsp;<strong>px</strong>
                                            &nbsp;<label>{{Form::input('checkbox','width_by_percent','',array('class'=>'flat-red width_by_percent'))}}&nbsp;Fix width 100%</label>
                                            @if($errors->first('width'))
                                            <div class="alert alert-danger alert-dismissable">
                                                <i class="fa fa-ban"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                {{$errors->first('width')}}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group" id="height" style="">
                                            {{Form::label('height','Height')}}&nbsp;<font color="#FF0000">*</font>
                                            {{Form::input('number','height',Input::old('height',$banner->height),array('class'=>'form-control','style'=>'width:100px;'))}}&nbsp;<strong>px</strong>
                                            &nbsp;<label>{{Form::input('checkbox','height_by_percent','',array('class'=>'flat-red height_by_percent'))}}&nbsp;Fix height 100%</label>
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
                                            	{{Form::text('keyword',Input::old('keyword',$banner->keyword),array('class'=>'form-control'))}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('weight','Weight')}}
                                            {{Form::input('number','weight',Input::old('weight',$banner->weight),array('class'=>'form-control','min'=>'0','style'=>'width:100px;'))}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('status','Status')}}
                                            <select name="status" class="form-control" style="width:auto;">
                                                <option value="1">Show</option>
                                                <option value="0">Hide</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('comments','Comments')}}
                                            {{Form::textarea('comments',Input::old('comments'),array('class'=>'form-control','rows'=>3))}}
                                        </div>
                                        <button type="submit" class="btn-sm btn-success"><i class="fa fa-check-circle-o"></i>&nbsp;Save</button>
                                    </div><!-- /.box-body -->
                            </div><!-- /.box -->
						</div><!--/.col (right) -->
                        <!--<div class="col-md-6">
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Linked Zones</h3>
                                </div>
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Select / Unselect</th>
                                                <th align="center">Name</th>
                                                <th></th>
                                                <th align="center">Website URL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($zones as $zone)
                                            <tr>
                                                <td align="center">
                                                    @if($banner->zoneid==$zone->id)
                                                        {{Form::input('radio','zoneid',Input::old('zoneid',$zone->id),array('class'=>'flat-red','checked'=>'checked'))}}
                                                    @else
                                                        {{Form::input('radio','zoneid',Input::old('zoneid',$zone->id),array('class'=>'flat-red'))}}
                                                    @endif
                                                </td>
                                                <td>{{$zone->zonename}}</td>
                                                <td><a href="{{URL::to('admin/zone-edit-'.$zone->id)}}" title="Edit zone {{$zone->zonename}}">{{HTML::image('assets/img/icon/edit.gif','Edit')}}</a></td>
                                                <td>
                                                    @foreach($websites as $website)
                                                        @if($zone->website_id==$website->id)
                                                            {{$website->website}}
                                                        @else

                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th align="center">Name</th>
                                                <th></th>
                                                <th align="center">Website URL</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>-->
                        {{Form::close()}}
                    </div>   <!-- /.row -->
                </section><!-- /.content -->

@stop