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
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th align="left">Name</th>
                                                <th align="left">Ad selection</th>
                                                <th align="left">Description</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($zones as $zone) 
                                                
                                                <tr>
                                                    <td align="center">{{$zone->id}}</td>
                                                    <td><a href="{{URL::to('admin/zone-edit-'.$zone->id)}}" title="">{{$zone->zonename}}</a></td>
                                                    <td>
                                                    @foreach($adtypes as $adtype)
                                                        @if($zone->ad_selection==$adtype->id)
                                                            {{$adtype->title}}
                                                        @else
                                                            
                                                        @endif()
                                                    @endforeach 
                                                    </td>
                                                    <td>{{$zone->description}}</td>
                                                    <td><a href="{{URL::to('admin/zone-include-'.$zone->id)}}" title="">{{HTML::image('assets/img/icon/application_link.png','',array('title'=>'Linked Banners'))}}&nbsp;Linked Banners</a></td>
                                                    <td align="center"><a href="{{URL::to('admin/zone-code-'.$zone->id)}}" title="">{{HTML::image('assets/img/icon/code.png','',array('title'=>'Invocation Code'))}}&nbsp;Invocation Code</a></td>
                                                    <td align="center"><a href="{{URL::to('admin/zone-show-'.$zone->id)}}" title="">{{HTML::image('assets/img/icon/view.png','View',array('title'=>'View'))}}</a></td>
                                                    <td align="center"><a href="{{URL::to('admin/zone-copy-'.$zone->id)}}" title="">{{HTML::image('assets/img/icon/copy.png','Copy',array('title'=>'Copy'))}}</a></td>
                                                    <td align="center"><a href="{{URL::to('admin/zone-edit-'.$zone->id)}}" title="">{{HTML::image('assets/img/icon/icon_edit.png','Edit',array('title'=>'Edit'))}}</a></td>
                                                    <td align="center"><a href="{{URL::to('admin/zone-delete-'.$zone->id)}}" title="" onclick="return confirm('Are you sure you want to move this record to the Recycle Bin? \n{{$zone->zonename}} \nDate modified: {{$zone->updated_at}}')">{{HTML::image('assets/img/icon/delete.png','Delete',array('title'=>'Delete'))}}</a></td>
                                                </tr>
                                            @endforeach   
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th align="left">Name</th>
                                                <th align="left">Ad selection</th>
                                                <th align="left">Description</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
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