@extends('layout.main')
@section('content')   
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1> <i class="fa fa-adn"></i>&nbsp;Ad Form Manager: Ad Forms <!-- <small>advanced tables</small> --></h1>
	<ol class="breadcrumb">
		<li>
			<a href="dashboard"><i class="fa fa-dashboard"></i> Home</a>
		</li>
		<li class="active">
			Ad Forms
		</li>
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
			<div class="box box-primary">
				<div id="slide" class="well" style="display:none;width:40%;">
					<div class="row">
						<div class="col-md-12">
							<!-- general form elements -->
							<div class="box box-primary">
								<div class="box-header" style="padding-bottom:0;">
									<h3 class="box-title">Add New Ad Form</h3>
								</div><!-- /.box-header -->
                                {{Form::open(array('url'=>'admin/adform-create'))}}
                                <div class="box-body">
                                    <div class="form-group">
                                        {{Form::label('form_name','Name')}}&nbsp;<font color="#FF0000">*</font>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-adn"></i></span>
                                            {{Form::text('form_name',Input::old('form_name'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
                                        </div>
                                        @if($errors->first('form_name'))
                                        <div class="alert alert-danger alert-dismissable">
                                            <i class="fa fa-ban"></i>
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                &times;
                                            </button>
                                            {{$errors->first('form_name')}}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('form_desc','Description')}}
                                        {{Form::textarea('form_desc',Input::old('form_desc'),array('class'=>'ckeditor form-control','placeholder'=>'Enter ...','style'=>'display:none !important;'))}}
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn-sm btn-success"><i class="fa fa-check-circle-o"></i>&nbsp;Save & New</button>
                                </div>
                                {{Form::close()}}
							</div>
						</div>
					</div>
				</div>
				<div class="box-body table-responsive">
                	<div class="form-group">
                        <a href="{{URL::to('admin/adform-create')}}">
                        <button class="slide_open btn-sm btn-success">
                            <i class="fa fa-plus"></i>&nbsp;Add new ad form
                        </button></a>
                        <a href="adform-recycle" class="recycle">
                        <button class="btn-sm btn-facebook">
                            <i class="fa fa-crop"></i>&nbsp;Recycle Bin
                        </button></a>
                        <a href="#myModalHelp" title="Help" data-toggle="modal"><button class="btn-sm btn-default btn-help margin-left-5 no-margin-top no-margin-right"><i class="fa fa-anchor"></i>&nbsp;Help</button></a>
                    </div>
                    <div class="modal fade" id="myModalHelp"
							tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
							aria-hidden="true">
								    <div class="modal-dialog">
									   <div class="modal-content">
										  <div class="modal-body">
                                                <div class="well">
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
                                           </div>
                                        </div>
                                    </div>
                                </div>
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Order No</th>
								<th>Form</th>
								<th>Description</th>
                                <th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
						<tfoot>
							<tr>
								<th>Order No</th>
								<th>Form</th>
								<th>Description</th>
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