<?php
$characters="0123456789abcdefghijklmnopqrstuvwxyz";
$randomDir="";
$randomFile="";
$randomSubDir="";
for($i=0;$i<2;$i++){
	$randomDir.=$characters[rand(0,strlen($characters)-1)];
	$randomSubDir.=$characters[rand(0,strlen($characters)-1)];
}
for($i=0;$i<32;$i++){
	$randomFile.=$characters[rand(0,strlen($characters)-1)];
}
//name for file cache
$script_name=$_SERVER["SCRIPT_NAME"];
$break=Explode('/',$script_name);
$file=$break[count($break)-1];
//$cachefile='../app/storage/cache/cache-'.substr_replace($file, "", -4);

//time storage cache 
$cachetime=72;  //echo filemtime('../app/storage/cache'); 
//die();
//export file cache, with 2 conditions: has cache file and not overflow cachetime
if(time()-$cachetime>filemtime('../app/storage/cache')){
	if(!file_exists('../app/storage/cache/'.$randomDir.'/'.$randomSubDir)){
		mkdir('../app/storage/cache/'.$randomDir.'/'.$randomSubDir,0777,true);
	}
	$cachefile='../app/storage/cache/'.$randomDir.'/'.$randomSubDir.'/'.$randomFile;
	include($cachefile);
	//exit();
}
ob_start();//on buff for output

header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS'); 

//Hẹn giờ xóa tất cả bản ghi lưu trữ trong bảng views
// $timer="00:00:00";
// $time_now=date("H:i:s");
// if($time_now=$timer){ 
// 	$sqlDelete="DELETE FROM views";
// 	mysql_query($sqlDelete);
// }else{}	

	if(isset($_REQUEST['url_page'])){	
		$url_page=$_REQUEST['url_page'];
		//echo $url_page; die();
	    //echo count_views($url_page); 
	    count_views($url_page);
	}else{
		count_views('');
	}

//hit counter function
function count_views($url_page){ 
	//$config=require '../app/config/local/database.php';
	$config=require '../app/config/production/database.php'; //echo '<pre/>'; print_r($config); die();
	$host=$config['connections']['mysql']['host'];
	$username=$config['connections']['mysql']['username'];
	$password=$config['connections']['mysql']['password'];
	$database=$config['connections']['mysql']['database'];
	define('DB_USER',$username);//db user
	define('DB_PASSWORD',$password);//db password
	define('DB_DATABASE',$database);//database name
	define('DB_SERVER',$host);//db server
	$link=mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD);
	if(!$link){
		die('Could not connect: '.mysql_error());
	}else{
		echo 'Connected to '.DB_SERVER.' successfully<br/>';
	}
	$dbselect=mysql_select_db(DB_DATABASE);
	if(!$dbselect){
		die("Can't use database ".DB_DATABASE." : ".mysql_error());
	}else{
		//echo 'Using database '.DB_DATABASE.' successfully<br/>';
	}
	//$count_total_view=1;
	$result=mysql_query("SELECT * FROM websites WHERE website='".trim($url_page,' ')."'");
	if($result){
		$row=mysql_fetch_array($result);
		// ##########################################################
		// ############# add IP and user-agent and time #############
		// ##########################################################
		//gather user data
		$ip_address=$_SERVER["REMOTE_ADDR"];
		$user_agent=$_SERVER['HTTP_USER_AGENT'];
		$date=explode(' ',date('Y-m-d H:i:s'))['0']; //echo $date; die();
		$delay=1800;
		$result2=mysql_query("SELECT * FROM views WHERE website_id='".trim($row['id'],' ')."' AND ip_address='".trim($ip_address,' ')."' AND UNIX_TIMESTAMP(view_at)+$delay>UNIX_TIMESTAMP(NOW())");
		//echo mysql_num_rows($result2); die();
		if($result2&&mysql_num_rows($result2)==0){//check if the IP is in database
			$sql_check_day="SELECT * FROM cviews WHERE day='".$date."'";
			if(mysql_query($sql_check_day)&&mysql_num_rows(mysql_query($sql_check_day))==0){ 
				$sql_insert_day="INSERT INTO cviews(day,user,view) VALUES('$date',1,1)";
				mysql_query($sql_insert_day);
			}else{ //echo 1; die();
				$sql_check_ip="SELECT * FROM views WHERE ip_address='".$_SERVER['REMOTE_ADDR']."' AND view_at LIKE '".trim($date,' ')."%'";
				if(mysql_query($sql_check_ip)&&mysql_num_rows(mysql_query($sql_check_ip))==0){
					$sql_update_day="UPDATE cviews SET user=user+1, view=view+1 WHERE day='".trim($date,' ')."'";
				}else{
					$sql_update_day="UPDATE cviews SET view=view+1 WHERE day='".trim($date,' ')."'";
				}
				mysql_query($sql_update_day);
			}	
			////////////////////////////////////////////////////////////////////////////////
			$sql_count="SELECT DISTINCT ip_address FROM views WHERE website_id=".trim($row['id'],' ');
			$result3=mysql_query($sql_count);
			//dem the nay co khi len den hang trieu ban ghi trong he thong (neu can thiet co the keo dai thoi gian dat 1 session khi nguoi dung click vao banner)
			if($result3){
				$count_unique_view=mysql_num_rows($result3);
			}else{
				$count_unique_view=0;
			}
			$updateview=mysql_query("UPDATE websites SET unique_views=unique_views+1 WHERE website='".trim($url_page,' ')."'");
			//doan nay co the bat session truy cap cua nguoi dung giong nhu trong file click.php
			if($row['id']>0){
				$insertdata=mysql_query("INSERT INTO views(website_id,ip_address,user_agent,view_at) VALUES('".$row['id']."','".$ip_address."','".$user_agent."',NOW())");
			}else{}
		}

		if(mysql_num_rows($result)){ 
			//$total_views=$row['total_views']+1;
			//A counter for this page already exsists. Now we have to update it.
			$updateview=mysql_query("UPDATE websites SET total_views=total_views+1 WHERE website='".trim($url_page,' ')."'");
			if(!$updateview){
				die("Can't update the views : ".mysql_error());
			}else{

			}
		}else{
			//This page did not exists in the counter database. A new counter must be created for this page.
			echo 'Trang web này chưa được đặt dịch vụ làm banner quảng cáo';
		}
		//delete the first entry in table if rows > max_rows
		$maxrows=200;
		$result4=mysql_query("SELECT * FROM views");
		$num_rows=mysql_num_rows($result4);
		$to_delete=$num_rows-$maxrows;
		if($to_delete>0){
			for($i=1;$i<=$to_delete;$i++){
				$delete=mysql_query("DELETE FROM views ORDER BY id LIMIT 1");
				if(!$delete){
					die('Could not delete : '.mysql_error());
				}
			}
		}
	}else{
		echo mysql_error();
	}
}
$cached=fopen($cachefile,'w');
fwrite($cached,ob_get_contents());
fclose($cached);
ob_end_flush();//stop buffer, send content to browser
?>