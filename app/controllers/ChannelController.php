<?php

class ChannelController extends \BaseController {
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
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getList()
	{  
		$first_record=Channel::where('status','=',1)->orderBy('order_no','ASC')->first();
		$last_record=Channel::where('status','=',1)->orderBy('order_no','DESC')->first();
	    $website=Website::where('id','=',0)->first();
        $websites=Website::all();
		$channels=Channel::where('status','=',1)->get();
		return View::make('admin/channel/index')->with('first_record',$first_record)->with('last_record',$last_record)->with('website',$website)->with('websites',$websites)->with('channels',$channels)->with('help',$this->__construct());
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate($id)
	{
		$website=Website::where('id','=',$id)->first();
		$websites=Website::all();
		return View::make('admin/channel/create')->with('website',$website)->with('websites',$websites)->with('help',$this->__construct());
	}

	public function postCopy($id)
	{
		//validate
		$rules=array(
			'name'=>'required'//,
			//'description'=>'required',
			//'comments'=>'required'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/channel-create')->withErrors($validator);
		}else{
			$channel=new Channel;
			$channel->website_id=Input::get('website_id');
			$channel->name=Input::get('name');
			$channel->description=Input::get('description');
			$channel->active=1;
			$channel->comments=Input::get('comments');
			$last_record=Channel::orderBy('order_no','DESC'); 
			if($last_record->count()>0){
				$number=$last_record->lists('order_no')[0]+1;
			}else{
				$number=1;
			} 
			$channel->order_no=$number;
			$channel->save();
            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="inserted";
            $userlog->context="Channel";
            $userlog->contextid=$channel->id;
            $userlog->object=$channel->name;
            $userlog->details=Auth::user()->username.' inserted Channel "'.$channel->name.'" (#'.$channel->id.')';
            $userlog->save();
            Session::flash('success','Successfully copied the channel!');
			return Redirect::to('admin/channel');
		}
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore($id)
	{
		//validate
		$rules=array(
			'name'=>'required'//,
			//'description'=>'required',
			//'comments'=>'required'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/channel-create')->withErrors($validator);
		}else{
			$channel=new Channel;
			$channel->website_id=$id;
			$channel->name=Input::get('name');
			$channel->description=Input::get('description');
			$channel->active=1;
			$channel->comments=Input::get('comments');
			$last_record=Channel::orderBy('order_no','DESC')->get(); 
			if($last_record){
				$number=$last_record->lists('order_no')[0]+1;
			}else{
				$number=1;
			} 
			$channel->order_no=$number;
			$channel->save();
            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="inserted";
            $userlog->context="Channel";
            $userlog->contextid=$channel->id;
            $userlog->object=$channel->name;
            $userlog->details=Auth::user()->username.' inserted Channel "'.$channel->name.'" (#'.$channel->id.')';
            $userlog->save();
            Session::flash('success','Successfully created the channel!');
			return Redirect::to('admin/channel');
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
		//validate
		$rules=array(
			'name'=>'required'//,
			//'description'=>'required',
			//'comments'=>'required'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/channel-edit-'.$id)->withErrors($validator);
		}else{
			$channel=Channel::find($id);
			$channel->website_id=Input::get('website_id');
			$channel->name=Input::get('name');
			$channel->description=Input::get('description');
			$channel->active=1;
			$channel->comments=Input::get('comments');
			$channel->save();
            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="updated";
            $userlog->context="Channel";
            $userlog->contextid=$channel->id;
            $userlog->object=$channel->name;
            $userlog->details=Auth::user()->username.' updated Channel "'.$channel->name.'" (#'.$channel->id.')';
            $userlog->save();
            Session::flash('success','Successfully updated the channel!');
			return Redirect::to('admin/channel');
		}
	}


	public function delete($id)
	{
		Channel::where('id','=',$id)->update(
							array(
								'status'=>0
							)
						);
        $channel=Channel::where('id','=',$id)->get(); 
        $userlog=new Userlog;
        $userlog->account_id=Auth::user()->default_account_id;
        $userlog->userid=Auth::user()->id;
        $userlog->username=Auth::user()->username;
        $userlog->action="deleted";
        $userlog->context="Channel";
        $userlog->contextid=$channel->lists('id')[0]; 
        $userlog->object=$channel->lists('name')[0];
        $userlog->details=Auth::user()->username.' deleted Channel "'.$channel->lists('name')[0].'" (#'.$channel->lists('id')[0].')';
        $userlog->save();
        Session::flash('warning','Successfully deleted the channel !');
        return Redirect::to('admin/channel');
	}
    
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function recycle_bin(){
        $channels=Channel::where('status','=',0)->get();
		return View::make('admin/channel/recycle_bin')->with('channels',$channels)->with('help',$this->__construct());
    }
    public function revert($id)
	{
        Channel::where('id','=',$id)->update(
							array(
								'status'=>1
							)
						);
        $channel=Channel::where('id','=',$id)->get(); 
        $userlog=new Userlog;
        $userlog->account_id=Auth::user()->default_account_id;
        $userlog->userid=Auth::user()->id;
        $userlog->username=Auth::user()->username;
        $userlog->action="reverted";
        $userlog->context="Channel";
        $userlog->contextid=$channel->lists('id')[0];
        $userlog->object=$channel->lists('name')[0];
        $userlog->details=Auth::user()->username.' reverted Channel "'.$channel->lists('name')[0].'" (#'.$channel->lists('id')[0].')';
        $userlog->save();
        Session::flash('success','Successfully reverted the channel!');
        return Redirect::to('admin/channel');
	}
    
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id        	
	 * @return Response
	 */
    public function destroy($id)
	{
        $channel=Channel::find($id);
        $channel->delete();
        Session::flash('danger','Successfully destroyed the channel!');
        return Redirect::to('admin/channel-recycle');
    }

	public function getShow($id){
		$websites=Website::all();
		$channel=Channel::find($id);
		return View::make('admin/channel/show')->with('channel',$channel)->with('websites',$websites)->with('help',$this->__construct());
	}
	
	public function getCopy($id){
		$websites=Website::all();
		$channel=Channel::find($id);
		return View::make('admin/channel/copy')->with('channel',$channel)->with('websites',$websites)->with('help',$this->__construct());
	}
	
	public function getEdit($id){
		$websites=Website::all();
		$channel=Channel::find($id);
		return View::make('admin/channel/edit')->with('channel',$channel)->with('websites',$websites)->with('help',$this->__construct());	
	}
}
