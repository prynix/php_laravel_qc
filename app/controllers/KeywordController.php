<?php
class KeywordController extends Controller{
	public function getList(){
		$zones=Zone::where('status','=',1)->get();
		$banners=Banner::where('status','=',1)->get();
		return View::make('admin/keyword/index')->with('banners',$banners)->with('zones',$zones);
	}
}
?>