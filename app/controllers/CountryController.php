<?php
class CountryController extends BaseController{
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
		$countries=DB::table('countries')->where('status','=',1)->get();
		return View::make('admin/country/index')->with('countries',$countries)->with('help',$this->__construct());
	}
	public function getCreate(){
		return View::make('admin/country/create')->with('help',$this->__construct());
	}
	public function postStore(){ 
		$rules=array(
			'country_name'=>'required'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/country')->withErrors($validator)->withInput(Input::except('country_name'));
		}else{
			$country=new Country;
			$country->country_name=Input::get('country_name');
			$country->save();
            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="inserted";
            $userlog->context="Country";
            $userlog->contextid=$country->id;
            $userlog->object=$country->country_name;
            $userlog->details=Auth::user()->username.' inserted Country "'.$country->country_name.'" (#'.$country->id.')';
            $userlog->save();
            Session::flash('success','Successfully created the country!');
			return Redirect::to('admin/country');
		}
	}
	public function postUpdate($id){
		$rules=array(
			'country_name'=>'required'
		);
		 $validator=Validator::make(Input::all(),$rules);
		 if($validator->fails()){
		 	return Redirect::to('admin/country-edit-'.$id)->withErrors($validator)->withInput(Input::except('country_name'));
		 }else{
			$country=Country::find($id);
			$country->country_name=Input::get('country_name');
			$country->save();
            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="updated";
            $userlog->context="Country";
            $userlog->contextid=$country->id;
            $userlog->object=$country->country_name;
            $userlog->details=Auth::user()->username.' updated Country "'.$country->country_name.'" (#'.$country->id.')';
            $userlog->save();
            Session::flash('success','Successfully updated the country!');
			return Redirect::to('admin/country');
		}
	}
    public function delete($id)
	{
		Country::where('id','=',$id)->update(
							array(
								'status'=>0
							)
						);
        $country=Country::where('id','=',$id)->get(); 
        $userlog=new Userlog;
        $userlog->account_id=Auth::user()->default_account_id;
        $userlog->userid=Auth::user()->id;
        $userlog->username=Auth::user()->username;
        $userlog->action="deleted";
        $userlog->context="Country";
        $userlog->contextid=$country->lists('id')[0];
        $userlog->object=$country->lists('country_name')[0];
        $userlog->details=Auth::user()->username.' deleted Country "'.$country->lists('country_name')[0].'" (#'.$country->lists('id')[0].')';
        $userlog->save();
        Session::flash('warning','Successfully deleted the country !');
        return Redirect::to('admin/country');
	}
    
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function recycle_bin(){
        $countries = Country::where('status','=',0)->get();
		return View::make('admin/country/recycle_bin')->with('countries',$countries)->with('help',$this->__construct());
    }
    public function revert($id)
	{
        Country::where('id','=',$id)->update(
							array(
								'status'=>1
							)
						);
        $country=Country::where('id','=',$id)->get(); 
        $userlog=new Userlog;
        $userlog->account_id=Auth::user()->default_account_id;
        $userlog->userid=Auth::user()->id;
        $userlog->username=Auth::user()->username;
        $userlog->action="reverted";
        $userlog->context="Country";
        $userlog->contextid=$country->lists('id')[0];
        $userlog->object=$country->lists('country_name')[0];
        $userlog->details=Auth::user()->username.' reverted Country "'.$country->lists('country_name')[0].'" (#'.$country->lists('id')[0].')';
        $userlog->save();
        Session::flash('success','Successfully reverted the country!');
        return Redirect::to('admin/country');
	}
    
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id        	
	 * @return Response
	 */
    public function destroy($id)
	{
        $countries=Country::find($id);
        $countries->delete();
        Session::flash('danger','Successfully destroyed the country!');
        return Redirect::to('admin/country-recycle');
    }
	
	public function getShow($id){
		$country=Country::find($id);
		return View::make('admin/country/show')->with('country',$country)->with('help',$this->__construct());
	}
	
	public function getCopy($id){
		$country=Country::find($id);
		return View::make('admin/country/copy')->with('country',$country)->with('help',$this->__construct());
	}
	
	public function getEdit($id){
		$country=Country::find($id);
		return View::make('admin/country/edit')->with('country',$country)->with('help',$this->__construct());
	}
}
?>