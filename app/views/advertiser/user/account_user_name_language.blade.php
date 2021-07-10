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
                                    <h3 class="box-title">Name & Language</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
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
                                                {{Form::label('contact_name','Full Name')}}
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
                                           <button type="submit" class="btn btn-success">Save Changes</button>
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
                                                {{Form::label('contact_name','Full Name')}}
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
                                           <button type="submit" class="btn btn-success">Save Changes</button>
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
                                                {{Form::label('contact_name','Full Name')}}
                                                {{Form::text('contact_name',Input::old('contact_name',$user->contact_name),array('class'=>'form-control','disabled'=>'disabled','style'=>'width:40%;display:block !important;'))}}
                                           </div>
                                           <div class="form-group">
                                                {{Form::label('oldpassword','Current Password')}}
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
                                           <button type="submit" class="btn btn-success">Save Changes</button>
                                        {{Form::close()}}
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
@stop