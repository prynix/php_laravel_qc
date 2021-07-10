<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin AD | Dashboard</title>
<meta
	content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'
	name='viewport'>
<link rel="shortcut icon" href="../assets/img/icon/advertising.png">
<meta name="robots" content="noindex,nofollow" />
<!-- bootstrap 3.0.2 -->
<link href="../assets/css/bootstrap.min.css" rel="stylesheet"
	type="text/css" />
<!-- font Awesome -->
<link href="../assets/css/font-awesome.min.css" rel="stylesheet"
	type="text/css" />
<!-- Ionicons -->
<link href="../assets/css/ionicons.min.css" rel="stylesheet"
	type="text/css" />
<!-- DATA TABLES -->
<link href="../assets/css/datatables/dataTables.bootstrap.css"
	rel="stylesheet" type="text/css" />
<!-- Morris chart
<link href="../assets/css/morris/morris.css" rel="stylesheet"
	type="text/css" /> -->
<!-- jvectormap
<link href="../assets/css/jvectormap/jquery-jvectormap-1.2.2.css"
	rel="stylesheet" type="text/css" /> -->
<!-- fullCalendar
<link href="../assets/css/fullcalendar/fullcalendar.css"
	rel="stylesheet" type="text/css" /> -->
<!-- Daterange picker
<link href="../assets/css/daterangepicker/daterangepicker-bs3.css"
	rel="stylesheet" type="text/css" /> -->
<!-- bootstrap wysihtml5 - text editor -->
<link
	href="../assets/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"
	rel="stylesheet" type="text/css" /> 
<!-- Theme style -->
<link href="../assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- iCheck for checkboxes and radio inputs -->
<link href="../assets/css/iCheck/all.css" rel="stylesheet"
	type="text/css" />
<!-- Calendar -->
<link href="../assets/css/clndr.css" rel="stylesheet" type="text/css" />
<!-- <link rel="stylesheet" href="../assets/css/main.css">
        <link rel="stylesheet" href="../assets/css/datepicker.css"> -->

<link type="text/css" rel="stylesheet"
	href="../assets/css/responsive-tabs.css" />
<link type="text/css" rel="stylesheet" href="../assets/css/style.css" />
<!-- css confirmon -->
<link rel="stylesheet" type="text/css" href="../assets/css/sample.css" />
<link rel="stylesheet" type="text/css"
	href="../assets/css/jquery.confirmon.css" />
<link rel="stylesheet" href="../assets/css/jquery-ui.css" />
<link rel="stylesheet" href="../assets/css/tooltip.css" />
<!-- form help -->
<link rel="stylesheet" href="../assets/css/sample1.css">
<link rel="stylesheet" href="../assets/css/jquery.formhelp.css">

<link rel="stylesheet" href="../assets/css/prism.css">
<link rel="stylesheet" href="../assets/css/chosen.css">
<!-- datetimepicker -->
<link rel="stylesheet" type="text/css"
	href="../assets/css/jquery.datetimepicker.css" />
