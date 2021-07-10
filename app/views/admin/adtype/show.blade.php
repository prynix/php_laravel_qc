@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        View ad type
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="adtype"> Ad Types</a></li>
                        <li class="active">View ad type</li>
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
                                <!-- form start -->
                                {{HTML::ul($errors->all())}}
                                {{Form::open()}}
                                    <div class="box-body">
                                        <div class="form-group">
                                            {{Form::label('title','Title')}}&nbsp;<font color="#FF0000">*</font>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-flag-o"></i></span>
                                            	{{Form::text('title',Input::old('title',$adtype->title),array('class'=>'form-control','disabled'=>'disabled'))}}
                                        	</div>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('width','Width')}}&nbsp;<font color="#FF0000">*</font>
                                            {{Form::input('number','width',Input::old('width',$adtype->width),array('class'=>'form-control','disabled'=>'disabled','min'=>'0','style'=>'width:100px;'))}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('height','Height')}}&nbsp;<font color="#FF0000">*</font>
                                            {{Form::input('number','height',Input::old('height',$adtype->height),array('class'=>'form-control','disabled'=>'disabled','min'=>'0','style'=>'width:100px;'))}}
                                        </div>
                                        <a href="{{URL::to('admin/adtype')}}" class="btn btn-default">Back</a>
                                    </div>
                                {{Form::close()}}
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->

@stop