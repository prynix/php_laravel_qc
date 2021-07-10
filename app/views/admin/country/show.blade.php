@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        View country
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="category"> Countries</a></li>
                        <li class="active">View country</li>
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
                                {{HTML::ul($errors->all())}}
                                {{Form::open()}}
                                    <div class="box-body">
                                        <div class="form-group">
                                            {{Form::label('country_name','Country Name')}}
                                            <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-rocket"></i></span>
                                            	{{Form::text('country_name',Input::old('country_name',$country->country_name),array('class'=>'form-control','disabled'=>'disabled'))}}
                                            </div>
                                        </div>
                                        <a href="{{URL::to('admin/country')}}" class="btn btn-default">Back</a>
                                    </div>
                                {{Form::close()}}
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->

@stop