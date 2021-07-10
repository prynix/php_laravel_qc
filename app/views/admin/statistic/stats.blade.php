@extends('layout.main')
@section('content')
<section class="content-header">
                    <h1>
                        Statistics
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Statistics</li>
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
                                          One View
                                        </h4>
                                    </div>
                                    <div class="box-body" style="border:1px solid #ccc;">
                                      <table width="100%" border="0" cellpadding="5" cellspacing="0" class="oneview">
                                        <tr valign="top"> 
                                          <td width="30%">Visitors</td><td width="20%">{{$visitors_2}}</td>
                                          <td width="30%">Visits</td><td width="20%">{{$visits_2}}</td>
                                        </tr>
                                        <tr valign="top">
                                          <td>Online</td><td>{{$online_2}}</td>
                                          <td>&nbsp;</td><td>&nbsp;</td>
                                        </tr>
                                        <tr valign="top">
                                          <td>&nbsp;</td><td>&nbsp;</td>
                                          <td>&nbsp;</td><td>&nbsp;</td>
                                        </tr>
                                        <tr valign="top">
                                          <!--bounce-->
                                          <td>Bounce</td>
                                          <td>@if($total_2>0) {{round(($onepage_2/$total_2)*100,2)}} @else 0 @endif %</td>
                                          <td>Page/Visitor</td><td>{{$page_user_2}}</td>
                                        </tr>
                                        <tr valign="top">
                                          <td>&nbsp;</td><td>&nbsp;</td>
                                          <td>&nbsp;</td><td>&nbsp;</td>
                                        </tr>
                                        <tr valign="top">
                                          <td>&Oslash; 7 days</td><td>{{$avg_7_2}}</td>
                                          <td>&Oslash; 30 days</td><td>{{$avg_30_2}}</td>
                                        </tr>
                                        <tr valign="top">
                                          <td>Today</td>
                                          <td>{{$today_2}}</td>
                                          <td>Yesterday (<?php echo date("G:i",time()); ?>)</td>
                                          <td>{{$yesterday_2}}</td>
                                        </tr>
                                      </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="padding-left:0px;padding-right:10px;">
                                <div class="box box-solid box-default">
                                    <div class="box-header">
                                        <h4 class="box-title" style="font-size:14px;">
                                          Last 24 hours
                                        </h4>
                                    </div>
                                    <div class="box-body" style="border:1px solid #ccc;height:212px;">
                                      <table height="200px" width="100%" cellpadding="0" cellspacing="0" align="right">
                                        <tr valign="bottom" height="180">
                                          <?php
                                            //Diagram
                                            for($i=0;$i<$bar_var_2;$i++){
                                              $value=$bar_2[$i];
                                              if($value=="") $value=0;
                                              if(max($bar_2)>0){
                                                $bar_height=round((170/$max_bar_2)*$value);
                                              }else{
                                                $bar_height=0;
                                              }
                                              if($bar_height==0){
                                                $bar_height=1;
                                              }
                                              if($bar_mark_2==$i){
                                                echo "<td style='border-left: #FF0000 1px dotted;' width='4%'>";
                                              }else{
                                                echo "<td width='4%'>";
                                              }
                                              echo "<div class='chart' style='height:".$bar_height."px' title='".$bar_title_2[$i]." - ".$value." Visitors'></div></td>";
                                            }
                                          ?>
                                        </tr>
                                        <tr>
                                          <td colspan="6" width="25%" class="time-line"><?php echo date('G:i',mktime(date('H')-23,0,0,date('n'),date('j'),date('Y'))); ?></td>
                                          <td colspan="6" width="25%" class="time-line"><?php echo date('G:i',mktime(date('H')-17,0,0,date('n'),date('j'),date('Y'))); ?></td>
                                          <td colspan="6" width="25%" class="time-line"><?php echo date('G:i',mktime(date('H')-11,0,0,date('n'),date('j'),date('Y'))); ?></td>
                                          <td colspan="6" width="25%" class="time-line"><?php echo date('G:i',mktime(date('H')-5,0,0,date('n'),date('j'),date('Y'))); ?></td>
                                        </tr>
                                      </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                <div class="box box-solid box-default">
                                    <div class="box-header">
                                        <h4 class="box-title" style="font-size:14px;">
                                          Last 30 days
                                        </h4>
                                    </div>
                                    <div class="box-body" style="border:1px solid #ccc;height:242px;">
                                      <table height="230px" width="100%" cellpadding="0" cellspacing="0" align="right">
                                        <tr valign="bottom" height="210px">
                                          <!-- Diagram -->
                                          <?php
                                            for($i=0;$i<$bar_var_3;$i++){
                                              $value1=$bar_3[$i];
                                              if($value1=="") $value1=0;
                                              if(max($bar_3)>0){
                                                $bar_height_1=round((200/$max_bar_3)*$value1);
                                              }else{
                                                $bar_height_1=0;
                                              }
                                              if($bar_height_1==0){
                                                $bar_height_1=1;
                                              }
                                              if($bar_mark_3==$i){
                                                echo "<td style='border-left: #FF0000 1px dotted;' width='3%'>";
                                              }else{
                                                echo "<td width='3%'>";
                                              }
                                              echo "<div class='chart' style='height:".$bar_height_1."px' title='".$bar_title_3[$i]." - ".$value1." Visitors'></div></td>";
                                            }
                                          ?>
                                        </tr>
                                        <tr height="20px">
                                          <td colspan="6" width="20%" class="time-line"><?php echo date('j.M',mktime(0,0,0,date('n'),date('j')-29,date('Y'))); ?></td>
                                          <td colspan="6" width="20%" class="time-line"><?php echo date('j.M',mktime(0,0,0,date('n'),date('j')-23,date('Y'))); ?></td>
                                          <td colspan="6" width="20%" class="time-line"><?php echo date('j.M',mktime(0,0,0,date('n'),date('j')-17,date('Y'))); ?></td>
                                          <td colspan="6" width="20%" class="time-line"><?php echo date('j.M',mktime(0,0,0,date('n'),date('j')-11,date('Y'))); ?></td>
                                          <td colspan="6" width="20%" class="time-line"><?php echo date('j.M',mktime(0,0,0,date('n'),date('j')-5,date('Y'))); ?></td>
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
                                          One View
                                        </h4>
                                    </div>
                                    <div class="box-body" style="border:1px solid #ccc;">
                                      <table width="100%" border="0" cellpadding="5" cellspacing="0" class="oneview">
                                        <tr valign="top"> 
                                          <td width="30%">Visitors</td><td width="20%">{{$visitors_1}}</td>
                                          <td width="30%">Visits</td><td width="20%">{{$visits_1}}</td>
                                        </tr>
                                        <tr valign="top">
                                          <td>Online</td><td>{{$online}}</td>
                                          <td>&nbsp;</td><td>&nbsp;</td>
                                        </tr>
                                        <tr valign="top">
                                          <td>&nbsp;</td><td>&nbsp;</td>
                                          <td>&nbsp;</td><td>&nbsp;</td>
                                        </tr>
                                        <tr valign="top">
                                          <!--bounce-->
                                          <td>Bounce</td>
                                          <td>@if($total>0) {{round(($onepage/$total)*100,2)}} @else 0 @endif %</td>
                                          <td>Page/Visitor</td><td>{{$page_user}}</td>
                                        </tr>
                                        <tr valign="top">
                                          <td>&nbsp;</td><td>&nbsp;</td>
                                          <td>&nbsp;</td><td>&nbsp;</td>
                                        </tr>
                                        <tr valign="top">
                                          <td>&Oslash; 7 days</td><td>{{$avg_7}}</td>
                                          <td>&Oslash; 30 days</td><td>{{$avg_30}}</td>
                                        </tr>
                                        <tr valign="top">
                                          <td>Today</td>
                                          <td>{{$today}}</td>
                                          <td>Yesterday (<?php echo date("G:i",time()); ?>)</td>
                                          <td>{{$yesterday}}</td>
                                        </tr>
                                      </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="padding-left:0px;padding-right:10px;">
                                <div class="box box-solid box-default">
                                    <div class="box-header">
                                        <h4 class="box-title" style="font-size:14px;">
                                          Last 24 hours
                                        </h4>
                                    </div>
                                    <div class="box-body" style="border:1px solid #ccc;height:212px;">
                                      <table height="200px" width="100%" cellpadding="0" cellspacing="0" align="right">
                                        <tr valign="bottom" height="180">
                                          <?php
                                            //Diagram
                                            for($i=0;$i<$bar_var;$i++){
                                              $value=$bar[$i];
                                              if($value=="") $value=0;
                                              if(max($bar)>0){
                                                $bar_height=round((170/$max_bar)*$value);
                                              }else{
                                                $bar_height=0;
                                              }
                                              if($bar_height==0){
                                                $bar_height=1;
                                              }
                                              if($bar_mark==$i){
                                                echo "<td style='border-left: #FF0000 1px dotted;' width='4%'>";
                                              }else{
                                                echo "<td width='4%'>";
                                              }
                                              echo "<div class='chart' style='height:".$bar_height."px' title='".$bar_title[$i]." - ".$value." Visitors'></div></td>";
                                            }
                                          ?>
                                        </tr>
                                        <tr>
                                          <td colspan="6" width="25%" class="time-line"><?php echo date('G:i',mktime(date('H')-23,0,0,date('n'),date('j'),date('Y'))); ?></td>
                                          <td colspan="6" width="25%" class="time-line"><?php echo date('G:i',mktime(date('H')-17,0,0,date('n'),date('j'),date('Y'))); ?></td>
                                          <td colspan="6" width="25%" class="time-line"><?php echo date('G:i',mktime(date('H')-11,0,0,date('n'),date('j'),date('Y'))); ?></td>
                                          <td colspan="6" width="25%" class="time-line"><?php echo date('G:i',mktime(date('H')-5,0,0,date('n'),date('j'),date('Y'))); ?></td>
                                        </tr>
                                      </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                <div class="box box-solid box-default">
                                    <div class="box-header">
                                        <h4 class="box-title" style="font-size:14px;">
                                          Last 30 days
                                        </h4>
                                    </div>
                                    <div class="box-body" style="border:1px solid #ccc;height:242px;">
                                      <table height="230px" width="100%" cellpadding="0" cellspacing="0" align="right">
                                        <tr valign="bottom" height="210px">
                                          <!-- Diagram -->
                                          <?php
                                            for($i=0;$i<$bar_var_1;$i++){
                                              $value1=$bar_1[$i]; 
                                              if($value1=="") $value1=0; 
                                              if(max($bar_1)>0){
                                                $bar_height_1=round((200/$max_bar_1)*$value1);
                                              }else{
                                                $bar_height_1=0;
                                              }
                                              if($bar_height_1==0){
                                                $bar_height_1=1;
                                              }
                                              if($bar_mark_1==$i){
                                                echo "<td style='border-left: #FF0000 1px dotted;' width='3%'>";
                                              }else{
                                                echo "<td width='3%'>";
                                              }
                                              echo "<div class='chart' style='height:".$bar_height_1."px' title='".$bar_title_1[$i]." - ".$value1." Visitors'></div></td>";
                                            }
                                          ?>
                                        </tr>
                                        <tr height="20px">
                                          <td colspan="6" width="20%" class="time-line"><?php echo date('j.M',mktime(0,0,0,date('n'),date('j')-29,date('Y'))); ?></td>
                                          <td colspan="6" width="20%" class="time-line"><?php echo date('j.M',mktime(0,0,0,date('n'),date('j')-23,date('Y'))); ?></td>
                                          <td colspan="6" width="20%" class="time-line"><?php echo date('j.M',mktime(0,0,0,date('n'),date('j')-17,date('Y'))); ?></td>
                                          <td colspan="6" width="20%" class="time-line"><?php echo date('j.M',mktime(0,0,0,date('n'),date('j')-11,date('Y'))); ?></td>
                                          <td colspan="6" width="20%" class="time-line"><?php echo date('j.M',mktime(0,0,0,date('n'),date('j')-5,date('Y'))); ?></td>
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