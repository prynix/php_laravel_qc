<?php

class ZonetypeController extends \BaseController {
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
	public function index()
	{
		$zonetypes=Zonetype::where('status','=',1)->get();
		return View::make('admin/zonetype/index')->with('zonetypes',$zonetypes)->with('help',$this->__construct());
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('admin/zonetype/create')->with('help',$this->__construct());
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		$rules=array(
			'title'=>'required'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/zonetype-create')->withErrors($validator);
		}else{
			$zonetype=new Zonetype;
			$zonetype->title=Input::get('title');
			$zonetype->description=Input::get('description');
			$zonetype->save();
            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="inserted";
            $userlog->context="Zone Type";
            $userlog->contextid=$zonetype->id;
            $userlog->object=$zonetype->title;
            $userlog->details=Auth::user()->username.' inserted Zone Type "'.$zonetype->title.'" (#'.$zonetype->id.')';
            $userlog->save();
            Session::flash('success','Successfully created zone type!');
			return Redirect::to('admin/zonetype');
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
			'title'=>'required'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/zonetype-edit-'.$id)->withErrors($validator);
		}else{
			$zonetype=Zonetype::find($id);
			$zonetype->title=Input::get('title');
			$zonetype->description=Input::get('description');
			$zonetype->save();
            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="updated";
            $userlog->context="Zone Type";
            $userlog->contextid=$zonetype->id;
            $userlog->object=$zonetype->title;
            $userlog->details=Auth::user()->username.' updated Zone Type "'.$zonetype->title.'" (#'.$zonetype->id.')';
            $userlog->save();
            Session::flash('success','Successfully updated zone type!');
			return Redirect::to('admin/zonetype');
		}
	}


	public function delete($id)
	{
		Zonetype::where('id','=',$id)->update(
							array(
								'status'=>0
							)
						);
        $zonetype=Zonetype::where('id','=',$id)->get(); 
        $userlog=new Userlog;
        $userlog->account_id=Auth::user()->default_account_id;
        $userlog->userid=Auth::user()->id;
        $userlog->username=Auth::user()->username;
        $userlog->action="deleted";
        $userlog->context="Zone Type";
        $userlog->contextid=$zonetype->lists('id')[0];
        $userlog->object=$zonetype->lists('title')[0];
        $userlog->details=Auth::user()->username.' deleted Zone Type "'.$zonetype->lists('title')[0].'" (#'.$zonetype->lists('id')[0].')';
        $userlog->save();
        Session::flash('warning','Successfully deleted the zone type !');
        return Redirect::to('admin/zonetype');
	}
    
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function recycle_bin(){
        $zonetypes=Zonetype::where('status','=',0)->get();
		return View::make('admin/zonetype/recycle_bin')->with('zonetypes',$zonetypes)->with('help',$this->__construct());
    }
    public function revert($id)
	{
        Zonetype::where('id','=',$id)->update(
							array(
								'status'=>1
							)
						);
        $zonetype=Zonetype::where('id','=',$id)->get(); 
        $userlog=new Userlog;
        $userlog->account_id=Auth::user()->default_account_id;
        $userlog->userid=Auth::user()->id;
        $userlog->username=Auth::user()->username;
        $userlog->action="reverted";
        $userlog->context="Zone Type";
        $userlog->contextid=$zonetype->lists('id')[0];
        $userlog->object=$zonetype->lists('title')[0];
        $userlog->details=Auth::user()->username.' reverted Zone Type "'.$zonetype->lists('title')[0].'" (#'.$zonetype->lists('id')[0].')';
        $userlog->save();
        Session::flash('success','Successfully reverted the zone type!');
        return Redirect::to('admin/zonetype');
	}
    
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id        	
	 * @return Response
	 */
    public function destroy($id)
	{
        $zonetypes=Zonetype::find($id);
        $zonetypes->delete();
        Session::flash('danger','Successfully destroyed the zone type!');
        return Redirect::to('admin/zonetype-recycle');
    }

	public function getShow($id){
		$zonetype=Zonetype::find($id);
		return View::make('admin/zonetype/show')->with('zonetype',$zonetype)->with('help',$this->__construct());
	}
	
	public function getCopy($id){
		$zonetype=Zonetype::find($id);
		return View::make('admin/zonetype/copy')->with('zonetype',$zonetype)->with('help',$this->__construct());
	}
	
	public function getEdit($id){
		$zonetype=Zonetype::find($id);
		return View::make('admin/zonetype/edit')->with('zonetype',$zonetype)->with('help',$this->__construct());
	}
	
}
