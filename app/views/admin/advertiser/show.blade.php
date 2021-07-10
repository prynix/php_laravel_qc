@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> Show advertiser<span class="target">: {{$advertiser->clientname}}</span>
    <!-- <small>Preview</small> -->
  </h1>
  <ol class="breadcrumb">
    <li> <a href="dashboard"><i class="fa fa-dashboard"></i> Home</a> </li>
    <li> <a href="advertiser"> Advertisers</a> </li>
    <li class="active"> Show advertiser </li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
<div class="row">
<!-- left column -->
<div class="col-md-6">
  <!-- general form elements -->
  <div class="box box-success">
    <div class="box-body">
      <div id="horizontalTab">
        <ul>
          <li> <a href="#tab-1" style="border-left:none;border-top-right-radius:0;">Advertiser Properties</a> </li>
          <li> <a href="#tab-2" style="border-top-left-radius:0;border-top-right-radius:0;">User Access</a> </li>
        </ul>
        <div id="tab-1">
          <!-- form start -->
          {{HTML::ul($errors->all())}}
          {{Form::open()}}
          <div class="form-group"> {{Form::label('clientname','Name')}}&nbsp;<font color="#FF0000">*</font>
            <div class="input-group"> <span class="input-group-addon"><i class="fa fa-user"></i></span> {{Form::text('clientname',Input::old('clientname',$advertiser->clientname),array('class'=>'form-control','disabled'=>'disabled'))}} </div>
          </div>
          <div class="form-group"> {{Form::label('contact','Contact')}}&nbsp;<font color="#FF0000">*</font>
            <div class="input-group"> <span class="input-group-addon"><i class="fa fa-credit-card"></i></span> {{Form::text('contact',Input::old('contact',$advertiser->contact),array('class'=>'form-control','disabled'=>'disabled'))}} </div>
          </div>
          <div class="form-group"> {{Form::label('email','Email')}}&nbsp;<font color="#FF0000">*</font>
            <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span> {{Form::text('email',Input::old('email',$advertiser->email),array('class'=>'form-control','disabled'=>'disabled'))}} </div>
          </div>
          <div class="form-group"> {{Form::label('address','Address')}}
            <div class="input-group"> <span class="input-group-addon"><i class="fa fa-book"></i></span> {{Form::text('address',Input::old('address',$advertiser->address),array('class'=>'form-control','disabled'=>'disabled'))}} </div>
          </div>
          <div class="form-group"> {{Form::label('city','City')}}
            <div class="input-group"> <span class="input-group-addon"><i class="fa fa-plane"></i></span> {{Form::text('city',Input::old('city',$advertiser->city),array('class'=>'form-control','disabled'=>'disabled'))}} </div>
          </div>
          <div class="form-group">
            <label>Country</label>
            <div class="input-group"> <span class="input-group-addon"><i class="fa fa-rocket"></i></span>
              <select class="form-control" name="country" disabled>
                

										@foreach($countries as $country)
										@if($advertiser->country==$country->id)

										
                <option value="{{$country->id}}" selected>{{ $country->country_name }}</option>
                

										@else

										
                <option value="{{$country->id}}">{{ $country->country_name }}</option>
                

										@endif
										@endforeach

									
              </select>
            </div>
          </div>
          <div class="form-group"> {{Form::label('phone','Phone')}}
            <div class="input-group">
              <div class="input-group-addon"> <i class="fa fa-phone"></i> </div>
              {{Form::text('phone',Input::old('phone',$advertiser->phone),array('class'=>'form-control','data-inputmask'=>'"mask": "(9999) 999-9999"','data-mask'=>'','disabled'=>'disabled'))}} </div>
            <!-- /.input group -->
          </div>
          <!-- /.form group -->
          <div class="form-group"> {{Form::label('comments','Comments')}}
            {{Form::textarea('comments',Input::old('comments',$advertiser->comments),array('class'=>'form-control','disabled'=>'disabled','rows'=>3))}} </div>
        </div>
        <!-- /.box-body -->
        {{Form::close()}}
        <div id="tab-2">
          <table id="example1" class="table table-bordered table-striped user_access">
            <thead>
              <tr>
                <th align="left">Username</th>
                <th align="left">Email</th>
                <th align="left">Contact Name</th>
                <th align="left">Date linked</th>
              </tr>
            </thead>
            <tbody>
            
            @foreach($users as $user)
            @if($user->clientid==$advertiser->id)
            <tr>
              <td>{{$user->username}}</td>
              <td>{{$user->email_address}}</td>
              <td>{{$user->contact_name}}</td>
              <td>{{$user->created_at}}</td>
            </tr>
            @else
            @endif
            @endforeach()
            </tbody>
            
            <tfoot>
              <tr>
                <th align="left">Username</th>
                <th align="left">Email</th>
                <th align="left">Contact Name</th>
                <th align="left">Date linked</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="box-footer"> <a href="{{URL::to('admin/advertiser')}}">
          <button class="btn-sm btn-default"><i class="fa fa-arrow-circle-o-left"></i>&nbsp;Back</button>
          </a>
          <button class="slide_open btn-sm btn-default btn-help no-margin-top no-margin-right"><i class="fa fa-anchor"></i>&nbsp;Help</button>
        </div>
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (left) -->
  </div>
</div>
<div id="slide" class="well" style="display:none;top:15%;width:30%;height:80%;bottom:5%;right:45%;left:25%;">
  <div id="widget">
    <div id="header">
      <input type="text" id="search" placeholder="Search in the text" />
    </div>
    <div id="content"> @if(isset($help))
      @foreach($help as $help)
      @if(Session::get('language',Config::get('app.locale'))=='en')
      {{$help->content_helper_en}}
      @elseif(Session::get('language',Config::get('app.locale'))=='vi')
      {{$help->content_helper_vi}}
      @endif
      @endforeach()
      @else
      @endif </div>
  </div>
</div>
<!-- /.row -->
</section>
<!-- /.content -->
@stop