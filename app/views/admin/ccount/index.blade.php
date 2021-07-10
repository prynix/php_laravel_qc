@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Click Counter
                        <!-- <small>advanced tables</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Click Counter</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                	<div class="row">
                        <div class="col-xs-12">
                        <div class="box">
                                <div class="box-body table-responsive">
                                	<div class="form-group clearfix full-width">
                                        <button class="slide_open btn-sm btn-default btn-help float-left no-margin-left no-margin-top"><i class="fa fa-anchor"></i>&nbsp;Help</button>
                                        <!--<a href="ccount-create"><button class="btn btn-success">Add new link</button></a>-->
    <!--                                    <a href="ccount-recycle" style="display:inline-block;margin:10px 10px 10px 0;"><button class="btn btn-bitbucket">Recycle Bin</button></a>-->
                                        <p class="box-title" style="font-size:14px;float:right;text-align:right;">
                                            <b>Total clicks:&nbsp;{{$total_clicks}}</b>&nbsp;&nbsp;(<?php echo round($total_clicks/$amount,2); ?>&nbsp;per link)<br/>                                
                                            <b>Total unique clicks:&nbsp;{{$unique_click}}</b>&nbsp;&nbsp;(<?php echo round($unique_click/$amount,2); ?>&nbsp;per link)
                                        </p>
                                    </div><br/>
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
                                                <th>Added</th>
                                                <th>Name</th>
                                                <th>Clicks (total)</th>
                                                <th>Clicks (unique)</th>
                                                <th>Link</th>
                                                <th>Graph</th>
                                                
                                                <th></th>
                                                <th></th>
                                                
                                                <th></th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($banners as $banner)
                                                <tr>
                                                    <td align="center">{{$banner->id}}</td>
                                                    <td align="center">{{$banner->created_at}}</td>
                                                    <td><a href="{{URL::to('admin/banner-show-'.$banner->id)}}" title="">{{$banner->description}}</a></td>
                                                    <td align="center">{{$banner->total_clicks}}</td>
                                                    <td align="center">{{$banner->unique_click}}</td>
                                                    <td align="left"><a target="_blank" href="{{$banner->url}}" title="">{{$banner->title}}</a></td>
                                                    <td align="center">
                                                        <div class="progress sm progress-striped active">
                                                            @if($total_clicks>0)
                                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: {{$banner->total_clicks/$total_clicks*100}}%">
                                                            @else
                                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                                            @endif
                                                                <span class="sr-only"></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td align="center"><a href="{{URL::to('admin/ccount-generate-url-'.$banner->id)}}" title="Generate URL" class=""><button class="btn-sm btn-default"><i class="fa fa-code-fork"></i></button></a>
                                                        
                                                    </td>
                                                    <!-- <td align="center"><a href="{{URL::to('admin/ccount-reset-'.$banner->id)}}" title="">{{HTML::image('assets/img/icon/reset.png','Reset',array('title'=>'Reset'))}}</a></td> -->
                                                    <td align="center"><a href="{{URL::to('admin/ccount-show-'.$banner->id)}}" title="Show"><button class="btn-sm btn-default">
											<i class="fa fa-search-plus"></i>
										</button></a></td>
                                                    <!-- <td align="center"><a href="{{URL::to('admin/ccount-copy-'.$banner->id)}}" title="">{{HTML::image('assets/img/icon/copy.png','Copy',array('title'=>'Copy'))}}</a></td> -->
                                                    <td align="center"><a href="{{URL::to('admin/ccount-edit-'.$banner->id)}}" title="Edit"><button class="btn-sm btn-default">
											<i class="fa fa-edit"></i>
										</button></a></td>
                                                    <!-- <td align="center"><a href="{{URL::to('admin/ccount-delete-'.$banner->id)}}" title="" onclick="return confirm('Are you sure you want to delete {{$banner->title}} ?')">{{HTML::image('assets/img/icon/delete.png','Delete',array('title'=>'Delete'))}}</a></td> -->
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Added</th>
                                                <th>Name</th>
                                                <th>Clicks (total)</th>
                                                <th>Clicks (unique)</th>
                                                <th>Link</th>
                                                <th>Graph</th>
                                                
                                                <th></th>
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