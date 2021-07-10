@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Keywords Manager: Keywords Used In Ads
                        <!-- <small>advanced tables</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Keywords Used In Ads</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                                <div class="form-group" style="float:right;width:40%;">
                                        @if(Session::has('success'))
                                            <div class="alert alert-success alert-dismissable">
                                                <i class="fa fa-check"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                {{Session::get('success')}}
                                            </div>
                                        @endif
                                        @if(Session::has('warning'))
                                            <div class="alert alert-warning alert-dismissable">
                                                <i class="fa fa-warning"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                {{Session::get('warning')}}
                                            </div>
                                        @endif
                                        @if(Session::has('danger'))
                                            <div class="alert alert-danger alert-dismissable">
                                                <i class="fa fa-ban"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                {{Session::get('danger')}}
                                            </div>
                                        @endif
                                    </div>
                	<div class="row">
                        <div class="col-xs-12">
                        <div class="box">
                                <div class="box-body table-responsive">
                                	<div class="form-group height-30-percent">
                                        <button class="slide_open btn-sm btn-default btn-help no-margin-top no-margin-right"><i class="fa fa-anchor"></i>&nbsp;Help</button>
                                    </div>
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
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th>Keyword</th>
                                                <th>Ads</th>
                                                <th>Impressions</th>
                                                <th>Clicks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($banners as $banner)
                                        	<tr>
                                            	<td>
                                                	@if($banner->alt!='')
                                                		{{$banner->alt}}
                                                    @else
	                                                    {{$banner->keyword}}
                                                	@endif        
                                                </td>
                                                <td align="center"><a href="#myModalShowAds-{{$banner->id}}" data-toggle="modal">Show ads</a></td>
                                                <td align="center">{{$banner->unique_click}}</td>
                                                <td align="center">{{$banner->total_clicks}}</td>
                                            </tr>
                                            <!-- Modal Show -->
                                            <div class="modal fade" id="myModalShowAds-{{$banner->id}}"
                                                                            tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                                            aria-hidden="true">
                                              <div class="modal-dialog" style="width:50%;height:100%;overflow-y:scroll;overflow-x:hidden;">
                                                <div class="modal-content">
                                                  <div class="modal-body">
                                                    <div class="row">
                                                      <div class="col-md-12"> 
                                                        <!-- general form elements -->
                                                        <div class="box box-primary">
                                                          <div class="box-header" style="padding-bottom: 0;">
                                                            <h3 class="box-title">Ad #{{$banner->id}}</h3>
                                                          </div>
                                                          <div class="box-body">
                                                          	<div class="form-group">
                                                            	<strong>Preview</strong>
                                                                <div id="myad">
                                                                    @if($banner->filename!='')
                                                                        {{HTML::image($banner->filename,'',array('onerror'=>"this.onerror=null;this.src='http://qc.tintuc.vn/assets/img/icon/filenotfound.png'",'width'=>'100%'))}}
                                                                    @else
                                                                        {{HTML::image('assets/img/icon/filenotfound.png','File Not Found')}};
                                                                    @endif
                                                                </div>
                                                          	</div>
                                                            <div class="form-group">
                                                            	<strong>Created at:</strong>&nbsp;
                                                                {{$banner->created_at}}
                                                          	</div>
                                                            <div class="form-group">
                                                            	<strong>Zone:</strong>&nbsp;
                                                                @foreach($zones as $zone)
                                                                	@if($zone->id==$banner->zoneid)
                                                                   		{{$zone->zonename}}
                                                                    @else 
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                            <div class="form-group">
                                                            	<strong>Keywords:</strong>&nbsp;
                                                                @if($banner->alt!='')
                                                                    {{$banner->alt}}
                                                                @else
                                                                    {{$banner->keyword}}
                                                                @endif
                                                          	</div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                <!-- /.modal-content --> 
                                              </div>
                                              <!-- /.modal-dialog --> 
                                            </div>
                                            <!-- /.modal --> 
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            	<th>Keyword</th>
                                                <th>Ads</th>
                                                <th>Impressions</th>
                                                <th>Clicks</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->

@stop