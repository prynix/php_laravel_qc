@extends('layout.main')
@section('content')

<!-- JavaScript Includes -->
<script src="../assets/js/highlight.jquery.js"></script>
<script src="../assets/js/jquery.scrollTo.min.js"></script>
<script src="../assets/js/script.js"></script>
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        User Logs
                        <!-- <small>advanced tables</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">User Log</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                	<div class="row">
                        <div class="col-xs-12">
                        <div class="box">
                                <div class="box-header">
                                    <!-- <h3 class="box-title">Data Table With Full Features</h3> -->                                    
                                </div><!-- /.box-header -->
                                <div style="width:100%;height:33px;"><button class="slide_open btn-sm btn-default float-right margin-right-10"><i class="fa fa-anchor"></i>&nbsp;Help</button>
                                </div>
                                <div id="slide" class="well" style="display:none;top:10%;width:30%;height:80%;bottom:10%;">
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

                                <div class="box-body table-responsive">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Timestamp</th>
                                                <th>Event</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($userlogs as $userlog)
                                                <tr>
                                                    <td align="center"><!--<div class="tooltip yellow-tooltip" style="position:relative;"><span>This is a timestamp</span></div>-->{{$userlog->created_at}}</td>
                                                    <td><!--<div class="tooltip yellow-tooltip" style="text-align:center;position:relative;"><span>This is a event</span></div>-->{{$userlog->details}}</td>
                                                    <td align="center"><a href="{{URL::to('admin/userlog-show-'.$userlog->id)}}" title="Show"><button class="btn-sm btn-default">
											<i class="fa fa-search-plus"></i>
										</button></a>
                                                    <a href="{{URL::to('admin/userlog-delete-'.$userlog->id)}}" title="Delete"><button class="btn-sm btn-default" onclick="return confirm('Are you sure you want to permanently delete this record? \n<?php echo str_replace('"','',$userlog->details); ?> \nDate modified: {{$userlog->updated_at}}')"><i class="fa fa-trash-o"></i></button></a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Timestamp</th>
                                                <th>Event</th>
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