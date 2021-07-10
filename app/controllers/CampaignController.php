<?php

class CampaignController extends \BaseController {

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
	public function getCampaignLongerTerm(){
		$longer_term=Campaign::where('expire','>=',date('Y-m-d'))->count();
		$expired=Campaign::where('expire','!=','')->where('expire','<',date('Y-m-d'))->count();
		$dont_expire=Campaign::where('expire','=','')->count();
		$first_record=Campaign::where('expire','>=',date('Y-m-d'))->where('status','=',1)->orderBy('order_no','ASC')->first();
		$last_record=Campaign::where('expire','>=',date('Y-m-d'))->where('status','=',1)->orderBy('order_no','DESC')->first();
        $advertiser=Advertiser::where('id','=',0)->first(); 
        $advertisers=Advertiser::all();
		$campaigns=Campaign::where('expire','>=',date('Y-m-d'))->where('status','=',1)->get();
		return View::make('admin/campaign/index')->with('longer_term',$longer_term)->with('expired',$expired)->with('dont_expire',$dont_expire)->with('first_record',$first_record)->with('last_record',$last_record)->with('campaigns',$campaigns)->with('advertiser',$advertiser)->with('advertisers',$advertisers)->with('help',$this->__construct());	
	}
	public function getCampaignExpired(){
		$longer_term=Campaign::where('expire','>=',date('Y-m-d'))->count();
		$expired=Campaign::where('expire','!=','')->where('expire','<',date('Y-m-d'))->count();
		$dont_expire=Campaign::where('expire','=','')->count();
		$first_record=Campaign::where('expire','!=','')->where('expire','<',date('Y-m-d'))->where('status','=',1)->orderBy('order_no','ASC')->first();
		$last_record=Campaign::where('expire','!=','')->where('expire','<',date('Y-m-d'))->where('status','=',1)->orderBy('order_no','DESC')->first();
        $advertiser=Advertiser::where('id','=',0)->first(); 
        $advertisers=Advertiser::all();
		$campaigns=Campaign::where('expire','!=','')->where('expire','<',date('Y-m-d'))->where('status','=',1)->get();
		return View::make('admin/campaign/index')->with('longer_term',$longer_term)->with('expired',$expired)->with('dont_expire',$dont_expire)->with('first_record',$first_record)->with('last_record',$last_record)->with('campaigns',$campaigns)->with('advertiser',$advertiser)->with('advertisers',$advertisers)->with('help',$this->__construct());	
	}
	public function getCampaignDontExpire(){
		$longer_term=Campaign::where('expire','>=',date('Y-m-d'))->count();
		$expired=Campaign::where('expire','!=','')->where('expire','<',date('Y-m-d'))->count();
		$dont_expire=Campaign::where('expire','=','')->count();
		$first_record=Campaign::where('expire','=','')->where('status','=',1)->orderBy('order_no','ASC')->first();
		$last_record=Campaign::where('expire','=','')->where('status','=',1)->orderBy('order_no','DESC')->first();
        $advertiser=Advertiser::where('id','=',0)->first(); 
        $advertisers=Advertiser::all();
		$campaigns=Campaign::where('expire','=','')->where('status','=',1)->get();
		return View::make('admin/campaign/index')->with('longer_term',$longer_term)->with('expired',$expired)->with('dont_expire',$dont_expire)->with('first_record',$first_record)->with('last_record',$last_record)->with('campaigns',$campaigns)->with('advertiser',$advertiser)->with('advertisers',$advertisers)->with('help',$this->__construct());	
	}
	public function getList()
	{
		$longer_term=Campaign::where('expire','>=',date('Y-m-d'))->count();
		$expired=Campaign::where('expire','!=','')->where('expire','<',date('Y-m-d'))->count();
		$dont_expire=Campaign::where('expire','=','')->count();
		$first_record=Campaign::where('status','=',1)->orderBy('order_no','ASC')->first();
		$last_record=Campaign::where('status','=',1)->orderBy('order_no','DESC')->first();
        $advertiser=Advertiser::where('id','=',0)->first(); 
        $advertisers=Advertiser::where('status','=',1)->get();
		$campaigns=Campaign::where('status','=',1)->get();
		return View::make('admin/campaign/index')->with('longer_term',$longer_term)->with('expired',$expired)->with('dont_expire',$dont_expire)->with('first_record',$first_record)->with('last_record',$last_record)->with('campaigns',$campaigns)->with('advertiser',$advertiser)->with('advertisers',$advertisers)->with('help',$this->__construct());
	}
	public function getListCampaignOfAdvertiser(){
		//return Auth::user()->clientid;
		$first_record=Campaign::orderBy('order_no','ASC')->first();
		$last_record=Campaign::orderBy('order_no','DESC')->first();
        $advertiser=Advertiser::where('id','=',Auth::user()->clientid)->where('id','=',0)->first(); 
        $advertisers=Advertiser::where('id','=',Auth::user()->clientid)->get();
		$campaigns=Campaign::where('clientid','=',Auth::user()->clientid)->where('status','=',1)->get();
		return View::make('advertiser/campaign/index')->with('first_record',$first_record)->with('last_record',$last_record)->with('campaigns',$campaigns)->with('advertiser',$advertiser)->with('advertisers',$advertisers)->with('help',$this->__construct());
	}
    public function getClientOfCampaign($id){ 
        $campaign=Campaign::where('id','=',$id)->get();
        return $campaign->lists('clientid')[0];
    }
 //    public function getListOfClient($id)
	// {
 //        $advertiser=Advertiser::where('id','=',$id)->first();
 //        $advertisers=Advertiser::all();
	// 	$campaigns=Campaign::where('clientid','=',$id)->where('status','=',1)->get();
	// 	return View::make('admin/campaign/index')->with('campaigns',$campaigns)->with('advertiser',$advertiser)->with('advertisers',$advertisers);
	// }
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate($id)
	{
		$advertisers=Advertiser::all();
        $advertiser=Advertiser::where('id','=',$id)->first();
		return View::make('admin/campaign/create')->with('advertiser',$advertiser)->with('advertisers',$advertisers)->with('help',$this->__construct());
	}

