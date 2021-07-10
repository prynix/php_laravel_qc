@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Show user log
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="userlog"> User Log</a></li>
                        <li class="active">Show user log</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Event Details</h3>
                                    <button class="slide_open btn-sm btn-default float-right margin-top-10 margin-right-10"><i class="fa fa-anchor"></i>&nbsp;Help</button>
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
                                <div class="box-body table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <td>ID</td>
                                            <td>#{{$userlog->contextid}}</td>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td>{{$userlog->object}}</td>
                                        </tr>
                                        <tr>
                                            <td>Type</td>
                                            <td>{{$userlog->context}}</td>
                                        </tr>
                                        <tr>
                                            <td>Action</td>
                                            <td>{{$userlog->action}}</td>
                                        </tr>
                                        <tr>
                                            <td>Username</td>
                                            <td>{{$userlog->username}}</td>
                                        </tr>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
						</div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->

@stop