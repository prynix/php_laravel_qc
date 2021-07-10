@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Website Manager: Websites
                        <!-- <small>advanced tables</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Websites</li>
                    </ol>
                    <br/>
                    <div class="row">
                        <div class="col-xs-4">
                            <select class="form-control" id="campaignid">
                                <option value="" disabled selected>-- Choose campaign --</option>
                                @if(isset($campaigns))
                                    @foreach($campaigns as $campaign)
                                        <option value="{{$campaign->id}}">{{ $campaign->campaignname }}</option>
                                    @endforeach
                                @else
                                @endif
                            </select>
                        </div>
                    </div>
                </section>
                <!-- Main content -->
                <section class="content">
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
                	<div class="row">
                        <div class="col-xs-12">
                        <div class="box">
                                <div class="box-body table-responsive">
                                	<div class="form-group">
                                        <a href="{{URL::to('admin/website-create')}}" id="addNewWebsite"><button class="btn-sm btn-success"><i class="fa fa-plus"></i>&nbsp;Add new website</button></a>
                                        <a href="website-recycle" class="recycle" id="websiteRecycle"><button class="btn-sm btn-facebook"><i class="fa fa-crop"></i>&nbsp;Recycle Bin</button></a>
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
                                    <table id="example3" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Order No</th>
                                                <th align="left">Name</th>
                                                <th>Status</th>
                                                <th></th>
	                                            <th></th>
	                                            <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($websites as $website)
                                                <tr>
                                                    <td align="center">{{$website['order_no']}}</td>
                                                    <td><a href="{{URL::to('admin/website-edit-'.$website['id'])}}" title="{{$website['name']}}">{{$website['name']}}</a></td>
                                                    <td align="center">
                                                    	@if($website['status']==1)
                                                    		<span class="label label-success">Active</span>
                                                    	@else
                                                    		<span class="label label-danger">Banned</span>
                                                    	@endif
                                                    </td>
                                                    	<td align="center"><a href="{{URL::to('admin/zone-create-'.$website['id'])}}" title="Add new zone"><i class="fa fa-indent"></i>&nbsp;Add new zone</a></td>
                                                    	<td align="center"><a href="{{URL::to('admin/zone-website-'.$website['id'])}}" title="Zones"><i class="fa fa-puzzle-piece"></i>&nbsp;Zones</a></td>
                                                    	<td align="center"><a href="{{URL::to('admin/channel-website-'.$website['id'])}}" title="Targeting Channels"><i class="fa fa-desktop"></i>&nbsp;Targeting Channels</a></td>
                                                <td align="center">
                                                <?php //echo '<pre/>'; print_r($first_record->toArray()[0]['id']); die(); ?>
                                                    @if($website['id']==$first_record->toArray()[0]['id'])
                                                    @else
                                                    	<a href="{{URL::to('admin/website-move_top-Website-'.$website['id'])}}" title="Move top" id="moveTop"><button class="btn-sm btn-default"><i class="fa fa-long-arrow-up"></i></button></a>
                                                    	<a href="{{URL::to('admin/website-move_up-Website-'.$website['id'])}}" title="Move up" id="moveUp"><button class="btn-sm btn-default"><i class="fa fa-arrow-up"></i></button></a>
                                                    @endif
                                                    @if($website['id']==$last_record->toArray()[0]['id'])                         
                                                    @else
                                                    	<a href="{{URL::to('admin/website-move_down-Website-'.$website['id'])}}" title="Move down" id="moveDown"><button class="btn-sm btn-default"><i class="fa fa-arrow-down"></i></button></a>
                                                    	<a href="{{URL::to('admin/website-move_bottom-Website-'.$website['id'])}}" title="Move bottom" id="moveBottom"><button class="btn-sm btn-default"><i class="fa fa-long-arrow-down"></i></button></a>
                                                    @endif
                                                </td>
                                                    <td align="center"><a href="{{URL::to('admin/website-show-'.$website['id'])}}" title="Show"><button class="btn-sm btn-default">
											<i class="fa fa-search-plus"></i>
										</button></a>
                                                    <a href="{{URL::to('admin/website-copy-'.$website['id'])}}" title="Copy"><button class="btn-sm btn-default">
											<i class="fa fa-copy"></i>
										</button></a>
                                                    <a href="{{URL::to('admin/website-edit-'.$website['id'])}}" title="Edit"><button class="btn-sm btn-default">
											<i class="fa fa-edit"></i>
										</button></a>
                                                    <a href="{{URL::to('admin/website-delete-'.$website['id'])}}" title="Delete"><button class="btn-sm btn-default" onclick="return confirm('Are you sure you want to move this record to the Recycle Bin? \n{{$website['name']}} \nDate modified: {{$website['updated_at']}}');"><i class="fa fa-trash-o"></i></button></a></td>
                                                </tr>
                                            @endforeach   
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Order No</th>
                                                <th align="left">Name</th>
                                                <th>Status</th>
                                                <th></th>
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