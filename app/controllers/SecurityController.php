<?php
class SecurityController extends BaseController{
	public function getlocationfromip(){
		if(isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
            $ipaddress =  $_SERVER['HTTP_CF_CONNECTING_IP'];
        } else if (isset($_SERVER['HTTP_X_REAL_IP'])) {
            $ipaddress = $_SERVER['HTTP_X_REAL_IP'];
        }
        else if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
		//$data=unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ipaddress));
        $data='';
		return $data;
	}
    public function checkEmptyData(){
       $amount=DB::select("SELECT COUNT(*) as number_tables FROM information_schema.TABLES WHERE TABLE_SCHEMA='qc'");
        $number_tables=$amount[0]['number_tables'];
        $show_tables=DB::select("SHOW TABLES");
        for($i=0;$i<count($show_tables);$i++){
            $count=DB::select('SELECT COUNT(*) as number_records FROM '.$show_tables[$i]['Tables_in_qc']);
            //array_push($sh,$show_tables[$i]['Tables_in_qc'].'|'.$count[0]['number_records'].',');
            //draw array and merge array
            $sh[]=array(
                'name'=>$show_tables[$i]['Tables_in_qc'],
                'number_records'=>$count[0]['number_records']
            );
        } 
        return Response::json($sh);
    }
    public function auto_creating_trigger(){
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
        foreach ($triggers as $trigger) {
            foreach ($tables as $table) {
                if($trigger['Trigger']==='delete_'.$table['Tables_in_'.$database].'_row'){
                    
                }else{
                   $conn->query('CREATE TRIGGER delete_'.$table['Tables_in_'.$database].'_row BEFORE DELETE ON '.$table['Tables_in_'.$database].' FOR EACH ROW BEGIN UPDATE '.$table['Tables_in_'.$database].' SET hide="Y" WHERE id=pID; END');
                }
            }
        }
    }
	public function warningInfo(){ 
        include public_path().'/references/general.php';
		$amount=DB::select("SELECT COUNT(*) as number_tables FROM information_schema.TABLES WHERE TABLE_SCHEMA='qc'");
		$number_tables=$amount[0]['number_tables'];
        $show_tables=DB::select("SHOW TABLES");
        for($i=0;$i<count($show_tables);$i++){
            $count=DB::select('SELECT COUNT(*) as number_records FROM '.$show_tables[$i]['Tables_in_qc']);
            //array_push($sh,$show_tables[$i]['Tables_in_qc'].'|'.$count[0]['number_records'].',');
            //draw array and merge array
            $sh[]=array(
                'name'=>$show_tables[$i]['Tables_in_qc'],
                'number_records'=>$count[0]['number_records']
            );
        }
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
        $database=$configs['connections']['mysql']['database'];
        $tables=DB::select(DB::raw('SHOW TABLES'));  
        $triggers=DB::select(DB::raw('SHOW TRIGGERS')); 
        foreach ($triggers as $trigger) {
            foreach ($tables as $table) {
                if($trigger['Trigger']==='delete_'.$table['Tables_in_'.$database].'_row'){
                    $condition="<i style='color:#FF0000;'>Don't allow delete record</i>";
                }else{
                    $condition="<i style='color:#7CFC00;'>Allow delete record</i>";
                }
            }
        }
        //print_r($_SERVER); die();
		return View::make('admin/system/system_warning')->with('number_tables',$number_tables)->with('sh',$sh)->with('triggers',$triggers)->with('condition',$condition);
	}
    public function autoChangePassword(){
        //generating password
        $chars='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_';
        $password=substr(str_shuffle($chars),0,16);
        //print_r($password);
        //generating new password as done in above function and update it in database by below query
        $password1=Hash::make($password); //encrypting password
        //print_r($password1);
        try{
            if(isset(Auth::user()->email)){
                $email=Auth::user()->email;
            }else{
                $email='daotientu@gmail.com';
            }
            User::where('email','=',$email)->update(
                array(
                    'password'=>$password1
                )
            );
            $to=$email;
            $subject='Your New Password ...';
            $message='Hello User,\n Your new password: '.$password.'\n E-mail: '.$email.'\nNow you can login with this email and new password.';
            Mail::send('emails.change_password',array('password'=>$password,'email'=>$email),function($message) use($to,$subject){
                $message->to($to,'AdMan')->subject($subject);
            });
            if(count(Mail::failures())>0){
                return 0;
            }else{
                return 1;
            }
        }catch(PDOException $e){
            return 0;
        }
    }
    //LOGS EVENT
    public function show_logs(){
    }
    //GHI DATABASE RA API
    public function dump_database($table=''){ 
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
        //folder project dynamic ????
        if($table!==''){
            $backup_file=$_SERVER['DOCUMENT_ROOT']."/qc/public/dump/".$table.".sql";
            if(file_exists($backup_file)){
                unlink($backup_file);
            }
            DB::select(DB::raw("SELECT * INTO OUTFILE '$backup_file' FROM ".$table));
            Session::flash('success','Backup table `'.$table.'` successfully!');
            return Redirect::to('admin/switch_to_update_database');
        }else{
            $show_tables=DB::select("SHOW TABLES");
            for($i=0;$i<count($show_tables);$i++){ 
                $backup_file=$_SERVER['DOCUMENT_ROOT']."/qc/public/dump/".$show_tables[$i]['Tables_in_qc'].".sql";
                //Kiem tra co ton tai file do khong, neu co thi delete truoc roi moi generate table
                if(file_exists($backup_file)){
                    unlink($backup_file);
                }
                DB::select(DB::raw("SELECT * INTO OUTFILE '$backup_file' FROM ".$show_tables[$i]['Tables_in_qc']));
                //To restore the backup
                //$sql = "LOAD DATA INFILE '$backup_file' INTO TABLE $table_name";
            }
        }
        //exec("mysqldump --opt -h $host -u $username -p $password $database users > ".public_path()."/dump/users.sql");
    }
    public function sendEmail(){
        
    }
    
}
?>