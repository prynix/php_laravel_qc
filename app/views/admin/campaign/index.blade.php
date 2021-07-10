@extends('layout.main') @section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> Campaign Manager: Campaigns @if($advertiser) of <a
		href="{{URL::to('admin/advertiser-edit-'.$advertiser->id)}}" title="">{{$advertiser->clientname}}</a> @else @endif </h1>
  <ol class="breadcrumb">
    <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Campaigns</li>
  </ol>
  <br />
  <div class="row">
    <div class="col-xs-4">
      <select class="form-control" id="clientid">
        <option value="" disabled selected>-- Choose advertiser --</option>
        

			@foreach($advertisers as $ad)

			
        <option value="{{$ad->id}}">{{ $ad->clientname }}</option>
        

			@endforeach

		
      </select>
    </div>
  </div>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- Statistic -->
    <div class="col-lg-4 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3> {{$longer_term}} </h3>
          <p> Longer term </p>
        </div>
        <div class="icon" style="height:128px;"> <i class="fa fa-check-circle-o"></i> </div>
        <a href="../admin/campaign-longer_term" class="small-box-footer"> More info <i class="fa fa-arrow-circle-right"></i> </a> </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3> {{$expired}} </h3>
          <p> Expired </p>
        </div>
        <div class="icon" style="height:128px;"> <i class="fa fa-times-circle-o"></i> </div> 
        <a href="../admin/campaign-expired" class="small-box-footer"> More info <i class="fa fa-arrow-circle-right"></i> </a> </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-orange">
        <div class="inner">
          <h3> {{$dont_expire}} </h3>
          <p> Don't expire </p>
        </div>
        <div class="icon" style="height:128px;"> <i class="fa fa-question-circle"></i> </div>
        <a href="../admin/campaign-dont_expire" class="small-box-footer"> More info <i class="fa fa-arrow-circle-right"></i> </a> </div>
    </div>
    <!-- ./col -->
    <div class="col-xs-12">
          <div class="form-group"> @if(Session::has('success'))
            <div class="alert alert-success alert-dismissable"> <i class="fa fa-ban"></i>
              <button type="button" class="close" data-dismiss="alert"
              aria-hidden="true">&times;</button>
              {{Session::get('success')}} </div>
            @endif @if(Session::has('warning'))
            <div class="alert alert-warning alert-dismissable"> <i class="fa fa-ban"></i>
              <button type="button" class="close" data-dismiss="alert"
              aria-hidden="true">&times;</button>
              {{Session::get('warning')}} </div>
            @endif @if(Session::has('danger'))
            <div class="alert alert-danger alert-dismissable"> <i class="fa fa-ban"></i>
              <button type="button" class="close" data-dismiss="alert"
              aria-hidden="true">&times;</button>
              {{Session::get('danger')}} </div>
            @endif </div>
      <div class="box">
        <div class="box-body table-responsive">
          <div class="form-group"> <a href="" id="addNewCampaign">
            <button class="btn-sm btn-success"> <i class="fa fa-plus"></i>&nbsp;Add new campaign </button>
            </a> <a href="campaign-recycle" class="recycle"
						id="campaignRecycle">
            <button class="btn-sm btn-facebook"> <i class="fa fa-crop"></i>&nbsp;Recycle Bin </button>
            </a>
            <button
						class="slide_open btn-sm btn-default btn-help no-margin-top no-margin-right"> <i class="fa fa-anchor"></i>&nbsp;Help </button>
          </div>
          <div id="slide" class="well"
					style="display: none; top: 15%; width: 30%; height: 80%; bottom: 5%; right: 45%; left: 25%;">
            <div id="widget">
              <div id="header">
                <input type="text" id="search" placeholder="Search in the text" />
              </div>
              <div id="content">@if(isset($help)) @foreach($help as $help)
                @if(Session::get('language',Config::get('app.locale'))=='en')
                {{$help->content_helper_en}}
                @elseif(Session::get('language',Config::get('app.locale'))=='vi')
                {{$help->content_helper_vi}} @endif @endforeach() @else @endif</div>
            </div>
          </div>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Order No</th>
                <th align="left">Name</th>
                <th>Status</th>
                <th align="left">Type</th>
                <th>Expire Date</th>
                @if($advertiser)
                <!-- <th></th> -->
                @else @endif
                <th></th>
                @if(count($campaigns)>1)
                <th></th>
                @else
                @endif
                <th></th>
              </tr>
            </thead>
            <tbody>
            
            @foreach($campaigns as $campaign)
            <tr>
              <td align="center">{{$campaign->order_no}}</td>
              <td><a href="{{URL::to('admin/campaign-edit-'.$campaign->id)}}"
								title="{{$campaign->campaignname}}">{{$campaign->campaignname}}</a></td>
              <td align="center">@if($campaign->status==1)
                <!-- {{HTML::image('assets/img/icon/running-20.png','Running',array('title'=>'Running'))}} -->
                <span class="label label-success">Active</span> @else
                <!-- {{HTML::image('assets/img/icon/loadingdata.gif','Waiting',array('title'=>'Waiting'))}} -->
                <span class="label label-warning">Pending</span> @endif</td>
              <td>@if($campaign->campaign_type==1) Remnant
                @elseif($campaign->campaign_type==2) Contract @else Contract
                (Exclusive) @endif</td>
              <td align="center">@if($campaign->expire=='') <span
								class="label label-warning">Don't expire</span> @elseif($campaign->expire<date
									('Y-m-d'))
                                                        <span class="label label-danger">{{$campaign->expire}}</span> @elseif($campaign->expire>=date('Y-m-d')) <span class="label label-success">{{$campaign->expire}}</span> @endif </td>
              @if($advertiser)
              <!-- <td align="center">
                                                    <a href="{{URL::to('admin/banner-create-'.$campaign->id)}}" title="">{{HTML::image('assets/img/icon/add-tab-group.png','Add new banner',array('title'=>'Add new banner'))}}&nbsp;Add new banner</a>
                                                </td> -->
              @else @endif 
              <td align="center"><a
								href="{{URL::to('admin/website-of_campaign-'.$campaign->id)}}"
								title="Websites"><i class="fa fa-globe"></i>&nbsp;Websites</a></td>
              @if(count($campaigns)>1)
              <td align="center"> @if($campaign->id==$first_record->id)
                @else <a
								href="{{URL::to('admin/campaign-move_top-Campaign-'.$campaign->id)}}"
								title="Move top" id="moveTop">
                <button class="btn-sm btn-default"><i class="fa fa-long-arrow-up"></i></button>
                </a> <a
								href="{{URL::to('admin/campaign-move_up-Campaign-'.$campaign->id)}}"
								title="Move up" id="moveUp">
                <button class="btn-sm btn-default"><i class="fa fa-arrow-up"></i></button>
                </a> @endif @if($campaign->id==$last_record->id)
                @else <a
								href="{{URL::to('admin/campaign-move_down-Campaign-'.$campaign->id)}}"
								title="Move down" id="moveDown">
                <button class="btn-sm btn-default"><i class="fa fa-arrow-down"></i></button>
                </a> <a
								href="{{URL::to('admin/campaign-move_bottom-Campaign-'.$campaign->id)}}"
								title="Move bottom" id="moveBottom">
                <button class="btn-sm btn-default"><i class="fa fa-long-arrow-down"></i></button>
                </a> @endif </td>
              @else
              @endif
              <td align="center"><a
								href="{{URL::to('admin/campaign-show-'.$campaign->id)}}"
								title="Show">
                <button class="btn-sm btn-default"> <i class="fa fa-search-plus"></i> </button>
                </a> <a
								href="{{URL::to('admin/campaign-copy-'.$campaign->id)}}"
								title="Copy">
                <button class="btn-sm btn-default"> <i class="fa fa-copy"></i> </button>
                </a> <a
								href="{{URL::to('admin/campaign-edit-'.$campaign->id)}}"
								title="Edit">
                <button class="btn-sm btn-default"> <i class="fa fa-edit"></i> </button>
                </a> <a
								href="{{URL::to('admin/campaign-delete-'.$campaign->id)}}"
								title="Delete">
                <button class="btn-sm btn-default"
								onclick="return confirm('Are you sure you want to move this record to the Recycle Bin? \n{{$campaign->campaignname}} \nDate modified: {{$campaign->updated_at}}')"><i class="fa fa-trash-o"></i></button>
                </a></td>
            </tr>
            @endforeach
            </tbody>
            
            <tfoot>
              <tr>
                <th>Order No</th>
                <th align="left">Name</th>
                <th>Status</th>
                <th align="left">Type</th>
                <th>Expire Date</th>
                @if($advertiser)
                <!-- <th></th> -->
                @else @endif
                <th></th>
                @if(count($campaigns)>1)
                <th></th>
                @else
                @endif
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