@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Zone Manager:
                        @if($website)
                            Zones in <a href="{{URL::to('admin/website-edit-'.$website->id)}}" title="">{{$website->name}}</a>
                        @else
							Zones
                        @endif
                        <!-- <small>advanced tables</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Zones</li>
                    </ol>
                    <br/>
                    <div class="row">
                        <div class="col-xs-4">
                            <select class="form-control" id="website_id">
                                <option value="" disabled selected>-- Choose website --</option>
                                @foreach($websites as $website)
                                    <option value="{{$website->id}}">{{ $website->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
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
                                	<div class="form-group">
                                        <a href="{{URL::to('admin/zone-create')}}" id="addNewZone"><button class="btn-sm btn-success"><i class="fa fa-plus"></i>&nbsp;Add new zone</button></a>
                                        <a href="zone-recycle" class="recycle" id="zoneRecycle"><button class="btn-sm btn-facebook"><i class="fa fa-crop"></i>&nbsp;Recycle Bin</button></a>
                                        <button class="slide_open btn-sm btn-default btn-help no-margin-top no-margin-right"><i class="fa fa-anchor"></i>&nbsp;Help</button>
                                    </div>
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
                                    <div class="form-group no-margin-bottom">
                                        <div class="input select rating-a">
                                            <select class="example-a" name="rating">
                                                <option value="1" selected="selected"></option>
                                            </select>&nbsp;<label for="example-a">10.000.000 VND</label>
                                        </div><br/>
                                    </div>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Orrder No</th>
                                                <th align="left">Name</th>
                                                <th align="left">Ad selection</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <!-- <th></th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($zones as $zone) 
                                                
                                                <tr>
                                                    <td align="center">{{$zone->order_no}}</td>
                                                    <td><a href="{{URL::to('admin/zone-edit-'.$zone->id)}}" title="{{$zone->zonename}}">{{$zone->zonename}}</a></td>
                                                    <td>
                                                    @foreach($adtypes as $adtype)
                                                        @if($zone->ad_selection==$adtype->id)
                                                            {{$adtype->title}}
                                                        @else
                                                            
                                                        @endif()
                                                    @endforeach 
                                                    </td>
                                                    <td>
                                                    <div class="input select rating-a">
                                                        <select class="example-a" name="rating">
                                                        <?php
                                                        if($zone->pricing<=10000000) {
                                                            echo '<option value="1" selected="selected"></option>';
                                                        }else if($zone->pricing>10000000&&$zone->pricing<=20000000) {
                                                            for($i=1;$i<2;$i++){
                                                                echo '<option value="'.$i.'"></option>';
                                                            }
                                                            echo '<option value="2" selected="selected"></option>';
                                                        }else if($zone->pricing>20000000&&$zone->pricing<=30000000) {
                                                            for($i=1;$i<3;$i++){
                                                                echo '<option value="'.$i.'"></option>';
                                                            }
                                                            echo '<option value="3" selected="selected"></option>';
                                                        }else if($zone->pricing>30000000&&$zone->pricing<=40000000) {
                                                            for($i=1;$i<4;$i++){
                                                                echo '<option value="'.$i.'"></option>';
                                                            }
                                                            echo '<option value="4" selected="selected"></option>';
                                                        }else if($zone->pricing>40000000&&$zone->pricing<=50000000) {
                                                            for($i=1;$i<5;$i++){
                                                                echo '<option value="'.$i.'"></option>';
                                                            }
                                                            echo '<option value="5" selected="selected"></option>';
                                                        }else if($zone->pricing>50000000&&$zone->pricing<=60000000) {
                                                            for($i=1;$i<6;$i++){
                                                                echo '<option value="'.$i.'"></option>';
                                                            }
                                                            echo '<option value="6" selected="selected"></option>';
                                                        }else if($zone->pricing>60000000&&$zone->pricing<=70000000) {
                                                            for($i=1;$i<7;$i++){
                                                                echo '<option value="'.$i.'"></option>';
                                                            }
                                                            echo '<option value="7" selected="selected"></option>';
                                                        }else if($zone->pricing>70000000&&$zone->pricing<=80000000) {
                                                            for($i=1;$i<8;$i++){
                                                                echo '<option value="'.$i.'"></option>';
                                                            }
                                                            echo '<option value="8" selected="selected"></option>';
                                                        }else if($zone->pricing>80000000&&$zone->pricing<=90000000) {
                                                            for($i=1;$i<9;$i++){
                                                                echo '<option value="'.$i.'"></option>';
                                                            }
                                                            echo '<option value="9" selected="selected"></option>';
                                                        }else if($zone->pricing>90000000&&$zone->pricing<=100000000) {
                                                            for($i=1;$i<10;$i++){
                                                                echo '<option value="'.$i.'"></option>';
                                                            }
                                                            echo '<option value="10" selected="selected"></option>';
                                                        }else if($zone->pricing>100000000) {
                                                            for($i=1;$i<10;$i++){
                                                                echo '<option value="'.$i.'"></option>';
                                                            }
                                                            echo '<option value="11" selected="selected">...</option>';
                                                        }
                                                        ?>
                                                        </select>
                                                    </div>
                                                    </td>
<!--                                                    <td>{{$zone->description}}</td>-->
                                                    <td align="center"><a href="{{URL::to('admin/banner-linked-'.$zone->id)}}" title="Link to banner"><i class="fa fa-picture-o"></i>&nbsp;Linked Banners</a></td>
                                                    <!--<td align="center"><a href="{{URL::to('admin/zone-code-'.$zone->id)}}" title="Invocation Code"><i class="fa fa-code"></i>&nbsp;Invocation Code</a></td>-->
                                                <td align="center">
                                                    @if($zone->id==$first_record->id)
                                                	
                                                @else
                                                	<a href="{{URL::to('admin/zone-move_top-Zone-'.$zone->id)}}" title="Move top" id="moveTop"><button class="btn-sm btn-default"><i class="fa fa-long-arrow-up"></i></button></a>
                                                	<a href="{{URL::to('admin/zone-move_up-Zone-'.$zone->id)}}" title="Move up" id="moveUp"><button class="btn-sm btn-default"><i class="fa fa-arrow-up"></i></button></a>
                                                @endif
                                                @if($zone->id==$last_record->id)     
                                                	                             
                                                @else
                                                	<a href="{{URL::to('admin/zone-move_down-Zone-'.$zone->id)}}" title="Move down" id="moveDown"><button class="btn-sm btn-default"><i class="fa fa-arrow-down"></i></button></a>
                                                	<a href="{{URL::to('admin/zone-move_bottom-Zone-'.$zone->id)}}" title="Move bottom" id="moveBottom"><button class="btn-sm btn-default"><i class="fa fa-long-arrow-down"></i></button></a>
                                                @endif
                                                </td>
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
                                                <th>Order No</th>
                                                <th align="left">Name</th>
                                                <th align="left">Ad selection</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <!-- <th></th> -->
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
@stop