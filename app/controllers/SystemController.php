<?php
class SystemController extends BaseController{
	public function system_info(){
		$user=User::find(Auth::user()->id);
		return View::make('admin/system/system_info')->with('user',$user);
	}
	public function set_time_out(){
		if($_SERVER['SERVER_NAME']=='localhost'||$_SERVER['SERVER_NAME']=='lqc.tintuc.vn'){
            $configs=require '../app/config/local/database.php';
		}else if($_SERVER['SERVER_NAME']=='sqc.tintuc.vn'){
            $configs=require '../app/config/staging/database.php';
		}else if($_SERVER['SERVER_NAME']=='qc.tintuc.vn'){
            $configs=require '../app/config/production/database.php';
		}
        //$default=$configs['default'];
        $hostname=$configs['connections']['mysql']['host'];
        $username=$configs['connections']['mysql']['username'];
        $password=$configs['connections']['mysql']['password'];
        $database=$configs['connections']['mysql']['database'];
        $charset=$configs['connections']['mysql']['charset'];
        $collection=$configs['connections']['mysql']['collation'];
        $prefix=$configs['connections']['mysql']['prefix'];
        $config=$configs['connections']['mysql'];
        $data_backups=Backup::first(); 
        $timeout=TimeOut::first();
		return View::make('admin/system/set_time_out')->with('data_backups',$data_backups)->with('hostname',$hostname)->with('username',$username)->with('password',$password)->with('database',$database)->with('timeout',$timeout);
	}
	public function postSetTimeOut(){
		$timeout=DB::table('settimeout')->first(); 
		if(count($timeout)>0){
			DB::table('settimeout')->where('id',$timeout['id'])->update(
				array(
					'cache_view'=>Input::get('cache_view'),
					'find_ad_error'=>Input::get('find_ad_error'),
					'request_ip'=>Input::get('request_ip'),
					'backup_database'=>Input::get('backup_database'),
					'backup_file'=>Input::get('backup_file'),
					'scan_code'=>Input::get('scan_code'),
					'created_at'=>date('Y-m-d H:i:s'),
				)
			);
		}else{
			DB::table('settimeout')->insert(
				array(
					'cache_view'=>Input::get('cache_view'),
					'find_ad_error'=>Input::get('find_ad_error'),
					'request_ip'=>Input::get('request_ip'),
					'backup_database'=>Input::get('backup_database'),
					'backup_file'=>Input::get('backup_file'),
					'scan_code'=>Input::get('scan_code'),
					'created_at'=>date('Y-m-d H:i:s'),
				)
			);
		}
		return Redirect::to('admin/set_time_out');
	}
}
?>