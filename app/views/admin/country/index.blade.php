@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1> Country Manager: Countries <!-- <small>advanced tables</small> --></h1>
	<ol class="breadcrumb">
		<li>
			<a href="dashboard"><i class="fa fa-dashboard"></i> Home</a>
		</li>
		<li class="active">
			Countries
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
				<!-- Start form add new -->
				<div id="slide" class="well" style="display:none;width:40%;">
					<div class="row">
						<div class="col-md-12">
							<!-- general form elements -->
							<div class="box box-success">
								<div class="box-header" style="padding-bottom:0;">
									<h3 class="box-title">Add New Country</h3>
								</div><!-- /.box-header
								{{HTML::ul($errors->all())}} -->
								{{Form::open(array('url'=>'admin/country-create'))}}
								<div class="box-body">
									<div class="form-group">
										{{Form::label('country_name','Country Name')}}&nbsp;<font color="#FF0000">*</font>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-rocket"></i></span>
											{{Form::text('country_name',Input::old('country_name'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
										</div>
									</div>
									<button type="submit" class="btn-sm btn-success"><i class="fa fa-check-circle-o"></i>&nbsp;Save & New</button>
									<button class="slide_close btn-sm btn-default">
										<i class="fa fa-times-circle-o"></i>&nbsp;Close
									</button>
								</div>
								{{Form::close()}}
							</div>
						</div>
					</div>
				</div>
				@if($errors->first('country_name'))
				<div class="alert alert-danger alert-dismissable" style="position:absolute;right:9px;top:17px;">
					<i class="fa fa-ban"></i>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
						&times;
					</button>
					{{$errors->first('country_name')}}
				</div>
				@endif
				<!-- End form -->
				<div class="box-body table-responsive">
                	<div class="form-group">
                        <a href="#">
                        <button class="slide_open btn-sm btn-success">
                            <i class="fa fa-plus"></i>&nbsp;Add new country
                        </button></a>
                        <a href="country-recycle" class="recycle">
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
								<th>ID</th>
								<th>Country name</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($countries as $country)
							<tr>
								<td align="center">{{$country['id']}}</td>
								<td><a href="#myModalEdit-{{$country['id']}}" title="{{$country['country_name']}}" data-toggle="modal">{{$country['country_name']}}</a></td>
								<td align="center"><a href="#myModalShow-{{$country['id']}}" title="Show" data-toggle="modal"><button class="btn-sm btn-default">
											<i class="fa fa-search-plus"></i>
										</button></a>
								<a href="#myModalCopy-{{$country['id']}}" title="" data-toggle="modal"> <!-- class="slide_open" --><button class="btn-sm btn-default">
											<i class="fa fa-copy"></i>
										</button></a>
								<a href="#myModalEdit-{{$country['id']}}" title="" data-toggle="modal"><button class="btn-sm btn-default">
											<i class="fa fa-edit"></i>
										</button></a>
								<a href="{{URL::to('admin/country-delete-'.$country['id'])}}" title="Delete"><button class="btn-sm btn-default" onclick="return confirm('Are you sure you want to move this record to the Recycle Bin? \n{{$country['country_name']}} \nDate modified: {{$country['updated_at']}}')"><i class="fa fa-trash-o"></i></button></a></td>
							</tr>
							<!-- Modal Show -->
							<div class="modal fade" id="myModalShow-{{$country['id']}}"
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
															<h3 class="box-title">Show Country</h3>
														</div>
														<div class="box-body">
															{{Form::open(array('url'=>'admin/country-show-'.$country['id']))}}
															<div class="form-group">
																{{Form::label('country_name','Country Name')}}&nbsp;<font color="#FF0000">*</font>
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-rocket"></i></span>
																	{{Form::text('country_name',Input::old('country_name',$country['country_name']),array('class'=>'form-control','disabled'=>true))}}
																</div>
																@if($errors->first('country_name'))
																<div class="alert alert-danger alert-dismissable">
																	<i class="fa fa-ban"></i>
																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
																		&times;
																	</button>
																	{{$errors->first('country_name')}}
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
							<div class="modal fade" id="myModalCopy-{{$country['id']}}"
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
															<h3 class="box-title">Copy Country</h3>
														</div>
														<div class="box-body">
															{{Form::open(array('url'=>'admin/country-copy-'.$country['id']))}}
															<div class="form-group">
																{{Form::label('country_name','Country Name')}}&nbsp;<font color="#FF0000">*</font>
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-rocket"></i></span>
																	{{Form::text('country_name',Input::old('country_name',$country['country_name']),array('class'=>'form-control'))}}
																</div>
																@if($errors->first('country_name'))
																<div class="alert alert-danger alert-dismissable">
																	<i class="fa fa-ban"></i>
																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
																		&times;
																	</button>
																	{{$errors->first('country_name')}}
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
							<div class="modal fade" id="myModalEdit-{{$country['id']}}"
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
															<h3 class="box-title">Edit Country</h3>
														</div>
														<div class="box-body">
															{{Form::open(array('url'=>'admin/country-edit-'.$country['id']))}}
															<div class="form-group">
																{{Form::label('country_name','Country Name')}}&nbsp;<font color="#FF0000">*</font>
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-rocket"></i></span>
																	{{Form::text('country_name',Input::old('country_name',$country['country_name']),array('class'=>'form-control'))}}
																</div>
																@if($errors->first('country_name'))
																<div class="alert alert-danger alert-dismissable">
																	<i class="fa fa-ban"></i>
																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
																		&times;
																	</button>
																	{{$errors->first('country_name')}}
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
								<th>ID</th>
								<th>Country name</th>
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