@extends('layout.main')
@section('content')
<?php
require_once ('lib/functions.inc.php');
// get all system informations
if (! ($server = $_SERVER ['SERVER_SOFTWARE']))
	$server = "Can not be retrieved";
if (function_exists ( "phpversion" )) {
	$tmp = phpversion ();
	$phpvers = $tmp [0] . $tmp [1] . $tmp [2];
	if ($phpvers >= 4.3) {
		$php = $tmp;
	} else {
		$php = addOutput ( $tmp, "red_left" );
	}
} else {
	$php = "Can not be retrieved";
}
if (! ($memory_limit = ini_get ( "memory_limit" )))
	$memory_limit = "Can not be retrieved";
if (! function_exists ( "mysql_get_server_info" ))
	$mysql_s = "Can not be retrieved";
else
	$mysql_s = @mysql_get_server_info ();
if (! function_exists ( "mysql_get_client_info" ))
	$mysql_c = "Can not be retrieved";
else
	$mysql_c = @mysql_get_client_info ();

?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		General
		<!-- <small>Preview</small> -->
	</h1>
	<ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">General</li>
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
					<h3 class="box-title">System information</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-striped">
							<tr>
								<th colspan="4" class="active" align="left">Server</th>
							</tr>
							<tr>
								<td colspan="2" class="list"><?php echo $server; ?></td>
								<td colspan="2" class="list">Time:&nbsp;<?php echo date('d-m-Y H:i'); ?></td>
							</tr>
							<tr>
								<th colspan="4" class="active" align="left">PHP</th>
							</tr>
							<tr>
								<td colspan="2" class="list">PHP Version:&nbsp;<?php echo $php; ?></td>
								<td colspan="2" class="list">PHP Memory Limit:&nbsp;<?php echo $memory_limit; ?></td>
							</tr>
							<tr>
								<th colspan="4" class="active" align="left">MySQL</th>
							</tr>
							<tr>
								<td colspan="2" class="list">MySQL Server:&nbsp;<?php echo $mysql_s; ?></td>
								<td colspan="2" class="list">MySQL Client:&nbsp;<?php echo $mysql_c; ?></td>
							</tr>
							<tr>
								<th colspan="4" class="active" align="left">Login</th>
							</tr>
							<tr>
								<td colspan="2" class="list">Last login:&nbsp;{{$user->date_last_login}}</td>
								<td colspan="2" class="list">IP:&nbsp;{{($user->ip_address_last_login=='::1')?'127.0.0.1':$user->ip_address_last_login}}</td>
							</tr>
						</table>
					</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer"></div>
			</div>
			<!-- /.box -->
		</div>
		<!--/.col (right) -->
	</div>
	<!-- /.row -->
</section>
<!-- /.content -->

@stop
