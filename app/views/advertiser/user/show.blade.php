@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Advertiser<span class="target">: {{$advertiser->clientname}}</span>
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="../advertiser/user"> User Access</a></li>
                        <li class="active">View user</li>
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
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                {{HTML::ul($errors->all())}}
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
                                            <select class="form-control" name="default_account_id" disabled>
                                                <!--<option value="0">-- Select --</option>-->
                                                @foreach($usergroups as $usergroup) 
                                                            @if($user->default_account_id==$usergroup->id)
                                                                <option value="{{$usergroup->id}}" selected>{{ $usergroup->account_name }}</option>
                                                            @else
                                                                <option value="{{$usergroup->id}}">{{ $usergroup->account_name }}</option>
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
                                        <a href="{{URL::to('advertiser/user')}}" class="btn btn-default">Back</a>
                                    </div>
                                {{Form::close()}}
                            </div><!-- /.box -->
						</div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->

@stop