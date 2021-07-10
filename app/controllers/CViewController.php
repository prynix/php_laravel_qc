<?php
class CViewController extends BaseController{
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
	public function getList(){
		$websites=Website::all();
		//Luu lai lan dang nhap vao page dau tien
		$views=DB::table('views')->select('id','ip_address','user_agent','region','lat','long','view_at')->groupBy('ip_address')->get();//moi lay dc lan truy cap dau tien cua dia chi ip
		$view=Views::select(DB::raw('DISTINCT ip_address'),'id')->orderBy('view_at','DESC')->get();
		//echo '<pre/>';
		//print_r($view); die();
		//$views=Views::all();
		$total_unique_ip=DB::table('views')->count(DB::raw('DISTINCT ip_address'));
		$total_hits=DB::table('websites')->sum(DB::raw('total_views'));
		return View::make('admin/view/index')->with('websites',$websites)->with('view',$view)->with('views',$views)->with('total_hits',$total_hits)->with('total_unique_ip',$total_unique_ip)->with('help',$this->__construct());
	}
	public function deleteViews(){
		Views::truncate();
		//$views->delete();
	}
}
?>