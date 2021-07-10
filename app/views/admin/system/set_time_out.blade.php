@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <i class="fa fa-clock-o"></i>&nbsp;Config set time out 
                        <!-- <small>advanced tables</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Set time out</li>
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
                        <div class="col-xs-6">
                        <div class="box">
                        	<div class="box-header margin-10">
                        		<button class="slide_open btn-sm btn-default btn-help"><i class="fa fa-anchor"></i>&nbsp;Help</button>
                        	</div>
                                <div class="box-body table-responsive">
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
                                	<table class="table table-bordered">
                                        <tbody>
                                            <tr> 
                                                <td align="right"><label>Auto delete cache view after</label></td>
                                                <td>
                                                	<input type="number" name="cache_view" class="form-control" value="{{$timeout->cache_view}}" />
                                                </td>
                                                <td><label>seconds</label></td>
                                            </tr>
                                            <tr>
                                                <td align="right"><label>Auto find path error ad file after</label></td>
                                                <td>
                                                	<input type="number" name="find_ad_error" class="form-control" value="{{$timeout->find_ad_error}}"/>
                                                </td>
                                                <td><label>seconds</label></td>
                                            </tr>
                                            <tr>
                                                <td align="right"><label>Auto request and get location from your ip address login after</label></td>
                                                <td>
                                                	<input type="number" name="request_ip" class="form-control" value="{{$timeout->request_ip}}"/>
                                                </td>
                                                <td><label>seconds</label></td>
                                            </tr>
                                            <tr>
                                                <td align="right"><label>Auto backup database on server after</label></td>
                                                <td>
                                                	<input type="number" name="backup_database" class="form-control" value="{{$timeout->backup_database}}"/>
                                                </td>
                                                <td><label>seconds</label></td>
                                                <!-- <td><a href="#myModalBackupDatabase" data-toggle="modal"><button class="btn-sm btn-primary"><i class="fa fa fa-inbox"></i>&nbsp;Config</button></a></td> -->
                                                <!-- Modal Show -->
												<div class="modal fade" id="myModalBackupDatabase"
												tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
												aria-hidden="true">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-body">
																<div class="row">
																	<div class="col-md-12">
																		<!-- general form elements -->
																		<div class="box">
																			<div class="box-header" style="padding-bottom: 0;">
																				<h3 class="box-title"><i class="fa fa-cog"></i>&nbsp;Config database to backup</h3>
																			</div>
																			<div class="box-body">
																				{{Form::open(array('url'=>'admin/save_config_backup_database'))}}
																				<div class="form-group">
																					{{Form::label('hostname','Hostname')}}
										                                            <div class="input-group">
										                                                <span class="input-group-addon"><i class="fa fa-home"></i></span>
										                                                @if(isset($data_backups))
																                        	{{Form::text('hostname',Input::old('hostname',$data_backups->hostname),array('class'=>'form-control'))}}
                                                                                        @else  
                                                                                        	{{Form::text('hostname',Input::old('hostname',''),array('class'=>'form-control'))}}
                                                                                        @endif
										                                            </div>
																				</div>
																				<div class="form-group">
																					{{Form::label('username','Username')}}
										                                            <div class="input-group">
										                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
										                                                @if(isset($data_backups))
									                                            			{{Form::text('username',Input::old('username',$data_backups->username),array('class'=>'form-control'))}}
                                                                                    	@else 
																							{{Form::text('username',Input::old('username',''),array('class'=>'form-control'))}}                                                                        
                                                                                    	@endif   
										                                            </div>
																				</div>
																				<div class="form-group">
																					{{Form::label('password','Password')}}
										                                            <div class="input-group">
										                                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
										                                                @if(isset($data_backups))
										                                            		{{Form::input('password','password',Input::old('password',$data_backups->password),array('class'=>'form-control'))}}
										                                            	@else
										                                            		{{Form::input('password','password',Input::old('password',''),array('class'=>'form-control'))}}
										                                            	@endif
										                                            </div>
																				</div>
																				<div class="form-group">
																					{{Form::label('databasename','Database')}}
										                                            <div class="input-group">
										                                                <span class="input-group-addon"><i class="fa fa-inbox"></i></span>
										                                                @if(isset($data_backups))
										                                            		{{Form::text('databasename',Input::old('databasename',$data_backups->databasename),array('class'=>'form-control'))}}
										                                            	@else
										                                            		{{Form::text('databasename',Input::old('databasename',''),array('class'=>'form-control'))}}
										                                            	@endif
										                                            </div>
																				</div>
																				<button type="submit" class="btn-sm btn-primary"><i class="fa fa-check-circle-o"></i>&nbsp;Save changes</button>
																				<button class="slide_close btn-sm btn-default"
																				data-dismiss="modal">
																					<i class="fa fa-times-circle-o"></i>&nbsp;Close
																				</button>
																				{{Form::close()}}
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<!-- /.modal-content -->
													</div>
													<!-- /.modal-dialog -->
												</div>
												<!-- /.modal -->
                                            </tr>
                                            <tr>
                                                <td align="right"><label>Auto backup site on server after</label></td>
                                                <td>
                                                	<input type="number" name="backup_file" class="form-control" value="{{$timeout->backup_file}}"/>
                                                </td>
                                                <td><label>seconds</label></td>
                                            </tr>
                                            <tr>
                                                <td align="right"><label>Auto scan source code of system after</label></td>
                                                <td>
                                                	<input type="number" name="scan_code" class="form-control" value="{{$timeout->scan_code}}"/>
                                                </td>
                                                <td><label>seconds</label></td>
                                            </tr>
                                            <tr>
                                            	<td colspan="3">
                                            		<button type="submit" class="btn-sm btn-primary">Save changes</button>
                                            	</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    {{Form::close()}}
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
@stop