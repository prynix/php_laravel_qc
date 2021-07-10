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
                </section>
                <!-- Main content -->
                <section class="content">
                	<div class="row">
                        <div class="col-xs-12">
                        <div class="box">
                                <div class="box-header">
                                    <!-- <h3 class="box-title">Data Table With Full Features</h3> -->                                    
                                </div><!-- /.box-header -->
                                <a href="{{URL::to('admin/website-create')}}" style="display:inline-block;margin-left:10px;"><button class="slide_open btn-sm btn-success">Add new website</button></a>
                                <a href="website-recycle" style="display:inline-block;margin-left:10px;"><button class="btn-sm btn-facebook">Recycle Bin</button></a>
                                <div class="box-body table-responsive">
                                    <table id="example3" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th align="left">Name</th>
                                                <th>Status</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                @if(Auth::user()->default_account_id==3)
                                                @else
	                                                <th></th>
	                                                <th></th>
	                                                <th></th>
                                                @endif
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($websites as $website) 
                                                <tr>
                                                    <td align="center">{{$website->id}}</td>
                                                    <td><a href="{{URL::to('admin/website-edit-'.$website->id)}}" title="">{{$website->name}}</a></td>
                                                    <td align="center">
                                                    	@if($website->status==1)
                                                    		<span class="label label-success">Active</span>
                                                    	@else
                                                    		<span class="label label-danger">Banned</span>
                                                    	@endif
                                                    </td>
                                                    <td align="center"><a href="{{URL::to('admin/rss-feed-'.$website->id)}}">{{HTML::image('assets/img/icon/rss-20.png','RSS Feed',array('title'=>'RSS Feed','width'=>'16px'))}}&nbsp;RSS Feed</a></td>
                                                    <td align="center">
                                                    	@if($website->status==1)
                                                    		<a href="{{URL::to('admin/website-topic-'.$website->id)}}" title="">
                                                    			{{HTML::image('assets/img/icon/category.png','List of topics',array('title'=>'List of topics','width'=>'16px'))}}&nbsp;List of topics
                                                    		</a>
                                                    	@else
                                                    		{{HTML::image('assets/img/icon/category-20.png','List of topics',array('title'=>'List of topics','width'=>'16px'))}}&nbsp;List of topics
                                                    	@endif
                                                    </td>
                                                    <td align="center"><a href="{{URL::to('admin/website-partner-'.$website->id)}}">{{HTML::image('assets/img/icon/acquisition.png','Partners',array('title'=>'Partners','width'=>'20px'))}}&nbsp;Partners</a></td>
                                                    <td align="center"><a href="{{URL::to('admin/website-click_stats-'.$website->id)}}">{{HTML::image('assets/img/icon/statistics.png','Click Stats',array('title'=>'Click Stats','width'=>'16px'))}}&nbsp;Click Stats</a></td>
                                                    <td align="center"><a href="{{URL::to('admin/website-stats-'.$website->id)}}">{{HTML::image('assets/img/icon/seo_performance.png','Stats',array('title'=>'Stats','width'=>'16px'))}}&nbsp;Stats</a></td>
                                                    @if(Auth::user()->default_account_id==3)
                                                    @else
                                                    	<td align="center" style="font-weight:bold;"><a href="{{URL::to('admin/zone-create')}}">{{HTML::image('assets/img/icon/gray-add-to-list-icon.png','Add new zone',array('title'=>'Add new zone'))}}&nbsp;Add new zone</a></td>
                                                    	<td align="center" style="font-weight:bold;"><a href="{{URL::to('admin/website-zone-'.$website->id)}}">{{HTML::image('assets/img/icon/plcaement_linked.png','Zones',array('title'=>'Zones'))}}Zones</a></td>
                                                    	<td align="center" style="font-weight:bold;"><a href="{{URL::to('admin/website-channel-'.$website->id)}}">{{HTML::image('assets/img/icon/channel_close-20.png','Zones',array('title'=>'Zones'))}}Targeting Channels</a></td>
                                                    @endif
                                                    <td align="center"><a href="{{URL::to('admin/website-show-'.$website->id)}}" title="">{{HTML::image('assets/img/icon/view.png','View',array('title'=>'View'))}}</a></td>
                                                    <td align="center"><a href="{{URL::to('admin/website-copy-'.$website->id)}}" title=""> <!-- class="slide_open" -->{{HTML::image('assets/img/icon/copy.png','Copy',array('title'=>'Copy'))}}</a></td>
                                                    <td align="center"><a href="{{URL::to('admin/website-edit-'.$website->id)}}" title="">{{HTML::image('assets/img/icon/icon_edit.png','Edit',array('title'=>'Edit'))}}</a></td>
                                                    <td align="center"><a href="{{URL::to('admin/website-delete-'.$website->id)}}" title="" onclick="return confirm('Are you sure you want to move this record to the Recycle Bin? \n{{$website->name}} \nDate modified: {{$website->updated_at}}');">{{HTML::image('assets/img/icon/delete.png','Delete',array('title'=>'Delete'))}}</a></td>
                                                </tr>
                                            @endforeach   
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th align="left">Name</th>
                                                <th>Status</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                @if(Auth::user()->default_account_id==3)
                                                @else
	                                                <th></th>
	                                                <th></th>
	                                                <th></th>
                                                @endif
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