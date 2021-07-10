@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
<script type="text/javascript">
    $('.left-side').addClass('collapse-left');
    $('.right-side').addClass('strech');
</script>
                <section class="content-header">
                    <h1>
                        Hits and Visitors
                        <!-- <small>advanced tables</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Hits and Visitors</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                	<div class="row">
                        <div class="col-xs-4">
                        <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title" style="font-size:15px;">Total Hits&nbsp;{{$total_hits}}</h3>    
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
                                                <th>Page</th>
                                                <th>Hits</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($websites as $website)
                                                <tr>
                                                    <td align="center">{{$website['id']}}</td>
                                                    <td>{{$website['website']}}</td>
                                                    <td>{{$website['total_views']}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Page</th>
                                                <th>Hits</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                        <!-- box 2 -->
                        <div class="col-xs-8">
                        <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title" style="font-size:15px;">Total unique IP´s&nbsp;{{$total_unique_ip}}</h3>    
                                    <a href="#myModalHelp" title="Help" data-toggle="modal">
                                    <button class="btn-sm btn-default btn-help">
                                        <i class="fa fa-anchor"></i>&nbsp;Help
                                    </button></a>
                                                    <?php //Demo region
                                                        $geo=curl_init();
                                                        curl_setopt($geo, CURLOPT_URL, "http://www.geoplugin.net/php.gp?ip=14.177.216.218");
                                                        //curl_setopt($geo, CURLOPT_CONNECTTIMEOUT, 2);
                                                        curl_setopt($geo, CURLOPT_RETURNTRANSFER, true);
                                                        //curl_setopt($geo, CURLOPT_USERAGENT, '');
                                                        $query=curl_exec($geo);  
                                                        //$city=$query["geoplugin_city"];
                                                        //$region=$query["geoplugin_regionName"];
                                                        //$country=$query["geoplugin_countryName"];
                                                        curl_close($geo); 
                                                        //echo '<pre/>'; print_r(unserialize($query));
                                                        $ipinfo=curl_init();
                                                        curl_setopt($ipinfo, CURLOPT_URL, "http://ipinfo.io/14.177.216.218/json");
                                                        curl_setopt($ipinfo, CURLOPT_RETURNTRANSFER, true);
                                                        $q=curl_exec($ipinfo);
                                                        curl_close($ipinfo);
                                                        $obj=json_decode($q);
                                                        //print_r($obj);
                                                        //echo 'IP:&nbsp;'; print_r($obj->ip); echo '<br/>';
                                                        //echo 'Network:&nbsp;'; print_r($obj->org); echo '<br/>';
                                                    ?>
                                </div><!-- /.box-header -->
                                <div class="modal fade" id="myModalHelp"
							tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
							aria-hidden="true">
								    <div class="modal-dialog">
									   <div class="modal-content">
										  <div class="modal-body">
                                                <div class="well">
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
                                           </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body table-responsive">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>IP</th>
                                                <th>User agent</th>
                                                <th>Region</th>
                                                <th></th>
                                                <th>Date & Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($views as $view)
                                                <tr>
                                                    <td>{{($view['ip_address']=='::1')?'127.0.0.1':$view['ip_address']}}</td>
                                                    <td>{{$view['user_agent']}}</td>
                                                    <td>
                                                        {{$view['region']}}
                                                    </td>
                                                    <td>
                                                        <button class="btn-sm btn-default" data-target="#location-dialog-{{$view['id']}}" data-toggle="modal"><i class="fa fa-map-marker"></i>&nbsp;Location</button>
                                                    </td>
                                                    <td>{{$view['view_at']}}</td>
                                                </tr>
                                                <div id="location-dialog-{{$view['id']}}" class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title">Location IP Address Info</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-horizontal" style="width: 550px">
                                                                    <div class="form-group">
                                                                        <label class="col-sm-2 control-label">Location:</label>

                                                                        <div class="col-sm-10"><input type="text" class="form-control" id="us3-address-{{$view['id']}}" placeholder="Enter location ..."/></div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-sm-2 control-label">Radius:</label>

                                                                        <div class="col-sm-5"><input type="text" class="form-control" id="us3-radius-{{$view['id']}}"/></div>
                                                                    </div>
                                                                    <div id="us3-{{$view['id']}}" style="width: 100%; height: 400px;"></div>
                                                                    <div class="clearfix">&nbsp;</div>
                                                                    <div class="m-t-small">
                                                                        <label class="p-r-small col-sm-1 control-label">Lat.:</label>

                                                                        <div class="col-sm-3"><input type="text" class="form-control" style="width: 110px" id="us3-lat-{{$view['id']}}" value="{{$view['lat']}}"/></div>
                                                                        <label class="p-r-small col-sm-2 control-label">Long.:</label>

                                                                        <div class="col-sm-3"><input type="text" class="form-control" style="width: 110px" id="us3-lon-{{$view['id']}}" value="{{$view['long']}}"/></div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <script type="text/javascript">
                                                                        var lat=($('#us3-lat-{{$view["id"]}}').val()!='')?$('#us3-lat-{{$view["id"]}}').val():21.033333300000000000;
                                                                        var long=($('#us3-lon-{{$view["id"]}}').val()!='')?$('#us3-lon-{{$view["id"]}}').val():105.850000000000020000;
                                                                        $('#us3-{{$view["id"]}}').locationpicker({
                                                                            location: {latitude: lat, longitude: long},
                                                                            radius: 300,
                                                                            inputBinding: {
                                                                                latitudeInput: $('#us3-lat-{{$view["id"]}}'),
                                                                                longitudeInput: $('#us3-lon-{{$view["id"]}}'),
                                                                                radiusInput: $('#us3-radius-{{$view["id"]}}'),
                                                                                locationNameInput: $('#us3-address-{{$view["id"]}}')
                                                                            },
                                                                            enableAutocomplete: true
                                                                        });
                                                                        $('#location-dialog-{{$view["id"]}}').on('shown.bs.modal', function() {
                                                                            $('#us3-{{$view["id"]}}').locationpicker('autosize');
                                                                        });
                                                                    </script>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>IP</th>
                                                <th>User agent</th>
                                                <th>Region</th>
                                                <th></th>
                                                <th>Date & Time</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                        <!-- end box 2 -->
                    </div>
                </section><!-- /.content -->
@stop