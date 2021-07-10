@extends('layout.main')
@section('content') 
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> Request Manager: Requests 
    <!-- <small>advanced tables</small> --> 
  </h1>
  <ol class="breadcrumb">
    <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Requests</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="form-group" style="float:right;width:40%;"> @if(Session::has('success'))
    <div class="alert alert-success alert-dismissable"> <i class="fa fa-check"></i>
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {{Session::get('success')}} </div>
    @endif
    @if(Session::has('warning'))
    <div class="alert alert-warning alert-dismissable"> <i class="fa fa-warning"></i>
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {{Session::get('warning')}} </div>
    @endif
    @if(Session::has('danger'))
    <div class="alert alert-danger alert-dismissable"> <i class="fa fa-ban"></i>
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {{Session::get('danger')}} </div>
    @endif </div>
  <!-- Modal Create -->
  <div class="modal fade" id="myModalNew"
							tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
							aria-hidden="true">
    <div class="modal-dialog" style="width:50%;height:100%;overflow-y:scroll;overflow-x:hidden;">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12"> 
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header" style="padding-bottom: 0;">
                  <h3 class="box-title">Create New Request</h3>
                </div>
                {{Form::open(array('url'=>'admin/request-create','files'=>'true'))}}
                <div class="box-body">
                  <div class="form-group"> {{Form::label('sender','Sender')}}
                    {{Form::textarea('sender',Input::old('sender'),array('class'=>'form-control','rows'=>2))}} </div>
                  <div class="form-group"> {{Form::label('title_request','Title Request')}}
                    {{Form::text('title_request',Input::old('title_request'),array('class'=>'form-control'))}} </div>
                  <div class="form-group"> {{Form::label('content_request','Content Request')}}
                    {{Form::textarea('content_request',Input::old('content_request'),array('class'=>'form-control ckeditor','rows'=>6,'style'=>'display:none !important;'))}} </div>
                  <div class="form-group"> {{Form::file('attach_file[]',array('id'=>'file-1a','multiple'=>true,'class'=>'file','multiple'=>'true','data-show-upload'=>false,'data-preview-file-type'=>'any','data-initial-caption'=>'','data-overwrite-initial'=>'false'))}} </div>
                  <div class="form-group"> {{Form::label('date_sent','Sent date')}}
                    <div class="input-group"> <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> {{Form::text('date_sent',Input::old('date_sent'),array('class'=>'form-control','style'=>'width:auto;'))}} </div>
                  </div>
                  <div class="form-group"> {{Form::label('receiver','Receiver')}}
                    {{Form::textarea('receiver',Input::old('receiver'),array('class'=>'form-control','rows'=>3))}} </div>
                  <div class="form-group"> {{Form::label('userid','Solver')}}<br/>
                    <select class="form-control" name="userid" id="userid" style="width:auto;">
                      <option value="" disabled selected>-- Choose solver --</option>
                      
                                                                    @foreach($users as $user)
                                                                        
                      <option value="{{$user->id}}">{{$user->username}}</option>
                      
                                                                    @endforeach
        														
                    </select>
                  </div>
                </div>
                <div class="box-footer"> {{Form::input('submit','','Save changes',array('class'=>'btn-sm btn-primary','value'=>''))}} </div>
                {{Form::close()}} </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
  </div>
  <!-- /.modal -->
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <div class="form-group"> <a href="#myModalNew" data-toggle="modal">
            <button class="btn-sm btn-success"><i class="fa fa-plus"></i>&nbsp;Add new request</button>
            </a> <a href="request-recycle" class="recycle">
            <button class="btn-sm btn-facebook"><i class="fa fa-crop"></i>&nbsp;Recycle Bin</button>
            </a>
            <button class="slide_open btn-sm btn-default btn-help no-margin-top no-margin-right"><i class="fa fa-anchor"></i>&nbsp;Help</button>
          </div>
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
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Order No</th>
                <th>Sender</th>
                <th>Date Sent</th>
                <th>Solver</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            
            @foreach($requests as $request)
            <tr>
              <td align="center">{{$request->id}}</td>
              <td>{{$request->sender}}</td>
              <td align="center">{{$request->date_sent}}</td>
              <td align="center"> @foreach($users as $user)
                @if($user->id==$request->solverid) <span class="label label-primary">{{$user->username}}</span> @else
                @endif
                @endforeach </td>
              <td align="center"> @if($request->status==0) <span class="label label-danger">Not received</span> @elseif($request->status==1) <span class="label label-success">Received</span> @endif </td>
              <td align="center"><a  href="#myModalShow-{{$request->id}}" data-toggle="modal" title="Show">
                <button class="btn-sm btn-default"> <i class="fa fa-search-plus"></i> </button>
                </a> <a href="#myModalCopy-{{$request->id}}" data-toggle="modal" title="Copy">
                <button class="btn-sm btn-default"> <i class="fa fa-copy"></i> </button>
                </a> <a href="#myModalEdit-{{$request->id}}" data-toggle="modal" title="Edit">
                <button class="btn-sm btn-default"> <i class="fa fa-edit"></i> </button>
                </a> <a href="{{URL::to('admin/request-delete-'.$request->id)}}" title="Delete">
                <button class="btn-sm btn-default" onclick="return confirm('Are you sure you want to move this record to the Recycle Bin? \n{{$request->sender}} \nDate modified: {{$request->updated_at}}')"><i class="fa fa-trash-o"></i></button>
                </a></td>
            </tr>
            <!-- Modal Show -->
            <div class="modal fade" id="myModalShow-{{$request->id}}"
                                            tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                            aria-hidden="true">
              <div class="modal-dialog" style="width:50%;height:100%;overflow-y:scroll;overflow-x:hidden;">
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12"> 
                        <!-- general form elements -->
                        <div class="box box-primary">
                          <div class="box-header" style="padding-bottom: 0;">
                            <h3 class="box-title">Show Request</h3>
                          </div>
                          <div class="box-body">
                            <div class="form-group"> {{Form::label('sender','Sender')}}
                              {{Form::textarea('sender',Input::old('sender',$request->sender),array('class'=>'form-control','rows'=>2,'disabled'=>'disabled'))}} </div>
                            <div class="form-group"> {{Form::label('title_request','Title Request')}}
                              {{Form::text('title_request',Input::old('title_request',$request->title_request),array('class'=>'form-control','disabled'=>'disabled'))}} </div>
                            <div class="form-group"> {{Form::label('content_request','Content Request')}}
                              {{Form::textarea('content_request',Input::old('content_request',$request->content_request),array('class'=>'form-control ckeditor','rows'=>6,'disabled'=>'disabled','style'=>'display:none !important;'))}} </div>
                            <div class="form-group"><i class="fa fa-paperclip"></i>&nbsp;{{Form::label('Attach File')}}<br/>
                            <?php foreach(explode(', ',$request->attach_file) as $attach_file){ ?>
                              <a href="../{{$attach_file}}" target="_blank">{{$attach_file}}</a><br/>
                            <?php } ?>
                            </div>
                            <div class="form-group"> {{Form::label('date_sent','Sent date')}}
                              <div class="input-group"> <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> {{Form::text('date_sent',Input::old('date_sent',$request->date_sent),array('class'=>'form-control','disabled'=>'disabled','style'=>'width:auto;'))}} </div>
                            </div>
                            <div class="form-group"> {{Form::label('receiver','Receiver')}}
                              {{Form::textarea('receiver',Input::old('receiver',$request->receiver),array('class'=>'form-control','disabled'=>'disabled','rows'=>3))}} </div>
                            <div class="form-group"> {{Form::label('userid','Solver')}}<br/>
                              <select class="form-control" name="userid" id="userid" style="width:auto;" disabled="disabled">
                                <option value="" disabled selected>-- Choose solver --</option>
                                  
                                                                                    @foreach($users as $user)
                                                                                        @if($request->solverid==$user->id)
                                                                                            
                                <option value="{{$user->id}}" selected="selected">{{$user->username}}</option>
                                  
                                                                                        @else
                                                                                            
                                <option value="{{$user->id}}">{{$user->username}}</option>
                                  
                                                                                        @endif
                                                                                    @endforeach
                                                                                
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.modal-content --> 
              </div>
              <!-- /.modal-dialog --> 
            </div>
            <!-- /.modal --> 
            <!-- Modal Copy -->
            <div class="modal fade" id="myModalCopy-{{$request->id}}"
                                            tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                            aria-hidden="true">
              <div class="modal-dialog" style="width:50%;height:100%;overflow-y:scroll;overflow-x:hidden;">
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12"> 
                        <!-- general form elements -->
                        <div class="box box-primary">
                          <div class="box-header" style="padding-bottom: 0;">
                            <h3 class="box-title">Copy Request</h3>
                          </div>
                          {{Form::open(array('url'=>'admin/request-create','files'=>'true'))}}
                          <div class="box-body">
                            <div class="form-group"> {{Form::label('sender','Sender')}}
                              {{Form::textarea('sender',Input::old('sender',$request->sender),array('class'=>'form-control','rows'=>2))}} </div>
                            <div class="form-group"> {{Form::label('title_request','Title Request')}}
                              {{Form::text('title_request',Input::old('title_request',$request->title_request),array('class'=>'form-control'))}} </div>
                            <div class="form-group"> {{Form::label('content_request','Content Request')}}
                              {{Form::textarea('content_request',Input::old('content_request',$request->content_request),array('class'=>'form-control ckeditor','rows'=>6,'style'=>'display:none !important;'))}} </div>
                            <div class="form-group"> {{Form::file('attach_file[]',array('id'=>'file-1a','multiple'=>true,'class'=>'file','multiple'=>'true','data-show-upload'=>false,'data-preview-file-type'=>'any','data-initial-caption'=>'','data-overwrite-initial'=>'false'))}} </div>
                            <div class="form-group"> {{Form::label('date_sent','Sent date')}}
                              <div class="input-group"> <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> {{Form::text('date_sent',Input::old('date_sent',$request->date_sent),array('class'=>'form-control','style'=>'width:auto;'))}} </div>
                            </div>
                            <div class="form-group"> {{Form::label('receiver','Receiver')}}
                              {{Form::textarea('receiver',Input::old('receiver',$request->receiver),array('class'=>'form-control','rows'=>3))}} </div>
                            <div class="form-group"> {{Form::label('userid','Solver')}}<br/>
                              <select class="form-control" name="userid" id="userid" style="width:auto;" disabled="disabled">
                                <option value="" disabled selected>-- Choose solver --</option>
                                  
                                                                                    @foreach($users as $user)
                                                                                        @if($request->solverid==$user->id)
                                                                                            
                                <option value="{{$user->id}}" selected="selected">{{$user->username}}</option>
                                  
                                                                                        @else
                                                                                            
                                <option value="{{$user->id}}">{{$user->username}}</option>
                                  
                                                                                        @endif
                                                                                    @endforeach
                                                                                
                              </select>
                            </div>
                          </div>
                          <div class="box-footer">
                            {{Form::input('submit','','Save changes',array('class'=>'btn-sm btn-primary','value'=>''))}}  
                          </div>
                          {{Form::close()}}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.modal-content --> 
              </div>
              <!-- /.modal-dialog --> 
            </div>
            <!-- end modal --> 
            <!-- Modal Edit -->
            <div class="modal fade" id="myModalEdit-{{$request->id}}"
                                            tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                            aria-hidden="true">
              <div class="modal-dialog" style="width:50%;height:100%;overflow-y:scroll;overflow-x:hidden;">
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12"> 
                        <!-- general form elements -->
                        <div class="box box-primary">
                          <div class="box-header" style="padding-bottom: 0;">
                            <h3 class="box-title">Edit Request</h3>
                          </div>
                          {{Form::open(array('url'=>'admin/request-edit','files'=>'true'))}}
                          <div class="box-body">
                            <div class="form-group"> {{Form::label('sender','Sender')}}
                              {{Form::textarea('sender',Input::old('sender',$request->sender),array('class'=>'form-control','rows'=>2))}} </div>
                            <div class="form-group"> {{Form::label('title_request','Title Request')}}
                              {{Form::text('title_request',Input::old('title_request',$request->title_request),array('class'=>'form-control'))}} </div>
                            <div class="form-group"> {{Form::label('content_request','Content Request')}}
                              {{Form::textarea('content_request',Input::old('content_request',$request->content_request),array('class'=>'form-control ckeditor','rows'=>6,'style'=>'display:none !important;'))}} </div>
                            <div class="form-group"> {{Form::file('attach_file[]',array('id'=>'file-1a','multiple'=>true,'class'=>'file','multiple'=>'true','data-show-upload'=>false,'data-preview-file-type'=>'any','data-initial-caption'=>'','data-overwrite-initial'=>'false'))}} </div>                              
                            <div class="form-group"><i class="fa fa-paperclip"></i>&nbsp;{{Form::label('Attach File')}}<br/>
                            <?php foreach(explode(', ',$request->attach_file) as $attach_file){ ?>
                              <a href="../{{$attach_file}}" target="_blank">{{$attach_file}}</a><br/>
                            <?php } ?>
                            </div>
                            <div class="form-group"> {{Form::label('date_sent','Sent date')}}
                              <div class="input-group"> <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> {{Form::text('date_sent',Input::old('date_sent',$request->date_sent),array('class'=>'form-control','style'=>'width:auto;'))}} </div>
                            </div>
                            <div class="form-group"> {{Form::label('receiver','Receiver')}}
                              {{Form::textarea('receiver',Input::old('receiver',$request->receiver),array('class'=>'form-control','rows'=>3))}} </div>
                            <div class="form-group"> {{Form::label('userid','Solver')}}<br/>
                              <select class="form-control" name="userid" id="userid" style="width:auto;" disabled="disabled">
                                <option value="" disabled selected>-- Choose solver --</option>
                                  
                                                                                    @foreach($users as $user)
                                                                                        @if($request->solverid==$user->id)
                                                                                            
                                <option value="{{$user->id}}" selected="selected">{{$user->username}}</option>
                                  
                                                                                        @else
                                                                                            
                                <option value="{{$user->id}}">{{$user->username}}</option>
                                  
                                                                                        @endif
                                                                                    @endforeach
                                                                                
                              </select>
                            </div>
                          </div>
                          <div class="box-footer">
                            {{Form::input('submit','','Save changes',array('class'=>'btn-sm btn-primary','value'=>''))}}  
                          </div>
                          {{Form::close()}}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.modal-content --> 
              </div>
              <!-- /.modal-dialog --> 
            </div>
            <!-- end modal --> 
            @endforeach
              </tbody>
            
            <tfoot>
              <tr>
                <th>Order No</th>
                <th>Sender</th>
                <th>Date Sent</th>
                <th>Solver</th>
                <th>Status</th>
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