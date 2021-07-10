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
                        {{Form::open(array('files'=>true))}}
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Basic information</h3>
                                </div><!-- /.box-header -->
                                <!-- form start
                                {{HTML::ul($errors->all())}} -->
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
                                            <p class="help-block">Select the image / video / text link ... you want to use for this banner</p>
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
                                        <div class="form-group" id="width" style="">
                                            {{Form::label('width','Width')}}&nbsp;<font color="#FF0000">*</font>
                                            {{Form::input('number','width',Input::old('width',0),array('class'=>'form-control','min'=>0,'style'=>'width:100px;'))}}
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
                                            {{Form::input('number','height',Input::old('height',0),array('class'=>'form-control','min'=>0,'style'=>'width:100px;'))}}
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
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-success">Create</button>
                                    </div>
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
                                                <td align="center">{{Form::input('radio','zoneid',Input::old('zoneid',$zone->id),array('class'=>'flat-red'))}}</td>
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
                                    @if($errors->first('zoneid'))
                                        <div class="alert alert-danger alert-dismissable">
                                            <i class="fa fa-ban"></i>
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            {{$errors->first('zoneid')}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>-->
                        {{Form::close()}}
                    </div>   <!-- /.row -->
                </section><!-- /.content -->

@stop