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
                        <li><a href="usergroup"> User Groups</a></li>
                        <li class="active">Recycle Bin</li>
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
                                <div class="box-header">
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
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
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
                                                    
                                                    </a></td>                                                       <td align="center">
                                                        @if($acc->status==1)
                                                            <span class="label label-success"><i class="fa fa-check-circle"></i></span>
                                                        @else
                                                            <span class="label label-danger"><i class="fa fa-times-circle-o"></i></span>
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
                                                    <td align="center"><a href="{{URL::to('admin/usergroup-revert-'.$acc->id)}}" title="Restore"><button class="btn-sm btn-default"><i class="fa fa-undo"></i></button></a>
                                                    <a href="{{URL::to('admin/usergroup-destroy-'.$acc->id)}}" title="Delete" onclick="return confirm('Are you sure you want to permanently delete this record? \n{{$acc->account_name}} \nDate modified: {{$acc->updated_at}}')"><button class="btn-sm btn-default"><i class="fa fa-trash-o"></i></button></a></td>
                                                </tr>
                                                    @foreach($accounts as $account)  
                                                        @if($account->parent_id==$acc->id)
                                                            <tr>
                                                                <td align="center">{{$account->id}}</td>
                                                                <td>{{$account->account_type}}</td>
                                                                <td><a href="{{URL::to('admin/usergroup-edit-'.$account->id)}}" title="{{$account->account_name}}">
                                                                    --| {{$account->account_name}}
                                                                </a></td>                                                       <td align="center">
                                                                    @if($account->status==1)
                                                                        <span class="label label-success"><i class="fa fa-check-circle"></i></span>
                                                                    @else
                                                                        <span class="label label-danger"><i class="fa fa-times-circle-o"></i></span>
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
                                                                <td align="center"><a href="{{URL::to('admin/usergroup-revert-'.$account->id)}}" title="Restore"><button class="btn-sm btn-default"><i class="fa fa-undo"></i></button></a>
                                                                <a href="{{URL::to('admin/usergroup-destroy-'.$account->id)}}" title="Delete" onclick="return confirm('Are you sure you want to permanently delete this record? \n{{$account->account_name}} \nDate modified: {{$account->updated_at}}')"><button class="btn-sm btn-default"><i class="fa fa-trash-o"></i></button></a></td>
                                                            </tr>
                                                        @else

                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                            @foreach($exceptions as $account)  
                                                            <tr>
                                                                <td align="center">{{$account->id}}</td>
                                                                <td>{{$account->account_type}}</td>
                                                                <td><a href="{{URL::to('admin/usergroup-edit-'.$account->id)}}" title="{{$account->account_name}}">
                                                                    --| {{$account->account_name}}
                                                                </a></td>                                                       <td align="center">
                                                                    @if($account->status==1)
                                                                        <span class="label label-success"><i class="fa fa-check-circle"></i></span>
                                                                    @else
                                                                        <span class="label label-danger"><i class="fa fa-times-circle-o"></i></span>
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
                                                                <td align="center"><a href="{{URL::to('admin/usergroup-revert-'.$account->id)}}" title="Restore"><button class="btn-sm btn-default"><i class="fa fa-undo"></i></button></a>
                                                                <a href="{{URL::to('admin/usergroup-destroy-'.$account->id)}}" title="Delete" onclick="return confirm('Are you sure you want to permanently delete this record? \n{{$account->account_name}} \nDate modified: {{$account->updated_at}}')"><button class="btn-sm btn-default"><i class="fa fa-trash-o"></i></button></a></td>
                                                            </tr>
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