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
                        <li><a href="user"> Users</a></li>
                        <li class="active">Recycle Bin</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                	<div class="row">
                        <div class="col-xs-12">
                        <div class="box">
                                <div class="box-header">
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th align="left">Username</th>
                                                <th align="left">Email</th>
                                                <th align="left">Contact Name</th>
                                                <th align="left">Date Created</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $user)
                                            <tr>
                                                <td><a href="{{URL::to('admin/user-edit-'.$user->id)}}" title="">{{$user->username}}</a></td>
                                                <td><a href="{{URL::to('admin/user-edit-'.$user->id)}}" title="">{{$user->email_address}}</a></td>
                                                <td>{{$user->contact_name}}</td>
                                                <td>{{$user->created_at}}</td>
                                                <td align="center"><a href="{{URL::to('admin/user-revert-'.$user->id)}}" title="">{{HTML::image('assets/img/icon/revert.png','Revert',array('title'=>'Revert'))}}</a></td>
                                                <td align="center"><a href="{{URL::to('admin/user-delete-'.$user->id)}}" title="" onclick="return confirm('Are you sure you want to permanently delete this record? \n{{$user->username}} \nDate modified: {{$user->updated_at}}')">{{HTML::image('assets/img/icon/delete_warning.png','Delete',array('title'=>'Delete'))}}</a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th align="left">Username</th>
                                                <th align="left">Email</th>
                                                <th align="left">Contact Name</th>
                                                <th align="left">Date Created</th>
                                                <th></th>
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
