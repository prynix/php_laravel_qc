@extends('layout.main')
@section('content')
<?php
//Thống kê theo tiêu chí số lượng người click >< số lượt người click
//get month and year
$time = time();
if (isset($_GET["m"]) AND is_numeric($_GET["m"]) AND $_GET["m"] >= 1 AND $_GET["m"] <= 12) {$show_month = $_GET["m"];
}//echo $show_month; die();
else {$show_month = date("n", $time);
}
if (isset($_GET["y"]) AND is_numeric($_GET["y"]) AND $_GET["y"] >= 1 AND $_GET["y"] <= 9999) {$show_year = $_GET["y"];
}//echo $show_year; die();
else {$show_year = date("Y", $time);
}
?>
				<section class="content-header">
                    <h1>
                        History
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">History</li>
                    </ol>
                </section>
                <section class="content">
                	<div class="row">
                        <div class="col-xs-12">
                        <div id="horizontalTab">
                            <ul>
                               	<li><a href="#tab-1" id="account-1" style="border-left:none;border-top-right-radius:0;">Clicks</a></li>
                               	<li><a href="#tab-2" id="account-3" style="border-top-left-radius:0;border-top-right-radius:0;">Views</a></li>
                            </ul>
                            <div id="tab-1" class="clearfix">
                        	<div class="col-md-6" style="padding-left:0px;padding-right:10px;">
                                <div class="box box-solid box-default">
                                    <div class="box-header">
                                        <h4 class="box-title" style="font-size:14px;">
                                        	History
                                        </h4>
                                    </div>
                                    <div class="box-body" style="border:1px solid #ccc;">
                                    	<table width="100%" border="0" cellpadding="5" cellspacing="0">
                                    		<tr valign="top">
                                    			<td colspan="4"><strong>Total since {{$since_1}}</strong></td>
                                    		</tr>
                                    		<tr valign="top">
                                    			<td width="30%">Visitors</td><td width="20%">
                                    				@if($visitors_1>0)
                                    					{{$visitors_1}}
                                    				@else
                                    					0
                                    				@endif
                                    			</td>
                                    			<td width="30%">Clicks</td><td width="20%">
                                    				@if($visits_1>0)
                                    					{{$visits_1}}
                                    				@else
                                    					0
                                    				@endif
                                    			</td>
                                    		</tr>
                                    		<tr valign="top">
                                    			<td width="30%">Average Day</td><td width="20%">
                                    				@if($total_avg_1>0)
                                    					{{$total_avg_1}}
                                    				@else
                                    					0
                                    				@endif
                                    			</td>
                                    			<td width="30%"></td><td width="20%"></td>
                                    		</tr>
                                    	</table>
                                    	<table width="100%" border="0" cellpadding="5" cellspacing="0">
                                    		<tr valign="top">
                                    			<td colspan="4"><strong>Selected is {{$date}}</strong></td>
                                    		</tr>
                                    		<tr valign="top">
                                    			<td width="30%">Visitors</td><td width="20%">
                                    				@if($visitors_2>0)
                                    					{{$visitors_2}}
                                    				@else
                                    					0
                                    				@endif
                                    			</td>
                                    			<td width="30%">Clicks</td><td width="20%">
                                    				@if($visits_2>0)
                                    					{{$visits_2}}
                                    				@else
                                    					0
                                    				@endif
                                    			</td>
                                    		</tr>
                                    		<tr valign="top">
                                    			<td width="30%">Average Day</td><td width="20%">
                                    				@if($day_avg_1>0)
                                    					{{$day_avg_1}}
                                    				@else
                                    					0
                                    				@endif
                                    			</td>
                                    			<td width="30%"></td><td width="20%"></td>
                                    		</tr>
                                    	</table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="padding-left:10px;padding-right:0px;">
                                <div class="box box-solid box-default">
                                    <div class="box-header">
                                        <h4 class="box-title" style="font-size:14px;">Year {{$year}}
                                        </h4>
                                        <div class="box-tools pull-right">
                                        	<?php
											echo "<a href=\"history?m=$back_month_1&y=$back_year_1\" class='btn btn-default btn-sm'><i class='glyphicon glyphicon-arrow-left'></i></a>";
											echo "<a href=\"history?m=$next_month_1&y=$next_year_1\" class='btn btn-default btn-sm'><i class='glyphicon glyphicon-arrow-right'></i></a>";
                                            ?>
                                        </div>
                                    </div>
                                    <div class="box-body" style="border:1px solid #ccc;">
                                        <table width="100%" height="200px" cellpadding="0" cellspacing="0">
                                       		<tr valign="bottom" height="180px">
                                       			<?php
												//Diagram
												for ($i = 0; $i < $stat_1; $i++) {
													$value = $chart_1[$i][0]['sum_user'];
													//echo '<pre/>'; print_r($value);
													if ($value == "")
														$value = 0;

													if ($max_month_1 > 0) {$chart_height = round((170 / $max_month_1) * $value); 
													} else
														$chart_height = 0;
													if ($chart_height == 0)
														$chart_height = 1;
													echo "<td width=\"38px\">";
													echo "<a href=\"history?m=" . $chart_month_1[$i] . "&y=$show_year\">";
													echo "<div class=\"chart\" style=\"height:" . $chart_height . "px;\" title=\"" . $chart_title_1[$i] . " : $value Visitors\"></div>";
													echo "</a></td>\n";
												}
                                       			?>

                                       		</tr>
                                       		<tr height="20">
                                       			<td colspan="1" width="8%" class="time-line" align="center"><?php echo date("Y-m", mktime(0, 0, 0, 1, 1, $show_year)); ?></td>
                                       			<td colspan="1" width="8%" class="time-line" align="center"><?php echo date("Y-m", mktime(0, 0, 0, 2, 1, $show_year)); ?></td>
                                       			<td colspan="1" width="8%" class="time-line" align="center"><?php echo date("Y-m", mktime(0, 0, 0, 3, 1, $show_year)); ?></td>
                                       			<td colspan="1" width="8%" class="time-line" align="center"><?php echo date("Y-m", mktime(0, 0, 0, 4, 1, $show_year)); ?></td>
                                       			<td colspan="1" width="8%" class="time-line" align="center"><?php echo date("Y-m", mktime(0, 0, 0, 5, 1, $show_year)); ?></td>
                                       			<td colspan="1" width="8%" class="time-line" align="center"><?php echo date("Y-m", mktime(0, 0, 0, 6, 1, $show_year)); ?></td>
                                       			<td colspan="1" width="8%" class="time-line" align="center"><?php echo date("Y-m", mktime(0, 0, 0, 7, 1, $show_year)); ?></td>
                                       			<td colspan="1" width="8%" class="time-line" align="center"><?php echo date("Y-m", mktime(0, 0, 0, 8, 1, $show_year)); ?></td>
                                       			<td colspan="1" width="8%" class="time-line" align="center"><?php echo date("Y-m", mktime(0, 0, 0, 9, 1, $show_year)); ?></td>
                                       			<td colspan="1" width="8%" class="time-line" align="center"><?php echo date("Y-m", mktime(0, 0, 0, 10, 1, $show_year)); ?></td>
                                       			<td colspan="1" width="8%" class="time-line" align="center"><?php echo date("Y-m", mktime(0, 0, 0, 11, 1, $show_year)); ?></td>
                                       			<td colspan="1" width="8%" class="time-line" align="center"><?php echo date("Y-m", mktime(0, 0, 0, 12, 1, $show_year)); ?></td>
                                       		</tr>
                                        </table>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                            </div>

                            <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                <div class="box box-solid box-default">
                                    <div class="box-header">
                                        <h4 class="box-title" style="font-size:14px;">{{$month_1}}
                                        </h4>
                                        <div class="box-tools pull-right">
                                        	<?php
											echo "<a href=\"history?m=$back_month_2&y=$back_year_2\" class='btn btn-default btn-sm'><i class='glyphicon glyphicon-arrow-left'></i></a>";
											echo "<a href=\"history?m=$next_month_2&y=$next_year_2\" class='btn btn-default btn-sm'><i class='glyphicon glyphicon-arrow-right'></i></a>";
                                            ?>
                                        </div>
                                    </div>
                                    <div class="box-body" style="border:1px solid #ccc;">
                                    	<table width="100%" height="230px" cellpadding="0" cellspacing="0">
                                    		<tr valign="bottom" height="210px">
                                    			<?php
												for ($i = 0; $i < $stats_1; $i++) {
													$value = $chart_2[$i][0]['sum_user'];
													//echo '<pre/>'; echo $value;
													if ($value == "")
														$value = 0;

													$arr = array();
													$arr = array_push($arr, $value);

													if ($value > 0) {$chart_height = round((200 / ($max_1)) * $value);
													} else
														$chart_height = 0;
													if ($chart_height == 0)
														$chart_height = 1;
													echo "<td width=\"30px\">";
													echo "<div class=\"chart\" style=\" height:" . $chart_height . "px;\" title=\"" . $chart_title_2[$i] . " : $value Visitors\"></div>";
													echo "</td>\n";
												}
                                    			?>
                                    		</tr>
                                    		<tr height="20px">
                                    			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 1, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 2, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 3, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 4, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 5, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 6, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 7, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 8, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 9, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 10, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 11, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 12, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 13, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 14, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 15, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 16, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 17, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 18, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 19, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 20, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 21, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 22, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 23, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 24, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 25, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 26, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 27, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 28, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 29, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 30, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 31, $show_year)); ?></td>
                                    		</tr>
                                    	</table>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div id="tab-2" class="clearfix">
                            	<div class="col-md-6" style="padding-left:0px;padding-right:10px;">
                                <div class="box box-solid box-default">
                                    <div class="box-header">
                                        <h4 class="box-title" style="font-size:14px;">
                                        	History
                                        </h4>
                                    </div>
                                    <div class="box-body" style="border:1px solid #ccc;">
                                    	<table width="100%" border="0" cellpadding="5" cellspacing="0">
                                    		<tr valign="top">
                                    			<td colspan="4"><strong>Total since {{$since_2}}</strong></td>
                                    		</tr>
                                    		<tr valign="top">
                                    			<td width="30%">Visitors</td><td width="20%">
                                    				@if($visitors_3>0)
                                    					{{$visitors_3}}
                                    				@else
                                    					0
                                    				@endif
                                    			</td>
                                    			<td width="30%">Views</td><td width="20%">
                                    				@if($visits_3>0)
                                    					{{$visits_3}}
                                    				@else
                                    					0
                                    				@endif
                                    			</td>
                                    		</tr>
                                    		<tr valign="top">
                                    			<td width="30%">Average Day</td><td width="20%">
                                    				@if($total_avg_2>0)
                                    					{{$total_avg_2}}
                                    				@else
                                    					0
                                    				@endif
                                    			</td>
                                    			<td width="30%"></td><td width="20%"></td>
                                    		</tr>
                                    	</table>
                                    	<table width="100%" border="0" cellpadding="5" cellspacing="0">
                                    		<tr valign="top">
                                    			<td colspan="4"><strong>Selected is {{$date}}</strong></td>
                                    		</tr>
                                    		<tr valign="top">
                                    			<td width="30%">Visitors</td><td width="20%">
                                    				@if($visitors_4>0)
                                    					{{$visitors_4}}
                                    				@else
                                    					0
                                    				@endif
                                    			</td>
                                    			<td width="30%">Views</td><td width="20%">
                                    				@if($visits_4>0)
                                    					{{$visits_4}}
                                    				@else
                                    					0
                                    				@endif
                                    			</td>
                                    		</tr>
                                    		<tr valign="top">
                                    			<td width="30%">Average Day</td><td width="20%">
                                    				@if($day_avg_2>0)
                                    					{{$day_avg_2}}
                                    				@else
                                    					0
                                    				@endif
                                    			</td>
                                    			<td width="30%"></td><td width="20%"></td>
                                    		</tr>
                                    	</table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="padding-left:10px;padding-right:0px;">
                                <div class="box box-solid box-default">
                                    <div class="box-header">
                                        <h4 class="box-title" style="font-size:14px;">Year {{$year}}
                                        </h4>
                                        <div class="box-tools pull-right">
                                        	<?php
											echo "<a href=\"history?m=$back_month_1&y=$back_year_1\" class='btn btn-default btn-sm'><i class='glyphicon glyphicon-arrow-left'></i></a>";
											echo "<a href=\"history?m=$next_month_1&y=$next_year_1\" class='btn btn-default btn-sm'><i class='glyphicon glyphicon-arrow-right'></i></a>";
                                            ?>
                                        </div>
                                    </div>
                                    <div class="box-body" style="border:1px solid #ccc;">
                                        <table width="100%" height="200px" cellpadding="0" cellspacing="0">
                                       		<tr valign="bottom" height="180px">
                                       			<?php
												//Diagram
												for ($i = 0; $i < $stat_2; $i++) {
													$value = $chart_3[$i][0]['sum_user'];
													//echo '<pre/>'; print_r($value);
													if ($value == "")
														$value = 0;

													if ($max_month_2 > 0) {$chart_height = round((1700 / $max_month_2) * $value); 
													} else
														$chart_height = 0;
													if ($chart_height == 0)
														$chart_height = 1;
													echo "<td width=\"38px\">";
													echo "<a href=\"history?m=" . $chart_month_3[$i] . "&y=$show_year\">";
													echo "<div class=\"chart\" style=\" height:" . $chart_height . "px;\" title=\"" . $chart_title_3[$i] . " : $value Visitors\"></div>";
													echo "</a></td>\n";
												}
                                       			?>
                                       		</tr>
                                       		<tr height="20">
                                       			<td colspan="1" width="8%" class="time-line" align="center"><?php echo date("Y-m", mktime(0, 0, 0, 1, 1, $show_year)); ?></td>
                                       			<td colspan="1" width="8%" class="time-line" align="center"><?php echo date("Y-m", mktime(0, 0, 0, 2, 1, $show_year)); ?></td>
                                       			<td colspan="1" width="8%" class="time-line" align="center"><?php echo date("Y-m", mktime(0, 0, 0, 3, 1, $show_year)); ?></td>
                                       			<td colspan="1" width="8%" class="time-line" align="center"><?php echo date("Y-m", mktime(0, 0, 0, 4, 1, $show_year)); ?></td>
                                       			<td colspan="1" width="8%" class="time-line" align="center"><?php echo date("Y-m", mktime(0, 0, 0, 5, 1, $show_year)); ?></td>
                                       			<td colspan="1" width="8%" class="time-line" align="center"><?php echo date("Y-m", mktime(0, 0, 0, 6, 1, $show_year)); ?></td>
                                       			<td colspan="1" width="8%" class="time-line" align="center"><?php echo date("Y-m", mktime(0, 0, 0, 7, 1, $show_year)); ?></td>
                                       			<td colspan="1" width="8%" class="time-line" align="center"><?php echo date("Y-m", mktime(0, 0, 0, 8, 1, $show_year)); ?></td>
                                       			<td colspan="1" width="8%" class="time-line" align="center"><?php echo date("Y-m", mktime(0, 0, 0, 9, 1, $show_year)); ?></td>
                                       			<td colspan="1" width="8%" class="time-line" align="center"><?php echo date("Y-m", mktime(0, 0, 0, 10, 1, $show_year)); ?></td>
                                       			<td colspan="1" width="8%" class="time-line" align="center"><?php echo date("Y-m", mktime(0, 0, 0, 11, 1, $show_year)); ?></td>
                                       			<td colspan="1" width="8%" class="time-line" align="center"><?php echo date("Y-m", mktime(0, 0, 0, 12, 1, $show_year)); ?></td>
                                       		</tr>
                                        </table>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                            </div>

                            <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                <div class="box box-solid box-default">
                                    <div class="box-header">
                                        <h4 class="box-title" style="font-size:14px;">{{$month_1}}
                                        </h4>
                                        <div class="box-tools pull-right">
                                        	<?php
											echo "<a href=\"history?m=$back_month_2&y=$back_year_2\" class='btn btn-default btn-sm'><i class='glyphicon glyphicon-arrow-left'></i></a>";
											echo "<a href=\"history?m=$next_month_2&y=$next_year_2\" class='btn btn-default btn-sm'><i class='glyphicon glyphicon-arrow-right'></i></a>";
                                            ?>
                                        </div>
                                    </div>
                                    <div class="box-body" style="border:1px solid #ccc;">
                                    	<table width="100%" height="230px" cellpadding="0" cellspacing="0">
                                    		<tr valign="bottom" height="210px">
                                    			<?php
												for ($i = 0; $i < $stats_2; $i++) {
													$value = $chart_4[$i][0]['sum_user'];
													//echo '<pre/>'; print_r($value);
													if ($value == "")
														$value = 0;

													if ($value > 0) {$chart_height = round((200 / $max_2) * $value);
													} else
														$chart_height = 0;
													if ($chart_height == 0)
														$chart_height = 1;
													echo "<td width=\"30px\">";
													echo "<div class=\"chart\" style=\" height:" . $chart_height . "px;\" title=\"" . $chart_title_4[$i] . " : $value Visitors\"></div>";
													echo "</td>\n";
												}
                                    			?>
                                    		</tr>
                                    		<tr height="20px">
                                    			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 1, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 2, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 3, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 4, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 5, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 6, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 7, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 8, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 9, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 10, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 11, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 12, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 13, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 14, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 15, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 16, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 17, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 18, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 19, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 20, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 21, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 22, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 23, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 24, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 25, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 26, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 27, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 28, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 29, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 30, $show_year)); ?></td>
                                       			<td colspan="1" width="3%" class="time-line" align="center"><?php echo date("j-M", mktime(0, 0, 0, $show_month, 31, $show_year)); ?></td>
                                    		</tr>
                                    	</table>
                                    </div>
                                </div>
                            </div>
                            </div>
                           </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </section>
@stop