@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Banner Manager: Banners
                        @if($campaign)
                            in <a href="{{URL::to('admin/campaign-edit-'.$campaign->id)}}" title="">{{$campaign->campaignname}}</a>
                        @else
                        @endif
                        <!-- <small>advanced tables</small> -->
                    </h1>
<!--
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Banners</li>
                    </ol>
-->
                    <br/>
                    <div class="row">
                        <div class="col-xs-4">
                            <select class="form-control" id="website_id" disabled="disabled">
                                <option value="" disabled selected>-- Choose website --</option>
                                @foreach($websites as $website)
                                    <option value="{{$website->id}}">{{ $website->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-4">
                            <select class="form-control" id="zoneid">
                                <option value="" disabled selected>-- Choose zone --</option>
                                @foreach($zones as $zone)
                                    <option value="{{$zone->id}}">{{ $zone->zonename }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
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
                                        <a href="banner-create" id="addNewBanner"><button class="btn-sm btn-success"><i class="fa fa-plus"></i>&nbsp;Add new banner</button></a>
                                        <a href="banner-recycle" class="recycle" id="bannerRecycle"><button class="btn-sm btn-facebook"><i class="fa fa-crop"></i>&nbsp;Recycle Bin</button></a>
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
                                                <th>Ability to display</th>
                                                <th align="left">Name</th>
                                                <th>Status</th>
                                                <!-- <th></th> -->
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($banners as $banner) 
                                            <tr>
												<td align="center">{{$banner->order_no}}</td>
                                                <td align="center">
                                                    @if($banner->mark==1)
                                                        <span class="label label-success"><i class="fa fa-check-circle"></i></span>
                                                    @else
                                                        <span class="label label-danger"><i class="fa fa-times-circle"></i></span>
                                                    @endif
                                                </td>
                                                <td><a href="{{URL::to('admin/banner-edit-'.$banner->id)}}" title="{{$banner->description}}">{{$banner->description}}</a></td>
                                                <td align="center">
                                                    @if($banner->status==1)
                                                        <span class="label label-success">Active</span>
                                                    @else
                                                        <span class="label label-danger">Banned</span>
                                                    @endif
                                                </td>
                                                <td align="center">
                                                @if($banner->id==$first_record->id)
                                                	
                                                @else
                                                	<a href="{{URL::to('admin/banner-move_top-Banner-'.$banner->id)}}" title="Move top" id="moveTop"><button class="btn-sm btn-default"><i class="fa fa-long-arrow-up"></i></button></a>
                                                	<a href="{{URL::to('admin/banner-move_up-Banner-'.$banner->id)}}" title="Move up" id="moveUp"><button class="btn-sm btn-default"><i class="fa fa-arrow-up"></i></button></a>
                                                @endif
                                                @if($banner->id==$last_record->id)     
                                                	                             
                                                @else
                                                	<a href="{{URL::to('admin/banner-move_down-Banner-'.$banner->id)}}" title="Move down" id="moveDown"><button class="btn-sm btn-default"><i class="fa fa-arrow-down"></i></button></a>
                                                	<a href="{{URL::to('admin/banner-move_bottom-Banner-'.$banner->id)}}" title="Move bottom" id="moveBottom"><button class="btn-sm btn-default"><i class="fa fa-long-arrow-down"></i></button></a>
                                                @endif
                                                </td>
                                                <!-- <td align="center"><a href="{{URL::to('admin/banner-acl-'.$banner->id)}}" title="">{{HTML::image('assets/img/icon/delivery.png','Banners',array('title'=>'Delivery'))}}&nbsp;Delivery</a></td> -->
                                                <td align="center"><a href="{{URL::to('admin/banner-zone-'.$banner->id.'-'.$banner->zoneid)}}" title="Link to Zone"><i class="fa fa-external-link"></i>&nbsp;Linked Zones</a></td>
                                                <td align="center"><a href="{{URL::to('admin/banner-show-'.$banner->id)}}" title="Show"><button class="btn-sm btn-default">
											<i class="fa fa-search-plus"></i>
										</button></a>
                                                <a href="{{URL::to('admin/banner-copy-'.$banner->id)}}" title="Copy"><button class="btn-sm btn-default">
											<i class="fa fa-copy"></i>
										</button></a>
                                                <a href="{{URL::to('admin/banner-edit-'.$banner->id)}}" title="Edit"><button class="btn-sm btn-default">
											<i class="fa fa-edit"></i>
										</button></a>
                                                <a href="{{URL::to('admin/banner-delete-'.$banner->id)}}" title="Delete"><button class="btn-sm btn-default" onclick="return confirm('Are you sure you want to move this record to the Recycle Bin? \n{{$banner->description}} \nDate modified: {{$banner->updated_at}}')"><i class="fa fa-trash-o"></i></button></a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Order No</th>
                                                <th>Ability to display</th>
                                                <th align="left">Name</th>
                                                <th>Status</th>
                                                <!-- <th></th> -->
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