@extends('layout.main') @section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1> @foreach($campaign as $campaign) @endforeach
		Add new website<span class="target"> to campaign</span> <a href="{{URL::to('admin/campaign-edit-'.$campaign->id)}}" title="">{{$campaign->campaignname}}</a>
		<!-- <small>Preview</small> -->
	</h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="website"> Websites</a></li>
		<li class="active">Add new website</li>
	</ol>
	<br/>
	<a href="{{URL::to('admin/campaign-edit-'.$campaign->id)}}" title="">Campaign: {{$campaign->campaignname}}</a>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<!-- left column -->
		<div class="col-md-6">
			<!-- general form elements -->
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title">Basic information</h3>
                    <button class="slide_open btn-sm btn-default btn-help"><i class="fa fa-anchor"></i>&nbsp;Help</button>
				</div>
				<!-- /.box-header -->
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
				{{Form::open()}}
				<div class="box-body" style="padding-bottom: 200px;">
					<div class="form-group">
						{{Form::label('website','Website URL')}}&nbsp;<font
							color="#FF0000">*</font>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-link"></i></span>
							{{Form::url('website',Input::old('website'),array('class'=>'form-control','placeholder'=>'http://'))}}
						</div>
						@if($errors->first('website'))
						<div class="alert alert-danger alert-dismissable">
							<i class="fa fa-ban"></i>
							<button type="button" class="close" data-dismiss="alert"
								aria-hidden="true">&times;</button>
							{{$errors->first('website')}}
						</div>
						@endif
					</div>
					<div class="form-group">
						{{Form::label('name','Name')}}&nbsp;<font color="#FF0000">*</font>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-globe"></i></span>
							{{Form::text('name',Input::old('name'),array('class'=>'form-control','placeholder'=>'Enter
							...'))}}
						</div>
						@if($errors->first('name'))
						<div class="alert alert-danger alert-dismissable">
							<i class="fa fa-ban"></i>
							<button type="button" class="close" data-dismiss="alert"
								aria-hidden="true">&times;</button>
							{{$errors->first('name')}}
						</div>
						@endif
					</div>
					<div class="form-group">
						{{Form::label('contact','Contact')}}&nbsp;<font color="#FF0000">*</font>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
							{{Form::text('contact',Input::old('contact'),array('class'=>'form-control','placeholder'=>'Enter
							...'))}}
						</div>
						@if($errors->first('contact'))
						<div class="alert alert-danger alert-dismissable">
							<i class="fa fa-ban"></i>
							<button type="button" class="close" data-dismiss="alert"
								aria-hidden="true">&times;</button>
							{{$errors->first('contact')}}
						</div>
						@endif
					</div>
					<div class="form-group">
						{{Form::label('email','Email')}}&nbsp;<font color="#FF0000">*</font>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
							{{Form::text('email',Input::old('email'),array('class'=>'form-control','placeholder'=>'Enter
							...'))}}
						</div>
						@if($errors->first('email'))
						<div class="alert alert-danger alert-dismissable">
							<i class="fa fa-ban"></i>
							<button type="button" class="close" data-dismiss="alert"
								aria-hidden="true">&times;</button>
							{{$errors->first('email')}}
						</div>
						@endif
					</div>
					<div class="form-group">
						{{Form::label('category','Category')}} <select
							data-placeholder="-- Select --" class="chosen-select"
							tabindex="1" name="category">
							<option value="0">-- Main --</option> @foreach($categories as
							$category)
							<option value="{{$category->id}}">{{ $category->category_name }}</option>
							@foreach($category['children'] as $category)

							<option value="{{$category->id}}">--|&nbsp;{{
								$category->category_name }}</option> @endforeach @endforeach
						</select>
					</div>
					<!--<div class="form-group">
						{{Form::input('checkbox','icp_status',Input::old('icp_status',1),array('class'=>''))}}&nbsp;
						{{Form::label('icp_status','ICP')}}
						{{Form::text('icp_name',Input::old('icp_name'),array('class'=>'form-control','placeholder'=>'Enter
						...','style'=>'display:inline-block
						!important;width:auto;margin-left:3px;','disabled'=>'disabled'))}}
					</div>
 					<div class="form-group"> -->
<!-- 						{{Form::label('webpage','Web page')}} <select -->
<!-- 							data-placeholder="-- Select --" class="chosen-select" -->
<!-- 							tabindex="1" name="webpage"> -->
<!-- 							<option value="1">Site</option> -->
<!-- 							<option value="2">Partner</option> -->
<!-- 						</select> -->
<!-- 					</div> -->
					<div class="form-group">
						{{Form::label('country','Country')}} <select
							data-placeholder="-- Select --" class="chosen-select"
							tabindex="1" name="country"> @foreach($countries as $country)
							<option value="{{$country->id}}">{{ $country->country_name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						{{Form::label('language','Language')}} <select
							data-placeholder="-- Select --" class="chosen-select"
							tabindex="1" name="language"> @foreach($languages as $language)
							<option value="{{$language->id}}">{{ $language->language_name }}</option>
							@endforeach
						</select>
					</div>
					<button type="submit" class="btn-sm btn-success"><i class="fa fa-check-circle-o"></i>&nbsp;Save & New</button>
				</div>
				{{Form::close()}}
			</div>
			<!-- /.box -->
		</div>
		<!--/.col (left) -->
		<!--<div class="col-md-6">
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">User Access</h3>
                                </div>
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th align="left">Username</th>
                                                <th align="left">Email</th>
                                                <th align="left">Contact Name</th>
                                                <th align="left">Date linked</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td align="center">
                                                        {{Form::input('checkbox','userid',Input::old('userid',$user->id),array('class'=>'flat-red'))}}
                                                    </td>
                                                    <td>{{$user->username}}</td>
                                                    <td>{{$user->email_address}}</td>
                                                    <td>{{$user->contact_name}}</td>
                                                    <td>{{$user->created_at}}</td>
                                                </tr>
                                            @endforeach()
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th align="left">Username</th>
                                                <th align="left">Email</th>
                                                <th align="left">Contact Name</th>
                                                <th align="left">Date linked</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>-->
                        <!--/.col (right) -->
	</div>
	<!-- /.row -->
</section>
<!-- /.content -->

@stop
