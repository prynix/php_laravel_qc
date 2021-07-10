@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Ad Help Manager: Uri Segments
                        <!-- <small>advanced tables</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="help#tab-1">Uri Segments</a></li>
                        <li class="active">Recycle Bin</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                	<div class="row">
                        <div class="col-xs-12">
                        <div class="box">
                                <div class="box-body table-responsive">
                                    <table id="example2"
							class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>ID</th>
										<th align="left">Uri Segment</th>
										<th>Actions</th>
									</tr>
								</thead>
                                        <tbody>
                                        	@foreach($uri as $uri)
									<tr>
										<td align="center">{{$uri->id}}</td>
										<td>{{$uri->uri_segment}}</td>
										<td align="center"><a href="{{URL::to('admin/uri-revert-'.$uri->id)}}" title="Restore">
										<button class="btn-sm btn-success">
											<i class="fa fa-undo"></i>
										</button></a><a href="{{URL::to('admin/uri-destroy-'.$uri->id)}}" title="Delete">
										<button class="btn-sm btn-danger" onclick="return confirm('Are you sure you want to permanently delete this record? \n{{$uri->uri_segment}} \nDate modified: {{$uri->updated_at}}')">
											<i class="fa fa-trash-o"></i>
										</button></a></td>
									</tr>
									@endforeach
                                        </tbody>
                                        <tfoot>
									<tr>
										<th>ID</th>
										<th align="left">Uri Segment</th>
										<th>Actions</th>
									</tr>
								</tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
@stop