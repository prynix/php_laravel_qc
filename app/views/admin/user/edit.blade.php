@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Edit user<span class="target">: {{$user->username}}</span>
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="user"> Users</a></li>
                        <li class="active">Edit user</li>
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
                                    <h3 class="box-title">User Properties</h3>
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
                                            	{{Form::text('username',Input::old('username',$user->username),array('class'=>'form-control','disabled'=>'disabled'))}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('contact_name','Contact Name')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                            	{{Form::text('contact_name',Input::old('contact_name',$user->contact_name),array('class'=>'form-control','disabled'=>'disabled'))}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('email_address','Email')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                            	{{Form::text('email_address',Input::old('email_address',$user->email_address),array('class'=>'form-control','disabled'=>'disabled'))}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('language','Language')}}
                                            <select class="form-control" name="language" disabled>
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
                                        <button type="submit" class="btn-sm btn-success"><i class="fa fa-check-circle-o"></i>&nbsp;Save</button>
                                    </div>
                                {{Form::close()}}
                            </div><!-- /.box -->
						</div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->

@stop