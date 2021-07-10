@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-unlock"></i>&nbsp;Reset user password
        <!-- <small>Preview</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="user"> Users</a></li>
        <li class="active">Reset user password</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-4">
            <!-- general form elements -->
            <div class="box box-success">
                <!--<div class="box-header">
                    <button class="slide_open btn-sm btn-default btn-help"><i class="fa fa-anchor"></i>&nbsp;Help</button>
                </div> /.box-header -->
                {{Form::open(array('url'=>'admin/reset_password'))}}
                <div class="box-body">
                    <div class="form-group">
                        {{Form::label('email','Email address')}}
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            {{Form::text('email',Input::old('email'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
                        </div>
                        @if($errors->first('email'))
                        <div class="alert alert-danger alert-dismissable">
                            <i class="fa fa-ban"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{$errors->first('email')}}
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
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn-sm btn-primary"><i class="fa fa-check-circle-o"></i>&nbsp;Reset new password</button>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
</section>
@stop