	public function postCopy($id)
	{
		$rules=array(
			'campaignname'=>'required',
			'revenue_type'=>'required'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/campaign-create')->withErrors($validator);
		}else{
			$campaign=new Campaign;
			$campaign->clientid=Input::get('clientid');
			$campaign->campaignname=Input::get('campaignname');
			$campaign->campaign_type=Input::get('campaign_type');
			$campaign->active=Input::get('active');
			$campaign->expire=Input::get('expire');
			$campaign->revenue_type=Input::get('revenue_type');
			$campaign->revenue=Input::get('revenue');
			$campaign->clicks=Input::get('clicks');
			$campaign->priority=Input::get('priority');
			//$campaign->target_type=Input::get('target_type');
			$campaign->target_click=Input::get('target_click');
			$campaign->capping=Input::get('capping');
			$campaign->session_capping=Input::get('session_capping');
			$campaign->comments=Input::get('comments');
			$last_record=Campaign::orderBy('order_no','DESC')->get(); 
			if(count($last_record)>0){
				$number=$last_record->lists('order_no')[0]+1;
			}else{
				$number=1;
			} 
			$campaign->order_no=$number;
			$campaign->status=1;
			$campaign->save();
            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="inserted";
            $userlog->context="Campaign";
            $userlog->contextid=$campaign->id;
            $userlog->object=$campaign->campaignname;
            $userlog->details=Auth::user()->username.' inserted Campaign "'.$campaign->campaignname.'" (#'.$campaign->id.')';
            $userlog->save();
            Session::flash('success','Successfully copied the campaign!');
			return Redirect::to('admin/campaign');
		}
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore($id)
	{
		$rules=array(
			'campaignname'=>'required',
			'revenue_type'=>'required'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/campaign-create')->withErrors($validator);
		}else{
			$campaign=new Campaign;
			//$campaign->clientid=Input::get('clientid');
			$campaign->clientid=$id;
			$campaign->campaignname=Input::get('campaignname');
			$campaign->campaign_type=Input::get('campaign_type');
			$campaign->active=Input::get('active');
			$campaign->expire=Input::get('expire');
			$campaign->revenue_type=Input::get('revenue_type');
			$campaign->revenue=Input::get('revenue');
			$campaign->clicks=Input::get('clicks');
			$campaign->priority=Input::get('priority');
			//$campaign->target_type=Input::get('target_type');
			$campaign->target_click=Input::get('target_click');
			$campaign->capping=Input::get('capping');
			$campaign->session_capping=Input::get('session_capping');
			$campaign->comments=Input::get('comments');
			$last_record=Campaign::orderBy('order_no','DESC')->get(); 
			if(count($last_record)>0){
				$number=$last_record->lists('order_no')[0]+1;
			}else{
				$number=1;
			} 
			$campaign->order_no=$number;
			$campaign->status=1;
			$campaign->save();
            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="inserted";
            $userlog->context="Campaign";
            $userlog->contextid=$campaign->id;
            $userlog->object=$campaign->campaignname;
            $userlog->details=Auth::user()->username.' inserted Campaign "'.$campaign->campaignname.'" (#'.$campaign->id.')';
            $userlog->save();
            Session::flash('success','Successfully created the campaign!');
			return Redirect::to('admin/campaign');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdate($id)
	{
		$rules=array(
			'campaignname'=>'required',
			'revenue_type'=>'required'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/campaign-edit-'.$id)->withErrors($validator);
		}else{
			$campaign=Campaign::find($id);
			$campaign->clientid=Input::get('clientid');
			$campaign->campaignname=Input::get('campaignname');
			$campaign->campaign_type=Input::get('campaign_type');
			$campaign->active=Input::get('active');
			$campaign->expire=Input::get('expire');
			$campaign->revenue_type=Input::get('revenue_type');
			$campaign->revenue=Input::get('revenue');
			$campaign->clicks=Input::get('clicks');
			$campaign->priority=Input::get('priority');
			//$campaign->target_type=Input::get('target_type');
			$campaign->target_click=Input::get('target_click');
			$campaign->capping=Input::get('capping');
			$campaign->session_capping=Input::get('session_capping');
			$campaign->comments=Input::get('comments');
			$campaign->status=1;
			$campaign->save();
            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="updated";
            $userlog->context="Campaign";
            $userlog->contextid=$campaign->id;
            $userlog->object=$campaign->campaignname;
            $userlog->details=Auth::user()->username.' updated Campaign "'.$campaign->campaignname.'" (#'.$campaign->id.')';
            $userlog->save();
            Session::flash('success','Successfully updated the campaign!');
			return Redirect::to('admin/campaign');
		}
	}

    public function delete($id)
	{
		Campaign::where('id','=',$id)->update(
							array(
								'status'=>0
							)
						);
        $campaign=Campaign::where('id','=',$id)->get(); 
        $userlog=new Userlog;
        $userlog->account_id=Auth::user()->default_account_id;
        $userlog->userid=Auth::user()->id;
        $userlog->username=Auth::user()->username;
        $userlog->action="deleted";
        $userlog->context="Campaign";
        $userlog->contextid=$campaign->lists('id')[0];
        $userlog->object=$campaign->lists('campaignname')[0];
        $userlog->details=Auth::user()->username.' deleted Campaign "'.$campaign->lists('campaignname')[0].'" (#'.$campaign->lists('id')[0].')';
        $userlog->save();
        Session::flash('warning','Successfully deleted the campaign!');
        return Redirect::to('admin/campaign');
	}
    
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function recycle_bin(){
        $campaigns=Campaign::where('status','=',0)->get();
		return View::make('admin/campaign/recycle_bin')->with('campaigns',$campaigns)->with('help',$this->__construct());
    }
    public function revert($id)
	{
        Campaign::where('id','=',$id)->update(
							array(
								'status'=>1
							)
						);
        $campaign=Campaign::where('id','=',$id)->get(); 
        $userlog=new Userlog;
        $userlog->account_id=Auth::user()->default_account_id;
        $userlog->userid=Auth::user()->id;
        $userlog->username=Auth::user()->username;
        $userlog->action="reverted";
        $userlog->context="Campaign";
        $userlog->contextid=$campaign->lists('id')[0];
        $userlog->object=$campaign->lists('campaignname')[0];
        $userlog->details=Auth::user()->username.' reverted Campaign "'.$campaign->lists('campaignname')[0].'" (#'.$campaign->lists('id')[0].')';
        $userlog->save();
        Session::flash('success','Successfully restored the campaign!');
        return Redirect::to('admin/campaign');
	}
    public function destroy($id)
	{
        $campaign=Campaign::find($id);
        $campaign->delete();
        Session::flash('danger','Successfully destroyed the campaign!');
        return Redirect::to('admin/campaign-recycle');
    }
	public function getShowAdmin($id){
		$advertisers=Advertiser::all();
	$campaign=Campaign::find($id);
	return View::make('admin/campaign/show')->with('campaign',$campaign)->with('advertisers',$advertisers)->with('help',$this->__construct());
	}
	public function getShowAdvertiser($id){
		$advertisers=Advertiser::all();
	$campaign=Campaign::find($id);
	return View::make('advertiser/campaign/show')->with('campaign',$campaign)->with('advertisers',$advertisers)->with('help',$this->__construct());	
	}
	public function getCopy($id){
		$advertisers=Advertiser::all();
	$campaign=Campaign::find($id);
	return View::make('admin/campaign/copy')->with('campaign',$campaign)->with('advertisers',$advertisers)->with('help',$this->__construct());	
	}
	public function getEdit($id){
		$advertisers=Advertiser::all();
	$campaign=Campaign::find($id);
	return View::make('admin/campaign/edit')->with('campaign',$campaign)->with('advertisers',$advertisers)->with('help',$this->__construct());	
	}
}
