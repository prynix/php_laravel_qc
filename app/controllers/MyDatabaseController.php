<?php
class MyDatabaseController extends BaseController{
    public function getModels(){
        return array_filter(scandir(app_path('models/')),function(&$val){
            if($val!='.'&&$val!='..'){
                $val=trim(str_replace('.php','',$val));
                return class_exists($val);
            }
        });
    }
	public function getInfo(){
		if($_SERVER['SERVER_NAME']=='localhost'||$_SERVER['SERVER_NAME']=='lqc.tintuc.vn'){
			$contents=File::get(app_path().'/config/local/database.php');
            //$default=Config::get('database.default');
            $configs=require '../app/config/local/database.php';
		}else if($_SERVER['SERVER_NAME']=='sqc.tintuc.vn'){
            $contents=File::get(app_path().'/config/staging/database.php');
            $configs=require '../app/config/staging/database.php';
		}else if($_SERVER['SERVER_NAME']=='qc.tintuc.vn'){
            $contents=File::get(app_path().'/config/production/database.php');
            $configs=require '../app/config/production/database.php';
		}
        if(isset($configs['default'])){
            $default=$configs['default'];
        }else{
            $default='';
        }
        $host=$configs['connections']['mysql']['host'];
        $username=$configs['connections']['mysql']['username'];
        $password=$configs['connections']['mysql']['password'];
        $database=$configs['connections']['mysql']['database'];
        if(isset($configs['connections']['mysql']['charset'])){
            $charset=$configs['connections']['mysql']['charset'];
        }else{
            $charset='';
        }
        if(isset($configs['connections']['mysql']['collation'])){
            $collection=$configs['connections']['mysql']['collation'];
        }else{
            $collection='';
        }
        if(isset($configs['connections']['mysql']['prefix'])){
            $prefix=$configs['connections']['mysql']['prefix'];
        }else{
            $prefix='';
        }

        $config=$configs['connections']['mysql']; 
        $mydatabase=Connect::all();

        $models=MyDatabaseController::getModels();
        $counts=array();
        foreach ($models as $model) {
            $m=new $model;
            $table=$m->getTable();
            if(isset($table)){
                $count=$table.'&nbsp;('.$model::count().')';
            }
            array_push($counts, $count);
        }
		//echo '<pre/>'; print_r($contents); die();
        $searchfor="'debug' => true";
        $path_to_file=app_path().'/config/app.php'; 
        $file_contents=file_get_contents($path_to_file);
        if(strpos($file_contents, $searchfor)){//tìm kiếm khi đọc trong file này
            $error=TRUE;
        }else{
            $error=FALSE;
        }
		return View::make('admin/database/index')->with('default',$default)->with('config',$config)->with('contents',$contents)->with('mydatabase',$mydatabase)->with('models',$models)->with('counts',$counts)->with('error',$error);
	}
	public function editConnect(){
		$default=Input::get('default');
		$host=Input::get('host');
		$database=Input::get('database');
		$username=Input::get('username');
		$password=Input::get('password');
		$charset=Input::get('charset');
		$collation=Input::get('collation');
		$prefix=Input::get('prefix');
        $configs=Connect::where('database_default','=',$default)->where('hosting','=',$host)->where('database_name','=',$database)->where('username','=',$username)->count();
        
        $rules=array(
            'default'=>'required',
            'host'=>'required',
            'database'=>'required',
            'username'=>'required'
        );
        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){ //nếu thất bại
		  return Redirect::to('admin/connect_to_database')->withErrors($validator);
        }else{
            if($configs>0){
                //? find to update config 
            }else{
                $config=new Connect;
                $config->database_default=Input::get('default');
                $config->hosting=Input::get('host');
                $config->database_name=Input::get('database');
                $config->username=Input::get('username');
                $config->password=Input::get('password');
                $config->charset=Input::get('charset');
                $config->collection=Input::get('collation');
                $config->prefix_table=Input::get('prefix');
                $config->created_at=date('Y-m-d H:i:s');
                $config->save();
            }
            //return Redirect::to('admin/connect_to_database');
        }
            if($_SERVER['SERVER_NAME']=='localhost'||$_SERVER['SERVER_NAME']=='lqc.tintuc.vn'){
                $contents=File::put(app_path().'/config/local/database.php',"
                    <?php
                        return array(
                            'default' => '".$default."',
                            'connections' => array(
                                'mysql' => array(
                                    'driver'    => '".$default."',
                                    'host'      => '".$host."',
                                    'database'  => '".$database."',
                                    'username'  => '".$username."',
                                    'password'  => '".$password."',
                                    'charset'   => '".$charset."',
                                    'collation' => '".$collation."',
                                    'prefix'    => '".$prefix."',
                                ),
                            ),
                        );
                    ?>
                ");
            }else if($_SERVER['SERVER_NAME']=='sqc.tintuc.vn'){

            }else if($_SERVER['SERVER_NAME']=='qc.tintuc.vn'){

            }
            $contents=File::put(app_path().'/config/database.php',"
                    <?php
                        return array(
                            'default' => '".$default."',
                            'connections' => array(
                                'mysql' => array(
                                    'driver'    => '".$default."',
                                    'host'      => '".$host."',
                                    'database'  => '".$database."',
                                    'username'  => '".$username."',
                                    'password'  => '".$password."',
                                    'charset'   => '".$charset."',
                                    'collation' => '".$collation."',
                                    'prefix'    => '".$prefix."',
                                ),
                            ),
                        );
                    ?>
            ");
		  return Redirect::to('admin/connect_to_database');
        }
    public function switchDatabase(){
        $id=Input::get('hosting');
        $server=Connect::where('id','=',$id)->get();
        //echo '<pre/>'; print_r($server); die();
        $default=$server->lists('database_default')[0]; 
        $host=$server->lists('hosting')[0]; 
        $database=$server->lists('database_name')[0]; 
        $username=$server->lists('username')[0]; 
        $password=$server->lists('password')[0]; 
        $charset=$server->lists('charset')[0]; 
        $collation=$server->lists('collection')[0]; 
        $prefix=$server->lists('prefix_table')[0]; 
        if($_SERVER['SERVER_NAME']=='localhost'||$_SERVER['SERVER_NAME']=='lqc.tintuc.vn'){
                $contents=File::put(app_path().'/config/local/database.php',"
                    <?php
                        return array(
                            'default' => '".$default."',
                            'connections' => array(
                                'mysql' => array(
                                    'driver'    => '".$default."',
                                    'host'      => '".$host."',
                                    'database'  => '".$database."',
                                    'username'  => '".$username."',
                                    'password'  => '".$password."',
                                    'charset'   => '".$charset."',
                                    'collation' => '".$collation."',
                                    'prefix'    => '".$prefix."',
                                ),
                            ),
                        );
                    ?>
                ");
            }else if($_SERVER['SERVER_NAME']=='sqc.tintuc.vn'){

            }else if($_SERVER['SERVER_NAME']=='qc.tintuc.vn'){

            }
            $contents=File::put(app_path().'/config/database.php',"
                    <?php
                        return array(
                            'default' => '".$default."',
                            'connections' => array(
                                'mysql' => array(
                                    'driver'    => '".$default."',
                                    'host'      => '".$host."',
                                    'database'  => '".$database."',
                                    'username'  => '".$username."',
                                    'password'  => '".$password."',
                                    'charset'   => '".$charset."',
                                    'collation' => '".$collation."',
                                    'prefix'    => '".$prefix."',
                                ),
                            ),
                        );
                    ?>
            ");
          return Redirect::to('admin/connect_to_database');
    }	
    public function deleteConnect($id){
        $connect=Connect::where('id','=',$id);
        $connect->delete();
        return Redirect::to('admin/connect_to_database');
    }
    public function allowUpdateDatabase(){
        //$logs=DB::select(DB::raw('SHOW BINLOG EVENTS'));
        return View::make('admin/database/allow');//->with('logs',$logs);
    }
    public function allowToInsert($table_name){
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
        $default=$configs['default'];
        $host=$configs['connections']['mysql']['host'];
        $username=$configs['connections']['mysql']['username'];
        $password=$configs['connections']['mysql']['password'];
        $database=$configs['connections']['mysql']['database'];
        $conn=new PDO('mysql:host='.$host.';dbname='.$database,$username,$password);
        $conn->query('CREATE TRIGGER insert_'.$table_name.'_row BEFORE INSERT ON '.$table_name.' FOR EACH ROW BEGIN UPDATE '.$table_name.' SET hide="Y" WHERE id=pID; END');      
    }
    public function notAllowToInsert($table_name){ //DROP TRIGGER IF EXISTS
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
        $default=$configs['default'];
        $host=$configs['connections']['mysql']['host'];
        $username=$configs['connections']['mysql']['username'];
        $password=$configs['connections']['mysql']['password'];
        $database=$configs['connections']['mysql']['database'];
        $conn=new PDO('mysql:host='.$host.';dbname='.$database,$username,$password);
        $conn->query('DROP TRIGGER IF EXISTS insert_'.$table_name.'_row');
    }
    public function allowToUpdate($table_name){
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
        $default=$configs['default'];
        $host=$configs['connections']['mysql']['host'];
        $username=$configs['connections']['mysql']['username'];
        $password=$configs['connections']['mysql']['password'];
        $database=$configs['connections']['mysql']['database'];
        $conn=new PDO('mysql:host='.$host.';dbname='.$database,$username,$password);
        $conn->query('CREATE TRIGGER update_'.$table_name.'_row BEFORE UPDATE ON '.$table_name.' FOR EACH ROW BEGIN UPDATE '.$table_name.' SET hide="Y" WHERE id=pID; END');      
    }
    public function notAllowToUpdate($table_name){ //DROP TRIGGER IF EXISTS
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
        $default=$configs['default'];
        $host=$configs['connections']['mysql']['host'];
        $username=$configs['connections']['mysql']['username'];
        $password=$configs['connections']['mysql']['password'];
        $database=$configs['connections']['mysql']['database'];
        $conn=new PDO('mysql:host='.$host.';dbname='.$database,$username,$password);
        $conn->query('DROP TRIGGER IF EXISTS update_'.$table_name.'_row');
    }
}
?>