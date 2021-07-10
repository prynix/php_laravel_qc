@extends('layout.main')
@section('content') 
<!-- Main content -->
<section class="content-header">
  <h1> Advertiser Manager: Advertisers Order
    <!-- <small>advanced tables</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Advertisers Order</li>
  </ol>
  <br/>
  <div class="row">
    <div class="col-xs-4">
      <select class="form-control" id="advertiser_ad">
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
      <div class="box box-success">
        <div class="box-body clearfix" style="width:100%;"> 
          <!-- Smart Wizard -->
          <div id="steps" class="swMain">
            <ul>
              <li><a href="#step-1"> <span class="stepNumber"><strong>Step 1</strong></span> <span class="stepDesc">
                <small><strong>Review Ads</strong></small> </span> </a></li>
              <li><a href="#step-2"> <span class="stepNumber"><strong>Step 2</strong></span> <span class="stepDesc"> 
                <small><strong>Shipping</strong></small> </span> </a></li>
              <li><a href="#step-3"> <span class="stepNumber"><strong>Step 3</strong></span> <span class="stepDesc"> 
                <small><strong>Check Out</strong></small> </span> </a></li>
              <li><a href="#step-4"> <span class="stepNumber"><strong>Step 4</strong></span> <span class="stepDesc"> 
                <small><strong>Print Invoices (Demo)</strong></small> </span> </a></li>
            </ul>
            <div id="step-1">
              <h2 class="StepTitle">Step 1 Content</h2>
              <br/>
              <table border="1" cellpadding="2" cellspacing="2" width="100%" style="border:1px solid #ccc;">
                <tr>
                  <td colspan="4"> You have @if(isset($banners)) {{count($banners)}} @else 0 @endif item(s) in your cart. </td>
                </tr>
                @if(isset($banners))
                  @foreach($banners as $banner)
                  <tr>
                    <td>
                      @if($banner->htmltemplate===''&&$banner->filename!=='')
                        <object data="{{URL::to('/').'/'.$banner->filename}}" width="100%" height="auto">
                            {{HTML::image($banner->filename,$banner->filename,array('onerror'=>"this.onerror=null;this.src='assets/img/icon/filenotfound.png'",'width'=>'100%'))}}
                        </object>
                      @else
                        {{HTML::image('assets/img/icon/filenotfound.png','File Not Found')}};
                      @endif

                      @if($banner->htmltemplate!==''&&$banner->filename==='')
                        {{$banner->htmltemplate}}    
                      @else
                        
                      @endif
                    </td>
                    <td>{{$banner->description}}</td>
                    <td align="center">1</td>
                    <td align="center">{{$banner->width}}&nbsp;x&nbsp;{{$banner->height}}</td>
                  </tr>
                  @endforeach
                @else
                @endif
                <tr>
                  <?php
                    $total_price=0;
                    if(isset($zones)){
                      foreach($zones as $zone){
                          $total_price+=$zone->pricing;   
                      }
                    }else{}
                  ?>
                  <td colspan="4" align="right"> Total VND&nbsp;<strong><?php echo $total_price; ?></strong></td>
                </tr>
              </table>
            </div>
            <div id="step-2">
              <h2 class="StepTitle">Step 2 Content</h2>
              <br/>
              @if(isset($advertiser))
              <div style="float:left;width:48%;">
                <div class="form-group"> {{Form::label('clientname','Name')}}&nbsp;<font color="#FF0000">*</font>
                  <div class="input-group"> <span class="input-group-addon"><i class="fa fa-user"></i></span> {{Form::text('clientname',Input::old('clientname',$advertiser->clientname),array('class'=>'form-control','disabled'=>'disabled'))}} </div>
                </div>
                <div class="form-group"> {{Form::label('contact','Contact')}}&nbsp;<font color="#FF0000">*</font>
                  <div class="input-group"> <span class="input-group-addon"><i class="fa fa-credit-card"></i></span> {{Form::text('contact',Input::old('contact',$advertiser->contact),array('class'=>'form-control','disabled'=>'disabled'))}} </div>
                </div>
                <div class="form-group"> {{Form::label('email','Email')}}&nbsp;<font color="#FF0000">*</font>
                  <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span> {{Form::text('email',Input::old('email',$advertiser->email),array('class'=>'form-control','disabled'=>'disabled'))}} </div>
                </div>
                <div class="form-group"> {{Form::label('address','Address')}}
                  <div class="input-group"> <span class="input-group-addon"><i class="fa fa-book"></i></span> {{Form::text('address',Input::old('address',$advertiser->address),array('class'=>'form-control','disabled'=>'disabled'))}} </div>
                </div>
                <div class="form-group"> {{Form::label('city','City')}}
                  <div class="input-group"> <span class="input-group-addon"><i class="fa fa-plane"></i></span> {{Form::text('city',Input::old('city',$advertiser->city),array('class'=>'form-control','disabled'=>'disabled'))}} </div>
                </div>
                <div class="form-group">
                  <label>Country</label>
                  <div class="input-group"> <span class="input-group-addon"><i class="fa fa-rocket"></i></span>
                    <select class="form-control" name="country" disabled>
                      @foreach($countries as $country)
                          @if($advertiser->country==$country->id)
                              <option value="{{$country->id}}" selected>{{ $country->country_name }}</option>
                          @else
                              <option value="{{$country->id}}">{{ $country->country_name }}</option>
                          @endif
      				        @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group"> {{Form::label('phone','Phone')}}
                  <div class="input-group">
                    <div class="input-group-addon"> <i class="fa fa-phone"></i> </div>
                    {{Form::text('phone',Input::old('phone',$advertiser->phone),array('class'=>'form-control','data-inputmask'=>'"mask": "(9999) 999-9999"','data-mask'=>'','disabled'=>'disabled'))}} </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <div class="form-group"> {{Form::label('comments','Comments')}}
                  {{Form::textarea('comments',Input::old('comments',$advertiser->comments),array('class'=>'form-control','disabled'=>'disabled','rows'=>3))}} </div>
              </div>
              @else
              @endif              
            </div>
            <div id="step-3">
              <h2 class="StepTitle">Step 3 Content</h2><br/>
              <p>Your order is show below. Process to checkout by click the button below.</p>
            </div>
            <div id="step-4">
              <h2 class="StepTitle">Step 4 Content</h2><br/>
              <textarea id='print-div' class="print_div ckeditor">
              	<b>Hóa đơn</b><br/>
                Giấy phép hoạt động số 3049/GP- TTĐT<br/>
				Địa chỉ: 247 Cầu Giấy, quận Cầu Giấy, Hà Nội<br/>
				Email: info@tintuc.vn<br/>
              </textarea><br/>
              <!-- <button class="print_link avoid-this">Print this</button> -->
            </div>
          </div>
          <!-- End SmartWizard Content --> 
        </div>
        <!-- /.box-body --> 
      </div>
      <!-- /.box --> 
    </div>
  </div>
</section>
@stop