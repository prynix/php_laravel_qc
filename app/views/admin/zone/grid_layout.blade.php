@extends('layout.main')
@section('content')
<script type="text/javascript">
    var $dragging=null;
    $(document.body).on('mousemove',function(e){
        if($dragging){
            $dragging.offset({
                top: e.pageY,
                left: e.pageX
            });
        }
    });
    $(document.body).on('mousedown','div.container > div.d-container',function(e){
        $dragging=$(e.target);
    });
    $(document.body).on('mouseup',function(e){
        $dragging=null;
    });
</script>
<section class="content-header">
    <h1>
        Layout display banners
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="zone"> Zones</a></li>
        <li class="active">Display banners</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
            	<div class="box-header">
                    <h3 class="box-title">Dynamic display banners</h3> 
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
            		<h4 style="text-align:center;">Web page</h4>
            		<span class="label label-warning">Warning</span> With code of google adsense only display max 5 banners.
            		<div class="container" style="width:100%;margin-top:5px;">
					    <!--<script type='text/javascript' src='http://localhost/skylink/public/assets/js/ilink.js'></script>
					    <script type='text/javascript'>
							displayAdsRSS(8,6,'horizontal');
						</script>
						<div class='horizontal_display'></div>
						<a href="#myModalShowHorizontal" title="Modal Show Vertical" data-toggle="modal"><i class="fa fa-edit"></i></a>--> 
					    <!-- Modal Show Horizontal 
								<div class="modal fade" id="myModalShowHorizontal"
								tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
								aria-hidden="true" style="background:transparent;position:fixed;text-align:left;font-weight:normal;">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-body">
												<div class="row">
													<div class="col-md-12">
														<div class="box box-warning">
															<div class="box-header" style="padding-bottom: 0;">
																<h3 class="box-title">Show Zone Horizontal <span class="label label-warning">iLink</span></h3>
															</div>
															<div class="box-body">

															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- /.modal-content 
									</div>
									<!-- /.modal-dialog 
								</div>
								<!-- /.modal -->
					    <!-- <div style="width:50%;min-height:600px;"><a href="#myModalShowVertical" title="Modal Show Vertical" data-toggle="modal"><i class="fa fa-edit"></i></a></div> -->

					    @foreach($zones as $zone)
					    	@if($zone->width>0&&$zone->height>0)
					    		<div class="d-container" style="width:{{$zone->width}}px;height:{{$zone->height+20}}px;">
					    			<span style="width:100%;height:20px;">{{$zone->width}}x{{$zone->height}}px
					    			&nbsp;<a href="#myModalShow-{{$zone->id}}" title="Show" data-toggle="modal"><i class="fa fa-edit"></i></a></span>
					    			{{$zone->zonecode}}
					    		</div>
					    		<!-- Modal Show -->
								<div class="modal fade" id="myModalShow-{{$zone->id}}"
								tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
								aria-hidden="true" style="background:transparent;position:fixed;text-align:left;font-weight:normal;">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-body">
												<div class="row">
													<div class="col-md-12">
														<!-- general form elements -->
														<div class="box">
															<div class="box-header" style="padding-bottom: 0;">
																<h3 class="box-title">Show Zone</h3>
															</div>
															<div class="box-body">
															{{Form::open(array('url'=>'admin/zone-add_zone_code-'.$zone->id))}}
															<div class="form-group">
																{{Form::label('zonename','Zone name')}}
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-flag-o"></i></span>
																	{{Form::text('zonename',Input::old('zonename',$zone->zonename),array('class'=>'form-control','disabled'=>'disabled'))}}
																</div>
																@if($errors->first('zonename'))
																<div class="alert alert-danger alert-dismissable">
																	<i class="fa fa-ban"></i>
																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
																		&times;
																	</button>
																	{{$errors->first('zonename')}}
																</div>
																@endif
															</div>
															<div class="form-group">
																{{Form::label('width','Width')}}
																{{Form::input('number','width',Input::old('width',$zone->width),array('class'=>'form-control','min'=>'0','style'=>'width:100px;display:block !important;','disabled'=>'disabled'))}}
																@if($errors->first('width'))
																<div class="alert alert-danger alert-dismissable">
																	<i class="fa fa-ban"></i>
																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
																		&times;
																	</button>
																	{{$errors->first('width')}}
																</div>
																@endif
															</div>
															<div class="form-group">
																{{Form::label('height','Height')}}
																{{Form::input('number','height',Input::old('height',$zone->height),array('class'=>'form-control','min'=>'0','style'=>'width:100px;display:block !important;','disabled'=>'disabled'))}}
																@if($errors->first('height'))
																<div class="alert alert-danger alert-dismissable">
																	<i class="fa fa-ban"></i>
																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
																		&times;
																	</button>
																	{{$errors->first('height')}}
																</div>
																@endif
															</div>
															<div class="form-group">
																{{Form::label('zonecode','Add zone code')}}
																<textarea class='form-control' name="zonecode" rows="10" placeholder="Get invocation code of zone ...">{{$zone->zonecode}}</textarea>
															</div>
															<button type="submit" class="btn-sm btn-primary"><i class="fa fa-check-circle-o"></i>&nbsp;Save & test</button>
															<button class="slide_close btn-sm btn-default"
															data-dismiss="modal">
																<i class="fa fa-times-circle-o"></i>&nbsp;Close
															</button>
															{{Form::close()}}
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
					    	@else
					    	@endif
					    @endforeach
					</div>
            	</div>
            </div>
        </div>
    </div>
</section>
@stop