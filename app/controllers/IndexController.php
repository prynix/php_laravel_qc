<?php
//file: app/controllers/IndexController.php
class IndexController extends BaseController{
	public function index(){
		//generates response from blog.blade.php
		return View::make('index',['name'=>'usman']);
	}
	public function getAction(){
		//get request handling
	}
	public function postAction(){
		//post request handling
	}
}
?>