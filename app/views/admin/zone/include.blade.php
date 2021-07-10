@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Zone&nbsp;{{$zone->zonename}}
                        <!-- <small>advanced tables</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="zone"> Zones</a></li>
                        <li class="active">Linked Banners</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                	<div class="row">
                        <div class="col-xs-12">
                        <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Linked Banners</h3>
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
                                                <th align="left">Name</th>
                                                <th>Status</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($banners as $banner)
                                            <tr>
                                                <td align="center">{{$banner->id}}</td>
                                                <td><a href="{{URL::to('admin/banner-edit-'.$banner->id)}}" title="{{$banner->description}}">{{$banner->description}}</a></td>
                                                <td align="center">
                                                    @if($banner->status==1)
                                                        {{HTML::image('assets/img/icon/active.png','Active',array('title'=>'Active'))}}
                                                    @else
                                                        {{HTML::image('assets/img/icon/inactive.png','Inactive',array('title'=>'Inactive'))}}
                                                    @endif
                                                </td>
                                                <!-- <td align="center"><a href="" title="" class="slide_open">{{HTML::image('assets/img/icon/code.png','',array('title'=>'Invocation Code'))}}&nbsp;Invocation Code</a></td> -->
                                                <td align="center"><a href="{{URL::to('admin/banner-zone-'.$banner->id.'-'.$banner->zoneid)}}" title="Linked Zones"><i class="fa fa-external-link-square"></i>&nbsp;Linked Zones</a></td>
                                                <td align="center"><a href="{{URL::to('admin/banner-show-'.$banner->id)}}" title="Show"><button class="btn-sm btn-default">
											<i class="fa fa-search-plus"></i>
										</button></a>
                                                <a href="{{URL::to('admin/banner-copy-'.$banner->id)}}" title="Copy"><button class="btn-sm btn-default">
											<i class="fa fa-copy"></i>
										</button></a>
                                                <a href="{{URL::to('admin/banner-edit-'.$banner->id)}}" title="Edit"><button class="btn-sm btn-default">
											<i class="fa fa-edit"></i>
										</button></a>
                                                <a href="{{URL::to('admin/banner-delete-'.$banner->id)}}" title="Delete"><button class="btn-sm btn-default" onclick="return confirm('Are you sure you want to move this record to the Recycle Bin? \n{{$banner->description}} \nDate modified: {{$banner->updated_at}}')"><i class="fa fa-trash-o"></i></button></a></td>
                                            </tr>
                                            
                <div id="slide" class="well" style="display:none;top:20%;width:70%;height:60%;">
                <!-- day du lieu vao 1 mang ben javascript -->
                    <textarea class="form-control" style="width:100%;height:100%;"><script language="javascript1.1" type="text/javascript">{gfx=new Array();wdh=new Array();hgt=new Array();lnk=new Array();gfx[0]="{{URL::asset($banner->filename)}}";@if($banner->url=="") lnk[0]="{{URL::asset($banner->filename)}}"; @else lnk[0]="{{$banner->url}}"; @endif wdh[0]={{$banner->width}};hgt[0]={{$banner->height}};document.writeln('<a href="'+lnk[0]+'"><img src="'+gfx[0]+'" border=0 style="width:100%;height:100%;"/></a>');}</script></textarea>
                </div>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th align="left">Name</th>
                                                <th>Status</th>
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