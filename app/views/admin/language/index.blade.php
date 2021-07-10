@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1> Language Manager: Languages <!-- <small>advanced tables</small> --></h1>
	<ol class="breadcrumb">
		<li>
			<a href="dashboard"><i class="fa fa-dashboard"></i> Home</a>
		</li>
		<li class="active">
			Languages
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
									<h3 class="box-title">Add New Language</h3>
								</div><!-- /.box-header
								{{HTML::ul($errors->all())}} -->
								{{Form::open(array('url'=>'admin/language-create'))}}
								<div class="box-body">
									<div class="form-group">
										{{Form::label('language_name','Language Name')}}&nbsp;<font color="#FF0000">*</font>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-font"></i></span>
											{{Form::text('language_name',Input::old('language_name'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
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
				@if($errors->first('language_name'))
				<div class="alert alert-danger alert-dismissable" style="position:absolute;right:9px;top:17px;">
					<i class="fa fa-ban"></i>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
						&times;
					</button>
					{{$errors->first('language_name')}}
				</div>
				@endif
				<!-- End form -->
				<div class="box-body table-responsive">
                	<div class="form-group">
                        <a href="#">
                        <button class="slide_open btn-sm btn-success">
                            <i class="fa fa-plus"></i>&nbsp;Add new language
                        </button></a>
                        <a href="language-recycle" class="recycle">
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
								<th>Language name</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($languages as $language)
							<tr>
								<td align="center">{{$language->id}}</td>
								<td><a href="#myModalEdit-{{$language->id}}" title="{{$language->language_name}}" data-toggle="modal">{{$language->language_name}}</a></td>
								<td align="center"><a href="#myModalShow-{{$language->id}}" title="Show" data-toggle="modal"><button class="btn-sm btn-default">
											<i class="fa fa-search-plus"></i>
										</button></a>
								<a href="#myModalCopy-{{$language->id}}" title="Copy" data-toggle="modal"> <!-- class="slide_open" --><button class="btn-sm btn-default">
											<i class="fa fa-copy"></i>
										</button></a>
								<a href="#myModalEdit-{{$language->id}}" title="Edit" data-toggle="modal"><button class="btn-sm btn-default">
											<i class="fa fa-edit"></i>
										</button></a>
								<a href="{{URL::to('admin/language-delete-'.$language->id)}}" title="Delete"><button class="btn-sm btn-default" onclick="return confirm('Are you sure you want to move this record to the Recycle Bin? \n{{$language->language_name}} \nDate modified: {{$language->updated_at}}')"><i class="fa fa-trash-o"></i></button></a></td>
							</tr>
							<!-- Modal Show -->
							<div class="modal fade" id="myModalShow-{{$language->id}}"
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
															<h3 class="box-title">Show Language</h3>
														</div>
														<div class="box-body">
															{{Form::open(array('url'=>'admin/language-edit-'.$language->id))}}
															<div class="form-group">
																{{Form::label('language_name','Language Name')}}
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-font"></i></span>
																	{{Form::text('language_name',Input::old('language_name',$language->language_name),array('class'=>'form-control','disabled'=>true))}}
																</div>
																@if($errors->first('language_name'))
																<div class="alert alert-danger alert-dismissable">
																	<i class="fa fa-ban"></i>
																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
																		&times;
																	</button>
																	{{$errors->first('language_name')}}
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
							<div class="modal fade" id="myModalCopy-{{$language->id}}"
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
															<h3 class="box-title">Copy Language</h3>
														</div>
														<div class="box-body">
															{{Form::open(array('url'=>'admin/language-copy-'.$language->id))}}
															<div class="form-group">
																{{Form::label('language_name','Language Name')}}&nbsp;<font color="#FF0000">*</font>
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-font"></i></span>
																	{{Form::text('language_name',Input::old('language_name',$language->language_name),array('class'=>'form-control'))}}
																</div>
																@if($errors->first('language_name'))
																<div class="alert alert-danger alert-dismissable">
																	<i class="fa fa-ban"></i>
																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
																		&times;
																	</button>
																	{{$errors->first('language_name')}}
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
							<div class="modal fade" id="myModalEdit-{{$language->id}}"
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
															<h3 class="box-title">Edit Language</h3>
														</div>
														<div class="box-body">
															{{Form::open(array('url'=>'admin/language-edit-'.$language->id))}}
															<div class="form-group">
																{{Form::label('language_name','Language Name')}}&nbsp;<font color="#FF0000">*</font>
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-font"></i></span>
																	{{Form::text('language_name',Input::old('language_name',$language->language_name),array('class'=>'form-control'))}}
																</div>
																@if($errors->first('language_name'))
																<div class="alert alert-danger alert-dismissable">
																	<i class="fa fa-ban"></i>
																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
																		&times;
																	</button>
																	{{$errors->first('language_name')}}
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
								<th>Language name</th>
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