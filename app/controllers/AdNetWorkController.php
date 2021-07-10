<?php
class AdNetworkController extends BaseController{
	public function index(){
		$websites=Website::all();
		return View::make('admin/adnetwork/index')->with('websites',$websites);
	}
}
?>