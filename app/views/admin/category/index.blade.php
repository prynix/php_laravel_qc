@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1> Category Manager: Categories <!-- <small>advanced tables</small> --></h1>
	<ol class="breadcrumb">
		<li>
			<a href="dashboard"><i class="fa fa-dashboard"></i> Home</a>
		</li>
		<li class="active">
			Categories
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
									<h3 class="box-title">Add New Category</h3>
								</div><!-- /.box-header -->
								{{Form::open(array('url'=>'admin/category-create'))}}
								<div class="box-body">
									<div class="form-group">
										{{Form::label('category_name','Category Name')}}&nbsp;<font color="#FF0000">*</font>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-outdent"></i></span>
											{{Form::text('category_name',Input::old('category_name'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
										</div>
										@if($errors->first('category_name'))
										<div class="alert alert-danger alert-dismissable">
											<i class="fa fa-ban"></i>
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
												&times;
											</button>
											{{$errors->first('category_name')}}
										</div>
										@endif
									</div>
									<div class="form-group">
										{{Form::label('parent_id','Parent Node')}}&nbsp;<font color="#FF0000">*</font>
										<select data-placeholder="-- Select --" class="chosen-select" tabindex="1" name="parent_id">
											<option value="0">-- Other --</option>
											@foreach($cat_parent as $category)
											<option value="{{$category->id}}">{{ $category->category_name }}</option>
											@foreach($category['children'] as $category)

											<option value="{{$category->id}}">--|&nbsp;{{ $category->category_name }}</option>

											@endforeach

											@endforeach
										</select>
									</div>
									{{Form::submit('Save & New',array('class'=>'btn btn-success'))}}
								</div>
								{{Form::close()}}
							</div>
						</div>
					</div>
				</div>
				<div class="box-body table-responsive">
                	<div class="form-group">
                        <a href="{{URL::to('admin/category-create')}}">
                        <button class="btn-sm btn-success">
                            <i class="fa fa-plus"></i>&nbsp;Add new category
                        </button></a>
                        <a href="category-recycle" class="recycle">
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
					<table id="example4" class="table table-bordered table-striped">
						<thead>
							<tr>
                            	<th>ID</th>
								<th>Category name</th>
                                <th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<!-- <select>
							@foreach($categories as $category)
							<option>{{ $category->category_name }} - {{ $category->id }}</option>
							@foreach($category['children'] as $category)

							<option>--|&nbsp;{{ $category->category_name }} - {{ $category->id }}</option>

							@endforeach

							@endforeach
							</select> -->
							@foreach($cat_parent as $cat)
								@if($cat->parent_id==0)
								<tr>
	                            	<td align="center">{{$cat->id}}</td>
									<td><a href="{{URL::to('admin/category-edit-'.$cat->id)}}" title="{{ $cat->category_name }}" data-toggle="modal"> @if($cat->parent_id!=0)
									|--&nbsp;{{ $cat->category_name }}
									@else
									{{ $cat->category_name }}
									@endif </a></td>
                                    <td align="center">
                                    	@if($cat->status==1)
															<span class="label label-success"><i class="fa fa-check-circle"></i></span>
														@else
															<span class="label label-danger"><i class="fa fa-times-circle-o"></i></span>
														@endif
                                    </td>
									<td align="center"><a href="{{URL::to('admin/category-show-'.$cat->id)}}" title="Show" data-toggle="modal"><button class="btn-sm btn-default">
											<i class="fa fa-search-plus"></i>
										</button></a>
									<a href="{{URL::to('admin/category-copy-'.$cat->id)}}" title="Copy" data-toggle="modal"><button class="btn-sm btn-default">
											<i class="fa fa-copy"></i>
										</button></a>
									<a href="{{URL::to('admin/category-edit-'.$cat->id)}}" title="Edit" data-toggle="modal"><button class="btn-sm btn-default">
											<i class="fa fa-edit"></i>
										</button></a>
									<a href="{{URL::to('admin/category-delete-'.$cat->id)}}" title="Delete"><button class="btn-sm btn-default" onclick="return confirm('Are you sure you want to move this record to the Recycle Bin? \n{{$cat->category_name}} \nDate mofified: {{$cat->updated_at}}')"><i class="fa fa-trash-o"></i>
										</button></a></td>
								</tr>
								@foreach($categories as $category)  
									@if($category->parent_id==$cat->id)
									<tr>
		                            	<td align="center">{{$category->id}}</td>
										<td><a href="{{URL::to('admin/category-edit-'.$category->id)}}" title="{{ $category->category_name }}" data-toggle="modal"> @if($category->parent_id!=0)
										|--&nbsp;{{ $category->category_name }}
										@else
										{{ $category->category_name }}
										@endif </a></td>
                                        <td align="center">
                                        	@if($category->status==1)
															<span class="label label-success"><i class="fa fa-check-circle"></i></span>
														@else
															<span class="label label-danger"><i class="fa fa-times-circle-o"></i></span>
														@endif
                                        </td>
										<td align="center"><a href="{{URL::to('admin/category-show-'.$category->id)}}" title="Show" data-toggle="modal"><button class="btn-sm btn-default">
											<i class="fa fa-search-plus"></i>
										</button></a>
										<a href="{{URL::to('admin/category-copy-'.$category->id)}}" title="Copy" data-toggle="modal"><button class="btn-sm btn-default">
											<i class="fa fa-copy"></i>
										</button></a>
										<a href="{{URL::to('admin/category-edit-'.$category->id)}}" title="Edit" data-toggle="modal"><button class="btn-sm btn-default">
											<i class="fa fa-edit"></i>
										</button></a>
										<a href="{{URL::to('admin/category-delete-'.$category->id)}}" title="Delete"><button class="btn-sm btn-default" onclick="return confirm('Are you sure you want to move this record to the Recycle Bin? \n{{$category->category_name}} \nDate mofified: {{$category->updated_at}}')"><i class="fa fa-trash-o"></i></button></a></td>
									</tr>
									@endif
								@endforeach
								@endif
							<!--
							@foreach($category['children'] as $child)
							<tr>
							<td align="center">{{$child->sort_order}}</td>
							<td>
							<a href="{{URL::to('admin/-'.$category->id)}}" title="">
							|--&nbsp;{{ $child->category_name }}
							</a>
							</td>
							<td align="center"><a href="{{URL::to('admin/category-show-'.$child->id)}}" title="">{{HTML::image('assets/img/icon/view.png','View',array('title'=>'View'))}}</a></td>
							<td align="center"><a href="{{URL::to('admin/category-copy-'.$child->id)}}" title="">{{HTML::image('assets/img/icon/copy.png','Copy',array('title'=>'Copy'))}}</a></td>
							<td align="center"><a href="{{URL::to('admin/category-edit-'.$child->id)}}" title="">{{HTML::image('assets/img/icon/icon_edit.png','Edit',array('title'=>'Edit'))}}</a></td>
							<td align="center"><a href="{{URL::to('admin/category-delete-'.$child->id)}}" title="" onclick="return confirm('Are you sure you want to permanently delete this record? \n{{$child->category_name}} \nDate modified: {{$child->updated_at}}')">{{HTML::image('assets/img/icon/delete.png','Delete',array('title'=>'Delete'))}}</a></td>
							</tr>
							@endforeach
							-->
							<!-- Modal Show -->
							<div class="modal fade" id="myModalShow-{{$category->id}}"
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
															<h3 class="box-title">Show Category</h3>
														</div>
														<div class="box-body">
															{{Form::open(array('url'=>'admin/category-show-'.$category->id))}}
															<div class="form-group">
																{{Form::label('category_name','Category Name')}}&nbsp;<font color="#FF0000">*</font>
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-outdent"></i></span>
																	{{Form::text('category_name',Input::old('category_name',$category->category_name),array('class'=>'form-control','disabled'=>true))}}
																</div>
																@if($errors->first('category_name'))
																<div class="alert alert-danger alert-dismissable">
																	<i class="fa fa-ban"></i>
																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
																		&times;
																	</button>
																	{{$errors->first('category_name')}}
																</div>
																@endif
															</div>
															<div class="form-group">
																{{Form::label('parent_id','Parent Node')}}&nbsp;<font color="#FF0000">*</font>
																<select data-placeholder="-- Select --" class="chosen-select" tabindex="1" name="parent_id" disabled="true">
																	<option value="0">-- Main --</option>
																	<!-- Menu da cap 1 cha nhieu con -->
																	@foreach($cat_parent as $cat)
																	@if($category->parent_id==$cat->id)
																	<option value="{{$cat->id}}" selected>{{ $cat->category_name }}</option>
																	@else
																	<option value="{{$cat->id}}">{{ $cat->category_name }}</option>
																	@endif
																	@foreach($cat['children'] as $cat)

																	<option value="{{$cat->id}}">--|&nbsp;{{ $cat->category_name }}</option>

																	@endforeach

																	@endforeach
																</select>
															</div>
															<button class="slide_close btn btn-default"
															data-dismiss="modal">
																Close
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
							<div class="modal fade" id="myModalCopy-{{$category->id}}"
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
															<h3 class="box-title">Copy Category</h3>
														</div>
														<div class="box-body">
															{{Form::open(array('url'=>'admin/category-copy-'.$category->id))}}
															<div class="form-group">
																{{Form::label('category_name','Category Name')}}&nbsp;<font color="#FF0000">*</font>
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-outdent"></i></span>
																	{{Form::text('category_name',Input::old('category_name',$category->category_name),array('class'=>'form-control'))}}
																</div>
																@if($errors->first('category_name'))
																<div class="alert alert-danger alert-dismissable">
																	<i class="fa fa-ban"></i>
																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
																		&times;
																	</button>
																	{{$errors->first('category_name')}}
																</div>
																@endif
															</div>
															<div class="form-group">
																{{Form::label('parent_id','Parent Node')}}&nbsp;<font color="#FF0000">*</font>
																<select data-placeholder="-- Select --" class="chosen-select" tabindex="1" name="parent_id">
																	<option value="0">-- Main --</option>
																	<!-- Menu da cap 1 cha nhieu con -->
																	@foreach($cat_parent as $cat)
																	@if($category->parent_id==$cat->id)
																	<option value="{{$cat->id}}" selected>{{ $cat->category_name }}</option>
																	@else
																	<option value="{{$cat->id}}">{{ $cat->category_name }}</option>
																	@endif
																	@foreach($cat['children'] as $cat)

																	<option value="{{$cat->id}}">--|&nbsp;{{ $cat->category_name }}</option>

																	@endforeach

																	@endforeach
																</select>
															</div>
															{{Form::submit('Save as Copy',array('class'=>'btn btn-success'))}}
															<button class="slide_close btn btn-default"
															data-dismiss="modal">
																Close
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
							<div class="modal fade" id="myModalEdit-{{$category->id}}"
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
															<h3 class="box-title">Edit Category</h3>
														</div>
														<div class="box-body">
															{{Form::open(array('url'=>'admin/category-edit-'.$category->id))}}
															<div class="form-group">
																{{Form::label('category_name','Category Name')}}&nbsp;<font color="#FF0000">*</font>
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-outdent"></i></span>
																	{{Form::text('category_name',Input::old('category_name',$category->category_name),array('class'=>'form-control'))}}
																</div>
																@if($errors->first('category_name'))
																<div class="alert alert-danger alert-dismissable">
																	<i class="fa fa-ban"></i>
																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
																		&times;
																	</button>
																	{{$errors->first('category_name')}}
																</div>
																@endif
															</div>
															<div class="form-group">
																{{Form::label('parent_id','Parent Node')}}&nbsp;<font color="#FF0000">*</font>
																<select data-placeholder="-- Select --" class="chosen-select" tabindex="1" name="parent_id">
																	<option value="0">-- Main --</option>
																	<!-- Menu da cap 1 cha nhieu con -->
																	@foreach($cat_parent as $cat)
																	@if($category->parent_id==$cat->id)
																	<option value="{{$cat->id}}" selected>{{ $cat->category_name }}</option>
																	@else
																	<option value="{{$cat->id}}">{{ $cat->category_name }}</option>
																	@endif
																	@foreach($cat['children'] as $cat)

																	<option value="{{$cat->id}}">--|&nbsp;{{ $cat->category_name }}</option>

																	@endforeach

																	@endforeach
																</select>
															</div>
															{{Form::submit('Save',array('class'=>'btn btn-success'))}}
															<button class="slide_close btn btn-default"
															data-dismiss="modal">
																Close
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
								<th>Category name</th>
                                <th>Status</th>
								<th>Actions</th>
							</tr>
						</tfoot>
					</table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
</section><!-- /.content -->
@stop