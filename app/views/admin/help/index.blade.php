@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1> Ad Help Manager<!-- <small>Preview</small> --></h1>
	<ol class="breadcrumb">
		<li>
			<a href="dashboard"><i class="fa fa-dashboard"></i> Home</a>
		</li>
		<li class="active">
			Ad Help
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
		<!-- left column -->
		<div class="col-md-12">
			<!-- general form elements -->
			<div class="box box-success">
				<div class="box-body">
					<!--Horizontal Tab-->
					<div id="horizontalTab">
						<ul>
							<li>
								<a href="#tab-1" style="border-left: none;">Uri Info</a>
							</li>
							<li>
								<a href="#tab-2">Content Helper</a>
							</li>
						</ul>
						<div id="tab-1">
							<div class="form-group">
								<a href="#myModalCreate" title="Create" data-toggle="modal">
								<button class="btn-sm btn-success">
									<i class="fa fa-plus"></i>&nbsp;Add new uri
								</button></a>
								<a href="uri-recycle" class="recycle"><button class="btn-sm btn-facebook"><i class="fa fa-crop"></i>&nbsp;Recycle Bin</button></a>
							</div>
							<!-- Start form add new -->
							<!-- Modal Show -->
							<div class="modal fade" id="myModalCreate"
							tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
							aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-body">
											<div class="row">
												<div class="col-md-12">
													<!-- general form elements -->
													<div class="box box-success">
														<div class="box-header no-padding-bottom">
															<h3 class="box-title">Add New Uri</h3>
														</div><!-- /.box-header
														{{HTML::ul($errors->all())}} -->
														{{Form::open(array('url'=>'admin/uri-create'))}}
														<div class="box-body">
															<div class="form-group">
																{{Form::label('uri_segment','Uri Segment')}}&nbsp;<font color="#FF0000">*</font>
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-external-link"></i></span>
																	{{Form::text('uri_segment',Input::old('uri_segment'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
																</div>
															</div>
															{{Form::submit('Save & New',array('class'=>'btn-sm btn-success'))}}
															{{Form::button('Close',array('class'=>'slide_close btn-sm btn-default btn-close','data-dismiss'=>'modal'))}}
														</div>
														{{Form::close()}}
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
							<table id="example2"
							class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>ID</th>
										<th align="left">Uri Segment</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach($uri as $uri)
									<tr>
										<td align="center">{{$uri->id}}</td>
										<td>{{$uri->uri_segment}}</td>
										<td align="center"><a href="#myModalShow-{{$uri->id}}" title="Show" data-toggle="modal">
										<button class="btn-sm btn-default">
											<i class="fa fa-search-plus"></i>
										</button></a><a href="#myModalCopy-{{$uri->id}}" title="Copy" data-toggle="modal">
										<button class="btn-sm btn-default">
											<i class="fa fa-copy"></i>
										</button></a><a href="#myModalEdit-{{$uri->id}}" title="Edit" data-toggle="modal">
										<button class="btn-sm btn-default">
											<i class="fa fa-edit"></i>
										</button></a><a href="{{URL::to('admin/uri-delete-'.$uri->id)}}" title="Delete">
										<button class="btn-sm btn-default" onclick="return confirm('Are you sure you want to move this record to the Recycle Bin? \n{{$uri->uri_segment}} \nDate modified: {{$uri->updated_at}}')">
											<i class="fa fa-trash-o"></i>
										</button></a></td>
									</tr>
									<!-- Modal Show -->
									<div class="modal fade" id="myModalShow-{{$uri->id}}"
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
																	<h3 class="box-title">Show Uri</h3>
																</div>
																<div class="box-body">
																	{{Form::open(array('url'=>'admin/uri-show-'.$uri->id))}}
																	<div class="form-group">
																		{{Form::label('uri_segment','Uri Segment')}}&nbsp;<font color="#FF0000">*</font>
																		<div class="input-group">
																			<span class="input-group-addon"><i class="fa fa-external-link"></i></span>
																			{{Form::text('uri_segment',Input::old('uri_segment',$uri->uri_segment),array('class'=>'form-control','placeholder'=>'Enter ...','disabled'=>'disabled'))}}
																		</div>
																	</div>
																	{{Form::button('Close',array('class'=>'slide_close btn-sm btn-default btn-close no-margin-left','data-dismiss'=>'modal'))}}
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
									<div class="modal fade" id="myModalCopy-{{$uri->id}}"
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
																	<h3 class="box-title">Copy Uri</h3>
																</div>
																<div class="box-body">
																	{{Form::open(array('url'=>'admin/uri-copy-'.$uri->id))}}
																	<div class="form-group">
																		{{Form::label('uri_segment','Uri Segment')}}&nbsp;<font color="#FF0000">*</font>
																		<div class="input-group">
																			<span class="input-group-addon"><i class="fa fa-external-link"></i></span>
																			{{Form::text('uri_segment',Input::old('uri_segment',$uri->uri_segment),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
																		</div>
																	</div>
																	{{Form::submit('Save as Copy',array('class'=>'btn-sm btn-success'))}}
																	{{Form::button('Close',array('class'=>'slide_close btn-sm btn-default btn-close no-margin-left','data-dismiss'=>'modal'))}}
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
									<div class="modal fade" id="myModalEdit-{{$uri->id}}"
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
																	<h3 class="box-title">Edit Uri</h3>
																</div>
																<div class="box-body">
																	{{Form::open(array('url'=>'admin/uri-edit-'.$uri->id))}}
																	<div class="form-group">
																		{{Form::label('uri_segment','Uri Segment')}}&nbsp;<font color="#FF0000">*</font>
																		<div class="input-group">
																			<span class="input-group-addon"><i class="fa fa-external-link"></i></span>
																			{{Form::text('uri_segment',Input::old('uri_segment',$uri->uri_segment),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
																		</div>
																	</div>
																	{{Form::submit('Save',array('class'=>'btn-sm btn-success'))}}
																	{{Form::button('Close',array('class'=>'slide_close btn-sm btn-default btn-close no-margin-left','data-dismiss'=>'modal'))}}
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
										<th align="left">Uri Segment</th>
										<th>Actions</th>
									</tr>
								</tfoot>
							</table>
						</div>
						<div id="tab-2">
							<div class="form-group">
								<button class="slide_open btn-sm btn-success">
									<i class="fa fa-plus"></i>&nbsp;Add new content
								</button>
								<a href="helper-recycle" class="recycle"><button class="btn-sm btn-facebook"><i class="fa fa-crop"></i>&nbsp;Recycle Bin</button></a>
							</div>
							<!-- Start form add new -->
							<div id="slide" class="well" style="display:none;width:50%;">
								<div class="row">
									<div class="col-md-12">
										<!-- general form elements -->
										<div class="box box-success">
											<div class="box-header no-padding-bottom">
												<h3 class="box-title">Add New Content</h3>
											</div><!-- /.box-header
											{{HTML::ul($errors->all())}} -->
											{{Form::open(array('url'=>'admin/helper-create'))}}
											<div class="box-body">
												<div class="form-group">
													{{Form::label('uri_id','Uri Segment')}}
													<select
													data-placeholder="-- Select --" class="chosen-select"
													tabindex="1" name="uri_id[]" multiple>
														@foreach($url as $u)

														<option value="{{$u->id}}">{{ $u->uri_segment }}</option>

														@endforeach
													</select>
												</div>
												<div class="form-group">
													{{Form::label('content_helper_en','Content (English Language)')}}
													{{Form::textarea('content_helper_en',Input::old('content_helper_en'),array('class'=>'form-control ckeditor','rows'=>6,'style'=>'display:none !important;'))}}
												</div>
                                                <div class="form-group">
													{{Form::label('content_helper_vi','Content (Vietnamese Language)')}}
													{{Form::textarea('content_helper_vi',Input::old('content_helper_vi'),array('class'=>'form-control ckeditor','rows'=>6,'style'=>'display:none !important;'))}}
												</div>
												{{Form::submit('Save & New',array('class'=>'btn-sm btn-success'))}}
												{{Form::button('Close',array('class'=>'slide_close btn-sm btn-default btn-close'))}}
											</div>
											{{Form::close()}}
										</div>
									</div>
								</div>
							</div>
							<table id="example1"
							class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>ID</th>
										<th>Tags</th>
										<th>Content (en)</th>
                                        <th>Content (vi)</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach($uri_id as $uid)
									<tr>
										<td align="center">{{$uid->id}}</td>
										<td>
											@foreach($ur as $ul)
												@if($ul->helper_id==$uid->id)
													<span class="label bg-navy">{{$ul->uri_segment}}</span>
												@else
												@endif
											@endforeach
										</td>
										<td align="center">{{strlen($uid->content_helper_en)}}&nbsp;characters</td>
                                        <td align="center">{{strlen($uid->content_helper_vi)}}&nbsp;characters</td>
										<td align="center"><a href="#myModalShowHelper-{{$uid->id}}" title="Show" data-toggle="modal">
										<button class="btn-sm btn-default">
											<i class="fa fa-search-plus"></i>
										</button></a><a href="#myModalCopyHelper-{{$uid->id}}" title="Copy" data-toggle="modal">
										<button class="btn-sm btn-default">
											<i class="fa fa-copy"></i>
										</button></a><a href="#myModalEditHelper-{{$uid->id}}" title="Edit" data-toggle="modal">
										<button class="btn-sm btn-default">
											<i class="fa fa-edit"></i>
										</button></a><a href="{{URL::to('admin/helper-delete-'.$uid->id)}}" title="Delete">
										<button class="btn-sm btn-default" onclick="return confirm('Are you sure you want to move this record to the Recycle Bin? \nDate modified: {{$uid->updated_at}}')">
											<i class="fa fa-trash-o"></i>
										</button></a></td>
									</tr>
									<!-- Modal Show -->
									<div class="modal fade" id="myModalShowHelper-{{$uid->id}}"
									tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
									aria-hidden="true">
										<div class="modal-dialog" style="width:50%;height:100%;overflow-y:scroll;">
											<div class="modal-content">
												<div class="modal-body">
													<div class="row">
														<div class="col-md-12">
															<!-- general form elements -->
															<div class="box">
																<div class="box-header" style="padding-bottom: 0;">
																	<h3 class="box-title">Show Content Helper</h3>
																</div>
																{{Form::open(array('url'=>'admin/helper-create'))}}
											<div class="box-body">
												<div class="form-group">
													{{Form::label('uri_id','Uri Segment')}}<br/>
													@foreach($ur as $ul)
												@if($ul->helper_id==$uid->id)
													<span class="label bg-maroon">{{$ul->uri_segment}}</span>
												@else
												@endif
											@endforeach
												</div>
												<div class="form-group">
													{{Form::label('content_helper_en','Content (English Language)')}}
													{{Form::textarea('content_helper_en',Input::old('content_helper_en',$uid->content_helper_en),array('class'=>'form-control ckeditor','rows'=>6,'style'=>'display:none !important;','disabled'=>'disabled'))}}
												</div>
                                                <div class="form-group">
													{{Form::label('content_helper_vi','Content (Vietnamese Language)')}}
													{{Form::textarea('content_helper_vi',Input::old('content_helper_vi',$uid->content_helper_vi),array('class'=>'form-control ckeditor','rows'=>6,'style'=>'display:none !important;','disabled'=>'disabled'))}}
												</div>
												{{Form::button('Close',array('class'=>'slide_close btn-sm btn-default btn-close no-margin-left','data-dismiss'=>'modal'))}}
											</div>
											{{Form::close()}}
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
									<div class="modal fade" id="myModalCopyHelper-{{$uid->id}}"
									tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
									aria-hidden="true">
										<div class="modal-dialog" style="width:50%;height:100%;overflow-y:scroll;">
											<div class="modal-content">
												<div class="modal-body">
													<div class="row">
														<div class="col-md-12">
															<!-- general form elements -->
															<div class="box">
																<div class="box-header" style="padding-bottom: 0;">
																	<h3 class="box-title">Copy Content Helper</h3>
																</div>
																{{Form::open(array('url'=>'admin/helper-copy-'.$uid->id))}}
											<div class="box-body">
												<div class="form-group">
													{{Form::label('uri_id','Uri Segment')}}
													<select
													data-placeholder="-- Select --" class="chosen-select"
													tabindex="1" name="uri_id[]" multiple>
														@foreach($url as $u)

														<option value="{{$u->id}}">{{ $u->uri_segment }}</option>

														@endforeach
													</select>
												</div>
												<div class="form-group">
													{{Form::label('content_helper_en','Content (English Language)')}}
													{{Form::textarea('content_helper_en',Input::old('content_helper_en',$uid->content_helper_en),array('class'=>'form-control ckeditor','rows'=>6,'style'=>'display:none !important;'))}}
												</div>
                                                <div class="form-group">
													{{Form::label('content_helper_vi','Content (Vietnamese Language)')}}
													{{Form::textarea('content_helper_vi',Input::old('content_helper_vi',$uid->content_helper_vi),array('class'=>'form-control ckeditor','rows'=>6,'style'=>'display:none !important;'))}}
												</div>
												{{Form::submit('Save as Copy',array('class'=>'btn-sm btn-success'))}}
												{{Form::button('Close',array('class'=>'slide_close btn-sm btn-default btn-close no-margin-left','data-dismiss'=>'modal'))}}
											</div>
											{{Form::close()}}
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
									<div class="modal fade" id="myModalEditHelper-{{$uid->id}}"
									tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
									aria-hidden="true">
										<div class="modal-dialog" style="width:50%;height:100%;overflow-y:scroll;">
											<div class="modal-content">
												<div class="modal-body">
													<div class="row">
														<div class="col-md-12">
															<!-- general form elements -->
															<div class="box">
																<div class="box-header" style="padding-bottom: 0;">
																	<h3 class="box-title">Edit Content Helper</h3>
																</div>
																{{Form::open(array('url'=>'admin/helper-edit-'.$uid->id))}}
											<div class="box-body">
												<div class="form-group">
													{{Form::label('uri_id','Uri Segment')}}
													<select
													data-placeholder="-- Select --" class="chosen-select"
													tabindex="1" name="uri_id[]" multiple>
														@foreach($ur as $u)
															@if($u->helper_id==$uid->id)
																<option value="{{$u->id}}" selected="selected">{{ $u->uri_segment }}</option>
															@else
																
															@endif
														@endforeach
														<!--@foreach($url as $u)
															@if($u->helper_id==$uid->id)
																<option value="{{$u->id}}" selected="selected">{{ $u->uri_segment }}</option>
															@else
																<option value="{{$u->id}}">{{ $u->uri_segment }}</option>
															@endif
														@endforeach-->
													</select>
												</div>
												<div class="form-group">
													{{Form::label('content_helper_en','Content (English Language)')}}
													{{Form::textarea('content_helper_en',Input::old('content_helper_en',$uid->content_helper_en),array('class'=>'form-control ckeditor','rows'=>6,'style'=>'display:none !important;'))}}
												</div>
                                                <div class="form-group">
													{{Form::label('content_helper_vi','Content (Vietnamese Language)')}}
													{{Form::textarea('content_helper_vi',Input::old('content_helper_vi',$uid->content_helper_vi),array('class'=>'form-control ckeditor','rows'=>6,'style'=>'display:none !important;'))}}
												</div>
												{{Form::submit('Save',array('class'=>'btn-sm btn-success'))}}
												{{Form::button('Close',array('class'=>'slide_close btn-sm btn-default btn-close no-margin-left','data-dismiss'=>'modal'))}}
											</div>
											{{Form::close()}}
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
										<th>Tags</th>
										<th>Content (en)</th>
                                        <th>Content (vi)</th>
										<th>Actions</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
</section><!-- /.content -->
@stop