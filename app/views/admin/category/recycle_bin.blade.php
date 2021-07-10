@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Category Manager: Categories
                        <!-- <small>advanced tables</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="category"> Categories</a></li>
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
                                    <button class="slide_open btn-sm btn-default btn-help margin-left-5"><i class="fa fa-anchor"></i>&nbsp;Help</button>                   
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
                                                <th>Category name</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
<!-- <select>
    @foreach($categories as $category)
        <option>{{ $category->category_name }} - {{ $category->id }}</option>
                @foreach($category['children'] as $category)
                
                <option>--|&nbsp;{{ $category->category_name }} - {{ $category->id }}</option>
                
                @endforeach
        
    @endforeach
</select> -->
                                            @foreach($categories as $category) 
                                            <tr>
                                                <td align="center">{{$category->id}}</td>
                                                <td>
                                                    <span title="{{ $category->category_name }}">
                                                    {{ $category->category_name }}
                                                    </span>
                                                </td>
                                                <td align="center"><a href="{{URL::to('admin/category-revert-'.$category->id)}}" title="Restore"><button class="btn-sm btn-default">
											<i class="fa fa-undo"></i>
										</button></a>
                                                <a href="{{URL::to('admin/category-destroy-'.$category->id)}}" title="Delete"><button class="btn-sm btn-default" onclick="return confirm('Are you sure you want to permanently delete this record? \n{{$category->category_name}} \nDate modified: {{$category->updated_at}}')"><i class="fa fa-trash-o"></i></button></a></td>
                                            </tr>
                                                @foreach($category['children'] as $child)
                                                    <tr>
                                                        <td align="center">{{$child->id}}</td>
                                                        <td>
                                                            <span title="{{ $category->category_name }}">
                                                            |--&nbsp;{{ $child->category_name }}
                                                            </span>
                                                        </td>
                                                        <td align="center"><a href="{{URL::to('admin/category-revert-'.$child->id)}}" title="Restore"><button class="btn-sm btn-default">
											<i class="fa fa-undo"></i>
										</button></a>
                                                        <a href="{{URL::to('admin/category-destroy-'.$child->id)}}" title="Delete"><button class="btn-sm btn-default" onclick="return confirm('Are you sure you want to permanently delete this record? \n{{$child->category_name}} \nDate modified: {{$child->updated_at}}')"><i class="fa fa-trash-o"></i></button></a></td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Category name</th>
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