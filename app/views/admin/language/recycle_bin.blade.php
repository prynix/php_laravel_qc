@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Language Manager: Languages
                        <!-- <small>advanced tables</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="language"> Languages</a></li>
                        <li class="active">Recycle Bin</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="form-group" style="float:right;width:40%;">
                                        @if(Session::has('success'))
                                            <div class="alert alert-success alert-dismissable">
                                                <i class="fa fa-check"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                {{Session::get('success')}}
                                            </div>
                                        @endif
                                        @if(Session::has('warning'))
                                            <div class="alert alert-warning alert-dismissable">
                                                <i class="fa fa-warning"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                {{Session::get('warning')}}
                                            </div>
                                        @endif
                                        @if(Session::has('danger'))
                                            <div class="alert alert-danger alert-dismissable">
                                                <i class="fa fa-ban"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                {{Session::get('danger')}}
                                            </div>
                                        @endif
                                    </div>
                	<div class="row">
                        <div class="col-xs-12">
                        <div class="box">
                                <div class="box-header">
                                    <button class="slide_open btn-sm btn-default btn-help"><i class="fa fa-anchor"></i>&nbsp;Help</button>                                      
                                </div><!-- /.box-header -->
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
                                <!-- Start form add new -->
                                <div id="slide" class="well" style="display:none;">
                                    <div class="row" style="width:300px;">
                                    <div class="col-md-12">
                                        <!-- general form elements -->
                                        <div class="box box-success">
                                            <div class="box-header">
                                                <h3 class="box-title">Basic information</h3>
                                            </div><!-- /.box-header
                                            {{HTML::ul($errors->all())}} -->
                                            {{Form::open(array('url'=>'admin/language-create'))}}
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        {{Form::label('language_name','Language Name')}}&nbsp;<font color="#FF0000">*</font>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                                            {{Form::text('language_name',Input::old('language_name'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
                                                        </div>
                                                    </div>
                                                    {{Form::submit('Create',array('class'=>'btn btn-success'))}}
                                                    <button class="slide_close btn btn-default">Close</button>
                                                </div>
                                            {{Form::close()}}
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                @if($errors->first('language_name'))
                                                        <div class="alert alert-danger alert-dismissable" style="position:absolute;right:9px;top:17px;">
                                                            <i class="fa fa-ban"></i>
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                            {{$errors->first('language_name')}}
                                                        </div>
                                                        @endif
                                <!-- End form -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Language name</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                               @foreach($languages as $language) 
                                                <tr>
                                                    <td align="center">{{$language->id}}</td>
                                                    <td><span title="{{$language->language_name}}">{{$language->language_name}}</span></td>
                                                    <td align="center"><a href="{{URL::to('admin/language-revert-'.$language->id)}}" title="Restore"><button class="btn-sm btn-default"><i class="fa fa-undo"></i></button></a></td>
                                                    <td align="center"><a href="{{URL::to('admin/language-destroy-'.$language->id)}}" title="Delete" onclick="return confirm('Are you sure you want to permanently delete this record? \n{{$language->language_name}} \nDate modified: {{$language->updated_at}}')"><button class="btn-sm btn-default"><i class="fa fa-trash-o"></i></button></a></td>
                                                </tr>
                                                @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Language name</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
@stop