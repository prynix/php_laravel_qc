@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                    	Banners
                        <span class="target">in {{$_campaign->campaignname}}</span>
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
                            <strong>Advertiser: </strong>
                            @if($advertiser)
                            	@foreach($advertiser as $advertiser)
                                	{{$advertiser->clientname}}
                                @endforeach()
                            @else
                            @endif
                            <strong>&nbsp;> Campaign: </strong>
                            @if($campaign)
                            	@foreach($campaign as $campaign)
	                                {{$campaign->campaignname}}
                                @endforeach()
                            @else
                            @endif
                        </div>
                    </div>
                </section>
                <!-- Main content -->
                <section class="content">
                	<div class="row">
                        <div class="col-xs-12">
                        <div class="box">
                                <div class="box-header">
                                    <!-- <h3 class="box-title">Data Table With Full Features</h3> -->                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Order No</th>
                                                <th align="left">Name</th>
                                                <th>Status</th>
                                                <!-- <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th> -->
                                                <th></th>
                                                <!--<th></th>
                                                <th></th>
                                                <th></th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($banners as $banner) 
                                            <tr>
                                                <td align="center">{{$banner->order_no}}</td>
                                                <td><a href="{{URL::to('advertiser/banner-show-'.$banner->id)}}" title="">{{$banner->description}}</a></td>
                                                <td align="center">
                                                    @if($banner->status==1)
                                                        <!--{{HTML::image('assets/img/icon/active.png','Active',array('title'=>'Active'))}}-->
                                                        <span class="label label-success">Active</span>
                                                    @else
                                                        <!--{{HTML::image('assets/img/icon/inactive.png','Inactive',array('title'=>'Inactive'))}}--><span class="label label-danger">Banned</span>
                                                    @endif
                                                </td>
                                                <!--@if($banner->id==$first_record->id)
                                                	<td></td>
                                                	<td></td>
                                                @else
                                                	<td align="center"><a href="{{URL::to('admin/banner-move_top-banner-'.$banner->id)}}" title="" id="moveTop">{{HTML::image('assets/img/icon/move_top.png','Move Top',array('title'=>'Move Top','width'=>'16px'))}}</a></td>
                                                	<td align="center"><a href="{{URL::to('admin/banner-move_up-banner-'.$banner->id)}}" title="" id="moveUp">{{HTML::image('assets/img/icon/move_up.png','Move Up',array('title'=>'Move Up','width'=>'20px'))}}</td>
                                                @endif
                                                @if($banner->id==$last_record->id)     
                                                	<td></td>  
                                                	<td></td>                             
                                                @else
                                                	<td align="center"><a href="{{URL::to('admin/banner-move_down-banner-'.$banner->id)}}" title="" id="moveDown">{{HTML::image('assets/img/icon/move_down.png','Move Down',array('title'=>'Move Down','width'=>'20px'))}}</td>
                                                	<td align="center"><a href="{{URL::to('admin/banner-move_bottom-banner-'.$banner->id)}}" title="" id="moveBottom">{{HTML::image('assets/img/icon/move_bottom.png','Move Bottom',array('title'=>'Move Bottom','width'=>'16px'))}}</td>
                                                @endif
                                                <td align="center"><a href="{{URL::to('admin/banner-acl-'.$banner->id)}}" title="">{{HTML::image('assets/img/icon/delivery.png','Banners',array('title'=>'Delivery'))}}&nbsp;Delivery</a></td>
                                                <td align="center"><a href="{{URL::to('admin/banner-zone-'.$banner->id.'-'.$banner->zoneid)}}" title="">{{HTML::image('assets/img/icon/sml-link.png','Linked Zones',array('title'=>'Linked Zones'))}}&nbsp;Linked Zones</a></td>-->
                                                <td align="center"><a href="{{URL::to('advertiser/banner-show-'.$banner->id)}}" title=""><!--{{HTML::image('assets/img/icon/view.png','View',array('title'=>'View'))}}--><i class="fa fa-search"></i></a></td>
                                                <!--<td align="center"><a href="{{URL::to('admin/banner-copy-'.$banner->id)}}" title="">{{HTML::image('assets/img/icon/copy.png','Copy',array('title'=>'Copy'))}}</a></td>
                                                <td align="center"><a href="{{URL::to('admin/banner-edit-'.$banner->id)}}" title="">{{HTML::image('assets/img/icon/icon_edit.png','Edit',array('title'=>'Edit'))}}</a></td>
                                                <td align="center"><a href="{{URL::to('admin/banner-delete-'.$banner->id)}}" title="" onclick="return confirm('Are you sure you want to move this record to the Recycle Bin? \n{{$banner->description}} \nDate modified: {{$banner->updated_at}}')">{{HTML::image('assets/img/icon/delete.png','Delete',array('title'=>'Delete'))}}</a></td>-->
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Order No</th>
                                                <th align="left">Name</th>
                                                <th>Status</th>
                                                <!-- <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>-->
                                                <th></th>
                                                <!--<th></th>
                                                <th></th>
                                                <th></th>-->
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
@stop