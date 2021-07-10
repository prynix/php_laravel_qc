@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Banner: {{$banner->description}}
                        <!-- <small>advanced tables</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="banner"> Banners</a></li>
                        <li class="active">Linked Zones</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                        <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Linked Zones</h3>        
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
                                                <th align="left">Ad selection</th>
                                                <th align="left">Description</th>
                                                <!--<th></th>-->
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($zones as $zone) 
                                                
                                                <tr>
                                                    <td align="center">{{$zone->id}}</td>
                                                    <td><a href="{{URL::to('admin/zone-edit-'.$zone->id)}}" title="{{$zone->zonename}}">{{$zone->zonename}}</a></td>
                                                    <td>
                                                    @foreach($adtypes as $adtype)
                                                        @if($zone->ad_selection==$adtype->id)
                                                            {{$adtype->title}}
                                                        @else
                                                            
                                                        @endif()
                                                    @endforeach 
                                                    </td>
                                                    <td>{{$zone->description}}</td>
                                                    <!--<td align="center"><a href="{{URL::to('admin/zone-include-'.$zone->id)}}" title="">{{HTML::image('assets/img/icon/application_link.png','',array('title'=>'Linked Banners'))}}&nbsp;Linked Banners</a></td>-->
                                                    <td align="center"><a href="{{URL::to('admin/zone-code-'.$zone->id)}}" title="Invocation Code"><i class="fa fa-code"></i>&nbsp;Invocation Code</a>
                                                    <td align="center"><a href="{{URL::to('admin/zone-show-'.$zone->id)}}" title="Show"><button class="btn-sm btn-default">
											<i class="fa fa-search-plus"></i>
										</button></a>
                                                    <a href="{{URL::to('admin/zone-copy-'.$zone->id)}}" title="Copy"><button class="btn-sm btn-default">
											<i class="fa fa-copy"></i>
										</button></a>
                                                    <a href="{{URL::to('admin/zone-edit-'.$zone->id)}}" title="Edit"><button class="btn-sm btn-default">
											<i class="fa fa-edit"></i>
										</button></a>
                                                    <a href="{{URL::to('admin/zone-delete-'.$zone->id)}}" title="Delete"><button class="btn-sm btn-default" onclick="return confirm('Are you sure you want to move this record to the Recycle Bin? \n{{$zone->zonename}} \nDate modified: {{$zone->updated_at}}')"><i class="fa fa-trash-o"></i></button></a></td>
                                                </tr>
                                            @endforeach   
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th align="left">Name</th>
                                                <th align="left">Ad selection</th>
                                                <th align="left">Description</th>
                                                <!--<th></th>-->
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