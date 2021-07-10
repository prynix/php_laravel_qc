<?php

class StatisticController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$banners = Banner::all();
		$acls_updated = Banner::select('acls_updated') -> get();

		$now = date('Y-m-d H:i:s');
		$date = date('d');
		$month = date('m');

		return View::make('admin/statistic/index') -> with('month', $month) -> with('acls_updated', $acls_updated);
	}

	public function getStats(){
		//Clicks
		$time=strtotime(date('Y-m-d H:i:s')); 
		$isonline=date('Y-m-d H:i:s',$time-(3*60)); //3*60 seconds : 3 minutes online
		$start_time=date('Y-m-d H:i:s',mktime(0,0,0,date("n"),date("j"),date("Y")));//-24*60*60); 
		//echo $start_time;
		$end_time=date('Y-m-d H:i:s');//,time()-24*60*60); 
		//echo $end_time;

		$result11=DB::select('SELECT SUM(user) as sum_users,SUM(click) as sum_clicks FROM cclicks');
		$visitors_2 = $result11[0]['sum_users'];
		$visits_2 = $result11[0]['sum_clicks'];

		$result12=DB::select('SELECT COUNT(id) as COUNT_id FROM clicks WHERE click_at>="'.$isonline.'"');
		$online_2=$result12[0]['COUNT_id'];

		$result13=DB::select('SELECT COUNT(id) as COUNT_id FROM clicks');
		$total_2=$result13[0]['COUNT_id'];

		$result14=DB::select('SELECT COUNT(id) as COUNT_id FROM clicks WHERE click_at LIKE "'.date('Y-m-d H:i').'%"');
		$onepage_2=$result14[0]['COUNT_id'];
		//echo $onepage;

		//Page/User and 7 days averange
		$from_day=date("Y-m-d",time()-(7*24*60*60)); //echo $from_day;
		$to_day=date('Y-m-d',time()-(24*60*60)); //echo $to_day;//one hours
		$result15=DB::select('SELECT AVG(user) as avg_user,(SUM(click)/SUM(user)) as sum_click_div_user FROM cclicks WHERE day >= "'.$from_day.'" AND day <= "'.$to_day.'"');
		$avg_7_2=round($result15[0]['avg_user'],2);
		$page_user_2=round($result15[0]['sum_click_div_user'],1); //echo $page_user;

		//30 days averange
		$from_day=date("Y-m-d",time()-(30*24*60*60)); //echo $from_day;
		$to_day=date('Y-m-d',time()-(24*60*60)); //echo $to_day;//one hours
		$result16=DB::select('SELECT AVG(user) as avg_user FROM cclicks WHERE day >= "'.$from_day.'" AND day <= "'.$to_day.'"');
		$avg_30_2=round($result16[0]['avg_user'],2);

		//Today
		$sel_timestamp=mktime(0,0,0,date("n"),date("j"),date("Y"));
		$sel_tag=date("Y-m-d",$sel_timestamp);
		$result17=DB::select('SELECT SUM(user) as sum_user FROM cclicks WHERE day = "'.$sel_tag.'"');
		$today_2=$result17[0]['sum_user'];
		$today_2=($today_2=='')?0:$today_2;

		//Yesterday
		$result18=DB::select('SELECT COUNT(id) as count_id FROM clicks WHERE click_at >= "'.$start_time.'" AND click_at <= "'.$end_time.'"');
		$yesterday_2=$result18[0]['count_id'];

		$bar_2=array();
		$bar_title_2=array();
		$bar_var_2=0;
        $bar_mark_2="";
        for($h=23;$h>=0;$h--){
        	$start_time=mktime(date("H")-$h,0,0,date("n"),date("j"),date("Y")); 
        	$start=date('Y-m-d H:i:s',$start_time);
        	$end_time=mktime(date("H")-$h,59,59,date("n"),date("j"),date("Y"));
        	$end=date('Y-m-d H:i:s',$end_time);
        	$result19=DB::select('SELECT COUNT(id) as count_id FROM clicks WHERE click_at >= "'.$start.'" AND click_at <= "'.$end.'"');
        	$user=$result19[0]['count_id'];
        	$bar_2[$bar_var_2]=$user;
        	$bar_title_2[$bar_var_2]=date("G:i",$start_time)." - ".date("G:i",$end_time);
        	if(date("H")-$h==0){
        		$bar_mark_2=$bar_var_2;
        	}
        	$bar_var_2++;
        }

        $bar_3=array();
		$bar_title_3=array();
		$bar_var_3=0;
        $bar_mark_3="";
        for($day=29;$day>=0;$day--){
        	$sel_timestamp=mktime(0,0,0,date("n"),date("j")-$day,date("Y"));//make current date
        	$sel_tag=date('Y-m-d',$sel_timestamp);
        	$result20=DB::select('SELECT SUM(user) as sum_user FROM cclicks WHERE day = "'.$sel_tag.'"');
        	$user1=$result20[0]['sum_user'];
        	$bar_3[$bar_var_3]=$user1;
        	$bar_title_3[$bar_var_3]=date("j.M.Y",$sel_timestamp);
        	if(date("j")-$day==1){
        		$bar_mark_3=$bar_var_3;
        	}
        	if(date('w',$sel_timestamp)==6 OR date('w',$sel_timestamp)==0){
        		$weekend[$bar_var_3]=true;
        	}else{
        		$weekend[$bar_var_3]=false;
        	}
        	$bar_var_3++;
        }
		//Views
		//Online
		//$time=strtotime(date('Y-m-d H:i:s')); 
		//$isonline=date('Y-m-d H:i:s',$time-(3*60)); //3*60 seconds : 3 minutes online

		//Views
		$result1=DB::select('SELECT SUM(user) as sum_users,SUM(view) as sum_views FROM cviews');
		$visitors_1 = $result1[0]['sum_users'];
		$visits_1 = $result1[0]['sum_views'];

		$result2=DB::select('SELECT COUNT(id) as COUNT_id FROM views WHERE view_at>="'.$isonline.'"');
		$online=$result2[0]['COUNT_id'];

		$result3=DB::select('SELECT COUNT(id) as COUNT_id FROM views');
		$total=$result3[0]['COUNT_id'];

		$result4=DB::select('SELECT COUNT(id) as COUNT_id FROM views WHERE view_at LIKE "'.date('Y-m-d H:i').'%"');
		$onepage=$result4[0]['COUNT_id'];
		//echo $onepage;

		//Page/User and 7 days averange
		$from_day=date("Y-m-d",time()-(7*24*60*60)); //echo $from_day;
		$to_day=date('Y-m-d',time()-(24*60*60)); //echo $to_day;//one hours
		$result5=DB::select('SELECT AVG(user) as avg_user,(SUM(view)/SUM(user)) as sum_view_div_user FROM cviews WHERE day >= "'.$from_day.'" AND day <= "'.$to_day.'"');
		$avg_7=round($result5[0]['avg_user'],2);
		$page_user=round($result5[0]['sum_view_div_user'],1); //echo $page_user;

		//30 days averange
		$from_day=date("Y-m-d",time()-(30*24*60*60)); //echo $from_day;
		$to_day=date('Y-m-d',time()-(24*60*60)); //echo $to_day;//one hours
		$result6=DB::select('SELECT AVG(user) as avg_user FROM cviews WHERE day >= "'.$from_day.'" AND day <= "'.$to_day.'"');
		$avg_30=round($result6[0]['avg_user'],2);

		//Today
		$sel_timestamp=mktime(0,0,0,date("n"),date("j"),date("Y"));
		$sel_tag=date("Y-m-d",$sel_timestamp);
		$result7=DB::select('SELECT SUM(user) as sum_user FROM cviews WHERE day = "'.$sel_tag.'"');
		$today=$result7[0]['sum_user'];
		$today=($today=='')?0:$today;

		//Yesterday
		//$start_time=date('Y-m-d H:i:s',mktime(0,0,0,date("n"),date("j"),date("Y"))-24*60*60); //echo $start_time;
		//$end_time=date('Y-m-d H:i:s',time()-24*60*60); //echo $end_time;
		$result8=DB::select('SELECT COUNT(id) as count_id FROM views WHERE view_at >= "'.$start_time.'" AND view_at <= "'.$end_time.'"');
		$yesterday=$result8[0]['count_id'];

		$bar=array();
		$bar_title=array();
		$bar_var=0;
        $bar_mark="";
        for($h=23;$h>=0;$h--){
        	$start_time=mktime(date("H")-$h,0,0,date("n"),date("j"),date("Y"));
        	$start_1=date('Y-m-d H:i:s',$start_time);
        	$end_time=mktime(date("H")-$h,59,59,date("n"),date("j"),date("Y"));
        	$end_1=date('Y-m-d H:i:s',$end_time);
        	$result9=DB::select("SELECT COUNT(id) as count_id FROM views WHERE view_at >= '".$start_1."' AND view_at <= '".$end_1."'");
        	$user=$result9[0]['count_id'];
        	$bar[$bar_var]=$user;
        	$bar_title[$bar_var]=date("G:i",$start_time)." - ".date("G:i",$end_time);
        	if(date("H")-$h==0){
        		$bar_mark=$bar_var;
        	}
        	$bar_var++;
        }

        $bar_1=array();
		$bar_title_1=array();
		$bar_var_1=0;
        $bar_mark_1="";
        for($day=29;$day>=0;$day--){
        	$sel_timestamp=mktime(0,0,0,date("n"),date("j")-$day,date("Y"));//make current date
        	$sel_tag=date('Y-m-d',$sel_timestamp);
        	$result10=DB::select('SELECT SUM(user) as sum_user FROM cviews WHERE day = "'.$sel_tag.'"');
        	$user1=$result10[0]['sum_user'];
        	$bar_1[$bar_var_1]=$user1;
        	$bar_title_1[$bar_var_1]=date("j.M.Y",$sel_timestamp);
        	if(date("j")-$day==1){
        		$bar_mark_1=$bar_var_1;
        	}
        	if(date('w',$sel_timestamp)==6 OR date('w',$sel_timestamp)==0){
        		$weekend[$bar_var_1]=true;
        	}else{
        		$weekend[$bar_var_1]=false;
        	}
        	$bar_var_1++;
        }
        //echo '<pre/>'; print_r($result9); die();

		return View::make('admin/statistic/stats')
		->with('online',$online)
		->with('total',$total)
		->with('online_2',$online_2)
		->with('total_2',$total_2)
		->with('visitors_1',$visitors_1)
		->with('visits_1',$visits_1)
		->with('onepage',$onepage)
		->with('avg_7',$avg_7)
		->with('page_user',$page_user)
		->with('avg_30',$avg_30)
		->with('today',$today)
		->with('yesterday',$yesterday)
		->with('bar',$bar)
		->with('max_bar',max($bar))
		->with('bar_title',$bar_title)
		->with('bar_var',$bar_var)
		->with('bar_mark',$bar_mark)
		->with('bar_1',$bar_1)
		->with('max_bar_1',max($bar_1))
		->with('bar_title_1',$bar_title_1)
		->with('bar_var_1',$bar_var_1)
		->with('bar_mark_1',$bar_mark_1)
		->with('visitors_2',$visitors_2)
		->with('visits_2',$visits_2)
		->with('onepage_2',$onepage_2)
		->with('avg_7_2',$avg_7_2)
		->with('page_user_2',$page_user_2)
		->with('avg_30_2',$avg_30_2)
		->with('today_2',$today_2)
		->with('yesterday_2',$yesterday_2)
		->with('bar_2',$bar_2)
		->with('max_bar_2',max($bar_2))
		->with('bar_title_2',$bar_title_2)
		->with('bar_var_2',$bar_var_2)
		->with('bar_mark_2',$bar_mark_2)
		->with('bar_3',$bar_3)
		->with('max_bar_3',max($bar_3))
		->with('bar_title_3',$bar_title_3)
		->with('bar_var_3',$bar_var_3)
		->with('bar_mark_3',$bar_mark_3)
		;

	}

	public function getHistory() {
		$time = time();
		if (isset($_GET["m"]) AND is_numeric($_GET["m"]) AND $_GET["m"] >= 1 AND $_GET["m"] <= 12) {$show_month = $_GET["m"];
		} else {$show_month = date("n", $time);
		}
		if (isset($_GET["y"]) AND is_numeric($_GET["y"]) AND $_GET["y"] >= 1 AND $_GET["y"] <= 9999) {$show_year = $_GET["y"];
		} else {$show_year = date("Y", $time);
		}
		//Clicks
		$result1 = DB::select('SELECT SUM(user) AS sum_users,SUM(click) AS sum_clicks,MIN(day) AS min_day,AVG(user) AS avg_user FROM cclicks'); //echo '<pre/>'; print_r($result1[0]['avg_user']); die(); 
		$visitors_1 = $result1[0]['sum_users'];
		$visits_1 = $result1[0]['sum_clicks'];
		$since_1 = $result1[0]['min_day'];
		$since_1 = strtotime($since_1);
		$since_1 = date("d F Y", $since_1);
		$total_avg_1 = round($result1[0]['avg_user'], 2);
		$date=date("F Y",mktime(0,0,0,$show_month,1,$show_year));
		$get_timestamp_1 = mktime(0, 0, 0, $show_month, 1, $show_year);
		$get_month_1 = date("Y-m-%", $get_timestamp_1);
		$result2 = DB::select("SELECT SUM(user) AS sum_users,SUM(click) AS sum_clicks,AVG(user) AS avg_user FROM cclicks WHERE day LIKE '$get_month_1'");
		$visitors_2 = $result2[0]['sum_users'];
		$visits_2 = $result2[0]['sum_clicks'];
		$day_avg_1 = round($result2[0]['avg_user'], 2);
		/////////////////////////////////////////////
		$year=date("Y",mktime(0,0,0,$show_month,1,$show_year));
		$back_month_1 = date("n", mktime(0, 0, 0, $show_month, 1, $show_year - 1));
		$back_year_1 = date("Y", mktime(0, 0, 0, $show_month, 1, $show_year - 1));
		$next_month_1 = date("n", mktime(0, 0, 0, $show_month, 1, $show_year + 1));
		$next_year_1 = date("Y", mktime(0, 0, 0, $show_month, 1, $show_year + 1));

		$result3 = DB::select('SELECT LEFT(day,7) AS month,SUM(user) AS user_month FROM cclicks GROUP BY month ORDER BY user_month DESC LIMIT 1');
		$max_month_1 = $result3[0]['user_month'];
		$stat_1 = 0;
		for ($month = 1; $month <= 12; $month++) {
			$get_timestamp = mktime(0, 0, 0, $month, 1, $show_year);
			$get_month = date("Y-m-%", $get_timestamp);
			$result4 = DB::select("SELECT SUM(user) as sum_user FROM cclicks WHERE day LIKE '" . $get_month . "'");
			$chart_1[$stat_1] = $result4; //echo '<pre/>'; print_r($result4[0]->sum_user); 
			$chart_title_1[$stat_1] = date("Y-m", $get_timestamp);
			$chart_month_1[$stat_1] = $month;
			$stat_1++;
		}
		//die();
		//////////////////////////////////////////////////////
		$month_1=date("F Y",mktime(0,0,0,$show_month,1,$show_year));
		$back_month_2 = date("n", mktime(0, 0, 0, $show_month - 1, 1, $show_year));
		$back_year_2 = date("Y", mktime(0, 0, 0, $show_month - 1, 1, $show_year));
		$next_month_2 = date("n", mktime(0, 0, 0, $show_month + 1, 1, $show_year));
		$next_year_2 = date("Y", mktime(0, 0, 0, $show_month + 1, 1, $show_year));

		$stats_1 = 0;
		$month_days = date("t", mktime(0, 0, 0, $show_month, 1, $show_year));
		for ($day = 1; $day <= $month_days; $day++) {
			$get_timestamp = mktime(0, 0, 0, $show_month, $day, $show_year);
			$get_tag = date("Y-m-d", $get_timestamp);
			$result5 = DB::select("SELECT SUM(user) as sum_user FROM cclicks WHERE day = '" . $get_tag . "'");
			$chart_2[$stats_1] = $result5;
			$chart_title_2[$stats_1] = date("j-M-Y", $get_timestamp);
			if (date("j") - $day == 1)
				$chart_mark = $stats_1;
			if (date("w", $get_timestamp) == 6 OR date("w", $get_timestamp) == 0) {$weekend[$stats_1] = true;
			} else {$weekend[$stats_1] = false;
			}
			$stats_1++;
		}
		$get_timestamp = mktime(0, 0, 0, $show_month, 1, $show_year);
		$get_tag = date("Y-m-", $get_timestamp);
		$result6 = DB::select("SELECT MAX(user) as max_user FROM cclicks WHERE day LIKE '" . $get_tag . "%'");
		$max_1 = $result6[0]['max_user'];
		//Views
		$result7 = DB::select('SELECT SUM(user) AS sum_users,SUM(view) AS sum_views,MIN(day) AS min_day,AVG(user) AS avg_user FROM cviews');
		$visitors_3 = $result7[0]['sum_users'];
		$visits_3 = $result7[0]['sum_views'];
		$since_2 = $result7[0]['min_day'];
		$since_2 = strtotime($since_2);
		$since_2 = date("d F Y", $since_2);
		$total_avg_2 = round($result7[0]['avg_user'], 2);

		$get_timestamp = mktime(0, 0, 0, $show_month, 1, $show_year);
		$get_month = date("Y-m-%", $get_timestamp);
		$result8 = DB::select("SELECT SUM(user) AS sum_users,SUM(view) AS sum_views,AVG(user) AS avg_user FROM cviews WHERE day LIKE '$get_month'");
		$visitors_4 = $result8[0]['sum_users'];
		$visits_4 = $result8[0]['sum_views'];
		$day_avg_2 = round($result8[0]['avg_user'], 2);

		///////////////////////////////////////////////
		$result9 = DB::select('SELECT LEFT(day,7) AS month,SUM(user) AS user_month FROM cviews GROUP BY month ORDER BY user_month DESC LIMIT 1');
		$max_month_2 = $result9[0]['user_month'];
		$stat_2 = 0;
		for ($month = 1; $month <= 12; $month++) {
			$get_timestamp = mktime(0, 0, 0, $month, 1, $show_year);
			$get_month = date("Y-m-%", $get_timestamp);
			$result10 = DB::select("SELECT SUM(user) as sum_user FROM cviews WHERE day LIKE '" . $get_month . "'");
			$chart_3[$stat_2] = $result10;
			$chart_title_3[$stat_2] = date("Y-m", $get_timestamp);
			$chart_month_3[$stat_2] = $month;
			$stat_2++;
		}
		$stats_2 = 0;
		$month_days = date("t", mktime(0, 0, 0, $show_month, 1, $show_year));
		for ($day = 1; $day <= $month_days; $day++) {
			$get_timestamp = mktime(0, 0, 0, $show_month, $day, $show_year);
			$get_tag = date("Y-m-d", $get_timestamp);
			$result11 = DB::select("SELECT SUM(user) as sum_user FROM cviews WHERE day = '" . $get_tag . "'");
			$chart_4[$stats_2] = $result11;
			$chart_title_4[$stats_2] = date("j-M-Y", $get_timestamp);
			if (date("j") - $day == 1)
				$chart_mark = $stats_2;
			if (date("w", $get_timestamp) == 6 OR date("w", $get_timestamp) == 0) {$weekend[$stats_2] = true;
			} else {$weekend[$stats_2] = false;
			}
			$stats_2++;
		}
		/////////////////////////////////////////////////////////////////////////////////////////////////////
		$get_timestamp = mktime(0, 0, 0, $show_month, $stats_2, $show_year);
		$get_tag = date("Y-m-", $get_timestamp);
		$result12 = DB::select("SELECT MAX(user) as max_user FROM cviews WHERE day LIKE '" . $get_tag . "%'");
		$max_2 = $result12[0]['max_user'];
		//tiếp tục việc đẩy dữ liệu thông qua biến (rất nhiều) 
		return View::make('admin/statistic/history')->with('show_month',$show_month)->with('show_year',$show_year)
		->with('since_1',$since_1)
		->with('visitors_1',$visitors_1)
		->with('visits_1',$visits_1)
		->with('total_avg_1',$total_avg_1)
        ->with('date',$date)
        ->with('visitors_2',$visitors_2)
		->with('visits_2',$visits_2)
        ->with('day_avg_1',$day_avg_1)
        ->with('year',$year)  
        ->with('back_month_1',$back_month_1)
        ->with('back_year_1',$back_year_1)
        ->with('next_month_1',$next_month_1)
        ->with('next_year_1',$next_year_1)
        ->with('stat_1',$stat_1) 
        ->with('chart_1',$chart_1) 
        ->with('max_month_1',$max_month_1)
        ->with('chart_title_1',$chart_title_1)
        ->with('chart_month_1',$chart_month_1)
        ->with('month_1',$month_1)
        ->with('back_month_2',$back_month_2)
        ->with('back_year_2',$back_year_2)
        ->with('next_month_2',$next_month_2)
        ->with('next_year_2',$next_year_2)
        ->with('stats_1',$stats_1)
        ->with('chart_2',$chart_2) 
        ->with('chart_title_2',$chart_title_2)
        ->with('max_1',$max_1)
        //view
        ->with('since_2',$since_2)
        ->with('visitors_3',$visitors_3)
        ->with('visits_3',$visits_3)
        ->with('total_avg_2',$total_avg_2)
        ->with('visitors_4',$visitors_4)
        ->with('visits_4',$visits_4)
        ->with('day_avg_2',$day_avg_2)
        ->with('stat_2',$stat_2) 
        ->with('chart_3',$chart_3) 
        ->with('max_month_2',$max_month_2)
        ->with('chart_title_3',$chart_title_3)
        ->with('chart_month_3',$chart_month_3)
        ->with('stats_2',$stats_2)
        ->with('chart_4',$chart_4) 
        ->with('chart_title_4',$chart_title_4)
        ->with('max_2',$max_2)
		;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}

}
