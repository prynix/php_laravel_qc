@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        User Manager: Users
                        <!-- <small>advanced tables</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Users</li>
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
                                <div class="box-body table-responsive">
                                	<div class="form-group">
                                        <a href="user-create"><button class="btn-sm btn-success"><i class="fa fa-plus"></i>&nbsp;Add new user</button></a>
                                        <a href="user-recycle" class="recycle"><button class="btn-sm btn-bitbucket"><i class="fa fa-crop"></i>&nbsp;Recycle Bin</button></a>
                                        <button class="slide_open btn-sm btn-default btn-help no-float margin-left-5 no-margin-top no-margin-right"><i class="fa fa-anchor"></i>&nbsp;Help</button>
                                        <p class="box-title" style="font-size:14px;float:right;text-align:right;">
                                            Total accounts:&nbsp;<b>{{$total_accounts}}</b>
                                        </p>
                                    </div>
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
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th>ID</th>
                                                <th align="left">Username</th>
                                                <th align="left">Email</th>
                                                <th align="left">Contact Name</th>
                                                <th align="left">Date Created</th>
                                                <th></th>
                                                @if($total_accounts==1)
                                                @else
                                                <!-- <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th> -->
                                                @endif
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $user)
                                            <tr>
                                            	<td align="center">{{$user->id}}</td>
                                                <td><a href="{{URL::to('admin/user-edit-'.$user->id)}}" title="{{$user->username}}">{{$user->username}}</a></td>
                                                <td><a href="{{URL::to('admin/user-edit-'.$user->id)}}" title="{{$user->email_address}}">{{$user->email}}</a></td>
                                                <td>{{$user->contact_name}}</td>
                                                <td>{{$user->created_at}}</td>
                                                <td align="center"><a href="{{URL::to('admin/user-edit-'.$user->id)}}" title="Role"><!--{{HTML::image('assets/img/icon/members.png','',array('title'=>'Role'))}}--><i class="fa fa-users"></i>&nbsp;Role</a></td>
                                                @if($total_accounts==1)
                                                @else
                                                	<!-- @if($user->id==$first_record->id)
                                                        <td></td>
                                                        <td></td>
                                                    @else
                                                        <td align="center"><a href="{{URL::to('admin/user-move_top-user-'.$user->id)}}" title="">{{HTML::image('assets/img/icon/move_top.png','Move Top',array('title'=>'Move Top','width'=>'16px'))}}</a></td>
                                                        <td align="center"><a href="{{URL::to('admin/user-move_up-user-'.$user->id)}}" title="">{{HTML::image('assets/img/icon/move_up.png','Move Up',array('title'=>'Move Up','width'=>'20px'))}}</td>
                                                    @endif
                                                    @if($user->id==$last_record->id)     
                                                        <td></td>  
                                                        <td></td>                             
                                                    @else
                                                        <td align="center"><a href="{{URL::to('admin/user-move_down-user-'.$user->id)}}" title="">{{HTML::image('assets/img/icon/move_down.png','Move Down',array('title'=>'Move Down','width'=>'20px'))}}</td>
                                                        <td align="center"><a href="{{URL::to('admin/user-move_bottom-user-'.$user->id)}}" title="">{{HTML::image('assets/img/icon/move_bottom.png','Move Bottom',array('title'=>'Move Bottom','width'=>'16px'))}}</td>
                                                    @endif -->
                                                @endif
                                                <td align="center"><a href="{{URL::to('admin/user-show-'.$user->id)}}" title="Show"><button class="btn-sm btn-default">
											<i class="fa fa-search-plus"></i>
										</button></a>
                                                <a href="{{URL::to('admin/user-copy-'.$user->id)}}" title="Copy"><button class="btn-sm btn-default">
											<i class="fa fa-copy"></i>
										</button></a>
                                                <a href="{{URL::to('admin/user-edit-'.$user->id)}}" title="Edit"><button class="btn-sm btn-default">
											<i class="fa fa-edit"></i>
										</button></a>
                                                <a href="{{URL::to('admin/user-delete-'.$user->id)}}" title="Delete"><button class="btn-sm btn-default" onclick="return confirm('Are you sure you want to move this record to the Recycle Bin? \n{{$user->username}} \nDate modified: {{$user->updated_at}}')"><i class="fa fa-trash-o"></i></button></a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            	<th>ID</th>
                                                <th align="left">Username</th>
                                                <th align="left">Email</th>
                                                <th align="left">Contact Name</th>
                                                <th align="left">Date Created</th>
                                                <th></th>
                                                @if($total_accounts==1)
                                                @else
                                                <!-- <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th> -->
                                                @endif
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
