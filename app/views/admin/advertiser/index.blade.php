@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Advertiser Manager: Advertisers 
                        <!-- <small>advanced tables</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Advertisers</li>
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
                                <div class="box-body table-responsive">
                                	<div class="form-group">
                                        <a href="advertiser-create"><button class="btn-sm btn-success"><i class="fa fa-plus"></i>&nbsp;Add new advertiser</button></a>
                                        <a href="advertiser-recycle" class="recycle"><button class="btn-sm btn-facebook"><i class="fa fa-crop"></i>&nbsp;Recycle Bin</button></a>
                                        <button class="slide_open btn-sm btn-default btn-help no-margin-top no-margin-right"><i class="fa fa-anchor"></i>&nbsp;Help</button>
                                    </div>
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
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th>Order No</th>
                                                <th align="left">Name</th>
                                                <th>Is Customer from</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($advertisers as $advertiser) 
                                            <tr>
                                            	<td align="center">{{$advertiser->order_no}}</td>
                                                <td><a href="{{URL::to('admin/advertiser-edit-'.$advertiser->id)}}" title="{{$advertiser->clientname}}">{{$advertiser->clientname}}</a></td>
                                                <td align="center">{{$advertiser->created_at}}</td>
                                                <td align="center"><a href="{{URL::to('admin/campaign-create-'.$advertiser->id)}}" title="Add new campaign"><i class="fa fa-indent"></i>&nbsp;Add new campaign</a></td>
                                                <td align="center"><a href="{{URL::to('admin/campaign-advertiser-'.$advertiser->id)}}" title="Campaigns"><i class="fa fa-calendar-o"></i>&nbsp;Campaigns</a></td>
                                                <td align="center">
                                                @if($advertiser->id==$first_record->id)
                                                	
                                                @else
                                                	<a href="{{URL::to('admin/advertiser-move_top-Advertiser-'.$advertiser->id)}}" title="Move top"><button class="btn-sm btn-default"><i class="fa fa-long-arrow-up"></i></button></a>
                                                	<a href="{{URL::to('admin/advertiser-move_up-Advertiser-'.$advertiser->id)}}" title="Move up"><button class="btn-sm btn-default"><i class="fa fa-arrow-up"></i></button></a>
                                                @endif
                                                @if($advertiser->id==$last_record->id)     
                                                	                             
                                                @else
                                                	<a href="{{URL::to('admin/advertiser-move_down-Advertiser-'.$advertiser->id)}}" title="Move down"><button class="btn-sm btn-default"><i class="fa fa-arrow-down"></i></button></a>
                                                	<a href="{{URL::to('admin/advertiser-move_bottom-Advertiser-'.$advertiser->id)}}" title="Move bottom"><button class="btn-sm btn-default"><i class="fa fa-long-arrow-down"></i></button></a>
                                                @endif
                                                </td>
                                                <td align="center"><a href="{{URL::to('admin/advertiser-show-'.$advertiser->id)}}" title="Show"><button class="btn-sm btn-default">
											<i class="fa fa-search-plus"></i>
										</button></a>
                                                <a href="{{URL::to('admin/advertiser-copy-'.$advertiser->id)}}" title="Copy"><button class="btn-sm btn-default">
											<i class="fa fa-copy"></i>
										</button></a>
                                                <a href="{{URL::to('admin/advertiser-edit-'.$advertiser->id)}}" title="Edit"><button class="btn-sm btn-default">
											<i class="fa fa-edit"></i>
										</button></a>
                                                <a href="{{URL::to('admin/advertiser-delete-'.$advertiser->id)}}" title="Delete"><button class="btn-sm btn-default" onclick="return confirm('Are you sure you want to move this record to the Recycle Bin? \n{{$advertiser->clientname}} \nDate modified: {{$advertiser->updated_at}}')"><i class="fa fa-trash-o"></i></button></a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            	<th>Order No</th>
                                                <th align="left">Name</th>
                                                <th>Is Customer from</th>
                                                <th></th>
                                                <th></th>
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