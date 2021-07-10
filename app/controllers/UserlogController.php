<?php
class UserlogController extends BaseController{
	public function __construct(){
		$uri=explode('-',Request::segment(2)); 
		if(isset($uri[1])){
			$uri_segment=Uri::where('uri_segment','=',$uri[0].'-'.$uri[1])->get();
		}else{ 
			$uri_segment=Uri::where('uri_segment','=',$uri[0])->get();
		}  
		if(count($uri_segment)>0){ 
			$help=Helper::where('id','=',$uri_segment->lists('helper_id')[0])->where('status','=',1)->get();
		}else{  
			$help=array();
		}
		return $help;
	}
	public function index(){
		$userlogs=Userlog::all();
		return View::make('admin/userlog/index')->with('userlogs',$userlogs)->with('help',$this->__construct());
	}
	public function getShow($id){
		$userlog=Userlog::find($id);
		$users=User::all();
		return View::make('admin/userlog/show')->with('userlog',$userlog)->with('users',$users)->with('help',$this->__construct());	
	}
	public function destroy($id){
		$userlog=Userlog::find($id);
		$userlog->delete();
		//redirect
		Session::flash('message','Successfully deleted the userlog!');
		return Redirect::to('admin/userlog');	
	}
}
?>