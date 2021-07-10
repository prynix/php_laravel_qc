@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1> Ad Type Manager: Ad Types <!-- <small>advanced tables</small> --></h1>
	<ol class="breadcrumb">
		<li>
			<a href="dashboard"><i class="fa fa-dashboard"></i> Home</a>
		</li>
		<li class="active">
			Ad Types
		</li>
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
				<div id="slide" class="well" style="display:none;width:40%;">
					<div class="row">
						<div class="col-md-12">
							<!-- general form elements -->
							<div class="box box-success">
								<div class="box-header" style="padding-bottom:0;">
									<h3 class="box-title">Add New Ad Type</h3>
								</div><!-- /.box-header -->
								{{Form::open(array('url'=>'admin/adtype-create'))}}
								<div class="box-body">
									<div class="form-group">
										{{Form::label('title','Title')}}&nbsp;<font color="#FF0000">*</font>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-flag-o"></i></span>
											{{Form::text('title',Input::old('title'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
										</div>
										@if($errors->first('title'))
										<div class="alert alert-danger alert-dismissable">
											<i class="fa fa-ban"></i>
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
												&times;
											</button>
											{{$errors->first('title')}}
										</div>
										@endif
									</div>
									<div class="form-group">
										{{Form::label('width','Width')}}&nbsp;<font color="#FF0000">*</font>
										{{Form::input('number','width',Input::old('width'),array('class'=>'form-control','placeholder'=>'','style'=>'width:20%;display:block !important;'))}}
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
										{{Form::label('height','Height')}}&nbsp;<font color="#FF0000">*</font>
										{{Form::input('number','height',Input::old('height'),array('class'=>'form-control','placeholder'=>'','style'=>'width:20%;display:block !important;'))}}
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
										{{Form::label('standard','Standard')}}
										<ul class="no-padding">
											<li>
												<input type="checkbox" id="ch_effects" name="ch_effects" data-on="Google Adsense" data-off="Customize Ads" checked />	
											</li>
										</ul>
									</div>
								</div>
								<div class="box-footer">
									<button type="submit" class="btn-sm btn-success"><i class="fa fa-check-circle-o"></i>&nbsp;Save & New</button>
								</div>
								{{Form::close()}}
							</div>
						</div>
					</div>
				</div>
				<div class="box-body table-responsive">
                	<div class="form-group">
                        <a href="{{URL::to('admin/adtype-create')}}">
                        <button class="slide_open btn-sm btn-success">
                            <i class="fa fa-plus"></i>&nbsp;Add new ad type
                        </button></a>
                        <a href="adtype-recycle" class="recycle">
                        <button class="btn-sm btn-facebook">
                            <i class="fa fa-crop"></i>&nbsp;Recycle Bin
                        </button></a>
                        <a href="#myModalHelp" title="Help" data-toggle="modal"><button class="btn-sm btn-default btn-help margin-left-5 no-margin-top no-margin-right"><i class="fa fa-anchor"></i>&nbsp;Help</button></a>
                    </div>
                    <div class="modal fade" id="myModalHelp"
							tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
							aria-hidden="true">
								    <div class="modal-dialog">
									   <div class="modal-content">
										  <div class="modal-body">
                                                <div class="well">
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
                                           </div>
                                        </div>
                                    </div>
                                </div>
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Order No</th>
								<th>Title</th>
								<th>Zone Type</th>
                                <th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($adtypes as $adtype)
							<tr>
								<td align="center">{{$adtype->order_no}}</td>
								<td><a href="#myModalEdit-{{$adtype->id}}" title="{{$adtype->title}}" data-toggle="modal">{{$adtype->title}}</a></td>
								<td align="center"> @foreach($zonetypes as $zonetype)
								@if($adtype->zonetype_id==$zonetype->id)
								{{$zonetype->title}}
								@else

								@endif
								@endforeach </td>
                                <td align="center">
                                @if($adtype->id==$first_record->id)
                                                        
                                                    @else
                                                        <a href="{{URL::to('admin/adtype-move_top-Adtype-'.$adtype->id)}}" title="Move top"><button class="btn-sm btn-default"><i class="fa fa-long-arrow-up"></i></button></a>
                                                        <a href="{{URL::to('admin/adtype-move_up-Adtype-'.$adtype->id)}}" title="Move up"><button class="btn-sm btn-default"><i class="fa fa-arrow-up"></i></button></a>
                                                    @endif
                                                    @if($adtype->id==$last_record->id)     
                                                                                     
                                                    @else
                                                        <a href="{{URL::to('admin/adtype-move_down-Adtype-'.$adtype->id)}}" title="Move down"><button class="btn-sm btn-default"><i class="fa fa-arrow-down"></i></button></a>
                                                        <a href="{{URL::to('admin/adtype-move_bottom-Adtype-'.$adtype->id)}}" title="Move bottom"><button class="btn-sm btn-default"><i class="fa fa-long-arrow-down"></i></button></a>
                                                    @endif
                                </td>
								<td align="center"><a href="#myModalShow-{{$adtype->id}}" title="Show" data-toggle="modal"><button class="btn-sm btn-default">
											<i class="fa fa-search-plus"></i>
										</button></a>
								<a href="#myModalCopy-{{$adtype->id}}" title="Copy" data-toggle="modal"><button class="btn-sm btn-default">
											<i class="fa fa-copy"></i>
										</button></a>
								<a href="#myModalEdit-{{$adtype->id}}" title="Edit" data-toggle="modal"><button class="btn-sm btn-default">
											<i class="fa fa-edit"></i>
										</button></a>
								<a href="{{URL::to('admin/adtype-delete-'.$adtype->id)}}" title="Delete"><button class="btn-sm btn-default" onclick="return confirm('Are you sure you want to move this record to the Recycle Bin? \n{{$adtype->title}} \nDate modified: {{$adtype->updated_at}}')"><i class="fa fa-trash-o"></i></button></a></td>
							</tr>
							<!-- Modal Show -->
							<div class="modal fade" id="myModalShow-{{$adtype->id}}"
							tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
							aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-body">
											<div class="row">
												<div class="col-md-12">
													<!-- general form elements -->
													<div class="box">
														<div class="box-header" style="padding-bottom: 0;">
															<h3 class="box-title">Show Ad Type</h3>
														</div>
														<div class="box-body">
															{{Form::open(array('url'=>'admin/adtype-edit-'.$adtype->id))}}
															<div class="form-group">
																{{Form::label('title','Title')}}
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-flag-o"></i></span>
																	{{Form::text('title',Input::old('title',$adtype->title),array('class'=>'form-control','disabled'=>true))}}
																</div>
																@if($errors->first('title'))
																<div class="alert alert-danger alert-dismissable">
																	<i class="fa fa-ban"></i>
																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
																		&times;
																	</button>
																	{{$errors->first('title')}}
																</div>
																@endif
															</div>
															<div class="form-group">
																{{Form::label('width','Width')}}
																{{Form::input('number','width',Input::old('width',$adtype->width),array('class'=>'form-control','min'=>'0','style'=>'width:100px;display:block !important;','disabled'=>true))}}
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
																{{Form::input('number','height',Input::old('height',$adtype->height),array('class'=>'form-control','min'=>'0','style'=>'width:100px;display:block !important;','disabled'=>true))}}
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
							<!-- Modal Copy -->
							<div class="modal fade" id="myModalCopy-{{$adtype->id}}"
							tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
							aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-body">
											<div class="row">
												<div class="col-md-12">
													<!-- general form elements -->
													<div class="box">
														<div class="box-header" style="padding-bottom: 0;">
															<h3 class="box-title">Copy Ad Type</h3>
														</div>
														<div class="box-body">
															{{Form::open(array('url'=>'admin/adtype-copy-'.$adtype->id))}}
															<div class="form-group">
																{{Form::label('title','Title')}}&nbsp;<font color="#FF0000">*</font>
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-flag-o"></i></span>
																	{{Form::text('title',Input::old('title',$adtype->title),array('class'=>'form-control'))}}
																</div>
																@if($errors->first('title'))
																<div class="alert alert-danger alert-dismissable">
																	<i class="fa fa-ban"></i>
																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
																		&times;
																	</button>
																	{{$errors->first('title')}}
																</div>
																@endif
															</div>
															<div class="form-group">
																{{Form::label('width','Width')}}&nbsp;<font color="#FF0000">*</font>
																{{Form::input('number','width',Input::old('width',$adtype->width),array('class'=>'form-control','min'=>'0','style'=>'width:100px;display:block !important;'))}}
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
																{{Form::label('height','Height')}}&nbsp;<font color="#FF0000">*</font>
																{{Form::input('number','height',Input::old('height',$adtype->height),array('class'=>'form-control','min'=>'0','style'=>'width:100px;display:block !important;'))}}
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
															<button type="submit" class="btn-sm btn-success"><i class="fa fa-check-circle-o"></i>&nbsp;Save as Copy</button>
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
							<!-- Modal Edit -->
							<div class="modal fade" id="myModalEdit-{{$adtype->id}}"
							tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
							aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-body">
											<div class="row">
												<div class="col-md-12">
													<!-- general form elements -->
													<div class="box">
														<div class="box-header" style="padding-bottom: 0;">
															<h3 class="box-title">Edit Ad Type</h3>
														</div>
														<div class="box-body">
															{{Form::open(array('url'=>'admin/adtype-edit-'.$adtype->id))}}
															<div class="form-group">
																{{Form::label('title','Title')}}&nbsp;<font color="#FF0000">*</font>
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-flag-o"></i></span>
																	{{Form::text('title',Input::old('title',$adtype->title),array('class'=>'form-control'))}}
																</div>
																@if($errors->first('title'))
																<div class="alert alert-danger alert-dismissable">
																	<i class="fa fa-ban"></i>
																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
																		&times;
																	</button>
																	{{$errors->first('title')}}
																</div>
																@endif
															</div>
															<div class="form-group">
																{{Form::label('width','Width')}}&nbsp;<font color="#FF0000">*</font>
																{{Form::input('number','width',Input::old('width',$adtype->width),array('class'=>'form-control','min'=>'0','style'=>'width:100px;display:block !important;'))}}
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
																{{Form::label('height','Height')}}&nbsp;<font color="#FF0000">*</font>
																{{Form::input('number','height',Input::old('height',$adtype->height),array('class'=>'form-control','min'=>'0','style'=>'width:100px;display:block !important;'))}}
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
															<button type="submit" class="btn-sm btn-success"><i class="fa fa-check-circle-o"></i>&nbsp;Save</button>
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
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>Order No</th>
								<th>Title</th>
								<th>Zone Type</th>
                                <th></th>
								<th></th>
							</tr>
						</tfoot>
					</table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
</section><!-- /.content -->
@stop