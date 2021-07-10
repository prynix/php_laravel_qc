@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Add a new link to click tracking
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="ccount"> Click Counter</a></li>
                        <li class="active">Add new link</li>
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
                                    <h3 class="box-title"></h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                {{HTML::ul($errors->all())}}
                                {{Form::open()}}
                                <div class="box-body">
                                    <div class="form-group">
                                        {{Form::label('url','Link URL')}}
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-link"></i></span>
                                            {{Form::text('url',Input::old('url'),array('class'=>'form-control','placeholder'=>'http://www.example.com'))}}
                                        </div>
                                        <p class="help-block">URL of the link you wish to count clicks on.</p>
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('title','Link title')}}
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-flag-checkered"></i></span>
                                            {{Form::text('title',Input::old('title'),array('class'=>'form-control','placeholder'=>'(optional) My page title'))}}
                                        </div>
                                        <p class="help-block">Title of the page for the link list.</p>
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('id','Link ID')}}
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                        	{{Form::text('id',Input::old('id'),array('class'=>'form-control','placeholder'=>'(optional) my_page_1','disabled'=>'disabled'))}}
                                        </div>
                                        <p class="help-block">Page ID for the tracking URL (click.php?id=<strong>page_id</strong>). Allowed chars: a-z A-Z 0-9 - _ .</p>
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('clicks','Start counting from')}}
                                        {{Form::input('number','clicks',Input::old('clicks'),array('class'=>'form-control','min'=>0,'placeholder'=>0,'maxlength'=>10,'size'=>5,'style'=>'width:100px;'))}}
                                        <p class="help-block">Click Counter will start counting clicks from this value.</p>
                                    </div>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success">Add this link</button>
                                </div><!-- /.box-footer -->
                                {{Form::close()}}
                                <!-- form end -->
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->

@stop