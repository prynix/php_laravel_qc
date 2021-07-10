@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Campaigns<span class="target"> of </span>
                        					@foreach($advertisers as $advertiser)
                                            @foreach($campaigns as $campaign) 
                                                @if($campaign->clientid==$advertiser->id)
                                                    <a>{{ $advertiser->clientname }}</a>
                                                @else
                                                @endif
                                            @endforeach
                                            @endforeach
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Campaigns</li>
                    </ol>
                    <br/>
                    <div class="row">
                        <div class="col-xs-4">
                            <!--<select class="form-control" id="clientid">-->
                                <!--<option value="" disabled selected>-- Choose advertiser --</option>-->
                                @foreach($advertisers as $ad)
                                    <!--<option value="{{$ad->id}}" selected="selected">--><strong>Advertiser: </strong>{{ $ad->clientname }}<!--</option>-->
                                @endforeach
                            <!--</select>-->
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
                                            	<th>ID</th>
                                                <th align="left">Name</th>
                                                <th>Status</th>
                                                <th align="left">Type</th>
                                                <th>Expire Date</th>
                                                @if($advertiser)
                                                    <!-- <th></th> -->
                                                @else
                                                @endif
                                                <th></th>
                                                <!--<th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>-->
                                                <th></th>
                                                <!--<th></th>
                                                <th></th>
                                                <th></th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($campaigns as $campaign) 
                                            <tr>
                                            	<td align="center">{{$campaign->id}}</td>
                                                <td><a href="{{URL::to('advertiser/campaign-show-'.$campaign->id)}}" title="">{{$campaign->campaignname}}</a></td>
                                                <td align="center">
                                                    @if($campaign->status==1)
                                                        {{HTML::image('assets/img/icon/running-20.png','Running',array('title'=>'Running'))}}
                                                    @else
                                                        {{HTML::image('assets/img/icon/loadingdata.gif','Waiting',array('title'=>'Waiting'))}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($campaign->campaign_type==1)
                                                        Remnant
                                                    @elseif($campaign->campaign_type==2)
                                                        Contract
                                                    @else
                                                        Contract (Exclusive)
                                                    @endif
                                                </td>
                                                <td align="center">
                                                    @if($campaign->expire=='')
                                                        <span class="label label-warning">Don't expire</span>
                                                    @elseif($campaign->expire<date('Y-m-d'))
                                                        <span class="label label-danger">{{$campaign->expire}}</span>
                                                    @elseif($campaign->expire>date('Y-m-d'))
                                                        <span class="label label-success">{{$campaign->expire}}</span>
                                                    @endif
                                                </td>
                                                @if($advertiser)
                                                <!-- <td align="center">
                                                    <a href="{{URL::to('advertiser/banner-create-'.$campaign->id)}}" title="">{{HTML::image('assets/img/icon/add-tab-group.png','Add new banner',array('title'=>'Add new banner'))}}&nbsp;Add new banner</a>
                                                </td> -->
                                                @else
                                                @endif
                                                <td align="center"><a href="{{URL::to('advertiser/banner-of_campaign-'.$campaign->id)}}" title=""><i class="fa fa-picture-o"></i>&nbsp;Banners</a></td>
                                                <!--@if($campaign->id==$first_record->id)
                                                	<td></td>
                                                	<td></td>
                                                @else
                                                	<td align="center"><a href="{{URL::to('advertiser/campaign-move_top-campaign-'.$campaign->id)}}" title="" id="moveTop">{{HTML::image('assets/img/icon/move_top.png','Move Top',array('title'=>'Move Top','width'=>'16px'))}}</a></td>
                                                	<td align="center"><a href="{{URL::to('advertiser/campaign-move_up-campaign-'.$campaign->id)}}" title="" id="moveUp">{{HTML::image('assets/img/icon/move_up.png','Move Up',array('title'=>'Move Up','width'=>'20px'))}}</td>
                                                @endif
                                                @if($campaign->id==$last_record->id)     
                                                	<td></td>  
                                                	<td></td>                             
                                                @else
                                                	<td align="center"><a href="{{URL::to('advertiser/campaign-move_down-campaign-'.$campaign->id)}}" title="" id="moveDown">{{HTML::image('assets/img/icon/move_down.png','Move Down',array('title'=>'Move Down','width'=>'20px'))}}</td>
                                                	<td align="center"><a href="{{URL::to('advertiser/campaign-move_bottom-campaign-'.$campaign->id)}}" title="" id="moveBottom">{{HTML::image('assets/img/icon/move_bottom.png','Move Bottom',array('title'=>'Move Bottom','width'=>'16px'))}}</td>
                                                @endif-->
                                                <td align="center"><a href="{{URL::to('advertiser/campaign-show-'.$campaign->id)}}" title=""><!--{{HTML::image('assets/img/icon/view.png','View',array('title'=>'View'))}}--><i class="fa fa-search"></i></a></td>
                                                <!--<td align="center"><a href="{{URL::to('advertiser/campaign-copy-'.$campaign->id)}}" title="">{{HTML::image('assets/img/icon/copy.png','Copy',array('title'=>'Copy'))}}</a></td>
                                                <td align="center"><a href="{{URL::to('advertiser/campaign-edit-'.$campaign->id)}}" title="">{{HTML::image('assets/img/icon/icon_edit.png','Edit',array('title'=>'Edit'))}}</a></td>
                                                <td align="center"><a href="{{URL::to('advertiser/campaign-delete-'.$campaign->id)}}" title="" onclick="return confirm('Are you sure you want to move this record to the Recycle Bin? \n{{$campaign->campaignname}} \nDate modified: {{$campaign->updated_at}}')">{{HTML::image('assets/img/icon/delete.png','Delete',array('title'=>'Delete'))}}</a></td>-->
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            	<th>ID</th>
                                                <th align="left">Name</th>
                                                <th>Status</th>
                                                <th align="left">Type</th>
                                                <th>Expire Date</th>
                                                @if($advertiser)
                                                    <!-- <th></th> -->
                                                @else
                                                @endif
                                                <th></th>
                                                <!--<th></th>
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