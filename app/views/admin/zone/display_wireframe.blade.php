@extends('layout.main')
@section('content')
<?php
switch($_SERVER['SERVER_NAME']){
	case 'localhost':
		$hostname='http://localhost/qc/public/';
	break;
	case 'slink.tintuc.vn':
		$hostname='http://sqc.tintuc.vn/';
	break;
	default: 
		$hostname='http://qc.tintuc.vn/';
}
?>
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <i class="fa fa-qrcode"></i>&nbsp;Zones: Display wireframe
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="zone"> Zones</a></li>
                        <li class="active">Display wireframe</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                            	<iframe src='<?php echo $hostname; ?>/qc/wireframe' width="100%" style="min-height:700px;"></iframe>
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
@stop