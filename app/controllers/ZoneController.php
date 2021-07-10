<?php
class ZoneController extends BaseController{
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
        $website=Website::where('id','=',0)->first();
        $websites=Website::all();
		$adtypes=Adtype::all();
		$zones=Zone::where('status','=',1)->get();
        $first_record=Zone::where('status','=',1)->orderBy('order_no','ASC')->first();
		$last_record=Zone::where('status','=',1)->orderBy('order_no','DESC')->first();
		return View::make('admin/zone/index')->with('website',$website)->with('websites',$websites)->with('zones',$zones)->with('adtypes',$adtypes)->with('first_record',$first_record)->with('last_record',$last_record)->with('help',$this->__construct());
	}
	public function getCreate($website_id){
		$categories=Category::tree();
		$zonetypes=Zonetype::all();
		$adtypes=Adtype::all();
        $website=Website::where('id','=',$website_id)->first();
		$websites=Website::all();
		return View::make('admin/zone/create')->with('categories',$categories)->with('zonetypes',$zonetypes)->with('adtypes',$adtypes)->with('website',$website)->with('websites',$websites)->with('help',$this->__construct());
	}
	public function postCopy($website_id){
		//validate
		$rules=array(
			'zonename'=>'required',
            'zonetype'=>'required',
            'width'=>'required|numeric',
            'height'=>'required|numeric'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/zone-create')->withErrors($validator);
		}else{
			$zone=new Zone;
			$zone->website_id=Input::get('website_id');
			$zone->zonename=Input::get('zonename');
			$zone->description=Input::get('description');
			$zone->category=Input::get('category');
			$zone->zonetype=Input::get('zonetype');
			$zone->ad_selection=Input::get('ad_selection');
			$zone->width=Input::get('width');
			$zone->height=Input::get('height');
			$zone->pricing=Input::get('pricing');
			$zone->comments=Input::get('comments');
			$zone->status=1;
			$last_record=Zone::orderBy('order_no','DESC')->get();
			if(count($last_record)>0){
				$number=$last_record->lists('order_no')[0]+1;
			}else{
				$number=1;
			} 
			$zone->order_no=$number;
			$zone->save();
            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="inserted";
            $userlog->context="Zone";
            $userlog->contextid=$zone->id;
            $userlog->object=$zone->zonename;
            $userlog->details=Auth::user()->username.' inserted Zone "'.$zone->zonename.'" (#'.$zone->id.')';
            $userlog->save();
			Session::flash('success','Successfully copied the zone!');
			return Redirect::to('admin/zone');
		}
	}
	public function postStore($website_id){
		//validate
		$rules=array(
			'zonename'=>'required',
            'zonetype'=>'required',
            'width'=>'required|numeric',
            'height'=>'required|numeric'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/zone-create')->withErrors($validator);
		}else{
			$zone=new Zone;
			//$zone->website_id=Input::get('website_id');
			$zone->website_id=$website_id;
			$zone->zonename=Input::get('zonename');
			$zone->description=Input::get('description');
			$zone->category=Input::get('category');
			$zone->zonetype=Input::get('zonetype');
			$zone->ad_selection=Input::get('ad_selection');
			$zone->width=Input::get('width');
			$zone->height=Input::get('height');
			$zone->pricing=Input::get('pricing');
			$zone->comments=Input::get('comments');
			$zone->status=1;
			$last_record=Zone::orderBy('order_no','DESC')->get();
			if(count($last_record)>0){
				$number=$last_record->lists('order_no')[0]+1;
			}else{
				$number=1;
			} 
			$zone->order_no=$number;
			$zone->save();
            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="inserted";
            $userlog->context="Zone";
            $userlog->contextid=$zone->id;
            $userlog->object=$zone->zonename;
            $userlog->details=Auth::user()->username.' inserted Zone "'.$zone->zonename.'" (#'.$zone->id.')';
            $userlog->save();
			Session::flash('success','Successfully created the zone!');
			return Redirect::to('admin/zone');
		}
	}
	public function postUpdate($id){

		//validate
		$rules=array(
			'zonename'=>'required',
            'zonetype'=>'required',
            'width'=>'required|numeric',
            'height'=>'required|numeric'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/zone-edit-'.$id)->withErrors($validator);
		}else{
			$zone=Zone::find($id);
			$zone->website_id=Input::get('website_id');
			$zone->zonename=Input::get('zonename');
			$zone->description=Input::get('description');
			$zone->category=Input::get('category');
			$zone->zonetype=Input::get('zonetype');
			$zone->ad_selection=Input::get('ad_selection');
			$zone->width=Input::get('width');
			$zone->height=Input::get('height');
			$zone->pricing=Input::get('pricing');
			$zone->comments=Input::get('comments');
			$zone->save();

			// update redis cache
			$redis = RedisHandler::setZoneData($id);

            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="updated";
            $userlog->context="Zone";
            $userlog->contextid=$zone->id;
            $userlog->object=$zone->zonename;
            $userlog->details=Auth::user()->username.' updated Zone "'.$zone->zonename.'" (#'.$zone->id.')';
            $userlog->save();
			Session::flash('success','Successfully updated the zone!');
			return Redirect::to('admin/zone');
		}
	}
	public function getCodeAds($id){
		
	}
    public function delete($id)
	{
		Zone::where('id','=',$id)->update(
							array(
								'status'=>0
							)
						);
        $zone=Zone::where('id','=',$id)->get(); 
        $userlog=new Userlog;
        $userlog->account_id=Auth::user()->default_account_id;
        $userlog->userid=Auth::user()->id;
        $userlog->username=Auth::user()->username;
        $userlog->action="deleted";
        $userlog->context="Zone";
        $userlog->contextid=$zone->lists('id')[0];
        $userlog->object=$zone->lists('zonename')[0];
        $userlog->details=Auth::user()->username.' deleted Zone "'.$zone->lists('zonename')[0].'" (#'.$zone->lists('id')[0].')';
        $userlog->save();
        Session::flash('warning','Successfully deleted the zone!');
        return Redirect::to('admin/zone');
	}
    
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function recycle_bin(){
        $adtypes=Adtype::all();
        $zones=Zone::where('status','=',0)->get();
		return View::make('admin/zone/recycle_bin')->with('zones',$zones)->with('adtypes',$adtypes)->with('help',$this->__construct());
    }
    public function revert($id)
	{
        Zone::where('id','=',$id)->update(
							array(
								'status'=>1
							)
						);
        $zone=Zone::where('id','=',$id)->get(); 
        $userlog=new Userlog;
        $userlog->account_id=Auth::user()->default_account_id;
        $userlog->userid=Auth::user()->id;
        $userlog->username=Auth::user()->username;
        $userlog->action="reverted";
        $userlog->context="Zone";
        $userlog->contextid=$zone->lists('id')[0];
        $userlog->object=$zone->lists('zonename')[0];
        $userlog->details=Auth::user()->username.' reverted Zone "'.$zone->lists('zonename')[0].'" (#'.$zone->lists('id')[0].')';
        $userlog->save();
        Session::flash('success','Successfully restored the zone!');
        return Redirect::to('admin/zone');
	}
    
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id        	
	 * @return Response
	 */
    public function destroy($id)
	{
        $zone=Zone::find($id);
        $zone->delete();
        Session::flash('danger','Successfully destroyed the zone!');
        return Redirect::to('admin/zone-recycle');
    }
	public function getShow($id){
		$websites=Website::all();
		$categories=Category::tree();
		$zonetypes=Zonetype::all();
		$adtypes=Adtype::all();
		$websites=Website::all();
		$zone=Zone::find($id);
		return View::make('admin/zone/show')->with('websites',$websites)->with('zone',$zone)->with('categories',$categories)->with('zonetypes',$zonetypes)->with('adtypes',$adtypes)->with('websites',$websites)->with('help',$this->__construct());	
	}
	public function getCopy($id){
		$categories=Category::tree();
		$zonetypes=Zonetype::all();
		$adtypes=Adtype::all();
		$websites=Website::all();
		$zone=Zone::find($id);
		return View::make('admin/zone/copy')->with('zone',$zone)->with('categories',$categories)->with('zonetypes',$zonetypes)->with('adtypes',$adtypes)->with('websites',$websites)->with('help',$this->__construct());	
	}
	public function getEdit($id){
		$categories=Category::tree();
		$zonetypes=Zonetype::all();
		$adtypes=Adtype::all();
		$websites=Website::all();
		$zone=Zone::find($id);
		return View::make('admin/zone/edit')->with('zone',$zone)->with('categories',$categories)->with('zonetypes',$zonetypes)->with('adtypes',$adtypes)->with('websites',$websites)->with('help',$this->__construct());	
	}
	public function demoZone(){
		$zones=Zone::where('status','=',1)->get();
		$websites=Website::where('status','=',1)->get();
		return View::make('admin/zone/demo')->with('zones',$zones)->with('websites',$websites);
	}
	public function gridLayout(){
		$zones=Zone::all();
		return View::make('admin/zone/grid_layout')->with('zones',$zones);
	}
	public function postZoneCode($id){ //$test='NULL'; echo gettype($test); die();
		$zone=Zone::find($id);
		$zone->zonecode=Input::get('zonecode');
		$zone->save();
		return Redirect::to('admin/grid_layout');
	}
	public function displayWireFrame(){
		return View::make('admin/zone/display_wireframe');
	}
	public function getWireFrame(){
		return View::make('admin/zone/wireframe');
	}
}
?>