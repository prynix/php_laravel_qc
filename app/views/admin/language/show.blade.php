@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        View language
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="language"> Languages</a></li>
                        <li class="active">View language</li>
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
                                            {{Form::label('language_name','Language Name')}}
                                            <div class="input-group">
                                            	<span class="input-group-addon"><i class="fa fa-font"></i></span>
                                            	{{Form::text('language_name',Input::old('language_name',$language->language_name),array('class'=>'form-control','disabled'=>'disabled'))}}
                                            </div>
                                        </div>
                                        <a href="{{URL::to('admin/language')}}" class="btn btn-default">Back</a>
                                    </div>
                                {{Form::close()}}
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->

@stop