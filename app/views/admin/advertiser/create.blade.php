@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Add new advertiser
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="advertiser"> Advertisers</a></li>
                        <li class="active">Add new advertiser</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-success">
                                <div class="box-header">
                                        <h3 class="box-title">Advertiser Properties</h3>
                                        <button class="slide_open btn-sm btn-default btn-help"><i class="fa fa-anchor"></i>&nbsp;Help</button>
                                </div><!-- /.box-header -->
								<div id="slide" class="well" style="display:none;top:15%;width:30%;height:80%;bottom:5%;right:45%;left:25%;">
                                    <div id="widget">
                                        <div id="header">
                                            <input type="text" id="search" placeholder="Search in the text" />
                                        </div>
                                        <div id="content">
                                            @if(isset($help))
                                            	@foreach($help as $help)
                                                	@if(Session::get('language',Config::get('app.locale'))=='en')
	                                            		{{$help->content_helper_en}}
                                                    @elseif(Session::get('language',Config::get('app.locale'))=='vi')
                                                    	{{$help->content_helper_vi}}
                                                    @endif
                                            	@endforeach()
                                            @else
                                            @endif
                                        </div>
                                    </div>​​
                                </div>

                                <!-- form start
                                {{HTML::ul($errors->all())}} -->
                                {{Form::open()}}
                                    <div class="box-body">
                                        <div class="form-group">
                                            {{Form::label('clientname','Name')}}&nbsp;<font color="#FF0000">*</font>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                {{Form::text('clientname',Input::old('clientname'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
                                            </div>
                                            @if($errors->first('clientname'))
                                            <div class="alert alert-danger alert-dismissable">
                                                <i class="fa fa-ban"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                 {{$errors->first('clientname')}} 
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('contact','Contact')}}&nbsp;<font color="#FF0000">*</font>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                                {{Form::text('contact',Input::old('contact'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
                                            </div>
                                            @if($errors->first('contact'))
                                            <div class="alert alert-danger alert-dismissable">
                                                <i class="fa fa-ban"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                {{$errors->first('contact')}}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('email','Email')}}&nbsp;<font color="#FF0000">*</font>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                {{Form::text('email',Input::old('email'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
                                            </div>
                                            @if($errors->first('email'))
                                            <div class="alert alert-danger alert-dismissable">
                                                <i class="fa fa-ban"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                {{$errors->first('email')}}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('address','Address')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-book"></i></span>
                                                {{Form::text('address',Input::old('address'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('city','City')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-plane"></i></span>
                                                {{Form::text('city',Input::old('city'),array('class'=>'form-control','placeholder'=>'Enter ...'))}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Country</label>
                                            <select data-placeholder="-- Select --" class="chosen-select" tabindex="1" name="country" id="country">
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}">{{ $country->country_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('phone','Phone')}}
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-phone"></i>
                                                </span>
                                                {{Form::text('phone',Input::old('phone'),array('class'=>'form-control','data-inputmask'=>'"mask": "(9999) 999-9999"','data-mask'=>''))}}
                                                
                                            </div><!-- /.input group -->
                                        </div><!-- /.form group -->
                                        <div class="form-group">
                                            {{Form::label('comments','Comments')}}
                                            {{Form::textarea('comments',Input::old('comments'),array('class'=>'form-control','placeholder'=>'Enter ...','rows'=>3))}}
                                            
                                        </div><button type="submit" class="btn-sm btn-success"><i class="fa fa-check-circle-o"></i>&nbsp;Save & New</button>
                                    </div><!-- /.box-body -->
                            </div><!-- /.box -->
						</div><!--/.col (left) -->
                        <!--<div class="col-md-6">
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">User Access</h3>
                                </div>
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th align="left">Username</th>
                                                <th align="left">Email</th>
                                                <th align="left">Contact Name</th>
                                                <th align="left">Date linked</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td align="center">
                                                        {{Form::input('checkbox','userid[]',Input::old('userid',$user->id),array('class'=>'flat-red'))}}
                                                    </td>
                                                    <td>{{$user->username}}</td>
                                                    <td>{{$user->email_address}}</td>
                                                    <td>{{$user->contact_name}}</td>
                                                    <td>{{$user->created_at}}</td>
                                                </tr>
                                            @endforeach()
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th align="left">Username</th>
                                                <th align="left">Email</th>
                                                <th align="left">Contact Name</th>
                                                <th align="left">Date linked</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>-->
                        {{Form::close()}}
                        <!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->

@stop