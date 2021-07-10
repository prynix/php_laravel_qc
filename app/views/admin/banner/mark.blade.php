@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Banner Manager: Mark Banners
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="banner"> Banners</a></li>
                        <li class="active">Mark banner</li>
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
                                    <table id="example3" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th></th>
                                                <th>Order No</th>
                                                <th>Image Preview</th>
                                                <th align="left">Name</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($banners as $banner) 
                                            <tr>
                                            	<td align="center">
                                            		{{Form::input('checkbox','check_mark',$banner->mark,array('bannerid'=>$banner->id))}}
                                            	</td>
                                                <td align="center">{{$banner->order_no}}</td>
                                                <td align="center">
                                                	@if($banner->htmltemplate!='')
                                                		<div style="border:2px solid #3498db;">{{$banner->htmltemplate}}</div>
                                                	@else
                                                		@if($banner->filename!='')
											            	{{HTML::image($banner->filename,'',array('onerror'=>"this.onerror=null;this.src='http://localhost/l4-bbad/public/assets/img/icon/filenotfound.png'",'width'=>'100%'))}}
											            @else
											            	{{HTML::image('assets/img/icon/filenotfound.png','File Not Found')}}
											            @endif
                                                	@endif
                                                </td>
                                                <td><a href="{{URL::to('admin/banner-edit-'.$banner->id)}}" title="{{$banner->description}}">{{$banner->description}}</a></td>
                                                <td align="center">
                                                    @if($banner->status==1)
                                                        <span class="label label-success">Active</span>
                                                    @else
                                                        <span class="label label-danger">Banned</span>
                                                    @endif
                                                </td>
                                                <td align="center"><a href="{{URL::to('admin/banner-zone-'.$banner->id.'-'.$banner->zoneid)}}" title="Link to Zone"><i class="fa fa-external-link"></i>&nbsp;Linked Zones</a></td>                                                
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            	<th></th>
                                                <th>Order No</th>
                                                <th>Image Preview</th>
                                                <th align="left">Name</th>
                                                <th>Status</th>
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