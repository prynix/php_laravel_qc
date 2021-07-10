<?php
class CCountController extends BaseController{
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
		$banners=Banner::where('status','=',1)->get();
		$amount=DB::table('banners')->count();
		$total_clicks=DB::table('banners')->sum(DB::raw('total_clicks'));
		$unique_click=DB::table('banners')->sum(DB::raw('unique_click'));
		return View::make('admin/ccount/index')->with('banners',$banners)->with('total_clicks',$total_clicks)->with('unique_click',$unique_click)->with('amount',$amount)->with('help',$this->__construct());
	}
	public function getCreate(){
		return View::make('admin/ccount/create')->with('help',$this->__construct());
	}
	public function getClickAt($starttime,$endtime){
		$banners=DB::table('clicks')->select('click_at')->whereBetween('click_at',array($starttime,$endtime))->get();
		
		//$banners=DB::table('clicks')->where('click_at','>=',"$starttime")->where('click_at','<=',"$endtime")->get();
		$unique_click=DB::table('clicks')->whereBetween('click_at',array($starttime,$endtime))->count();
		//$banners=Banner::select('*')->whereRaw("click_at between '".$starttime."' and '".$endtime."'")->get();
		//$banners=Banner::select('*')->where('click_at','>=',strtotime($starttime))->get();
		//echo $unique_click;
		//echo '<pre/>';
		//print_r($banners);
		//foreach($banners as $key=>$value){
			//print_r($value);
		//}
		foreach ($banners as $banner) { //print_r(explode(' ',$banner->click_at)[0]);
			//câu lệnh này chưa trả về đúng giá trị cần lấy
			$count_click=DB::table('clicks')->select(array(DB::raw("DISTINCT '".explode(' ',$banner->click_at)[0]."'"),"ip_address"))->where('click_at','LIKE',explode(' ',$banner->click_at)[0].'%')->count();
			//break;
			//$query="SELECT DISTINCT ".explode(' ',$banner->click_at)[0]." FROM clicks";

			print_r($count_click);
		}
		//return Response::json($count_click);

		//thong ke so luong click, view trong 1 ngay, n ngay
		//Mức cơ bản: so sánh click_at với ngày lựa chọn, đếm số lượng click có trong ngày đó -> hiển thị ntn???
		//Mức nâng cao: đếm theo 1 khoảng thời gian lựa chọn -> đã nghĩ ra được cách hiển thị nhưng khó lấy ra được dữ liệu
		
	}
	public function postUpdate($id){
		$rules=array(
			'url'=>'required',
			'title'=>'required'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/ccount-edit-'.$id)->withErrors($validator)->withInput(Input::except('url'));
		}else{
			//store
			$banner=Banner::find($id);
			$banner->url=Input::get('url');
			$banner->title=Input::get('title');
			$banner->save();
			return Redirect::to('admin/ccount');
		}
	}
	public function deleteClicks(){
		Clicks::truncate();
	}
    public function delete($id)
	{
		
	}
    
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function recycle_bin(){
        $banners = Banner::where('status','=',0)->get();
		return View::make('admin/ccount/recycle_bin')->with('banners',$banners)->with('help',$this->__construct());
    }
    public function revert($id)
	{
        Language::where('id','=',$id)->update(
							array(
								'status'=>1
							)
						);
        $language=Language::where('id','=',$id)->get(); 
        $userlog=new Userlog;
        $userlog->account_id=Auth::user()->default_account_id;
        $userlog->userid=Auth::user()->id;
        $userlog->username=Auth::user()->username;
        $userlog->action="reverted";
        $userlog->context="Language";
        $userlog->contextid=$language->lists('id')[0];
        $userlog->object=$language->lists('language_name')[0];
        $userlog->details=Auth::user()->username.' reverted Language "'.$language->lists('language_name')[0].'" (#'.$language->lists('id')[0].')';
        $userlog->save();
        Session::flash('message','Successfully reverted the language!');
        return Redirect::to('admin/language');
	}
    
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id        	
	 * @return Response
	 */
    public function destroy($id)
	{
        
    }
}
?>