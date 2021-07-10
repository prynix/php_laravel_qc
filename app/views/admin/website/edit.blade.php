@extends('layout.main') @section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Edit website<span class="target">: {{$website->name}}</span>
		<!-- <small>Preview</small> -->
	</h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="website"> Websites</a></li>
		<li class="active">Edit website</li>
	</ol>
    <br/>
                    @foreach($campaigns as $campaign)
                                                @if($website->campaignid==$campaign->id)
                                                    <a href="{{URL::to('admin/campaign-edit-'.$campaign->id)}}" title="">Campaign: {{ $campaign->campaignname }}</a>
                                                @else
                                                @endif
                                            @endforeach
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<!-- left column -->
		{{Form::open()}}
		<div class="col-md-6">
			<!-- general form elements -->
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title">Website Properties</h3>
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
				<div class="box-body" style="padding-bottom: 200px;">
                	<input type="hidden" name="campaignid" value="{{ $website->campaignid }}"/>
					<div class="form-group">
						{{Form::label('website','Website URL')}}&nbsp;<font
							color="#FF0000">*</font>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-link"></i></span>
							{{Form::url('website',Input::old('website',$website->website),array('class'=>'form-control'))}}
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
							{{Form::text('name',Input::old('name',$website->name),array('class'=>'form-control'))}}
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
							{{Form::text('contact',Input::old('contact',$website->contact),array('class'=>'form-control'))}}
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
							{{Form::text('email',Input::old('email',$website->email),array('class'=>'form-control'))}}
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
							<!--<option value="0">-- Main --</option>--> @foreach($categories as
							$cat) @if($website->category==$cat->id)
							<option value="{{$cat->id}}" selected>{{ $cat->category_name }}</option>
							@else
							<option value="{{$cat->id}}">{{ $cat->category_name }}</option>
							@endif @foreach($cat['children'] as $cat)
							@if($website->category==$cat->id)
							<option value="{{$cat->id}}" selected>--|&nbsp;{{
								$cat->category_name }}</option> @else
							<option value="{{$cat->id}}">--|&nbsp;{{ $cat->category_name }}</option>
							@endif @endforeach @endforeach
						</select>
					</div>
					<!--
 					<div class="form-group"> -->
<!-- 						{{Form::label('webpage','Web page')}}  -->
<!-- 						<select data-placeholder="-- Select --" class="chosen-select" tabindex="1" name="webpage">{{$website->webpage}}  -->
<!-- 							@if($website->webpage==1) -->
<!--     							<option value="1" selected>Site</option> -->
<!--     							<option value="2">Partner</option> -->
<!-- 							@else -->
<!-- 							    <option value="1">Site</option> -->
<!--     							<option value="2" selected>Partner</option> -->
<!-- 							@endif -->
<!-- 						</select> -->
<!-- 					</div> -->
					<div class="form-group">
						{{Form::label('country','Country')}} <select
							data-placeholder="-- Select --" class="chosen-select"
							tabindex="1" name="country"> @foreach($countries as $country)
							@if($website->country==$country->id)
							<option value="{{$country->id}}" selected>{{
								$country->country_name }}</option> @else
							<option value="{{$country->id}}">{{ $country->country_name }}</option>
							@endif @endforeach
						</select>
					</div>
					<div class="form-group">
						{{Form::label('language','Language')}} <select
							data-placeholder="-- Select --" class="chosen-select"
							tabindex="1" name="language"> @foreach($languages as $language)
							@if($website->language==$language->id)
							<option value="{{$language->id}}" selected>{{
								$language->language_name }}</option> @else
							<option value="{{$language->id}}">{{ $language->language_name }}</option>
							@endif @endforeach
						</select>
					</div>
					<button type="submit" class="btn-sm btn-success"><i class="fa fa-check-circle-o"></i>&nbsp;Save</button>
				</div>
			</div>
			<!-- /.box -->
		</div>
		<!--/.col (right) -->
		{{Form::close()}}
	</div>
	<!-- /.row -->
</section>
<!-- /.content -->

@stop
