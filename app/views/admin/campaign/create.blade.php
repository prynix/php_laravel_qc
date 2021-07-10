@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> Add new campaign <span class="target">for advertiser {{$advertiser->clientname}}</span>
    <!-- <small>Preview</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="campaign"> Campaigns</a></li>
    <li class="active">Add new campaign</li>
  </ol>
  <br/>
  <a href="{{URL::to('admin/advertiser-edit-'.$advertiser->id)}}" title="">Advertiser: {{$advertiser->clientname}}</a> </section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    {{Form::open()}}
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Basic information</h3>
          <button class="slide_open btn-sm btn-default btn-help"><i class="fa fa-crop"></i>&nbsp;Help</button>
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
          <div class="form-group"> {{Form::label('campaignname','Name')}}&nbsp;<font color="#FF0000">*</font>
            <div class="input-group"> <span class="input-group-addon"><i class="fa fa-bar-chart-o"></i></span> {{Form::text('campaignname',Input::old('campaignname'),array('class'=>'form-control','placeholder'=>'Enter ...'))}} </div>
            @if($errors->first('campaignname'))
            <div class="alert alert-danger alert-dismissable"> <i class="fa fa-ban"></i>
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {{$errors->first('campaignname')}} </div>
            @endif </div>
          <div class="form-group"> {{Form::label('revenue_type','Campaign type')}} </div>
          <div class="form-group">
            <input type="radio" name="campaign_type" class="flat-red" value="1" checked/>
            &nbsp;Remnant<br/>
            <font style="font-weight:normal;">This is a standard campaign which can be constrained with either an end date or a specific limit</font> </div>
          <div class="form-group">
            <input type="radio" name="campaign_type" class="flat-red" value="2"/>
            &nbsp;Contract<br/>
            <font style="font-weight:normal;">This campaign is limited per day and is going to be delivered evenly until the end date or specified limit is met</font> </div>
          <div class="form-group">
            <input type="radio" name="campaign_type" class="flat-red" value="3"/>
            &nbsp;Contract (Exclusive)<br/>
            <font style="font-weight:normal;">This campaign is going to take all impressions and be delivered before other campaigns</font> </div>
          <div class="form-group"> {{Form::label('active','Start date')}}
            <div class="input-group"> <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> {{Form::text('active',Input::old('active'),array('class'=>'form-control','style'=>'width:auto;'))}} </div>
          </div>
          <div class="form-group"> {{Form::label('expire','End date')}}
            <div class="input-group"> <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> {{Form::text('expire',Input::old('expire'),array('class'=>'form-control','style'=>'width:auto;'))}} </div>
          </div>
          <div class="form-group"> {{Form::label('revenue_type','Pricing model')}}&nbsp;<font color="#FF0000">*</font>
            <select name="revenue_type" data-placeholder="-- Select --" class="chosen-select" tabindex="1">
              <option value="1">CPM</option>
              <option value="2">CPC</option>
              <option value="3">CPA</option>
              <option value="4">Tenancy</option>
            </select>
          </div>
          <div class="form-group"> {{Form::label('revenue','Rate / Price')}}
            <div class="input-group"> <span class="input-group-addon"><i class="fa fa-eur"></i></span> {{Form::text('revenue',Input::old('revenue'),array('class'=>'form-control','style'=>'width:auto;'))}} </div>
          </div>
          <div class="form-group"> {{Form::label('clicks','Clicks')}}
            {{Form::input('number','clicks',Input::old('clicks',0),array('class'=>'form-control','min'=>0,'style'=>'width:auto;'))}} </div>
          <div class="form-group"> {{Form::label('views','Impressions')}}
            {{Form::input('number','views',Input::old('views',0),array('class'=>'form-control','min'=>0,'style'=>'width:auto;'))}} </div>
          <div class="form-group"> {{Form::label('','Priority level')}}<br/>
            <select name="priority" class="form-control" style="display:inline-block !important;width:auto;">
              
                                                @for($i=10;$i>0;$i--)
                                                    
              <option value={{$i}}>{{$i}}</option>
              
                                                @endfor
                                            
            </select>
            &nbsp;-&nbsp;Limit&nbsp;
            <select name="target_type" class="form-control" style="display:inline-block !important;width:auto;">
              <option value="target_click">Clicks</option>
            </select>
            &nbsp;to&nbsp;
            {{Form::input('number','target_click',Input::old('target_click'),array('class'=>'form-control','style'=>'display:inline-block !important;width:auto;'))}}
            &nbsp;per day </div>
          <div class="form-group"> {{Form::label('weight','Set the campaign weight')}}
            {{Form::input('number','weight',Input::old('weight',1),array('class'=>'form-control','min'=>0,'style'=>'width:auto;'))}} </div>
          <div class="form-group"> {{Form::label('capping','Limit campaign views to')}}<br/>
            {{Form::input('number','capping',Input::old('capping'),array('class'=>'form-control','style'=>'display:inline-block !important;width:auto;'))}}
            &nbsp;in total </div>
          <div class="form-group"> {{Form::input('number','session_capping',Input::old('session_capping'),array('class'=>'form-control','style'=>'display:inline-block !important;width:auto;'))}}
            &nbsp;per session </div>
          <div class="form-group"> {{Form::label('comments','Comments')}}
            {{Form::textarea('comments',Input::old('comments'),array('class'=>'form-control','rows'=>6,'placeholder'=>'Enter ...'))}} </div>
          {{Form::submit('Save & New',array('class'=>'btn-sm btn-success'))}} </div>
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (right) -->
    <!-- <div class="col-md-6">
                            <div class="box box-success">
                                <div class="box-body">
                                    <div class="form-group">
                                        {{Form::label('clientid','Advertiser')}}<br/>
                                        <select data-placeholder="Choose a Advertiser..." class="chosen-select" tabindex="1" name="clientid">
                                            
                                            @foreach($advertisers as $advertiser)
                                                <option value="{{$advertiser->id}}">{{ $advertiser->clientname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div> -->
    {{Form::close()}} </div>
  <!-- /.row -->
</section>
<!-- /.content -->
@stop 