@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Banner Manager: Banners
                        <!-- <small>advanced tables</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="banner"> Banners</a></li>
                        <li class="active">Recycle Bin</li>
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
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th align="left">Name</th>
                                                <th align="center">Status</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($banners as $banner) 
                                            <tr>
                                                <td><a href="{{URL::to('admin/banner-edit-'.$banner->id)}}" title="">{{$banner->description}}</a></td>
                                                <td align="center">
                                                    @if($banner->status==1)
                                                        {{HTML::image('assets/img/icon/active.png','Active',array('title'=>'Active'))}}
                                                    @else
                                                        {{HTML::image('assets/img/icon/inactive.png','Inactive',array('title'=>'Inactive'))}}
                                                    @endif
                                                </td>
                                                <td align="center"><a href="{{URL::to('admin/banner-revert-'.$banner->id)}}" title="">{{HTML::image('assets/img/icon/revert.png','Revert',array('title'=>'Revert'))}}</a></td>
                                                <td align="center"><a href="{{URL::to('admin/banner-destroy-'.$banner->id)}}" title="" onclick="return confirm('Are you sure you want to permanently delete this record? \n{{$banner->description}} \nDate modified: {{$banner->updated_at}}')">{{HTML::image('assets/img/icon/delete_warning.png','Delete',array('title'=>'Delete'))}}</a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th align="left">Name</th>
                                                <th align="center">Status</th>
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