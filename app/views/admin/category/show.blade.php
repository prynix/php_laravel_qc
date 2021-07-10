@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Show category<span class="target">: {{$category->category_name}}</span>
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="category"> Categories</a></li>
                        <li class="active">Show category</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Basic information</h3>
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
                                    <div class="box-body">
                                		{{Form::open()}}
                                        <div class="form-group">
                                            {{Form::label('category_name','Category Name')}}&nbsp;<font color="#FF0000">*</font>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-outdent"></i></span>
                                            	{{Form::text('category_name',Input::old('category_name',$category->category_name),array('class'=>'form-control','disabled'=>'disabled'))}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('parent_id','Parent Node')}}&nbsp;<font color="#FF0000">*</font>
                                            <select class="form-control" name="parent_id" disabled>
                                                <option value="0">-- Select --</option>
                                                <!-- Menu da cap 1 cha nhieu con -->
                                                @foreach($categories as $cat)
                                                    @if($category->parent_id==$cat->id)
                                                        <option value="{{$cat->id}}" selected>{{ $cat->category_name }}</option>
                                                    @else
                                                        <option value="{{$cat->id}}">{{ $cat->category_name }}</option>
                                                    @endif
                                                            @foreach($cat['children'] as $cat)
                                                            
                                                            <option value="{{$cat->id}}">--|&nbsp;{{ $cat->category_name }}</option>
                                                            
                                                            @endforeach
                                                    
                                                @endforeach
                                            </select>
                                        </div>
                                		{{Form::close()}}
                                        <a href="{{URL::to('admin/category')}}"><button class="btn-sm btn-default"><i class="fa fa-arrow-circle-o-left"></i>&nbsp;Back</button></a>
                                    </div>
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->

@stop