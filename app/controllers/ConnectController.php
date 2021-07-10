<?php
class ConnectController extends BaseController{
	public function getInfo(){
		$default=Config::get('database.default');
		$config=Config::get('database.connections.'.$default); //echo '<pre/>'; print_r($config['host']); die();
		
		return View::make('admin/database/index')->with('default',$default)->with('config',$config);
	}
}
?>