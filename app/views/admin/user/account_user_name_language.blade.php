@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        User Preferences
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">User Preferences</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <!--<h3 class="box-title">Name & Language</h3>-->
                                    <button class="slide_open btn-sm btn-default btn-help"><i class="fa fa-anchor"></i>&nbsp;Help</button>
                                </div><!-- /.box-header -->
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
                                <div class="box-body">
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
                                    <!--Horizontal Tab-->
                                    <div id="horizontalTab">
                                        <ul>
                                            <li><a href="#tab-1" id="account-1" style="border-left: none;">Name & Language</a></li>
                                            <li><a href="#tab-2" id="account-2">Change E-mail</a></li>
                                            <li><a href="#tab-3" id="account-3">Change Password</a></li>
                                        </ul>
                                        <div id="tab-1">
                                        {{HTML::ul($errors->all())}}
                                        {{Form::open(array('url'=>'admin/account-user-name-language-'.$user->id))}}
                                           <div class="form-group">
                                                {{Form::label('username','Username')}}
                                                {{Form::text('username',Input::old('username',$user->username),array('class'=>'form-control','disabled'=>'disabled','style'=>'width:40%;display:block !important;'))}}
                                           </div> 
                                           <div class="form-group">
                                                {{Form::label('email_address','Email address')}}
                                                {{Form::text('email_address',Input::old('email_address',$user->email_address),array('class'=>'form-control','disabled'=>'disabled','style'=>'width:40%;display:block !important;'))}}
                                           </div> 
                                           <div class="form-group">
                                                {{Form::label('contact_name','Full name')}}
                                                {{Form::text('contact_name',Input::old('contact_name',$user->contact_name),array('class'=>'form-control','style'=>'width:40%;display:block !important;'))}}
                                           </div>
                                           <div class="form-group">
                                                {{Form::label('language','Language')}}
                                                <select class="form-control" name="language" style="width:40%;display:block !important;">
                                                    
                                                    @foreach($languages as $language)
                                                        @if($user->language==$language->id)
                                                            <option value="{{$language->id}}" selected>{{ $language->language_name }}</option>
                                                        @else
                                                            <option value="{{$language->id}}">{{ $language->language_name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                           <button type="submit" class="btn-sm btn-success">Save Changes</button>
                                        {{Form::close()}}
                                        </div>
                                        <div id="tab-2">
                                        {{HTML::ul($errors->all())}}
                                        {{Form::open(array('url'=>'admin/account-user-email-'.$user->id))}}
                                           <div class="form-group">
                                                {{Form::label('username','Username')}}
                                                {{Form::text('username',Input::old('username',$user->username),array('class'=>'form-control','disabled'=>'disabled','style'=>'width:40%;display:block !important;'))}}
                                           </div> 
                                           <div class="form-group">
                                                {{Form::label('contact_name','Full name')}}
                                                {{Form::text('contact_name',Input::old('contact_name',$user->contact_name),array('class'=>'form-control','disabled'=>'disabled','style'=>'width:40%;display:block !important;'))}}
                                           </div>
                                           <div class="form-group">
                                                {{Form::label('password','Password')}}&nbsp;<font color="#FF0000">*</font>
                                                {{Form::input('password','password',Input::old('password'),array('class'=>'form-control','style'=>'width:40%;display:block !important;'))}}
                                           </div>
                                           <div class="form-group">
                                                {{Form::label('email_address','Email address')}}
                                                {{Form::text('email_address',Input::old('email_address',$user->email_address),array('class'=>'form-control','style'=>'width:40%;display:block !important;'))}}
                                           </div> 
                                           <button type="submit" class="btn-sm btn-success">Save Changes</button>
                                        {{Form::close()}} 
                                        </div>
                                        <div id="tab-3">
                                            {{HTML::ul($errors->all())}}
                                            {{Form::open(array('url'=>'admin/account-user-password-'.$user->id))}}
                                           <div class="form-group">
                                                {{Form::label('username','Username')}}
                                                {{Form::text('username',Input::old('username',$user->username),array('class'=>'form-control','disabled'=>'disabled','style'=>'width:40%;display:block !important;'))}}
                                           </div> 
                                           <div class="form-group">
                                                {{Form::label('email_address','Email address')}}
                                                {{Form::text('email_address',Input::old('email_address',$user->email_address),array('class'=>'form-control','disabled'=>'disabled','style'=>'width:40%;display:block !important;'))}}
                                           </div> 
                                           <div class="form-group">
                                                {{Form::label('contact_name','Full name')}}
                                                {{Form::text('contact_name',Input::old('contact_name',$user->contact_name),array('class'=>'form-control','disabled'=>'disabled','style'=>'width:40%;display:block !important;'))}}
                                           </div>
                                           <div class="form-group">
                                                {{Form::label('oldpassword','Current password')}}
                                                {{Form::input('password','oldpassword',Input::old('oldpassword'),array('class'=>'form-control','style'=>'width:40%;display:block !important;'))}}
                                           </div>
                                           <div class="form-group">
                                                {{Form::label('password','Create a new password')}}
                                                {{Form::input('password','password',Input::old('password'),array('class'=>'form-control','style'=>'width:40%;display:block !important;'))}}
                                           </div>
                                           <div class="form-group">
                                                {{Form::label('newpassword','Re-enter new password')}}
                                                {{Form::input('password','newpassword',Input::old('newpassword'),array('class'=>'form-control','style'=>'width:40%;display:block !important;'))}}
                                           </div>
                                           <button type="submit" class="btn-sm btn-success">Save Changes</button>
                                        {{Form::close()}}
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
@stop