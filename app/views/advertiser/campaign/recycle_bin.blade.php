@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Campaign Manager: Campaigns
                        <!-- <small>advanced tables</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="campaign"> Campaigns</a></li>
                        <li class="active">Recycle Bin</li>
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
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th align="left">Name</th>
                                                <th align="center">Status</th>
                                                <th align="left">Type</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($campaigns as $campaign) 
                                            <tr>
                                                <td><a href="{{URL::to('admin/campaign-edit-'.$campaign->id)}}" title="">{{$campaign->campaignname}}</a></td>
                                                <td align="center">
                                                    @if($campaign->status==1)
                                                        {{HTML::image('assets/img/icon/running-20.png','Running',array('title'=>'Running'))}}
                                                    @else
                                                        {{HTML::image('assets/img/icon/loadingdata.gif','Waiting',array('title'=>'Waiting'))}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($campaign->revenue_type==1)
                                                        Remnant
                                                    @elseif($campaign->revenue_type==2)
                                                        Contract
                                                    @else
                                                        Contract (Exclusive)
                                                    @endif
                                                </td>
                                                <td align="center"><a href="{{URL::to('admin/campaign-revert-'.$campaign->id)}}" title="">{{HTML::image('assets/img/icon/revert.png','Revert',array('title'=>'Revert'))}}</a></td>
                                                <td align="center"><a href="{{URL::to('admin/campaign-detroy-'.$campaign->id)}}" title="" onclick="return confirm('Are you sure you want to permanently delete this record? \n{{$campaign->campaignname}} \nDate modified: {{$campaign->updated_at}}')">{{HTML::image('assets/img/icon/delete_warning.png','Delete',array('title'=>'Delete'))}}</a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th align="left">Name</th>
                                                <th align="center">Status</th>
                                                <th align="left">Type</th>
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