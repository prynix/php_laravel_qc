@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Edit language
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="language"> Languages</a></li>
                        <li class="active">Edit language</li>
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
                                </div><!-- /.box-header
                                {{HTML::ul($errors->all())}} -->
                                {{Form::open()}}
                                    <div class="box-body">
                                        <div class="form-group">
                                            {{Form::label('language_name','Language Name')}}&nbsp;<font color="#FF0000">*</font>
                                            <div class="input-group">
                                            	<span class="input-group-addon"><i class="fa fa-font"></i></span>
                                            	{{Form::text('language_name',Input::old('language_name',$language->language_name),array('class'=>'form-control'))}}
                                           	</div>
                                            @if($errors->first('language_name'))
                                                        <div class="alert alert-danger alert-dismissable">
                                                            <i class="fa fa-ban"></i>
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                            {{$errors->first('language_name')}}
                                                        </div>
                                                        @endif
                                        </div>
                                        {{Form::submit('Edit',array('class'=>'btn btn-success'))}}
                                    </div>
                                {{Form::close()}}
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->

@stop