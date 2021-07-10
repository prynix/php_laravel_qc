@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Add new user
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="user"> Users</a></li>
                        <li class="active">Add new user</li>
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
                                    <h3 class="box-title">User Details</h3>
                                    <button class="slide_open btn-sm btn-default btn-help"><i class="fa fa-anchor"></i>&nbsp;Help</button>
                                </div><!-- /.box-header -->
                                <!-- form start -->
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
                                    <div class="box-body">
                                        <div class="form-group">
                                            {{Form::label('username','Username')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                {{Form::text('username',Input::old('username'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
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
                                                {{Form::text('contact_name',Input::old('contact_name'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
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
                                                {{Form::text('email_address',Input::old('email_address'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
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
                                                <!--<option value="0">-- Select --</option>-->
                                                @foreach($languages as $language)
                                                    <option value="{{$language->id}}">{{ $language->language_name }}</option>
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
                                                        <option value="{{$usergroup->id}}">{{ $usergroup->account_name }}</option>
                                                    @endif
                                                        @foreach($usergroup['children'] as $ug)
                                                            <option value="{{$ug->id}}">--|&nbsp;{{ $ug->account_name }}</option>
                                                        @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn-sm btn-success">Save & New</button>
                                    </div>
                                {{Form::close()}}
                            </div><!-- /.box -->
						</div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->

@stop