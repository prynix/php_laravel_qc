<?php 
class OrderController extends BaseController{
	public function getOrder(){
		$advertisers=Advertiser::where('status','=',1)->get();
		return View::make('admin/order/index')->with('advertisers',$advertisers);	
	}
}
?>