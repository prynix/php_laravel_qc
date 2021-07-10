@extends('layout.main')
@section('content')
<section class="content-header">
  <h1> Advertiser Manager: Advertisers Profile
    <!-- <small>advanced tables</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Advertisers Profile</li>
  </ol>
  <br/>
  <div class="row">
    <div class="col-xs-4">
      <select class="form-control" id="advertiserid">
        <option value="" disabled selected>-- Choose advertiser --</option>
        
        
        
        
        
        
        
        
        
					        

								@foreach($advertisers as $ad)

        
        
        <option value="{{$ad->id}}">{{ $ad->clientname }}</option>
        
        
        
        
        
        
        
        
        
					        

								@endforeach

							
					      
      
      
      
      
      
      
      
      
      </select>
    </div>
  </div>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-body table-responsive">
          <div id="wizard">
            <h2>First Step - Advertiser</h2>
            <section>
              <div id="horizontalTab">
                <ul>
                  <li> <a href="#tab-1" style="border-left:none;border-top-right-radius:0;">Advertiser Properties</a> </li>
                  <li> <a href="#tab-2" style="border-top-left-radius:0;border-top-right-radius:0;">User Access</a> </li>
                </ul>
                <div id="tab-1">
                  <form class="grid-form">
                    <fieldset>
                      <legend class="no-margin">Advertiser Details</legend>
                      <div data-row-span="10">
                        <div data-field-span="3">
                          <label>Name</label>
                          <input type="text" value="@if(isset($advertiser)) {{$advertiser->clientname}} @else @endif" readonly/>
                        </div>
                        <div data-field-span="7">
                          <label>Contact</label>
                          <input type="text" value="@if(isset($advertiser)) {{$advertiser->contact}} @else @endif" readonly/>
                        </div>
                      </div>
                      <div data-row-span="10">
                        <div data-field-span="4">
                          <label>Email</label>
                          <input type="text" value="@if(isset($advertiser)) {{$advertiser->email}} @else @endif" readonly/>
                        </div>
                        <div data-field-span="6">
                          <label>Address</label>
                          <input type="text" value="@if(isset($advertiser)) {{$advertiser->address}} @else @endif" readonly/>
                        </div>
                      </div>
                      <div data-row-span="10">
                        <div data-field-span="5">
                          <label>City</label>
                          <input type="text" value="@if(isset($advertiser)) {{$advertiser->city}} @else @endif" readonly/>
                        </div>
                        <div data-field-span="5">
                          <label>Country</label>
                          <select disabled>
                            
                            
                            
                            
                            
                            
                            
                          @if(isset($countries)&&isset($advertiser))
										@foreach($countries as $country)
										@if($advertiser->country==$country->id)
                            
                            
                            
                            
                            
                            
                            
                            <option value="{{$country->id}}" selected>{{ $country->country_name }}</option>
                            
                            
                            
                            
                            
                            
                            
										@else
                            
                            
                            
                            
                            
                            
                            
                            <option value="{{$country->id}}">{{ $country->country_name }}</option>
                            
                            
                            
                            
                            
                            
                            
										@endif
										@endforeach
                          @endif
                          
                          
                          
                          
                          
                          
                          
                          </select>
                        </div>
                      </div>
                      <div data-row-span="10">
                        <div data-field-span="3">
                          <label>Phone</label>
                          <input type="text" value="@if(isset($advertiser)) {{$advertiser->phone}} @else @endif" readonly/>
                        </div>
                        <div data-field-span="7">
                          <label>Comments</label>
                          <textarea readonly>@if(isset($advertiser)) {{$advertiser->comments}} @else @endif</textarea>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
                <div id="tab-2">
                  <table id="example1" class="table table-bordered table-striped user_access">
                    <thead>
                      <tr>
                        <th align="left">Username</th>
                        <th align="left">Email</th>
                        <th align="left">Contact Name</th>
                        <th align="left">Date linked</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                    @if(isset($users))
                    @foreach($users as $user)
                    @if($user->clientid==$advertiser->id)
                    <tr>
                      <td>{{$user->username}}</td>
                      <td>{{$user->email_address}}</td>
                      <td>{{$user->contact_name}}</td>
                      <td>{{$user->created_at}}</td>
                    </tr>
                    @else
                    @endif
                    @endforeach()
                    @else
                    @endif
                    </tbody>
                    
                    <tfoot>
                      <tr>
                        <th align="left">Username</th>
                        <th align="left">Email</th>
                        <th align="left">Contact Name</th>
                        <th align="left">Date linked</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </section>
            <h2>Second Step - Campaigns</h2>
            <section>
              <form class="grid-form">
                <fieldset>
                  <legend class="no-margin">Campaign Details</legend>
                    <table border="1" cellspacing="2" cellpadding="2" width="100%">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                        </tr>
                      </thead>
                      <tbody>
                      	@if(isset($campaigns))
                        @foreach($campaigns as $campaign)
                        <tr>
                          <td>{{$campaign->campaignname}}</td>
                          <td align="center">{{$campaign->active}}</td>
                          <td align="center">
                          	@if($campaign->expire=='')
                          		<span class="label label-warning">Don't expire</span>
                          	@else
                          		{{$campaign->expire}}
                          	@endif
                          </td>
                        </tr>
                        @endforeach
                        @else
                        @endif
                      </tbody>
                    </table>
                </fieldset>
              </form>
            </section>
            <h2>Third Step - Websites</h2>
            <section>
              <form class="grid-form">
                <fieldset>
                  <legend class="no-margin">Website Details</legend>
                    <table border="1" cellspacing="2" cellpadding="2" width="100%">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>URL</th>
                          <th>Contact</th>
                          <th>Email</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(isset($websites))
                        @foreach($websites as $website)
                        <tr>
                          <td>{{$website->name}}</td>
                          <td><a href="{{$website->website}}" target="_blank">{{$website->website}}</a></td>
                          <td>{{$website->contact}}</td>
                          <td><a href="mailto:{{$website->email}}">{{$website->email}}</a></td>
                        </tr>
                        @endforeach
                        @else
                        @endif
                      </tbody>
                    </table>
                </fieldset>
              </form>
            </section>
            <h2>Forth Step - Zones</h2>
            <section>
              <form class="grid-form">
                <fieldset>
                  <legend class="no-margin">Zone Details</legend>
                  <table border="1" cellspacing="2" cellpadding="2" width="100%">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Zone type</th>
                          <th>Size</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(isset($zones))
                            @foreach($zones as $zone)
                            <tr>  
                              <td>{{$zone->zonename}}</td>
                              <td>
                              @if(isset($zonetypes))
                                  @foreach($zonetypes as $zonetype)
                                      @if($zone->zonetype==$zonetype->id)
                                          {{$zonetype->title}}
                                      @else
                                      @endif
                                  @endforeach 
                              @else
                              @endif
                              </td>
                              <td>({{$zone->width}}x{{$zone->height}}px)</td>
                            </tr>
                            @endforeach
                        @else
                        @endif
                      </tbody>
                    </table>
                </fieldset>
              </form>
            </section>
            <h2>Fifth Step - Banners</h2>
            <section>
              <form class="grid-form">
                <fieldset>
                  <legend class="no-margin">Banner Details</legend>
                  <table border="1" cellspacing="2" cellpadding="2" width="100%">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Banner type</th>
                          <th>Destination URL</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(isset($banners))
                        @foreach($banners as $banner)
                          <tr>
                            <td>{{$banner->description}}</td>
                            <td align="center">{{$banner->filetype}}</td>
                            <td>{{$banner->url}}</td>
                          </tr>
                        @endforeach
                        @else
                        @endif
                      </tbody>
                    </table>
                </fieldset>
              </form>
            </section>
            <h2>Sixth Step - Targeting Channels</h2>
            <section>
              <form class="grid-form">
                <fieldset>
                  <legend class="no-margin">Targeting Channel Details</legend>
                <table border="1" cellspacing="2" cellpadding="2" width="100%">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Description</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(isset($channels))
                            @foreach($channels as $channel)
                            <tr>  
                              <td>{{$channel->name}}</td>
                              <td>{{$zone->description}}</td>
                            </tr>
                        @endforeach
                        @else
                        @endif
                      </tbody>
                    </table>
                </fieldset>
              </form>
            </section>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@stop