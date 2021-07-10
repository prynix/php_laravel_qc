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
                	<div class="row">
                        <div class="col-xs-12">
                        <div class="box">
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th>ID</th>
                                                <th align="left">Username</th>
                                                <th align="left">Email</th>
                                                <th align="left">Contact Name</th>
                                                <th align="left">Date Created</th>
                                                <!--<th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>-->
                                                <th></th>
                                                <!--<th></th>
                                                <th></th>
                                                <th></th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $user)
                                            <tr>
                                            	<td align="center">{{$user->id}}</td>
                                                <td><a href="{{URL::to('advertiser/user-show-'.$user->id)}}" title="">{{$user->username}}</a></td>
                                                <td><a href="{{URL::to('advertiser/user-show-'.$user->id)}}" title="">{{$user->email_address}}</a></td>
                                                <td>{{$user->contact_name}}</td>
                                                <td>{{$user->created_at}}</td>
                                                <!--<td align="center"><a href="{{URL::to('advertiser/user-edit-'.$user->id)}}" title="Role">{{HTML::image('assets/img/icon/members.png','',array('title'=>'Role'))}}&nbsp;Role</a></td>
                                                	@if($user->id==$first_record->id)
                                                        <td></td>
                                                        <td></td>
                                                    @else
                                                        <td align="center"><a href="{{URL::to('advertiser/user-move_top-user-'.$user->id)}}" title="">{{HTML::image('assets/img/icon/move_top.png','Move Top',array('title'=>'Move Top','width'=>'16px'))}}</a></td>
                                                        <td align="center"><a href="{{URL::to('advertiser/user-move_up-user-'.$user->id)}}" title="">{{HTML::image('assets/img/icon/move_up.png','Move Up',array('title'=>'Move Up','width'=>'20px'))}}</td>
                                                    @endif
                                                    @if($user->id==$last_record->id)     
                                                        <td></td>  
                                                        <td></td>                             
                                                    @else
                                                        <td align="center"><a href="{{URL::to('advertiser/user-move_down-user-'.$user->id)}}" title="">{{HTML::image('assets/img/icon/move_down.png','Move Down',array('title'=>'Move Down','width'=>'20px'))}}</td>
                                                        <td align="center"><a href="{{URL::to('advertiser/user-move_bottom-user-'.$user->id)}}" title="">{{HTML::image('assets/img/icon/move_bottom.png','Move Bottom',array('title'=>'Move Bottom','width'=>'16px'))}}</td>
                                                    @endif-->
                                                <td align="center"><a href="{{URL::to('advertiser/user-show-'.$user->id)}}" title=""><i class="fa fa-search"></i></a></td>
                                                <!--<td align="center"><a href="{{URL::to('advertiser/user-copy-'.$user->id)}}" title="">{{HTML::image('assets/img/icon/copy.png','Copy',array('title'=>'Copy'))}}</a></td>
                                                <td align="center"><a href="{{URL::to('advertiser/user-edit-'.$user->id)}}" title="">{{HTML::image('assets/img/icon/icon_edit.png','Edit',array('title'=>'Edit'))}}</a></td>
                                                <td align="center"><a href="{{URL::to('advertiser/user-delete-'.$user->id)}}" title="" onclick="return confirm('Are you sure you want to move this record to the Recycle Bin? \n{{$user->username}} \nDate modified: {{$user->updated_at}}')">{{HTML::image('assets/img/icon/delete.png','Delete',array('title'=>'Delete'))}}</a></td>-->
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
                                                <!--<th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>-->
                                                <th></th>
                                                <!--<th></th>
                                                <th></th>
                                                <th></th>-->
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
@stop
