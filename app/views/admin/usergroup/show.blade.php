@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Show user group<span class="target">: {{$usergroup->account_name}}</span>
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="usergroup"> User Groups</a></li>
                        <li class="active">Show user group</li>
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
                                    <h3 class="box-title">User Group Details</h3>
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
                            </div>
                        </div>
                                <!-- form start -->
                                	{{Form::open()}}
                                    <div class="box-body">
                                        <div class="form-group">
                                            {{Form::label('account_name','Group Name')}}&nbsp;<font color="#FF0000">*</font>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                            	{{Form::text('account_name',Input::old('account_name',$usergroup->account_name),array('class'=>'form-control','disabled'=>'disabled'))}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('parent_id','Group Parent')}}&nbsp;<font color="#FF0000">*</font>
                                            <select class="form-control" name="parent_id" disabled>
                                                <option value="0">-- Root --</option>
                                                @foreach($usergroups as $ug)
                                                    @if($usergroup->parent_id==$ug->id)
                                                        <option value="{{$ug->id}}" selected>{{ $ug->account_name }}</option>
                                                    @else
                                                        <option value="{{$ug->id}}">{{ $ug->account_name }}</option>
                                                    @endif
                                                        @foreach($ug['children'] as $ug)
                                                            <option value="{{$ug->id}}">--|&nbsp;{{ $ug->account_name }}</option>
                                                        @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!-- /.box-body -->
	                                {{Form::close()}}
                                    <div class="box-footer">
                                        <a href="{{URL::to('admin/usergroup')}}"><button class="btn-sm btn-default"><i class="fa fa-arrow-circle-o-left">&nbsp;Back</i></button></a>
                                    </div>
                            </div><!-- /.box -->
						</div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->

@stop