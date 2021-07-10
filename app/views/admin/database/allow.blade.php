@extends('layout.main')
@section('content')    
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-edit"></i>&nbsp;Allow/Don't allow to update database: Insert/Update
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Allow to update database</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
               	<div class="box-header">
                    <h3 class="box-title">MySQL Trigger On Insert/Update Events</h3>
                    <button class="slide_open btn-sm btn-default btn-help"><i class="fa fa-anchor"></i>&nbsp;Help</button></div><!-- /.box-header -->
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
                	<table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th align="left">Table name</th>
                                <th>Insert</th>
                                <th>Update</th>
                                <th>A/D</th>
                                <th align="center"></th>
                            </tr>
                        </thead>
	                   <tbody>
	                   			<?php
	                   				if($_SERVER['SERVER_NAME']=='localhost'||$_SERVER['SERVER_NAME']=='lqc.tintuc.vn'){
							            $contents=File::get(app_path().'/config/local/database.php');
							            $configs=require '../app/config/local/database.php';
							        }else if($_SERVER['SERVER_NAME']=='sqc.tintuc.vn'){
							            $contents=File::get(app_path().'/config/staging/database.php');
							            $configs=require '../app/config/staging/database.php';
							        }else if($_SERVER['SERVER_NAME']=='qc.tintuc.vn'){
							            $contents=File::get(app_path().'/config/production/database.php');
							            $configs=require '../app/config/production/database.php';
							        }
							        //$default=$configs['default'];
							        $host=$configs['connections']['mysql']['host'];
							        $username=$configs['connections']['mysql']['username'];
							        $password=$configs['connections']['mysql']['password'];
							        $database=$configs['connections']['mysql']['database'];
							        $conn=new PDO('mysql:host='.$host.';dbname='.$database,$username,$password);
	                   				$tables=DB::select(DB::raw('SHOW TABLES'));  
	                   				$triggers=DB::select(DB::raw('SHOW TRIGGERS')); 
	                   			?>
	                   		<?php
	                   			$show_tables=DB::select("SHOW TABLES");
        						for($i=0;$i<count($show_tables);$i++){
							        $trigger=DB::select(DB::raw('SHOW TRIGGERS LIKE "'.$show_tables[$i]['Tables_in_qc'].'"'));
							 		$trigger_2=DB::select(DB::raw('SHOW TRIGGERS LIKE "'.$show_tables[$i]['Tables_in_qc'].'"'));
	                   		?>
	                   		<tr>
	                   			<td>{{$show_tables[$i]['Tables_in_qc']}}</td>
	                   			<td align="center">
	                   				<?php
	                   					if($trigger!==null){ 
	                   						foreach($trigger as $trig){   
		                   						if(isset($trig['Trigger'])&&$trig['Trigger']==='insert_'.$show_tables[$i]['Tables_in_qc'].'_row'){
		                   							//echo '<input type="checkbox" name="allow_to_insert" value="'.$show_tables[$i]['Tables_in_qc'].'" checked="checked"/>'; break;
		                   							echo "<span class='label label-danger'>Don't allow to insert</span>";
		                   						}else{
		                   							//echo '<input type="checkbox" name="allow_to_insert" value="'.$show_tables[$i]['Tables_in_qc'].'"/>'; goto label_end;
		                   						}
	                   						} //label_end: echo '';
	                   					}else{
	                   						echo '<input type="checkbox" name="allow_to_insert" value="'.$show_tables[$i]['Tables_in_qc'].'"/>';
	                   					}
							        ?>
	                   			</td>
	                   			<td align="center">
	                   				<?php        
	                   					if($trigger_2!==null){ 
	                   						foreach($trigger_2 as $tig){   
		                   						if(isset($tig['Trigger'])&&$tig['Trigger']==='update_'.$show_tables[$i]['Tables_in_qc'].'_row'){
		                   							//echo '<input type="checkbox" name="allow_to_update" value="'.$show_tables[$i]['Tables_in_qc'].'" checked="checked"/>'; break;
		                   							echo "<span class='label label-danger'>Don't allow to update</span>";
		                   						}else{ 
		                   							//echo '<input type="checkbox" name="allow_to_update" value="'.$show_tables[$i]['Tables_in_qc'].'"/>'; goto input_end;
		                   						}
		                   					} //input_end: echo '';
	                   					}else{
	                   						echo '<input type="checkbox" name="allow_to_update" value="'.$show_tables[$i]['Tables_in_qc'].'"/>';
	                   					}
							        ?>
	                   			</td>
	                   			<td align="center">
	                   				<a href="#myControls-{{$show_tables[$i]['Tables_in_qc']}}" title="Controls" data-toggle="modal"><button class="btn btn-sm btn-success">
			                            <i class="fa fa-plus"></i>/<i class="fa fa-minus"></i>
			                        </button></a>
	                   			</td>
	                   			<td align="center">
	                   				<a href="dump-{{$show_tables[$i]['Tables_in_qc']}}" class="btn btn-sm btn-primary"><i class="fa fa-download"></i>&nbsp;Export</a>
	                   			</td>
	                   		</tr>
	                   		<!-- Modal Show -->
							<div class="modal fade" id="myControls-<?php echo $show_tables[$i]['Tables_in_qc']; ?>"
							tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
							aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-body">
											<div class="row">
												<div class="col-md-12">
													<!-- general form elements -->
													<div class="box">
														<div class="box-header" style="padding-bottom: 0;">
															<h3 class="box-title"><i class="fa fa-lock"></i>&nbsp;Lock database</h3>
														</div>
														<div class="box-body">
															<button name="not_allow_to_insert" class="btn btn-sm btn-success" value="<?php echo $show_tables[$i]['Tables_in_qc']; ?>">Allow to insert</button>
															<button name="allow_to_insert" class="btn btn-sm btn-danger" value="<?php echo $show_tables[$i]['Tables_in_qc']; ?>">Don't allow to insert</button>
			                                            </div>
			                                            <div class="box-footer">
															<button name="not_allow_to_update" class="btn btn-sm btn-success" value="<?php echo $show_tables[$i]['Tables_in_qc']; ?>">Allow to update</button>	
															<button name="allow_to_update" class="btn btn-sm btn-danger" value="<?php echo $show_tables[$i]['Tables_in_qc']; ?>">Don't allow to update</button>		                                         
			                                            </div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>
							<!-- /.modal -->
	                   		<?php } ?>
	                   </tbody>
	                   <tfoot>
                            <tr>
                                <th align="left">Table name</th>
                                <th>Insert</th>
                                <th>Update</th>
                                <th>A/D</th>
                                <th align="center"></th>
                            </tr>
                        </tfoot>
	               </table>
                </div>
            </div>
        </div>
        <!-- right column 
        <div class="col-md-6">
        	<div class="box box-primary">
        		<div class="box-header">
        			<h3 class="box-title">Show Logs</h3>
        		</div>
        		<div class="box-body"> 
        			<table id="example3" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th align="left">Event type</th>
                                <th align="left">Info</th>
                            </tr>
                        </thead>
	                   	<tbody>
	                   		@foreach($logs as $log)
	                   			<tr>
	                   				<td>{{$log['Event_type']}}</td>
	                   				<td>{{$log['Info']}}</td>
	                   			</tr>
	                   		@endforeach
	                   	</tbody>
	                   	<tfoot>
                            <tr>
                                <th align="left">Event type</th>
                                <th align="left">Info</th>
                            </tr>
                        </tfoot>
	               </table>
        		</div>
        	</div>
        </div>-->
    </div>
</section>
@stop