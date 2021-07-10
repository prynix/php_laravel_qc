<?php
class AdvertiserController extends BaseController{
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
	public function getList(){ //$language=Session::get('language',Config::get('app.locale')); echo $language; 
		$first_record=Advertiser::where('status','=',1)->orderBy('order_no','ASC')->first();
		$last_record=Advertiser::where('status','=',1)->orderBy('order_no','DESC')->first();
		$advertisers=Advertiser::where('status','=',1)->get();
		return View::make('admin/advertiser/index')->with('first_record',$first_record)->with('last_record',$last_record)->with('advertisers',$advertisers)->with('help',$this->__construct());
	}
	public function getInfo(){
		$advertisers=Advertiser::where('status','=',1)->get();
		return View::make('admin/advertiser/info')->with('advertisers',$advertisers)->with('help',$this->__construct());
	}
	public function getInfoById($id){
		$advertiser=Advertiser::find($id);
		$users=User::where('default_account_id','=',3)->get();
		$usergroups=Usergroup::all();
		$countries=Country::all();
		return View::make('admin/advertiser/info')->with('advertisers',$advertisers)->with('users',$users)->with('usergroups',$usergroups)->with('advertiser',$advertiser)->with('countries',$countries)->with('help',$this->__construct());
	}
	public function getCreate(){
		$users=User::where('default_account_id','=',3)->where('clientid','=',0)->get();
		$countries=Country::all();
		return View::make('admin/advertiser/create')->with('users',$users)->with('countries',$countries)->with('help',$this->__construct());
	}
	public function postStore(){
		//validate
		$rules=array(
			'clientname'=>'required',
			'contact'=>'required',
			'email'=>'required|email'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/advertiser-create')->withErrors($validator);
		}else{
			$advertiser=new Advertiser;
			$advertiser->clientname=Input::get('clientname');
			$advertiser->contact=Input::get('contact');
			$advertiser->email=Input::get('email');
			$advertiser->address=Input::get('address');
			$advertiser->city=Input::get('city');
			$advertiser->country=Input::get('country');
			$advertiser->phone=Input::get('phone');
			$advertiser->comments=Input::get('comments');
			$last_record=Advertiser::orderBy('order_no','DESC')->get(); 
			if(count($last_record)>0){
				$number=$last_record->lists('order_no')[0]+1;
			}else{
				$number=1;
			} 
			$advertiser->order_no=$number;
			$advertiser->save();
			// $userids=Input::get('userid'); 
			// $last_id=Advertiser::orderBy('id','DESC')->get(); 
			// if($userids){ 
			// 	foreach($userids as $userid){
			// 		//$advertiser->userid.=$userid.', ';
			// 		User::where('id','=',$userid)->update(
			// 			array(
			// 				'clientid'=>$last_id->lists('id')[0]	
			// 			)
			// 		);
			// 	}
			// }else{

			// }
            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="inserted";
            $userlog->context="Advertiser";
            $userlog->contextid=$advertiser->id;
            $userlog->object=$advertiser->clientname;
            $userlog->details=Auth::user()->username.' inserted Advertiser "'.$advertiser->clientname.'" (#'.$advertiser->id.')';
            $userlog->save();
            Session::flash('success','Successfully created the advertiser!');
			return Redirect::to('admin/advertiser');
		}
	}
	public function postUserAccess($id){
		$rules=array(
			'username'=>'required',//|unique:users',
			'password'=>'required',
			'repeat_password'=>'required|same:password',
			'contact_name'=>'required',
			'email_address'=>'required|email'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			//print_r($validator);
			return Redirect::to('admin/advertiser-edit-'.$id.'#tab-2')->withErrors($validator);
		}else{
			$user=new User;
			$user->username=Input::get('username');
			$user->password=Hash::make(Input::get('password'));
			$user->contact_name=Input::get('contact_name');
			$user->email=Input::get('email_address');
			$user->language=Input::get('language');
			$user->default_account_id=3;
			$user->clientid=$id;
			$last_record=User::orderBy('order_no','DESC'); 
			if($last_record->count()>0){
				$number=$last_record->lists('order_no')[0]+1;
			}else{
				$number=1;
			}
            $user->order_no=$number;
			$user->activated=1;
			$user->save();
			Session::flash('success','Successfully created the user access!');
			return Redirect::to('admin/advertiser-edit-'.$id.'#tab-2');
		}
	}
	public function destroyUserAccess($clientid,$userid){
		$user=User::find($userid);
        $user->delete();
        Session::flash('danger','Successfully deleted the user access!');
        return Redirect::to('admin/advertiser-edit-'.$clientid.'#tab-2');
	}
	public function postUpdate($id){
		//validate
		$rules=array(
			'clientname'=>'required',
			'contact'=>'required',
			'email'=>'required|email'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/advertiser-edit-'.$id)->withErrors($validator);
		}else{
			$advertiser=Advertiser::find($id);
			$advertiser->clientname=Input::get('clientname');
			$advertiser->contact=Input::get('contact');
			$advertiser->email=Input::get('email');
			$advertiser->address=Input::get('address');
			$advertiser->city=Input::get('city');
			$advertiser->country=Input::get('country');
			$advertiser->phone=Input::get('phone');
			$advertiser->comments=Input::get('comments');
			$advertiser->save();
			// $userids=Input::get('userid'); //echo '<pre/>'; print_r($userids); die();
			// if($userids){ 
			// 	foreach($userids as $userid){
			// 		User::where('id','=',$userid)->update(
			// 			array(
			// 				'clientid'=>$id
			// 			)
			// 		);
			// 	}
			// }else{

			// }
            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="updated";
            $userlog->context="Advertiser";
            $userlog->contextid=$advertiser->id;
            $userlog->object=$advertiser->clientname;
            $userlog->details=Auth::user()->username.' updated Advertiser "'.$advertiser->clientname.'" (#'.$advertiser->id.')';
            $userlog->save();
            Session::flash('success','Successfully updated the advertiser!');
			return Redirect::to('admin/advertiser');
		}
	}
    public function delete($id)
	{
        Advertiser::where('id','=',$id)->update(
							array(
								'status'=>0
							)
						);
        $advertiser=Advertiser::where('id','=',$id)->get(); 
        $userlog=new Userlog;
        $userlog->account_id=Auth::user()->default_account_id;
        $userlog->userid=Auth::user()->id;
        $userlog->username=Auth::user()->username;
        $userlog->action="deleted";
        $userlog->context="Advertiser";
        $userlog->contextid=$advertiser->lists('id')[0];
        $userlog->object=$advertiser->lists('clientname')[0];
        $userlog->details=Auth::user()->username.' deleted Advertiser "'.$advertiser->lists('clientname')[0].'" (#'.$advertiser->lists('id')[0].')';
        $userlog->save();
        Session::flash('warning','Successfully deleted the advertiser!');
        return Redirect::to('admin/advertiser');
	}
    public function recycle_bin(){
        $advertisers=Advertiser::where('status','=',0)->get();
		return View::make('admin/advertiser/recycle_bin')->with('advertisers',$advertisers)->with('help',$this->__construct());
    }
    public function revert($id)
	{
        Advertiser::where('id','=',$id)->update(
							array(
								'status'=>1
							)
						);
        $advertiser=Advertiser::where('id','=',$id)->get(); 
        $userlog=new Userlog;
        $userlog->account_id=Auth::user()->default_account_id;
        $userlog->userid=Auth::user()->id;
        $userlog->username=Auth::user()->username;
        $userlog->action="reverted";
        $userlog->context="Advertiser";
        $userlog->contextid=$advertiser->lists('id')[0];
        $userlog->object=$advertiser->lists('clientname')[0];
        $userlog->details=Auth::user()->username.' reverted Advertiser "'.$advertiser->lists('clientname')[0].'" (#'.$advertiser->lists('id')[0].')';
        $userlog->save();
        Session::flash('success','Successfully restored the advertiser!');
        return Redirect::to('admin/advertiser');
	}
    public function destroy($id)
	{
        $advertiser=Advertiser::find($id);
        $advertiser->delete();
        Session::flash('danger','Successfully destroyed the advertiser!');
        return Redirect::to('admin/advertiser-recycle');
    }
	public function getShow($id){
		$advertiser=Advertiser::find($id);
		$users=User::where('default_account_id','=',3)->get();
		$usergroups=Usergroup::all();
		$countries=Country::all();
		$languages=Language::all();
		return View::make('admin/advertiser/show')->with('users',$users)->with('usergroups',$usergroups)->with('advertiser',$advertiser)->with('languages',$languages)->with('countries',$countries)->with('help',$this->__construct());
	}
    public function getCopy($id){
        $users=User::where('default_account_id','=',3)->where('clientid','=',0)->get();
	$countries=Country::all();
	$advertiser=Advertiser::find($id);
	return View::make('admin/advertiser/copy')->with('users',$users)->with('advertiser',$advertiser)->with('countries',$countries)->with('help',$this->__construct());
    }
    public function getEdit($id){
        $users=User::where('default_account_id','=',3)->get();
		$usergroups=Usergroup::all();
		$countries=Country::all();
		$languages=Language::all();
		$advertiser=Advertiser::find($id);
	return View::make('admin/advertiser/edit')->with('users',$users)->with('usergroups',$usergroups)->with('advertiser',$advertiser)->with('languages',$languages)->with('countries',$countries)->with('help',$this->__construct());
    }
    public function getOrder($id){
        $advertisers=Advertiser::where('status','=',1)->get();
    	$advertiser=Advertiser::find($id);
    	if(isset($advertiser)){
            $campaigns=Campaign::where('clientid','=',$id)->get();
            if(isset($campaigns)){
                //echo '<pre/>';
                //print_r(count($campaign));
                foreach($campaigns as $cam){
                    //print_r($cam->id);   
                    $websites=Website::where('campaignid','=',$cam->id)->get();
                    if(isset($websites)){
                        foreach($websites as $web){
                            $zones=Zone::where('website_id','=',$web->id)->get();
                            if(isset($zones)){
                                foreach($zones as $zon){
                                    $banners=Banner::where('zoneid','=',$zon->id)->get();
                                }
                            }else{
                                $zones='';
                            }
                        }
                    }else{
                        $websites='';     
                    }
                }
            }else{
               $campaigns=''; 
            }
        }else{
            $advertiser='';   
        } 
        $countries=Country::where('status','=',1)->get();
        return View::make('admin/order/index')->with('advertiser',$advertiser)->with('advertisers',$advertisers)->with('zones',$zones)->with('banners',$banners)->with('countries',$countries);
    }
    public function getPackage($id){
    	$zonetypes=Zonetype::all();
    	$advertisers=Advertiser::where('status','=',1)->get();
    	$advertiser=Advertiser::find($id);
    	if(isset($advertiser)){
            $campaigns=Campaign::where('clientid','=',$id)->get();
            if(isset($campaigns)){
                //echo '<pre/>';
                //print_r(count($campaign));
                foreach($campaigns as $cam){
                    //print_r($cam->id);   
                    $websites=Website::where('campaignid','=',$cam->id)->get();
                    if(isset($websites)){
                        foreach($websites as $web){
                            $zones=Zone::where('website_id','=',$web->id)->get();
                            if(isset($zones)){
                                foreach($zones as $zon){
                                    $banners=Banner::where('zoneid','=',$zon->id)->get();
                                }
                            }else{
                                $zones='';
                            } 
					    	$channels=Channel::where('website_id','=',$web->id)->get();
					    	if(isset($channels)){
					    		
					    	}else{
					    		$channels='';
					    	}
                        }
                    }else{
                        $websites='';     
                    }
                }
            }else{
               $campaigns=''; 
            }
        }else{
            $advertiser='';   
        }
    	return View::make('admin/advertiser/info')->with('zonetypes',$zonetypes)->with('advertiser',$advertiser)->with('advertisers',$advertisers)->with('campaigns',$campaigns)->with('websites',$websites)->with('zones',$zones)->with('banners',$banners)->with('channels',$channels);
    }
}
?>