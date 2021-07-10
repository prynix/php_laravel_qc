<?php

class AdtypeController extends \BaseController {
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
		$first_record=Adtype::orderBy('order_no','ASC')->first();
		$last_record=Adtype::orderBy('order_no','DESC')->first();
		$zonetypes=Zonetype::all();
		$adtypes=Adtype::where('status','=',1)->get();
		return View::make('admin/adtype/index')->with('first_record',$first_record)->with('last_record',$last_record)->with('adtypes',$adtypes)->with('zonetypes',$zonetypes)->with('help',$this->__construct());
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		$zonetypes=Zonetype::all();
		//load the create form (app/views/admin/adtype/create.blade.php)
		return View::make('admin/adtype/create')->with('zonetypes',$zonetypes)->with('help',$this->__construct());
		// echo 'snvjkds';
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		//validate 
		//read more on validation at http://laravel.com/docs/validation
		$rules=array(
			'title'=>'required',
			'width'=>'required|numeric',
			'height'=>'required|numeric'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/adtype-create')->withErrors($validator)->withInput(Input::except('title'));
		}else{
			//store
			// echo 'xin chao';
			// exit();
			$adtype= new Adtype;
			$adtype->zonetype_id=1;
			$adtype->title=Input::get('title');
			$adtype->preview='default.png';
			$adtype->width=Input::get('width');
			$adtype->height=Input::get('height');
			$last_record=Adtype::orderBy('order_no','DESC'); 
			if($last_record->count()>0){
				$number=$last_record->lists('order_no')[0]+1;
			}else{
				$number=1;
			} 
			$adtype->order_no=$number;
			$adtype->status=1;
			$adtype->save();
            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="inserted";
            $userlog->context="Ad Type";
            $userlog->contextid=$adtype->id;
            $userlog->object=$adtype->title;
            $userlog->details=Auth::user()->username.' inserted Ad Type "'.$adtype->title.'" (#'.$adtype->id.')';
            $userlog->save();
			//redirect
			Session::flash('success','Successfully created ad type!');
			return Redirect::to('admin/adtype');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		$zonetypes=Zonetype::all();
		$adtype=Adtype::find($id);
		//show the view and pass the adtype to it
		return View::make('admin/adtype/show')->with('adtype',$adtype)->with('zonetypes',$zonetypes)->with('help',$this->__construct());
	}

	public function getCopy($id)
	{
		$zonetypes=Zonetype::all();
		$adtype=Adtype::find($id);
		return View::make('admin/adtype/copy')->with('adtype',$adtype)->with('zonetypes',$zonetypes)->with('help',$this->__construct());
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$zonetypes=Zonetype::all();
		$adtype=Adtype::find($id);
		return View::make('admin/adtype/edit')->with('adtype',$adtype)->with('zonetypes',$zonetypes)->with('help',$this->__construct());
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
		//read more on validation at http://laravel.com/docs/validation
		$rules=array(
			'title'=>'required',
			'width'=>'required|numeric',
			'height'=>'required|numeric'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/adtype-edit-'.$id)->withErrors($validator)->withInput(Input::except('title'));
		}else{
			//store
			// echo 'xin chao';
			// exit();
			$adtype= Adtype::find($id);
			$adtype->zonetype_id=1;
			$adtype->title=Input::get('title');
			$adtype->preview='default.png';
			$adtype->width=Input::get('width');
			$adtype->height=Input::get('height');
			$adtype->save();
            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="updated";
            $userlog->context="Ad Type";
            $userlog->contextid=$adtype->id;
            $userlog->object=$adtype->title;
            $userlog->details=Auth::user()->username.' updated Ad Type "'.$adtype->title.'" (#'.$adtype->id.')';
            $userlog->save();
			Session::flash('success','Successfully updated ad type!');
			return Redirect::to('admin/adtype');
		}
	}


	public function delete($id)
	{
		Adtype::where('id','=',$id)->update(
							array(
								'status'=>0
							)
						);
        $adtype=Adtype::where('id','=',$id)->get(); 
        $userlog=new Userlog;
        $userlog->account_id=Auth::user()->default_account_id;
        $userlog->userid=Auth::user()->id;
        $userlog->username=Auth::user()->username;
        $userlog->action="deleted";
        $userlog->context="Ad Type";
        $userlog->contextid=$adtype->lists('id')[0];
        $userlog->object=$adtype->lists('title')[0];
        $userlog->details=Auth::user()->username.' deleted Ad Type "'.$adtype->lists('title')[0].'" (#'.$adtype->lists('id')[0].')';
        $userlog->save();
        Session::flash('warning','Successfully deleted the advertisement type !');
        return Redirect::to('admin/adtype');
	}
    
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function recycle_bin(){
        $zonetypes=Zonetype::all();
        $adtypes=Adtype::where('status','=',0)->get();
		return View::make('admin/adtype/recycle_bin')->with('adtypes',$adtypes)->with('zonetypes',$zonetypes)->with('help',$this->__construct());
    }
    public function revert($id)
	{
        Adtype::where('id','=',$id)->update(
							array(
								'status'=>1
							)
						);
        $adtype=Adtype::where('id','=',$id)->get(); 
        $userlog=new Userlog;
        $userlog->account_id=Auth::user()->default_account_id;
        $userlog->userid=Auth::user()->id;
        $userlog->username=Auth::user()->username;
        $userlog->action="reverted";
        $userlog->context="Ad Type";
        $userlog->contextid=$adtype->lists('id')[0];
        $userlog->object=$adtype->lists('title')[0];
        $userlog->details=Auth::user()->username.' reverted Ad Type "'.$adtype->lists('title')[0].'" (#'.$adtype->lists('id')[0].')';
        $userlog->save();
        Session::flash('success','Successfully reverted the advertisement type!');
        return Redirect::to('admin/adtype');
	}
    
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id        	
	 * @return Response
	 */
    public function destroy($id)
	{
        $adtypes=Adtype::find($id);
        $adtypes->delete();
        Session::flash('danger','Successfully destroyed the advertisement type!');
        return Redirect::to('admin/adtype-recycle');
    }

	
}
