@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> Copy campaign<span class="target">: {{$campaign->campaignname}}</span>
    <!-- <small>Preview</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="campaign"> Campaigns</a></li>
    <li class="active">Copy campaign</li>
  </ol>
  <br/>
  @foreach($advertisers as $advertiser)
  @if($campaign->clientid==$advertiser->id) <a href="{{URL::to('admin/advertiser-edit-'.$advertiser->id)}}" title="">Advertiser: {{ $advertiser->clientname }}</a> @else
  @endif
  @endforeach </section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    {{Form::open()}}
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Campaign Properties</h3>
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
        <div class="box-body">
          <input type="hidden" name="clientid" value="{{ $campaign->clientid }}"/>
          <div class="form-group"> {{Form::label('campaignname','Name')}}&nbsp;<font color="#FF0000">*</font>
            <div class="input-group"> <span class="input-group-addon"><i class="fa fa-bar-chart-o"></i></span> {{Form::text('campaignname',Input::old('campaignname',$campaign->campaignname),array('class'=>'form-control'))}} </div>
            @if($errors->first('campaignname'))
            <div class="alert alert-danger alert-dismissable"> <i class="fa fa-ban"></i>
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {{$errors->first('campaignname')}} </div>
            @endif </div>
          <div class="form-group"> {{Form::label('revenue_type','Campaign type')}} </div>
          <div class="form-group"> @if($campaign->campaign_type==1)
            <input type="radio" name="campaign_type" class="flat-red" value="1" checked/>
            @else
            <input type="radio" name="campaign_type" class="flat-red" value="1"/>
            @endif
            &nbsp;Remnant<br/>
            <font style="font-weight:normal;">This is a standard campaign which can be constrained with either an end date or a specific limit</font> </div>
          <div class="form-group"> @if($campaign->campaign_type==2)
            <input type="radio" name="campaign_type" class="flat-red" value="2" checked/>
            @else
            <input type="radio" name="campaign_type" class="flat-red" value="2"/>
            @endif
            &nbsp;Contract<br/>
            <font style="font-weight:normal;">This campaign is limited per day and is going to be delivered evenly until the end date or specified limit is met</font> </div>
          <div class="form-group"> @if($campaign->campaign_type==3)
            <input type="radio" name="campaign_type" class="flat-red" value="3" checked/>
            @else
            <input type="radio" name="campaign_type" class="flat-red" value="3"/>
            @endif
            &nbsp;Contract (Exclusive)<br/>
            <font style="font-weight:normal;">This campaign is going to take all impressions and be delivered before other campaigns</font> </div>
          <div class="form-group"> {{Form::label('active','Start date')}}
            <div class="input-group"> <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> {{Form::text('active',Input::old('active',$campaign->active),array('class'=>'form-control','style'=>'width:auto;'))}} </div>
          </div>
          <div class="form-group"> {{Form::label('expire','End date')}}
            <div class="input-group"> <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> {{Form::text('expire',Input::old('expire',$campaign->expire),array('class'=>'form-control','style'=>'width:auto;'))}} </div>
          </div>
          <div class="form-group"> {{Form::label('revenue_type','Pricing model')}}&nbsp;<font color="#FF0000">*</font>
            <select name="revenue_type" data-placeholder="-- Select --" class="chosen-select" tabindex="1">
              
                                                @if($campaign->revenue_type==1)
                                                    
              <option value="1" selected>CPM</option>
              
                                                @else
                                                    
              <option value="1">CPM</option>
              
                                                @endif
                                                @if($campaign->revenue_type==2)
                                                    
              <option value="2" selected>CPC</option>
              
                                                @else
                                                    
              <option value="2">CPC</option>
              
                                                @endif
                                                @if($campaign->revenue_type==3)
                                                    
              <option value="3" selected>CPA</option>
              
                                                @else
                                                    
              <option value="3">CPA</option>
              
                                                @endif
                                                @if($campaign->revenue_type==4)
                                                    
              <option value="4" selected>Tenancy</option>
              
                                                @else
                                                    
              <option value="4">Tenancy</option>
              
                                                @endif
                                            
            </select>
          </div>
          <div class="form-group"> {{Form::label('revenue','Rate / Price')}}
            <div class="input-group"> <span class="input-group-addon"><i class="fa fa-eur"></i></span> {{Form::text('revenue',Input::old('revenue',$campaign->revenue),array('class'=>'form-control','style'=>'width:auto;'))}} </div>
          </div>
          <div class="form-group"> {{Form::label('clicks','Clicks')}}
            {{Form::input('number','clicks',Input::old('clicks',$campaign->clicks),array('class'=>'form-control','min'=>0,'style'=>'width:auto;'))}} </div>
          <div class="form-group"> {{Form::label('','Priority level')}}<br/>
            <select name="priority" class="form-control" style="display:inline-block;width:auto;">
              
                                                @for($i=10;$i>0;$i--)
                                                    @if($campaign->priority==$i)
                                                        
              <option value={{$i}} selected>{{$i}}</option>
              
                                                    @else
                                                        
              <option value={{$i}}>{{$i}}</option>
              
                                                    @endif()
                                                @endfor
                                            
            </select>
            &nbsp;-&nbsp;Limit&nbsp;
            <select name="target_type" class="form-control" style="display:inline-block;width:auto;">
              <option value="target_click">Clicks</option>
            </select>
            &nbsp;to&nbsp;
            {{Form::input('number','target_click',Input::old('target_click',$campaign->target_click),array('class'=>'form-control','style'=>'display:inline-block;width:auto;'))}}
            &nbsp;per day </div>
          <div class="form-group"> {{Form::label('capping','Limit campaign views to')}}<br/>
            {{Form::input('number','capping',Input::old('capping',$campaign->capping),array('class'=>'form-control','style'=>'display:inline-block;width:auto;'))}}
            &nbsp;in total </div>
          <div class="form-group"> {{Form::input('number','session_capping',Input::old('session_capping',$campaign->session_capping),array('class'=>'form-control','style'=>'display:inline-block;width:auto;'))}}
            &nbsp;per session </div>
          <div class="form-group"> {{Form::label('comments','Comments')}}
            {{Form::textarea('comments',Input::old('comments',$campaign->comments),array('class'=>'form-control','rows'=>3))}} </div>
          <button type="submit" class="btn-sm btn-success"><i class="fa fa-check-circle-o"></i>&nbsp;Save as Copy</button>
          </div>
        {{Form::close()}} </div>
      <!-- /.box -->
    </div>
    <!--/.col (right) -->
    <!--<div class="col-md-6">
                            <div class="box box-success">
                                <div class="box-body">
                                    <div class="form-group">
                                        {{Form::label('clientid','Advertiser')}}<br/>
                                        <select data-placeholder="Choose a Advertiser..." class="chosen-select" tabindex="1" name="clientid">
                                            @foreach($advertisers as $advertiser)
                                                @if($campaign->clientid==$advertiser->id)
                                                    <option value="{{$advertiser->id}}" selected="selected">{{ $advertiser->clientname }}</option>
                                                @else
                                                    <option value="{{$advertiser->id}}">{{ $advertiser->clientname }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>-->
    {{Form::close()}} </div>
  <!-- /.row -->
</section>
<!-- /.content -->
@stop 