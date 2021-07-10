@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> Campaign Manager: Campaigns
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
        <div class="box-header">
          <button class="slide_open btn-sm btn-default btn-help"><i class="fa fa-anchor"></i>&nbsp;Help</button>
        </div>
        <!-- /.box-header -->
        <div id="slide" class="well" style="display:none;top:15%;width:30%;height:80%;bottom:5%;right:45%;left:25%;">
          <div id="widget">
            <div id="header">
              <input type="text" id="search" placeholder="Search in the text" />
            </div>
            <div id="content"> @if(isset($help))
              @foreach($help as $help)
              @if(Session::get('language',Config::get('app.locale'))=='en')
              {{$help->content_helper_en}}
              @elseif(Session::get('language',Config::get('app.locale'))=='vi')
              {{$help->content_helper_vi}}
              @endif
              @endforeach()
              @else
              @endif </div>
          </div>
        </div>
        <div class="box-body table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th align="left">Name</th>
                <th align="center">Status</th>
                <th align="left">Type</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            
            @foreach($campaigns as $campaign)
            <tr>
              <td><a href="{{URL::to('admin/campaign-edit-'.$campaign->id)}}" title="{{$campaign->campaignname}}">{{$campaign->campaignname}}</a></td>
              <td align="center"> @if($campaign->status==1)
								<!-- {{HTML::image('assets/img/icon/running-20.png','Running',array('title'=>'Running'))}} -->
								<span class="label label-success">Active</span>
								@else
								<!-- {{HTML::image('assets/img/icon/loadingdata.gif','Waiting',array('title'=>'Waiting'))}} -->
								<span class="label label-warning">Pending</span>
								@endif </td>
              <td> @if($campaign->revenue_type==1)
                Remnant
                @elseif($campaign->revenue_type==2)
                Contract
                @else
                Contract (Exclusive)
                @endif </td>
              <td align="center"><a href="{{URL::to('admin/campaign-revert-'.$campaign->id)}}" title="Restore"><button class="btn-sm btn-default">
											<i class="fa fa-undo"></i>
										</button></a>
              <a href="{{URL::to('admin/campaign-detroy-'.$campaign->id)}}" title="Delete"><button class="btn-sm btn-default" onclick="return confirm('Are you sure you want to permanently delete this record? \n{{$campaign->campaignname}} \nDate modified: {{$campaign->updated_at}}')"><i class="fa fa-trash-o"></i></button></a></td>
            </tr>
            @endforeach
            </tbody>
            
            <tfoot>
              <tr>
                <th align="left">Name</th>
                <th align="center">Status</th>
                <th align="left">Type</th>
                <th></th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->
@stop