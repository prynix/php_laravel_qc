@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Banner<span class="target">: {{$banner->description}}</span>
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="../advertiser/campaign"> Campaign</a></li>
                        <li class="active">View banner</li>
                    </ol>
                    <br/>
                    @if($advertiser)
                    	@foreach($advertiser as $advertiser)
                    		Advertiser: {{ $advertiser->clientname }}
                        @endforeach()
                    @else
                    @endif
                    @if($campaign)
                    	@foreach($campaign as $campaign)
                    		> Campaign: {{ $campaign->campaignname }}
                        @endforeach()    
                    @else
                    @endif                   
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        {{Form::open()}}
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Banner Properties</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                {{HTML::ul($errors->all())}}
                                    <div class="box-body">
                                        <!--<div class="form-group">
                                            {{Form::label('campaignid','Campaign')}}<br/>
                                            <select class="form-control" name="campaignid" disabled="disabled">
                                                @foreach($campaigns as $campaign)
                                                    @if($banner->campaignid==$campaign->id)
                                                        <option value="{{$campaign->id}}" selected="selected">{{ $campaign->campaignname }}</option>
                                                    @else
                                                        <option value="{{$campaign->id}}">{{ $campaign->campaignname }}</option>    
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>-->
                                        <div class="form-group">
                                            {{Form::label('storagetype','Please a local banner to the webserver')}}
                                            <select name="storagetype" class="form-control" id="storagetype" disabled>
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
                                                    <option value="html" disabled>Generic HTML Banner</option>
                                                @endif
                                                @if($banner->storagetype=='text')
                                                    <option value="text" selected>Generic Text Banner</option>
                                                @else
                                                    <option value="text" disabled>Generic Text Banner</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('description','Name')}}&nbsp;<font color="#FF0000">*</font>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-picture-o"></i></span>
	                                            {{Form::text('description',Input::old('description',$banner->description),array('class'=>'form-control','disabled'=>'disabled'))}}
                                            </div>
                                        </div>
                                        <div class="form-group" id="filename">
                                            {{Form::label('filename','Upload a local banner to the webserver - banner creative')}}
                                            {{Form::file('filename',Input::old('filename',array('disabled'=>'disabled')))}}
                                            <p class="help-block">Select the image / video / text link ... you want to use for this banner</p>
                                            @if($banner->filename!='')
                                                {{HTML::image($banner->filename,'',array('onerror'=>"this.onerror=null;this.src='http://qc.tintuc.vn/assets/img/icon/filenotfound.png'",'width'=>'100%'))}}
                                            @else
                                                {{HTML::image('assets/img/icon/filenotfound.png','File Not Found')}}
                                            @endif
                                        </div>
                                        <div class="form-group" id="imageurl" style="display:none;">
                                            {{Form::label('imageurl','Image / Video / Text link ... URL (incl. http://)')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-picture-o"></i></span>
	                                            {{Form::text('imageurl',Input::old('imageurl',$banner->imageurl),array('class'=>'form-control','placeholder'=>'http://','disabled'=>'disabled'))}}
                                            </div>
                                        </div>
                                        <div class="form-group" id="htmltemplate" style="display:none;">
                                            {{Form::label('url','Create an HTML banner - banner code')}}
                                            {{Form::textarea('htmltemplate',Input::old('htmltemplate',$banner->htmltemplate),array('class'=>'form-control','placeholder'=>'Alter HTML to enable click tracking for Google AdSense ...','rows'=>5,'disabled'=>'disabled'))}}
                                        </div>
                                        <div class="form-group" id="bannertext_2" style="display:none;">
                                            {{Form::label('url','Create a Text banner - banner text')}}
                                            {{Form::textarea('bannertext_2',Input::old('bannertext_2',$banner->bannertext),array('class'=>'form-control','placeholder'=>'Enter ...','rows'=>5,'disabled'=>'disabled'))}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('url','Destination URL (incl. http://)')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-link"></i></span>
	                                            {{Form::text('url',Input::old('url',$banner->url),array('class'=>'form-control','placeholder'=>'http://','disabled'=>'disabled'))}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('alt','Alt text')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                                            	{{Form::text('alt',Input::old('alt',$banner->alt),array('class'=>'form-control','disabled'=>'disabled'))}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('statustext','Status text')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
	                                            {{Form::text('statustext',Input::old('statustext',$banner->statustext),array('class'=>'form-control','disabled'=>'disabled'))}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('bannertext','Text below image')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                                            	{{Form::text('bannertext',Input::old('bannertext',$banner->imagetext),array('class'=>'form-control','disabled'=>'disabled'))}}
                                            </div>
                                        </div>
                                        <div class="form-group" id="width" style="">
                                            {{Form::label('width','Width')}}&nbsp;<font color="#FF0000">*</font>
                                            {{Form::text('width',Input::old('width',$banner->width),array('class'=>'form-control','style'=>'width:100px;','disabled'=>'disabled'))}}
                                        </div>
                                        <div class="form-group" id="height" style="">
                                            {{Form::label('height','Height')}}&nbsp;<font color="#FF0000">*</font>
                                            {{Form::text('height',Input::old('height',$banner->height),array('class'=>'form-control','style'=>'width:100px;','disabled'=>'disabled'))}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('keyword','Keywords')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
	                                            {{Form::text('keyword',Input::old('keyword',$banner->keyword),array('class'=>'form-control','disabled'=>'disabled'))}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('weight','Weight')}}
                                            {{Form::input('number','weight',Input::old('weight',$banner->weight),array('class'=>'form-control','min'=>'0','style'=>'width:100px;','disabled'=>'disabled'))}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('comments','Comments')}}
                                            {{Form::textarea('comments',Input::old('comments',$banner->comments),array('class'=>'form-control','rows'=>3,'disabled'=>'disabled'))}}
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <a href="{{URL::to('advertiser/campaign')}}" class="btn btn-default">Back</a>
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
                                                <td align="center">
                                                    @if($banner->zoneid==$zone->id)
                                                        {{Form::input('radio','zoneid',Input::old('zoneid',$zone->id),array('class'=>'flat-red','checked'=>'checked'))}}
                                                    @else
                                                        {{Form::input('radio','zoneid',Input::old('zoneid',$zone->id),array('class'=>'flat-red','disabled'=>'disabled'))}}
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