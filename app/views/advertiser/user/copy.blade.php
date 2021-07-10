@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Copy user<span class="target">: {{$user->username}}</span>
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="user"> Users</a></li>
                        <li class="active">Copy user</li>
                    </ol>
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
                                </div><!-- /.box-header -->
                                <!-- form start
                                {{HTML::ul($errors->all())}} -->
                                {{Form::open()}}
                                    <div class="box-body">
                                        <div class="form-group">
                                            {{Form::label('username','Username')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                {{Form::text('username',Input::old('username',$user->username),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
                                            </div>
                                            @if($errors->first('username'))
                                                <div class="alert alert-danger alert-dismissable">
                                                    <i class="fa fa-ban"></i>
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    {{$errors->first('username')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('password','Password')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-code"></i></span>
                                                {{Form::password('password',array('class'=>'form-control','placeholder'=>'Enter ...'))}}
                                            </div>
                                            @if($errors->first('password'))
                                                <div class="alert alert-danger alert-dismissable">
                                                    <i class="fa fa-ban"></i>
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    {{$errors->first('password')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('repeat_password','Repeat password')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-code"></i></span>
                                                {{Form::password('repeat_password',array('class'=>'form-control','placeholder'=>'Enter ...'))}}
                                            </div>
                                            @if($errors->first('repeat_password'))
                                                <div class="alert alert-danger alert-dismissable">
                                                    <i class="fa fa-ban"></i>
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    {{$errors->first('repeat_password')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('contact_name','Contact Name')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                                {{Form::text('contact_name',Input::old('contact_name',$user->contact_name),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
                                            </div>
                                            @if($errors->first('contact_name'))
                                                <div class="alert alert-danger alert-dismissable">
                                                    <i class="fa fa-ban"></i>
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    {{$errors->first('contact_name')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('email_address','Email')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                {{Form::text('email_address',Input::old('email_address',$user->email_address),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
                                            </div>
                                            @if($errors->first('email_address'))
                                                <div class="alert alert-danger alert-dismissable">
                                                    <i class="fa fa-ban"></i>
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    {{$errors->first('email_address')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('language','Language')}}
                                            <select data-placeholder="-- Select --" class="chosen-select" tabindex="1" name="language">
                                                <option value="0">-- Select --</option>
                                                @foreach($languages as $language)
                                                    @if($user->language==$language->id)
                                                        <option value="{{$language->id}}" selected>{{ $language->language_name }}</option>
                                                    @else
                                                        <option value="{{$language->id}}">{{ $language->language_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('default_account_id','Role')}}
                                            <select data-placeholder="-- Select --" class="chosen-select" tabindex="1" name="default_account_id">
                                                <!--<option value="0">-- Select --</option>-->
                                                @foreach($usergroups as $usergroup) 
                                                        @if($usergroup->account_name=='Advertiser')

                                                        @else
                                                            @if($user->default_account_id==$usergroup->id)
                                                                <option value="{{$usergroup->id}}" selected>{{ $usergroup->account_name }}</option>
                                                            @else
                                                                <option value="{{$usergroup->id}}">{{ $usergroup->account_name }}</option>
                                                            @endif
                                                        @endif
                                                        @foreach($usergroup['children'] as $ug)
                                                            @if($user->default_account_id==$ug->id)
                                                                <option value="{{$ug->id}}" selected>--|&nbsp;{{ $ug->account_name }}</option>
                                                            @else
                                                                <option value="{{$ug->id}}">--|&nbsp;{{ $ug->account_name }}</option>
                                                            @endif
                                                        @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-success">Copy</button>
                                    </div>
                                {{Form::close()}}
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->

@stop