<!-- database backups -->
<link rel="stylesheet" href="../assets/css/database.css">
<!-- file input -->
<link rel="stylesheet" href="../assets/css/fileinput.css">
<!-- intro -->
<link type="text/css" rel="stylesheet" href="../assets/css/introjs.css" />
<!-- jQuery 1.11.1 -->
<script src="../assets/js/jquery-1.11.1.min.js"></script>
<!-- AdminLTE App
<script src="../assets/js/AdminLTE/app.js" type="text/javascript"></script> -->
<script type="text/javascript">
$(document).ready(function(){
	if(window.location.hostname=='localhost'){ 
      hostname="http://localhost/qc/public/";
    }else if(window.location.hostname=='lqc.tintuc.vn'){ 
      hostname="http://lqc.tintuc.vn/";
    }else if(window.location.hostname=='sqc.tintuc.vn'){ 
      hostname="http://sqc.tintuc.vn/";
    }else{
      hostname="http://qc.tintuc.vn/";
    }
	$("#debug-on").click(function(){
        var parent = $(this).parents('.switch_bug');
        $('#debug-off',parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox_bug',parent).attr('checked', true);
        $.ajax({
                type:'GET',
                url:hostname+"admin/switch_debug_true",
                success:function(data){ 
                    //event.preventDefault;
                },
                error:function(jqXHR,textStatus,errorThrown){ 
                    //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
                }  
        }); 
    });
    $("#debug-off").click(function(){
        var parent = $(this).parents('.switch_bug');
        $('#debug-on',parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox_bug',parent).attr('checked', false);
        $.ajax({
                type:'GET',
                url:hostname+"admin/switch_debug_false",
                success:function(data){ 
                    //event.preventDefault;
                },
                error:function(jqXHR,textStatus,errorThrown){ 
                    //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
                }  
        }); 
    });
});
</script>
</head>
<body class="skin-blue">
	<!-- header logo: style can be found in header.less -->
	<header class="header">
		<a href="dashboard" class="logo"> <!-- Add the class icon to your logo image or logo icon to add the margining -->
			Admin BBAd
		</a>
		<!-- Header Navbar: style can be found in header.less -->
		<nav class="navbar navbar-static-top" role="navigation">
			<!-- Sidebar toggle button-->
			<a class="navbar-btn sidebar-toggle" data-toggle="offcanvas"
				role="button"> <span class="sr-only">Toggle navigation</span> <span
				class="icon-bar"></span> <span class="icon-bar"></span> <span
				class="icon-bar"></span>
			</a>
		</nav>
	</header>
	<div class="wrapper row-offcanvas row-offcanvas-left">
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="left-side sidebar-offcanvas">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu">
					<li id="dashboard"><a href="dashboard" class="no-reload"><i class="fa fa-arrow-circle-o-left"></i>
							<!-- <img src="../assets/img/icon/dashboard.png" alt="" width="16px" />&nbsp; -->
							<span>Back</span>
					</a></li>
				</ul>
			</section>
			<!-- /.sidebar -->
		</aside>

		<!-- Right side column. Contains the navbar and content of the page -->
		<aside class="right-side">

		<div class="sticky-container">
			<ul class="sticky">
				<li id="delete_cache">
					<img width="32" height="32" title="" alt="" src="../assets/img/icon/cache.png" />
					<p>Delete cache</p>
				</li>
			</ul>
		</div>
<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Database connection
                        <!-- <small>Preview</small> -->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Database connection</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
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
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-4">
                            <!-- general form elements -->
                            <div class="box box-success">
                                <div class="box-header">
                                        <h3 class="box-title">Current config</h3>
                                        <!--<button class="slide_open btn-sm btn-default btn-help"><i class="fa fa-anchor"></i>&nbsp;Help</button>-->
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
                                {{Form::open()}}
                                    <div class="box-body">
                                        <div class="form-group">
                                            <button type="button" class="btn-sm btn-success btnAddNew"><i class="fa fa-plus"></i>&nbsp;Add new config</button>
                                        </div>
                                    	<div class="form-group">
                                            {{Form::label('','Database default')}}&nbsp;<font color="#FF0000">*</font>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                                {{Form::text('default',Input::old('default',$config['driver']),array('class'=>'form-control'))}}
                                            </div>
                                            @if($errors->first('default'))
                                            <div class="alert alert-danger alert-dismissable">
                                                <i class="fa fa-ban"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                 {{$errors->first('default')}} 
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('','Hosting')}}&nbsp;<font color="#FF0000">*</font>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                                {{Form::text('host',Input::old('host',$config['host']),array('class'=>'form-control'))}}
                                            </div>
                                            @if($errors->first('host'))
                                            <div class="alert alert-danger alert-dismissable">
                                                <i class="fa fa-ban"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                 {{$errors->first('host')}} 
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('','Database name')}}&nbsp;<font color="#FF0000">*</font>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                                {{Form::text('database',Input::old('database',$config['database']),array('class'=>'form-control'))}}
                                            </div>
                                            @if($errors->first('database'))
                                            <div class="alert alert-danger alert-dismissable">
                                                <i class="fa fa-ban"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                 {{$errors->first('database')}} 
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('','Username')}}&nbsp;<font color="#FF0000">*</font>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                                {{Form::text('username',Input::old('username',$config['username']),array('class'=>'form-control'))}}
                                            </div>
                                            @if($errors->first('username'))
                                            <div class="alert alert-danger alert-dismissable">
                                                <i class="fa fa-ban"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                 {{$errors->first('username')}} 
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('','Password')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                                {{Form::text('password',Input::old('password',$config['password']),array('class'=>'form-control'))}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('','Charset')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                                {{Form::text('charset',Input::old('charset',$config['charset']),array('class'=>'form-control'))}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('','Collection')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                                {{Form::text('collation',Input::old('collation',$config['collation']),array('class'=>'form-control'))}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('','Prefix table')}}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                                {{Form::text('prefix',Input::old('prefix',$config['prefix']),array('class'=>'form-control'))}}
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
                                        <!--<button type="button" class="btn-sm btn-success btnEdit">
                                            <i class="fa fa-edit"></i>&nbsp;Edit
                                        </button>-->
                                        <button type="submit" class="btn-sm btn-primary btnSaveChanges">
                                            <i class="fa fa-check-circle-o"></i>&nbsp;Save changes
                                        </button>
                                        <button type="submit" class="btn-sm btn-primary btnSave display-none">
                                            <i class="fa fa-check-circle-o"></i>&nbsp;Save & New
                                        </button>
                                        <button type="reset" class="btn-sm btn-default btnCancel display-none" onclick="location.reload();">
                                            <i class="fa fa-times-circle-o"></i>&nbsp;Cancel
                                        </button>
                                    </div>
								{{Form::close()}}
                            </div><!-- /.box -->
						</div><!--/.col (left) -->
						<!-- center column -->
                        <div class="col-md-4">
                            <!-- general form elements -->
                            <div class="box box-success">
                            	<div class="box-header">
                                    <h3 class="box-title">File configs</h3>
                                </div><!-- /.box-header -->
                        		<div class="box-body">
                                    <div class="form-group">
                                        {{trim($contents)}}
                                    </div>
                                </div>
                                {{Form::open(array('url'=>'admin/switch_to_database','method'=>'post'))}}
                                <div class="box-header">
                                    <h3 class="box-title">Switch to database servers</h3>                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <select class="form-control" name="hosting" id="hosting">
                                            @foreach($mydatabase as $mydata)
                                                <option value="{{$mydata->id}}">{{ $mydata->hosting }} || {{$mydata->database_name}} - {{$mydata->database_default}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn-sm btn-primary btnChangeServer width-100-percent">
                                            <i class="fa fa-exchange"></i>&nbsp;Change Server
                                        </button>
                                    </div>
                                </div>
                                {{Form::close()}}
                            </div>
                        </div>
                        <!--/.col (center) -->
                        <div class="col-md-2">
                            <!-- general form elements -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Switch debug errors</h3>
                                </div>
                                <div class="box-body clearfix width-100-percent">
                                    <p class="field switch_bug">
                                    	@if($error==TRUE)
											<label class="cb-enable selected" id="debug-on"><span>On</span></label>
										@else
											<label class="cb-enable" id="debug-on"><span>On</span></label>
										@endif
										@if($error==FALSE)
											<label class="cb-disable selected" id="debug-off"><span>Off</span></label>
										@else
											<label class="cb-disable" id="debug-off"><span>Off</span></label>
										@endif
										<input type="checkbox" id="checkbox" class="checkbox_bug" name="field2" style="display:none;" />
									</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <!-- general form elements -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Tables</h3>
                                </div>
                                <div class="box-body">
                                    @foreach($counts as $model)
                                            {{$model}}<br/>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- right column -->
                        <div class="col-md-8">
                            <!-- general form elements -->
                            <div class="box box-success">
                            	<div class="box-header">
                                    <h3 class="box-title">Data configs</h3>
                                </div><!-- /.box-header -->
                        		<div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Driver</th>
                                            	<th>User</th>
                                                <th>Host</th>
                                                <th>Password</th>
                                                <th>Database Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($mydatabase as $mydatabase)
                                                <tr>
                                                    <td align="center">{{$mydatabase->database_default}}</td>
                                                    <td align="center">{{$mydatabase->username}}</td>
                                                    <td align="center">{{$mydatabase->hosting}}</td>
                                                    <td align="center">{{$mydatabase->password}}</td>
                                                    <td align="center">{{$mydatabase->database_name}}</td>
                                                    <td align="center"><a href="{{URL::to('admin/connect-delete-'.$mydatabase->id)}}" title="Delete"><button class="btn-sm btn-default" onclick="return confirm('Are you sure you want to permanently delete this record? \n{{$mydatabase->hosting}} \nDate modified: {{$mydatabase->updated_at}}')"><i class="fa fa-trash-o"></i></button></a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Driver</th>
                                            	<th>User</th>
                                                <th>Host</th>
                                                <th>Password</th>
                                                <th>Database Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
</aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->

        <div id='buttonToTop'>BACK TO TOP</div>
        <div class="simple-loader"></div>
    </body>
</html>