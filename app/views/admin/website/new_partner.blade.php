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
		<li class="active">Partners</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Partners</h3>
				</div>
				<!-- /.box-header -->
				<a href="#" style="display: inline-block; margin-left: 10px;"><button
						class="slide_open btn btn-success">Add new partner</button></a>
				<a href="#" style="display: inline-block; margin-left: 10px;"><button
						class="btn bg-light-green">New</button></a> <a
					href="website-partner-{{$website_id}}"
					style="display: inline-block; margin-left: 10px;"><button
						class="btn btn-default">Active</button></a> <a
					href="website-partner_banned-{{$website_id}}"
					style="display: inline-block; margin-left: 10px;"><button
						class="btn btn-default">Banned</button></a>
				<div id="slide" class="well"
					style="display: none; top: 0%; width: 50%;height: 90%;">
					<div class="row">
						<div class="col-md-12">
							<!-- general form elements -->
							<div class="box">
								<div class="box-header" style="padding-bottom: 0;">
									<h3 class="box-title">
<!-- 									Add new partner -->
									   List partners
									</h3>
								</div>
								{{Form::open()}}
								<div class="box-body table-responsive">
<!-- 									<div class="form-group"> -->
<!-- 										{{Form::label('website_name','Website Name')}}&nbsp;<font -->
<!-- 											color="#FF0000">*</font> -->
<!-- 										<div class="input-group"> -->
<!-- 											<span class="input-group-addon"><i class="fa fa-rss-square"></i></span> -->
<!-- 											{{Form::text('website_name',Input::old('website_name'),array('class'=>'form-control','placeholder'=>'Enter ...'))}} -->
<!-- 										</div> -->
<!-- 									</div> -->
<!-- 									<div class="form-group"> -->
<!-- 										{{Form::label('website_topic_id','Topic')}} <select -->
<!-- 											data-placeholder="-- Select --" class="chosen-select" -->
<!-- 											tabindex="1" name="topic_id[]" multiple -->
<!-- 											data-rel="chosen"> -->
<!-- 											<option value="0" selected>Other</option> -->
<!-- 											@foreach($categories as $category) -->
<!-- 											<option value="{{$category->id}}">{{$category->category_name}}</option> -->
<!-- 											@endforeach() -->
<!-- 										</select> -->
<!-- 									</div> -->
<!-- 									<div class="form-group"> -->
<!-- 										{{Form::input('checkbox','icp_status',Input::old('icp_status',1),array('class'=>'flat-red'))}}&nbsp; -->
<!-- 										{{Form::label('icp_status','ICP')}} -->
<!-- 										{{Form::text('icp_name',Input::old('icp_name'),array('class'=>'form-control','placeholder'=>'Enter ...','style'=>'display:inline-block -->
<!-- 										!important;width:auto;margin-left:3px;','disabled'=>'disabled'))}}</div> -->
<!-- 									{{Form::submit('Create',array('class'=>'btn -->
<!-- 									bg-maroon','style'=>'margin-right:10px;'))}} -->
<!-- 									<button class="slide_close btn bg-black">Close</button> -->
								    
								    <table id="example3" class="table table-bordered table-striped">
								        <thead>
                                            <tr>
                                                <th align="center">ID</th>
                                                <th></th>
                                                <th align="center">Website name</th>
                                                <th align="center">Topic</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($websites as $website)
	                                            <tr>
	                                                <td align="center">
	                                                	{{$website->id}}
	                                                </td>
	                                                <td align="center">
	                                                	{{Form::input('checkbox','partner_id[]',Input::old('partner_id[]',$website->id),array('class'=>'flat-red'))}}	                                              
	                                                	{{Form::input('hidden','icp[]',Input::old('icp[]',$website->icp))}}
	                                                </td>
	                                                <td>
	                                                    {{$website->website}}
	                                                    {{Form::input('hidden','name',Input::old('name',$website->website))}} 
	                                                </td> 
	                                                <td>@foreach($topics as $topic)
	                                                        @if($topic->website_id==$website->id)
	                                                            {{$topic->feed_name.'; '}}
	                                                            {{Form::input('hidden','topic_id[]',Input::old('topic_id[]',$topic->id))}} 
	                                                        @else
	                                                        
	                                                        @endif
	                                                    @endforeach()
	                                                </td>    
	                                            </tr>
                                            @endforeach()
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th align="center">ID</th>
                                                <th></th>
                                                <th align="center">Website name</th>
                                                <th align="center">Topic</th>
                                            </tr>
                                        </tfoot>
								    </table> 
								</div>
								<div class="box-footer">
                                    <button type="submit" class="btn btn-success">Save changes</button>
                                </div>
								{{Form::close()}}
							</div>
						</div>
					</div>
				</div>
				<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th align="left">Website name</th>
								<th></th>
								<th align="left">Topic</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($partners as $partner)
							<tr>
								<td align="center">{{$partner->id}}</td>
								<td>{{$partner->name}}</td>
								<td align="center">
										<?php 
										//check ký tự '_' có tồn tại trong string hay không?
											$icp_status=explode('_',$partner->icp)[0];
											$icp_name=explode('_',$partner->icp)[1]
;
if ($icp_status == 1) {
	echo '<span class="label label-success" title="' . $icp_name . '">ICP</span>';
} else {
	echo '<span class="label label-default">ICP</span>';
}
?>
									</td>
								<td>
										<?php
											$topic_id=explode("; ",$partner->topic_id);
											foreach($topic_id as $topic_id){
												foreach($topics as $topic){
													if($topic->id==$topic_id){
														echo $topic->feed_name."; ";
													}
												}
												if($topic_id=='0') echo 'Other';
											}
										?>
									</td>
								<td align="center"><a
									href="{{URL::to('admin/website-partner_accept-'.$website_id.'-'.$partner->id)}}"
									title="Accept" class="btn-sm btn-primary">Accept</a></td>
								<td align="center"><a
									href="{{URL::to('admin/website-partner_deny-'.$website_id.'-'.$partner->id)}}"
									title="Deny" class="btn-sm bg-red">Deny</a></td>
							</tr>
							@endforeach()
						</tbody>
						<tfoot>
							<tr>
								<th>ID</th>
								<th align="left">Website name</th>
								<th></th>
								<th align="left">Topic</th>
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
