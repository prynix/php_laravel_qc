	<?php
	class BackupController extends BaseController{
		var $host='';
		var $username='';
		var $password='';
		var $databasename='';
		var $charset='';
		public function backup_database(){
			return View::make('admin/backup/database');
		}
		public function backups(){
			//return View::make('admin/database/handle');
			return Redirect::to('handle.php');
		}
		public function backup_files(){
			return View::make('admin/backup/files');
		}
		public function showBackup(){
			$list=array();
			if($handle=opendir(public_path().'/backups')){
				while(($entry=readdir($handle))<false){
					if($entry!='.'&&$entry!='..'){
						array_push($list,$entry);
					}
				}
				closedir($handle);
			}
			return View::make('admin/backup/show_backup')->with('list',$list);
		}
		public function zipFiles(){
			ini_set('max_execution_time',600);//thời gian thực thi
			ini_set('memory_limit','1024M');//cài đặt dung lượng bộ nhớ
			$datetime=date('Y-m-d_H-i');
			//start the backup all sites
			$this->zipData(public_path().'/uploads/adbanner_images/',public_path().'/backups/project_qc_'.$datetime.'.zip');//class trỏ tới function khác
			return Redirect::to('admin/backup_files');
		}
		function zipData($source,$destination){
			if(extension_loaded('zip')){
				if(file_exists($source)){
					$zip=new ZipArchive();
					if($zip->open($destination,ZIPARCHIVE::CREATE)){
						$source=str_replace('','/',realpath($source));
						if(is_dir($source)===true){
							$files=new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source),RecursiveIteratorIterator::SELF_FIRST);
							foreach($files as $file){
								$file=str_replace('','/',$file);
								$file=realpath($file);
								if(is_dir($file)){
									$zip->addEmptyDir(str_replace($source.'/','',$file.'/'));
								}else if(is_file($file)){
									$zip->addFromString(str_replace($source.'/','',$file),file_get_contents($file));
								}
							}
						}else if(is_file($source)){
							$zip->addFromString(basename($source),file_get_contents($source));
						}
					}
					return $zip->close();
				}
			}
			return false;
		}
		public function download($filename){
			return View::make('admin/backup/download')->with('filename',$filename);
		}
		public function save_config_backup_database(){
			$first_record=Backup::first(); 
			if(count($first_record)>0){
				Backup::where('id','=',$first_record->id)->update(
					array(
						"hostname"=>Input::get('hostname'),
						"username"=>Input::get('username'),
						"password"=>Input::get('password'),
						"databasename"=>Input::get('databasename'),
						"updated_at"=>date('Y-m-d H:i:s')
					)
				);
			}else{
				Backup::insert(
					array(
						"hostname"=>Input::get('hostname'),
						"username"=>Input::get('username'),
						"password"=>Input::get('password'),
						"databasename"=>Input::get('databasename'),
						"created_at"=>date('Y-m-d H:i:s')
					)
				);
			}
			return Redirect::to('admin/set_time_out');
		}
		public function auto_backup_database(){
			/*require_once(public_path().'/includes/definitions.php');
			require_once(public_path().'/includes/functions.inc.php');
			PMBP_dump("qc","on","on","on","off","");*/
			include(public_path().'/backup_database.php');
	    }
	    public function checkMissingDatabase(){
	    	$r=DB::table('datatables')->first();
	    	if(count($r)>0){
	    		$n_accounts=DB::select('SELECT COUNT(*) as number_records FROM accounts'); //2
	    		$n_adtypes=DB::select('SELECT COUNT(*) as number_records FROM adtypes'); //3
	    		$n_banners=DB::select('SELECT COUNT(*) as number_records FROM banners'); //4
	    		$n_campaigns=DB::select('SELECT COUNT(*) as number_records FROM campaigns'); //5
	    		$n_categories=DB::select('SELECT COUNT(*) as number_records FROM categories'); //6
	    		$n_cclicks=DB::select('SELECT COUNT(*) as number_records FROM cclicks'); //7

	    		$n_channels=DB::select('SELECT COUNT(*) as number_records FROM channels'); //8
	    		$n_clicks=DB::select('SELECT COUNT(*) as number_records FROM clicks'); //9

	    		$n_clients=DB::select('SELECT COUNT(*) as number_records FROM clients'); //10
	    		$n_countries=DB::select('SELECT COUNT(*) as number_records FROM countries'); //11
	    		$n_cviews=DB::select('SELECT COUNT(*) as number_records FROM cviews'); //12
	    		$n_data_helper=DB::select('SELECT COUNT(*) as number_records FROM data_helper'); //13
	    		$n_data_uri=DB::select('SELECT COUNT(*) as number_records FROM data_uri'); //14
	    		$n_folder_banners=DB::select('SELECT COUNT(*) as number_records FROM folder_banners'); //15
	    		$n_groups=DB::select('SELECT COUNT(*) as number_records FROM groups'); //16
	    		$n_languages=DB::select('SELECT COUNT(*) as number_records FROM languages'); //17
	    		$n_requests=DB::select('SELECT COUNT(*) as number_records FROM requests'); //18 
	    		$n_settimeout=DB::select('SELECT COUNT(*) as number_records FROM settimeout'); //19
	    		$n_throttle=DB::select('SELECT COUNT(*) as number_records FROM throttle'); //20
	    		$n_userlogs=DB::select('SELECT COUNT(*) as number_records FROM userlogs'); //21
	    		$n_users=DB::select('SELECT COUNT(*) as number_records FROM users'); //22
	    		$n_users_groups=DB::select('SELECT COUNT(*) as number_records FROM users_groups'); //23
	    		$n_views=DB::select('SELECT COUNT(*) as number_records FROM views'); //24
	    		$n_websites=DB::select('SELECT COUNT(*) as number_records FROM websites'); //25
	    		$n_zones=DB::select('SELECT COUNT(*) as number_records FROM zones'); //26
	    		$n_zonetypes=DB::select('SELECT COUNT(*) as number_records FROM zonetypes'); //27
	    		
	    		DB::table('datatables')->where('id','=',$r['id'])->update(
	    			array(
	    				'accounts'=>$n_accounts[0]['number_records'], //2
	    				'adtypes'=>$n_adtypes[0]['number_records'], //3
	    				'banners'=>$n_banners[0]['number_records'], //4
	    				'campaigns'=>$n_campaigns[0]['number_records'], //5
	    				'categories'=>$n_categories[0]['number_records'], //6
	    				'cclicks'=>$n_cclicks[0]['number_records'], //7
	    				'channels'=>$n_channels[0]['number_records'], //8
	    				'clicks'=>$n_clicks[0]['number_records'], //9
	    				'clients'=>$n_clients[0]['number_records'], //10
	    				'countries'=>$n_countries[0]['number_records'], //11
	    				'cviews'=>$n_cviews[0]['number_records'], //12
	    				'data_helper'=>$n_data_helper[0]['number_records'], //13
	    				'data_uri'=>$n_data_uri[0]['number_records'], //14
	    				'folder_banners'=>$n_folder_banners[0]['number_records'], //15
	    				'groups'=>$n_groups[0]['number_records'], //16
	    				'languages'=>$n_languages[0]['number_records'], //17
	    				'requests'=>$n_requests[0]['number_records'], //18
	    				'settimeout'=>$n_settimeout[0]['number_records'], //19
	    				'throttle'=>$n_throttle[0]['number_records'], //20
	    				'userlogs'=>$n_userlogs[0]['number_records'], //21
	    				'users'=>$n_users[0]['number_records'], //22
	    				'users_groups'=>$n_users_groups[0]['number_records'], //23
	    				'views'=>$n_views[0]['number_records'], //24
	    				'websites'=>$n_websites[0]['number_records'], //25
	    				'zones'=>$n_zones[0]['number_records'], //26
	    				'zonetypes'=>$n_zonetypes[0]['number_records'] //27
	    			)
	    		);
				//TRONG TRƯỜNG HỢP KHÔNG TỒN TẠI BẢNG ĐÓ THÌ SAO ??????????????????????????????????????????????????????????????????
				$path=public_path().'/backups/tables/';
				$vals['db_user']='root';
				$vals['db_pass']='';
				$vals['db_host']='localhost';
				$vals['db_name']='qc';
				//2
				if($n_accounts[0]['number_records']<$r['accounts']){
					//CHƯA CHẠY ĐƯỢC
					$command="mysql -u{$vals['db_user']} -p{$vals['db_pass']} "."-h {$vals['db_host']} -D {$vals['db_name']} < {$path}";
					$ouput=shell_exec($command.'accounts.sql');
				}else{}
				//3
				if($n_adtypes[0]['number_records']<$r['adtypes']){
					
				}else{}
				//4
				if($n_banners[0]['number_records']<$r['banners']){
					
				}else{}
				//5
				if($n_campaigns[0]['number_records']<$r['campaigns']){
					
				}else{}
				//6
				if($n_categories[0]['number_records']<$r['categories']){
					
				}else{}
				//7
				if($n_cclicks[0]['number_records']<$r['cclicks']){
					
				}else{}
				//8
				if($n_channels[0]['number_records']<$r['channels']){
					
				}else{}
				//9
				if($n_clicks[0]['number_records']<$r['clicks']){
					
				}else{}
				//10
				if($n_clients[0]['number_records']<$r['clients']){
					
				}else{}
				//11
				if($n_countries[0]['number_records']<$r['countries']){
					
				}else{}
				//12
				if($n_cviews[0]['number_records']<$r['cviews']){
					
				}else{}
				//13
				if($n_data_helper[0]['number_records']<$r['data_helper']){
					
				}else{}
				//14
				if($n_data_uri[0]['number_records']<$r['data_uri']){
					
				}else{}
				//15
				if($n_folder_banners[0]['number_records']<$r['folder_banners']){
					
				}else{}
				//16
				if($n_groups[0]['number_records']<$r['groups']){
					
				}else{}
				//17
				if($n_languages[0]['number_records']<$r['languages']){
					
				}else{}
				//18
				if($n_requests[0]['number_records']<$r['requests']){
					
				}else{}
				//19
				if($n_settimeout[0]['number_records']<$r['settimeout']){
					
				}else{}
				//20
				if($n_throttle[0]['number_records']<$r['throttle']){
					
				}else{}
				//21
				if($n_userlogs[0]['number_records']<$r['userlogs']){
					
				}else{}
				//22
				if($n_users[0]['number_records']<$r['users']){
					
				}else{}
				//23
				if($n_users_groups[0]['number_records']<$r['users_groups']){
					
				}else{}
				//24
				if($n_views[0]['number_records']<$r['views']){
					
				}else{}
				//25
				if($n_websites[0]['number_records']<$r['websites']){
					
				}else{}
				//26
				if($n_zones[0]['number_records']<$r['zones']){
					
				}else{}
				//27
				if($n_zonetypes[0]['number_records']<$r['zonetypes']){
					
				}else{}
	    	}else{
	    		DB::table('datatables')->insert(
	    			array(
	    				'accounts'=>0, //2
	    				'adtypes'=>0, //3
	    				'banners'=>0, //4
	    				'campaigns'=>0, //5
	    				'categories'=>0, //6
	    				'cclicks'=>0, //7
	    				'channels'=>0, //8
	    				'clicks'=>0, //9
	    				'clients'=>0, //10
	    				'countries'=>0, //11
	    				'cviews'=>0, //12
	    				'data_helper'=>0, //13
	    				'data_uri'=>0, //14
	    				'folder_banners'=>0, //15
	    				'groups'=>0, //16
	    				'languages'=>0, //17
	    				'requests'=>0, //18
	    				'settimeout'=>0, //19
	    				'throttle'=>0, //20
	    				'userlogs'=>0, //21
	    				'users'=>0, //22
	    				'users_groups'=>0, //23
	    				'views'=>0, //24
	    				'websites'=>0, //25
	    				'zones'=>0, //26
	    				'zonetypes'=>0 //27
	    			)
	    		);
	    	}
	    }
	}
	?>