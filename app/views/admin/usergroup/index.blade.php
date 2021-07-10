@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        User Manager: User Groups
                        <!-- <small>advanced tables</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">User Groups</li>
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
                                        <a href="usergroup-create"><button class="btn-sm btn-success"><i class="fa fa-plus"></i>&nbsp;Add new user group</button></a>
                                        <a href="usergroup-recycle" class="recycle"><button class="btn-sm btn-facebook"><i class="fa fa-crop"></i>&nbsp;Recycle Bin</button></a>
                                        <button class="slide_open btn-sm btn-default btn-help margin-left-5 no-margin-top no-margin-right"><i class="fa fa-anchor"></i>&nbsp;Help</button>
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
                                    <table id="example5" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th align="left">Group Type</th>
                                                <th align="left">Group Name</th>
                                                <th>Status</th>
                                                <th>Users in group</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($acc_parent as $acc)    
                                                @if($acc->parent_id==0)
                                                <tr>
                                                    <td align="center">{{$acc->id}}</td>
                                                    <td>{{$acc->account_type}}</td>
                                                    <td><a href="{{URL::to('admin/usergroup-edit-'.$acc->id)}}" title="{{$acc->account_name}}">
                                                        {{$acc->account_name}}
                                                    
                                                    </a></td>                                               		<td align="center">
                                                    	@if($acc->status==1)
															<span class="label label-success"><i class="fa fa-check-circle"></i></span>
														@else
															<span class="label label-warning"><i class="fa fa-times-circle-o"></i></span>
														@endif
                                                    </td>
                                                    <td align="center">
                                                        <?php $count=0; ?>
                                                        @foreach($number_users as $number_user)
                                                            @if($number_user->default_account_id==$acc->id)
                                                                <?php $count++; ?>
                                                            @endif
                                                        @endforeach
                                                        <?php echo $count; ?>
                                                    </td>
                                                    <td align="center"><a href="{{URL::to('admin/usergroup-show-'.$acc->id)}}" title="Show"><button class="btn-sm btn-default">
											<i class="fa fa-search-plus"></i>
										</button></a>
                                                    <a href="{{URL::to('admin/usergroup-copy-'.$acc->id)}}" title="Copy"><button class="btn-sm btn-default">
											<i class="fa fa-copy"></i>
										</button></a>
                                                    <a href="{{URL::to('admin/usergroup-edit-'.$acc->id)}}" title="Edit"><button class="btn-sm btn-default">
											<i class="fa fa-edit"></i>
										</button></a>
                                                    <a href="{{URL::to('admin/usergroup-delete-'.$acc->id)}}" title="Delete"><button class="btn-sm btn-default" onclick="return confirm('Are you sure you want to move this record to the Recycle Bin? \n{{$acc->account_name}} \nDate modified: {{$acc->updated_at}}?')"><i class="fa fa-trash-o"></i></button></a></td>
                                                </tr>
                                                @foreach($accounts as $account)  
                                                    @if($account->parent_id==$acc->id)
                                                        <tr>
                                                    <td align="center">{{$account->id}}</td>
                                                    <td>{{$account->account_type}}</td>
                                                    <td><a href="{{URL::to('admin/usergroup-edit-'.$account->id)}}" title="{{$account->account_name}}">
                                                        --| {{$account->account_name}}
                                                    </a></td>                                               		<td align="center">
                                                    	@if($account->status==1)
															<span class="label label-success"><i class="fa fa-check-circle"></i></span>
														@else
															<span class="label label-warning"><i class="fa fa-times-circle-o"></i></span>
														@endif
                                                    </td>
                                                    <td align="center">
                                                        <?php $count=0; ?>
                                                        @foreach($number_users as $number_user)
                                                            @if($number_user->default_account_id==$account->id)
                                                                <?php $count++; ?>
                                                            @endif
                                                        @endforeach
                                                        <?php echo $count; ?>
                                                    </td>
                                                    <td align="center"><a href="{{URL::to('admin/usergroup-show-'.$account->id)}}" title="Show"><button class="btn-sm btn-default">
											<i class="fa fa-search-plus"></i>
										</button></a>
                                                    <a href="{{URL::to('admin/usergroup-copy-'.$account->id)}}" title="Copy"><button class="btn-sm btn-default">
											<i class="fa fa-copy"></i>
										</button></a>
                                                    <a href="{{URL::to('admin/usergroup-edit-'.$account->id)}}" title="Edit"><button class="btn-sm btn-default">
											<i class="fa fa-edit"></i>
										</button></a>
                                                    <a href="{{URL::to('admin/usergroup-delete-'.$account->id)}}" title="Delete"><button class="btn-sm btn-default" onclick="return confirm('Are you sure you want to move this record to the Recycle Bin? \n{{$account->account_name}} \nDate modified: {{$account->updated_at}}?')"><i class="fa fa-trash-o"></i></button></a></td>
                                                </tr>
                                                    @endif
                                                @endforeach
                                                @endif
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th align="left">Group Type</th>
                                                <th align="left">Group Name</th>
                                                <th>Status</th>
                                                <th>Users in group</th>
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