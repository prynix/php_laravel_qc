<?php
class WebsiteController extends \BaseController {
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
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
	public function getList() { 
		$campaigns=Campaign::all();
		$first_record=Website::orderBy('order_no','ASC')->get(); 
		$last_record=Website::orderBy('order_no','DESC')->get();
		$websites = DB::table('websites')->where('status','=',1)->orderBy('name','asc')->get();
		return View::make ( 'admin/website/list' )->with ( 'campaigns', $campaigns )->with ( 'first_record', $first_record )->with ( 'last_record', $last_record )->with ( 'websites', $websites )->with('help',$this->__construct());
	}
	public function getWebsiteOfCampaign($campaignid){
		$campaigns=Campaign::all();
		$first_record=Website::orderBy('order_no','ASC')->get();
		$last_record=Website::orderBy('order_no','DESC')->get();
		$websites = DB::table('websites')->where('campaignid','=',$campaignid)->where('status','=',1)->orderBy('name','asc')->get();
		return View::make ( 'admin/website/list' )->with ( 'campaigns', $campaigns )->with ( 'first_record', $first_record )->with ( 'last_record', $last_record )->with ( 'websites', $websites )->with('help',$this->__construct());
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate($campaignid) {
		$users=User::all();
		$campaign=Campaign::where('id','=',$campaignid)->get();
		$categories = Category::tree ();
		$countries = Country::all ();
		$languages = Language::all ();
		return View::make ( 'admin/website/create' )->with('users',$users)->with ( 'campaign', $campaign )->with ( 'categories', $categories )->with ( 'countries', $countries )->with ( 'languages', $languages )->with('help',$this->__construct());
	}
	public function postCopy($id) {
		// validate
		$rules = array (
				'website' => 'required',
				'name' => 'required',
				'contact' => 'required',
				'email' => 'required|email' 
		);
		$validator = Validator::make ( Input::all (), $rules );
		if ($validator->fails ()) {
			return Redirect::to ( 'admin/website-create' )->withErrors ( $validator )->withInput ( Input::except ( 'website' ) );
		} else {
			$website = new Website ();
			$website->campaignid=Input::get ( 'campaignid');
			$website->website = Input::get ( 'website' );
			$website->name = Input::get ( 'name' );
			$website->contact = Input::get ( 'contact' );
			$website->email = Input::get ( 'email' );
			$website->category = Input::get ( 'category' ); 
			//$website->icp=Input::get('icp_status')."_".Input::get('icp_name');
			// $website->webpage=Input::get('webpage');
			$website->country = Input::get ( 'country' );
			$website->language = Input::get ( 'language' );
			$last_record=Website::orderBy('order_no','DESC')->get(); 
			if(count($last_record)>0){
				$number=$last_record->lists('order_no')[0]+1;
			}else{
				$number=1;
			} 
			$website->order_no=$number;
			$website->status=1;
			$website->save();
            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="inserted";
            $userlog->context="Website";
            $userlog->contextid=$website->id;
            $userlog->object=$website->website;
            $userlog->details=Auth::user()->username.' inserted Website "'.$website->website.'" (#'.$website->id.')';
            $userlog->save();
            Session::flash('success','Successfully copied the website!');
			return Redirect::to ( 'admin/website' );
		}
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore($campaignid) {
		// validate
		$rules = array (
				'website' => 'required',
				'name' => 'required',
				'contact' => 'required',
				'email' => 'required|email' 
		);
		$validator = Validator::make ( Input::all (), $rules );
		if ($validator->fails ()) {
			return Redirect::to ( 'admin/website-create' )->withErrors ( $validator )->withInput ( Input::except ( 'website' ) );
		} else {
			$website = new Website ();
			$website->campaignid=$campaignid;
			$website->website = Input::get ( 'website' );
			$website->name = Input::get ( 'name' );
			$website->contact = Input::get ( 'contact' );
			$website->email = Input::get ( 'email' );
			$website->category = Input::get ( 'category' ); 
			//$website->icp=Input::get('icp_status')."_".Input::get('icp_name');
			// $website->webpage=Input::get('webpage');
			$website->country = Input::get ( 'country' );
			$website->language = Input::get ( 'language' );
			$last_record=Website::orderBy('order_no','DESC')->get(); 
			if(count($last_record)>0){
				$number=$last_record->lists('order_no')[0]+1;
			}else{
				$number=1;
			} 
			$website->order_no=$number;
			$website->status=1;
			$website->save();
            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="inserted";
            $userlog->context="Website";
            $userlog->contextid=$website->id;
            $userlog->object=$website->website;
            $userlog->details=Auth::user()->username.' inserted Website "'.$website->website.'" (#'.$website->id.')';
            $userlog->save();
            Session::flash('success','Successfully created the website!');
			return Redirect::to ( 'admin/website' );
		}
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function show($id) {
		//
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function edit($id) {
		//
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function postUpdate($id) {
		$rules = array (
				'website' => 'required',
				'name' => 'required',
				'contact' => 'required',
				'email' => 'required|email' 
		);
		$validator = Validator::make ( Input::all (), $rules );
		if ($validator->fails ()) {
			return Redirect::to ( 'admin/website-edit-' . $id )->withErrors ( $validator )->withInput ( Input::except ( 'website' ) );
		} else {
			$website = Website::find ( $id );
			$website->campaignid=Input::get ( 'campaignid');
			$website->website = Input::get ( 'website' );
			$website->name = Input::get ( 'name' );
			$website->contact = Input::get ( 'contact' );
			$website->email = Input::get ( 'email' );
			$website->category = Input::get ( 'category' );
			//$website->icp=Input::get('icp_status')."_".Input::get('icp_name');
			// $website->webpage=Input::get('webpage');
			$website->country = Input::get ( 'country' );
			$website->language = Input::get ( 'language' );
			$website->save ();

            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="updated";
            $userlog->context="Website";
            $userlog->contextid=$website->id;
            $userlog->object=$website->website;
            $userlog->details=Auth::user()->username.' updated Website "'.$website->website.'" (#'.$website->id.')';
            $userlog->save();
            Session::flash('success','Successfully updated the website!');
			return Redirect::to ( 'admin/website' );
		}
	}
	
	public function getCodeAds($zoneid) { 
		header ( 'Access-Control-Allow-Origin: *' );
		header ( 'Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS' );
		header ( 'Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description' );
		
		$redis = Redis::connection();
		// if exist zone in redis
		$bannerData = array();
		$cacheKey = 'zone_'.$zoneid.':banners';
		if($redis->exists($cacheKey)) {
			$bannerData = $redis->get($cacheKey);
		} else {
			$bannerData = Banner::where ( 'zoneid', '=', $zoneid )->where('status','=',1)->get()->toJson();
			// update redis cache
			$redis = RedisHandler::setZoneData($zoneid);
		}

		return $bannerData;
	}
	public function displayAds($zoneid,$website_url,$timeout){ //echo $website_url; echo $zoneid; echo $timeout; die();
		return View::make('admin/zone/display_timeout')->with('zoneid',$zoneid)->with('website_url',$website_url)->with('timeout',$timeout);
	}
	public function displayQC($zoneid,$website_url){
		return View::make('admin/zone/display')->with('zoneid',$zoneid)->with('website_url',$website_url);
	}
    public function delete($id)
	{
		Website::where('id','=',$id)->update(
							array(
								'status'=>0
							)
						);
        $website=Website::where('id','=',$id)->get(); 
        $userlog=new Userlog;
        $userlog->account_id=Auth::user()->default_account_id;
        $userlog->userid=Auth::user()->id;
        $userlog->username=Auth::user()->username;
        $userlog->action="deleted";
        $userlog->context="Website";
        $userlog->contextid=$website->lists('id')[0];
        $userlog->object=$website->lists('website')[0];
        $userlog->details=Auth::user()->username.' deleted Website "'.$website->lists('website')[0].'" (#'.$website->lists('id')[0].')';
        $userlog->save();
        Session::flash('warning','Successfully deleted the website !');
        return Redirect::to('admin/website');
	}
    public function deleteTopic($website_id,$topic_id){
    	$topic=Topic::where('id','=',$topic_id);
    	$topic->delete();
    	$adbanners=AdBanner::where('topic_id','=',$topic_id);
    	$adbanners->delete();
    	return Redirect::to('admin/website-topic-'.$website_id);
    }
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function recycle_bin(){
        $websites=Website::where('status','=',0)->get();
		return View::make('admin/website/recycle_bin')->with('websites',$websites)->with('help',$this->__construct());
    }
    public function revert($id)
	{
        Website::where('id','=',$id)->update(
							array(
								'status'=>1
							)
						);
        $website=Website::where('id','=',$id)->get(); 
        $userlog=new Userlog;
        $userlog->account_id=Auth::user()->default_account_id;
        $userlog->userid=Auth::user()->id;
        $userlog->username=Auth::user()->username;
        $userlog->action="reverted";
        $userlog->context="Website";
        $userlog->contextid=$website->lists('id')[0];
        $userlog->object=$website->lists('website')[0];
        $userlog->details=Auth::user()->username.' reverted Website "'.$website->lists('website')[0].'" (#'.$website->lists('id')[0].')';
        $userlog->save();
        Session::flash('success','Successfully reverted the website!');
        return Redirect::to('admin/website');
	}
    
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id        	
	 * @return Response
	 */
    public function destroy($id)
	{
        $website=Website::find($id);
        $website->delete();
        Session::flash('danger','Successfully destroyed the website!');
        return Redirect::to('admin/website-recycle');
    }
	public function getShow($id){
        $campaigns=Campaign::all();
        $categories=Category::tree();
        $countries=Country::all();
        $languages=Language::all();
        $website=Website::find($id);
        return View::make('admin/website/show')->with('campaigns',$campaigns)->with('website',$website)->with('categories',$categories)->with('countries',$countries)->with('languages',$languages)->with('help',$this->__construct());
    }
    public function getCopy($id){
        $campaigns=Campaign::all();
        $categories=Category::tree();
        $countries=Country::all();
        $languages=Language::all();
        $website=Website::find($id);
        return View::make('admin/website/copy')->with('campaigns',$campaigns)->with('website',$website)->with('categories',$categories)->with('countries',$countries)->with('languages',$languages)->with('help',$this->__construct());
    }
    public function getEdit($id){
	$campaigns=Campaign::all();
	$categories=Category::tree();
	$countries=Country::all();
	$languages=Language::all();
	$website=Website::find($id); 
	return View::make('admin/website/edit')->with('campaigns',$campaigns)->with('website',$website)->with('categories',$categories)->with('countries',$countries)->with('languages',$languages);
    }
}
