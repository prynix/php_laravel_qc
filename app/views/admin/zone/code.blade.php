@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Zone code
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="zone"> Zones</a></li>
                        <li class="active">Zone code</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
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
                                    <div class="form-group">
                                        <textarea class='form-control' id="zone_code" rows="10" style="border-width:2px;" data-step="1" data-intro="Get invocation code of zone">                                       
<script type="text/javascript" @if(Request::server('HTTP_HOST')=='localhost')src="{{URL::to('/')}}/assets/js/bbad.js" @else src="http://qc.tintuc.vn/assets/js/bbad.js"@endif></script>
<script type="text/javascript">
@foreach($website as $w)
    displayBanners({{$zone->id}},'{{$w->website}}');
@endforeach
</script>
<div class="ads-{{$zone->id}}"></div>
                                        </textarea><br/><br/>
                                        <h4 style="font-weight:normal;">Banners display:</h4>
<script type="text/javascript" @if(Request::server('HTTP_HOST')=='localhost')src="{{URL::to('/')}}/assets/js/bbad.js" @else src="http://qc.tintuc.vn/assets/js/bbad.js"@endif></script>
<script type="text/javascript">
@foreach($website as $w)
    displayBanners({{$zone->id}},'{{$w->website}}');
@endforeach
</script>
<div class="ads-{{$zone->id}}"></div>
                                    </div>
                                </div>
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
@stop