@extends('layout.main')
@section('content') 
<script type="text/javascript" src="../assets/js/adman.js"></script>
<section class="content-header">
                    <h1>
                        Demo zone
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="zone"> Zones</a></li>
                        <li class="active">Demo zone</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Display banners</h3>
                                    <button class="slide_open btn-sm btn-default btn-help"><i class="fa fa-anchor"></i>&nbsp;Help</button>
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
                                <div class="box-body">
                                	<div class="form-group" style="clear:both;margin-bottom:10px;">
	                                	<div style="float:left;width:25%;">
				                            <select class="form-control" id="demo_zoneid">
				                                <option value="" disabled selected>-- Choose zone --</option>
				                                @foreach($zones as $zone)
                                                    @foreach($websites as $website)
                                                        @if($website->id==$zone->website_id)
				                                            <option value="{{$zone->id}}" website="{{$website->domain_name}}">{{ $zone->zonename }}</option>
                                                        @endif
                                                    @endforeach
				                                @endforeach
				                            </select>
				                        </div>
                                        <div style="float:left;width:20%;margin-left:10px;">
                                        <label style="float:left;width:50%;text-align:center;">{{Form::input('checkbox','chk_timeout','',array('class'=>'form-control'))}}&nbsp;Has time out</label>
                                            <input type="number" value="10000" name="txt_timeout" class="form-control" style="float:left;width:50%;" disabled="disabled">
                                        </div>
                                        <div style="float:left;width:auto;margin-left:10px;">
                                            <button id="btnRefresh" class="btn-sm btn-default"><i class="fa fa-refresh"></i>&nbsp;Refresh</button>
                                            <button id="btnDisplay" class="btn-sm btn-primary"><i class="fa fa-camera"></i>&nbsp;Display</button>
                                            <button id="btnCode" class="btn-sm btn-danger"><i class="fa fa-code"></i>&nbsp;Javascript code</button>
                                        </div>
				                    </div>
                                    <div style="width:100%;height:10px;clear:both;"></div>
			                        <div class="form-group">
			                        	<textarea class='form-control' id="zone_code" rows="10" style="border-width:2px;" data-step="1" data-intro="Get invocation code of zone"></textarea>
			                        </div>
                                	<div id="zone_banners" style="height:900px;">
                                		
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

@stop