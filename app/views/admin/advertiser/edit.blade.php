@extends('layout.main') @section('content') <!-- Content Header (Page header) -->
<section class="content-header">
	<h1> Edit advertiser<span class="target">: {{$advertiser->clientname}}</span><!-- <small>Preview</small> --></h1>
	<ol class="breadcrumb">
		<li>
			<a href="dashboard"><i class="fa fa-dashboard"></i> Home</a>
		</li>
		<li>
			<a href="advertiser"> Advertisers</a>
		</li>
		<li class="active">
			Edit advertiser
		</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<!-- left column -->
		<div class="col-md-6">
			<!-- general form elements -->
			<div class="box box-success">
				<!-- form start -->
				<div class="box-body">
					<div id="horizontalTab">
						<ul>
							<li>
								<a href="#tab-1"
								style="border-left: none; border-top-right-radius: 0;">Advertiser
								Properties</a>
							</li>
							<li>
								<a href="#tab-2"
								style="border-top-left-radius: 0; border-top-right-radius: 0;">User
								Access</a>
							</li>
						</ul>
						<div id="tab-1">
							{{Form::open(array('url'=>'admin/advertiser-edit-'.$advertiser->id.'#tab-1'))}}
							<div class="form-group">
								{{Form::label('clientname','Name')}}&nbsp;<font color="#FF0000">*</font>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i> </span> {{Form::text('clientname',Input::old('clientname',$advertiser->clientname),array('class'=>'form-control','placeholder'=>'Enter
									...'))}}
								</div>
								@if($errors->first('clientname'))
								<div class="alert alert-danger alert-dismissable">
									<i class="fa fa-ban"></i>
									<button type="button" class="close" data-dismiss="alert"
									aria-hidden="true">
										&times;
									</button>
									{{$errors->first('clientname')}}
								</div>
								@endif
							</div>
							<div class="form-group">
								{{Form::label('contact','Contact')}}&nbsp;<font color="#FF0000">*</font>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-credit-card"></i> </span> {{Form::text('contact',Input::old('contact',$advertiser->contact),array('class'=>'form-control','placeholder'=>'Enter
									...'))}}
								</div>
								@if($errors->first('contact'))
								<div class="alert alert-danger alert-dismissable">
									<i class="fa fa-ban"></i>
									<button type="button" class="close" data-dismiss="alert"
									aria-hidden="true">
										&times;
									</button>
									{{$errors->first('contact')}}
								</div>
								@endif
							</div>
							<div class="form-group">
								{{Form::label('email','Email')}}&nbsp;<font color="#FF0000">*</font>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope"></i> </span> {{Form::text('email',Input::old('email',$advertiser->email),array('class'=>'form-control','placeholder'=>'Enter
									...'))}}
								</div>
								@if($errors->first('email'))
								<div class="alert alert-danger alert-dismissable">
									<i class="fa fa-ban"></i>
									<button type="button" class="close" data-dismiss="alert"
									aria-hidden="true">
										&times;
									</button>
									{{$errors->first('email')}}
								</div>
								@endif
							</div>
							<div class="form-group">
								{{Form::label('address','Address')}}
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-book"></i> </span> {{Form::text('address',Input::old('address',$advertiser->address),array('class'=>'form-control','placeholder'=>'Enter
									...'))}}
								</div>
							</div>
							<div class="form-group">
								{{Form::label('city','City')}}
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-plane"></i> </span> {{Form::text('city',Input::old('city',$advertiser->city),array('class'=>'form-control','placeholder'=>'Enter
									...'))}}
								</div>
							</div>
							<div class="form-group">
								<label>Country</label>
								<select data-placeholder="-- Select --"
								class="chosen-select" tabindex="1" name="country">

									@foreach($countries as $country)
									@if($advertiser->country==$country->id)

									<option value="{{$country->id}}" selected>{{
										$country->country_name }}</option>

									@else

									<option value="{{$country->id}}">{{ $country->country_name }}</option>

									@endif @endforeach

								</select>
							</div>
							<div class="form-group">
								{{Form::label('phone','Phone')}}
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-phone"></i>
									</div>
									{{Form::text('phone',Input::old('phone',$advertiser->phone),array('class'=>'form-control','data-inputmask'=>'"mask":
									"(9999) 999-9999"','data-mask'=>''))}}
								</div>
								<!-- /.input group -->
							</div>
							<!-- /.form group -->
							<div class="form-group">
								{{Form::label('comments','Comments')}}
								{{Form::textarea('comments',Input::old('comments',$advertiser->comments),array('class'=>'form-control','placeholder'=>'Enter
								...','rows'=>3))}}
							</div>
								<button type="submit" class="btn-sm btn-success">
									<i class="fa fa-check-circle-o"></i>&nbsp;Save
								</button>
							{{Form::close()}}
						</div>
						<div id="tab-2">
							<!--<div id="frmGroupAddUser" class="form-group">
							<button class="btn btn-success" id="btnAddUserAccess">Add user</button>
							</div>-->
							<div id="tblUserAccess">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th align="left">Username</th>
											<th align="left">Email</th>
											<th align="left">Contact Name</th>
											<th align="left">Date linked</th>
											<th></th>
										</tr>
									</thead>
									<tbody>

										@foreach($users as $user) @if($user->clientid==$advertiser->id)
										<tr>
											<td>{{$user->username}}</td>
											<td>{{$user->email}}</td>
											<td>{{$user->contact_name}}</td>
											<td>{{$user->created_at}}</td>
											<td align="center"><a href="{{URL::to('admin/useraccess-destroy-'.$advertiser->id.'-'.$user->id)}}" title="Delete"><button class="btn-sm btn-default" onclick="return confirm('Are you sure you want to permanently delete this record? \n{{$user->username}} \nDate modified: {{$user->updated_at}}')"><i class="fa fa-trash-o"></i></button></a></td>
										</tr>
										@else @endif @endforeach()
									</tbody>

									<tfoot>
										<tr>
											<th align="left">Username</th>
											<th align="left">Email</th>
											<th align="left">Contact Name</th>
											<th align="left">Date linked</th>
											<th></th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
					<!-- /.box -->
				</div>
			</div>
			<!-- /.col (left) -->
		</div>
		<div class="col-md-6">
			<!-- general form elements -->
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title">Add user access</h3>
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
                                    </div>​​
                                </div>
				<!-- form start -->
				<div class="box-body">
					<div id="frmUserAccess">
						{{Form::open(array('url'=>'admin/advertiser-user-'.$advertiser->id))}}
						<div class="form-group">
							{{Form::label('username','Username')}}&nbsp;<font color="#FF0000">*</font>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i> </span> {{Form::text('username',Input::old('username'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
							</div>
							@if($errors->first('username'))
							<div class="alert alert-danger alert-dismissable">
								<i class="fa fa-ban"></i>
								<button type="button" class="close" data-dismiss="alert"
								aria-hidden="true">
									&times;
								</button>
								{{$errors->first('username')}}
							</div>
							@endif
						</div>
						<div class="form-group">
							{{Form::label('password','Password')}}&nbsp;<font color="#FF0000">*</font>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-code"></i> </span> {{Form::password('password',array('class'=>'form-control','placeholder'=>'Enter ...'))}}
							</div>
							@if($errors->first('password'))
							<div class="alert alert-danger alert-dismissable">
								<i class="fa fa-ban"></i>
								<button type="button" class="close" data-dismiss="alert"
								aria-hidden="true">
									&times;
								</button>
								{{$errors->first('password')}}
							</div>
							@endif
						</div>
						<div class="form-group">
							{{Form::label('repeat_password','Repeat password')}}&nbsp;<font color="#FF0000">*</font>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-code"></i> </span> {{Form::password('repeat_password',array('class'=>'form-control','placeholder'=>'Enter ...'))}}
							</div>
							@if($errors->first('repeat_password'))
							<div class="alert alert-danger alert-dismissable">
								<i class="fa fa-ban"></i>
								<button type="button" class="close" data-dismiss="alert"
								aria-hidden="true">
									&times;
								</button>
								{{$errors->first('repeat_password')}}
							</div>
							@endif
						</div>
						<div class="form-group">
							{{Form::label('contact_name','Contact Name')}}&nbsp;<font color="#FF0000">*</font>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-credit-card"></i> </span> {{Form::text('contact_name',Input::old('contact_name'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
							</div>
							@if($errors->first('contact_name'))
							<div class="alert alert-danger alert-dismissable">
								<i class="fa fa-ban"></i>
								<button type="button" class="close" data-dismiss="alert"
								aria-hidden="true">
									&times;
								</button>
								{{$errors->first('contact_name')}}
							</div>
							@endif
						</div>
						<div class="form-group">
							{{Form::label('email_address','Email')}}&nbsp;<font color="#FF0000">*</font>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope"></i> </span> {{Form::text('email_address',Input::old('email_address'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
							</div>
							@if($errors->first('email_address'))
							<div class="alert alert-danger alert-dismissable">
								<i class="fa fa-ban"></i>
								<button type="button" class="close" data-dismiss="alert"
								aria-hidden="true">
									&times;
								</button>
								{{$errors->first('email_address')}}
							</div>
							@endif
						</div>
						<div class="form-group">
							{{Form::label('default_account_id','Language')}}
							<select
							data-placeholder="-- Select --" class="chosen-select"
							tabindex="1" name="language">
								<!--<option value="0">-- Select --</option>-->

								@foreach($languages as $language)

								<option value="{{$language->id}}">{{ $language->language_name
									}}</option>

								@endforeach

							</select>
						</div>
						<div class="form-group">
							<button type="submit" class="btn-sm btn-primary">
								<i class="fa fa-check-circle-o"></i>&nbsp;Save changes
							</button>
							<button type="reset" class="btn-sm btn-default">
								<i class="fa fa-times-circle-o"></i>&nbsp;Reset
							</button>
						</div>
						{{Form::close()}}
					</div>
				</div>
			</div>
		</div>
		<!-- /.col (right) -->
		<!-- /.row -->
</section>
<!-- /.content -->
@stop 