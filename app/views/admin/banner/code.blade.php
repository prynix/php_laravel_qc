@extends('layout.main')
@section('content')
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Banner code
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="banner"> Banners</a></li>
                        <li class="active">Banner code</li>
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
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div class="form-group">
                                        <textarea class='form-control' rows="10"><script language="javascript1.1" type="text/javascript">{gfx=new Array();wdh=new Array();hgt=new Array();lnk=new Array();gfx[0]="{{URL::asset($banner->filename)}}";@if($banner->url=="") lnk[0]="{{URL::asset($banner->filename)}}"; @else lnk[0]="{{$banner->url}}"; @endif wdh[0]={{$banner->width}};hgt[0]={{$banner->height}};document.writeln('<a href="'+lnk[0]+'"><img src="'+gfx[0]+'" border=0 style="width:100%;height:100%;"/></a>');}</script>
                                        </textarea>
                                    </div>
                                </div>
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->

@stop