@extends('layout.main') @section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Website Manager: Websites
		<!-- <small>advanced tables</small> -->
	</h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="website"> Websites</a></li>
		<li class="active">List of Topics</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">List of Topics</h3>
				</div>
				<!-- /.box-header -->
				<!-- <a href="website-topic_recycle" style="display:inline-block;margin-left:10px;"><button class="btn btn-bitbucket">Recycle Bin</button></a> -->
				<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th align="left">Feed name</th>
								<th>Status</th>
								<th>Link</th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($topics as $topic)
							<tr>
								<td align="center">{{$topic->id}}</td>
								<td>{{$topic->feed_name}} &nbsp; <?php $count=0; ?>
									@foreach($number_adbanners as $number_adbanner)
									@if($number_adbanner->topic_id==$topic->id) <?php $count++; ?>
									@endif @endforeach <?php echo '('.$count.')'; ?>
								</td>
								<td align="center">
									<p class="field switch" style="display:inherit;">
										@if($topic->status==1) 
											<label for="radio1" class="cb-enable selected radioButtonEnableTopic" id="{{$topic->id}}"><span>Enable</span></label>
											<label for="radio2" class="cb-disable radioButtonDisableTopic" id="{{$topic->id}}"><span>Disable</span></label>
										@else 
											<label for="radio1" class="cb-enable radioButtonEnableTopic" id="{{$topic->id}}"><span>Enable</span></label>
											<label for="radio2" class="cb-disable selected radioButtonDisableTopic" id="{{$topic->id}}"><span>Disable</span></label>
										@endif
									</p>
								</td>
								<td align="center"><a href="{{$topic->feed_address}}"
									target="_blank">{{HTML::image('assets/img/icon/link-external-20.png','Link',array('title'=>'Link'))}}</a>
								</td>
								<td align="center"><a href="rss-banner-{{$website_id}}-{{$topic->id}}">{{HTML::image('assets/img/icon/share-128.png','Link Ad Banner',array('title'=>'Link Ad Banner','width'=>'20px'))}}</a>
								</td>
								<td align="center"><a href="#myModal-{{$topic->id}}" title=""
									data-toggle="modal">{{HTML::image('assets/img/icon/icon_edit.png','Edit',array('title'=>'Edit'))}}</a>
								</td>
								<td align="center"><a
									href="{{URL::to('admin/website-topic_delete-'.$website_id.'-'.$topic->id)}}" title="" onclick="return confirm('Are you sure you want to permanently delete this topic? \n{{str_replace('"','',$topic->feed_name)}} \nDate modified: {{$topic->updated_at}}')">{{HTML::image('assets/img/icon/delete.png','Delete',array('title'=>'Delete'))}}</a>
								</td>
							</tr>
							<!-- Modal -->
							<div class="modal fade" id="myModal-{{$topic->id}}" tabindex="-1"
								role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-body">
											<div class="row">
												<div class="col-md-12">
													<!-- general form elements -->
													<div class="box">
														<div class="box-header" style="padding-bottom: 0;">
															<h3 class="box-title">Edit RSS - Feed</h3>
														</div>
														{{Form::open(array('url'=>'admin/website-topic_edit-'.$website_id.'-'.$topic->id))}}
														<div class="box-body">
															<div class="form-group">
																{{Form::label('feed_name','Feed Name')}}&nbsp;<font
																	color="#FF0000">*</font>
																<div class="input-group">
																	<span class="input-group-addon"><i
																		class="fa fa-rss-square"></i> </span>
																	{{Form::text('feed_name',Input::old('feed_name',$topic->feed_name),array('class'=>'form-control','placeholder'=>'Enter
																	...'))}}
																</div>
																<p class="help-block">Tùy chọn. Không nhiều hơn 20 ký tự</p>
															</div>
															<div class="form-group">
																{{Form::label('feed_address','Feed Address')}}&nbsp;<font
																	color="#FF0000">*</font>
																<div class="input-group">
																	<span class="input-group-addon"><i
																		class="fa fa-external-link"></i> </span>
																	{{Form::text('feed_address',Input::old('feed_address',$topic->feed_address),array('class'=>'form-control','placeholder'=>'Enter
																	...'))}}
																</div>
															</div>
															<div class="form-group">
																{{Form::label('period','Period')}} <select
																	class="form-control" name="period" style="width: auto;">
																	@if($topic->period==1)
																	<option value="1" selected>1 day</option> @else
																	<option value="1">1 day</option> @endif
																	<?php
																	for($i = 2; $i <= 5; $i ++) {
																		if($topic->period==$i){
																			echo '<option value="' . $i . '" selected>' . $i . '&nbsp;days</option>';
																		}else{
																			echo '<option value="' . $i . '">' . $i . '&nbsp;days</option>';
																		}
																	}
																	?>
																</select>
															</div>
															{{Form::submit('Save changes',array('class'=>'btn
															bg-maroon','style'=>'margin-right:10px;'))}}
															<button class="slide_close btn bg-black"
																data-dismiss="modal">Close</button>
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
							@endforeach()
						</tbody>
						<tfoot>
							<tr>
								<th>ID</th>
								<th align="left">Feed name</th>
								<th>Status</th>
								<th>Link</th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
						</tfoot>
					</table>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
	</div>
</section>
<!-- /.content -->
@stop
